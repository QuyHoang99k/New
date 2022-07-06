@extends('admin.layout.app')

@section('heading', 'Edit Post')
@section('button')
    <a href="{{ route('admin_post_index') }}" class="btn btn-primary"><i class="fas fa-eye"></i> Post
        List</a>

@endsection

@section('main_content')

    <div class="section-body">
        <form action="{{ route('admin_post_update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label>Post Title *</label>
                                <input type="text" class="form-control" name="post_title"
                                    value="{{ $post->post_title }}">
                            </div>
                            <div class="form-group mb-3">
                                <label>Post Detail *</label>
                                <textarea name="post_detail" class="form-control snote" cols="30" rows="10">
                                    {{ $post->post_detail }}
                                </textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label>Change Photo</label>
                                <div>
                                    <input type="file" name="post_photo" style="margin-bottom: 5px">
                                </div>
                                <div>
                                    <img src="{{ asset('admin/uploads/' . $post->post_photo) }}" alt=""
                                        style="width: 300px;">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label>Select Category *</label>
                                <select name="sub_category_id" class="form-control" id="">
                                    @foreach ($sub_category as $row)
                                        <option value="{{ $row->id }}"
                                            @if ($row->id == $post->sub_category_id) selected @endif>
                                            {{ $row->sub_category_name }} ({{ $row->Category->category_name }})</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Is Sharable?</label>
                                <select name="is_share" class="form-control" id="">
                                    <option value="1" @if ($post->is_share == 1) selected @endif>Yes</option>
                                    <option value="0" @if ($post->is_share == 0) selected @endif>No</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Is Comment?</label>
                                <select name="is_comment" class="form-control" id="">
                                    <option value="1" @if ($post->is_comment == 1) selected @endif>Yes</option>
                                    <option value="0" @if ($post->is_comment == 0) selected @endif>No</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Existing Tags *</label>
                                <table class="table table-bordered">
                                    @foreach ($tags as $tag)
                                        <tr>

                                            <td>
                                                {{ $tag->tag_name }}
                                            </td>
                                            <td><a href="{{ route('admin_post_delete_tag', [$tag->id, $post->id]) }}"
                                                    onclick="return confirm('Bạn có chắc muốn xóa dữ liệu này')">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="form-group mb-3">
                                <label>News Tags *</label>
                                <input type="text" class="form-control" name="tags">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>


@endsection
