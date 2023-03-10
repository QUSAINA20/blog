<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAll();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'image' => ['nullable', 'image']
        ]);

        $category = $this->categoryRepository->create($validatedData);
        return redirect()->route('categories.show', ['category' => $category->slug])
            ->with('success', 'category created successfully.');
    }

    public function show($slug)
    {
        $category = $this->categoryRepository->getBySlug($slug);
        return view('categories.show', compact('category'));
    }

    public function edit($slug)
    {
        $category = $this->categoryRepository->getBySlug($slug);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $slug)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'image' => ['nullable', 'image']
        ]);

        $category = $this->categoryRepository->getBySlug($slug);
        $this->categoryRepository->update($category, $validatedData);

        return redirect()->route('categories.show', ['category' => $category->slug])
            ->with('success', 'category updated successfully.');
    }

    public function destroy($slug)
    {
        $category = $this->categoryRepository->getBySlug($slug);
        $this->categoryRepository->delete($category);

        return redirect()->route('categories.index')
            ->with('success', 'category deleted successfully.');
    }
}
