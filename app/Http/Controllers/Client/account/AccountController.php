<?php

namespace App\Http\Controllers\Client\account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AccountController extends Controller
{
    public function indexLogin(Request $request)
    {
        try {
            $previousUrl = url()->previous();

            $keywords = ['register', 'action-register'];
            if (collect($keywords)->contains(function ($keyword) use ($previousUrl) {
                return str_contains($previousUrl, $keyword);
            })) {
                $previousUrl = "/";
            }
            $request->session()->put('previous_url_before_login', $previousUrl);
            $err = $request->session()->get('err', null);
            return view('client.body.xdsoft.account.view_login', compact('err'));
        } catch (\Exception $e) {
            return view('errors.404');
        }
    }
    public function indexRegister()
    {
        try {
            return view('client.body.xdsoft.account.view_register');
        } catch (\Exception $e) {
            return view('errors.404');
        }
    }
    public function indexForgetPassword()
    {
        try {
            $err = "Hãy nhập tên tài khoản và email của bạn";
            return view('client.body.xdsoft.account.view_forget_password', compact('err'));
        } catch (\Exception $e) {
            return view('error.404');
        }
    }
    public function indexEditPassword()
    {
        try {
            $err = "Hãy nhập mật khẩu mới";
            return view('client.body.xdsoft.account.view_edit_password', compact('err'));
        } catch (\Exception $e) {
            return view('errors.404');
        }
    }
    public function actionLogin(Request $request)
    {
        try {

            $err = '';
            if (!empty($request->username) && !empty($request->password)) {
                $user = DB::table('users')
                    ->where('username', '=', $request->username)
                    // ->orWhere('email', '=', $request->username)
                    ->where('password', '=', $request->password)
                    ->get()->toArray();
                if (count($user) == 1) {
                    $request->session()->put('account_name', $user[0]->display_name);
                    $request->session()->put('account_role', $user[0]->role);
                    $request->session()->put('account_id', $user[0]->id);
                    return redirect('/');
                } else {
                    $err = "Sai tài khoản hoặc mật khẩu";
                    return view('client.body.xdsoft.account.view_login', compact('err'));
                }
            } else {
                $err = "Vui lòng nhập đầy đủ thông tin";
                return view('client.body.xdsoft.account.view_login', compact('err'));
            }
        } catch (\Exception $e) {
            $err = "Có lỗi xảy ra khi đăng nhập, vui lòng thử lại";
            return view('client.body.xdsoft.account.view_login', compact('err'));
        }
    }

    public function actionRegister(Request $request)
    {
        try {
            $err = '';
            $userCheck = DB::table('users')
                ->where('username', $request->username)
                ->orWhere('email', $request->email)
                ->orWhere('phone', $request->phone)
                ->first();
            if (!$userCheck) {
                if ($request->password == $request->confirm_password) {

                    $rs = DB::table('users')->insert([
                        'username' => $request->username,
                        'password' => $request->password,
                        'display_name' => $request->fullname,
                        'phone' => $request->phone,
                        'email' => $request->email == null ? "" : $request->email,
                        'created_at' => date('y-m-d h:i:s'),
                        'updated_at' => date('y-m-d h:i:s'),
                        'role' => 'user',
                    ]);
                    if ($rs == true) {
                        return redirect('/login');
                    } else {
                        $err = 'Vui lòng kiểm tra lại thông tin';
                        return view('client.body.xdsoft.account.view_register', compact('err'));
                    }
                } else {
                    $err = 'Mật khẩu và mật khẩu xác nhận không khớp';
                    return view('client.body.xdsoft.account.view_register', compact('err'));
                }
            } else {
                $err = 'Tên tài khoản, số điện thoại hoặc email đã tồn tại';
                return view('client.body.xdsoft.account.view_register', compact('err'));
            }
        } catch (\Exception $e) {
            $err = "Có lỗi xảy ra khi đăng ký, vui lòng thử lại";
            return view('client.body.xdsoft.account.view_register', compact('err'));
        }
    }

