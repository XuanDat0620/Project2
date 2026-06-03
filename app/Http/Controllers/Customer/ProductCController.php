<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductCController extends Controller
{
    public function list(Request $request)
    {
        $query = Product::query();

        // lọc theo gender
        if ($request->gender) {
            $query->where('gender', $request->gender);
        }

        // lọc theo mùa
        if ($request->season) {
            $query->where('season', $request->season);
        }

        $products = $query->get();
        $title = 'Tất cả sản phẩm';
        if ($request->gender == 'nam') $title = 'Thời trang nam';
        if ($request->gender == 'nu') $title = 'Thời trang nữ';
        if ($request->gender == 'tre-em') $title = 'Thời trang trẻ em';

        return view('customer.products', compact('products','title'));
    }

    public function detail($id)
    {
        $product = Product::with(['variants.size', 'variants.color'])
            ->where('p_id', $id)
            ->where('p_status', 'active')
            ->firstOrFail();

        // sản phẩm tương tự
        $relatedProducts = Product::with('variants')
            ->where('cate_id', $product->cate_id)
            ->where('p_id', '!=', $id)
            ->take(4)
            ->get();

        return view('customer.product_detail', compact('product', 'relatedProducts'));
    }
}
