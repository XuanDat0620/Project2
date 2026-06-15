@extends('admin.layouts.app')

@section('title','Báo cáo thống kê')
@section('name','Báo cáo thống kê')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item active">Báo cáo thống kê</li>
@endsection

@section('content')

<div class="app-content report-page">
<div class="container-fluid">

<!-- ================= FILTER ================= -->
<div class="card shadow-sm mb-4 report-filter">
    <div class="card-body">

        <form method="GET">
            <div class="row">

                <div class="col-md-3">
                    <label>Từ ngày</label>
                    <input type="date" name="from" value="{{ request('from') }}" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Đến ngày</label>
                    <input type="date" name="to" value="{{ request('to') }}" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Loại thống kê</label>
                    <select name="type" class="form-control">
                        <option value="day"   {{ $type == 'day'   ? 'selected' : '' }}>Theo ngày</option>
                        <option value="week"  {{ $type == 'week'  ? 'selected' : '' }}>Theo tuần</option>
                        <option value="month" {{ $type == 'month' ? 'selected' : '' }}>Theo tháng</option>
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button class="btn btn-primary w-100">
                        Lọc dữ liệu
                    </button>
                </div>

            </div>
        </form>

    </div>
</div>

<!-- ================= KPI ================= -->
<div class="row mb-4">

    <div class="col-lg-3 col-md-6 mb-3">
        <div class="small-box bg-primary">
            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <h4>{{ number_format($revenue) }} đ</h4>
                    <p>Doanh thu</p>
                </div>

                <i class="fas fa-money-bill-wave fa-3x opacity-50"></i>

            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-3">
        <div class="small-box bg-success">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4>{{ $totalOrders }}</h4>
                    <p>Tổng đơn hàng</p>
                </div>

                <i class="fas fa-shopping-cart fa-3x opacity-50"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-3">
        <div class="small-box bg-warning">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4>{{ $totalCustomers }}</h4>
                    <p>Khách hàng</p>
                </div>

                <i class="fas fa-users fa-3x opacity-50"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-3">
        <div class="small-box bg-danger">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4>{{ $totalSold }}</h4>
                    <p>Sản phẩm đã bán</p>
                </div>

                <i class="fas fa-box fa-3x opacity-50"></i>
            </div>
        </div>
    </div>

</div>

<!-- ================= CHARTS ================= -->
<div class="row">

    <!-- DOANH THU -->
    <!-- DOANH THU -->
    <div class="col-lg-6">
        <div class="card shadow-sm report-table">
            <div class="card-header">Doanh thu</div>

            <div class="card-body">
                <div class="chart-container revenue-chart">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- ORDER STATUS -->
    <div class="col-lg-3">
        <div class="card shadow-sm report-table">
            <div class="card-header">Trạng thái đơn hàng</div>

            <div class="card-body">
                <div class="chart-container pie-chart">
                    <canvas id="orderStatusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- PAYMENT -->
    <div class="col-lg-3">
        <div class="card shadow-sm report-table">
            <div class="card-header">Thanh toán</div>

            <div class="card-body">
                <div class="chart-container pie-chart">
                    <canvas id="paymentChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- ================= TOP & VIEW ================= -->
<div class="row mt-4">

    <!-- TOP PRODUCT -->
    <div class="col-md-6">
        <div class="card shadow-sm report-table">
            <div class="card-header">Top sản phẩm bán chạy</div>
            <div class="card-body">
                <table class="table">
                    @foreach($topProducts as $item)
                    <tr>
                        <td>
                             <span class="rank-badge
                                {{ $loop->iteration == 1 ? 'rank-1' :
                                ($loop->iteration == 2 ? 'rank-2' :
                                ($loop->iteration == 3 ? 'rank-3' : 'rank-normal')) }}">
                                {{ $loop->iteration }}
                            </span>
                        </td>
                        <td>{{ $item->p_name }}</td>
                        <td>{{ $item->total_sold }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <!-- MOST VIEWED -->
    <div class="col-md-6">
        <div class="card shadow-sm report-table">
            <div class="card-header">Sản phẩm xem nhiều nhất</div>
            <div class="card-body">
                <table class="table">
                    @foreach($mostViewedProducts as $item)
                    <tr>
                        <td>
                            <span class="rank-badge
                                {{ $loop->iteration == 1 ? 'rank-1' :
                                ($loop->iteration == 2 ? 'rank-2' :
                                ($loop->iteration == 3 ? 'rank-3' : 'rank-normal')) }}">
                                {{ $loop->iteration }}
                            </span>
                        </td>
                        <td>{{ $item->p_name }}</td>
                        <td>{{ $item->views }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

</div>

<!-- ================= CUSTOMER ================= -->
<div class="row mt-4">

    <!-- TOP CUSTOMER -->
    <div class="col-md-6">
        <div class="card shadow-sm report-table">
            <div class="card-header">Top khách hàng</div>
            <div class="card-body">
                <table class="table">
                    @foreach($topCustomers as $customer)
                    <tr>
                        <td>
                            <span class="rank-badge
                                {{ $loop->iteration == 1 ? 'rank-1' :
                                ($loop->iteration == 2 ? 'rank-2' :
                                ($loop->iteration == 3 ? 'rank-3' : 'rank-normal')) }}">
                                {{ $loop->iteration }}
                            </span>
                        </td>
                        <td>{{ $customer->cus_name }}</td>
                        <td>{{ number_format($customer->total_spent) }} đ</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <!-- NEW CUSTOMER -->
    <div class="col-md-6">
        <div class="card shadow-sm report-table">
            <div class="card-header">Khách hàng mới</div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="newCustomerChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- ================= LOW STOCK ================= -->
<div class="card shadow-sm mt-4 report-table">
    <div class="card-header">Sản phẩm sắp hết hàng</div>
    <div class="card-body">
        <table class="table">
            @foreach($lowStock as $item)
            <tr>
                <td>{{ $item->product->p_name }}</td>
                <td>{{ $item->size->size_name }}</td>
                <td>{{ $item->color->color_name }}</td>
                <td>
                    <span class="{{ $item->pv_stock == 0 ? 'stock-low' : 'stock-medium' }}">
                        {{ $item->pv_stock == 0 ? 'Hết hàng' : $item->pv_stock }}
                    </span>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

</div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
console.log('JS chạy');
console.log(@json($revenueData));
console.log(document.getElementById('revenueChart'));
// Doanh thu
new Chart(document.getElementById('revenueChart'), {
    type: 'bar',
    data: {
        labels: @json($labels),
        datasets: [{
            label: 'Doanh thu',
            data: @json($revenueData),
            backgroundColor: '#0d6efd'
        }]
    }
});

// Order status
new Chart(document.getElementById('orderStatusChart'), {
    type: 'pie',
    data: {
        labels: ['Chờ', 'Đang giao', 'Đã giao', 'Hủy'],
        datasets: [{
            data: @json($orderStatusData),
            backgroundColor: [
                '#ffc107',
                '#0d6efd',
                '#198754',
                '#dc3545'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true
    }
});

// Payment
new Chart(document.getElementById('paymentChart'), {
    type: 'doughnut',
    data: {
        labels: ['COD','VNPay','Momo'],
        datasets: [{
            data: @json($paymentData),
            backgroundColor: ['#198754','#0d6efd','#dc3545']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true 
    }
});

// New customer
new Chart(document.getElementById('newCustomerChart'), {
    type: 'line',
    data: {
        labels: @json($labels),
        datasets: [{
            label: 'Khách mới',
            data: @json($newCustomerData),
            borderColor: '#0d6efd'
        }]
    }
});

</script>
@endpush
