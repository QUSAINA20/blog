<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postRepository;
    protected $categoryRepository;

    public function __construct(PostRepositoryInterface $postRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
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
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'image' => ['nullable', 'image']
        ]);

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
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $slug)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'image', 'nullable',
            'category_id' => 'nullable|exists:categories,id',

        ]);

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
