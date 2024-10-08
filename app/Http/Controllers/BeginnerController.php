<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BeginnerController extends Controller
{
    public function index()
    {
        $active = 'simulasi';
        return view('beginner.index',  compact('active'));
    }
    public function exam()
    {
        $active = 'examination';
        $page = '1';

        // Cek apakah ada parameter 'page' di URL
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }

        // Path untuk folder resources/beginner/partials
        $directory = resource_path('views/beginner/partials');

        // Menghitung jumlah file yang ada di folder tersebut
        $files = array_diff(scandir($directory), ['..', '.']); // Ambil isi folder, kecuali '.' dan '..'
        $fileCount = count($files); // Hitung jumlah file

        // Menentukan nama view berdasarkan halaman yang dipilih
        $viewName = 'beginner.partials.page' . $page;

        // Cek apakah view tersebut ada
        if (view()->exists($viewName)) {
            return view('beginner.exam', compact('active', 'page', 'fileCount'));
        } else {
            // Redirect dengan pesan error jika view tidak ditemukan
            return redirect()->back()->with('error', 'Halaman yang diminta tidak ada');
        }
    }

    // public function saveAnswer(Request $request)
    // {
    //     $userAnswer = $request->input('answer');
    //     $questionId = $request->input('question_id');

    //     // Logika untuk menyimpan jawaban ke database atau session
    //     Answer::updateOrCreate(
    //         ['user_id' => auth()->id(), 'question_id' => $questionId],
    //         ['answer' => $userAnswer]
    //     );

    //     // Kirim respons dengan ID soal berikutnya
    //     return response()->json(['success' => true, 'nextQuestionId' => $request->input('next_question_id')]);
    // }
    // public function getNextQuestion($id)
    // {
    //     $question = Question::find($id);
    //     return view('partials.question', compact('question'))->render(); // Return partial view
    // }
}