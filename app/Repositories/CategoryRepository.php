<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;



class CategoryRepository implements CategoryRepositoryInterface
{
    protected $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->with('posts')->get();
    }

    public function getBySlug($slug)
    {
        return $this->model->with('posts')->where('slug', $slug)->first();
    }

    public function create(array $data)
    {
        $data['slug'] = Str::slug($data['name']);
        $category = $this->model->create($data);

        if (isset($data['image'])) {
            $category->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return $category;
    }

    public function update(Category $category, array $data)
    {
        if (isset($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        $category->update($data);

        if (isset($data['image']) && $data['image']->isValid()) {
            $category->clearMediaCollection('images');
            $category->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return $category;
    }

    public function delete(Category $category)
    {
        return $category->delete();
    }
}
