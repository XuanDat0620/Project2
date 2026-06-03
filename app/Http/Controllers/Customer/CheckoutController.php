<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!session()->has('customer')) {
            return redirect()->route('customer.login')
                ->with('error','Vui lòng đăng nhập để thanh toán');
        }
        $cart = session()->get('cart', []);
        $cartItems = [];
        $total = 0;

        foreach ($cart as $item) {

            $product = Product::find($item['product_id']);

            $variant = ProductVariant::where('p_id', $item['product_id'])
                ->where('size_id', $item['size_id'])
                ->where('color_id', $item['color_id'])
                ->first();

            if ($product && $variant) {
                $subtotal = $variant->pv_price * $item['quantity'];
                $total += $subtotal;

                $cartItems[] = [
                    'product' => $product,
                    'variant' => $variant,
                    'quantity' => $item['quantity'],
                    'subtotal' => $subtotal
                ];
            }
        }

        return view('customer.checkout', compact('cartItems', 'total'));
    }
    public function process(Request $request)
    {
        if (!session()->has('customer')) {
            return redirect()->route('customer.login')
                ->with('error','Vui lòng đăng nhập để thanh toán');
        }
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'payment' => 'required',
        ]);

        $cart = session()->get('cart', []);

        if(empty($cart)){
            return back()->with('error', 'Giỏ hàng trống');
        }

        $customer = session('customer');

        DB::beginTransaction();

        try {

            $order = Order::create([
                'cus_id' => $customer->cus_id,
                'ord_code' => 'DH' . time(),
                'ord_receiver_name' => $request->name,
                'ord_receiver_phone' => $request->phone,
                'ord_receiver_address' => $request->address,
                'ord_note' => $request->note,
                'ord_total_price' => 0,
                'ord_buy_date' => now(),
                'ord_status' => 'pending'
            ]);

            $total = 0;

            foreach ($cart as $item) {

                $variant = ProductVariant::where('p_id', $item['product_id'])
                    ->where('size_id', $item['size_id'])
                    ->where('color_id', $item['color_id'])
                    ->first();

                if(!$variant) continue;

                $subtotal = $variant->pv_price * $item['quantity'];

                OrderDetail::create([
                    'ord_id' => $order->ord_id,
                    'pv_id' => $variant->pv_id,
                    'ord_detail_quantity' => $item['quantity'],
                    'ord_detail_price' => $variant->pv_price
                ]);

                $total += $subtotal;
            }

            $order->update([
                'ord_total_price' => $total
            ]);
            Payment::create([
                'ord_id' => $order->ord_id,
                'pm_id' => $request->payment == 'cod' ? 1 : 2,
                'pay_amount' => $total,
                'pay_status' => 'pending'
             ]);

            session()->forget('cart');

            DB::commit();

            return redirect()->route('customer.success', ['id' => $order->ord_id]);

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage()); 
        }
    }
}
