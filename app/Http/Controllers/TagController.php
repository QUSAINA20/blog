<?php

namespace App\Http\Controllers;

use App\Repositories\TagRepositoryInterface;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        $tags = $this->tagRepository->getAll();
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $tag = $this->tagRepository->create($validatedData);
        return redirect()->route('tags.show', ['tag' => $tag->slug])
            ->with('success', 'tag created successfully.');
    }

    public function show($slug)
    {
        $tag = $this->tagRepository->getBySlug($slug);
        return view('tags.show', compact('tag'));
    }

    public function edit($slug)
    {
        $tag = $this->tagRepository->getBySlug($slug);
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, $slug)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $tag = $this->tagRepository->getBySlug($slug);
        $this->tagRepository->update($tag, $validatedData);

        return redirect()->route('tags.show', ['tag' => $tag->slug])
            ->with('success', 'tag updated successfully.');
    }

    public function destroy($slug)
    {
        $tag = $this->tagRepository->getBySlug($slug);
        $this->tagRepository->delete($tag);

        return redirect()->route('tags.index')
            ->with('success', 'tag deleted successfully.');
    }
}
