@extends('admin.layouts.app')

@section('title','Thêm khách hàng')
@section('name','Thêm khách hàng')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.dashboard') }}">Trang chủ</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('admin.customers.list') }}">Danh sách khách hàng</a>
</li>
<li class="breadcrumb-item active">Thêm khách hàng</li>
@endsection

@section('content')

<div class="app-content">
  <div class="container-fluid">
    <div class="row justify-content-center">

      <div class="col-lg-10">
        <div class="card shadow-sm border-0">

          <!-- HEADER -->
          <div class="card-header bg-success text-white">
            <h5 class="mb-0">Thêm khách hàng mới</h5>
          </div>

          <!-- FORM -->
          <form method="POST" action="{{ route('admin.customers.store') }}">
          @csrf

          <div class="card-body">
            <div class="row g-3">

              <!-- Tên -->
              <div class="col-md-6">
                <label>Họ tên</label>
                <input type="text" name="cus_name" class="form-control" required>
              </div>

              <!-- Email -->
              <div class="col-md-6">
                <label>Email</label>
                <input type="email" name="cus_email" class="form-control" required>
              </div>

              <!-- SĐT -->
              <div class="col-md-6">
                <label>Số điện thoại</label>
                <input type="text" name="cus_phone" class="form-control">
              </div>

              <!-- Ngày sinh -->
              <div class="col-md-6">
                <label>Ngày sinh</label>
                <input type="date" name="cus_dob" class="form-control">
              </div>

              <!-- Giới tính -->
              <div class="col-md-6">
                <label>Giới tính</label>
                <select name="cus_gender" class="form-control">
                  <option value="male">Nam</option>
                  <option value="female">Nữ</option>
                  <option value="other">Khác</option>
                </select>
              </div>

              <!-- Mật khẩu -->
              <div class="col-md-6">
                <label>Mật khẩu</label>
                <input type="password" name="cus_password" class="form-control" required>
              </div>

              <!-- Địa chỉ -->
              <div class="col-12">
                <label>Địa chỉ</label>
                <textarea name="cus_address" class="form-control"></textarea>
              </div>

              <!-- Trạng thái -->
              <div class="col-md-6">
                <label>Trạng thái</label>
                <select name="cus_status" class="form-control">
                  <option value="active">Hoạt động</option>
                  <option value="inactive">Ngưng hoạt động</option>
                </select>
              </div>

            </div>
          </div>

          <!-- FOOTER -->
          <div class="card-footer text-end">
            <a href="{{ route('admin.customers.list') }}" class="btn btn-secondary">Hủy</a>
            <button type="submit" class="btn btn-success">Lưu</button>
          </div>

          </form>

        </div>
      </div>

    </div>
  </div>
</div>

@endsection