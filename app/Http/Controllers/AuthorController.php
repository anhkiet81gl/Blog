<?php

namespace App\Http\Controllers;

use App\DataTables\AuthorsDataTable;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    protected $postAuthorRepository;

    public function __construct(
        \App\Repositories\PostAuthorRepositoryInterface $postAuthorRepository
    )
    {
        $this->postAuthorRepository = $postAuthorRepository;
    }

    public function index(AuthorsDataTable $dataTable)
    {
        return $dataTable->render('admin.authors.index');

    }

    public function create()
    {
        return view('admin.authors.create');
    }

    public function store(Request $request)
    {
        try {
            $data = $this->handlePostAuthorCategories($request);
            $this->postAuthorRepository->store((array)$data);
            return redirect()->back()->with('success', 'Create author successfully');
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
        $author = $this->postAuthorRepository->get($id);
        if ($author) {
            return view("admin.authors.edit", compact('author'));
        }
        return redirect(route('admin.authors.create'));
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $this->handlePostAuthorCategories($request);
            $this->postAuthorRepository->update($id, (array)$data);
            return redirect()->back()->with('success', 'Update Categories successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->with('validator', $e->errors());
        }
    }

    public function destroy($id)
    {
        //
    }

    protected function handlePostAuthorCategories($request)
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
