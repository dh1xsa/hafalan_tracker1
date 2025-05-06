<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class userLoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.userLogin');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cari user
        $user = User::where('name', $request->name)->first();

        // Validasi password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login' => 'Nama atau password salah.'])->withInput();
        }

        // Simpan sesi
        session(['user_id' => $user->id, 'user_level' => $user->level]);

        // Redirect berdasarkan level
        switch ($user->level) {
            case 1:
                return redirect('/admin-dashboard')->with('success', 'Login sebagai Admin berhasil!');
            case 2:
                return redirect('/user-dashboard')->with('success', 'Login sebagai Guru berhasil!');
        }
    }

    public function logout()
    {
        session()->forget(['user_id', 'user_level']);
        return redirect('/user-login')->with('success', 'Berhasil logout.');
    }
}
