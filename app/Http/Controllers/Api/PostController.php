<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostResource;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct(
        \App\Repositories\PostRepositoryInterface $postRepository
    )
    {
        $this->postRepository = $postRepository;
    }

    public function index(Request $request)
    {
        $pagination = $request->query('per_page') ?? null;
        $collection = $this->postRepository->getPostWithPagination($pagination);

        foreach ($collection as $key => $value) {
            $post = $this->handleSetDataPost($value);
            $collection[$key] = $post;
        }

        return new PostCollection($collection);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($urlKey)
    {
        $post = $this->postRepository->getPostByUrlKey($urlKey);
        $post = $this->handleSetDataPost($post);

        return new PostResource($post);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    protected function handleSetDataPost($post)
    {
        $url = $this->postRepository->getImageUrl($post);

        $post->setAttribute('image', $url);
        $post->setAttribute('categories', $post->postCategories);
        $post->setAttribute('authors', $post->postAuthors);
        $post->setAttribute('tags', $post->postTags);

        return $post;
    }
}
