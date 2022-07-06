@extends('admin.layout.app')

@section('heading', 'Category Edit')
@section('button')
    <a href="{{ route('admin_category_index') }}" class="btn btn-primary"><i class="fas fa-eye"></i> Category
        List</a>

@endsection

@section('main_content')

    <div class="section-body">
        <form action="{{ route('admin_category_update', $category->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label>Category Name *</label>
                                <input type="text" class="form-control" name="category_name"
                                    value="{{ $category->category_name }}">
                            </div>
                            <div class="form-group mb-3">
                                <label>Status</label>
                                <select name="status" class="form-control" id="">
                                    <option value="Show" @if ($category->status == 'Show') selected @endif>Show</option>
                                    <option value="Hide" @if ($category->status == 'Hide') selected @endif>Hide</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Category Order *</label>
                                <input type="text" value="{{ $category->category_order }}" class="form-control"
                                    name="category_order" value="">
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>


@endsection
