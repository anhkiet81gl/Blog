<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\PostAuthors\PostAuthorsCollection;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    protected $postAuthorRepository;
    protected $postRepository;

    public function __construct(
        \App\Repositories\PostRepositoryInterface       $postRepository,
        \App\Repositories\PostAuthorRepositoryInterface $postAuthorRepository
    )
    {
        $this->postAuthorRepository = $postAuthorRepository;
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $author = $this->postAuthorRepository->all();

        return new PostAuthorsCollection($author);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request, $urlKey)
    {
        $pagination = $request->query('per_page') ?? null;
        $posts = $this->postAuthorRepository->getPostsByUrlKey($urlKey);
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
