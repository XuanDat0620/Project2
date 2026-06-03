@extends('admin.layouts.app')

@section('title','Sửa danh mục')
@section('name','Sửa danh mục')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.dashboard') }}">Trang chủ</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('admin.categories.list') }}">Danh sách danh mục</a>
</li>
<li class="breadcrumb-item active">Sửa danh mục</li>
@endsection

@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="card card-primary card-outline mb-4">
                <form method="POST" action="{{ route('admin.categories.update', $category->cate_id) }}">
                @csrf
                @method('PUT')
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tên danh mục</label>
                                <input type="text" name="cate_name" class="form-control"
                                    value="{{ old('cate_name', $category->cate_name) }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mô tả</label>
                                <input type="text" name="cate_desc" class="form-control"
                                    value="{{ old('cate_desc', $category->cate_desc) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Trạng thái</label>
                                <select name="cate_status" class="form-control">
                                    <option value="active"
                                        {{ old('cate_status', $category->cate_status)=='active' ? 'selected' : '' }}>
                                        Hoạt động
                                    </option>
                                    <option value="inactive"
                                        {{ old('cate_status', $category->cate_status)=='inactive' ? 'selected' : '' }}>
                                        Ngưng hoạt động
                                    </option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <a href="{{ route('admin.categories.list') }}" class="btn btn-secondary">Hủy</a>
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection