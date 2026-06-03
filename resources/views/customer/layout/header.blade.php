<header>
    <section id="section-header-1">
      <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand fw-bold" href="/">FASHION</a>
                    
                <!-- Toggle cho mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    
                <!-- Navbar content -->
                <div class="collapse navbar-collapse" id="navbarContent">
                    
                    <!-- Menu giữa -->
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('customer.home') }}">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.products', ['gender' => 'nam']) }}">Nam</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.products', ['gender' => 'nu']) }}">Nữ</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.products', ['gender' => 'tre-em']) }}">Trẻ em</a>
                    </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                Danh mục
                            </a>

                            <ul class="dropdown-menu">
                                @foreach($categories as $cate)
                                    <li>
                                        <a class="dropdown-item"
                                           href="{{ route('customer.products', ['category' => $cate->cate_id]) }}">
                                            {{ $cate->cate_name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                    
                    <!-- Phần phải: tìm kiếm, tài khoản, giỏ hàng -->
                    <div class="d-flex align-items-center gap-3">
                        <!-- Tìm kiếm -->
                        <form class="d-flex" role="search">
                        <input class="form-control form-control-sm" type="search" placeholder="Tìm kiếm..." aria-label="Search">
                        <button class="btn btn-outline-dark btn-sm ms-2" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                        </form>
                    
                        <!-- Tài khoản -->
                        @php
                            $customer = session('customer');
                        @endphp

                        @if(!$customer)
                            <!-- Chưa đăng nhập -->
                            <a href="{{ route('customer.login') }}" class="text-dark" title="Đăng nhập">
                                <i class="fa-solid fa-user fs-5"></i>
                            </a>
                        @else
                            <!-- Đã đăng nhập -->
                            <div class="dropdown">
                                <a class="user-dropdown-toggle"  data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-user fs-5 me-1"></i>
                                    <span class="d-none d-lg-inline">{{ $customer->cus_name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('customer.account') }}">
                                            <i class="fa-regular fa-user me-2"></i> Tài khoản
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('customer.orders') }}">
                                            <i class="fa-solid fa-box me-2"></i> Đơn hàng
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('customer.history') }}">
                                            <i class="fa-solid fa-clock-rotate-left me-2"></i> Lịch sử
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('customer.logout') }}">
                                            @csrf
                                            <button class="dropdown-item text-danger">
                                                <i class="fa-solid fa-right-from-bracket me-2"></i> Đăng xuất
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    
                        <!-- Giỏ hàng -->
                         @php
                            $cart = session('cart', []);
                            $cartCount = 0;

                            foreach ($cart as $item) {
                                $cartCount += $item['quantity'];
                            }
                        @endphp
                        <a href="{{ route('customer.cart') }}" class="text-dark position-relative" title="Giỏ hàng">
                            <i class="fa-solid fa-cart-shopping fs-5"></i>

                            @if($cartCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                    </div>
                </div>
            </div>
      </nav>
    </section>
</header>