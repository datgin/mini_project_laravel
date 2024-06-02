<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    protected $PATH_VIEW = 'admin.category.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Category::all();

        return view($this->PATH_VIEW . __FUNCTION__, compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view($this->PATH_VIEW . __FUNCTION__, compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->input('parent_id'));

        $request->validate([
            'name' => [
                'required',
                Rule::unique('categories')->where(function ($query) use ($request) {
                    return $query->where('parent_id', $request->input('parent_id'));
                })
            ],
            'slug' => [
                'required',
                Rule::unique('categories')->where(function ($query) use ($request) {
                    return $query->where('parent_id', $request->input('parent_id'));
                })
            ],
        ]);

        $data = $request->only('name', 'slug', 'parent_id', 'status');

        $data['status'] = isset($data['status']) ? 1 : 0;
        Category::create($data);

        return redirect()->route('category.index')->with('success', 'Thêm danh mục thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::all();
        return view($this->PATH_VIEW . __FUNCTION__, compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('categories')->where(function ($query) use ($request, $id) {
                    return $query->where('parent_id', $request->input('parent_id'))->where('id', '!=', $id);
                })
            ],
            'slug' => [
                'required',
                Rule::unique('categories')->where(function ($query) use ($request, $id) {
                    return $query->where('parent_id', $request->input('parent_id'))->where('id', '!=', $id);
                })
            ],
        ]);

        $data = $request->only('name', 'slug', 'parent_id', 'status');

        $data['status'] = isset($data['status']) ? 1 : 0;

        Category::where('id', $id)->update($data);

        return redirect()->route('category.index')->with('success', 'Cập nhật danh mục thành công');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::destroy($id);
        return redirect()->route('category.index')->with('success', 'Xóa danh mục thành công');
    }
}
