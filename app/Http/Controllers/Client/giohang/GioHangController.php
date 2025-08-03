<?php

namespace App\Http\Controllers\Client\giohang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

use Illuminate\Support\Facades\DB;

class GioHangController extends Controller
{
    public function addToCart($id)
    {
        try {
            if (!session()->has('account_id')) {
                $err = 'Vui lòng đăng nhập để thực hiện tác vụ này!';
                return redirect('/login')->with('err', $err);
            }

            // $cart = session()->get('cart', []);
            $accountId = session('account_id');
            $user = DB::table('users')->where('id', $accountId)->first();
            $course = DB::table('courses')->where('id', $id)->first(); // Giả sử bảng khóa học là 'courses'

            // Kiểm tra xem khóa học có tồn tại không
            if (!$course) {
                return redirect()->back()->with('fail', 'Không tìm thấy khóa học.');
            }
            $invoice = DB::table('invoices')
                ->where('id_user', $accountId)
                ->where('trang_thai', 'Chưa mua')
                ->orderBy("id", "desc")
                ->first();
            if (!$invoice) {
                $invoiceId = DB::table('invoices')->insertGetId([
                    'ho_ten' => $user->display_name,
                    'email' => $user->email,
                    'so_dien_thoai' => $user->phone,
                    'gia_goc' => 0,
                    'gia_giam' => 0,
                    'ghi_chu' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id_user' => $accountId,
                    'trang_thai' => 'Chưa mua'
                ]);
            } else {
                $invoiceId = $invoice->id;
            }

            $exists = DB::table('invoice_relationships')
                ->where('id_invoice', $invoiceId)
                ->where('id_course', $course->id)
                ->exists();

            if (!$exists) {
                DB::table('invoice_relationships')->insert([
                    'id_invoice' => $invoiceId,
                    'id_course' => $course->id,
                ]);
                DB::table('invoices')->where('id', $invoiceId)->increment('gia_goc', $course->gia_goc);
                DB::table('invoices')->where('id', $invoiceId)->increment('gia_giam', $course->gia_giam);
            }
            return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi thêm vào giỏ hàng: ' . $e->getMessage());
        }
    }

    public function addToCartNow($id)
    {
        try {
            if (!session()->has('account_id')) {
                $err = 'Vui lòng đăng nhập để thực hiện tác vụ này!';
                return redirect('/login')->with('err', $err);
            }
            $course = Course::findOrFail($id);
            $accountId = session('account_id');
            $user = DB::table('users')->where('id', $accountId)->first();
            $invoice = DB::table('invoices')
                ->where('id_user', $accountId)
                ->where('trang_thai', 'Chưa mua')
                ->orderBy("id", "desc")
                ->first();
            if (!$invoice) {
                $invoiceId = DB::table('invoices')->insertGetId([
                    'ho_ten' => $user->display_name,
                    'email' => $user->email,
                    'so_dien_thoai' => $user->phone,
                    'gia_goc' => 0,
                    'gia_giam' => 0,
                    'ghi_chu' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id_user' => $accountId,
                    'trang_thai' => 'Chưa mua'
                ]);
            } else {
                $invoiceId = $invoice->id;
            }

            $exists = DB::table('invoice_relationships')
                ->where('id_invoice', $invoiceId)
                ->where('id_course', $course->id)
                ->exists();

            if (!$exists) {
                DB::table('invoice_relationships')->insert([
                    'id_invoice' => $invoiceId,
                    'id_course' => $course->id,
                ]);
                DB::table('invoices')->where('id', $invoiceId)->increment('gia_goc', $course->gia_goc);
                DB::table('invoices')->where('id', $invoiceId)->increment('gia_giam', $course->gia_giam);
            }
            return redirect()->route('xdsoft.cart')->with('success', 'Đã thêm vào giỏ hàng!');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Có lỗi xảy ra khi thêm vào giỏ hàng: ' . $e->getMessage());
        }
    }



