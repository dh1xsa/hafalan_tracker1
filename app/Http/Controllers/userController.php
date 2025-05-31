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
        $students = Student::where('user_id', session('user_id'))->orderBy('name')->get();
        $hafalan = Hafalan::where('user_id', session('user_id'))->with('student')->get();

        return view('user.dashboard', compact('students', 'hafalan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'hafalan' => 'required',
            'description' => 'required',
            'date' => 'required|date',
        ]);

        $student = \App\Models\Student::find($validated['student_id']);

        $validated['user_id'] = session('user_id');
        $validated['group_id'] = $student->group_id; // <--- tambahkan ini

        if (\App\Models\hafalan::create($validated)) {
            return redirect()->route('user-dashboard')->with('success', 'Data berhasil diperbarui');
        }

        return back()->with('error', 'Gagal memperbarui data');
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
        $students = \App\Models\Student::where('name', 'LIKE', "%{$keyword}%")->get();

        return response()->json($students);
    }
}
