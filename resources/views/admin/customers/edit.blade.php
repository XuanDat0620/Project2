@extends('admin.layouts.app')

@section('title','Sửa thông tin khách hàng')
@section('name','Sửa thông tin khách hàng')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.dashboard') }}">Trang chủ</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('admin.customers.list') }}">Danh sách khách hàng</a>
</li>
<li class="breadcrumb-item active">Sửa thông tin khách hàng</li>
@endsection

@section('content')

<!--begin::App Content-->
<div class="app-content">
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
      <!-- Content list -->
      <!--begin::Quick Example-->
      <div class="card card-primary card-outline mb-4">
        <!--begin::Form-->
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf
          <div class="row">
            <!-- Họ tên -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Họ tên</label>
              <input type="text" name="fullname" class="form-control" value="{{ $user->name }}" required>
            </div>
            <!-- Email -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>
            <!-- Số điện thoại -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Số điện thoại</label>
              <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
            </div>
            <!-- Mật khẩu mới -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Mật khẩu mới</label>
              <input type="password" name="password" class="form-control" placeholder="Để trống nếu không đổi">
            </div>
            <!-- Địa chỉ -->
            <div class="col-12 mb-3">
              <label class="form-label">Địa chỉ</label>
              <textarea name="address" rows="3" class="form-control" required>{{ $user->address }}</textarea>
            </div>
            <!-- Vai trò -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Vai trò</label>
              <select name="role" class="form-control">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Nhân viên</option>
              </select>
            </div>
            <!-- Trạng thái -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Ngưng hoạt động</option>
                </select>
            </div>
          </div>
            <div class="text-end">
              <a href="{{ route('admin.users.list') }}" class="btn btn-secondary">Hủy</a>
              <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
            </div>
        </form>
        <!--end::Form-->
      </div>
      <!--end::Quick Example-->
      <!-- End content list-->
    </div>
    <!-- /.row (main row) -->
  </div>
  <!--end::Container-->
</div>
<!--end::App Content-->
@endsection