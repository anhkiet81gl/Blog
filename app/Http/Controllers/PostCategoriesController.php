<?php

namespace App\Http\Controllers;

use App\DataTables\PostCategoriesDataTable;
use Illuminate\Http\Request;

class PostCategoriesController extends Controller
{
    protected $postCategoriesRepository;

    public function __construct(
        \App\Repositories\PostCategoriesRepositoryInterface $postCategoriesRepository
    )
    {
        $this->postCategoriesRepository = $postCategoriesRepository;
    }

    public function index(PostCategoriesDataTable $dataTable)
    {
        return $dataTable->render('admin.post_categories.index');
    }

    public function create()
    {
        return view("admin.post_categories.create");
    }

    public function edit($id)
    {
        $category = $this->postCategoriesRepository->get($id);
        if ($category) {
            return view("admin.post_categories.edit", compact('category'));
        }
        return redirect(route('admin.post-categories.create'));
    }

    public function store(Request $request)
    {
        try {
            $data = $this->handlePostCategories($request);
            $this->postCategoriesRepository->store((array)$data);
            return redirect()->back()->with('success', 'Create Post Categories successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->with('validator', $e->errors());
        }
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $this->handlePostCategories($request);
            $this->postCategoriesRepository->update($id, (array)$data);
            return redirect()->back()->with('success', 'Update Categories successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->with('validator', $e->errors());
        }
    }

    public function destroy($id)
    {

    }

    protected function handlePostCategories($request)
    {
        return $request->validate([
            'name' => isset($request->all()['id'])
                ? 'required|unique:post_categories,name,'.$request->all()['id']
                : 'required|unique:post_categories,name',
            'url_key' => isset($request->all()['id'])
                ? 'required|unique:post_categories,url_key,' . $request->all()['id']
                : 'required|unique:post_categories,url_key',
        ]);
    }
}
