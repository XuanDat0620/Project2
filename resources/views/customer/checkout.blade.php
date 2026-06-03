@extends('customer.layout.app')
@section('title','Thanh toán')
@section('name','Thanh toán')

@section('content')

<section id="payment-page" class="py-5">
    <div class="container">
        <div class="row g-4">

            <!-- LEFT: FORM -->
            <div class="col-lg-7">
                <div class="card shadow-sm p-4">

                    <h4 class="mb-4 fw-bold">Thông tin giao hàng</h4>

                    @php $customer = session('customer'); @endphp

                    <form id="checkout-form" action="{{ route('customer.checkout.process') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label>Họ và tên</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ $customer->cus_name ?? '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Số điện thoại</label>
                            <input type="text" name="phone" class="form-control"
                                value="{{ $customer->cus_phone ?? '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Địa chỉ</label>
                            <textarea name="address" class="form-control" required>{{ $customer->cus_address ?? '' }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label>Ghi chú</label>
                            <textarea name="note" class="form-control"></textarea>
                        </div>

                        <h5 class="mt-4 mb-3 fw-bold">Phương thức thanh toán</h5>

                        <div class="form-check payment-box mb-2">
                            <input type="radio" name="payment" value="cod" checked>
                            <label>Thanh toán khi nhận hàng (COD)</label>
                        </div>

                        <div class="form-check payment-box">
                            <input type="radio" name="payment" value="bank">
                            <label>Chuyển khoản ngân hàng / Ví điện tử</label>

                            <div class="bank-list mt-2 ms-4">
                                <img src="{{ asset('images/vietcombank.png') }}" height="30">
                                <img src="{{ asset('images/mbbank.png') }}" height="30">
                                <img src="{{ asset('images/momo.png') }}" height="30">
                            </div>
                        </div>

                    </form>

                </div>
            </div>

            <!-- RIGHT: ĐƠN HÀNG -->
            <div class="col-lg-5">
                <div class="card shadow-sm p-4">

                    <h4 class="fw-bold mb-3">Đơn hàng của bạn</h4>

                    @foreach($cartItems as $item)
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <strong>
                                {{ $item['product']->p_name }}
                                <span class="text-muted">x{{ $item['quantity'] }}</span>
                            </strong>
                        </div>
                        <div>
                            {{ number_format($item['subtotal'],0,',','.') }}₫
                        </div>
                    </div>
                    @endforeach

                    <hr>

                    <div class="d-flex justify-content-between">
                        <strong>Tổng cộng</strong>
                        <strong class="text-danger">
                            {{ number_format($total,0,',','.') }}₫
                        </strong>
                    </div>

                    <!-- BUTTON SUBMIT -->
                    <button type="submit" form="checkout-form" class="btn btn-danger w-100 mt-4 fw-bold">
                        Đặt hàng
                    </button>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection