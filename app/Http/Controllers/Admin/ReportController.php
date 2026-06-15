<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderDetail;
use App\Models\ProductVariant;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
{
    $from = $request->from;
    $to   = $request->to;
    $type = $request->type ?? 'month';

    // ================= CHART LABELS & REVENUE DATA =================
    $labels      = [];
    $revenueData = [];

    if ($type == 'day' && $from && $to) {
        $period = \Carbon\CarbonPeriod::create($from, $to);
        foreach ($period as $date) {
            $labels[]      = $date->format('d/m');
            $revenueData[] = Order::whereDate('ord_buy_date', $date->format('Y-m-d'))
                ->whereIn('ord_status', ['completed', 'delivered'])
                ->sum('ord_total_price');
        }
    } elseif ($type == 'week' && $from && $to) {
        $week = \Carbon\Carbon::parse($from)->startOfWeek();
        $end  = \Carbon\Carbon::parse($to)->endOfWeek();
        while ($week->lte($end)) {
            $labels[]      = 'Tuần ' . $week->weekOfYear;
            $revenueData[] = Order::whereBetween('ord_buy_date', [
                    $week->copy()->startOfWeek()->toDateString(),
                    $week->copy()->endOfWeek()->toDateString()
                ])
                ->whereIn('ord_status', ['completed', 'delivered'])
                ->sum('ord_total_price');
            $week->addWeek();
        }
    } else {
        // Mặc định: theo tháng
        $labels = ['T1','T2','T3','T4','T5','T6','T7','T8','T9','T10','T11','T12'];
        for ($m = 1; $m <= 12; $m++) {
            $q = Order::whereMonth('ord_buy_date', $m)
                ->whereIn('ord_status', ['completed', 'delivered']);
            if ($from && $to) {
                $q->whereYear('ord_buy_date', date('Y', strtotime($from)));
            }
            $revenueData[] = $q->sum('ord_total_price');
        }
    }

    // ================= ORDER QUERY =================
    $orderQuery = Order::query();
    if ($from && $to) {
        $orderQuery->whereBetween('ord_buy_date', [
            $from . ' 00:00:00',
            $to . ' 23:59:59'
        ]);
    }

    // ================= KPI =================
    $revenue = (clone $orderQuery)
        ->where('ord_status', 'completed')
        ->sum('ord_total_price');

    $totalOrders = (clone $orderQuery)->count();

    $totalCustomers = Customer::count();

    $totalSold = OrderDetail::join('orders', 'order_details.ord_id', '=', 'orders.ord_id')
        ->where('orders.ord_status', 'completed')
        ->when($from && $to, function ($q) use ($from, $to) {
            $q->whereBetween('orders.ord_buy_date', [
                $from . ' 00:00:00',
                $to . ' 23:59:59'
            ]);
        })
        ->sum('order_details.ord_detail_quantity');

    // ================= TOP PRODUCTS =================
    $topProducts = OrderDetail::join('orders', 'order_details.ord_id', '=', 'orders.ord_id')
        ->join('product_variants', 'order_details.pv_id', '=', 'product_variants.pv_id')
        ->join('products', 'product_variants.p_id', '=', 'products.p_id')
        ->where('orders.ord_status', 'completed')
        ->select('products.p_name', DB::raw('SUM(order_details.ord_detail_quantity) as total_sold'))
        ->groupBy('products.p_id', 'products.p_name')
        ->orderByDesc('total_sold')
        ->limit(5)
        ->get();

    // ================= MOST VIEWED =================
    $mostViewedProducts = ProductVariant::join('products', 'product_variants.p_id', '=', 'products.p_id')
        ->select('products.p_name', DB::raw('SUM(COALESCE(product_variants.pv_view,0)) as views'))
        ->groupBy('products.p_id', 'products.p_name')
        ->orderByDesc('views')
        ->limit(5)
        ->get();

    // ================= LOW STOCK =================
    $lowStock = ProductVariant::with(['product', 'size', 'color'])
        ->where('pv_stock', '<', 5)
        ->orderBy('pv_stock')
        ->get();

    // ================= TOP CUSTOMERS =================
    $topCustomers = Customer::join('orders', 'customers.cus_id', '=', 'orders.cus_id')
        ->whereIn('orders.ord_status', ['completed', 'delivered'])
        ->select(
            'customers.cus_name',
            DB::raw('COUNT(orders.ord_id) as total_orders'),
            DB::raw('SUM(orders.ord_total_price) as total_spent')
        )
        ->groupBy('customers.cus_id', 'customers.cus_name')
        ->orderByDesc('total_spent')
        ->limit(5)
        ->get();

    // ================= ORDER STATUS =================
    $orderStatusData = [
        Order::where('ord_status', 'pending')->count(),
        Order::where('ord_status', 'shipping')->count(),
        Order::where('ord_status', 'delivered')->count(),
        Order::where('ord_status', 'cancelled')->count(),
    ];

    // ================= PAYMENT =================
    $paymentData = [
        Payment::join('payment_methods', 'payments.pm_id', '=', 'payment_methods.pm_id')
            ->where('payment_methods.pm_name', 'Thanh toán khi nhận hàng(COD)')->count(),
        Payment::join('payment_methods', 'payments.pm_id', '=', 'payment_methods.pm_id')
            ->where('payment_methods.pm_name', 'VNPay')->count(),
        Payment::join('payment_methods', 'payments.pm_id', '=', 'payment_methods.pm_id')
            ->where('payment_methods.pm_name', 'Momo')->count(),
    ];

    // ================= NEW CUSTOMER =================
    $newCustomerData = [];
    for ($m = 1; $m <= 12; $m++) {
        $newCustomerData[] = Customer::whereMonth('created_at', $m)->count();
    }

    return view('admin.report', compact(
        'revenue', 'totalOrders', 'totalCustomers', 'totalSold',
        'topProducts', 'mostViewedProducts', 'lowStock', 'topCustomers',
        'labels', 'revenueData', 'orderStatusData', 'paymentData',
        'newCustomerData', 'from', 'to', 'type'
    ));
}
}
