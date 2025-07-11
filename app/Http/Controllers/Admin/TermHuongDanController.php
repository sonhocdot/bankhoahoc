<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TermHuongDanController extends Controller
{
    public function indexTermsHuongDan(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses)) {
                //                $index = 1;
                $ds_terms_huong_dan = DB::table('post_categories')
                    ->orderBy('post_categories.id', 'desc')
                    ->paginate(15);
                Session::put('tasks_url', $request->fullUrl());
                return view("admin.tintuc.danh_sach_terms_huong_dan", compact('ds_terms_huong_dan'));
            } else {
                $err = 'Vui lòng đăng nhập để thực hiện tác vụ này!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function themTermHuongDan()
    {

        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            return view('admin.tintuc.them_term_huong_dan');
        } catch (\Exception $e) {
            return abort(404);
        }
    }
    public function insertTermHuongDan(Request $request)
    {
        try {
            // $markupFixer  = new \TOC\MarkupFixer();
            // $contentWithMenu = $markupFixer->fix($request->noi_dung);
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $existingTag = DB::table('post_categories')->where('slug', $request->term_slug)->first();
                if ($existingTag) {
                    return redirect()->back()->with('fail', 'Slug đã tồn tại!');
                }
            DB::table('post_categories')->insert([
                'name' => $request->term_name,
                'slug' => $request->term_slug,
            ]);
            return redirect()->route('index_terms_HD')->with('success', 'Thêm tag bài viết thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi thêm tag bài viết: '. $e->getMessage());
        }
    }
    public function pageEditTermHuongDan(Request $request)
    {
        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $term_detail = DB::table('post_categories')
                ->where("post_categories.id", '=', $request->id)
                ->first();

            return view('admin.tintuc.sua_term_huong_dan', compact('term_detail'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function editTermHuongDan(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses) && ($request->session()->get('role') == 'admin' || $request->session()->get('role') == 'nv')) {
                $existingTag = DB::table('post_categories')->where('slug', $request->term_slug)->whereNot('id', $request->id)->first();
                if ($existingTag) {
                    return redirect()->back()->with('fail', 'Slug đã tồn tại!');
                }
                DB::table('post_categories')
                    ->where("post_categories.id", '=', $request->id)
                    ->update([
                        'name' => $request->term_name,
                        'slug' => $request->term_slug,
                    ]);

                return redirect()->route('index_terms_HD')->with('success', 'Sửa tag bài viết thành công!');
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi sửa tag bài viết: '. $e->getMessage());
        }
    }

    public function deleteTermHuongDan($id, Request $request)
    {
        try {

            $ses = $request->session()->get('tk_user');

            if (isset($ses) && $request->session()->get('role') == 'admin') {
                DB::table('posts')->where('category', '=', $id)->delete();
                DB::table('post_categories')->where('post_categories.id', '=', $id)->delete();
                return redirect()->back()->with('success', 'Xóa tag bài viết thành công!');
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi xóa tag bài viết: '. $e->getMessage());
        }
    }
    public function findTermHuongDan(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses)) {
                if (isset($_GET['s']) && strlen($_GET['s']) >= 1) {
                    $search_text = $_GET['s'];
                    $ds_terms_huong_dan = DB::table('post_categories')
                        ->where('name', 'like', '%' . $search_text . '%')
                        ->orderBy('post_categories.id', 'desc')
                        ->paginate(15);
                    Session::put('tasks_url', $request->fullUrl());
                    return view("admin.tintuc.danh_sach_terms_huong_dan", compact('ds_terms_huong_dan', 'search_text'));
                } else {
                    return redirect('/admin/index-terms-huong-dan');
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
