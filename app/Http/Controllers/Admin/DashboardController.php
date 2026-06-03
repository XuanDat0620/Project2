<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Thống kê
        $totalOrders = Order::count();

        $totalProducts = Product::count();

        $totalCustomers = Customer::count();

        $revenue = Order::whereIn('ord_status', [
            'delivered',
            'completed'
        ])->sum('ord_total_price');

        // Doanh thu 12 tháng
        $monthlyRevenue = Order::selectRaw(
        'MONTH(ord_buy_date) as month,
        SUM(ord_total_price) as total'
        )
        ->whereYear('ord_buy_date', date('Y'))
        ->whereIn('ord_status', ['delivered','completed'])
        ->groupBy(DB::raw('MONTH(ord_buy_date)'))
        ->pluck('total','month');

        $revenueData = [];

        for($i=1;$i<=12;$i++){
            $revenueData[] = $monthlyRevenue[$i] ?? 0;
        }

        // Thống kê trạng thái đơn hàng
        $pending = Order::where('ord_status','pending')->count();
        $confirmed = Order::where('ord_status','confirmed')->count();
        $shipping = Order::where('ord_status','shipping')->count();
        $delivered = Order::where('ord_status','delivered')->count();
        $completed = Order::where('ord_status','completed')->count();
        $cancelled = Order::where('ord_status','cancelled')->count();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalProducts',
            'totalCustomers',
            'revenue',
            'revenueData',
            'pending',
            'confirmed',
            'shipping',
            'delivered',
            'completed',
            'cancelled'
        ));
    }
}
