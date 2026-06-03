@extends('admin.layouts.app')

@section('title','Chi tiết danh mục')
@section('name','Chi tiết danh mục')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.dashboard') }}">Trang chủ</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('admin.categories.list') }}">Danh sách danh mục</a>
</li>
<li class="breadcrumb-item active">Chi tiết danh mục</li>
@endsection

@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card shadow-sm border-0 rounded-3">
                    
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Thông tin danh mục</h5>
                    </div>

                    <div class="card-body">
                        <div class="row g-3">

                            <!-- Tên -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tên danh mục</label>
                                <input type="text" class="form-control bg-light"
                                       value="{{ $category->cate_name }}" readonly>
                            </div>

                            <!-- Trạng thái -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Trạng thái</label>
                                <input type="text" class="form-control bg-light"
                                       value="{{ $category->cate_status == 'active' ? 'Hoạt động' : 'Ngưng hoạt động' }}"
                                       readonly>
                            </div>

                            <!-- Mô tả -->
                            <div class="col-12">
                                <label class="form-label fw-bold">Mô tả</label>
                                <textarea class="form-control bg-light" rows="3" readonly>{{ $category->cate_desc }}</textarea>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <a href="{{ route('admin.categories.list') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Quay lại
                        </a>

                        <a href="{{ route('admin.categories.edit', $category->cate_id) }}" 
                           class="btn btn-primary">
                            <i class="fa-solid fa-pen"></i> Chỉnh sửa
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection