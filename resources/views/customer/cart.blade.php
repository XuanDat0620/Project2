@extends('customer.layout.app')
@section('title','Giỏ hàng')
@section('name','Giỏ hàng')

@section('content')
<section class="cart-header text-center">
    <div class="container">
        <h2 class="section-title">GIỎ HÀNG CỦA BẠN</h2>
    </div>
</section>
<section id="cart-page">
    <div class="container cart-container">
        <!-- Box giỏ hàng -->
        <div class="cart-box">
            <table class="table align-middle text-center">
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                @php $total = 0; @endphp

                @foreach($cartItems as $item)
                @php
                    $subtotal = $item['variant']->pv_price * $item['quantity'];
                    $total += $subtotal;
                @endphp

                <tr>
                    <td>
                        <img src="{{ asset('storage/' . ($item['variant']->pv_image ?? $item['product']->p_image)) }}" width="60">
                    </td>

                    <td class="text-start">
                        <strong>{{ $item['product']->p_name }}</strong><br>
                        <small>
                            Size: {{ $item['variant']->size->size_name }},
                            Màu: {{ $item['variant']->color->color_name }}
                        </small>
                    </td>

                    <td>{{ number_format($item['variant']->pv_price,0,',','.') }}₫</td>

                    <td>
                        <form action="{{ route('customer.cart.update') }}" method="POST">
                            @csrf

                            <input type="hidden" name="key" value="{{ $item['product']->p_id }}_{{ $item['variant']->size_id }}_{{ $item['variant']->color_id }}">

                            <input 
                                type="number" 
                                name="quantity"
                                value="{{ $item['quantity'] }}" 
                                min="1" 
                                class="form-control"
                                onchange="this.form.submit()"
                            >
                        </form>
                    </td>

                    <td>{{ number_format($subtotal,0,',','.') }}₫</td>

                    <td>
                        <form action="{{ route('customer.cart.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="key" value="{{ $item['product']->p_id }}_{{ $item['variant']->size_id }}_{{ $item['variant']->color_id }}">
                            <button class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="d-flex justify-content-end align-items-center gap-3">
                                <h5 class="mb-0">
                                    Tổng cộng:
                                    <span class="text-danger">{{ number_format($total,0,',','.') }}₫</span>
                                </h5>
                                @php
                                    $customer = session('customer');
                                @endphp

                                @if($customer)
                                    <a href="{{ route('customer.checkout') }}" class="btn btn-main">
                                        Thanh toán
                                    </a>
                                @else
                                    <a href="{{ route('customer.login') }}" class="btn btn-main">
                                        Đăng nhập để thanh toán
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</section>

@endsection