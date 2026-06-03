@extends('admin.layouts.app')

@section('title','Quản lý khách hàng')
@section('name','Quản lý khách hàng')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
<li class="breadcrumb-item active">Quản lý khách hàng</li>
@endsection

@section('content')

<div class="app-content">
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Danh sách khách hàng</h3>
                <a href="{{ route('admin.customers.create') }}" class="btn btn-primary ms-auto">
                    <i class="fa-solid fa-plus"></i> Thêm người dùng
                </a>
            </div>
            <div class="card-body p-3">
                <!-- Filter -->
                <form method="GET" class="mb-3">
                    <div class="row g-2">
                        <div class="col-md-5">
                            <input type="text" name="keyword" class="form-control"placeholder="Tìm theo tên khách hàng ">
                        </div>
                        <div class="col-md-5">
                            <select name="status" class="form-control">
                                <option value="">-- Tất cả trạng thái --</option>
                                <option value="active">Hoạt động</option>
                                <option value="inactive">Ngưng hoạt động</option>
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
                        <th style="width:60px">#</th>
                        <th>Họ tên</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th>Email</th>
                        <th style="width:140px">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->cus_id }}</td>
                            <td>{{ $customer->cus_name }}</td>
                            <td>{{ $customer->cus_phone }}</td>
                            <td>{{ $customer->cus_address }}</td>
                            <td>{{ $customer->cus_email }}</td>

                            <td>
                                <a href="{{ route('admin.customers.detail', $customer->cus_id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.customers.edit', $customer->cus_id) }}"
                                class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen text-white"></i>
                                </a>

                                <form action="{{ route('admin.customers.delete', $customer->cus_id) }}"
                                    method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination -->
                  <div class="d-flex justify-content-center mt-3">
                    {{ $customers->links() }}
                </div>
            </div>
    </div>
</div>

@endsection