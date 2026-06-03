<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
   public function index(Request $request)
    {
        // $userses = Ur :: all();
    //     // dd($users);
    // return view('admin.users.list', compact('users'));
    $query = User::query();

    // Tìm kiếm theo tên
    if ($request->keyword) {
        $query->where('u_name', 'like', '%' . $request->keyword . '%');
    }

    // Lọc theo role
    if ($request->role) {
        $query->where('u_role', $request->role);
    }

    $users = $query->paginate(10);

    return view('admin.users.list', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'u_name' => 'required|string|max:255',
        'u_email' => 'required|email|unique:users,u_email',
        'u_password' => 'required|min:6',
        'u_phone' => 'nullable',
        'u_gender' => 'nullable',
        'u_address' => 'nullable',
        'u_dob' => 'nullable|date',
        'u_role' => 'required',
        'u_status' => 'required',
    ]);
    User::create([
        'u_name' => $request->u_name,
        'u_email' => $request->u_email,
        'u_password' => Hash::make($request->u_password),
        'u_phone' => $request->u_phone,
        'u_gender' => $request->u_gender,
        'u_address' => $request->u_address,
        'u_dob' => $request->u_dob,
        'u_role' => $request->u_role,
        'u_status' => $request->u_status,
    ]);

    // Redirect
    return redirect()->route('admin.users.list')->with('success', 'Thêm người dùng thành công');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.detail', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // lấy user theo id
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request,$id)
    {
    $user = User::findOrFail($id);
    $user->u_name = $request->u_name;
    $user->u_email = $request->u_email;
    $user->u_phone = $request->u_phone;
    $user->u_gender = $request->u_gender;
    $user->u_address = $request->u_address;
    $user->u_dob = $request->u_dob;
    $user->u_role = $request->u_role;
    $user->u_status = $request->u_status;

    if($request->u_password){
        $user->u_password = bcrypt($request->u_password);
    }
    $user->save();
    return redirect()->route('admin.users.list')->with('success', 'Cập nhật thành công');
    }

    public function delete($id)
    {
        User::destroy($id);
        return redirect()->route('admin.users.list')->with('success', 'Xóa thành công');
    }
}