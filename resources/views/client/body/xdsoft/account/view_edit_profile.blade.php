@extends('client.layoutx.xdsoft.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/card.css') }}">
<link rel="stylesheet" href="{{ asset('css/footer.css') }}">
<style>
    /* Container for the form */
    .profile-form-container {
        max-width: 800px;
        margin: 0 auto;
        border: 2px solid black;
        padding: 20px;
        border-radius: 10px;
    }

    /* Avatar image */
    .avatar-uploader img {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid black;
    }

    /* Avatar container and input styling */
    .avatar-uploader-input {
        display: block;
        margin-top: 10px;
        width: 200px;
        margin-left: auto;
        margin-right: auto;
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

    /* Centered elements */
    .text-center {
        text-align: center;
    }

    /* Button styling */
    .btn {
        margin-top: 10px;
    }

    /* Title styling */
    .text-title {
        font-size: 24px;
        margin-bottom: 20px;
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
            <h4 class="text-title"><b>CHỈNH SỬA THÔNG TIN CÁ NHÂN</b></h4>
            <form action="{{ route('xdsoft.account.updateProfile') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Avatar -->
                <div class="form-group">
                    <input type="number" class="form-control" name="id"
                           value="{{$user->id}}"
                           id="projectNameProjectSettingsLabel" placeholder="ID"
                           aria-label="Enter project name here" hidden="">
                </div>
                <div class="form-group">
                    <label class="input-label">Ảnh đại diện</label>
                    <div class="text-center">
                        <label class="avatar avatar-xl avatar-circle avatar-uploader" for="avatarUploader">
                            <img id="output" class="avatar-img shadow-soft"
                                src="{{ $user->avatar ? asset( $user->avatar) : asset('image/no_img.jfif') }}"
                                alt="Avatar">
                        </label>
                    </div>
                    <!-- File input for avatar -->
                    <input type="file" class="js-file-attach avatar-uploader-input form-control"
                        id="avatarUploader" name="avatar" accept="image/*" onchange="loadFile(event)">
                </div>
                <!-- End Avatar -->

                <!-- User Info Form -->
                <div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label class="input-label">Tên đăng nhập</label>
                            <input type="text" class="form-control" name="username" required
                                value="{{ $user->username }}">
                        </div>
                        <div class="form-group col-6">
                            <label class="input-label">Tên hiển thị</label>
                            <input type="text" class="form-control" name="display_name" required
                                value="{{ $user->display_name }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label class="input-label">Email</label>
                            <input type="email" class="form-control" name="email" required
                                value="{{ $user->email }}">
                        </div>
                        <div class="form-group col-6">
                            <label class="input-label">Số điện thoại</label>
                            <input type="text" class="form-control" name="phone" required
                                value="{{ $user->phone }}" pattern="[0-9]*" title="Chỉ được nhập số">
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Xác nhận</button>
                    <a href="{{ route('xdsoft.account.profile') }}" class="btn btn-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </section>
</main>

<script>
    function loadFile(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src); // Free memory
        }
    }
</script>
@endsection