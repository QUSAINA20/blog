<?php

namespace App\Repositories;

use App\Models\Image;
use App\Repositories\ImageRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;



class ImageRepository implements ImageRepositoryInterface
{
    protected $model;

    public function __construct(Image $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function getBySlug($slug)
    {
        return $this->model->where('slug', $slug)->with('comments')->first();
    }

    public function create(array $data)
    {
        $data['slug'] = Str::slug($data['name']);
        $image = $this->model->create($data);

        if (isset($data['image'])) {
            $image->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return $image;
    }

    public function update(Image $image, array $data)
    {
        if (isset($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        $image->update($data);

        if (isset($data['image']) && $data['image']->isValid()) {
            $image->clearMediaCollection('images');
            $image->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return $image;
    }

    public function delete(Image $category)
    {
        return $category->delete();
    }
}
