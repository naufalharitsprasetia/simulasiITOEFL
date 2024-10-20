<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\UserExam;
use App\Models\Exam;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExamController extends Controller
{
    public function index($id)
    {
        $active = 'simulasi';
        // cek di UserExam Attempt apakah ada file , jika iya kirim kan sebuah varibel yang isinya true
        // cek apakah dia masih dalam proses ujian atau tidak
        $masihBisa = false;

        // Cek apakah $id ada di Exam
        $exam = Exam::find($id);

        if (!$exam) {
            // Jika $id tidak ditemukan, redirect kembali dengan pesan error
            return redirect()->back()->with('error', 'Ujian tidak ditemukan.');
        }


        return view('exam.index',  compact('active', 'masihBisa', 'exam'));
    }
    public function start($id)
    {
        $userId = auth()->user()->id;
        $examId = $id; // pastikan ini dikirim dari request
        $currentDatetime = Carbon::now('Asia/Jakarta');

        // Cek apakah ada UserExam yang aktif untuk user dan exam ini

        $ongoingAttempt = UserExam::where('user_id', $userId)
            ->where('exam_id', $examId)
            ->where('start_time', '<=', $currentDatetime)
            ->where('end_time', '>=', $currentDatetime)
            ->first();

        // dd($currentDatetime);
        // dd($ongoingAttempt);

        if ($ongoingAttempt) {
            // Jika ada attempt yang sedang berjalan, redirect user ke halaman lain
            return redirect()->route('exam.exam', ['user_exam_id' => $ongoingAttempt->id]);
        }

        // Menghitung attempt_number berikutnya
        $latestAttemptNumber = UserExam::where('user_id', $userId)
            ->where('exam_id', $examId)
            ->max('attempt_number');

        $plus2currentDatetime =    $currentDatetime->copy()->addHours(2);
        // Jika tidak ada attempt yang sedang berjalan, buat UserExam baru
        $userExam = UserExam::create([
            'user_id' => $userId,
            'exam_id' => $examId,
            'attempt_number' => $latestAttemptNumber + 1,
            'start_time' => $currentDatetime,
            'end_time' => $plus2currentDatetime, // contoh durasi ujian 2 jam
        ]);

        // Redirect ke halaman ujian baru
        return redirect()->route('exam.exam', ['user_exam_id' => $userExam->id]);
    }
    public function exam()
    {
        $active = 'examination';

        // Cek apakah ada data UserExam punyanya user yang sedang login 


        $page = request()->get('page', 1); // Mengambil nilai page dari request - function submit
        $user_exam_id = request()->get('user_exam_id');

        // Cek File di Direktori
        $directory = resource_path('views/exam/1');
        $files = array_diff(scandir($directory), ['..', '.']);
        $fileCount = count($files);
        $viewName = 'exam.1.page' . $page;
        if (view()->exists($viewName)) {
            return view('exam.exam', compact('active', 'page', 'fileCount', 'user_exam_id'));
        } else {
            return redirect()->back()->with('error', 'Halaman yang diminta tidak ada');
        }
    }

    public function submit(Request $request)
    {
        // Ambil jawaban dari input
        // $answersS1 = $request->input('answers', []);
        $answersS2 = $request->input('section2question.*', []);
        $answersS3 = $request->input('section3question.*', []);
        // Jika tidak ada jawaban yang dikirimkan, langsung redirect ke halaman berikutnya
        $user_exam_id = $request->input('user_exam_id');
        dd($user_exam_id);
        $currentPage = $request->input('pageNow', 1);
        if (empty($answersS2) && empty($answersS3)) {
            return redirect()->route('exam.exam', ['page' => $currentPage + 1]);
        }

        // Validasi jawaban
        $validated = $request->validate([
            'section2question.*' => 'nullable|string', // Validasi jawaban
            'section3question.*' => 'nullable|string', // Validasi jawaban
        ]);

        // Simpan jawaban ke database
        foreach ($validated['section2question'] as $questionId => $answer) {
            // Simpan ke dalam database
            Answer::updateOrCreate(
                [
                    'user_exam_id' => $user_exam_id,
                    'question_id' => $questionId
                ],
                ['answer' => $answer]
            );
        }

        // Redirect ke halaman selanjutnya
        return redirect()->route('exam.exam', ['page' => $currentPage + 1]);
    }
}