    public function deleteCartItem(Request $request)
    {
        try {
            if (!session()->has('account_id')) {
                return response()->json(['message' => 'Đã hết phiên đăng nhập, vui lòng đăng nhập lại!'], 403);
            }
            $userId = session('account_id');
            $invoice = DB::table('invoices')
                ->where('id_user', $userId)
                ->where('trang_thai', 'Chưa mua')
                ->orderBy("id", "desc")
                ->first();

            if ($invoice) {
                DB::table('invoice_relationships')
                    ->where('id_invoice', $invoice->id)
                    ->where('id_course', $request->id)
                    ->delete();
                $course = DB::table('courses')->where('id', $request->id)->first();
                if (!$course) {
                    return response()->json(['message' => 'Khóa học không tồn tại!'], 404);
                }
                DB::table('invoices')->where('id', $invoice->id)->decrement('gia_goc', $course->gia_goc);
                DB::table('invoices')->where('id', $invoice->id)->decrement('gia_giam', $course->gia_giam);
                return response()->json(['message' => 'Xóa khóa học khỏi giỏ hàng thành công!']);
            } else {
                return response()->json(['message' => 'Không tìm thấy hóa đơn hợp lệ!'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Có lỗi xảy ra khi xóa khóa học: ' . $e->getMessage()], 404);
        }
    }

    public function deleteAllCart(Request $request)
    {
        try {
            if (!session()->has('account_id')) {
                $err = 'Vui lòng đăng nhập để thực hiện tác vụ này!';
                return redirect('/login')->with('err', $err);
            }
            $userId = session('account_id');
            $invoice = DB::table('invoices')
                ->where('id_user', $userId)
                ->where('trang_thai', 'Chưa mua')
                ->orderBy("id", "desc")
                ->first();

            if ($invoice) {
                DB::table('invoice_relationships')
                    ->where('id_invoice', $invoice->id)
                    ->delete();
                DB::table('invoices')
                    ->where('id', $invoice->id)
                    ->delete();
            }
            return redirect()->back()->with('success', 'Đã xóa tất cả khóa học khỏi giỏ hàng!');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Xóa tất cả khóa học thất bại: ' . $e->getMessage());
        }
    }

    public function insertCart(Request $request)
    {
        try {
            if (!session()->has('account_id')) {
                $err = 'Vui lòng đăng nhập để thực hiện tác vụ này!';
                return redirect('/login')->with('err', $err);
            }

            $accountId = session('account_id');
            $invoice = DB::table('invoices')
                ->where('id_user', $accountId)
                ->where('trang_thai', 'Chưa mua')
                ->orderBy("id", "desc")
                ->first();
            $existCourse = DB::table(('invoice_relationships'))
                ->where('id_invoice', $invoice->id)->exists();
            if ($invoice && $existCourse) {
                DB::table('invoices')
                    ->where('id', $invoice->id)
                    ->update([
                        'ho_ten' => $request->ho_ten,
                        'email' => $request->email,
                        'so_dien_thoai' => $request->so_dien_thoai,
                        'gia_goc' => $request->gia_goc,
                        'gia_giam' => $request->gia_giam,
                        'ghi_chu' => $request->ghi_chu,
                        'updated_at' => date('y-m-d h:i:s'),
                        'id_user' => session('account_id'),
                        'trang_thai' => "Đã đặt mua"
                    ]);
            } else {
                return back()->with('fail', 'Lỗi không tồn tại giỏ hàng, vui lòng thử lại!');
            }
            GioHangController::deleteAllCart($request);
            return redirect()->back()->with('success', 'Đặt hàng thành công! Nhân viên hỗ trợ sẽ liên hệ với bạn sớm nhất.');
        } catch (\Exception $e) {
            return back()->with('fail', 'Đã xảy ra lỗi khi đặt hàng: ' . $e->getMessage());
        }
    }

    public function processVNPay(Request $request)
    {
        $invoice = DB::table('invoices')
            ->where('id_user', session('account_id'))
            ->where('trang_thai', 'Chưa mua')->orderBy('id', 'desc')->first();
        if (!$invoice) {
            return redirect()->route('xdsoft.cart')->with('error', 'Không tìm thấy giỏ hàng hợp lệ!');
        } else {
            DB::table('invoices')
                ->where('id', $invoice->id)
                ->update([
                    'ho_ten' => $request->ho_ten,
                    'email' => $request->email,
                    'so_dien_thoai' => $request->so_dien_thoai,
                    'gia_goc' => $request->gia_goc,
                    'gia_giam' => $request->gia_giam,
                    'ghi_chu' => $request->ghi_chu,
                    'updated_at' => date('y-m-d h:i:s')
                ]);
        }

        $vnp_TmnCode = "1JSVVDV5"; // Mã website tại VNPAY
        $vnp_HashSecret = "7YJN7PE7K8RAG0LHGXIVDQ3YWYDMBAKV"; // Chuỗi bí mật
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return');

        $vnp_TxnRef = time(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán đơn hàng #{$vnp_TxnRef}";
        $vnp_OrderType = "CodeFun";
        $vnp_Amount = $request->amount * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,

        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }

        return redirect($vnp_Url);
    }
    public function vnpayReturn(Request $request)
    {
        try {
            if ($request->vnp_ResponseCode == '00') {
                // Cập nhật trạng thái hóa đơn
                DB::table('invoices')
                    ->where('id_user', session('account_id'))
                    ->where('trang_thai', 'Chưa mua')
                    ->update(['trang_thai' => 'Đã thanh toán']);
                return redirect()->route('xdsoft.cart')->with('success', 'Thanh toán thành công!');
            } else {
                DB::table('invoices')
                    ->where('id_user', session('account_id'))
                    ->where('trang_thai', 'Chưa mua')
                    ->update(['trang_thai' => 'Lỗi thanh toán']);
                return redirect()->route('xdsoft.cart')->with('error', 'Thanh toán không thành công!');
            }
        } catch (\Exception $e) {
            return redirect()->route('xdsoft.cart')->with('error', 'Xảy ra lỗi trong khi thanh toán! Vui lòng thử lại. Chi tiết lỗi: ' . $e->getMessage());
        }
    }
}
