<?php

// app/Http/Controllers/StudentLoginController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentLoginController extends Controller
{

    public function showLogin()
    {
        return view('auth.studentLogin');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'name'     => 'required|string',
            'password' => 'required|string',
        ]);

        $student = Student::where('name', $request->name)->first();

        if (!$student || !Hash::check($request->password, $student->password)) {
            return back()->with('error', 'Login gagal: username atau password salah.');
        }

        // Simpan session dan redirect ke dashboard
        session(['student_id' => $student->id]);
        return redirect('/student-dashboard')->with('success', 'Login berhasil! Selamat datang, ' . $student->name);
    }

    public function logout()
    {
        session()->forget('student_id');
        return redirect('/')->with('success', 'Anda telah logout.');
    }


}
