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
        $masihBisa = false;
        $remainingTime = 0;
        $userId = auth()->user()->id;
        $examId = $id;
        $currentDatetime = Carbon::now('Asia/Jakarta');

        // Cek apakah ada UserExam yang aktif untuk user dan exam ini
        $ongoingAttempt = UserExam::where('user_id', $userId)
            ->where('exam_id', $examId)
            ->where('start_time', '<=', $currentDatetime)
            ->where('end_time', '>=', $currentDatetime)
            ->first();

        if ($ongoingAttempt) {
            $masihBisa = true;
            // Hitung waktu tersisa
            $endDate = Carbon::parse($ongoingAttempt->end_time);
            $remainingTime = $currentDatetime->diffInSeconds($endDate); // Menghitung selisih dalam detik
        }

        $exam = Exam::find($id);
        if (!$exam) {
            return redirect()->back()->with('error', 'Ujian tidak ditemukan.');
        }

        return view('exam.index', compact('active', 'masihBisa', 'exam', 'ongoingAttempt', 'remainingTime'));
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

    public function continue($id)
    {
        return redirect()->route('exam.exam', ['user_exam_id' => $id]);
    }

    public function exam($user_exam_id)
    {
        // Cek dulu apakah $user_exam_id ada di db 
        $active = 'examination';
        $page = request()->get('page', 1); // Mengambil nilai page dari request - function submit
        $currentDatetime = Carbon::now('Asia/Jakarta');

        $userId = auth()->user()->id;
        // Cek apakah ada UserExam yang aktif untuk user dan exam ini
        $ongoingAttempt = UserExam::where('id', $user_exam_id)
            ->where('user_id', $userId)
            ->where('start_time', '<=', $currentDatetime)
            ->where('end_time', '>=', $currentDatetime)
            ->first();

        if ($ongoingAttempt) {
            // Hitung waktu tersisa
            $endDate = Carbon::parse($ongoingAttempt->end_time);
            $remainingTime = $currentDatetime->diffInSeconds($endDate);
        } else {
            // Jika tidak ada attempt yang sedang berlangsung, set waktu tersisa menjadi 0
            $remainingTime = 0;
        }

        // Cek File di Direktori
        $directory = resource_path('views/exam/1');
        $files = array_diff(scandir($directory), ['..', '.']);
        $fileCount = count($files);
        $viewName = 'exam.1.page' . $page;
        if (view()->exists($viewName)) {
            return view('exam.exam', compact('active', 'page', 'fileCount', 'user_exam_id', 'remainingTime'));
        } else {
            return redirect()->back()->with('error', 'Halaman yang diminta tidak ada');
        }
    }

    public function submit(Request $request)
    {
        // KUNCI JAWABAN
        $answerKeySection3 = [
            1 => 'B', 2 => 'C', 3 => 'D', 4 => 'A', 5 => 'C', 6 => 'B', 7 => 'B', 8 => 'A', 9 => 'B', 10 => 'B',
            11 => 'D', 12 => 'A', 13 => 'A', 14 => 'C', 15 => 'A', 16 => 'A', 17 => 'B', 18 => 'B', 19 => 'C', 20 => 'D',
            21 => 'C', 22 => 'A', 23 => 'D', 24 => 'A', 25 => 'D', 26 => 'D', 27 => 'C', 28 => 'B', 29 => 'B', 30 => 'D',
            31 => 'B', 32 => 'A', 33 => 'D', 34 => 'B', 35 => 'B', 36 => 'A', 37 => 'A', 38 => 'A', 39 => 'D', 40 => 'B',
            41 => 'A', 42 => 'C', 43 => 'D', 44 => 'D', 45 => 'B', 46 => 'A', 47 => 'A', 48 => 'D', 49 => 'A', 50 => 'A'
        ];
        $answerKeySection2 = [
            1 => 'B', 2 => 'A', 3 => 'C', 4 => 'B', 5 => 'B', 6 => 'C', 7 => 'C', 8 => 'A',
            9 => 'D', 10 => 'D', 11 => 'C', 12 => 'B', 13 => 'B', 14 => 'C', 15 => 'D', 16 => 'D',
            17 => 'B', 18 => 'B', 19 => 'D', 20 => 'B', 21 => 'A', 22 => 'B', 23 => 'D', 24 => 'C',
            25 => 'C', 26 => 'C', 27 => 'B', 28 => 'C', 29 => 'D', 30 => 'D', 31 => 'C', 32 => 'A',
            33 => 'A', 34 => 'D', 35 => 'B', 36 => 'D', 37 => 'B', 38 => 'B', 39 => 'D', 40 => 'D'
        ];
        $user_exam_id = $request->input('user_exam_id');
        $currentPage = $request->input('pageNow', 1);
        // Cek Jika Ujian Telah Finish
        $cekFinish = $request->input('finish');
        if ($cekFinish == "true") {
            dd($cekFinish);
        }
        // Ambil jawaban dari input section2 dan section3
        $answersS2 = $request->input('section2question', []); // Tidak perlu pakai wildcard '*'
        $answersS3 = $request->input('section3question', []);

        // Jika tidak ada jawaban yang dikirimkan, langsung redirect ke halaman berikutnya
        if (empty($answersS2) && empty($answersS3)) {
            return redirect()->route('exam.exam', ['user_exam_id' => $user_exam_id, 'page' => $currentPage + 1]);
        }

        // Validasi jawaban
        $validated = $request->validate([
            'section2question.*' => 'nullable|string', // Validasi jawaban
            'section3question.*' => 'nullable|string', // Validasi jawaban
        ]);

        // Simpan jawaban ke database
        if (!empty($validated['section2question'])) {
            foreach ($validated['section2question'] as $questionId => $answer) {
                $isCorrect = (isset($answerKeySection2[$questionId]) && $answerKeySection2[$questionId] === $answer) ? 1 : 0;
                Answer::updateOrCreate(
                    [
                        'user_exam_id' => $user_exam_id, // Kondisi pencarian
                        'question_id' => "section2question[{$questionId}]"    // Kondisi pencarian
                    ],
                    [
                        'answer' => $answer,             // Data yang akan disimpan
                        'user_exam_id' => $user_exam_id, // Pastikan user_exam_id diisi saat create
                        'question_id' => "section2question[{$questionId}]",   // Pastikan question_id diisi saat create
                        'is_correct' => $isCorrect // Simpan status apakah jawaban benar atau tidak
                    ]
                );
            }
        }

        // Sama halnya untuk section3question jika diperlukan
        if (!empty($validated['section3question'])) {
            foreach ($validated['section3question'] as $questionId => $answer) {
                $isCorrect = (isset($answerKeySection3[$questionId]) && $answerKeySection3[$questionId] === $answer) ? 1 : 0;
                Answer::updateOrCreate(
                    [
                        'user_exam_id' => $user_exam_id, // Kondisi pencarian
                        'question_id' => "section3question[{$questionId}]"    // Kondisi pencarian
                    ],
                    [
                        'answer' => $answer,             // Data yang akan disimpan
                        'user_exam_id' => $user_exam_id, // Pastikan user_exam_id diisi saat create
                        'question_id' => "section3question[{$questionId}]",  // Pastikan question_id diisi saat create
                        'is_correct' => $isCorrect // Simpan status apakah jawaban benar atau tidak
                    ]
                );
            }
        }

        // Redirect ke halaman selanjutnya
        return redirect()->route('exam.exam', ['user_exam_id' => $user_exam_id, 'page' => $currentPage + 1]);
    }
}
