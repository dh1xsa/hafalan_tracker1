<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;
use Illuminate\Support\Facades\Hash;

class studentLoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.studentLogin');
    }

    public function login(Request $request)
    {
        $student = student::where('name', $request->name)->first();

        if (!$student || !Hash::check($request->password, $student->password)) {
            return back()->with('error', 'Login gagal.');
        }

        session(['student_id' => $student->id]);
        return redirect('/student-dashboard');
    }

    public function logout()
    {
        session()->forget('student_id');
        return redirect('/');
    }
}
