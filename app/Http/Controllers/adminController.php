<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\Group;
use App\Models\group_user;

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
            'birth_date'     => 'required',
            'gender'     => 'required',
        ]);

        $user = user::findOrFail($id);
        $user->update([
            'name'     => $request->name,
            'birth_date'     => $request->birth_date,
            'gender'     => $request->gender,
        ]);

        return redirect()->route('admin-user-dashboard')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $user = user::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
    // masuk student
    public function student_dashboard()
    {
        // Ambil guru yang memang punya relasi ke grup (melalui pivot group_user)
        $guru = User::where('level', 2)
            ->whereHas('groups') // hanya guru yang punya relasi ke group_user
            ->with('groups')     // load relasi agar bisa dipakai langsung di view
            ->get();

        $groups = Group::orderBy('groups_name')->get();

        // Ambil murid dan kelompokkan berdasarkan group_id
        $students = Student::orderBy('group_id')
            ->orderBy('name')
            ->get()
            ->groupBy('group_id');

        return view('admin.dashboard-student', compact('students', 'guru', 'groups'));
    }

    public function getGroupsByGuru($user_id)
    {
        // Ambil semua grup yang memiliki user (guru) ini
        $groups = Group::whereHas('users', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->get();

        return response()->json($groups);
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
            'user_id'    => $request->user_id, // tambahkan ini!
            'group_id'   => $request->group_id,
            'name'       => $request->name,
            'password' => $request->password,
            'birth_date' => $request->birth_date,
            'gender'     => $request->gender,
        ]);


        return redirect()->route('admin-student-dashboard')->with('success', 'Murid berhasil ditambahkan.');
    }

    public function student_edit($id)
    {
        $student = Student::with('group.users')->findOrFail($id);

        // Ambil semua guru yang memiliki relasi ke grup
        $guru = User::where('level', 2)
            ->whereHas('groups')
            ->with('groups')
            ->get();

        // Ambil semua grup
        $groups = Group::orderBy('groups_name')->get();

        return view('admin.edit-student', compact('student', 'guru', 'groups'));
    }


    public function student_update(Request $request, $id)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'group_id'    => 'required|exists:groups,id',
            'name'        => 'required|string|max:255',
            'password'    => 'nullable|string|min:6', // opsional, hanya jika ingin diubah
            'birth_date'  => 'required|date',
            'gender'      => 'required|in:L,P',
        ]);

        $student = Student::findOrFail($id);

        $student->user_id     = $request->user_id;
        $student->group_id    = $request->group_id;
        $student->name        = $request->name;
        $student->birth_date  = $request->birth_date;
        $student->gender      = $request->gender;

        if ($request->filled('password')) {
            $student->password = bcrypt($request->password);
        }

        $student->save();

        return redirect()->route('admin-student-dashboard')->with('success', 'Data murid berhasil diperbarui.');
    }


    public function student_destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
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

    public function group_edit($id)
    {
        $group = group_user::with('group', 'user')->find($id);
        $users = User::where('level', 2)->get();

        return view('admin.edit-group', compact('group', 'users'));
    }

    public function group_update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
        ]);

        $group = group_user::findOrFail($id);
        $group->update([
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('admin-group-dashboard')->with('success', 'Data berhasil diperbarui');
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
