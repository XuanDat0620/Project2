@extends('admin.layouts.app')

@section('title','Chi tiết sản phẩm')
@section('name','Chi tiết sản phẩm')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.products.list') }}">Quản lý sản phẩm</a></li>
<li class="breadcrumb-item active">Chi tiết sản phẩm</li>
@endsection

@section('content')

<div class="app-content">
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-body">
            <div class="row">
                <!-- LEFT: IMAGE -->
                <div class="col-md-4 text-center">
                    <img 
                        src="{{ $product->p_image ? asset('storage/'.$product->p_image) : asset('dist/assets/img/default-150x150.png') }}" 
                        class="img-fluid rounded border"
                        style="max-height:250px"
                    >
                </div>
                <!-- RIGHT: INFO -->
                <div class="col-md-8">
                    <h4 class="mb-3 fw-bold">{{ $product->p_name }}</h4>
                    <table class="table table-borderless">
                        <tr>
                            <th width="150">Danh mục:</th>
                            <td>{{ $product->category->cate_name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>Thương hiệu:</th>
                            <td>{{ $product->brand->brand_name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>Trạng thái:</th>
                            <td>
                                @if($product->p_status == 'active')
                                    <span class="badge bg-success">Hiển thị</span>
                                @else
                                    <span class="badge bg-danger">Ẩn</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Mô tả:</th>
                            <td>{{ $product->p_desc }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <hr>
            <!-- VARIANTS -->
            <h5 class="mb-3">Danh sách biến thể</h5>
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Size</th>
                        <th>Màu</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tình trạng tồn kho</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($product->variants as $index => $variant)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $variant->size->size_name ?? '' }}</td>
                        <td>{{ $variant->color->color_name ?? '' }}</td>
                        <td>{{ number_format($variant->pv_price) }} VNĐ</td>
                        <td>{{ $variant->pv_stock }}</td>
                        <td>
                            @if($variant->pv_stock == 0)
                                <span class="badge bg-danger">Hết hàng</span>
                            @elseif($variant->pv_stock < 5)
                                <span class="badge bg-warning">Sắp hết</span>
                            @else
                                <span class="badge bg-success">Còn hàng</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">Chưa có biến thể</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="text-end">
                <a href="{{ route('admin.products.list') }}" class="btn btn-secondary">
                    Quay lại
                </a>
                <a href="{{ route('admin.products.edit', $product->p_id) }}" class="btn btn-primary">
                    Chỉnh sửa
                </a>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection