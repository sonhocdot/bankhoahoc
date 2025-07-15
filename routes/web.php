<?php

use App\Http\Controllers\Admin\BaiVietController;
use App\Http\Controllers\Admin\KhoaHocController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Client\account\AccountController;
use App\Http\Controllers\Client\MainController;
use App\Http\Controllers\Client\giohang\GioHangController;
use App\Http\Controllers\Client\tintuc\PostController;
use App\Http\Controllers\Admin\TermKhoaHocController;
use App\Http\Controllers\Admin\TermHuongDanController;
use App\Http\Controllers\Admin\PictureController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('/admin')->group(function () {
    // Sử dụng Route::controller để không cần lặp lại tên controller
    Route::controller(KhoaHocController::class)->group(function () {
        Route::get('/trang-chu', 'indexKhoaHoc')->name('trang_chu');
        Route::get('/', 'indexKhoaHoc')->name('trang_chu');
        Route::get('/them-khoa-hoc', 'themKhoaHoc')->name('them_khoa_hoc');
        Route::post('/insert-khoa-hoc', 'insertKhoaHoc')->name('insert_khoa_hoc');
        Route::get('/index-khoa-hoc', 'indexKhoaHoc')->name('index_khoa_hoc');
        Route::get('/edit-khoa-hoc/{id}', 'pageEditKhoaHoc')->name('page_edit_khoa_hoc');
        Route::post('/edit-khoa-hoc', 'editKhoaHoc')->name('edit_khoa_hoc');
        Route::get('/delete-khoa-hoc/{id}', 'deleteKhoaHoc')->name('delete_khoa_hoc');
        Route::get('/find-khoa-hoc', 'findKhoaHoc')->name('find_khoa_hoc');
        Route::patch('/toggle-comment-course-show/{id}', 'toggleCommentShow')->name('show_comment_KH');
        Route::delete('/delete-comment-course/{id}', 'deleteComment')->name('delete_comment_KH');
    });

    Route::controller(BaiVietController::class)->group(function () {
        Route::get('/them-bai-viet', 'themBaiViet')->name('themBV');
        Route::post('/them-bai-viet', 'luuBaiViet')->name('luuBV');
        Route::get('/index-bai-viet', 'danhSachBaiViet')->name('indexBV');
        Route::get('/sua-bai-viet/{id}', 'suaBaiViet')->name('suaBV');
        Route::put('/sua-bai-viet', 'updateBaiViet')->name('updateBV');
        Route::delete('xoa-bai-viet/{id}', 'xoaBaiViet')->name('xoaBV');
        Route::get('/tim-kiem', 'timBaiViet')->name('timkiemBV');
        Route::patch('/toggle-comment-post-show/{id}', 'toggleCommentShow')->name('show_comment_BV');
        Route::delete('/delete-comment-post/{id}', 'deleteComment')->name('delete_comment_BV');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/login', 'view_login')->name('view_login');
        Route::post('/action-login', 'action_login')->name('action_login');

        Route::get('/them-user', 'page_user')->name('page_user');
        Route::post('/insert-user', 'insert_user')->name('insert_user');
        Route::get('/index-user', 'index_user')->name('index_user');

        Route::get('/edit-user/{id}', 'page_edit_user')->name('page_edit_user');
        // Lưu ý: Route cập nhật thường dùng PUT/PATCH và có {id} trong URL
        Route::post('/edit-user', 'edit_user')->name('edit_user');

        // Lưu ý: Route xóa thường dùng DELETE
        Route::get('/delete-user/{id}', 'delete_user')->name('delete_user');

        Route::get('/find-user', 'find_user')->name('find_user');
        Route::get('/logout', 'indexLogout')->name('admin.logout');
    });
    Route::controller(LessonController::class)->group(function () {
        Route::get('/them-lesson', 'themLesson')->name('them_lesson');
        Route::post('/insert-lesson', 'insertLesson')->name('insert_lesson');
        Route::get('/index-lesson', 'indexLesson')->name('index_lesson');
        Route::get('/edit-lesson/{id}', 'pageEditLesson')->name('page_edit_lesson');
        Route::post('/edit-lesson', 'editLesson')->name('edit_lesson');
        Route::get('/delete-lesson/{id}', 'deleteLesson')->name('delete_lesson');
        Route::get('/find-lesson', 'findLesson')->name('find_lesson');
    });
    Route::controller(TermKhoaHocController::class)->group(function () {
        Route::get('/them-term-khoa-hoc', 'themTermKhoaHoc')->name('them_term_KH');
        Route::post('/insert-term-khoa-hoc', 'insertTermKhoaHoc')->name('insert_term_KH');
        Route::get('/index-terms-khoa-hoc', 'indexTermsKhoaHoc')->name('index_terms_KH');
        Route::get('/edit-term-khoa-hoc/{id}', 'pageEditTermKhoaHoc')->name('page_edit_term_KH');
        Route::post('/edit-term-khoa-hoc', 'editTermKhoaHoc')->name('edit_term_KH');
        Route::get('/delete-term-khoa-hoc/{id}', 'deleteTermKhoaHoc')->name('delete_term_KH');
        Route::get('/find-term-khoa-hoc', 'findTermKhoaHoc')->name('find_term_KH');
    });
    Route::controller(TermHuongDanController::class)->group(function () {
        Route::get('/them-term-huong-dan', 'themTermHuongDan')->name('them_term_HD');
        Route::post('/insert-term-huong-dan', 'insertTermHuongDan')->name('insert_term_HD');
        Route::get('/index-terms-huong-dan', 'indexTermsHuongDan')->name('index_terms_HD');
        Route::get('/edit-term-huong-dan/{id}', 'pageEditTermHuongDan')->name('page_edit_term_HD');
        Route::post('/edit-term-huong-dan', 'editTermHuongDan')->name('edit_term_HD');
        Route::get('/delete-term-huong-dan/{id}', 'deleteTermHuongDan')->name('delete_term_HD');
        Route::get('/find-term-bai-viet', 'findTermHuongDan')->name('find_term_HD');
    });
    Route::controller(PictureController::class)->group(function () {
        Route::get('/them-picture', 'themPicture')->name('them_picture');
        Route::post('/insert-picture', 'insertPicture')->name('insert_picture');
        Route::get('/index-picture', 'indexPicture')->name('index_picture');
        Route::get('/edit-picture/{id}', 'pageEditPicture')->name('page_edit_picture');
        Route::post('/edit-picture', 'editPicture')->name('edit_picture');
        Route::get('/delete-picture/{id}', 'deletePicture')->name('delete_picture');
        Route::get('/find-picture', 'findPicture')->name('find_picture');
    });
    Route::controller(\App\Http\Controllers\Admin\GioHangController::class)->group(function () {
        Route::get('/them-gio-hang', 'themGioHang')->name('them_gio_hang');
        Route::post('/insert-gio-hang', 'insertGioHang')->name('insert_gio_hang');
        Route::get('/index-gio-hang', 'indexGioHang')->name('index_gio_hang');
        Route::get('/edit-gio-hang/{id}', 'pageEditGioHang')->name('page_edit_gio_hang');
        Route::post('/edit-gio-hang', 'editGioHang')->name('edit_gio_hang');
        Route::get('/delete-gio-hang/{id}', 'deleteGioHang')->name('delete_gio_hang');
        Route::get('/find-gio-hang', 'findGioHang')->name('find_gio_hang');
    });
    Route::controller(\App\Http\Controllers\Admin\QuizController::class)->group(function () {
        Route::get('/them-bai-trac-nghiem', 'themTracNghiem')->name('them_trac_nghiem');
        Route::post('/insert-bai-trac-nghiem', 'insertTracNghiem')->name('insert_trac_nghiem');
        Route::get('/index-bai-trac-nghiem', 'indexTracNghiem')->name('index_trac_nghiem');
        Route::get('/edit-bai-trac-nghiem/{id}', 'pageEditTracNghiem')->name('page_edit_trac_nghiem');
        Route::post('/edit-bai-trac-nghiem', 'editTracNghiem')->name('edit_trac_nghiem');
        Route::get('/delete-bai-trac-nghiem/{id}', 'deleteTracNghiem')->name('delete_trac_nghiem');
        Route::get('/find-bai-trac-nghiem', 'findTracNghiem')->name('find_trac_nghiem');
    });
    Route::controller(\App\Http\Controllers\Admin\QuizAttemptController::class)->group(function () {
        Route::get('/them-history-trac-nghiem', 'themHistoryTracNghiem')->name('them_history_trac_nghiem');
        Route::post('/insert-history-trac-nghiem', 'insertHistoryTracNghiem')->name('insert_history_trac_nghiem');
        Route::get('/index-history-trac-nghiem', 'indexHistoryTracNghiem')->name('index_history_trac_nghiem');
        Route::get('/edit-history-trac-nghiem/{id}', 'pageEditHistoryTracNghiem')->name('page_edit_history_trac_nghiem');
        Route::post('/edit-history-trac-nghiem', 'editHistoryTracNghiem')->name('edit_history_trac_nghiem');
        Route::get('/delete-history-trac-nghiem/{id}', 'deleteHistoryTracNghiem')->name('delete_history_trac_nghiem');
        Route::get('/find-history-trac-nghiem', 'findHistoryTracNghiem')->name('find_history_trac_nghiem');
    });
});

