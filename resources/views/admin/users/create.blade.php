@extends('admin.layouts.app')

@section('title','Thêm người dùng')
@section('name','Thêm người dùng')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.dashboard') }}">Trang chủ</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('admin.users.list') }}">Danh sách người dùng</a>
</li>
<li class="breadcrumb-item active">Thêm</li>
@endsection

@section('content')

<div class="app-content">
  <div class="container-fluid">

    <div class="row">

      <!-- LEFT: Avatar preview -->
      <div class="col-md-4">
        <div class="card card-primary card-outline text-center">
          <div class="card-body">
            <img id="avatarPreview"
                 class="img-fluid img-circle mb-3"
                 src="https://ui-avatars.com/api/?name=User&background=0D8ABC&color=fff"
                 style="width:120px">

            <h5 id="previewName">Tên người dùng</h5>
            <p class="text-muted">email@example.com</p>

            <span class="badge bg-info">Nhân viên</span>
          </div>
        </div>
      </div>

      <!-- RIGHT: Form -->
      <div class="col-md-8">
        <div class="card card-primary card-outline">

          <div class="card-header">
            <h5 class="mb-0"><i class="fa fa-user-plus"></i> Thêm người dùng</h5>
          </div>

          <form method="POST" action="{{ route('admin.users.store') }}">
          @csrf

          <div class="card-body">
            <div class="row">

              <!-- Họ tên -->
              <div class="col-md-6 mb-3">
                <label><i class="fa fa-user"></i> Họ tên</label>
                <input type="text" name="u_name" id="u_name"
                       class="form-control" required>
              </div>

              <!-- Email -->
              <div class="col-md-6 mb-3">
                <label><i class="fa fa-envelope"></i> Email</label>
                <input type="email" name="u_email"
                       class="form-control" required>
              </div>

              <!-- SĐT -->
              <div class="col-md-6 mb-3">
                <label><i class="fa fa-phone"></i> Số điện thoại</label>
                <input type="text" name="u_phone" class="form-control">
              </div>

              <!-- Ngày sinh -->
              <div class="col-md-6 mb-3">
                <label><i class="fa fa-calendar"></i> Ngày sinh</label>
                <input type="date" name="u_dob" class="form-control">
              </div>

              <!-- Giới tính -->
              <div class="col-md-6 mb-3">
                <label><i class="fa fa-venus-mars"></i> Giới tính</label>
                <select name="u_gender" class="form-control">
                  <option value="male">Nam</option>
                  <option value="female">Nữ</option>
                  <option value="other">Khác</option>
                </select>
              </div>

              <!-- Password -->
              <div class="col-md-6 mb-3">
                <label><i class="fa fa-lock"></i> Mật khẩu</label>
                <input type="password" name="u_password"
                       class="form-control" required>
              </div>

              <!-- Địa chỉ -->
              <div class="col-12 mb-3">
                <label><i class="fa fa-map-marker-alt"></i> Địa chỉ</label>
                <textarea name="u_address" rows="3"
                          class="form-control"></textarea>
              </div>

              <!-- Role -->
              <div class="col-md-6 mb-3">
                <label><i class="fa fa-user-shield"></i> Vai trò</label>
                <select name="u_role" class="form-control">
                  <option value="admin">Quản trị viên</option>
                  <option value="staff">Nhân viên</option>
                </select>
              </div>

              <!-- Status -->
              <div class="col-md-6 mb-3">
                <label><i class="fa fa-toggle-on"></i> Trạng thái</label>
                <select name="u_status" class="form-control">
                  <option value="active">Hoạt động</option>
                  <option value="inactive">Ngưng hoạt động</option>
                </select>
              </div>

            </div>
          </div>

          <!-- Footer -->
          <div class="card-footer text-end">
            <a href="{{ route('admin.users.list') }}" class="btn btn-secondary">
              <i class="fa fa-arrow-left"></i> Hủy
            </a>

            <button type="submit" class="btn btn-success">
              <i class="fa fa-save"></i> Lưu người dùng
            </button>
          </div>

          </form>

        </div>
      </div>

    </div>

  </div>
</div>

<!-- JS preview tên -->
<script>
document.getElementById('u_name').addEventListener('input', function() {
    document.getElementById('previewName').innerText = this.value || 'Tên người dùng';
});
</script>

@endsection