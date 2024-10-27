<?php

namespace App\Http\Controllers;

use App\Models\UserExam;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $active = 'admin';
        $userExams = UserExam::with('user', 'exam')->get();

        return view('admin.index', compact('userExams', 'active'));
    }
}
