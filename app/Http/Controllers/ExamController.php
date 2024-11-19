<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\UserExam;
use App\Models\Exam;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

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
            ->where('is_finish', false)
            ->first();

        if ($ongoingAttempt) {
            $masihBisa = true;
            // Hitung waktu tersisa
            $endDate = Carbon::parse($ongoingAttempt->end_time);
            $remainingTime = $currentDatetime->diffInSeconds($endDate); // Menghitung selisih dalam detik
        }

        $exam = Exam::find($id);
        if (!$exam) {
            return redirect()->back()->with('error', 'Practice not found.');
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
            ->where('is_finish', false)
            ->first();

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
    public function restart($user_exam_id)
    {
        $userExam = UserExam::find($user_exam_id);
        $examId = $userExam->exam_id;
        $userExam->delete();
        return redirect()->route('exam.index', ['id', $examId]);
    }

    public function exam($user_exam_id)
    {
        // Cek dulu apakah $user_exam_id ada di db 
        $active = 'examination';
        $page = request()->get('page', 1);
        $currentDatetime = Carbon::now('Asia/Jakarta');

        // Mengambil data dari UserExam
        $userExam = UserExam::find($user_exam_id);
        if (!$userExam) {
            return redirect()->route('home.index')->with('error', 'Practice not found.');
        }

        $userId = auth()->user()->id;
        // Cek apakah ada UserExam yang aktif untuk user dan exam ini
        $ongoingAttempt = UserExam::where('id', $user_exam_id)
            ->where('user_id', $userId)
            ->where('start_time', '<=', $currentDatetime)
            ->where('end_time', '>=', $currentDatetime)
            ->where('is_finish', false)
            ->first();

        if ($ongoingAttempt) {
            // Hitung waktu tersisa
            $endDate = Carbon::parse($ongoingAttempt->end_time);
            $remainingTime = $currentDatetime->diffInSeconds($endDate);
        } else {
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
            return redirect()->back()->with('error', 'The requested page does not exist');
        }
    }

    public function submit(Request $request)
    {
        // Kunci jawaban untuk section2 dan section3
        $answerKeySection1 = $this->getAnswerKeySection1();
        $answerKeySection2 = $this->getAnswerKeySection2();
        $answerKeySection3 = $this->getAnswerKeySection3();

        $user_exam_id = $request->input('user_exam_id');
        $currentPage = $request->input('pageNow', 1);

        // Ambil jawaban dari section2 dan section3
        $answersS1 = $request->input('exam1section1question', []);
        $answersS2 = $request->input('exam1section2question', []);
        $answersS3 = $request->input('exam1section3question', []);

        // Jika tidak ada jawaban, redirect ke halaman berikutnya
        if (empty($answersS1) && empty($answersS2) && empty($answersS3)) {
            return $this->redirectToNextPage($user_exam_id, $currentPage);
        }

        // Validasi input
        $validated = $request->validate([
            'exam1section1question.*' => 'nullable|string',
            'exam1section2question.*' => 'nullable|string',
            'exam1section3question.*' => 'nullable|string',
        ]);
        // Simpan jawaban section1
        $this->saveAnswers($validated['exam1section1question'] ?? [], $answerKeySection1, $user_exam_id, 'exam1section1question');

        // Simpan jawaban section2
        $this->saveAnswers($validated['exam1section2question'] ?? [], $answerKeySection2, $user_exam_id, 'exam1section2question');

        // Simpan jawaban section3
        $this->saveAnswers($validated['exam1section3question'] ?? [], $answerKeySection3, $user_exam_id, 'exam1section3question');

        // Cek jika ujian telah selesai
        if ($request->input('finish') === "true") {
            return redirect()->route('exam.finish', ['user_exam_id' => $user_exam_id]);
        }

        // Redirect ke halaman berikutnya
        return $this->redirectToNextPage($user_exam_id, $currentPage);
    }
    // Fungsi untuk mengambil kunci jawaban section1
    private function getAnswerKeySection1()
    {
        return [
            1 => 'C', 2 => 'D', 3 => 'B', 4 => 'C', 5 => 'D',
            6 => 'A', 7 => 'B', 8 => 'B', 9 => 'C', 10 => 'D',
            11 => 'A', 12 => 'C', 13 => 'C', 14 => 'C', 15 => 'B',
            16 => 'C', 17 => 'D', 18 => 'A', 19 => 'D', 20 => 'B',
            21 => 'C', 22 => 'D', 23 => 'A', 24 => 'B', 25 => 'C',
            26 => 'A', 27 => 'A', 28 => 'D', 29 => 'A', 30 => 'C',
            31 => 'B', 32 => 'A', 33 => 'A', 34 => 'B', 35 => 'D',
            36 => 'A', 37 => 'C', 38 => 'A', 39 => 'C', 40 => 'C',
            41 => 'A', 42 => 'C', 43 => 'B', 44 => 'D', 45 => 'A',
            46 => 'D', 47 => 'D', 48 => 'A', 49 => 'B', 50 => 'A'
        ];
    }

    // Fungsi untuk mengambil kunci jawaban section2
    private function getAnswerKeySection2()
    {
        return [
            1 => 'B', 2 => 'A', 3 => 'C', 4 => 'B', 5 => 'B', 6 => 'C', 7 => 'C', 8 => 'A',
            9 => 'D', 10 => 'D', 11 => 'C', 12 => 'B', 13 => 'B', 14 => 'C', 15 => 'D', 16 => 'D',
            17 => 'B', 18 => 'B', 19 => 'D', 20 => 'B', 21 => 'A', 22 => 'B', 23 => 'D', 24 => 'C',
            25 => 'C', 26 => 'C', 27 => 'B', 28 => 'C', 29 => 'D', 30 => 'D', 31 => 'C', 32 => 'A',
            33 => 'A', 34 => 'D', 35 => 'B', 36 => 'D', 37 => 'B', 38 => 'B', 39 => 'D', 40 => 'D'
        ];
    }

    // Fungsi untuk mengambil kunci jawaban section3
    private function getAnswerKeySection3()
    {
        return [
            1 => 'B', 2 => 'C', 3 => 'D', 4 => 'A', 5 => 'C', 6 => 'B', 7 => 'B', 8 => 'A', 9 => 'B', 10 => 'B',
            11 => 'D', 12 => 'A', 13 => 'A', 14 => 'C', 15 => 'A', 16 => 'A', 17 => 'B', 18 => 'B', 19 => 'C', 20 => 'D',
            21 => 'C', 22 => 'A', 23 => 'D', 24 => 'A', 25 => 'D', 26 => 'D', 27 => 'C', 28 => 'B', 29 => 'B', 30 => 'D',
            31 => 'B', 32 => 'A', 33 => 'D', 34 => 'B', 35 => 'B', 36 => 'A', 37 => 'A', 38 => 'A', 39 => 'D', 40 => 'B',
            41 => 'A', 42 => 'C', 43 => 'D', 44 => 'D', 45 => 'B', 46 => 'A', 47 => 'A', 48 => 'D', 49 => 'A', 50 => 'A'
        ];
    }

    // Fungsi untuk menyimpan jawaban
    private function saveAnswers(array $answers, array $answerKey, $user_exam_id, $section)
    {
        foreach ($answers as $questionId => $answer) {
            $isCorrect = isset($answerKey[$questionId]) && $answerKey[$questionId] === $answer ? 1 : 0;

            Answer::updateOrCreate(
                [
                    'user_exam_id' => $user_exam_id,
                    'question_id' => "{$section}[{$questionId}]"
                ],
                [
                    'answer' => $answer,
                    'is_correct' => $isCorrect
                ]
            );
        }
    }

    // Fungsi untuk redirect ke halaman berikutnya
    private function redirectToNextPage($user_exam_id, $currentPage)
    {
        return redirect()->route('exam.exam', ['user_exam_id' => $user_exam_id, 'page' => $currentPage + 1]);
    }


    // KETIKA FINISH
    public function finish($user_exam_id)
    {
        $active = 'finish';

        // Mengambil data dari UserExam
        $userExam = UserExam::find($user_exam_id);

        if (!$userExam) {
            return redirect()->back()->with('error', 'Practice not found.');
        }

        // Ambil jawaban dari tabel Answers untuk Section 2 dan Section 3
        $section1Answers = Answer::where('user_exam_id', $user_exam_id)
            ->where('question_id', 'LIKE', 'exam1section1question[%]')
            ->get();

        $section2Answers = Answer::where('user_exam_id', $user_exam_id)
            ->where('question_id', 'LIKE', 'exam1section2question[%]')
            ->get();

        $section3Answers = Answer::where('user_exam_id', $user_exam_id)
            ->where('question_id', 'LIKE', 'exam1section3question[%]')
            ->get();

        // Hitung jumlah benar di setiap section
        $section1Correct = $section1Answers->where('is_correct', true)->count();
        $section1Incorrect = $section1Answers->where('is_correct', false)->count();
        $section2Correct = $section2Answers->where('is_correct', true)->count();
        $section2Incorrect = $section2Answers->where('is_correct', false)->count();
        $section3Correct = $section3Answers->where('is_correct', true)->count();
        $section3Incorrect = $section3Answers->where('is_correct', false)->count();

        // Pengecekan jika tidak ada jawaban
        if ($section1Answers->isEmpty()) {
            $section1Score = 0;
        } else {
            $section1Score = max(68 - (50 - $section1Correct), 0); // Section 2: skor maksimal 68
        }

        if ($section2Answers->isEmpty()) {
            $section2Score = 0;
        } else {
            $section2Score = max(68 - (40 - $section2Correct), 0); // Section 2: skor maksimal 68
        }

        if ($section3Answers->isEmpty()) {
            $section3Score = 0;
        } else {
            $section3Score = max(67 - (50 - $section3Correct), 0); // Section 3: skor maksimal 67
        }

        // Hitung skor total (sesuai rumus yang diberikan)
        $finalScore = (($section1Score + $section2Score + $section3Score) * 10) / 3;

        // Update skor di UserExam
        $userExam->score = $finalScore;
        $userExam->is_finish = true;
        $userExam->save();

        // Format data untuk view
        $section1AnswersArray = $section1Answers->map(function ($answer) {
            return [
                'question_id' => $answer->question_id,
                'answer' => $answer->answer,
                'is_correct' => $answer->is_correct
            ];
        })->toArray();

        $section2AnswersArray = $section2Answers->map(function ($answer) {
            return [
                'question_id' => $answer->question_id,
                'answer' => $answer->answer,
                'is_correct' => $answer->is_correct
            ];
        })->toArray();

        $section3AnswersArray = $section3Answers->map(function ($answer) {
            return [
                'question_id' => $answer->question_id,
                'answer' => $answer->answer,
                'is_correct' => $answer->is_correct
            ];
        })->toArray();

        // Pass jumlah benar/salah dan skor ke view
        return view('exam.finish', compact(
            'active',
            'section1AnswersArray',
            'section2AnswersArray',
            'section3AnswersArray',
            'section1Correct',
            'section1Incorrect',
            'section2Correct',
            'section2Incorrect',
            'section3Correct',
            'section3Incorrect',
            'section1Score',
            'section2Score',
            'section3Score',
            'finalScore'
        ));
    }
    // CEK
    public function checkAndUpdateExpiredExams()
    {
        $currentDatetime = now();

        // Ambil semua UserExam yang statusnya belum selesai dan waktu selesai ujiannya sudah lewat
        $expiredExams = UserExam::where('is_finish', false)
            ->where('end_time', '<', $currentDatetime)
            ->get();

        foreach ($expiredExams as $userExam) {
            // Ambil jawaban dari tabel Answers untuk section 2 dan section 3
            $section1Answers = Answer::where('user_exam_id', $userExam->id)
                ->where('question_id', 'LIKE', 'exam1section1question[%]')
                ->get();

            $section2Answers = Answer::where('user_exam_id', $userExam->id)
                ->where('question_id', 'LIKE', 'exam1section2question[%]')
                ->get();

            $section3Answers = Answer::where('user_exam_id', $userExam->id)
                ->where('question_id', 'LIKE', 'exam1section3question[%]')
                ->get();

            // Hitung jumlah jawaban benar di setiap section
            $section1CorrectAnswers = $section1Answers->where('is_correct', true)->count();
            $section2CorrectAnswers = $section2Answers->where('is_correct', true)->count();
            $section3CorrectAnswers = $section3Answers->where('is_correct', true)->count();

            // Perhitungan skor untuk setiap section, dengan pengecekan jika tidak ada jawaban
            $section1Score = $section1Answers->isEmpty() ? 0 : max(68 - (50 - $section1CorrectAnswers), 0);
            $section2Score = $section2Answers->isEmpty() ? 0 : max(68 - (40 - $section2CorrectAnswers), 0);
            $section3Score = $section3Answers->isEmpty() ? 0 : max(67 - (50 - $section3CorrectAnswers), 0);

            // Hitung total skor berdasarkan formula
            $totalScore = ($section1Score + $section2Score + $section3Score) * 10 / 2;

            // Update UserExam dengan is_finish menjadi true dan menyimpan total score
            // $userExam->update([
            //     'is_finish' => true,
            //     'score' => $totalScore
            // ]);
            $userExam->score = $totalScore;
            $userExam->is_finish = true;
            $userExam->save();
        }
    }
}