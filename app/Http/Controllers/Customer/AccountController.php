<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    public function index()
    {
        $customer = session('customer');
        return view('customer.account', compact('customer'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'cus_name' => 'required',
            'cus_email' => 'required|email',
        ]);

        $customer = Customer::find(session('customer')->cus_id);

        $customer->update([
            'cus_name' => $request->cus_name,
            'cus_email' => $request->cus_email,
            'cus_phone' => $request->cus_phone,
            'cus_address' => $request->cus_address,
            'cus_dob' => $request->cus_dob,
            'cus_gender' => $request->cus_gender,
        ]);

        session(['customer' => $customer]);

        return back()->with('success', 'Cập nhật thành công');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            're_password' => 'required',
        ]);

        $customer = Customer::find(session('customer')->cus_id);

        if (!Hash::check($request->old_password, $customer->cus_password)) {
            return back()->with('error', 'Sai mật khẩu hiện tại');
        }

        if ($request->new_password != $request->re_password) {
            return back()->with('error', 'Mật khẩu mới không khớp');
        }

        $customer->update([
            'cus_password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Đổi mật khẩu thành công');
    }
}
