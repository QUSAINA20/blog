<?php

namespace App\Repositories;

use App\Models\Image;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ImageRepositoryInterface
{
    public function getAll();
    public function getBySlug($slug);
    public function create(array $data);
    public function update(Image $image, array $data);
    public function delete(Image $image);
}
