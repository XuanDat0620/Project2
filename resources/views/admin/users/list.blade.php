@extends('admin.layouts.app')

@section('title','Quản lý người dùng')
@section('name','Quản lý người dùng')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
<li class="breadcrumb-item active">Quản lý người dùng</li>
@endsection

@section('content')

<div class="app-content">
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Danh sách người dùng</h3>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary ms-auto">
                    <i class="fa-solid fa-plus"></i> Thêm người dùng
                </a>
            </div>
            <div class="card-body p-3">
                <!-- Filter -->
                <form method="GET" class="mb-3">
                    <div class="row g-2">
                        <div class="col-md-5">
                            <input type="text" name="keyword" class="form-control"placeholder="Tìm theo tên ">
                        </div>
                        <div class="col-md-5">
                            <select name="role" class="form-control">
                                <option value="">-- Tất cả --</option>
                                <option value="admin">Quản trị viên</option>
                                <option value="staff">Nhân viên</option>
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
                        <th >#</th>
                        <th>Họ tên</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <th >Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->u_id }}</td>
                            <td>{{ $user->u_name }}</td>
                            <td>{{ $user->u_phone }}</td>
                            <td>{{ $user->u_address }}</td>
                            <td>{{ $user->u_email }}</td>

                            <td>
                                @if($user->u_role == 'admin')
                                    <span class="badge bg-success">Quản trị viên</span>
                                @else
                                    <span class="badge bg-info">Nhân viên</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.users.detail', $user->u_id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.users.edit', $user->u_id) }}"
                                class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen text-white"></i>
                                </a>

                                <form action="{{ route('admin.users.delete', $user->u_id) }}"
                                    method="POST"
                                    style="display:inline;">
                                    @csrf
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
                    {{ $users->links() }}
                </div>
            </div>
    </div>
</div>

@endsection