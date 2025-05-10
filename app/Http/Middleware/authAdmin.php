<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class authAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user login dan level = 1 (admin/guru misalnya), lanjut
        if (session()->has('user_id') && session('user_level') == 1) {
            return $next($request);
        }

        // Jika user belum login
        if (!session()->has('user_id')) {
            return redirect('/user-login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Jika yang login adalah student, redirect ke login student
        if (session()->has('student_id')) {
            return redirect('/student-login')->with('error', 'Silakan login sebagai guru.');
        }

        // Default redirect jika login tapi bukan level 1
        return redirect('/user-dashboard');
    }
}
