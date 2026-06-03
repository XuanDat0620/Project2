@extends('customer.layout.app')
@section('title','Đặt hàng thành công')
@section('name','Đặt hàng thành công')

@section('content')

<section id="section-success">
    <div class="container">
        <div class="success-box text-center">

            <div class="success-icon mb-3">
                <i class="fa-solid fa-circle-check text-success fs-1"></i>
            </div>

            <h2 class="mb-2">Đặt hàng thành công!</h2>
            <p>Cảm ơn bạn đã mua hàng tại shop.</p>
            <p>Chúng tôi sẽ liên hệ và giao hàng sớm nhất.</p>

            <div class="order-info mt-4 text-start mx-auto" style="max-width:400px;">
                <p>
                    <strong>Mã đơn hàng:</strong> 
                    #DH{{ str_pad($order->ord_id, 5, '0', STR_PAD_LEFT) }}
                </p>

                <p>
                    <strong>Khách hàng:</strong> 
                    {{ $order->ord_receiver_name }}
                </p>

                <p>
                    <strong>SĐT:</strong> 
                    {{ $order->ord_receiver_phone }}
                </p>

                <p>
                    <strong>Tổng tiền:</strong> 
                    <span class="text-danger">
                        {{ number_format($order->ord_total_price,0,',','.') }}₫
                    </span>
                </p>
            </div>

            <div class="action mt-4">
                <a href="{{ route('customer.home') }}" class="btn btn-main">
                    Về trang chủ
                </a>

                <a href="{{ route('customer.products') }}" class="btn btn-outline-dark">
                    Tiếp tục mua
                </a>
            </div>

        </div>
    </div>
</section>

@endsection