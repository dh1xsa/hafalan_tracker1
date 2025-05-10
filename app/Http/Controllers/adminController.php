<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;
use App\Models\user;

class adminController extends Controller
{
    public function dashboard()
    {
        $user = user::where('level', 2)->get();
        $student = student::with('user')->get();

        return view('admin.dashboard-user', compact('user', 'student'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $validated['level'] = 2;

        if (user::create($validated)) {
            return redirect()->route('admin-user-dashboard')->with('success', 'Data berhasil diperbarui');
        }

        return back()->with('error', 'Gagal memperbarui data');
    }

    public function edit($id)
    {
        $user = user::findOrFail($id);
        return view('admin.edit-user', compact('user'));
    }

    // Proses update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'     => 'required',
        ]);

        $user = user::findOrFail($id);
        $user->update([
            'name'     => $request->name,
        ]);

        return redirect()->route('admin-user-dashboard')->with('success', 'Data berhasil diperbarui');
    }

    public function student_dashboard()
    {
        $user = user::where('level', 2)->get();
        $student = student::with('user')->get();

        return view('admin.dashboard-student', compact('user', 'student'));
    }

    public function student_store(Request $request)
    {
        $validated = $request->validate([
            'user_id'=> 'required',
            'name' => 'required',
            'password' => 'required',
        ]);        

        if (student::create($validated)) {
            return redirect()->route('admin-student-dashboard')->with('success', 'Data berhasil diperbarui');
        }

        return back()->with('error', 'Gagal memperbarui data');
    }

    public function student_edit($id)
    {
        $student = student::findOrFail($id);
        $user = user::all();
        return view('admin.edit-student', compact('student','user'));
    }

    // Proses update data
    public function student_update(Request $request, $id)
    {
        $request->validate([
            'user_id'     => 'required',
            'name'     => 'required',
        ]);

        $hafalan = user::findOrFail($id);
        $hafalan->update([
            'user_id'     => $request->user_id,
            'name'     => $request->name,
        ]);

        return redirect()->route('admin-student-dashboard')->with('success', 'Data berhasil diperbarui');
    }
}
