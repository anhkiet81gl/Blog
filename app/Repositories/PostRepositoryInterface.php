<?php

namespace App\Repositories;

interface PostRepositoryInterface
{
    /**
     * Gets a post by its ID
     *
     * @param int
     */
    public function get($postId);

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
    public function delete($postId);

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update($postId, array $postData);

    /**
     * Save a post.
     *
     * @param array $postData
     */
    public function store(array $postData);

    /**
     * Gets all posts.
     *
     * @param int $pagination
     * @return mixed
     */
    public function getPostWithPagination(int $pagination);

    /**
     * Gets all posts.
     *
     * @param mixed $post
     * @return string
     */
    public function getImageUrl($post);

    /**
     * Gets all posts.
     *
     * @param string $urlKey
     * @return mixed
     */
    public function getPostByUrlKey(string $urlKey);
}
