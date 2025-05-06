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
        $student = student::all();

        return view('admin.dashboard',compact('user','student'));
    }
}
