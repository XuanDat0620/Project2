@extends('admin.layouts.app')

@section('title','Dashboard')
@section('name','Dashboard')

@section('content')

<div class="app-content">
  <div class="container-fluid">
    <div class="row g-4">
      <div class="col-lg-3 col-md-3">
        <div class="small-box bg-primary dashboard-card position-relative">
          <div class="inner">
            <h3>{{ $totalOrders }}</h3>
            <p>Tổng đơn hàng</p>
          </div>
          <div class="icon">
            <i class="fas fa-shopping-cart"></i>
          </div>
        </div>
      </div>

        <div class="col-lg-3 col-md-3">
            <div class="small-box bg-success dashboard-card position-relative">
                <div class="inner">
                    <h3>{{ $totalProducts }}</h3>
                    <p>Tổng sản phẩm</p>
                </div>

                <div class="icon">
                    <i class="fas fa-box-open"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3">
            <div class="small-box bg-warning dashboard-card position-relative">
                <div class="inner">
                    <h3>{{ $totalCustomers }}</h3>
                    <p>Khách hàng</p>
                </div>

                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3">
            <div class="small-box bg-danger dashboard-card position-relative">
                <div class="inner">
                    <h3>{{ number_format($revenue) }}</h3>
                    <p>Doanh thu (VNĐ)</p>
                </div>

                <div class="icon">
                    <i class="fas fa-coins"></i>
                </div>
            </div>
        </div>
      </div>
      <div class="row mt-4">
            <!-- Biểu đồ doanh thu -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Doanh thu theo tháng
                        </h3>
                    </div>

                    <div class="card-body">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Trạng thái đơn hàng -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Trạng thái đơn hàng
                        </h3>
                    </div>

                    <div class="card-body">

                        <p>Chờ xác nhận
                            <span class="float-end">
                                {{ $pending }}
                            </span>
                        </p>

                        <p>Đã xác nhận
                            <span class="float-end">
                                {{ $confirmed }}
                            </span>
                        </p>

                        <p>Đang giao
                            <span class="float-end">
                                {{ $shipping }}
                            </span>
                        </p>

                        <p>Đã giao
                            <span class="float-end">
                                {{ $delivered }}
                            </span>
                        </p>
                        <p>Hoàn thành
                            <span class="float-end">
                                {{ $completed }}
                            </span>
                        </p>

                        <p>Đã hủy
                            <span class="float-end">
                                {{ $cancelled }}
                            </span>
                        </p>

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('revenueChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            'T1','T2','T3','T4',
            'T5','T6','T7','T8',
            'T9','T10','T11','T12'
        ],
        datasets: [{
            label: 'Doanh thu',
            data: @json($revenueData)
        }]
    },
    options: {
        responsive: true
    }
});

</script>

@endsection