<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class AdminSubCategoryController extends Controller
{
    public function index()
    {
        $subcategory = SubCategory::with('Category')->orderBy('sub_category_order', 'asc')->get();
        return view('admin.subcategory.index', compact('subcategory'));
    }
    public function create(Request $request)
    {
        $categories = Category::get();
        return view('admin.subcategory.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'sub_category_name' => 'required',
            'sub_category_order' => 'required',
        ], [
            'sub_category_name.required' => 'Tên danh mục con không được bỏ trống',
            'sub_category_order.required' => 'Thứ tự danh mục con không được bỏ trống',
        ]);
        $subcategory = new SubCategory();
        $subcategory->sub_category_name = $request->sub_category_name;
        $subcategory->status = $request->status;
        $subcategory->show_on_home = $request->show_on_home;
        $subcategory->sub_category_order = $request->sub_category_order;
        $subcategory->category_id = $request->category_id;
        $subcategory->save();

        return redirect()->route('admin_subcategory_index')->with('success', 'Thêm Mới Danh Mục Con Thành Công');
    }
    public function edit($id)
    {
        $categories = Category::get();
        $subcategory = SubCategory::where('id', $id)->first();
        return view('admin.subcategory.edit', compact('subcategory', 'categories'));
    }
    public function update(Request $request, $id)
    {

        $subcategory = SubCategory::where('id', $id)->first();
        $request->validate([
            'sub_category_name' => 'required',
            'sub_category_order' => 'required',
        ], [
            'sub_category_name.required' => 'Tên danh mục con không được bỏ trống',
            'sub_category_order.required' => 'Thứ tự danh mục con không được bỏ trống',
        ]);
        $subcategory->sub_category_name = $request->sub_category_name;
        $subcategory->status = $request->status;
        $subcategory->show_on_home = $request->show_on_home;
        $subcategory->sub_category_order = $request->sub_category_order;
        $subcategory->category_id = $request->category_id;
        $subcategory->update();

        return redirect()->route('admin_subcategory_index')->with('success', 'Cập Nhật Danh Mục Con Thành Công');
    }
    public function delete($id)
    {
        $subcategory = SubCategory::where('id', $id)->first();
        $subcategory->delete();
        return redirect()->back()->with('success', 'Xóa Danh Mục Con Thành Công');
    }
}
