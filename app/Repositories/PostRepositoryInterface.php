<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PostRepositoryInterface
{
    public function getAll();
    public function getBySlug($slug);
    public function create(array $data);
    public function update(Post $post, array $data);
    public function delete(Post $post);
}
