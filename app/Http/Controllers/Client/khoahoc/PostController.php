<?php

namespace App\Http\Controllers\Client\khoahoc;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PostController extends Controller
{
    function getVideoIdFromYoutubeOrDrive($url)
    {
        $videoId = $url;

        $youtubePatterns = [
            '/youtu\.be\/([A-Za-z0-9_-]+)/',  // Dạng ngắn gọn
            '/youtube\.com\/v\/([A-Za-z0-9_-]+)/',  // Dạng /v/
            '/youtube\.com\/vi\/([A-Za-z0-9_-]+)/',  // Dạng /vi/
            '/youtube\.com\/.*[?&]v=([A-Za-z0-9_-]+)/',  // Dạng ?v=
            '/youtube\.com\/.*[?&]vi=([A-Za-z0-9_-]+)/',  // Dạng ?vi=
            '/youtube\.com\/embed\/([A-Za-z0-9_-]+)/',  // Dạng embed/
            '/youtube\.com\/watch\?v=([A-Za-z0-9_-]+)/',  // Dạng watch?v=
        ];

        foreach ($youtubePatterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                $videoId = $matches[1];
                break;
            }
        }

        $drivePattern = '/drive\.google\.com\/file\/d\/([A-Za-z0-9_-]+)/';
        if (preg_match($drivePattern, $url, $matches)) {
            $videoId = $matches[1];
        }

        return $videoId;
    }
    public function post_detail($post_name)
    {
        try {
            $course = $coursePaid = DB::table('courses')->where('slug', '=', $post_name)->first();
            $lessons = DB::table("lessons")
                ->select('lessons.id', 'lesson_title', 'video_id')
                ->join('lesson_relationships', 'lesson_relationships.id_lesson', 'lessons.id')
                ->join('courses', 'lesson_relationships.id_course', 'courses.id')
                ->where('lesson_relationships.id_course', $course->id)
                ->get()->toArray();
            foreach ($lessons as $lesson) {
                $lesson->videoID_embeded = $this->getVideoIdFromYoutubeOrDrive($lesson->video_id);
            }
           
           
            // Thêm cột vào khóa học
            $course->lesson_count = count($lessons);
            $course->author_course = DB::table('users')->where('id', $course->id_author)->first();

          
            $comments = DB::table('comments')
                ->select('comments.id', 'content', 'display_name', 'comments.created_at', 'rate', 'avatar')
                ->join('users', 'users.id', 'comments.id_user')
                ->where('id_course', $course->id)
                ->where('id_parent', null)
                ->where('show', 1)
                ->get()->toArray();
            $commentCount = count($comments);

            if (session('account_role') == 'user') {
                $coursePaid = DB::table('courses')
                    ->select('courses.id')
                    ->leftJoin('invoice_relationships', 'invoice_relationships.id_course', '=', 'courses.id')
                    ->leftJoin('invoices', 'invoice_relationships.id_invoice', '=', 'invoices.id')
                    ->where(function ($query) use ($course) {
                        $query->where('invoices.id_user', session('account_id'))
                            ->where('courses.id', $course->id)
                            ->where('invoices.trang_thai', 'Đã thanh toán');
                    })
                    ->orWhere(function ($query) use ($course) {
                        $query->where('courses.id', $course->id)
                            ->where('courses.gia_giam', 0);
                    })
                    ->first();
                if (!$coursePaid) {
                    $lessons = collect();
                }
            }
            if (!request()->cookie($post_name)) {
                DB::table('courses')->where('id', $course->id)->increment('view_count');
                return response(view('client.body.xdsoft.khoahoc.post_detail', compact('course', 'coursePaid', 'lessons', 'comments', 'commentCount')))
                    ->cookie($post_name, true, 900);
            }
            //$list_post_lien_quan = DB::table('soft_wares')->whereNot('slug','=',$post_name)->orderBy('id','desc')->limit(6)->get()->toArray();
            return view('client.body.xdsoft.khoahoc.post_detail', compact('course', 'coursePaid', 'lessons', 'comments', 'commentCount'));
        } catch (\Exception $e) {
            return view('errors.404');
        }
    }

    public function addComment(Request $request)
    {
        try {
            $ses = $request->session()->get('account_id');
            if (isset($ses)) {
                $idCourse = $request->id_post;
                $idUser = $request->id_user;

                $isFreeCourse = DB::table('courses')
                    ->where('id', $idCourse)
                    ->where('gia_giam', 0)
                    ->exists();
                if (!$isFreeCourse) {
                    $hasPurchased = DB::table('invoices')
                        ->join('invoice_relationships', 'invoices.id', '=', 'invoice_relationships.id_invoice')
                        ->where('invoices.id_user', $idUser)
                        ->where('invoice_relationships.id_course', $idCourse)
                        ->where('trang_thai', "Đã thanh toán")
                        ->exists();
                    if (!$hasPurchased) {
                        return back()->with('fail', 'Bạn chưa mua khóa học này, không thể thêm đánh giá.');
                    }
                }
                $hasCommented = DB::table('comments')
                    ->where('id_user', $idUser)
                    ->where('id_course', $idCourse)
                    ->exists();
                if ($hasCommented) {
                    return back()->with('fail', 'Bạn đã đánh giá về khóa học này trước đó.');
                }

                DB::table('comments')->insert([
                    'id_course' => $request->id_post,
                    'id_user' => $request->id_user,
                    'content' => $request->content,
                    'rate' => $request->rate,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'show' => 0
                ]);
                return back()->with('success', 'Đánh giá của bạn đã được gửi thành công! Hãy chờ quản trị viên duyệt qua đánh giá của bạn');
            } else {
                $err = 'Vui lòng đăng nhập để thực hiện tác vụ này!';
                return redirect('/login')->with('err', $err);
            }
        } catch (\Throwable $th) {
            return back()->with('fail', 'Lỗi khi gửi đánh giá khóa học: ' . $th->getMessage());
        }
    }
}
