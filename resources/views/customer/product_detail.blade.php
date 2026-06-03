@extends('customer.layout.app')
@section('title', $product->p_name)
@section('name', $product->p_name)

@section('content')

@php
    $variant = $product->variants->first();
@endphp

<section id="product-detail-page-1">
  <div class="container">
    <div class="row">

      <!-- ẢNH -->
      <div class="col-lg-6">
        <img 
            src="{{ asset('storage/' . ($variant->pv_image ?? $product->p_image)) }}" 
            class="main-product-img w-100"
        >
      </div>

      <!-- THÔNG TIN -->
      <div class="col-lg-6">

        <h2>{{ $product->p_name }}</h2>

        <p class="text-muted">
            {{ $variant ? number_format($variant->pv_price,0,',','.') : 0 }}₫
        </p>

        <!-- FORM -->
        <form action="{{ route('customer.cart.add') }}" method="POST">
        @csrf

        <input type="hidden" name="product_id" value="{{ $product->p_id }}">

        <!-- SIZE -->
        <div class="mb-3">
            <label>Size:</label>
            <select name="size_id" class="form-control">
                @foreach($product->variants->unique('size_id') as $v)
                    <option value="{{ $v->size->size_id }}">
                        {{ $v->size->size_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- COLOR -->
        <div class="mb-3">
            <label>Color:</label>
            <select name="color_id" class="form-control">
                @foreach($product->variants->unique('color_id') as $v)
                    <option value="{{ $v->color->color_id }}">
                        {{ $v->color->color_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- SỐ LƯỢNG -->
        <div class="mb-3">
            <label>Số lượng:</label>
            <input type="number" name="quantity" value="1" min="1" class="form-control w-50">
        </div>

        <!-- BUTTON -->
        <div class="mt-3">
            <button name="action" value="buy_now" class="btn btn-danger">
                Mua ngay
            </button>

            <button name="action" value="add_to_cart" class="btn btn-outline-secondary ms-2">
                Thêm vào giỏ hàng
            </button>
        </div>

        </form>

      </div>
    </div>

    <!-- MÔ TẢ -->
    <div class="mt-5">
        <h4>CHI TIẾT</h4>
        <p>{{ $product->p_desc }}</p>
    </div>

  </div>
</section>

<!-- SẢN PHẨM TƯƠNG TỰ -->
<section id="product-detail-page-2">
  <div class="container">
    <h4 class="text-center">SẢN PHẨM TƯƠNG TỰ</h4>

    <div class="row mt-3">
        @foreach($relatedProducts as $item)
            @php $v = $item->variants->first(); @endphp

            <div class="col-6 col-md-3 text-center">
                <div class="bg-gray">
                    <a href="{{ route('customer.product.detail', $item->p_id) }}">
                        <img src="{{ asset('storage/' . ($v->pv_image ?? $item->p_image)) }}" class="w-100">
                    </a>
                </div>

                <h5>
                    <a href="{{ route('customer.product.detail', $item->p_id) }}">
                        {{ $item->p_name }}
                    </a>
                </h5>

                <span>
                    {{ number_format($v->pv_price ?? 0,0,',','.') }}₫
                </span>
            </div>
        @endforeach
    </div>
  </div>
</section>

@endsection