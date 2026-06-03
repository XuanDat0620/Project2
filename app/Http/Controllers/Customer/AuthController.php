<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('customer.login');
    }

    public function login(Request $request)
    {
        $customer = Customer::where('cus_name', $request->cus_name)->first();

        if ($customer && Hash::check($request->cus_password, $customer->cus_password)) {
            session(['customer' => $customer]);
            return redirect()->route('customer.home');
        }

        return back()->with('error', 'Sai tài khoản hoặc mật khẩu');
    }
    public function showRegister()
    {
        return view('customer.register');
    }

    public function register(Request $request)
    {
        if ($request->cus_password != $request->re_password) {
            return back()->with('error', 'Mật khẩu không khớp');
        }

        Customer::create([
            'cus_name' => $request->cus_name,
            'cus_phone' => $request->cus_phone,
            'cus_address' => $request->cus_address,
            'cus_email' => $request->cus_email,
            'cus_password' => Hash::make($request->cus_password),
        ]);

        return redirect()->route('customer.login')->with('success', 'Đăng ký thành công');
    }
    public function logout()
    {
        session()->forget('customer');
        return redirect()->route('customer.login');
    }
}
