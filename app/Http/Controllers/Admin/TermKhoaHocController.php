<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TermKhoaHocController extends Controller
{
    public function indexTermsKhoaHoc(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses)) {
                //                $index = 1;
                $ds_terms_khoa_hoc = DB::table('course_categories')
                    ->orderBy('course_categories.id', 'desc')
                    ->paginate(15);
                Session::put('tasks_url', $request->fullUrl());
                return view("admin.khoahoc.danh_sach_terms_khoa_hoc", compact('ds_terms_khoa_hoc'));
            } else {
                $err = 'Vui lòng đăng nhập để thực hiện tác vụ này!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function themTermKhoaHoc()
    {

        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            return view('admin.khoahoc.them_term_khoa_hoc');
        } catch (\Exception $e) {
            return abort(404);
        }
    }
    public function insertTermKhoaHoc(Request $request)
    {
        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $existingTag = DB::table('course_categories')->where('slug', $request->term_slug)->first();
            if ($existingTag) {
                return redirect()->back()->with('fail', 'Slug đã tồn tại!');
            }
            DB::table('course_categories')->insert([
                'name' => $request->term_name,
                'slug' => $request->term_slug,
            ]);
            return redirect()->route('index_terms_KH')->with('success', 'Thêm tag khóa học thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi thêm tag khóa học: ' . $e->getMessage());
        }
    }
    public function pageEditTermKhoaHoc(Request $request)
    {
        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $term_detail = DB::table('course_categories')
                ->where("course_categories.id", '=', $request->id)
                ->first();

            return view('admin.khoahoc.sua_term_khoa_hoc', compact('term_detail'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function editTermKhoaHoc(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');

            if (isset($ses) && ($request->session()->get('role') == 'admin')) {
                $existingTag = DB::table('course_categories')
                    ->where('slug', $request->term_slug)
                    ->whereNot("id", $request->id)
                    ->first();
                if ($existingTag) {
                    return redirect()->back()->with('fail', 'Slug đã tồn tại!');
                }
                DB::table('course_categories')
                    ->where("course_categories.id", '=', $request->id)
                    ->update([
                        'name' => $request->term_name,
                        'slug' => $request->term_slug,
                    ]);


                return redirect()->route('index_terms_KH')->with('success', 'Sửa tag khóa học thành công!');
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi sửa tag khóa học: ' . $e->getMessage());
        }
    }

    public function deleteTermKhoaHoc($id, Request $request)
    {
        try {

            $ses = $request->session()->get('tk_user');

            if (isset($ses) && $request->session()->get('role') == 'admin') {
                $isCourseInUse = DB::table('courses')
                    ->join('invoice_relationships', 'courses.id', '=', 'invoice_relationships.id_course')
                    ->where('courses.category', '=', $id)->exists();
                $isQuizInUse = DB::table('quizzes')
                    ->join('quiz_histories', 'quizzes.id', '=', 'quiz_histories.id_quiz')
                    ->where('quizzes.category', '=', $id)->exists();
                if ($isCourseInUse) {
                    return redirect()->back()->with('fail', 'Tag khóa học này không thể xóa do tồn tại khóa học được đặt mua!');
                }
                if ($isQuizInUse) {
                    return redirect()->back()->with('fail', 'Tag khóa học này không thể xóa do tồn tại bộ đề kiểm tra được thực hiện!');
                }

                DB::table('courses')->where('category', '=', $id)->delete();
                DB::table('course_categories')->where('course_categories.id', '=', $id)->delete();
                return redirect()->back()->with('success', 'Xóa tag khóa học thành công!');
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi xóa tag khóa học: ' . $e->getMessage());
        }
    }

    public function findTermKhoaHoc(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses)) {
                if (isset($_GET['s']) && strlen($_GET['s']) >= 1) {
                    $search_text = $_GET['s'];
                    $ds_terms_khoa_hoc = DB::table('course_categories')
                        ->where('name', 'like', '%' . $search_text . '%')
                        ->orderBy('course_categories.id', 'desc')
                        ->paginate(15);
                    Session::put('tasks_url', $request->fullUrl());
                    return view("admin.khoahoc.danh_sach_terms_khoa_hoc", compact('ds_terms_khoa_hoc', 'search_text'));
                } else {
                    return redirect('/admin/index-terms-khoa-hoc');
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
