<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BaoGiaController extends Controller
{
    public function indexBaoGia(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses)) {
                //                $index = 1;
                $ds_bao_gia = DB::table('advices')
                    ->orderBy('id', 'desc')
                    ->paginate(15);
                Session::put('tasks_url', $request->fullUrl());
                return view("admin.baogia.danh_sach_bao_gia", compact('ds_bao_gia'));
            } else {
                $err = 'Vui lòng đăng nhập để thực hiện tác vụ này!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return abort(404);
        }
    }
    public function themBaoGia()
    {

        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $users = DB::table('users')->select("id", 'username', "display_name")->where('role', 'user')->get()->toArray();
            return view('admin.baogia.them_bao_gia', compact('users'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }
    public function insertBaoGia(Request $request)
    {
        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            DB::table('advices')->insert([
                'thong_tin' => $request->thong_tin,
                'tinh_thanh' => $request->tinh_thanh,
                'ho_ten' => $request->ho_ten,
                'phone' => $request->phone,
                'id_user' => $request->tac_gia

            ]);
            return redirect()->route('index_bao_gia')->with('success', 'Thêm yêu cầu tư vấn thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi thêm yêu cầu tư vấn: '. $e->getMessage());
        }
    }
    public function pageEditBaoGia(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (!isset($ses)) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $cart_detail = DB::table('advices')
                ->where("id", '=', $request->id)
                ->first();
            $users = DB::table('users')->select("id", 'username', "display_name")->where('role', 'user')->get()->toArray();

            return view('admin.baogia.sua_bao_gia', compact('cart_detail', 'users'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function editBaoGia(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses) && ($request->session()->get('role') == 'admin' || $request->session()->get('role') == 'nv')) {
                 DB::table('advices')
                    ->where("id", '=', $request->id)
                    ->update([
                        'thong_tin' => $request->thong_tin,
                        'tinh_thanh' => $request->tinh_thanh,
                        'ho_ten' => $request->ho_ten,
                        'phone' => $request->phone,
                        'id_user' => $request->tac_gia

                    ]);
                return redirect()->route('index_bao_gia')->with('success', 'Sửa yêu cầu tư vấn thành công!');
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi sửa yêu cầu tư vấn: '. $e->getMessage());
        }
    }

    public function deleteBaoGia($id, Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');

            if (isset($ses) && $request->session()->get('role') == 'admin') {
                DB::table('advices')->where('id', '=', $id)->delete();
                return redirect()->back()->with('success', 'Xóa báo giá thành công!');
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi xóa yêu cầu tư vấn: '. $e->getMessage());
        }
    }

    public function findBaoGia(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses)) {
                if (isset($_GET['s']) && strlen($_GET['s']) >= 1) {
                    $search_text = $_GET['s'];
                    $ds_bao_gia = DB::table('advices')
                        ->where('ho_ten', 'like', '%' . $search_text . '%')
                        ->orWhere('tinh_thanh', 'like', '%' . $search_text . '%')
                        ->orWhere('phone', 'like', '%' . $search_text . '%')
                        ->orderBy('id', 'desc')
                        ->paginate(15);
                    Session::put('tasks_url', $request->fullUrl());
                    return view("admin.baogia.danh_sach_bao_gia", compact('ds_bao_gia', 'search_text'));
                } else {
                    return redirect('/admin/index-bao-gia');
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
