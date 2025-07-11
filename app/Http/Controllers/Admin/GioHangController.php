<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;

class GioHangController extends Controller
{
    public function indexGioHang(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses)) {
                //                $index = 1;
                $ds_invoices = DB::table('invoices')
                    ->select(
                        'invoices.id',
                        'invoices.created_at',
                        'invoices.ho_ten',
                        'invoices.gia_giam',
                        'invoices.ghi_chu',
                        'invoices.so_dien_thoai',
                        'invoices.email',
                        'invoices.trang_thai'
                    )
                    ->orderBy('invoices.id', 'desc')
                    ->paginate(15);
                $datMua = DB::table('invoices')->where('trang_thai', 'Đã đặt mua')->count();
                $daThanhToan = DB::table('invoices')->where('trang_thai', 'Đã thanh toán')->count();
                $tongDoanhThu = DB::table('invoices')->where('trang_thai', 'Đã thanh toán')->sum('gia_giam');
                $tongDonHang = DB::table('invoices')->count();

                Session::put('tasks_url', $request->fullUrl());
                return view("admin.giohang.danh_sach_gio_hang", compact('ds_invoices', 'datMua', 'daThanhToan', 'tongDoanhThu', 'tongDonHang'));
            } else {
                $err = 'Vui lòng đăng nhập để thực hiện tác vụ này!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function themGioHang()
    {
        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $users = DB::table('users')->select("id", 'display_name')->where('role', 'user')->get()->toArray();
            $courses = DB::table('courses')->select("id", 'name', 'gia_goc', 'gia_giam')->whereNot('gia_giam', 0)->get()->toArray();
            return view('admin.giohang.them_gio_hang', compact("users", "courses"));
        } catch (\Exception $e) {
            return abort(404);
        }
    }
    public function insertGioHang(Request $request)
    {
        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            DB::table('invoices')->insert([
                'ho_ten' => $request->ho_ten,
                'gia_goc' => $request->gia_goc,
                'gia_giam' => $request->gia_giam,
                'ghi_chu' => $request->ghi_chu,
                'trang_thai' => $request->trang_thai,
                'email' => $request->email,
                'so_dien_thoai' => $request->so_dien_thoai,
                'id_user' => $request->id_user,
                'created_at' => date('y-m-d h:i:s'),
                'updated_at' => date('y-m-d h:i:s'),
            ]);
            $cart = DB::table('invoices')->select("id")
                ->orderBy("id", "desc")
                ->first();
            if ($request->course) {
                foreach ($request->courses as $key) {
                    DB::table('invoice_relationships')->insert([
                        'id_invoice' => $cart->id,
                        'id_course' => $key,
                    ]);
                }
            }

            return redirect()->route('index_gio_hang')->with('success', 'Thêm giỏ hàng thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi thêm giỏ hàng: ' . $e->getMessage());
        }
    }
    public function pageEditGioHang(Request $request)
    {
        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $cart_detail = DB::table('invoices')
                ->where("invoices.id", '=', $request->id)
                ->first();
            $users = DB::table('users')->select("id", 'display_name')->where('role', 'user')->get()->toArray();
            $courses = DB::table('courses')->select("id", 'name', 'gia_goc', 'gia_giam')->whereNot('gia_giam', 0)->get()->toArray();
            $course_list = DB::table('invoice_relationships')->where('id_invoice', '=', $request->id)->get()->toArray();
            return view('admin.giohang.sua_gio_hang', compact('cart_detail', 'courses', 'course_list', 'users'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function editGioHang(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses) && ($request->session()->get('role') == 'admin' || $request->session()->get('role') == 'nv')) {
                DB::table('invoices')
                    ->where('invoices.id', '=', $request->id)
                    ->update([
                        'ho_ten' => $request->ho_ten,
                        'gia_goc' => $request->gia_goc,
                        'gia_giam' => $request->gia_giam,
                        'ghi_chu' => $request->ghi_chu,
                        'trang_thai' => $request->trang_thai,
                        'email' => $request->email,
                        'so_dien_thoai' => $request->so_dien_thoai,
                        'id_user' => $request->id_user,
                        'updated_at' => date('y-m-d h:i:s'),
                    ]);

                DB::table("invoice_relationships")->where('id_invoice', '=', $request->id)->delete();
                if ($request->courses) {
                    foreach ($request->courses as $key) {
                        DB::table("invoice_relationships")->insert([
                            'id_invoice' => $request->id,
                            'id_course' => $key,
                        ]);
                    }
                }
                return redirect()->route('index_gio_hang')->with('success', 'Sửa giỏ hàng thành công!');
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi sửa giỏ hàng: ' . $e->getMessage());
        }
    }

    public function deleteGioHang($id, Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');

            if (isset($ses) && $request->session()->get('role') == 'admin') {
                DB::table('invoices')->where('id', '=', $id)->delete();
                DB::table('invoice_relationships')->where('id_invoice', '=', $id)->delete();
                return redirect()->back()->with('success', 'Xóa giỏ hàng thành công!');
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi xóa giỏ hàng: ' . $e->getMessage());
        }
    }

    public function findGioHang(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses)) {
                if (isset($_GET['s']) && strlen($_GET['s']) >= 1) {
                    $search_text = $_GET['s'];
                    $ds_invoices = DB::table('invoices')
                        ->select(
                            'invoices.id',
                            'invoices.created_at',
                            'invoices.ho_ten',
                            'invoices.gia_giam',
                            'invoices.ghi_chu',
                            'invoices.so_dien_thoai',
                            'invoices.email',
                            'invoices.trang_thai'
                        )
                        ->where('invoices.ho_ten', 'like', '%' . $search_text . '%')
                        ->orWhere('invoices.trang_thai', 'like', '%' . $search_text . '%')
                        ->orWhere('invoices.email', 'like', '%' . $search_text . '%')
                        ->orWhere('invoices.so_dien_thoai', 'like', '%' . $search_text . '%')
                        ->orderBy('invoices.id', 'desc')
                        ->get();
                    $currentPage = LengthAwarePaginator::resolveCurrentPage();
                    $perPage = 15;
                    $items = $ds_invoices->forPage($currentPage, $perPage);
                    $ds_invoices = new LengthAwarePaginator(
                        $items,
                        $ds_invoices->count(),
                        $perPage,
                        $currentPage,
                        ['path' => LengthAwarePaginator::resolveCurrentPath()]
                    );


                    Session::put('tasks_url', $request->fullUrl());
                    return view("admin.giohang.danh_sach_gio_hang", compact('ds_invoices', 'datMua', 'daThanhToan', 'tongDoanhThu', 'tongDonHang'));
                } else {
                    return redirect('/admin/index-gio-hang');
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
