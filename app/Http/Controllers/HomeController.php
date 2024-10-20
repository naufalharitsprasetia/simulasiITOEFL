<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $active = 'beranda';
        return view('home.index',  compact('active'));
    }
    public function simulasi()
    {
        $active = 'simulasi';
        $exams = Exam::all();
        return view('home.simulasi',  compact('active', 'exams'));
    }

    public function about()
    {
        $active = 'about';
        return view('home.about',  compact('active'));
    }

    public function contact()
    {
        $active = 'contact';
        return view('home.contact',  compact('active'));
    }
    public function faq()
    {
        $active = 'faq';
        return view('home.faq',  compact('active'));
    }
    public function dashboard()
    {
        $active = "dashboard";
        return view('admin.dashboard', compact('active'));
    }
}
