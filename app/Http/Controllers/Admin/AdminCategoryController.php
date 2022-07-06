<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $category = Category::orderBy('category_order', 'asc')->get();
        return view('admin.category.index', compact('category'));
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_order' => 'required',
        ], [
            'category_name.required' => 'Tên danh mục không được bỏ trống',
            'category_order.required' => 'Thứ tự danh mục không được bỏ trống',
        ]);
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->status = $request->status;
        $category->category_order = $request->category_order;
        $category->save();

        return redirect()->route('admin_category_index')->with('success', 'Thêm Mới Danh Mục Thành Công');
    }
    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::where('id', $id)->first();
        $request->validate([
            'category_name' => 'required',
            'category_order' => 'required',
        ], [
            'category_name.required' => 'Tên danh mục không được bỏ trống',
            'category_order.required' => 'Thứ tự danh mục không được bỏ trống',
        ]);
        $category->category_name = $request->category_name;
        $category->status = $request->status;
        $category->category_order = $request->category_order;
        $category->update();
        return redirect()->route('admin_category_index')->with('success', 'Cập Nhật Danh Mục Thành Công');
    }
    public function delete($id)
    {
        $category = Category::where('id', $id)->first();
        $category->delete();
        return redirect()->back()->with('success', 'Xóa Danh Mục Thành Công');
    }
}
