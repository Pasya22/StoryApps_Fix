<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
     
        return $request->expectsJson() ? null : route('loginUser');
    }

    // public function handle(Request $request, Closure $next): Response
    // {

    //     if (auth()->user()->id_role == 1) {
    //         if (Auth::check()) {
    //             // Pengguna sudah masuk, izinkan akses ke dashboard
    //             return $next($request);
    //         } else {
    //             return redirect()->route('LoginAdmin');
    //         }
    //     } else {
    //         if (Auth::check()) {
    //             // Pengguna sudah masuk, izinkan akses ke dashboard
    //             return Auth::logout();
    //             // return redirect()->route('LoginUser');
    //         } else {
    //             return redirect()->route('LoginUser');
    //         }
    //     }
    // }
}
