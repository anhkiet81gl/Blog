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
        return Tag::find($tagId);
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
        Tag::find($tagId)->update($tagData);
    }

    public function store(array $tagData)
    {
         Tag::create($tagData);
    }
}
