@extends('customer.layout.app')
@section('title','Lịch sử mua hàng')
@section('name','Lịch sử mua hàng')

@section('content')

<section id="order-card" class="py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="history-title">Lịch sử mua hàng</h2>
            </div>
            <div class="history-wrapper">
                <div class="table-responsive">
                    <table class="table history-table align-middle">
                        <thead>
                            <tr>
                                <th>Mã đơn</th>
                                <th>Ngày đặt</th>
                                <th>Sản phẩm</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>

                        @forelse($orders as $order)

                        <tr>

                            <td>
                                {{ $order->ord_code }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($order->ord_buy_date)->format('d/m/Y') }}
                            </td>

                            <td>

                                @php
                                    $firstItem = $order->details->first();
                                    $productCount = $order->details->count();
                                @endphp

                                @if($firstItem)

                                <div class="product-mini">

                                    <img
                                        src="{{ asset('storage/'.$firstItem->variant->pv_image) }}"
                                        alt="{{ $firstItem->variant->product->p_name }}"
                                    >

                                    <div>

                                        <p class="mb-1 fw-semibold">
                                            {{ $firstItem->variant->product->p_name }}
                                        </p>

                                        <small>
                                            {{ $productCount }} sản phẩm
                                        </small>

                                    </div>

                                </div>

                                @endif

                            </td>

                            <td class="fw-bold text-danger">
                                {{ number_format($order->ord_total_price,0,',','.') }}₫
                            </td>

                            <td>

                                @if($order->ord_status == 'pending')

                                    <span class="status-badge pending">
                                        Chờ xác nhận
                                    </span>

                                @elseif($order->ord_status == 'shipping')

                                    <span class="status-badge shipping">
                                        Đang giao
                                    </span>

                                @elseif($order->ord_status == 'completed')

                                    <span class="status-badge completed">
                                        Hoàn thành
                                    </span>

                                @elseif($order->ord_status == 'cancelled')

                                    <span class="status-badge cancelled">
                                        Đã hủy
                                    </span>

                                @endif

                            </td>

                            <td class="text-center">

                                <a href="{{ route('customer.orders.detail',$order->ord_id) }}"
                                class="btn-detail">
                                    Xem
                                </a>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="6" class="text-center py-4">
                                Chưa có đơn hàng nào
                            </td>
                        </tr>

                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection