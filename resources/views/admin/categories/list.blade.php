@extends('admin.layouts.app')

@section('title','Quản lý danh mục')
@section('name','Quản lý danh mục')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
<li class="breadcrumb-item active">Quản lý danh mục</li>
@endsection

@section('content')

<div class="app-content">
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Danh sách danh mục</h3>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary ms-auto">
                    <i class="fa-solid fa-plus"></i> Thêm danh mục
                </a>
            </div>

            <div class="card-body p-3">
                <!-- Filter -->
                <form method="GET" class="mb-3">
                    <div class="row g-2">
                        <div class="col-md-5">
                            <input type="text" name="keyword" class="form-control"placeholder="Tìm theo tên danh mục ">
                        </div>
                        <div class="col-md-5">
                            <select name="cate_status" class="form-control">
                                <option value="">-- Trạng thái --</option>
                                <option value="active">Hoạt động</option>
                                <option value="inactive">Ngưng hoạt động</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary w-100">
                                <i class="fa fa-filter"></i> Lọc
                            </button>
                        </div>
                    </div>
                </form>
                <!-- Table -->
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                    <tr>
                      <th style="width:60px">#</th>
                      <th>Tên danh mục</th>
                      <th>Mô tả</th>
                      <th>Trạng thái</th>
                      <th style="width:140px">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $cate)
                        <tr>
                            <td>{{ $cate->cate_id }}</td>
                            <td>{{ $cate->cate_name }}</td>
                            <td>{{ $cate->cate_desc }}</td>
                            <td>
                                @if($cate->cate_status == 'active')
                                    <span class="badge bg-success">Hoạt động</span>
                                @else
                                    <span class="badge bg-danger">Ngưng hoạt động</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.categories.detail', $cate->cate_id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.categories.edit', $cate->cate_id) }}"
                                class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen text-white"></i>
                                </a>
                                <form action="{{ route('admin.categories.delete', $cate->cate_id) }}"
                                    method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $categories->links() }}
                </div>
            </div>
    </div>
</div>

@endsection