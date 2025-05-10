<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class redirectIfLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('user_id') || session()->has('student_id')) {
            if (session()->has('user_id')) {
                $level = session('user_level');
                switch ($level) {
                    case 1:
                        return redirect()->route('admin-dashboard');
                    case 2:
                        return redirect()->route('user-dashboard');
                }
            } else {
                return redirect()->route('student-dashboard');
            }
        }

        return $next($request);
    }
}
