<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class AdminPostController extends Controller
{
    public function index()
    {
        $post = Post::with('SubCategory.Category')->get();
        return view('admin.post.index', compact('post'));
    }

    public function create()
    {
        $sub_category = SubCategory::with('Category')->get();
        return view('admin.post.create', compact('sub_category'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'post_title' => 'required',
            'post_detail' => 'required',
            'post_photo' => 'required|image|mimes:jpg,jpeg,png,gif'

        ], [
            'post_title.required' => 'Tên bài viết không được bỏ trống',
            'post_detail.required' => 'Nội dung bài viết không được bỏ trống',
            'post_photo.required' => 'Ảnh bài viết không được bỏ trống',
        ]);
        $q = DB::select("SHOW TABLE STATUS LIKE'posts'");
        $ai_id = $q[0]->Auto_increment;

        $now = time();
        $ext = $request->file('post_photo')->extension();
        $file_name = 'post_photo_' . $now . '.' . $ext;
        $request->file('post_photo')->move(public_path('admin/uploads/'), $file_name);

        $post = new Post();
        $post->sub_category_id = $request->sub_category_id;
        $post->post_title = $request->post_title;
        $post->post_detail = $request->post_detail;
        $post->post_photo = $file_name;
        $post->visitors = 1;
        $post->author_id = 0;
        $post->admin_id =  Auth::guard('admin')->user()->id;
        $post->is_share = $request->is_share;
        $post->is_comment = $request->is_comment;
        $post->save();

        if ($request->tags != '') {
            $tags_array_new = [];
            $tags_array = explode(',', $request->tags);
            for ($i = 0; $i < count($tags_array); $i++) {
                $tags_array_new[] = trim($tags_array[$i]);
            }
            $tags_array_new = array_values(array_unique($tags_array_new));
            for ($i = 0; $i < count($tags_array_new); $i++) {
                $tag = new Tag();
                $tag->post_id = $ai_id;
                $tag->tag_name = trim($tags_array_new[$i]);
                $tag->save();
            }
        }

        return redirect()->route('admin_post_index')->with('success', 'Thêm Mới Bài Viết Thành Công');
    }


    public function edit($id)
    {
        $sub_category = SubCategory::with('Category')->get();
        $post = Post::where('id', $id)->first();
        $tags = Tag::where('post_id', $id)->get();
        return view('admin.post.edit', compact('post', 'sub_category', 'tags'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'post_title' => 'required',
            'post_detail' => 'required',

        ], [
            'post_title.required' => 'Tên bài viết không được bỏ trống',
            'post_detail.required' => 'Nội dung bài viết không được bỏ trống',
        ]);
        $post = Post::where('id', $id)->first();

        if ($request->hasFile('post_photo')) {
            $request->validate([
                'post_photo' => 'required|image|mimes:jpg,jpeg,png,gif'
            ]);
            $now = time();
            unlink(public_path('admin/uploads/' . $post->post_photo));
            $ext = $request->file('post_photo')->extension();
            $file_name = 'post_photo_' . $now . '.' . $ext;
            $request->file('post_photo')->move(public_path('admin/uploads/'), $file_name);
            $post->post_photo = $file_name;
        }

        $post->sub_category_id = $request->sub_category_id;
        $post->post_title = $request->post_title;
        $post->post_detail = $request->post_detail;
        $post->visitors = 1;
        $post->author_id = 0;
        $post->admin_id =  Auth::guard('admin')->user()->id;
        $post->is_share = $request->is_share;
        $post->is_comment = $request->is_comment;
        $post->update();

        if ($request->tags != '') {
            $tags_array = explode(',', $request->tags);
            for ($i = 0; $i < count($tags_array); $i++) {
                $total = Tag::where('post_id', $id)->where('tag_name', trim($tags_array[$i]))->count();
                if (!$total) {
                    $tag = new Tag();
                    $tag->post_id = $id;
                    $tag->tag_name = trim($tags_array[$i]);
                    $tag->save();
                }
            }
        }

        return redirect()->route('admin_post_index')->with('success', 'Cập Nhật Danh Mục Thành Công');
    }
    public function TagDelete($id, $id1)
    {
        $tag = Tag::where('id', $id)->first();
        $tag->delete();
        return redirect()->route('admin_post_edit', $id1)->with('success', 'Xóa dữ liệu thành công');
    }
    public function delete($id)
    {
        $test = Post::where('id', $id)->where('admin_id', Auth::guard('admin')->user()->id)->count();
        if (!$test) {
            return redirect()->route('admin_home');
        }

        $post = Post::where('id', $id)->first();
        unlink(public_path('admin/uploads/' . $post->post_photo));
        $post->delete();

        Tag::where('post_id', $id)->delete();

        return redirect()->route('admin_post_index')->with('success', 'Xóa Bài Đăng Thành Công');
    }
}
