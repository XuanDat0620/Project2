<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        // tìm theo tên
        if ($request->keyword) {
            $query->where('cus_name', 'like', '%' . $request->keyword . '%');
        }

        // lọc trạng thái
        if ($request->status) {
            $query->where('cus_status', $request->status);
        }

        $customers = $query->paginate(10);

        return view('admin.customers.list', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cus_name' => 'required',
            'cus_email' => 'required|email|unique:customers,cus_email',
            'cus_password' => 'required|min:6',
        ]);

        Customer::create([
            'cus_name' => $request->cus_name,
            'cus_email' => $request->cus_email,
            'cus_password' => Hash::make($request->cus_password),
            'cus_phone' => $request->cus_phone,
            'cus_gender' => $request->cus_gender,
            'cus_address' => $request->cus_address,
            'cus_dob' => $request->cus_dob,
            'cus_status' => $request->cus_status ?? 'active',
        ]);

        return redirect()->route('admin.customers.list')
            ->with('success', 'Thêm khách hàng thành công');
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return view('admin.customers.detail', compact('customer'));
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id); // lấy user theo id
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
{
    $customer = Customer::findOrFail($id);

    $customer->cus_name = $request->cus_name;
    $customer->cus_email = $request->cus_email;
    $customer->cus_phone = $request->cus_phone;
    $customer->cus_gender = $request->cus_gender;
    $customer->cus_address = $request->cus_address;
    $customer->cus_dob = $request->cus_dob;
    $customer->cus_status = $request->cus_status;

    if ($request->cus_password) {
        $customer->cus_password = bcrypt($request->cus_password);
    }

    $customer->save();

    return redirect()->route('admin.customers.list')->with('success', 'Cập nhật thành công');
}

    public function delete($id)
    {
        Customer::destroy($id);

        return redirect()->route('admin.customers.list') ->with('success', 'Xóa thành công');
    }
}
