<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CategoryRepositoryInterface
{
    public function getAll();
    public function getBySlug($slug);
    public function create(array $data);
    public function update(Category $category, array $data);
    public function delete(Category $category);
}
