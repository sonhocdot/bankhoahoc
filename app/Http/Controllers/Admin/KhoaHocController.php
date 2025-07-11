<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class KhoaHocController extends Controller
{
    public function indexKhoaHoc(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses)) {
                //                $index = 1;
                $ds_khoa_hoc = DB::table('courses')
                    ->select(
                        'courses.id',
                        'courses.created_at',
                        'courses.name',
                        'courses.img',
                        'courses.gia_giam',
                        'slug',
                        'users.display_name as author_name'
                    )
                    ->leftJoin('users', 'users.id', 'courses.id_author')
                    ->orderBy('courses.id', 'desc')
                    ->paginate(15);
                Session::put('tasks_url', $request->fullUrl());
                return view("admin.khoahoc.danh_sach_khoa_hoc", compact('ds_khoa_hoc'));
            } else {
                $err = 'Vui lòng đăng nhập để thực hiện tác vụ này!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return abort(404);
        }
    }
    public function themKhoaHoc()
    {

        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $lessons = DB::table('lessons')->select("id", 'lesson_title')->get()->toArray();
            $course_categories = DB::table('course_categories')
                ->get()->toArray();
            $users = DB::table('users')->select("id", 'username', "display_name")->whereNot('role', 'user')->get()->toArray();
            return view('admin.khoahoc.them_khoa_hoc', compact("users", "lessons", 'course_categories'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }
    public function insertKhoaHoc(Request $request)
    {
        try {

            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $existingCourse = DB::table('courses')->where('slug', $request->slug)->first();
            if ($existingCourse) {
                return redirect()->back()->with('fail', 'Slug đã tồn tại, vui lòng chọn slug khác!');
            }

            if ($request->has('image_upload')) {
                $file_image = $request->file('image_upload');
                $ext = $request->file('image_upload')->extension();
                $name_image = now()->toDateString() . '-' . time() . '-' . 'post_img.' . $ext;

                $file_image->move(public_path('images'), $name_image);
            }

            $tieu_de_processed = $request->input('tieu_de'); // Lấy giá trị gốc
            if ($tieu_de_processed) {
                $tieu_de_processed = preg_replace('/\s+/', " ", $tieu_de_processed); // Xử lý
            } else {
                // Xử lý trường hợp tieu_de là null hoặc rỗng nếu cần, ví dụ:
                // return redirect()->back()->withInput()->with('fail', 'Tiêu đề không được để trống.');
                $tieu_de_processed = ''; // Hoặc giá trị mặc định
            }
            DB::table('courses')->insert([
                'name' =>  $tieu_de_processed,
                'slug' => $request->slug,
                'content' => $request->noi_dung,
                'id_author' => $request->tac_gia,
                'description' => $request->mo_ta,
                'gia_goc' => $request->gia_goc,
                'gia_giam' => $request->gia_giam,
                'img' =>  URL::to('') . '/images/' . $name_image,
                'category' => $request->category,
                'created_at' => date('y-m-d h:i:s'),
                'updated_at' => date('y-m-d h:i:s'),
            ]);
            if ($request->lessons) {
                $rs = DB::table('courses')->select("id")->orderBy("id", "desc")->first();
                foreach ($request->lessons as $key) {
                    DB::table('lesson_relationships')->insert([
                        'id_course' => $rs->id,
                        'id_lesson' => $key,
                    ]);
                }
            }
            return redirect()->route('index_khoa_hoc')->with('success', 'Thêm khóa học thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi thêm khóa học: ' . $e->getMessage());
        }
    }
    public function pageEditKhoaHoc(Request $request)
    {
        try {
            if (!session()->has('tk_user')) {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
            $course_detail = DB::table('courses')
                ->select(
                    'courses.id',
                    'courses.created_at',
                    'courses.name',
                    'courses.content',
                    'courses.id_author',
                    'courses.img',
                    'courses.description',
                    'courses.slug',
                    'gia_goc',
                    'gia_giam',
                    'category'
                )
                ->where("courses.id", '=', $request->id)
                ->first();
            $lessons = DB::table('lessons')->select('id', 'lesson_title')->get()->toArray();
            $lesson_detail = DB::table('lesson_relationships')->where('id_course', '=', $request->id)->get()->toArray();
            $users = DB::table('users')->select("id", 'username', "display_name")->whereNot('role', 'user')->get()->toArray();
            $course_categories = DB::table('course_categories')
                ->get()->toArray();
            $comments = DB::table('comments')
                ->select('comments.id', 'content', 'rate', 'display_name', 'comments.created_at', 'show')
                ->join('users', 'users.id', 'comments.id_user')
                ->where('id_course', $request->id)
                ->get()->toArray();
            return view('admin.khoahoc.sua_khoa_hoc', compact('course_detail', 'lessons', 'lesson_detail', 'users', 'course_categories', 'comments'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function editKhoaHoc(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses) && ($request->session()->get('role') == 'admin')) {
                $existingCourse = DB::table('courses')->where('slug', $request->slug)->whereNot('id', $request->id)->first();
                if ($existingCourse) {
                    return redirect()->back()->with('fail', 'Slug đã tồn tại, vui lòng chọn slug khác!');
                }

                $tieu_de_processed = $request->input('tieu_de'); // Lấy giá trị gốc
                if ($tieu_de_processed) {
                    $tieu_de_processed = preg_replace('/\s+/', " ", $tieu_de_processed); // Xử lý
                } else {
                    // Xử lý trường hợp tieu_de là null hoặc rỗng nếu cần, ví dụ:
                    // return redirect()->back()->withInput()->with('fail', 'Tiêu đề không được để trống.');
                    $tieu_de_processed = ''; // Hoặc giá trị mặc định
                }
                if ($request->has('image_upload')) {
                    $file_image = $request->file('image_upload');
                    $ext = $request->file('image_upload')->extension();
                    $name_image = now()->toDateString() . '-' . time() . '-' . 'post_img.' . $ext;
                    // $img = (new \Intervention\Image\ImageManager)->make($file_image->path())->fit(300)->encode('jpg');
                    $path = public_path('images/') . $name_image;
                    // $img->save($path);
                    $file_image->move(public_path('images'), $name_image);
                    DB::table('courses')
                        ->where('courses.id', '=', $request->id)
                        ->update([
                            'name' => $tieu_de_processed,
                            'slug' => $request->slug,
                            'content' => $request->noi_dung,
                            'id_author' => $request->tac_gia,
                            'description' => $request->mo_ta,
                            'gia_goc' => $request->gia_goc,
                            'gia_giam' => $request->gia_giam,
                            'category' => $request->category,
                            'img' =>  URL::to('') . '/images/' . $name_image,
                            'updated_at' => date('y-m-d h:i:s'),
                        ]);
                } else {
                    DB::table('courses')
                        ->where('courses.id', '=', $request->id)
                        ->update([
                            'name' => $request->tieu_de,
                            'slug' => $request->slug,
                            'content' => $request->noi_dung,
                            'id_author' => $request->tac_gia,
                            'description' => $request->mo_ta,
                            'gia_goc' => $request->gia_goc,
                            'gia_giam' => $request->gia_giam,
                            'category' => $request->category,
                            'updated_at' => date('y-m-d h:i:s'),
                        ]);
                }

                DB::table("lesson_relationships")->where('id_course', '=', $request->id)->delete();
                if ($request->lessons) {
                    foreach ($request->lessons as $key) {
                        DB::table('lesson_relationships')->insert([
                            'id_course' => $request->id,
                            'id_lesson' => $key,
                        ]);
                    }
                }

                return redirect()->route('index_khoa_hoc')->with('success', 'Sửa khóa học thành công!');
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi sửa khóa học: ' . $e->getMessage());
        }
    }

    public function deleteKhoaHoc($id, Request $request)
    {
        try {

            $ses = $request->session()->get('tk_user');

            if (isset($ses) && $request->session()->get('role') == 'admin') {

                $isInInvoice = DB::table('invoice_relationships')
                    ->where('id_course', $id)->exists();
                if ($isInInvoice) {
                    return redirect()->back()->with('fail', 'Khóa học đang được đặt mua bởi người dùng!');
                }
                $isInFavorite = DB::table('favorite_courses')
                    ->where('id_course', $id)->exists();
                if ($isInFavorite) {
                    return redirect()->back()->with('fail', 'Khóa học đang được theo dõi bởi người dùng!');
                }

                $lessonIds = DB::table('lesson_relationships')
                    ->where('id_course', '=', $id)
                    ->pluck('id_lesson');
                if ($lessonIds->isNotEmpty()) {
                    DB::table('lessons')->whereIn('id', $lessonIds)->delete();
                }
                //TODO: xóa comment tương ứng
                DB::table('invoice_relationships')->where('id_course', '=', $id)->delete();
                DB::table('lesson_relationships')->where('id_course', '=', $id)->delete();
                DB::table("favorite_courses")->where('id_course', '=', $id)->delete();
                DB::table('courses')->where('id', '=', $id)->delete();
                return redirect()->back()->with('success', 'Xóa khóa học thành công!');
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi xóa khóa học: ' . $e->getMessage());
        }
    }
    public function findKhoaHoc(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses)) {
                if (isset($_GET['s']) && strlen($_GET['s']) >= 1) {
                    $search_text = $_GET['s'];
                    $ds_khoa_hoc = DB::table('courses')
                        ->select(
                            'courses.id',
                            'courses.created_at',
                            'courses.name',
                            'courses.img',
                            'courses.gia_giam',
                            'slug',
                            'users.display_name as author_name'
                        )
                        ->leftJoin('users', 'users.id', 'courses.id_author')
                        ->where('courses.name', 'like', '%' . $search_text . '%')
                        ->orderBy('courses.id', 'desc')
                        ->paginate(15);
                    Session::put('tasks_url', $request->fullUrl());
                    return view("admin.khoahoc.danh_sach_khoa_hoc", compact('ds_khoa_hoc', 'search_text'));
                } else {
                    return redirect('/admin/index-khoa-hoc');
                }
            } else {
                $err = 'Hết phiên đăng nhập, vui lòng đăng nhập lại!';
                return redirect('/admin/login')->with('err', $err);
            }
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function toggleCommentShow($id)
    {
        $comment = DB::table('comments')->where('id', $id)->first();

        if ($comment) {
            $newShowStatus = !$comment->show;
            DB::table('comments')->where('id', $id)->update(['show' => $newShowStatus]);

            return response()->json(['success' => true, 'show' => $newShowStatus]);
        }

        return response()->json(['success' => false]);
    }
    public function deleteComment($id)
    {
        $deleted = DB::table('comments')->where('id', $id)->delete();

        return response()->json(['success' => $deleted ? true : false]);
    }
}
