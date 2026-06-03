@extends('customer.layout.app')
@section('title','Đăng nhập')
@section('name','Đăng nhập')

@section('content')

    <section id="login-page">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="login-container">
                <h2>Đăng nhập</h2>
                <!-- Thông báo  -->
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form method="POST" action="{{ route('customer.login') }}">
                @csrf
                    <div class="mb-3">
                        <label>Tên đăng nhập</label>
                        <input type="text" name="cus_name" class="form-control" placeholder="Nhập tên đăng nhập" required>
                    </div>
                    <div class="mb-3">
                        <label>Mật khẩu</label>
                        <input type="password" name="cus_password" class="form-control" placeholder="Nhập mật khẩu" required>
                    </div>
                    <button type="submit" class="btn btn-main">Đăng nhập</button>
                </form>
                <div class="login-extra mt-3">
                    <a href="#">Quên mật khẩu?</a>
                    <p class="mt-2">
                        Chưa có tài khoản?
                        <a href="{{ route('customer.register') }}">Đăng ký</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection