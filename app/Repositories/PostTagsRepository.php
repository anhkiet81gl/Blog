<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class PostTagsRepository implements PostTagsRepositoryInterface
{

    public function get($tagId)
    {
        // TODO: Implement get() method.
    }

    public function all()
    {
        return Tag::all();
    }

    public function delete($tagId)
    {
        // TODO: Implement delete() method.
    }

    public function update($tagId, array $tagData)
    {
        // TODO: Implement update() method.
    }

    public function store(array $tagData)
    {
        // TODO: Implement store() method.
    }
}
