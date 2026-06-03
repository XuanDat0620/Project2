@extends('admin.layouts.app')

@section('title','Quản lý sản phẩm')
@section('name','Quản lý sản phẩm')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
<li class="breadcrumb-item active">Quản lý sản phẩm</li>
@endsection

@section('content')

<div class="app-content">
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Danh sách sản phẩm</h3>
                <a href="{{ route('admin.products.create') }}" class="btn btn-success ms-auto">
                    <i class="fa-solid fa-plus"></i> Thêm sản phẩm
                </a>
            </div>
            <div class="card-body p-3">
                <!-- Filter -->
                <form method="GET" class="mb-3">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <input type="text" name="keyword" class="form-control"placeholder="Tìm theo tên sản phẩm">
                        </div>
                        <div class="col-md-3">
                            <select name="category" class="form-control">
                                <option value="">-- Danh mục --</option>
                                @foreach($categories as $cate)
                                    <option value="{{ $cate->cate_id }}"
                                        {{ request('category') == $cate->cate_id ? 'selected' : '' }}>
                                        {{ $cate->cate_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="p_status" class="form-control">
                                <option value="">-- Trạng thái --</option>
                                <option value="active">Hiển thị</option>
                                <option value="inactive">Ẩn</option>
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
                        <th>#</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->p_id }}</td>
                        <td>
                            <img src="{{ $product->p_image ? asset('storage/'.$product->p_image) : asset('dist/assets/img/default-150x150.png') }}"
                                width="60">
                        </td>
                        <td>{{ $product->p_name }}</td>
                        <td>{{ $product->category->cate_name ?? '' }}</td>
                        <td>
                            @if($product->variants->count())
                                {{ number_format($product->variants->first()->pv_price) }} VNĐ
                            @else
                                0 VNĐ
                            @endif
                        </td>
                        <td>
                            @if($product->p_status == 'active')
                                <span class="badge bg-success">Hiển thị</span>
                            @else
                                <span class="badge bg-danger">Ẩn</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('admin.products.detail',$product->p_id) }}" class="btn btn-primary btn-sm">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.products.edit',$product->p_id) }}" class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen text-white"></i>
                            </a>

                            <form action="{{ route('admin.products.delete',$product->p_id) }}" method="POST" style="display:inline;">
                                @csrf
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
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection