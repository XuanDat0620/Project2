<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('customer');
        // tìm theo tên hoặc sđt
        if ($request->keyword) {
            $query->where(function ($q) use ($request) {
                $q->where('ord_receiver_name', 'like', '%' . $request->keyword . '%')
                  ->orWhere('ord_receiver_phone', 'like', '%' . $request->keyword . '%');
            });
        }
        // lọc theo ngày
        if ($request->date_from) {
            $query->whereDate('ord_buy_date', '>=', $request->date_from);
        }
        if ($request->date_to) {
            $query->whereDate('ord_buy_date', '<=', $request->date_to);
        }
        // lọc theo trạng thái
        if ($request->status) {
            $query->where('ord_status', $request->status);
        }
        $orders = $query->orderBy('ord_id', 'desc')->paginate(10);
        return view('admin.orders.list', compact('orders'));
    }

     public function show($id)
    {
        $order = Order::with([
            'customer',
            'details.variant.product',
            'details.variant.size',
            'details.variant.color',
            'payment.paymentMethod'
        ])->findOrFail($id);
        return view('admin.orders.detail', compact('order'));
    }

    // UPDATE TRẠNG THÁI
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $currentStatus = $order->ord_status;
        $newStatus = $request->ord_status;

        $validFlow = [
            'pending' => [
                'confirmed',
                'cancelled'
            ],

            'confirmed' => [
                'packing',
                'cancelled'
            ],

            'packing' => [
                'shipping',
                'cancelled'
            ],

            'shipping' => [
                'delivered',
                'cancelled'
            ],

            'delivered' => [],

            'completed' => [],

            'cancelled' => []
        ];

        if (
            $currentStatus != $newStatus &&
            !in_array($newStatus, $validFlow[$currentStatus] ?? [])
        ) {
            return back()->with(
                'error',
                'Không thể chuyển trạng thái không hợp lệ!'
            );
        }

        $order->update([
            'ord_status' => $newStatus
        ]);

        return back()->with(
            'success',
            'Cập nhật trạng thái thành công'
        );
    }
}
