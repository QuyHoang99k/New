@extends('admin.layout.app')

@section('heading', 'SubCategory Edit')
@section('button')
    <a href="{{ route('admin_subcategory_index') }}" class="btn btn-primary"><i class="fas fa-eye"></i> SubCategory
        List</a>

@endsection

@section('main_content')

    <div class="section-body">
        <form action="{{ route('admin_subcategory_update', $subcategory->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label>Category Name *</label>
                                <select name="category_id" id="" class="form-control">
                                    @foreach ($categories as $row)
                                        <option value="{{ $row->id }}"
                                            @if ($subcategory->category_id == $row->id) selected @endif>{{ $row->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>SubCategory Name *</label>
                                <input type="text" class="form-control" name="sub_category_name"
                                    value="{{ $subcategory->sub_category_name }}">
                            </div>
                            <div class="form-group mb-3">
                                <label>Status</label>
                                <select name="status" class="form-control" id="">
                                    <option value="Show" @if ($subcategory->status == 'Show') selected @endif>Show</option>
                                    <option value="Hide" @if ($subcategory->status == 'Hide') selected @endif>Hide</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Show on home? </label>
                                <select name="show_on_home" class="form-control" id="">
                                    <option value="Show" @if ($subcategory->show_on_home == 'Show') selected @endif>Show</option>
                                    <option value="Hide" @if ($subcategory->show_on_home == 'Hide') selected @endif>Hide</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>SubCategory Order *</label>
                                <input type="text" value="{{ $subcategory->sub_category_order }}" class="form-control"
                                    name="sub_category_order" value="">
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
