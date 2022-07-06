@extends('admin.layout.app')

@section('heading', 'Post Create')
@section('button')
    <a href="{{ route('admin_post_index') }}" class="btn btn-primary"><i class="fas fa-eye"></i> Post
        List</a>

@endsection

@section('main_content')

    <div class="section-body">
        <form action="{{ route('admin_post_store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label>Post Title *</label>
                                <input type="text" class="form-control" name="post_title"
                                    value="{{ old('post_title') }}">
                            </div>
                            <div class="form-group mb-3">
                                <label>Post Detail *</label>
                                <textarea name="post_detail" class="form-control snote" cols="30" rows="10">{{ old('post_detail') }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label>Select Photo</label>
                                <div>
                                    <input type="file" name="post_photo">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Select Category *</label>
                                <select name="sub_category_id" class="form-control" id="">
                                    @foreach ($sub_category as $row)
                                        <option value="{{ $row->id }}">
                                            {{ $row->sub_category_name }} ({{ $row->Category->category_name }})</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Is Sharable?</label>
                                <select name="is_share" class="form-control" id="">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Is Comment?</label>
                                <select name="is_comment" class="form-control" id="">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Tags *</label>
                                <input type="text" value="" class="form-control" name="tags" value="">
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
