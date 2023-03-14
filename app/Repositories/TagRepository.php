<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Repositories\TagRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;



class TagRepository implements TagRepositoryInterface
{
    protected $model;

    public function __construct(Tag $model)
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
        $tag = $this->model->create($data);
        return $tag;
    }

    public function update(Tag $tag, array $data)
    {
        if (isset($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        $tag->update($data);
        return $tag;
    }

    public function delete(Tag $tag)
    {
        return $tag->delete();
    }
}
