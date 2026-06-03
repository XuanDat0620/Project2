@extends('admin.layouts.app')

@section('title','Chi tiết thông tin đơn hàng')
@section('name','Chi tiết thông tin đơn hàng')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.orders.list') }}">Quản lý đơn hàng</a></li>
<li class="breadcrumb-item active">Chi tiết đơn hàng</li>
@endsection

@section('content')

@php
    // TRẠNG THÁI
    $statusText = [
        'pending'   => 'Chờ xác nhận',
        'confirmed' => 'Đã xác nhận',
        'packing'   => 'Đang chuẩn bị hàng',
        'shipping'  => 'Đang giao hàng',
        'delivered' => 'Đã giao',
        'completed' => 'Hoàn thành',
        'cancelled' => 'Đã hủy'
    ];

    $statusClass = [
        'pending'   => 'warning',
        'confirmed' => 'primary',
        'packing'   => 'secondary',
        'shipping'  => 'info',
        'delivered' => 'success',
        'completed' => 'dark',
        'cancelled' => 'danger'
    ];


    $nextStatus = [
        'pending' => [
            'confirmed' => 'Đã xác nhận',
            'cancelled' => 'Đã hủy'
        ],
        'confirmed' => [
            'packing' => 'Đang chuẩn bị hàng',
            'cancelled' => 'Đã hủy'
        ],
        'packing' => [
            'shipping' => 'Đang giao hàng',
            'cancelled' => 'Đã hủy'
        ],
        'shipping' => [
            'delivered' => 'Đã giao',
            'cancelled' => 'Đã hủy'
        ],
        'delivered' => [],
        'completed' => [],
        'cancelled' => []
    ];
    $payment = $order->payment;
@endphp

<div class="container-fluid">
    <div class="row">
        <!-- ORDER -->
        <div class="col-md-6 d-flex">
            <div class="card mb-3 w-100 h-95">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Thông tin đơn hàng</h6>

                    <span class="badge bg-{{ $statusClass[$order->ord_status] }} ms-auto">
                        {{ $statusText[$order->ord_status] }}
                    </span>
                </div>
                <div class="card-body">
                    <p><b>Mã đơn:</b> {{ $order->ord_code }}</p>
                    <p><b>Ngày đặt:</b> {{ $order->ord_buy_date }}</p>
                    <p><b>Ghi chú:</b> {{ $order->ord_note ?? 'Không có' }}</p>
                    <p><b>Phí ship:</b> {{ number_format($order->ord_shipping_fee) }} đ</p>
                    <p>
                        <b>Trạng thái đơn hàng:</b>
                        <form action="{{ route('admin.orders.update', $order->ord_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <select name="ord_status" class="form-select">
                            @if($order->ord_status == 'pending')

                                <option value="pending" selected>
                                    Chờ xác nhận
                                </option>

                                <option value="confirmed">
                                    Đã xác nhận
                                </option>

                                <option value="cancelled">
                                    Đã hủy
                                </option>

                            @elseif($order->ord_status == 'confirmed')

                                <option value="confirmed" selected>
                                    Đã xác nhận
                                </option>

                                <option value="packing">
                                    Đang chuẩn bị hàng
                                </option>

                                <option value="cancelled">
                                    Đã hủy
                                </option>

                            @elseif($order->ord_status == 'packing')

                                <option value="packing" selected>
                                    Đang chuẩn bị hàng
                                </option>

                                <option value="shipping">
                                    Đang giao hàng
                                </option>

                                <option value="cancelled">
                                    Đã hủy
                                </option>

                            @elseif($order->ord_status == 'shipping')

                                <option value="shipping" selected>
                                    Đang giao hàng
                                </option>

                                <option value="delivered">
                                    Đã giao
                                </option>

                                <option value="cancelled">
                                    Đã hủy
                                </option>

                            @elseif($order->ord_status == 'delivered')

                                <option value="delivered" selected>
                                    Đã giao
                                </option>

                            @elseif($order->ord_status == 'completed')

                                <option value="completed" selected>
                                    Hoàn thành
                                </option>

                            @elseif($order->ord_status == 'cancelled')

                                <option value="cancelled" selected>
                                    Đã hủy
                                </option>

                            @endif

                        </select>

                        @if(!in_array($order->ord_status,['completed','cancelled']))
                            <button class="btn btn-primary mt-2">
                                Cập nhật trạng thái
                            </button>
                        @endif
                        </form>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 d-flex">
            <div class="card mb-3 w-100 h-95">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0">Thông tin khách hàng</h6>
                </div>
                <div class="card-body">
                    <p><b>Người nhận:</b> {{ $order->ord_receiver_name }}</p>
                    <p><b>SĐT:</b> {{ $order->ord_receiver_phone }}</p>
                    <p><b>Địa chỉ:</b> {{ $order->ord_receiver_address }}</p>
                    <p><b>Email:</b>{{ $order->customer->cus_email ?? '' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-warning">
            <h6 class="mb-0">Thanh toán</h6>
        </div>
        <div class="card-body py-2">
            <div class="row">
                <div class="col-md-4">
                    <b>Phương thức:</b><br>
                    <span class="text-muted">
                        {{ optional($payment->paymentMethod)->pm_name ?? 'Chưa có' }}
                    </span>
                </div>

                <div class="col-md-4">
                    <b>Trạng thái:</b><br>
                    <span class="text-muted">
                        {{ 
                            $payment && $payment->pay_status == 'paid' ? 'Đã thanh toán' :
                        ($payment && $payment->pay_status == 'failed' ? 'Thất bại' : 'Chưa thanh toán')
                        }}
                    </span>
                </div>

                <div class="col-md-4">
                    <b>Mã GD:</b><br>
                    <span class="text-muted">
                       {{ $payment->pay_transaction_code ?? '-' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-success text-white">
            <h6 class="mb-0">Danh sách sản phẩm</h6>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered text-center mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ảnh</th>
                        <th>Sản phẩm</th>
                        <th>Size</th>
                        <th>Màu</th>
                        <th>SL</th>
                        <th>Giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($order->details as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <img src="{{ $item->variant->product->p_image 
                            ? asset('storage/'.$item->variant->product->p_image) 
                            : asset('dist/assets/img/default-150x150.png') }}" width="60">
                        </td>

                        <td>
                            {{ $item->variant->product->p_name ?? '' }}
                        </td>

                        <td>{{ $item->variant->size->size_name ?? '' }}</td>
                        <td>{{ $item->variant->color->color_name ?? '' }}</td>

                        <td>{{ $item->ord_detail_quantity }}</td>
                        <td>{{ number_format($item->ord_detail_price) }} đ</td>

                        <td>
                            {{ number_format($item->ord_detail_quantity * $item->ord_detail_price) }} đ
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">Không có sản phẩm</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer text-end">
            <h6>Phí ship: {{ number_format($order->ord_shipping_fee) }} đ</h6>
            <h5 class="text-danger">
                Tổng tiền: {{ number_format($order->ord_total_price) }} đ
            </h5>
        </div>
    </div>

</div>

@endsection