<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LessonController extends Controller
{
    public function indexLesson(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses)) {
                //                $index = 1;
                $ds_lesson = DB::table('lessons')
                    ->select('lessons.id', 'lessons.created_at', 'lessons.lesson_title', 'lessons.video_id', 'courses.name as courseName', 'users.display_name as author_name')
                    ->join('lesson_relationships', 'lesson_relationships.id_lesson', 'lessons.id')
                    ->join('courses', 'lesson_relationships.id_course', 'courses.id')
                    ->leftJoin('users', 'users.id', 'lessons.id_author')
                    ->orderBy('lessons.id', 'desc')
                    ->paginate(15);
                Session::put('tasks_url', $request->fullUrl());
                return view("admin.khoahoc.danh_sach_bai_giang", compact('ds_lesson'));
            } else {
                $err = 'Vui lòng đăng nhập để thực hiện tác vụ này!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function themLesson()
    {

        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $users = DB::table('users')->select("id", 'username', "display_name")->whereNot('role', 'user')->get()->toArray();
            $courses = DB::table('courses')->select("id", 'name')->get()->toArray();
            return view('admin.khoahoc.them_bai_giang', compact("users", "courses"));
        } catch (\Exception $e) {
            return abort(404);
        }
    }
    public function insertLesson(Request $request)
    {
        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $lesson_title_processed = $request->input('lesson_title');
            if ($lesson_title_processed) {
                $lesson_title_processed = preg_replace('/\s+/', " ", $lesson_title_processed);
            } else {
                $lesson_title_processed = ''; // Hoặc xử lý lỗi nếu bắt buộc
            }
            DB::table('lessons')->insert([
                'lesson_title' => $lesson_title_processed,
                'video_id' => $request->video_id,
                'id_author' => $request->tac_gia,
                'created_at' => date('y-m-d h:i:s'),
                'updated_at' => date('y-m-d h:i:s'),
            ]);
            $rs = DB::table('lessons')->select("id")->orderBy("id", "desc")->first();
            DB::table('lesson_relationships')->insert([
                'id_course' => $request->khoa_hoc,
                'id_lesson' => $rs->id,
            ]);

            $users = DB::table('users')->select("id", 'username', "display_name")->whereNot('role', 'user')->get()->toArray();
            $courses = DB::table('courses')->select("id", 'name')->get()->toArray();
            return redirect()->route('index_lesson', compact("users"))->with('success', 'Thêm bài giảng thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi thêm bài giảng: ' . $e->getMessage());
        }
    }
    public function pageEditLesson(Request $request)
    {
        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $lesson_detail = DB::table('lessons')
                ->select('lessons.id', 'lessons.lesson_title', 'lessons.id_author', 'lessons.video_id', 'courses.id  as courseID', 'courses.name as courseName')
                ->join('lesson_relationships', 'lesson_relationships.id_lesson', 'lessons.id')
                ->join('courses', 'lesson_relationships.id_course', 'courses.id')
                ->where("lessons.id", '=', $request->id)
                ->first();

            $users = DB::table('users')->select("id", 'username', "display_name")->whereNot('role', 'user')->get()->toArray();
            $courses = DB::table('courses')->select("id", 'name')->get()->toArray();
            return view('admin.khoahoc.sua_bai_giang', compact('lesson_detail', 'courses', 'users'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function editLesson(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');

            if (isset($ses) && ($request->session()->get('role')  == 'admin' || $request->session()->get('role')  == 'nv')) {

                // Lấy và xử lý lesson_title
                $lesson_title_processed = $request->input('lesson_title');
                if ($lesson_title_processed) {
                    $lesson_title_processed = preg_replace('/\s+/', " ", $lesson_title_processed);
                    $lesson_title_processed = trim($lesson_title_processed); // Thêm trim() để loại bỏ khoảng trắng ở đầu/cuối
                } else {
                    $lesson_title_processed = '';
                }

                DB::table('lessons')
                    ->where('lessons.id', '=', $request->id)
                    ->update([
                        'lesson_title' =>$lesson_title_processed,
                        'video_id' => $request->video_id,
                        'id_author' => $request->tac_gia,
                        'updated_at' => date('y-m-d h:i:s'),
                    ]);

                DB::table('lesson_relationships')
                    ->where('id_lesson', '=', $request->id)
                    ->update([
                        'id_course' => $request->khoa_hoc,
                    ]);

                return redirect()->route('index_lesson')->with('success', 'Sửa bài giảng thành công!');
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi sửa bài giảng: ' . $e->getMessage());
        }
    }

    public function deleteLesson($id, Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');

            if (isset($ses) && $request->session()->get('role') == 'admin') {
                DB::table('lesson_relationships')->where('id_lesson', '=', $id)->delete();
                DB::table('lessons')->where('id', '=', $id)->delete();
                return redirect()->back()->with('success', 'Xóa bài giảng thành công!');
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi xóa bài giảng: ' . $e->getMessage());
        }
    }
    public function findLesson(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses)) {
                if (isset($_GET['s']) && strlen($_GET['s']) >= 1) {
                    $search_text = $_GET['s'];
                    $ds_lesson = DB::table('lessons')
                        ->select('lessons.id', 'lessons.created_at', 'lessons.lesson_title', 'lessons.video_id', 'courses.name as courseName', 'users.display_name as author_name')
                        ->join('lesson_relationships', 'lesson_relationships.id_lesson', 'lessons.id')
                        ->join('courses', 'lesson_relationships.id_course', 'courses.id')
                        ->leftJoin('users', 'users.id', 'lessons.id_author')
                        ->where('lessons.lesson_title', 'like', '%' . $search_text . '%')
                        ->orWhere('courses.name', 'like', '%' . $search_text . '%')
                        ->orderBy('lessons.id', 'desc')
                        ->paginate(15);
                    Session::put('tasks_url', $request->fullUrl());
                    return view("admin.khoahoc.danh_sach_bai_giang", compact('ds_lesson', 'search_text'));
                } else {
                    return redirect('/admin/index-lesson');
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
