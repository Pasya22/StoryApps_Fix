<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode;
use Illuminate\Support\Facades\Auth;


class AuthenticateDashboard
{


    public function handle(Request $request, Closure $next)
    {

        if (auth()->user()->id_role == 1) {
            if (Auth::check()) {
                return $next($request);
            } else {
                if ($request->ajax()) {
                    return response()->json(['success' => false, 'message' => 'Please login!']);
                } else {
                    return redirect()->route('LoginAdmin');
                }
            }
        } else if (auth()->user()->id_role == 2) {
            if (Auth::check()) {

                if ($request->is('writter/*')) {
                    if ($request->ajax()) {
                        return response()->json(['success' => false, 'message' => 'Please login!']);
                    } else {
                        return redirect()->route('writter');
                    }
                }

            } else {
                if ($request->ajax()) {
                    return response()->json(['success' => false, 'message' => 'Please login!']);
                } else {
                    return redirect()->route('LoginUser');
                }
            }
        } else if (auth()->user()->id_role == 3) {
            if (Auth::check()) {

                if (!$request->is('writter')) {
                    if ($request->ajax()) {
                        return response()->json(['success' => false, 'message' => 'Please login!']);
                    } else {
                        return redirect()->route('StoryApps');
                    }
                }

            } else {
                if ($request->ajax()) {
                    return response()->json(['success' => false, 'message' => 'Please login!']);
                } else {
                    return redirect()->route('LoginUser');
                }
            }
        }
    }

}
