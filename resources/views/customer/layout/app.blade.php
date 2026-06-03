<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/TrangChu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chitietsp.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanpham.css') }}">
    <link rel="stylesheet" href="{{ asset('css/giohang.css') }}">
    <link rel="stylesheet" href="{{ asset('css/thanhtoan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dangki.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dangnhap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/taikhoan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/donhang.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lichsu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/success.css') }}"> 

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    {{-- HEADER --}}
    @include('customer.layout.header')

    {{-- MAIN CONTENT --}}
    <main>
        @yield('content')
        @yield('scripts')
    </main>

    {{-- FOOTER --}}
    @include('customer.layout.footer')

    <!-- JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')

</body>
</html>