@extends('admin.layouts.app')

@section('title','Báo cáo thống kê')
@section('name','Báo cáo thống kê')

@section('breadcrumb')

<li class="breadcrumb-item">
    <a href="{{ route('admin.dashboard') }}">
        Dashboard
    </a>
</li>
<li class="breadcrumb-item active">
    Báo cáo thống kê
</li>
@endsection

@section('content')

<div class="app-content">
    <div class="container-fluid">

```
    <!-- Bộ lọc -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET">

                <div class="row">

                    <div class="col-md-4">
                        <label>Từ ngày</label>
                        <input type="date"
                               name="from"
                               class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label>Đến ngày</label>
                        <input type="date"
                               name="to"
                               class="form-control">
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <button class="btn btn-primary w-100">
                            <i class="fas fa-filter"></i>
                            Xem báo cáo
                        </button>
                    </div>

                </div>

            </form>
        </div>
    </div>

    <!-- Thống kê nhanh -->
    <div class="row mb-4">

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6>Tổng doanh thu</h6>
                    <h3>{{ number_format($revenue) }} đ</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6>Tổng đơn hàng</h6>
                    <h3>{{ $totalOrders }}</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6>Tổng khách hàng</h6>
                    <h3>{{ $totalCustomers }}</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6>Sản phẩm đã bán</h6>
                    <h3>{{ $totalSold }}</h3>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <!-- Biểu đồ doanh thu -->
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header">
                    Doanh thu theo tháng
                </div>

                <div class="card-body">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

        </div>

        <!-- Trạng thái đơn -->
        <div class="col-md-4">

            <div class="card shadow-sm">
                <div class="card-header">
                    Trạng thái đơn hàng
                </div>

                <div class="card-body">
                    <canvas id="orderStatusChart"></canvas>
                </div>
            </div>

        </div>

    </div>

    <!-- Top sản phẩm -->
    <div class="card shadow-sm mt-4">

        <div class="card-header">
            Top 5 sản phẩm bán chạy
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sản phẩm</th>
                        <th>Đã bán</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($topProducts as $item)

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->p_name }}</td>
                        <td>{{ $item->total_sold }}</td>
                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

    <!-- Sản phẩm sắp hết hàng -->

    <div class="card shadow-sm mt-4">

        <div class="card-header">
            Sản phẩm sắp hết hàng
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Size</th>
                        <th>Màu</th>
                        <th>Tồn kho</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($lowStock as $item)

                    <tr>
                        <td>{{ $item->product->p_name }}</td>
                        <td>{{ $item->size->size_name }}</td>
                        <td>{{ $item->color->color_name }}</td>
                        <td>
                            <span class="badge bg-danger">
                                {{ $item->pv_stock }}
                            </span>
                        </td>
                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>
```

</div>

@endsection
