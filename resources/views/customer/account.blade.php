@extends('customer.layout.app')
@section('title','Tài khoản')
@section('name','Tài khoản')

@section('content')

<section id="account-page">
    <div class="container">
        <div class="row g-4">

            <!-- CỘT 1 -->
            <div class="col-md-6">
                <div class="account-box">
                    <h4 class="mb-3 text-center">Thông tin tài khoản</h4>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('customer.account.update') }}">
                        @csrf

                        <div class="mb-3">
                            <label>Họ và tên</label>
                            <input type="text" name="cus_name" class="form-control"
                                   value="{{ $customer->cus_name }}">
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="cus_email" class="form-control"
                                   value="{{ $customer->cus_email }}">
                        </div>

                        <div class="mb-3">
                            <label>Ngày sinh</label>
                            <input type="date" name="cus_dob" class="form-control"
                                   value="{{ $customer->cus_dob }}">
                        </div>

                        <div class="mb-3">
                            <label>Giới tính</label>
                            <select name="cus_gender" class="form-control">
                                <option value="male" {{ $customer->cus_gender == 'male' ? 'selected' : '' }}>Nam</option>
                                <option value="female" {{ $customer->cus_gender == 'female' ? 'selected' : '' }}>Nữ</option>
                                <option value="other" {{ $customer->cus_gender == 'other' ? 'selected' : '' }}>Khác</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Số điện thoại</label>
                            <input type="text" name="cus_phone" class="form-control"
                                   value="{{ $customer->cus_phone }}">
                        </div>

                        <div class="mb-3">
                            <label>Địa chỉ</label>
                            <input type="text" name="cus_address" class="form-control"
                                   value="{{ $customer->cus_address }}">
                        </div>

                        <button class="btn btn-main w-100">Cập nhật</button>
                    </form>
                </div>
            </div>

            <!-- CỘT 2: ĐỔI MẬT KHẨU -->
            <div class="col-md-6">
                <div class="account-box">
                    <h4 class="mb-3 text-center">Đổi mật khẩu</h4>

                    <form method="POST" action="{{ route('customer.account.password') }}">
                        @csrf

                        <div class="mb-3">
                            <label>Mật khẩu hiện tại</label>
                            <input type="password" name="old_password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Mật khẩu mới</label>
                            <input type="password" name="new_password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Xác nhận mật khẩu</label>
                            <input type="password" name="re_password" class="form-control">
                        </div>

                        <button class="btn btn-outline-main w-100">Đổi mật khẩu</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection