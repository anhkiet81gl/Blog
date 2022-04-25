<?php

namespace App\Repositories;

interface PostCategoriesRepositoryInterface
{
    /**
     * Gets a post by its ID
     *
     * @param int
     */
    public function get($postCategoriesId);

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
    public function delete($postCategoriesId);

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update($postCategoriesId, array $postCategoriesData);

    /**
     * Save a post.
     *
     * @param array $postCategoriesData
     */
    public function store(array $postCategoriesData);
}
