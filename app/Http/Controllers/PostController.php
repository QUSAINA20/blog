<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepositoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->getAll();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
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
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $slug)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'image', 'nullable'
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
