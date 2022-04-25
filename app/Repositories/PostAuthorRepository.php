<?php

namespace App\Repositories;

use App\Models\Author;
use App\Models\PostCategories;

class PostAuthorRepository implements PostAuthorRepositoryInterface
{

    public function get($postAuthorId)
    {
        // TODO: Implement get() method.
    }

    public function all()
    {
        return Author::all();

    }

    public function delete($postAuthorId)
    {
        // TODO: Implement delete() method.
    }

    public function update($postAuthorId, array $postAuthorData)
    {
        // TODO: Implement update() method.
    }

    public function store(array $postAuthorData)
    {
        // TODO: Implement store() method.
    }
}
