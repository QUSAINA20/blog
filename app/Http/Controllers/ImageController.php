<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Repositories\ImageRepositoryInterface;
use Illuminate\Http\Request;

class imageController extends Controller
{
    protected $imageRepository;

    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function index()
    {
        $images = $this->imageRepository->getAll();
        return view('images.index', compact('images'));
    }

    public function create()
    {
        return view('images.create');
    }

    public function store(ImageRequest $request)
    {
        $validatedData = $request->validate();

        $image = $this->imageRepository->create($validatedData);
        return redirect()->route('images.show', ['image' => $image->slug])
            ->with('success', 'image created successfully.');
    }

    public function show($slug)
    {
        $image = $this->imageRepository->getBySlug($slug);
        return view('images.show', compact('image'));
    }

    public function edit($slug)
    {
        $image = $this->imageRepository->getBySlug($slug);
        return view('images.edit', compact('image'));
    }

    public function update(ImageRequest $request, $slug)
    {
        $validatedData = $request->validate();

        $image = $this->imageRepository->getBySlug($slug);
        $this->imageRepository->update($image, $validatedData);

        return redirect()->route('images.show', ['image' => $image->slug])
            ->with('success', 'image updated successfully.');
    }

    public function destroy($slug)
    {
        $image = $this->imageRepository->getBySlug($slug);
        $this->imageRepository->delete($image);

        return redirect()->route('images.index')
            ->with('success', 'image deleted successfully.');
    }
}
