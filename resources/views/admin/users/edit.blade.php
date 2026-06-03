@extends('admin.layouts.app')

@section('title','Sửa thông tin người dùng')
@section('name','Sửa thông tin người dùng')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.dashboard') }}">Trang chủ</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('admin.users.list') }}">Danh sách người dùng</a>
</li>
<li class="breadcrumb-item active">Sửa</li>
@endsection

@section('content')

<div class="app-content">
  <div class="container-fluid">
    <div class="row">
      <!-- LEFT: Avatar -->
      <div class="col-md-4">
        <div class="card card-primary card-outline text-center">
          <div class="card-body">
            <img class="img-fluid img-circle mb-3"
                 src="https://ui-avatars.com/api/?name={{ $user->u_name }}&background=0D8ABC&color=fff"
                 style="width:120px">

            <h5>{{ $user->u_name }}</h5>
            <p class="text-muted">{{ $user->u_email }}</p>

            <span class="badge 
                {{ $user->u_role == 'admin' ? 'bg-success' : 'bg-info' }}">
                {{ $user->u_role == 'admin' ? 'Admin' : 'Staff' }}
            </span>
          </div>
        </div>
      </div>

      <!-- RIGHT: Form -->
      <div class="col-md-8">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="mb-0"><i class="fa fa-edit"></i> Chỉnh sửa thông tin</h5>
          </div>

          <form method="POST" action="{{ route('admin.users.update', $user->u_id) }}">
          @csrf
          @method('PUT')

          <div class="card-body">
            <div class="row">

              <!-- Họ tên -->
              <div class="col-md-6 mb-3">
                <label><i class="fa fa-user"></i> Họ tên</label>
                <input type="text" name="u_name" class="form-control" value="{{ $user->u_name }}" required>
              </div>

              <!-- Email -->
              <div class="col-md-6 mb-3">
                <label><i class="fa fa-envelope"></i> Email</label>
                <input type="email" name="u_email" class="form-control" value="{{ $user->u_email }}" required>
              </div>

              <!-- SĐT -->
              <div class="col-md-6 mb-3">
                <label><i class="fa fa-phone"></i> Số điện thoại</label>
                <input type="text" name="u_phone" class="form-control" value="{{ $user->u_phone }}">
              </div>

              <!-- Ngày sinh -->
              <div class="col-md-6 mb-3">
                <label><i class="fa fa-calendar"></i> Ngày sinh</label>
                <input type="date" name="u_dob" class="form-control" value="{{ $user->u_dob }}">
              </div>

              <!-- Giới tính -->
              <div class="col-md-6 mb-3">
                <label><i class="fa fa-venus-mars"></i> Giới tính</label>
                <select name="u_gender" class="form-control">
                  <option value="male" {{ $user->u_gender == 'male' ? 'selected' : '' }}>Nam</option>
                  <option value="female" {{ $user->u_gender == 'female' ? 'selected' : '' }}>Nữ</option>
                  <option value="other" {{ $user->u_gender == 'other' ? 'selected' : '' }}>Khác</option>
                </select>
              </div>

              <!-- Mật khẩu -->
              <div class="col-md-6 mb-3">
                <label><i class="fa fa-lock"></i> Mật khẩu mới</label>
                <input type="password" name="u_password" class="form-control" placeholder="Để trống nếu không đổi">
              </div>

              <!-- Địa chỉ -->
              <div class="col-12 mb-3">
                <label><i class="fa fa-map-marker-alt"></i> Địa chỉ</label>
                <textarea name="u_address" rows="3" class="form-control">{{ $user->u_address }}</textarea>
              </div>

              <!-- Vai trò -->
              <div class="col-md-6 mb-3">
                <label><i class="fa fa-user-shield"></i> Vai trò</label>
                <select name="u_role" class="form-control">
                  <option value="admin" {{ $user->u_role == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                  <option value="staff" {{ $user->u_role == 'staff' ? 'selected' : '' }}>Nhân viên</option>
                </select>
              </div>

              <!-- Trạng thái -->
              <div class="col-md-6 mb-3">
                <label><i class="fa fa-toggle-on"></i> Trạng thái</label>
                <select name="u_status" class="form-control">
                  <option value="active" {{ $user->u_status == 'active' ? 'selected' : '' }}>Hoạt động</option>
                  <option value="inactive" {{ $user->u_status == 'inactive' ? 'selected' : '' }}>Ngưng hoạt động</option>
                </select>
              </div>

            </div>
          </div>

          <!-- Footer -->
          <div class="card-footer text-end">
            <a href="{{ route('admin.users.list') }}" class="btn btn-secondary">
              <i class="fa fa-arrow-left"></i> Quay lại
            </a>

            <button type="submit" class="btn btn-primary">
              <i class="fa fa-save"></i> Cập nhật
            </button>
          </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection