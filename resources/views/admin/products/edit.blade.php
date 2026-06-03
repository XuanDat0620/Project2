@extends('admin.layouts.app')

@section('title','Sửa thông tin sản phẩm')
@section('name','Sửa thông tin sản phẩm')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.products.list') }}">Quản lý sản phẩm</a></li>
<li class="breadcrumb-item active">Sửa thông tin sản phẩm</li>
@endsection

@section('content')

<div class="app-content">
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-body p-3">

                <form method="POST" action="{{ route('admin.products.update', $product->p_id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    <!-- Tên -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tên sản phẩm</label>
                        <input type="text" name="p_name" class="form-control"
                               value="{{ old('p_name', $product->p_name) }}">
                    </div>

                    <!-- Danh mục -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Danh mục</label>
                        <select name="cate_id" class="form-control">
                            @foreach($categories as $cate)
                                <option value="{{ $cate->cate_id }}"
                                    {{ $product->cate_id == $cate->cate_id ? 'selected' : '' }}>
                                    {{ $cate->cate_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Brand -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Thương hiệu</label>
                        <select name="brand_id" class="form-control">
                            @foreach($brands as $brand)
                                <option value="{{ $brand->brand_id }}"
                                    {{ $product->brand_id == $brand->brand_id ? 'selected' : '' }}>
                                    {{ $brand->brand_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Ảnh -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Hình ảnh</label>
                        <input type="file" name="p_image" class="form-control">

                        <div class="mt-2">
                            <img src="{{ $product->p_image ? asset('storage/'.$product->p_image) : asset('dist/assets/img/default-150x150.png') }}"
                                 width="80">
                        </div>
                    </div>

                    <!-- Trạng thái -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select name="p_status" class="form-control">
                            <option value="active" {{ $product->p_status == 'active' ? 'selected' : '' }}>Hiển thị</option>
                            <option value="inactive" {{ $product->p_status == 'inactive' ? 'selected' : '' }}>Ẩn</option>
                        </select>
                    </div>

                    <!-- Mô tả -->
                    <div class="col-12 mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea name="p_desc" class="form-control" rows="4">{{ $product->p_desc }}</textarea>
                    </div>

                </div>

                <hr>

                <!--  VARIANTS -->
                <h5>Biến thể sản phẩm</h5>

                @foreach($product->variants as $index => $variant)
                <div class="row mb-2">

                    <!-- Size -->
                    <div class="col-md-3">
                        <select name="variants[{{ $index }}][size_id]" class="form-control">
                            @foreach($sizes as $size)
                                <option value="{{ $size->size_id }}"
                                    {{ $variant->size_id == $size->size_id ? 'selected' : '' }}>
                                    {{ $size->size_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Color -->
                    <div class="col-md-3">
                        <select name="variants[{{ $index }}][color_id]" class="form-control">
                            @foreach($colors as $color)
                                <option value="{{ $color->color_id }}"
                                    {{ $variant->color_id == $color->color_id ? 'selected' : '' }}>
                                    {{ $color->color_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Price -->
                    <div class="col-md-3">
                        <input type="number" name="variants[{{ $index }}][pv_price]"
                               value="{{ $variant->pv_price }}" class="form-control">
                    </div>

                    <!-- Stock -->
                    <div class="col-md-3">
                        <input type="number" name="variants[{{ $index }}][pv_stock]"
                               value="{{ $variant->pv_stock }}" class="form-control">
                    </div>

                </div>
                @endforeach

                <div class="text-end">
                    <a href="{{ route('admin.products.list') }}" class="btn btn-secondary">Hủy</a>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection