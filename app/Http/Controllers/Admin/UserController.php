<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;



class UserController extends Controller
{
    public function view_login(Request $request)
    {
        try {
            return view('admin.users.login');
        } catch (\Exception $e) {
            return view('error.404');
        }
    }

    public function action_login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required|string',
                'password' => 'required|string',
            ], [
                'username.required' => 'Vui lòng nhập tên đăng nhập.',
                'password.required' => 'Vui lòng nhập mật khẩu.',
                //Bạn có thể thêm các thông báo tùy chỉnh khác nếu muốn
                'username.string' => 'Tên đăng nhập phải là chuỗi.',
                'password.string' => 'Mật khẩu phải là chuỗi.',
            ]);
            if ($validator->fails()) {
                return redirect()->back() // Quay lại trang trước đó (trang login)
                    ->withErrors($validator) // Gửi lỗi về view
                    ->withInput($request->except('password')); // Giữ lại giá trị đã nhập (trừ password)
            }
            $err = '';

            // Không cần kiểm tra !empty nữa vì validator đã làm việc đó
            // if (!empty($request->username) && !empty($request->password)) { // Bỏ dòng này

            $user = DB::table('users')
                ->where('username', '=', $request->username)
                ->where('password', '=', $request->password) // !!! CẢNH BÁO BẢO MẬT: KHÔNG BAO GIỜ SO SÁNH MẬT KHẨU TRỰC TIẾP THẾ NÀY
                ->whereNot('role', '=', 'user')
                ->first(); // Sử dụng first() để lấy 1 bản ghi hoặc null, thay vì get()->toArray() rồi count()

            if ($user) { // Nếu tìm thấy người dùng
                $request->session()->put('tk_user', $user->username); // Lấy từ $user object
                $request->session()->put('role', $user->role);       // Lấy từ $user object
                return redirect('/admin/trang-chu');
            } else {
                $err = "Sai tài khoản hoặc mật khẩu :))";
                // Quay lại trang login với thông báo lỗi tùy chỉnh này
                // và giữ lại username đã nhập
                return redirect()->back()
                    ->with('err', $err) // Sử dụng key khác để phân biệt với lỗi validate
                    ->withInput($request->except('password'));
                // Hoặc bạn vẫn có thể dùng cách cũ nếu view đã xử lý biến $err
                //return view('admin.user.login', compact('err'))->withInput($request->except('password'));
            }
            // } // Bỏ dấu đóng của if !empty

        } catch (\Exception $e) {
            // Log lỗi để debug
            // Thay vì 404, có thể trả về 500 hoặc một trang lỗi chung thân thiện hơn
            return view('errors.500', ['message' => 'Có lỗi xảy ra, vui lòng thử lại sau.']);
            // Hoặc giữ nguyên 404 nếu đó là ý đồ của bạn
            // return view('errors.404');
        }
    }

    public function index_user(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses)) {
                $ds_user = DB::table('users')
                    ->orderBy('users.id', 'desc')
                    ->paginate(15);
                return view('admin.users.list_user', compact('ds_user'));
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return abort(404);
        }
    }


    public function page_user()
    {
        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $courses = DB::table('courses')->get()->toArray();
            return view('admin.users.them_user', compact('courses'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }
    public function insert_user(Request $request)
    {
        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $existingUser = DB::table('users')
                ->where('username', $request->username)
                ->orWhere('email', $request->email)
                ->orWhere('phone', $request->phone)
                ->first();
            if ($existingUser) {
                return redirect()->back()->with('fail', 'Username, email hoặc số điện thoại đã tồn tại!');
            }
            if ($request->has('image_upload')) {
                $file_image = $request->file('image_upload');
                $ext = $request->file('image_upload')->extension();
                $name_image = now()->toDateString() . '-' . time() . '-' . 'post_img.' . $ext;
                $file_image->move(public_path('images'), $name_image);
            }
            $rs = DB::table('users')->insert([
                'username' => $request->username,
                'password' => $request->password,
                'display_name' => $request->full_name,
                'phone' => $request->phone,
                'email' => $request->email == null ? "" : $request->email,
                'created_at' => date('y-m-d h:i:s'),
                'updated_at' => date('y-m-d h:i:s'),
                'role' => $request->quyen,
                'avatar' =>  isset($name_image) ? URL::to('') . '/images/' . $name_image : null,

            ]);
            if ($request->favorite_courses) {
                $rs = DB::table('users')->select("id")->orderBy("id", "desc")->first();
                foreach ($request->favorite_courses as $key) {
                    DB::table('favorite_courses')->insert([
                        'id_user' => $rs->id,
                        'id_course' => $key,
                    ]);
                }
            }
            return redirect('/admin/index-user')->with('success', 'Thêm tài khoản thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi thêm tài khoản: ' . $e->getMessage());
        }
    }

    public function page_edit_user(Request $request)
    {
        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $user = DB::table('users')
                ->where("users.id", '=', $request->id)
                ->get()->toArray()[0];
            $courses = DB::table('courses')->get()->toArray();
            $favorite_courses = DB::table('favorite_courses')->where('id_user', $user->id)->get()->toArray();
            return view('admin.users.edit_user', compact('user', 'courses', 'favorite_courses'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }
    public function edit_user(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (
                isset($ses) && ($request->session()->get('role') == 'admin')
            ) {
                $existingUser = DB::table('users')
                    ->where(function ($query) use ($request) {
                        $query->where('username', $request->username)
                            ->orWhere('email', $request->email)
                            ->orWhere('phone', $request->phone);
                    })
                    ->whereNot('id', $request->id)
                    ->first();
                if ($existingUser) {
                    return redirect()->back()->with('fail', 'Username, email hoặc số điện thoại đã tồn tại!');
                }

                if ($request->has('image_upload')) {
                    $file_image = $request->file('image_upload');
                    $ext = $request->file('image_upload')->extension();
                    $name_image = now()->toDateString() . '-' . time() . '-' . 'post_img.' . $ext;
                    // $img = (new \Intervention\Image\ImageManager)->make($file_image->path())->fit(300)->encode('jpg');
                    $path = public_path('images/') . $name_image;
                    // $img->save($path);
                    $file_image->move(public_path('images'), $name_image);

                    DB::table('users')
                        ->where('users.id', '=', $request->id)
                        ->update([
                            'username' => $request->username,
                            'password' => $request->password,
                            'display_name' => $request->full_name,
                            'phone' => $request->phone,
                            'email' => $request->email == null ? "" : $request->email,
                            'created_at' => date('y-m-d h:i:s'),
                            'updated_at' => date('y-m-d h:i:s'),
                            'role' => $request->quyen,
                            'avatar' =>  URL::to('') . '/images/' . $name_image,
                        ]);
                } else {
                    DB::table('users')
                        ->where('users.id', '=', $request->id)
                        ->update([
                            'username' => $request->username,
                            'password' => $request->password,
                            'display_name' => $request->full_name,
                            'phone' => $request->phone,
                            'email' => $request->email == null ? "" : $request->email,
                            'created_at' => date('y-m-d h:i:s'),
                            'updated_at' => date('y-m-d h:i:s'),
                            'role' => $request->quyen,
                        ]);
                }
                if ($request->favorite_courses) {
                    DB::table('favorite_courses')->where('id_user', $request->id)->delete();
                    foreach ($request->favorite_courses as $key) {
                        DB::table('favorite_courses')->insert([
                            'id_user' => $request->id,
                            'id_course' => $key,
                        ]);
                    }
                }
                return redirect()->route('index_user')->with('success', 'Sửa tài khoản thành công!');
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi sửa tài khoản này: ' . $e->getMessage());
        }
    }

    public function delete_user(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses) && $request->session()->get('role') == 'admin') {
                DB::table("comments")->where('id_user', '=', $request->id)->delete();
                DB::table("invoices")->where('id_user', '=', $request->id)->delete();
                DB::table("favorite_courses")->where('id_user', '=', $request->id)->delete();
                DB::table('users')->where('users.id', '=', $request->id)->delete();
                return redirect()->back()->with('success', 'Xóa tài khoản thành công!');
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi xóa tài khoản: ' . $e->getMessage());
        }
    }

    public function find_user(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses)) {
                if (isset($_GET['s']) && strlen($_GET['s']) >= 1) {
                    $search_text = $_GET['s'];
                    $ds_user = DB::table('users')
                        ->where('display_name', 'like', '%' . $search_text . '%')
                        ->orWhere('username', 'like', '%' . $search_text . '%')
                        ->orWhere('email', 'like', '%' . $search_text . '%')
                        ->orWhere('phone', 'like', '%' . $search_text . '%')
                        ->orWhere('role', 'like', '%' . $search_text . '%')
                        ->orderBy('users.id', 'desc')
                        ->paginate(15);
                    Session::put('tasks_url', $request->fullUrl());

                    return view('admin.users.list_user', compact('ds_user', 'search_text'));
                } else {
                    return redirect('/admin/index-user');
                }
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function indexLogout()
    {
        try {
            session()->forget('tk_user');
            session()->forget('role');
            return redirect('admin/login');
        } catch (\Exception $e) {
            return view('errors.404');
        }
    }
}
