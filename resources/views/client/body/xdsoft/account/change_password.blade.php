@extends('client.layoutx.xdsoft.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/card.css') }}">
<link rel="stylesheet" href="{{ asset('css/footer.css') }}">
<style>
    /* Container for the form */
    .profile-form-container {
        width: 400px;
        margin: 0 auto;
        border: 2px solid black;
        padding: 20px;
        border-radius: 10px;
    }

    /* General form styling */
    .form-control {
        background-color: white !important;
        color: black !important;
        border: 1px solid black;
        margin-bottom: 15px;
    }
    .form-control:hover {
        background-color: white !important;
        color: black !important;
    }
</style>
@endsection

@section('content')
<div style="height: 24px"></div>
<main class="h-100 mt-5">
    <section class="container-fluid h-100 mt-5 text-center p-5">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @elseif(session('fail'))
            <div class="alert alert-danger" role="alert">
                {{ session('fail') }}
            </div>
        @endif
        <div class="profile-form-container">
            <h4 class="text-title"><b>ĐỔI MẬT KHẨU</b></h4>
            <form class="js-validate" action="{{ route('xdsoft.account.actionChangePassword') }}" method="POST">
                @csrf
                <div class="text-center mb-3">
                    <!-- Thông báo lỗi -->
                    <h6 class="text-danger">{{empty($err)?'':$err}}</h6>

                </div>
            
                <!-- Mật khẩu hiện tại -->
                <div class="js-form-message mb-3">
                    <label class="input-label" for="currentPassword">
                        Mật khẩu hiện tại
                    </label>
                    <div class="input-group input-group-merge">
                        <input type="password" class="form-control form-control-md" name="current_password" id="currentPassword"
                            placeholder="Nhập mật khẩu hiện tại" required>
                    </div>
                </div>
            
                <!-- Mật khẩu mới -->
                <div class="js-form-message mb-3">
                    <label class="input-label" for="newPassword">
                        Mật khẩu mới
                    </label>
                    <div class="input-group input-group-merge">
                        <input type="password" class="form-control form-control-md" name="new_password" id="newPassword"
                            placeholder="Nhập mật khẩu mới" required pattern=".{6,}" title="Mật khẩu phải ít nhất 6 kí tự">
                    </div>
                </div>
            
                <!-- Xác nhận mật khẩu mới -->
                <div class="js-form-message mb-3">
                    <label class="input-label" for="confirmPassword">
                        Xác nhận mật khẩu mới
                    </label>
                    <div class="input-group input-group-merge">
                        <input type="password" class="form-control form-control-md" name="new_password_confirmation" id="confirmPassword"
                            placeholder="Nhập lại mật khẩu mới" required pattern=".{6,}" title="Mật khẩu phải ít nhất 6 kí tự">
                    </div>
                </div>
            
                <button type="submit" class="btn btn-lg btn-block btn-success">Đổi mật khẩu</button>
            </form>
            
        </div>
    </section>
</main>
@endsection