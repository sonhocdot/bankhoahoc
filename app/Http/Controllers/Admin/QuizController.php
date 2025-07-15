<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class QuizController extends Controller
{
    public function indexTracNghiem(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses)) {
                //                $index = 1;
                $ds_quiz = DB::table('quizzes')
                    ->select('quizzes.*', DB::raw('COUNT(questions.id) as question_count'), 'users.display_name as author_name')
                    ->leftJoin('questions', 'quizzes.id', '=', 'questions.id_quiz')
                    ->leftJoin('users', 'users.id', 'quizzes.id_author')
                    ->groupBy('quizzes.id')
                    ->orderBy('quizzes.id', 'desc')
                    ->paginate(15);
                Session::put('tasks_url', $request->fullUrl());
                return view("admin.tracnghiem.danh_sach_trac_nghiem", compact('ds_quiz'));
            } else {
                $err = 'Vui lòng đăng nhập để thực hiện tác vụ này!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function themTracNghiem()
    {
        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $users = DB::table('users')->select("id", 'username', "display_name")->whereNot('role', 'user')->get()->toArray();
            $course_categories = DB::table('course_categories')
                ->get()->toArray();
            return view('admin.tracnghiem.them_trac_nghiem', compact('users', 'course_categories'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function insertTracNghiem(Request $request)
    {
        // dd($request->questions);
        try {
            // $markupFixer  = new \TOC\MarkupFixer();
            // $contentWithMenu = $markupFixer->fix($request->noi_dung);
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $existingQuiz = DB::table('quizzes')->where('title', $request->title)->first();
            if ($existingQuiz) {
                return redirect()->back()->with('fail', 'Tiêu đề bài kiểm tra đã tồn tại, vui lòng sửa lại thông tin!');
            }

            $tieu_de_processed = $request->input('title'); // Lấy giá trị gốc
            if ($tieu_de_processed) {
                $tieu_de_processed = preg_replace('/\s+/', " ", $tieu_de_processed); // Xử lý
            } else {
                // Xử lý trường hợp tieu_de là null hoặc rỗng nếu cần, ví dụ:
                // return redirect()->back()->withInput()->with('fail', 'Tiêu đề không được để trống.');
                $tieu_de_processed = ''; // Hoặc giá trị mặc định
            }
            DB::table('quizzes')->insert([
                'title' => $tieu_de_processed,
                'id_author' => $request->id_author,
                'duration' => $request->duration,
                'description' => $request->description,
                'category' => $request->category,
                'created_at' => date('y-m-d h:i:s'),
                'updated_at' => date('y-m-d h:i:s'),
            ]);
            if ($request->questions) {
                $rs = DB::table('quizzes')->select("id")->orderBy("id", "desc")->first();

                foreach ($request->questions as $key) {
                    DB::table('questions')->insert([
                        'id_quiz' => $rs->id,
                        'question' => $key['question_title'],
                        'option_a' => $key['option_a'],
                        'option_b' => $key['option_b'],
                        'option_c' => $key['option_c'],
                        'option_d' => $key['option_d'],
                        'correct_option' => $key['correct_option']
                    ]);
                }
            }
            return redirect()->route('index_trac_nghiem')->with('success', 'Thêm đề kiểm tra thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi thêm đề kiểm tra: ' . $e->getMessage());
        }
    }

    public function pageEditTracNghiem(Request $request)
    {
        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $quiz_detail = DB::table('quizzes')
                ->where("quizzes.id", '=', $request->id)
                ->first();
            $question_detail = DB::table('questions')->where('id_quiz', '=', $request->id)->get()->toArray();
            $users = DB::table('users')->whereNot('role', 'user')->get()->toArray();
            $course_categories = DB::table('course_categories')->get()->toArray();
            return view('admin.tracnghiem.sua_trac_nghiem', compact('quiz_detail', 'question_detail', 'users', 'course_categories'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function editTracNghiem(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses) && ($request->session()->get('role') == 'admin')) {
                $existingQuiz = DB::table('quizzes')->where('title', $request->title)->whereNot('id', $request->id)->first();
                if ($existingQuiz) {
                    return redirect()->back()->with('fail', 'Tiêu đề bài kiểm tra đã tồn tại, vui lòng sửa lại thông tin!');
                }

                $tieu_de_processed2 = $request->input('title'); // Lấy giá trị gốc
            if ($tieu_de_processed2) {
                $tieu_de_processed2 = preg_replace('/\s+/', " ", $tieu_de_processed2); // Xử lý
            } else {
                // Xử lý trường hợp tieu_de là null hoặc rỗng nếu cần, ví dụ:
                // return redirect()->back()->withInput()->with('fail', 'Tiêu đề không được để trống.');
                $tieu_de_processed2 = ''; // Hoặc giá trị mặc định
            }

                DB::table('quizzes')
                    ->where('quizzes.id', '=', $request->id)
                    ->update([
                        'title' => $tieu_de_processed2,
                        'id_author' => $request->id_author,
                        'duration' => $request->duration,
                        'description' => $request->description,
                        'category' => $request->category,
                        'updated_at' => date('y-m-d h:i:s'),
                    ]);

                if ($request->questions) {
                    DB::table("questions")->where('id_quiz', '=', $request->id)->delete();
                    foreach ($request->questions as $key) {
                        DB::table('questions')->insert([
                            'id_quiz' => $request->id,
                            'question' => $key['question_title'],
                            'option_a' => $key['option_a'],
                            'option_b' => $key['option_b'],
                            'option_c' => $key['option_c'],
                            'option_d' => $key['option_d'],
                            'correct_option' => $key['correct_option']
                        ]);
                    }
                }

                return redirect()->route('index_trac_nghiem')->with('success', 'Sửa đề kiểm tra thành công!');
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi sửa đề kiểm tra: ' . $e->getMessage());
        }
    }

    public function deleteTracNghiem($id, Request $request)
    {
        try {

            $ses = $request->session()->get('tk_user');

            if (isset($ses) && $request->session()->get('role') == 'admin') {
                $isInQuizHistories = DB::table('quiz_histories')
                    ->where('id_quiz', $id)->exists();

                if ($isInQuizHistories) {
                    return redirect()->back()->with('fail', 'Bộ đề kiểm tra đã được thực hiện bởi người dùng!');
                }

                DB::table('questions')->where('id_quiz', '=', $id)->delete();
                DB::table('quizzes')->where('id', '=', $id)->delete();
                return redirect()->back()->with('success', 'Xóa đề kiểm tra thành công!');
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi xóa đề kiểm tra: ' . $e->getMessage());
        }
    }

    public function findTracNghiem(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses)) {
                if (isset($_GET['s']) && strlen($_GET['s']) >= 1) {
                    $search_text = $_GET['s'];
                    $ds_quiz = DB::table('quizzes')
                        ->select('quizzes.*', DB::raw('COUNT(questions.id) as question_count'), 'users.display_name as author_name')
                        ->leftJoin('questions', 'quizzes.id', '=', 'questions.id_quiz')
                        ->leftJoin('users', 'users.id', 'quizzes.id_author')
                        ->where('quizzes.title', 'like', '%' . $search_text . '%')
                        ->groupBy('quizzes.id')
                        ->orderBy('quizzes.id', 'desc')
                        ->paginate(15);

                    Session::put('tasks_url', $request->fullUrl());
                    return view("admin.tracnghiem.danh_sach_trac_nghiem", compact('ds_quiz', 'search_text'));
                } else {
                    return redirect('/admin/index-bai-trac-nghiem');
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
