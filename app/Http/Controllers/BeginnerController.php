<?php

namespace App\Http\Controllers;

use App\Models\Answer;
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
        $page = request()->get('page', 1); // Mengambil nilai page dari request

        // Ambil jawaban dari database untuk pengguna yang sedang login
        $answers = Answer::where('user_id', auth()->id())->pluck('answer', 'question_id')->toArray();

        // Menghitung jumlah file
        $directory = resource_path('views/beginner/partials');
        $files = array_diff(scandir($directory), ['..', '.']);
        $fileCount = count($files);
        $viewName = 'beginner.partials.page' . $page;

        if (view()->exists($viewName)) {
            return view('beginner.exam', compact('active', 'page', 'fileCount', 'answers'));
        } else {
            return redirect()->back()->with('error', 'Halaman yang diminta tidak ada');
        }
    }

    public function submit(Request $request)
    {
        // Ambil jawaban dari input
        $answers = $request->input('answers', []);

        // Jika tidak ada jawaban yang dikirimkan, langsung redirect ke halaman berikutnya
        $currentPage = $request->input('pageNow');
        if (empty($answers)) {
            // dd($currentPage);
            return redirect()->route('beginner.exam', ['page' => $currentPage + 1]);
        }

        // Validasi jawaban
        $validated = $request->validate([
            'answers.*' => 'nullable|string', // Validasi jawaban
        ]);

        // Simpan jawaban ke database
        foreach ($validated['answers'] as $questionId => $answer) {
            // Simpan ke dalam database
            Answer::updateOrCreate(
                ['user_id' => auth()->id(), 'question_id' => $questionId],
                ['answer' => $answer]
            );
        }

        // Redirect ke halaman selanjutnya
        return redirect()->route('beginner.exam', ['page' => $currentPage + 1]);
    }
}