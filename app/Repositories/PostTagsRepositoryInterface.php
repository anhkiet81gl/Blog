<?php

namespace App\Repositories;

interface PostTagsRepositoryInterface
{
    /**
     * Gets a post by its ID
     *
     * @param int
     */
    public function get($tagId);

    /**
     * Gets all posts.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($tagId);

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update($tagId, array $tagData);

    /**
     * Save a post.
     *
     * @param array $tagData
     */
    public function store(array $tagData);

    /**
     * Deletes a post.
     *
     * @param string $urlKey
     */
    public function getPostsByUrlKey(string $urlKey);
}
