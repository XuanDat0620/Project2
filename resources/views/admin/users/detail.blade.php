@extends('admin.layouts.app')

@section('title','Chi tiết thông tin người dùng')
@section('name','Chi tiết thông tin người dùng')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.dashboard') }}">Trang chủ</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('admin.users.list') }}">Danh sách người dùng</a>
</li>
<li class="breadcrumb-item active">Chi tiết</li>
@endsection

@section('content')

<div class="app-content">
    <div class="container-fluid">

        <div class="row">
            <!-- LEFT: Avatar + Info nhanh -->
            <div class="col-md-4">
                <div class="card card-primary card-outline text-center">
                    <div class="card-body box-profile">

                        <!-- Avatar -->
                        <div class="mb-3">
                            <img class="profile-user-img img-fluid img-circle"
                                 src="https://ui-avatars.com/api/?name={{ $user->u_name }}&background=0D8ABC&color=fff"
                                 alt="User profile picture">
                        </div>

                        <h4 class="mb-1">{{ $user->u_name }}</h4>
                        <p class="text-muted">{{ $user->u_email }}</p>

                        <!-- Role -->
                        <span class="badge 
                            {{ $user->u_role == 'admin' ? 'bg-success' : 'bg-info' }}">
                            {{ $user->u_role == 'admin' ? 'Quản trị viên' : 'Nhân viên' }}
                        </span>

                        <!-- Status -->
                        <div class="mt-2">
                            <span class="badge 
                                {{ $user->u_status == 'active' ? 'bg-primary' : 'bg-secondary' }}">
                                {{ $user->u_status == 'active' ? 'Hoạt động' : 'Ngưng hoạt động' }}
                            </span>
                        </div>

                    </div>
                </div>
            </div>

            <!-- RIGHT: Thông tin chi tiết -->
            <div class="col-md-8">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="mb-0">Thông tin chi tiết</h5>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label><i class="fa fa-phone"></i> Số điện thoại</label>
                                <input type="text" class="form-control" value="{{ $user->u_phone }}" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label><i class="fa fa-calendar"></i> Ngày sinh</label>
                                <input type="date" class="form-control" value="{{ $user->u_dob }}" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label><i class="fa fa-venus-mars"></i> Giới tính</label>
                                <input type="text" class="form-control" value="@if($user->u_gender == 'male') Nam
                                        @elseif($user->u_gender == 'female') Nữ @else Khác @endif" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label><i class="fa fa-lock"></i> Mật khẩu</label>
                                <input type="password" class="form-control" value="********" readonly>
                            </div>

                            <div class="col-12 mb-3">
                                <label><i class="fa fa-map-marker-alt"></i> Địa chỉ</label>
                                <textarea class="form-control" rows="3" readonly>{{ $user->u_address }}</textarea>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <a href="{{ route('admin.users.list') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Quay lại
                        </a>
                        <a href="{{ route('admin.users.edit', $user->u_id) }}" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Chỉnh sửa
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection