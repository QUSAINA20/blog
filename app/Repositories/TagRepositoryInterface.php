<?php

namespace App\Repositories;

use App\Models\Tag;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TagRepositoryInterface
{
    public function getAll();
    public function getBySlug($slug);
    public function create(array $data);
    public function update(Tag $tag, array $data);
    public function delete(Tag $tag);
}
