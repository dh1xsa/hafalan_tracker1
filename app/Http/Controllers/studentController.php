<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;
use App\Models\hafalan;

class studentController extends Controller
{
    public function dashboard(){
        $student = student::where('id', session('student_id'))->get();
        $hafalan = hafalan::where('student_id', session('student_id'))->get();

        return view('student.dashboard',compact('student','hafalan'));
    }
    public function search(Request $request)
    {
        $keyword = $request->query('q', '');
        $userId  = session('user_id');

        // Hanya cari murid milik guru yang sedang login
        $students = Student::where('user_id', $userId)
            ->where('name', 'LIKE', "%{$keyword}%")
            ->get(['id','name']);

        return response()->json($students);
    }
}
