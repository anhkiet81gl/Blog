<?php

namespace App\Http\Controllers;

use App\DataTables\PostDataTable;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PostController extends Controller
{

    protected $postRepository;
    protected $postCategoriesRepository;
    protected $postTagsRepository;
    protected $postAuthorRepository;

    public function __construct(
        \App\Repositories\PostRepositoryInterface           $postRepository,
        \App\Repositories\PostCategoriesRepositoryInterface $postCategoriesRepository,
        \App\Repositories\PostTagsRepositoryInterface       $postTagsRepository,
        \App\Repositories\PostAuthorRepositoryInterface     $postAuthorRepository
    )
    {
        $this->postRepository = $postRepository;
        $this->postCategoriesRepository = $postCategoriesRepository;
        $this->postTagsRepository = $postTagsRepository;
        $this->postAuthorRepository = $postAuthorRepository;
    }

    public function index(PostDataTable $dataTable)
    {
        return $dataTable->render('admin.posts.index');
    }

    public function create()
    {
        $categories = $this->postCategoriesRepository->all()->pluck('name', 'id');
        $tags = $this->postTagsRepository->all()->pluck('name', 'id');
        $authors = $this->postAuthorRepository->all()->pluck('name', 'id');
        return view('admin.posts.create', compact('categories', 'tags', 'authors'));
    }

    public function edit($id)
    {
        try {
            $post = $this->postRepository->get($id);

            $categories = $this->postCategoriesRepository->all()->pluck('name', 'id');
            $tags = $this->postTagsRepository->all()->pluck('name', 'id');
            $authors = $this->postAuthorRepository->all()->pluck('name', 'id');

            $authorSelected = $post->postAuthors->pluck('name', 'id')->toArray();
            $categoriesSelected = $post->postCategories->pluck('name', 'id')->toArray();
            $tagsSelected = $post->postTags->pluck('name', 'id')->toArray();

            return view('admin.posts.edit', compact(
                'categories',
                'categoriesSelected',
                'post',
                'authorSelected',
                'tagsSelected',
                'tagsSelected',
                'tags',
                'authors',
            ));
        } catch (\Exception $e) {
            return view('admin.posts.create')->with('error', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = $this->handlePost($request);
            $this->postRepository->store($validator);
            return redirect()->back()->with('success', 'Create post successfully');
        } catch (\Exception $e) {
            return redirect(route('admin.posts.create'))->with('validator', $e->errors())->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = $this->handlePost($request);
            $this->postRepository->update($id, $validator);
            return redirect()->back()->with('success', 'Update post successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->with('validator', $e->errors());
        }
    }

    public function destroy($id)
    {
        try {
            $this->postRepository->delete($id);
            return redirect()->back()->with('success', 'Delete post successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    protected function handlePost($request)
    {
        $validator = $request->validate([
            'user_id' => '',
            'title' => 'required',
            'slug' => isset($request->all()['id'])
                ? 'required|unique:posts,slug,' . $request->all()['id']
                : 'required|unique:posts,slug',
            'views' => '',
            'body' => 'required',
            'published' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories' => '',
            'tags' => '',
            'authors' => '',
        ]);

        $auth = Auth::user();
        if ($auth) $validator['user_id'] = $auth->getAuthIdentifier();
        $result = $validator;

        if (isset($validator['image'])) {
            $image = Storage::disk('public')->putFileAs('post', $validator['image'], $validator['image']->getClientOriginalName());
            Artisan::call('storage:link');
            $result['image'] = $image;
        } else {
            $result['image'] = '';
        }

        return $result;
    }
}