    public function actionForgetPassword(Request $request)
    {
        try {
            $err = '';
            if (!empty($request->username) && !empty($request->email)) {
                $user = DB::table('users')
                    ->where('username', '=', $request->username)
                    ->where('email', '=', $request->email)
                    ->first();
                if ($user) {
                    // $request->session()->put('account_id', $user[0]->id);
                    return redirect()->route('xdsoft.account.editPassword')->with('account_id_forget', $user->id);
                } else {
                    $err = "Sai tài khoản hoặc email";
                    return view('client.body.xdsoft.account.view_forget_password', compact('err'));
                }
            } else {
                $err = "Vui lòng nhập đầy đủ thông tin";
                return view('client.body.xdsoft.account.view_forget_password', compact('err'));
            }
        } catch (\Exception $e) {
            $err = "Có lỗi xảy ra khi xác thực tài khoản, vui lòng thử lại";
            return view('client.body.xdsoft.account.view_forget_password', compact('err'));
        }
    }

    public function actionEditPassword(Request $request)
    {
        try {
            
            $err = '';
            $account_id = $request->account_id;
            if (!empty($account_id)) {
                if ($request->password == $request->confirm_password) {
                    $rs = DB::table('users')
                        ->where('users.id', '=', $account_id)
                        ->update([
                            'password' => $request->password,
                            'updated_at' => date('y-m-d h:i:s'),
                        ]);
                    if ($rs == true) {
                        $tb = 'Thay đổi mật khẩu thành công! ';
                         return redirect('/login')->with('tb', 'Đổi mật khẩu thành công!');
                    } else {
                        $err = 'Vui lòng kiểm tra lại thông tin';
                        return view('client.body.xdsoft.account.view_edit_password', compact('err'));
                    }
                } else {
                    $err = 'Mật khẩu và mật khẩu xác nhận không khớp';
                    return view('client.body.xdsoft.account.view_edit_password', compact('err'));
                }
            } else {
                $err = 'Có lỗi xảy ra, vui lòng nhập lại tên tài khoản và email của bạn';
                return redirect()->route('xdsoft.account.forgetPassword', compact('err'));
            }
        } catch (\Exception $e) {
            $err = "Có lỗi xảy ra khi đổi mật khẩu, vui lòng thử lại";
            return view('client.body.xdsoft.account.view_edit_password', compact('err'));
        }
    }

    public function indexLogout()
    {
        try {
            session()->forget('account_name');
            session()->forget('account_role');
            session()->forget('account_id');
            session()->forget('cart');
            return redirect(url()->previous());
        } catch (\Exception $e) {
            return view('errors.404');
        }
    }

    public function indexProfile()
    {
        try {
            if (!session()->has('account_id')) {
                $err = 'Vui lòng đăng nhập để thực hiện tác vụ này!';
                return redirect('/login')->with('err', $err);
            }
            $user = DB::table('users')
                ->where('id', session('account_id'))
                ->first();
            $purchasedCourses = DB::table('courses')
                ->select('courses.name', 'courses.img', 'description', 'invoices.created_at as purchase_date')
                ->join('invoice_relationships', 'invoice_relationships.id_course', 'courses.id')
                ->join('invoices', 'invoices.id', 'invoice_relationships.id_invoice')
                ->where('invoices.id_user', session('account_id'))
                ->where('invoices.trang_thai', 'Đã thanh toán')
                ->get()->toArray();
            $favoriteCourses = DB::table('courses')
                ->select('courses.name', 'courses.img', 'description', 'favorite_courses.created_at as favorite_date')
                ->join('favorite_courses', 'courses.id', 'favorite_courses.id_course')
                ->where('favorite_courses.id_user', session('account_id'))
                ->get()->toArray();
            return view('client.body.xdsoft.account.view_profile', compact('user', 'purchasedCourses', 'favoriteCourses'));
        } catch (\Exception $e) {
            return view('errors.404');
        }
    }
    public function editProfile()
    {
        try {
            if (!session()->has('account_id')) {
                $err = 'Vui lòng đăng nhập để thực hiện tác vụ này!';
                return redirect('/login')->with('err', $err);
            }
            $user = DB::table('users')
                ->where('id', session('account_id'))
                ->first();
            return view('client.body.xdsoft.account.view_edit_profile', compact('user'));
        } catch (\Exception $e) {
            return view('errors.404');
        }
    }
    public function updateProfile(Request $request)
    {
        try {
            if (!session()->has('account_id')) {
                $err = 'Vui lòng đăng nhập để thực hiện tác vụ này!';
                return redirect('/login')->with('err', $err);
            }
            $name_image = '';
            if ($request->has('avatar')) {
                $file_image = $request->file('avatar');
                $ext = $request->file('avatar')->extension();
                $name_image = now()->toDateString() . '-' . time() . '-' . 'post_img.' . $ext;
                $path = public_path('images/') . $name_image;
                $file_image->move(public_path('images'), $name_image);
                DB::table('users')
                    ->where('users.id', '=', $request->id)
                    ->update([
                        'username' => $request->username,
                        'display_name' => $request->display_name,
                        'phone' => $request->phone,
                        'email' => $request->email == null ? "" : $request->email,
                        'updated_at' => date('y-m-d h:i:s'),
                        'avatar' =>  URL::to('') . '/images/' . $name_image,
                    ]);
            } else {
                DB::table('users')
                    ->where('users.id', '=', $request->id)
                    ->update([
                        'username' => $request->username,
                        'display_name' => $request->display_name,
                        'phone' => $request->phone,
                        'email' => $request->email == null ? "" : $request->email,
                        'updated_at' => date('y-m-d h:i:s'),
                    ]);
            }

            return redirect('/profile')->with('success', 'Sửa thông tin thành công!');;
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi sửa hồ sơ cá nhân: '. $e->getMessage());
        }
    }

    public function changePassword()
    {
        try {
            if (!session()->has('account_id')) {
                $err = 'Vui lòng đăng nhập để thực hiện tác vụ này!';
                return redirect('/login')->with('err', $err);
            }
            $err = '';
            return view('client.body.xdsoft.account.change_password', compact('err'));
        } catch (\Exception $e) {
            return view('errors.404');
        }
    }

    public function actionChangePassword(Request $request)
    {
        try {
            if (!session()->has('account_id')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/login')->with('err', $err);
            }
            $err = '';
            if (session('account_id')) {
                $userWithOldPassword = DB::table('users')
                    ->select('id')
                    ->where('id', session('account_id'))
                    ->where('password', $request->current_password)->first();
                if ($userWithOldPassword) {
                    if ($request->new_password == $request->new_password_confirmation) {
                        $rs = DB::table('users')
                            ->where('users.id', '=', session('account_id'))
                            ->update([
                                'password' => $request->new_password,
                                'updated_at' => date('y-m-d h:i:s'),
                            ]);
                        if ($rs == true) {
                            return redirect('/profile')->with('success', 'Đổi mật khẩu thành công!');
                        } else {
                            $err = 'Vui lòng kiểm tra lại thông tin';
                            return view('client.body.xdsoft.account.change_password', compact('err'));
                        }
                    } else {
                        $err = 'Mật khẩu mới và mật khẩu xác nhận không khớp';
                        return view('client.body.xdsoft.account.change_password', compact('err'));
                    }
                } else {
                    $err = 'Mật khẩu hiện tại không đúng';
                    return view('client.body.xdsoft.account.change_password', compact('err'));
                }
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại';
                return redirect()->route('xdsoft.account.login', compact('err'));
            }
        } catch (\Exception $e) {
            $err = 'Có lỗi xảy ra khi thực hiện đổi mật khẩu!';
            return view('client.body.xdsoft.account.change_password', compact('err'));
        }
    }

    public function toggleFavoriteCourse(Request $request)
    {
        try {
            if (!session()->has('account_id')) {
                return response()->json(['success' => false, 'message' => 'Bạn cần đăng nhập để theo dõi khóa học.']);
            }
            $userId = session('account_id');
            $courseId = $request->course_id;
            $exists = DB::table('favorite_courses')->where('id_user', $userId)->where('id_course', $courseId)->exists();
            if ($exists) {
                DB::table('favorite_courses')->where('id_user', $userId)->where('id_course', $courseId)->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'Đã xóa khỏi danh sách theo dõi!',
                    'is_favorite' => false,
                ]);
            } else {
                DB::table('favorite_courses')->insert([
                    'id_user' => $userId,
                    'id_course' => $courseId,
                    'created_at' => now(),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Đã thêm vào danh sách theo dõi!',
                    'is_favorite' => true,
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Đã xảy ra lỗi khi theo dõi khóa học: '. $th->getMessage()]);
        }
    }
}