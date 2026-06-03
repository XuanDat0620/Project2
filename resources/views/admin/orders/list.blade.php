@extends('admin.layouts.app')

@section('title','Quản ý đơn hàng')
@section('name','Quản lý đơn hàng')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
<li class="breadcrumb-item active">Quản lý đơn hàng</li>
@endsection

@section('content')

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Danh sách đơn hàng</h3>
                </div>
                <div class="card-body p-3">
                    <!-- Bộ lọc -->
                    <form method="GET" class="mb-3">
                        <div class="row g-2 align-items-center">

                            <div class="col-md-3">
                                <input type="text" name="keyword" class="form-control"
                                       placeholder="Tìm theo người nhận hoặc SĐT">
                            </div>
                            <div class="col-md-2">
                                <input type="date" name="date_from" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <input type="date" name="date_to" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <select name="status" class="form-control">
                                    <option value="">-- Trạng thái --</option>
                                    <option value="pending">Chờ xác nhận</option>
                                    <option value="confirmed">Đã xác nhận</option>
                                    <option value="packing">Đang chuẩn bị hàng</option>
                                    <option value="shipping"> Đang giao hàng</option>
                                    <option value="delivered">Đã giao</option>
                                    <option value="completed"> Hoàn thành</option>
                                    <option value="cancelled">Đã hủy</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary w-100">
                                    <i class="fa fa-filter"></i> Lọc
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- Table -->
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Người nhận</th>
                                <th>SĐT</th>
                                <th>Địa chỉ</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->ord_id }}</td>
                                <td>{{ $order->ord_receiver_name }}</td>
                                <td>{{ $order->ord_receiver_phone }}</td>
                                <td>{{ $order->ord_receiver_address }}</td>
                                <td>{{ number_format($order->ord_total_price) }} VNĐ</td>
                                <td>
                                    @switch($order->ord_status)
                                        @case('pending')
                                            <span class="badge bg-warning">Chờ xác nhận</span>
                                            @break
                                        @case('confirmed')
                                            <span class="badge bg-primary">Đã xác nhận</span>
                                            @break
                                        @case('packing')
                                            <span class="badge bg-secondary">Đang chuẩn bị hàng</span>
                                            @break
                                        @case('shipping')
                                            <span class="badge bg-info">Đang giao hàng</span>
                                            @break
                                        @case('delivered')
                                            <span class="badge bg-success">Đã giao</span>
                                            @break
                                        @case('completed')
                                            <span class="badge bg-dark">Hoàn thành</span>
                                            @break
                                        @case('cancelled')
                                            <span class="badge bg-danger">Đã hủy</span>
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{ route('admin.orders.detail', $order->ord_id) }}" class="btn btn-primary btn-sm">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection