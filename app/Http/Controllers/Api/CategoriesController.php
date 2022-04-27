<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostCollection;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    protected $postCategoriesRepository;
    protected $postRepository;

    public function __construct(
        \App\Repositories\PostCategoriesRepositoryInterface $postCategoriesRepository,
        \App\Repositories\PostRepositoryInterface           $postRepository
    )
    {
        $this->postCategoriesRepository = $postCategoriesRepository;
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show(Request $request, $urlKey)
    {
        $pagination = $request->query('per_page') ?? null;
        $posts = $this->postCategoriesRepository->getPostsByUrlKey($urlKey);
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
