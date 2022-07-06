@extends('admin.layout.app')

@section('heading', 'SubCategory Create')
@section('button')
    <a href="{{ route('admin_subcategory_index') }}" class="btn btn-primary"><i class="fas fa-eye"></i> Category
        List</a>

@endsection

@section('main_content')

    <div class="section-body">
        <form action="{{ route('admin_subcategory_store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label>Category Name *</label>
                                <select name="category_id" id="" class="form-control">
                                    @foreach ($categories as $row)
                                        <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>SubCategory Name *</label>
                                <input type="text" class="form-control" name="sub_category_name">
                            </div>
                            <div class="form-group mb-3">
                                <label>Status</label>
                                <select name="status" class="form-control" id="">
                                    <option value="Show">Show</option>
                                    <option value="Hide">Hide</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Show on home?</label>
                                <select name="show_on_home" class="form-control" id="">
                                    <option value="Show">Show</option>
                                    <option value="Hide">Hide</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>SubCategory Order *</label>
                                <input type="text" value="" class="form-control" name="sub_category_order" value="">
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
