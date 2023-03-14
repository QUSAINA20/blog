<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;



class PostRepository implements PostRepositoryInterface
{
    protected $model;
    protected $categoryRepository;
    protected $tagRepository;


    public function __construct(Post $model, CategoryRepository $categoryRepository, TagRepositoryInterface $tagRepository)
    {
        $this->model = $model;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
    }

    public function getAll()
    {
        return $this->model->with('category', 'user', 'tags')->paginate(3);
    }
    public function search($query, $categorySlug = null)
    {
        $postsQuery = Post::query()
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%$query%")
                    ->orWhere('body', 'LIKE', "%$query%");
            })
            ->with('category');

        if ($categorySlug) {
            $category = $this->categoryRepository->getBySlug($categorySlug);
            if ($category) {
                $postsQuery->where('category_id', $category->id);
            }
        }

        return $postsQuery->paginate(3);
    }



    public function getBySlug($slug)
    {
        return $this->model->where('slug', $slug)->with('category', 'user', 'comments', 'tags')->first();
    }

    public function create(array $data)
    {
        $data['slug'] = Str::slug($data['title']);
        $post = $this->model->create($data);

        if (isset($data['image'])) {
            $post->addMediaFromRequest('image')->toMediaCollection('images');
        }
        if (isset($data['category_id'])) {
            $category = Category::find($data['category_id']);
            $post->category()->associate($category);
        }
        if (isset($data['user_id'])) {
            $user = User::find($data['user_id']);
            $post->user()->associate($user);
        } else {
            $post->user_id = auth()->user()->id;
        }
        if (isset($data['tags'])) {
            $tagIds = Tag::whereIn('name', $data['tags'])->pluck('id')->toArray();
            $post->tags()->attach($tagIds);
        }
        $post->save();
        return $post;
    }

    public function update(Post $post, array $data)
    {
        if (isset($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        $post->update($data);

        if (isset($data['image']) && $data['image']->isValid()) {
            $post->clearMediaCollection('images');
            $post->addMediaFromRequest('image')->toMediaCollection('images');
        }
        if (isset($data['category_id'])) {
            $category = Category::find($data['category_id']);
            $post->category()->associate($category);
        }
        if (isset($data['user_id'])) {
            $user = User::find($data['user_id']);
            $post->user()->associate($user);
        }
        if (isset($data['tags'])) {
            $tagIds = [];
            foreach ($data['tags'] as $tagName) {
                $tag = Tag::where('name', $tagName)->first();
                if ($tag) {
                    $tagIds[] = $tag->id;
                }
            }
            $post->tags()->sync($tagIds);
        }

        $post->save();

        return $post;
    }
    public function getCategories()
    {
        return Category::all();
    }
    public function gettags()
    {
        return Tag::all();
    }

    public function delete(Post $post)
    {
        return $post->delete();
    }
}
