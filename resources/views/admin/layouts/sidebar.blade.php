<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

    <div class="sidebar-brand">
        <a href="#" class="brand-link">
            <span class="brand-text fw-light">Fashion</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column">

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.users.list') }}" class="nav-link">
                        <i class="nav-icon bi bi-people"></i>
                        <p>Quản lý người dùng</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.customers.list') }}" class="nav-link">
                        <i class="nav-icon bi bi-people"></i>
                        <p>Quản lý khách hàng</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.categories.list') }}" class="nav-link">
                        <i class="nav-icon bi bi-list"></i>
                        <p>Quản lý danh mục</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.products.list') }}" class="nav-link">
                        <i class="nav-icon bi bi-box"></i>
                        <p>Quản lý sản phẩm</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.orders.list') }}" class="nav-link">
                        <i class="nav-icon bi bi-cart"></i>
                        <p>Quản lý đơn hàng</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>

</aside>