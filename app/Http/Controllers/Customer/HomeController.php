<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = [
            'slider_1.jpg',
            'slider_2.jpg',
            'slider_3.jpg'
        ];
        $newProducts = Product::with(['variants' => function($q) {
                $q->where('pv_status', 'active');
            }])->where('p_status', 'active')->latest()->take(8)->get();

            // demo bán chạy (tạm dùng random)
            $bestProducts = Product::with(['variants' => function($q) {
                $q->where('pv_status', 'active');
            }])->where('p_status', 'active')->inRandomOrder()->take(8)->get();

        return view('customer.home', compact('sliders','newProducts','bestProducts'));

    }
}
