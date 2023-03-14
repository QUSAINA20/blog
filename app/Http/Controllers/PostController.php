<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\TagRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    protected $postRepository;
    protected $categoryRepository;
    protected $tagRepository;

    public function __construct(PostRepositoryInterface $postRepository, CategoryRepositoryInterface $categoryRepository, TagRepositoryInterface $tagRepository)
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
    }

    public function index(Request $request)
    {
        $query = $request->input('query');
        $categorySlug = $request->input('category');
        $categories = $this->categoryRepository->getAll();
        $posts = $this->postRepository->search($query, $categorySlug);

        return view('posts.index', compact('categories', 'posts', 'query', 'categorySlug'));
    }

    public function create()
    {
        $categories = $this->postRepository->getCategories();
        $tags = $this->postRepository->gettags();
        return view('posts.create', compact('categories', 'tags'));
    }

    public function store(PostRequest $request)
    {
        $validatedData = $request->validated();
        $post = $this->postRepository->create($validatedData);
        return redirect()->route('posts.show', ['post' => $post->slug])
            ->with('success', 'Post created successfully.');
    }

    public function show($slug)
    {
        $post = $this->postRepository->getBySlug($slug);
        return view('posts.show', compact('post'));
    }

    public function edit($slug)
    {
        $post = $this->postRepository->getBySlug($slug);
        $categories = $this->postRepository->getCategories();
        $tags = $this->postRepository->gettags();
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(PostRequest $request, $slug)
    {
        $validatedData = $request->validated();

        $post = $this->postRepository->getBySlug($slug);
        $this->postRepository->update($post, $validatedData);

        return redirect()->route('posts.show', ['post' => $post->slug])
            ->with('success', 'Post updated successfully.');
    }

    public function destroy($slug)
    {
        $post = $this->postRepository->getBySlug($slug);
        $this->postRepository->delete($post);

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}
