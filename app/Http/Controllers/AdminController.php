<?php

namespace App\Http\Controllers;

use App\Models\UserExam;
use Illuminate\Http\Request;
use App\Http\Controllers\ExamController;

class AdminController extends Controller
{
    public function index()
    {
        $active = 'admin';
        $examController = new ExamController();
        $examController->checkAndUpdateExpiredExams();

        $userExams = UserExam::with('user', 'exam')->get();
        return view('admin.index', compact('userExams', 'active'));
    }
}