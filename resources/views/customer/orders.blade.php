@extends('customer.layout.app')
@section('title','Đơn hàng')
@section('name','Đơn hàng')

@section('content')

<section id="orders-page" class="py-5">
    <div class="container">

        <div class="text-center mb-4">
            <h2 class="order-page-title">Chi tiết đơn hàng</h2>
        </div>

        <div class="order-detail-wrapper">

            <!-- HEADER -->
            <div class="order-top">

                <div>
                    <p class="order-code">
                        Mã đơn: {{ $order->ord_code }}
                    </p>
                </div>

                <span class="status-badge {{ $order->ord_status }}">

                    @switch($order->ord_status)

                        @case('pending')
                            Chờ xác nhận
                            @break

                        @case('shipping')
                            Đang giao
                            @break

                        @case('completed')
                            Hoàn thành
                            @break

                        @case('cancelled')
                            Đã hủy
                            @break

                    @endswitch

                </span>

            </div>

            <!-- INFO -->
            <div class="order-info-grid">

                <div class="info-box">

                    <h6>Thông tin nhận hàng</h6>

                    <p>
                        <strong>Người nhận:</strong>
                        {{ $order->ord_receiver_name }}
                    </p>

                    <p>
                        <strong>SĐT:</strong>
                        {{ $order->ord_receiver_phone }}
                    </p>

                    <p>
                        <strong>Địa chỉ:</strong>
                        {{ $order->ord_receiver_address }}
                    </p>

                </div>

                <div class="info-box">

                    <h6>Thông tin đơn hàng</h6>

                    <p>
                        <strong>Ngày đặt:</strong>
                        {{ \Carbon\Carbon::parse($order->ord_buy_date)->format('d/m/Y H:i') }}
                    </p>

                    <p>
                        <strong>Thanh toán:</strong>
                        {{ $order->payment?->paymentMethod?->pm_name ?? 'Chưa có thông tin' }}
                    </p>
                    <p>
                        <strong>Trạng thái thanh toán:</strong>

                        @if($order->payment)

                            @switch($order->payment->pay_status)

                                @case('pending')
                                    Chờ thanh toán
                                    @break

                                @case('paid')
                                    Đã thanh toán
                                    @break

                                @case('failed')
                                    Thanh toán thất bại
                                    @break

                            @endswitch

                        @else

                            Chưa có thông tin

                        @endif
                    </p>

                    <p>
                        <strong>Trạng thái:</strong>

                        @switch($order->ord_status)

                            @case('pending')
                                Chờ xác nhận
                                @break

                            @case('shipping')
                                Đang giao
                                @break

                            @case('completed')
                                Hoàn thành
                                @break

                            @case('cancelled')
                                Đã hủy
                                @break

                        @endswitch

                    </p>

                </div>

            </div>

            <!-- ACTION -->
            <div class="order-actions">

                @if($order->ord_status == 'shipping')

                    <form action="{{ route('orders.complete',$order->ord_id) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <button type="submit" class="btn-main success">
                            Đã nhận hàng
                        </button>

                    </form>

                @endif


                @if($order->ord_status == 'pending')

                    <form action="{{ route('orders.cancel',$order->ord_id) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <button type="submit"
                                class="btn-main danger">
                            Hủy đơn
                        </button>

                    </form>

                @endif

            </div>

            <!-- PRODUCT -->
            <div class="product-list">

                @foreach($order->details as $item)

                    <div class="product-item">

                        <div class="product-left">

                            <img
                                src="{{ asset('storage/' . $item->variant->pv_image) }}"
                                alt="{{ $item->variant->product->p_name }}"
                            >

                        </div>

                        <div class="product-center">

                            <h6>
                                {{ $item->variant->product->p_name }}
                            </h6>

                            <p>
                                Size:
                                {{ $item->variant->size->size_name }}

                                |

                                Màu:
                                {{ $item->variant->color->color_name }}
                            </p>

                            <p>
                                Số lượng:
                                x{{ $item->ord_detail_quantity }}
                            </p>

                        </div>

                        <div class="product-right">

                            {{ number_format($item->ord_detail_price,0,',','.') }}₫

                        </div>

                    </div>

                @endforeach

            </div>

            <!-- TOTAL -->
            <div class="order-total">

                <span>Tổng thanh toán</span>

                <span class="total-price">
                    {{ number_format($order->ord_total_price,0,',','.') }}₫
                </span>

            </div>

        </div>

    </div>
</section>

@endsection