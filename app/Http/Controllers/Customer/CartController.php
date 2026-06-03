<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        $cartItems = [];

        foreach ($cart as $key => $item) {

            $product = Product::find($item['product_id']);

            $variant = ProductVariant::where('p_id', $item['product_id'])
                ->where('size_id', $item['size_id'])
                ->where('color_id', $item['color_id'])
                ->first();

            if ($product && $variant) {
                $cartItems[] = [
                    'product' => $product,
                    'variant' => $variant,
                    'quantity' => $item['quantity']
                ];
            }
        }

        return view('customer.cart', compact('cartItems'));
    }

    public function add(Request $request)
    {
        $cart = session()->get('cart', []);

        $key = $request->product_id . '_' . $request->size_id . '_' . $request->color_id;

        if(isset($cart[$key])){
            $cart[$key]['quantity'] += $request->quantity;
        }else{
            $cart[$key] = [
                'product_id' => $request->product_id,
                'size_id' => $request->size_id,
                'color_id' => $request->color_id,
                'quantity' => $request->quantity,
            ];
        }

        session()->put('cart', $cart);

        // phân biệt nút
        if($request->action == 'buy_now'){
            return redirect()->route('customer.checkout');
        }

        return back()->with('success', 'Đã thêm vào giỏ hàng');
    }
    public function update(Request $request)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$request->key])){
            $cart[$request->key]['quantity'] = $request->quantity;
        }

        session()->put('cart', $cart);

        return back();
    }
    public function delete(Request $request)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$request->key])){
            unset($cart[$request->key]);
        }

        session()->put('cart', $cart);

        return back();
    }
}
