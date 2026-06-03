<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user() ?: Auth::guard('admin')->user();
        //1. Kiểm tra tài khoản đã đăng nhập chưa?
        if(!$user) {
            return redirect()->route('login');
        }
        //2. Kiểm tra role của tài khoản có trong $roles không?
        if(in_array($user->role, $roles)) {
            return $next($request);
        }
        //3. Nếu không có quyền truy cập thì trả về lỗi 403
        abort(403, 'Unauthorized');
    }
}
