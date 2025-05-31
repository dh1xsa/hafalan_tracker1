<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\Group;

class adminController extends Controller
{
    public function dashboard()
    {
        $users = User::where('level', 2)->with('groups')->get();
        $groups = Group::all();

        return view('admin.dashboard-user', compact('users', 'groups'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'password' => 'required|min:6',
            'birth_date' => 'required|date',
            'gender' => 'required|in:L,P',
        ]);

        User::create([
            'name' => $validated['name'],
            'password' => bcrypt($validated['password']),
            'birth_date' => $validated['birth_date'],
            'gender' => $validated['gender'],
            'level' => 2,
        ]);

        return redirect()->route('admin-user-dashboard')->with('success', 'Guru berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $groups = Group::all(); // Ambil semua kelas

        return view('admin.edit-user', compact('user', 'groups'));
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

    // masuk student
    public function student_dashboard()
    {
        $guru = User::where('level', 2)->get()->keyBy('group_id');
        $groups = Group::orderBy('name')->get();

        $students = Student::orderBy('group_id')
            ->orderBy('name')
            ->get()
            ->groupBy('group_id');

        return view('admin.dashboard-student', compact('students', 'guru', 'groups'));
    }
    public function student_store(Request $request)
    {
        $request->validate([
            'user_id'    => 'required|exists:users,id',
            'group_id'   => 'required|exists:groups,id',
            'name'       => 'required|string|max:255',
            'password'   => 'required|string|min:6',
            'birth_date' => 'required|date',
            'gender'     => 'required|in:L,P',
        ]);

        Student::create([
            'group_id'   => $request->group_id,
            'name'       => $request->name,
            'password'   => bcrypt($request->password),
            'birth_date' => $request->birth_date,
            'gender'     => $request->gender,
        ]);

        return redirect()->route('admin-student-dashboard')->with('success', 'Murid berhasil ditambahkan.');
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
    // masuk ke group
    public function group_dashboard()
    {
        $groups = Group::with('users')->get();
        $users = User::where('level', 2)->get();

        return view('admin.dashboard-group', compact('groups', 'users'));
    }

    public function group_store(Request $request)
    {
        $validated = $request->validate([
            'groups_name' => 'required|max:20',
            'user_id' => 'required|exists:users,id'
        ]);

        // Buat grupnya dulu
        $group = Group::create([
            'groups_name' => $validated['groups_name'],
        ]);

        // Tambahkan guru ke pivot table
        $group->users()->attach($validated['user_id']);

        return redirect()->route('admin-group-dashboard')->with('success', 'Kelas berhasil dibuat');
    }

    public function group_destroy($id)
    {
        $groups = Group::find($id);

        if (!$groups) {
            return redirect()->route('admin-group-dashboard')->with('error', 'User not found');
        }

        $groups->delete();
        return redirect()->route('admin-group-dashboard')->with('success', 'Data deleted successfully');
    }
}
