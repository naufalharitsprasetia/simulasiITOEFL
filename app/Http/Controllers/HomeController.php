<?php

namespace App\Http\Controllers;

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
        return view('home.simulasi',  compact('active'));
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
