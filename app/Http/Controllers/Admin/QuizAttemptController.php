<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class QuizAttemptController extends Controller
{
    public function indexHistoryTracNghiem(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses)) {
                //                $index = 1;
                $ds_quiz_history = DB::table('quiz_histories')
                    ->select('quiz_histories.id', 'quizzes.title', 'quiz_histories.score', 'quiz_histories.created_at', DB::raw('COUNT(questions.id) as question_count'), 'users.display_name')
                    ->join('quizzes', 'quiz_histories.id_quiz', '=', 'quizzes.id')
                    ->leftJoin('questions', 'quizzes.id', '=', 'questions.id_quiz')
                    ->leftJoin('users', 'users.id', 'quiz_histories.id_user')
                    ->groupBy('quizzes.id', 'quiz_histories.id')
                    ->orderBy('quiz_histories.created_at', 'desc')
                    ->groupBy('quizzes.id')
                    ->orderBy('quizzes.id', 'desc')
                    ->paginate(15);


                Session::put('tasks_url', $request->fullUrl());
                return view("admin.tracnghiem.danh_sach_history_trac_nghiem", compact('ds_quiz_history'));
            } else {
                $err = 'Vui lòng đăng nhập để thực hiện tác vụ này!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function themHistoryTracNghiem()
    {
        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $ds_quiz = DB::table('quizzes')
                ->select('quizzes.*', DB::raw('COUNT(questions.id) as question_count'))
                ->leftJoin('questions', 'quizzes.id', '=', 'questions.id_quiz')
                ->groupBy('quizzes.id')
                ->get()->toArray();
            $users = DB::table('users')->select("id", 'username', "display_name")->where('role', 'user')->get()->toArray();
            return view('admin.tracnghiem.them_history_trac_nghiem', compact('ds_quiz', 'users'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function insertHistoryTracNghiem(Request $request)
    {
        // dd($request->questions);
        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }

            DB::table('quiz_histories')->insert([
                'id_quiz' => $request->id_quiz,
                'id_user' => $request->id_user,
                'score' => $request->score,
                'created_at' => date('y-m-d h:i:s'),
                'updated_at' => date('y-m-d h:i:s'),
            ]);
            return redirect()->route('index_history_trac_nghiem')->with('success', 'Thêm lịch sử làm bài thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi thêm lịch sử kiểm tra: '. $e->getMessage());
        }
    }

    public function pageEditHistoryTracNghiem(Request $request)
    {
        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $history_detail = DB::table('quiz_histories')
                ->where("id", '=', $request->id)
                ->first();
            $ds_quiz = DB::table('quizzes')
                ->select('quizzes.*', DB::raw('COUNT(questions.id) as question_count'))
                ->leftJoin('questions', 'quizzes.id', '=', 'questions.id_quiz')
                ->groupBy('quizzes.id')
                ->get()->toArray();
            $users = DB::table('users')->select("id", 'username', "display_name")->where('role', 'user')->get()->toArray();
            return view('admin.tracnghiem.sua_history_trac_nghiem', compact('history_detail', 'ds_quiz', 'users'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function editHistoryTracNghiem(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses) && ($request->session()->get('role') == 'admin')) {
            
                DB::table('quiz_histories')
                    ->where('id', '=', $request->id)
                    ->update([
                        'id_quiz' => $request->id_quiz,
                        'id_user' => $request->id_user,
                        'score' => $request->score,
                        'updated_at' => date('y-m-d h:i:s'),
                    ]);

                return redirect()->route('index_history_trac_nghiem')->with('success', 'Sửa lịch sử kiểm tra thành công!');
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi sửa lịch sử kiểm tra: '. $e->getMessage());
        }
    }

    public function deleteHistoryTracNghiem($id, Request $request)
    {
        try {

            $ses = $request->session()->get('tk_user');

            if (isset($ses) && $request->session()->get('role') == 'admin') {
                DB::table('quiz_histories')->where('id', '=', $id)->delete();
                return redirect()->back()->with('success', 'Xóa lịch sử kiểm tra thành công!');
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi xóa lịch sử kiểm tra: '. $e->getMessage());
        }
    }

    public function findHistoryTracNghiem(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses)) {
                if (isset($_GET['s']) && strlen($_GET['s']) >= 1) {
                    $search_text = $_GET['s'];
                    $ds_quiz_history = DB::table('quiz_histories')
                    ->select('quiz_histories.id', 'quizzes.title', 'quiz_histories.score', 'quiz_histories.created_at', DB::raw('COUNT(questions.id) as question_count'), 'users.display_name')
                    ->join('quizzes', 'quiz_histories.id_quiz', '=', 'quizzes.id')
                    ->leftJoin('questions', 'quizzes.id', '=', 'questions.id_quiz')
                    ->leftJoin('users', 'users.id', 'quiz_histories.id_user')
                    ->where('users.display_name', 'like', '%' . $search_text . '%')
                    ->orWhere('title', 'like', '%' . $search_text . '%')
                    ->groupBy('quizzes.id', 'quiz_histories.id')
                    ->orderBy('quiz_histories.created_at', 'desc')
                    ->groupBy('quizzes.id')
                    ->orderBy('quizzes.id', 'desc')
                    ->paginate(15);
                    Session::put('tasks_url', $request->fullUrl());
                    return view("admin.tracnghiem.danh_sach_history_trac_nghiem", compact('ds_quiz_history', 'search_text'));
                } else {
                    return redirect('/admin/index-history-trac-nghiem');
                }
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return abort(404);
        }
    }
}
