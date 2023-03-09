<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;



class PostRepository implements PostRepositoryInterface
{
    protected $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function create(array $data)
    {
        $data['slug'] = Str::slug($data['title']);
        $post = $this->model->create($data);

        if (isset($data['image'])) {
            $post->addMediaFromRequest('image')->toMediaCollection('images');
        }

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

        return $post;
    }

    public function delete(Post $post)
    {
        return $post->delete();
    }
}