Route::controller(GioHangController::class)->group(function () {
    Route::get('/add-to-cart/{id}', 'addToCart')->name('add_to_cart');
    Route::get('/add-to-cart-now/{id}', 'addToCartNow')->name('add_to_cart_now');
    Route::post('/insert-cart', 'insertCart')->name('insert_cart');
    Route::delete('/delete-cart-item', 'deleteCartItem')->name('delete_cart_item');
    Route::get('/delete-all-cart', 'deleteAllCart')->name('delete_all_cart');

    Route::post('/vnpay/payment', 'processVNPay')->name('vnpay.payment');
    Route::get('/vnpay/return', 'vnpayReturn')->name('vnpay.return');
}); // của khách hàng

Route::controller(MainController::class)->group(function () {
    Route::get('/', 'homepage')->name('xdsoft.mainpage');
    Route::get('/tintuc', 'tintuc')->name('xdsoft.tintuc');
    Route::get('/khoahoc', 'khoahoc')->name('xdsoft.khoahoc');
    Route::get('/baiviet', 'dohoa')->name('xdsoft.baiviet');
    Route::get('/chitiet/{type?}/{id?}', 'chitiet')->name('xdsoft.chitiet');
    Route::get('/chitiet/tintuc/posts/{news}', 'detail_topic')->name('xdsoft.detail.topic');
    Route::get('/chitiet/tintuc/sub/{news}', 'detail_topic_v2')->name('xdsoft.detail.topic.small');
    Route::get('/chitiet/tintuc/chude/{news}', 'detail_chude')->name('xdsoft.detail.chude');
    Route::get('/giohang', 'cart')->name('xdsoft.cart');
    Route::post('/insert/baogia', 'insert_bao_gia')->name('xdsoft.create.baogia');
    Route::get('/tracnghiem', 'tracnghiem')->name('xdsoft.tracnghiem');
});

