<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;
use App\Models\hafalan;
use App\Models\Group;

class studentController extends Controller
{
    public function dashboard()
    {
        $students = Student::with('group.users') // penting untuk eager load guru
            ->where('id', session('student_id'))
            ->get();

        $hafalan = Hafalan::with('student') // supaya bisa akses $item->student->name
            ->where('student_id', session('student_id'))
            ->get();

        $groups = Group::with('users')->get();

        return view('student.dashboard', compact('students', 'hafalan', 'groups'));
    }


    public function search(Request $request)
    {
        $keyword = $request->query('q', '');
        $userId  = session('user_id');

        // Hanya cari murid milik guru yang sedang login
        $students = Student::where('user_id', $userId)
            ->where('name', 'LIKE', "%{$keyword}%")
            ->get(['id', 'name']);

        return response()->json($students);
    }

    public function edit($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return redirect()->route('student-dashboard')->with('error', 'Account not found');
        }

        $groups = Group::all();  // <-- pastikan ini ada
        return view('student.edit', compact('student', 'groups'));  // <-- kirim variabel groups ke view
    }

    public function update(Request $request, $id)
    {
        $student = Student::where('id', $id)->first();

        if (!$student) {
            return redirect()->route('student-dashboard')->with('error', 'Account not found');
        }
        $request->validate([
            'name' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
        ]);
        $student->update($request->all());
        return redirect()->route('student-dashboard')->with('success', 'Profile berhasil di update');
    }
    public function show($id)
    {
        // Ambil data murid beserta relasi group dan users
        $data = Student::with(['group.users'])->findOrFail($id);

        // Tampilkan view 'student-profil' dengan data
        return view('student-profil', compact('data'));
    }
}
