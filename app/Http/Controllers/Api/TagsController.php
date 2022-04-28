<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\PostTags\PostTagCollection;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    protected $postRepository;
    protected $postTagsRepository;

    public function __construct(
        \App\Repositories\PostRepositoryInterface     $postRepository,
        \App\Repositories\PostTagsRepositoryInterface $postTagsRepository
    )
    {
        $this->postRepository = $postRepository;
        $this->postTagsRepository = $postTagsRepository;
    }

    public function index()
    {
        return new PostTagCollection($this->postTagsRepository->all());
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request, $urlKey)
    {
        $pagination = $request->query('per_page') ?? null;
        $posts = $this->postTagsRepository->getPostsByUrlKey($urlKey);
        $collection = $posts->paginate("10");

        foreach ($collection as $key => $value) {
            $post = $this->handleSetDataPost($value);
            $collection[$key] = $post;
        }

        return new PostCollection($collection);
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
