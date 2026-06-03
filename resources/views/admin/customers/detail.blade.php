@extends('admin.layouts.app')

@section('title','Chi tiết thông tin khách hàng')
@section('name','Chi tiết thông tin khách hàng')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.dashboard') }}">Trang chủ</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('admin.customers.list') }}">Danh sách khách hàng</a>
</li>
<li class="breadcrumb-item active">Chi tiết thông tin khách hàng</li>
@endsection

@section('content')

<div class="app-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0">

                    <!-- HEADER -->
                    <div class="card-header bg-primary text-white d-flex justify-content-between">
                        <h5 class="mb-0">Thông tin khách hàng</h5>
                    </div>

                    <!-- BODY -->
                    <div class="card-body">
                        <div class="row g-3">

                            <!-- Họ tên -->
                            <div class="col-md-6">
                                <label>Họ tên</label>
                                <input class="form-control" value="{{ $customer->cus_name }}" readonly>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label>Email</label>
                                <input class="form-control" value="{{ $customer->cus_email }}" readonly>
                            </div>

                            <!-- SĐT -->
                            <div class="col-md-6">
                                <label>Số điện thoại</label>
                                <input class="form-control" value="{{ $customer->cus_phone }}" readonly>
                            </div>

                            <!-- Ngày sinh -->
                            <div class="col-md-6">
                                <label>Ngày sinh</label>
                                <input class="form-control" value="{{ $customer->cus_dob }}" readonly>
                            </div>

                            <!-- Giới tính -->
                            <div class="col-md-6">
                                <label>Giới tính</label>
                                <input class="form-control"
                                    value="{{ $customer->cus_gender == 'male' ? 'Nam' : ($customer->cus_gender == 'female' ? 'Nữ' : 'Khác') }}"
                                    readonly>
                            </div>

                            <!-- Trạng thái -->
                            <div class="col-md-6">
                                <label>Trạng thái</label><br>
                                <span class="badge {{ $customer->cus_status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $customer->cus_status == 'active' ? 'Hoạt động' : 'Ngưng hoạt động' }}
                                </span>
                            </div>

                            <!-- Địa chỉ -->
                            <div class="col-12">
                                <label>Địa chỉ</label>
                                <textarea class="form-control" rows="3" readonly>{{ $customer->cus_address }}</textarea>
                            </div>

                        </div>
                    </div>

                    <!-- FOOTER -->
                    <div class="card-footer text-end">
                        <a href="{{ route('admin.customers.list') }}" class="btn btn-secondary">
                            Quay lại
                        </a>

                        <a href="{{ route('admin.customers.edit', $customer->cus_id) }}"
                           class="btn btn-primary">
                            Chỉnh sửa
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection