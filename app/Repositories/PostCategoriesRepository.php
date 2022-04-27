<?php

namespace App\Repositories;

use App\Models\PostCategories;

class PostCategoriesRepository implements PostCategoriesRepositoryInterface
{
    public function get($postCategoriesId)
    {
        return PostCategories::find($postCategoriesId);
    }

    public function all()
    {
        return PostCategories::all();
    }

    public function delete($postCategoriesId)
    {
        PostCategories::destroy($postCategoriesId);
    }

    public function update($postCategoriesId, array $postCategoriesData)
    {
        PostCategories::find($postCategoriesId)->update($postCategoriesData);
    }

    public function store(array $postCategoriesData)
    {
        PostCategories::create($postCategoriesData);
    }

    public function getPostsByUrlKey(string $urlKey)
    {
        $posts = PostCategories::where('url_key', $urlKey);

        if(!empty($posts->get()->toArray())){
            return $posts->first()->posts();
        }

        abort(404, 'Post not found');
    }
}
