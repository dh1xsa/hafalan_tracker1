<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;
use App\Models\user;
use App\Models\group;

class adminController extends Controller
{
    public function dashboard()
    {
        // Ambil semua guru (user dengan level 2), indeks berdasarkan group_id
        $user = User::where('level', 2)->get()->keyBy('group_id');

        // Ambil semua murid, kelompokkan berdasarkan group_id
        $student = Student::orderBy('group_id')->orderBy('name')->get()->groupBy('group_id');

        return view('admin.dashboard-user', compact('user', 'student'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'password' => 'required|min:6',
            'kelas' => 'required|in:A,B,C',
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
        // Ambil semua guru (user level 2), lalu indeks berdasarkan group_id
        $guru = user::where('level', 2)->get()->keyBy('group_id');

        // Ambil semua siswa, lalu kelompokkan berdasarkan group_id
        $students = student::orderBy('group_id')
            ->orderBy('name')
            ->get()
            ->groupBy('group_id');

        return view('admin.dashboard-student', compact('students', 'guru'));
    }

    public function student_store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'password' => 'required',
            'birth_date' => 'required|date',
            'gender' => 'required|in:L,P',
        ]);

        if (student::create($validated)) {
            return redirect()->route('admin-student-dashboard')->with('success', 'Data berhasil diperbarui');
        }

        return back()->with('error', 'Gagal memperbarui data');
    }

    public function student_edit($id)
    {
        $student = Student::findOrFail($id);
        $user = User::where('level', 2)->get();
        return view('admin.edit-student', compact('student', 'user'));
    }

    public function student_update(Request $request, $id)
    {
        $request->validate([
            'user_id'    => 'required|exists:users,id',
            'name'       => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender'     => 'required|in:L,P',
        ]);

        $student = Student::findOrFail($id);
        $student->update([
            'user_id'    => $request->user_id,
            'name'       => $request->name,
            'birth_date' => $request->birth_date,
            'gender'     => $request->gender,
        ]);

        return redirect()->route('admin-student-dashboard')->with('success', 'Data berhasil diperbarui');
    }

    public function group_dashboard(){
        $groups = Group::all();
        return view('admin.dashboard-group', compact('groups'));
    }

    public function group_store(Request $request){
        $validated = $request->validate([
            'groups_name' => 'required|max:20',
        ]);

        if (Group::create($validated)) {
            return redirect()->route('admin-group-dashboard')->with('success', 'Data berhasil diperbarui');
        }

        return back()->with('error', 'Gagal memperbarui data');
    }

    public function group_destroy($id){
        $groups = Group::find($id);

        if(!$groups){
            return redirect()->route('admin-group-dashboard')->with('error', 'User not found');
        }

        $groups->delete();
        return redirect()->route('admin-group-dashboard')->with('success', 'Data deleted successfully');
    }

}
