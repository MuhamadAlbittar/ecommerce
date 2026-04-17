<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. التأكد من تسجيل الدخول
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // 2. التحقق مما إذا كان دور المستخدم موجود ضمن الأدوار المسموح بها
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // 3. إذا لم يكن لديه صلاحية، نرجعه للصفحة الرئيسية للمتجر مع رسالة خطأ
        return redirect()->route('store.home')->with('error', 'ليس لديك صلاحية للدخول لهذه الصفحة.');
    }
}
