<?php

namespace App\Repositories;

interface PostAuthorRepositoryInterface
{
    /**
     * Gets a post by its ID
     *
     * @param int
     */
    public function get($postAuthorId);

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
    public function delete($postAuthorId);

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update($postAuthorId, array $postAuthorData);

    /**
     * Save a post.
     *
     * @param array $postAuthorData
     */
    public function store(array $postAuthorData);
}
