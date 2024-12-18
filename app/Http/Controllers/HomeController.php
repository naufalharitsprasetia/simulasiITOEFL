<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\UserExam;
use Illuminate\Http\Request;
use App\Http\Controllers\ExamController;

class HomeController extends Controller
{
    public function index()
    {
        $active = 'beranda';
        return view('home.index',  compact('active'));
    }
    public function references()
    {
        $active = 'references';
        return view('home.references',  compact('active'));
    }
    public function simulasi()
    {
        $active = 'simulasi';
        $exams = Exam::all();
        return view('home.simulasi',  compact('active', 'exams'));
    }
    public function history()
    {
        $active = 'history';
        $userId = auth()->user()->id;
        $examController = new ExamController();
        $examController->checkAndUpdateExpiredExams();

        // Ambil semua riwayat UserExam untuk user yang sedang login
        $userExams = UserExam::where('user_id', $userId)
            ->with('exam') // Pastikan relasi ke model Exam sudah diatur di model UserExam
            ->orderBy('start_time', 'desc') // Urutkan dari ujian terbaru
            ->get();

        return view('home.history', compact('active', 'userExams'));
    }
}