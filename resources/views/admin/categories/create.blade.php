@extends('admin.layouts.app')

@section('title','Thêm danh mục')
@section('name','Thêm danh mục')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.dashboard') }}">Trang chủ</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('admin.categories.list') }}">Danh sách danh mục</a>
</li>
<li class="breadcrumb-item active">Thêm danh mục</li>
@endsection

@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="card card-primary card-outline mb-4">
                <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tên danh mục</label>
                        <input type="text" name="cate_name" class="form-control" >
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mô tả</label>
                        <input type="text" name="cate_desc" class="form-control" >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select name="cate_status" class="form-control">
                            <option value="active">Hoạt động</option>
                            <option value="inactive">Ngưng hoạt động</option>
                        </select>
                    </div>
                </div>
                <div class="text-end">
                    <a href="{{ route('admin.categories.list') }}" class="btn btn-secondary">Hủy</a>
                    <button type="submit" class="btn btn-success">Lưu danh mục</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection