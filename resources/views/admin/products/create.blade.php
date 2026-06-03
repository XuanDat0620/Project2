@extends('admin.layouts.app')

@section('title','Thêm sản phẩm')
@section('name','Thêm sản phẩm')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Trang chủ</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.products.list') }}">Quản lý sản phẩm</a>
    </li>
    <li class="breadcrumb-item active">Thêm sản phẩm</li>
@endsection

@section('content')

    <div class="app-content">
        <div class="container-fluid">

            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- ================= THÔNG TIN SẢN PHẨM ================= -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Thông tin sản phẩm</h5>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <!-- Tên -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tên sản phẩm</label>
                                <input type="text" name="p_name" class="form-control" value="{{ old('p_name') }}">
                            </div>

                            <!-- Danh mục -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Danh mục</label>
                                <select name="cate_id" class="form-control">
                                    <option value="">Chọn danh mục</option>
                                    @foreach($categories as $cate)
                                        <option value="{{ $cate->cate_id }}">
                                            {{ $cate->cate_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Brand -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Thương hiệu</label>
                                <select name="brand_id" class="form-control">
                                    <option value="">Chọn brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->brand_id }}">
                                            {{ $brand->brand_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Ảnh -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Hình ảnh</label>
                                <input type="file" name="p_image" class="form-control">
                            </div>

                            <!-- Trạng thái -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Trạng thái</label>
                                <select name="p_status" class="form-control">
                                    <option value="active">Hiển thị</option>
                                    <option value="inactive">Ẩn</option>
                                </select>
                            </div>

                            <!-- Mô tả -->
                            <div class="col-12 mb-3">
                                <label class="form-label">Mô tả</label>
                                <textarea name="p_desc" class="form-control" rows="4">{{ old('p_desc') }}</textarea>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- ================= BIẾN THỂ ================= -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Biến thể sản phẩm</h5>
                    </div>

                    <div class="card-body">

                        <div id="variants">

                            <div class="row mb-3">

                                <!-- Size -->
                                <div class="col-md-3">
                                    <label>Size</label>
                                    <select name="variants[0][size_id]" class="form-control">
                                        @foreach($sizes as $size)
                                            <option value="{{ $size->size_id }}">
                                                {{ $size->size_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Color -->
                                <div class="col-md-3">
                                    <label>Màu</label>
                                    <select name="variants[0][color_id]" class="form-control">
                                        @foreach($colors as $color)
                                            <option value="{{ $color->color_id }}">
                                                {{ $color->color_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Giá -->
                                <div class="col-md-3">
                                    <label>Giá</label>
                                    <input type="number" name="variants[0][price]" class="form-control">
                                </div>

                                <!-- Kho -->
                                <div class="col-md-3">
                                    <label>Số lượng</label>
                                    <input type="number" name="variants[0][stock]" class="form-control">
                                </div>

                            </div>

                        </div>

                        <!-- Nút thêm biến thể -->
                        <button type="button" class="btn btn-outline-primary" onclick="addVariant()">
                            + Thêm biến thể
                        </button>

                    </div>
                </div>

                <!-- ================= BUTTON ================= -->
                <div class="text-end">
                    <a href="{{ route('admin.products.list') }}" class="btn btn-secondary">
                        Hủy
                    </a>
                    <button type="submit" class="btn btn-success">
                        Lưu sản phẩm
                    </button>
                </div>

            </form>

        </div>
    </div>

@endsection

<!-- ================= SCRIPT ADD VARIANT ================= -->
<script>
    let index = 1;

    function addVariant() {
        let html = `
        <div class="row mb-3">
            <div class="col-md-3">
                <select name="variants[${index}][size_id]" class="form-control">
                    @foreach($sizes as $size)
                        <option value="{{ $size->size_id }}">{{ $size->size_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select name="variants[${index}][color_id]" class="form-control">
                    @foreach($colors as $color)
                        <option value="{{ $color->color_id }}">{{ $color->color_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <input type="number" name="variants[${index}][price]" class="form-control" placeholder="Giá">
            </div>

            <div class="col-md-3">
                <input type="number" name="variants[${index}][stock]" class="form-control" placeholder="Kho">
            </div>
        </div>
        `;

        document.getElementById('variants').insertAdjacentHTML('beforeend', html);
        index++;
    }
</script>