<?php

namespace App\Http\Controllers\Client\tracnghiem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function show($id)
    {
        try {
            if (!session()->has('account_id')) {
                $err = 'Vui lòng đăng nhập để thực hiện tác vụ này!';
                return redirect('/login')->with('err', $err);
            }
            $quiz = DB::table('quizzes')->where('id', $id)->first();
            if (!$quiz) {
                return redirect()->back()->with('fail', 'Quiz không tồn tại.');
            }

            $questions = DB::table('questions')->where('id_quiz', $id)->get();
            return view('client.body.xdsoft.tracnghiem.show', compact('quiz', 'questions'));
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Lỗi xảy ra khi tải quiz: '. $e->getMessage());
        }
    }

    public function submit(Request $request, $id)
    {
        try {
            if (!session()->has('account_id')) {
                $err = 'Vui lòng đăng nhập để thực hiện tác vụ này!';
                return redirect('/login')->with('err', $err);
            }
            $quiz = DB::table('quizzes')->where('id', $id)->first();
            if (!$quiz) {
                return redirect('/quizzes')->with('fail', 'Quiz không tồn tại.');
            }
            $questions = DB::table('questions')->where('id_quiz', $id)->get();
            $answers = $request->input('answers', []);

            $score = 0;
            $results = [];

            foreach ($questions as $question) {
                $correctOption = $question->correct_option;
                $userAnswer = $answers[$question->id] ?? null;

                $isCorrect = $userAnswer === $correctOption;
                if ($isCorrect) {
                    $score++;
                }

                $results[] = [
                    'question' => $question,
                    'userAnswer' => $userAnswer,
                    'isCorrect' => $isCorrect,
                ];
            }
            // Lưu kết quả
            DB::table('quiz_histories')->insert([
                'id_user' => session('account_id'),
                'id_quiz' => $quiz->id,
                'score' => $score,
                'created_at' => now(),
            ]);
            return view('client.body.xdsoft.tracnghiem.result', compact('quiz', 'results', 'score'));
        } catch (\Exception $e) {
            return back()->with('fail', 'Đã xảy ra lỗi khi nộp bài: '. $e->getMessage());
        }
    }
}