Route::controller(AccountController::class)->group(function () {
    Route::get('/login', 'indexLogin')->name('xdsoft.account.login');
    Route::get('/register', 'indexRegister')->name('xdsoft.account.register');
    Route::get('/forget-password', 'indexForgetPassword')->name('xdsoft.account.forgetPassword');
    Route::get('/edit-password', 'indexEditPassword')->name('xdsoft.account.editPassword');
    Route::post('/action-login', 'actionLogin')->name('xdsoft.account.actionLogin');
    Route::post('/action-register', 'actionRegister')->name('xdsoft.account.actionRegister');
    Route::post('/action-forget-password', 'actionForgetPassword')->name('xdsoft.account.actionForgetPassword');
    Route::post('/action-edit-password', 'actionEditPassword')->name('xdsoft.account.actionEditPassword');
    Route::get('/profile', 'indexProfile')->name('xdsoft.account.profile');
    Route::get('/edit-profile', 'editProfile')->name('xdsoft.account.editProfile');
    Route::post('/update-profile', 'updateProfile')->name('xdsoft.account.updateProfile');
    Route::get('/change-password', 'changePassword')->name('xdsoft.account.changePassword');
    Route::post('/action-change-password', 'actionChangePassword')->name('xdsoft.account.actionChangePassword');
    Route::get('/logout', 'indexLogout')->name('xdsoft.account.logout');
    Route::post('/courses/favorite', 'toggleFavoriteCourse')->name('xdsoft.account.favoriteCourse');
});

Route::controller(App\Http\Controllers\Client\tintuc\PostController::class)->group(function () {
    Route::get('/tintuc/{slug}', 'post_detail')->name('tintuc.post');
    Route::post('/tintuc/addComment', 'addComment')->name('tintuc.addComment');
    Route::post('/tintuc/replyComment', 'replyComment')->name('tintuc.replyComment');
    Route::post('/tintuc/reportComment', 'reportComment')->name('tintuc.reportComment');
});
Route::controller(App\Http\Controllers\Client\khoahoc\PostController::class)->group(function () {
    Route::get('/khoa-hoc/{slug}', 'post_detail')->name('khoahoc.post');
    Route::post('/khoa-hoc/comment', 'addComment')->name('khoahoc.addComment');
    // Route::post('/khoa-hoc/report-comment', 'reportComment')->name('khoahoc.reportComment');
    // Route::post('/khoa-hoc/reply-comment', 'replyComment')->name('khoahoc.replyComment');

});
Route::controller(App\Http\Controllers\Client\tracnghiem\QuizController::class)->group(function () {
    Route::get('/tracnghiem/{id}', 'show')->name('quiz.show');
    Route::post('/tracnghiem/{id}/submit', 'submit')->name('quiz.submit');
});
