<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;
use App\Models\hafalan;
use Barryvdh\DomPDF\Facade\Pdf;

class userController extends Controller
{
    public function dashboard()
    {
        $userId = session('user_id');

        // Ambil semua grup yang dimiliki guru (user) ini, beserta murid-muridnya
        $groups = \App\Models\Group::whereHas('users', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->with(['students' => function ($query) use ($userId) {
                $query->where('user_id', $userId)->orderBy('name');
            }])
            ->orderBy('groups_name')
            ->get();

        // Hafalan milik guru, jika dibutuhkan
        $hafalan = \App\Models\Hafalan::where('user_id', $userId)->with('student')->get();

        return view('user.dashboard', compact('groups', 'hafalan'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'  => 'required|exists:students,id',
            'hafalan'     => 'required|string',
            'description' => 'required|string',
            'date'        => 'required|date',
            'status'      => 'required|in:belum,proses,selesai,perlu diulang',
            'score'       => 'nullable|integer|min:0|max:100',
        ]);

        $user_id = session('user_id');
        $student = Student::where('id', $validated['student_id'])->where('user_id', $user_id)->firstOrFail();

        $validated['user_id'] = $user_id;
        $validated['group_id'] = $student->group_id;

        if (Hafalan::create($validated)) {
            return redirect()->route('user-dashboard')->with('success', 'Data berhasil disimpan.');
        }

        return back()->with('error', 'Gagal menyimpan data.');
    }

    public function show($student_id)
    {
        $hafalan = hafalan::where('user_id', session('user_id'))->where('student_id', $student_id)->with(['student', 'user'])->get();

        return view('user.student-detail', compact('hafalan'));
    }

    public function edit($id)
    {
        $hafalan = Hafalan::findOrFail($id);
        return view('user.edit-hafalan', compact('hafalan'));
    }

    // Proses update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'hafalan'     => 'required',
            'description' => 'required',
            'date'        => 'required|date',
            'student_id' => 'required',
        ]);

        $student_id = $request->student_id;

        $hafalan = Hafalan::findOrFail($id);
        $hafalan->update([
            'hafalan'     => $request->hafalan,
            'description' => $request->description,
            'date'        => $request->date,
        ]);

        return redirect()->route('student-detail', ['student_id' => $student_id])->with('success', 'Data berhasil diperbarui');
    }


    public function destroy($id)
    {
        $hafalan = hafalan::findOrFail($id);
        $hafalan->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function exportPDF($student_id)
    {
        $hafalan = hafalan::where('user_id', session('user_id'))
            ->where('student_id', $student_id)
            ->with(['student', 'user'])
            ->get();

        if ($hafalan->isEmpty()) {
            return redirect()->back()->with('error', 'Data hafalan tidak ditemukan.');
        }

        $student = $hafalan->first()->student;

        $pdf = Pdf::loadView('user.pdf-hafalan', compact('hafalan', 'student'));
        return $pdf->download('Hafalan_' . $student->name . '.pdf');
    }

    public function search(Request $request)
    {
        $keyword = $request->query('q');

        $students = Student::where('user_id', session('user_id'))
            ->where('name', 'LIKE', "%{$keyword}%")
            ->orderBy('name')
            ->get();

        return response()->json($students);
    }
}
