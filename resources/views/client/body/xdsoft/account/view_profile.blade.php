@extends('client.layoutx.xdsoft.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/card.css') }}">
<link rel="stylesheet" href="{{ asset('css/footer.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<style>
    /* Container for the form */
    .profile-form-container {
        width: 400px;
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

    .owl-nav {
        display: none !important;
    }
</style>
@endsection

@section('content')
<div style="height: 24px"></div>
<main class="h-100 mt-5">
    <section class="container-fluid h-100 mt-5 p-5">
        <div class="row">
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @elseif(session('fail'))
                <div class="alert alert-danger" role="alert">
                    {{ session('fail') }}
                </div>
            @endif
            <!-- User Info Display -->
            <div class="col-lg-4 col-md-12 mb-4">
                <div class="profile-form-container">
                    <h4 class="text-title"><b>THÔNG TIN CÁ NHÂN</b></h4>
                    
                    <!-- Avatar -->
                    <center>
                        <div class="form-group">
                            <label class="input-label">Ảnh đại diện</label>
                            <div class="text-center">
                                <img class="avatar-img shadow-soft"
                                    src="{{ $user->avatar ? asset($user->avatar) : asset('image/no_img.jfif')}}"
                                    alt="Avatar" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 1px solid black;">
                            </div>
                        </div>
                    </center>

                    <!-- Username -->
                    <div class="form-group">
                        <label class="input-label">Tên đăng nhập</label>
                        <input type="text" class="form-control" value="{{ $user->username }}" disabled>
                    </div>

                    <!-- Display Name -->
                    <div class="form-group">
                        <label class="input-label">Tên hiển thị</label>
                        <input type="text" class="form-control" value="{{ $user->display_name }}" disabled>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label class="input-label">Email</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                    </div>

                    <!-- Phone -->
                    <div class="form-group">
                        <label class="input-label">Số điện thoại</label>
                        <input type="text" class="form-control" value="{{ $user->phone }}" disabled pattern="[0-9]*" title="Chỉ được nhập số">
                    </div>

                    <!-- Edit Profile Button -->
                    <div class="text-center mt-4">
                        <a href="{{ route('xdsoft.account.editProfile') }}" class="btn btn-success">Sửa thông tin</a>
                        <a href="{{ route('xdsoft.account.changePassword') }}" class="btn btn-danger">Đổi mật khẩu</a>

                    </div>
                </div>
            </div>
            <!-- End User Info Display -->

            <div class="col-lg-8 col-md-12 mb-4">
                <div class="course-list-container">
                    <h4 class="text-title"><b>KHÓA HỌC ĐÃ MUA</b></h4>
                    <div class="courses-carousel owl-carousel">
                        @forelse ($purchasedCourses as $course)
                            <div class="p-3">
                                <div class="item card border rounded shadow-sm">
                                    <img src="{{ $course->img }}" alt="{{ $course->name }}" 
                                        class="card-img-top img-fluid w-100" 
                                        style="height: 200px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-center mb-3">
                                            <strong>{{ $course->name }}</strong>
                                        </h5>
                                        <p class="card-text text-dark mb-2 fs-5">
                                            {{ $course->description }}
                                        </p>
                                        <p class="text-secondary mt-auto fs-5 fst-italic">
                                            Ngày mua: {{ $course->purchase_date }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                        <p>Bạn chưa mua khóa học nào.</p>
                        @endforelse
                    </div>
                </div>
                
                <div class="course-list-container mt-4">
                    <h4 class="text-title"><b>KHÓA HỌC ĐÃ THEO DÕI</b></h4>
                    <div class="courses-carousel owl-carousel">
                        @forelse ($favoriteCourses as $course)
                            <div class="p-3">
                                <div class="item card border rounded shadow-sm">
                                    <img src="{{ $course->img }}" alt="{{ $course->name }}" 
                                        class="card-img-top img-fluid w-100" 
                                        style="height: 200px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-center mb-3">
                                            <strong>{{ $course->name }}</strong>
                                        </h5>
                                        <p class="card-text text-dark mb-2 fs-5">
                                            {{ $course->description }}
                                        </p>
                                        <p class="text-secondary mt-auto fs-5 fst-italic">
                                            Ngày theo dõi: {{ $course->favorite_date }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>Bạn chưa theo dõi khóa học nào.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            
        </div>
    </section>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    $('.courses-carousel').owlCarousel({
        loop: false,
        nav: false,
        responsive: {
            0: { items: 1 },
            768: { items: 2 },
            1200: { items: 3 }
        }
    });
});

</script>
@endsection
