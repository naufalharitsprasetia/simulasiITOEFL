<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\ExamController;

class AuthController extends Controller
{
    public function login()
    {
        $active = "login";
        return view('auth.login', compact('active'));
    }
    public function register()
    {
        $active = "register";
        return view('auth.register', compact('active'));
    }
    public function authenticate(Request $request)
    {
        $request->validate([
            'username_or_email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = null;
        if (filter_var($request->input('username_or_email'), FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $request->input('username_or_email'))->first();
        } else {
            $user = User::where('username', $request->input('username_or_email'))->first();
        }

        if ($user) {
            if (Hash::check($request->input('password'), $user->password)) {
                $examController = new ExamController();
                $examController->checkAndUpdateExpiredExams();
                Auth::login($user);
                Alert::alert('Success', 'Congratulations! You have successfully logged in!', 'success');
                return redirect()->intended('/')->with('success', 'Login successful!');
            } else {
                return back()->withErrors([
                    'password' => 'Password Invalid.',
                ])->withInput();
            }
        } else {
            return back()->withErrors([
                'username_or_email' => 'Username or Email not found.',
            ])->withInput();
        }
        // Alert::alert('Berhasil', 'selamat ! anda berhasil masuk !', 'success');
    }

    public function logout(Request $request)
    {

        $title = 'Do you want to Logout !';
        $text = "make sure all progress is saved!";
        confirmDelete($title, $text);

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect('/login')->with('success', 'Registration successful, please login.');
    }
}