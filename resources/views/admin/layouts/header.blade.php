<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ms-auto">

            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="{{ asset('dist/assets/img/user2-160x160.jpg') }}"
                         class="user-image rounded-circle shadow">
                    <span class="d-none d-md-inline">Admin</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="user-footer">
                        <a href="#" class="btn btn-default btn-flat float-end">Sign out</a>
                    </li>
                </ul>
            </li>

        </ul>

    </div>
</nav>