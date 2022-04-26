<?php

namespace App\Http\Controllers;

use App\DataTables\TagsDataTable;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $postTagsRepository;

    public function __construct(
        \App\Repositories\PostTagsRepository $postTagsRepository
    )
    {
        $this->postTagsRepository = $postTagsRepository;
    }

    public function index(TagsDataTable $dataTable)
    {
        return $dataTable->render('admin.tags.index');

    }

    public function create()
    {
        return view("admin.tags.create");

    }

    public function store(Request $request)
    {
        try {
            $data = $this->handlePostTagsCategories($request);
            $this->postTagsRepository->store((array)$data);
            return redirect()->back()->with('success', 'Create Tag successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->with('validator', $e->errors());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $tag = $this->postTagsRepository->get($id);
        if ($tag) {
            return view("admin.tags.edit", compact('tag'));
        }
        return redirect(route('admin.tags.create'));
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $this->handlePostTagsCategories($request);
            $this->postTagsRepository->update($id, (array)$data);
            return redirect()->back()->with('success', 'Update Tag successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->with('validator', $e->errors());
        }
    }

    public function destroy($id)
    {
        //
    }

    protected function handlePostTagsCategories($request)
    {
        return $request->validate([
            'name' => isset($request->all()['id'])
                ? 'required|unique:post_categories,name,' . $request->all()['id']
                : 'required|unique:post_categories,name',
            'url_key' => isset($request->all()['id'])
                ? 'required|unique:post_categories,url_key,' . $request->all()['id']
                : 'required|unique:post_categories,url_key',
        ]);
    }
}
