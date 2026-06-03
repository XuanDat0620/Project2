<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderCController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();

        return view('customer.history', compact('orders'));
    }
    public function history()
    {
       $orders = Order::with([
        'details.variant.product'
        ])->latest()->get();

        return view('customer.history', compact('orders'));
    }

    public function detail($id)
    {
        $order = Order::with([
            'customer',
            'payment',
            'payment.paymentMethod',
            'details.variant.product',
            'details.variant.size',
            'details.variant.color'
        ])->findOrFail($id);

        return view('customer.orders', compact('order'));
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);

        if ($order->ord_status != 'pending') {
            return back();
        }

        $order->update([
            'ord_status' => 'cancelled'
        ]);

        return back()->with('success', 'Đã hủy đơn hàng');
    }

    public function complete($id)
    {
        $order = Order::findOrFail($id);

        if ($order->ord_status != 'shipping') {
            return back();
        }

        $order->update([
            'ord_status' => 'completed'
        ]);

        return back()->with('success', 'Đã xác nhận nhận hàng');
    }
}
