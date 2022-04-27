<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class PostRepository implements PostRepositoryInterface
{
    /**
     * Gets a post by its ID
     *
     * @param int
     * @return collection
     */
    public function get($postId)
    {
        return Post::find($postId);
    }

    /**
     * Gets all posts.
     *
     * @return Collection|Post[]
     */
    public function all()
    {
        return Post::all();
    }

    /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($postId)
    {
        Post::destroy($postId);
    }

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update($postId, array $postData)
    {
        $post = Post::find($postId);
        $categories = $postData["categories"] ?? [];
        $post->postCategories()->sync($categories);
        Arr::forget($postData, 'categories');
        $post->update($postData);
    }

    /**
     * Updates a post.
     *
     * @param array
     */
    public function store(array $postData)
    {
        $categories = $postData["categories"] ?? [];
        $tags = $postData["tags"] ?? [];
        $author = $postData["authors"] ?? [];

        $post = Post::create($postData);
        $post->postCategories()->sync($categories);
        $post->postTags()->sync($tags);
        $post->postAuthors()->sync($author);
    }

    public function getPostWithPagination(int $pagination = null)
    {
        return Post::paginate($pagination);
    }

    public function getImageUrl($post)
    {
        if (isset($post->toArray()['image'])) {
            return Storage::disk('public')->url($post->getAttribute('image'));
        }
        return '';
    }

    public function getPostByUrlKey(string $urlKey)
    {
        $post = Post::where('slug', $urlKey);

        if(!empty($post->get()->toArray())){
            return $post->first();
        }

        abort(404, 'Post not found');
    }
}
