<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class PictureController extends Controller
{
    public function indexPicture(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses)) {
                //                $index = 1;
                $ds_pictures = DB::table('pictures')
                    ->orderBy('picture_name', 'asc')
                    ->paginate(15);
                Session::put('tasks_url', $request->fullUrl());
                return view("admin.picture.danh_sach_picture", compact('ds_pictures'));
            } else {
                $err = 'Vui lòng đăng nhập để thực hiện tác vụ này!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function themPicture()
    {
        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $users = DB::table('users')->select("id", 'username', "display_name")->whereNot('role', 'user')->get()->toArray();

            return view('admin.picture.them_picture', compact("users"));
        } catch (\Exception $e) {
            return abort(404);
        }
    }
    public function insertPicture(Request $request)
    {
        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            
            $name_image = '';
            if ($request->has('image_upload')) {
                $file_image = $request->file('image_upload');
                $ext = $request->file('image_upload')->extension();
               
                $name_image = $request->ten_anh . '.' . $ext;
                
                $path = public_path("image/TrangChu/head_carousel") . "." . $name_image;
                $file_image->move(public_path("image/TrangChu/head_carousel"), $name_image);
            }
            DB::table('pictures')->insert([
                'picture_name' => $request->ten_anh,
                'id_author' => $request->tac_gia,
                'picture_type' => $request->phan_loai,
                'picture_image' =>  URL::to('') . '/image/TrangChu/head_carousel/' . $name_image,
            ]);

            $users = DB::table('users')->select("id", 'username', "display_name")->whereNot('role', 'user')->get()->toArray();
            return redirect()->route('them_picture', compact("users"))->with('success', 'Thêm hình ảnh thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi thêm hình ảnh: '. $e->getMessage());
        }
    }
    public function pageEditPicture(Request $request)
    {
        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $picture_detail = DB::table('pictures')
                ->where("id", '=', $request->id)
                ->first();
            $users = DB::table('users')->select("id", 'username', "display_name")->whereNot('role', 'user')->get()->toArray();
            return view('admin.picture.sua_picture', compact('picture_detail', 'users'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function editPicture(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');

            if (isset($ses) && ($request->session()->get('role') == 'admin' || $request->session()->get('role') == 'nv')) {
                if ($request->has('image_upload')) {
                    $file_image = $request->file('image_upload');
                    $ext = $request->file('image_upload')->extension();
                    // $name_image = now()->toDateString() . '-' . time() . '-' . 'post_img.' . $ext;
                    $name_image = $request->ten_anh . '.' . $ext;
                    // $img = (new \Intervention\Image\ImageManager)->make($file_image->path())->fit(300)->encode('jpg');
                    $path = public_path("image/TrangChu/head_carousel") . "." . $name_image;
                    $file_image->move(public_path("image/TrangChu/head_carousel"), $name_image);
                    // $file_image->move(public_path('images'), $name_image);
                    DB::table('pictures')
                        ->where('pictures.id', '=', $request->id)
                        ->update([
                            'picture_name' => $request->ten_anh,
                            'id_author' => $request->tac_gia,
                            'picture_type' => $request->phan_loai,
                            'picture_image' =>  URL::to('') . '/image/TrangChu/head_carousel/' . $name_image,
                        ]);
                } else {
                    DB::table('pictures')
                        ->where('pictures.id', '=', $request->id)
                        ->update([
                            'picture_name' => $request->ten_anh,
                            'id_author' => $request->tac_gia,
                            'picture_type' => $request->phan_loai,
                        ]);
                }

                return redirect()->route('index_picture')->with('success', 'Sửa hình ảnh thành công!');
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi sửa hình ảnh: '. $e->getMessage());
        }
    }

    public function deletePicture($id, Request $request)
    {
        try {

            $ses = $request->session()->get('tk_user');

            if (isset($ses) && $request->session()->get('role') == 'admin') {
                $imageToDelete = DB::table('pictures')->where('id', '=', $id)->first();
                $parseUrl = parse_url($imageToDelete->picture_image)['path'];
                $fullPath = public_path($parseUrl);
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
                DB::table('pictures')->where('id', '=', $id)->delete();
                return redirect()->back()->with('success', 'Xóa hình ảnh thành công!');
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi xóa hình ảnh: '. $e->getMessage());
        }
    }
    public function findPicture(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses)) {
                if (isset($_GET['s']) && strlen($_GET['s']) >= 1) {
                    $search_text = $_GET['s'];
                    $ds_pictures = DB::table('pictures')
                        ->where('picture_name', 'like', '%' . $search_text . '%')
                        ->orWhere('picture_type', 'like', '%' . $search_text . '%')
                        ->orderBy('picture_name', 'asc')
                        ->paginate(15);
                    Session::put('tasks_url', $request->fullUrl());
                    return view("admin.picture.danh_sach_picture", compact('ds_pictures', 'search_text'));
                } else {
                    return redirect('/admin/index-picture');
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
