@extends('customer.layout.app')
@section('title','Đăng ký')
@section('name','Đăng ký')

@section('content')

    <section id="register-page">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="register-container">
                <form method="POST" action="{{ route('customer.register') }}">
                @csrf
                    <h2>Đăng ký tài khoản</h2>
                    <!-- {{-- Thông báo --}} -->
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <label>Họ và tên</label>
                    <input type="text" name="cus_name" class="form-control" placeholder="Nhập họ tên" required>

                    <label>Số điện thoại</label>
                    <input type="text" name="cus_phone" class="form-control" placeholder="Nhập số điện thoại" required>

                    <label>Địa chỉ</label>
                    <input type="text" name="cus_address" class="form-control" placeholder="Nhập địa chỉ" required>

                    <label>Email</label>
                    <input type="text" name="cus_email" class="form-control" placeholder="Nhập email" required>

                    <label>Mật khẩu</label>
                    <input type="password" name="cus_password" class="form-control" placeholder="Nhập mật khẩu" required>

                    <label>Xác nhận mật khẩu</label>
                    <input type="password" name="re_password" class="form-control" placeholder="Nhập lại mật khẩu" required>

                    <button name="sbm" type="submit" class="btn btn-main">Đăng ký</button>
                    <p class="login-link">
                        Đã có tài khoản? <a href="{{ route('customer.login') }}">Đăng nhập</a>
                    </p>
                </form>
            </div>
        </div>
    </section>

@endsection