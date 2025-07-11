<!DOCTYPE html>
<html lang="en">

<head>
   
    <meta charset="utf-8" />
    {{--
    <link rel="icon" href="%PUBLIC_URL%/favicon.ico" />--}}
    <link rel="shortcut icon" href="{{ asset('image/logo code_fun.png')}}" type="image/x-icon">

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="description" content="Web site created using create-react-app" />

    <link rel="apple-touch-icon" href="%PUBLIC_URL%/logo192.png" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&amp;display=swap" rel="stylesheet" />
    <link rel="manifest" href="%PUBLIC_URL%/manifest.json" />
    <link rel="stylesheet" href="{{Request::root().'/css/css_admin/theme.min.css'}}" />
    <link rel="stylesheet" href="{{Request::root().'/css/css_admin/vendor.min.css'}}" />
    <link rel="stylesheet" href="{{Request::root().'/js/libs_admin/icon-set/style.css'}}" />
    <title>Đăng kí tài khoản mới | CodeFun</title>
</head>

<body>
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="main">
        <div class="top-0 right-0 left-0 bg-img-hero"
            style=" height:100%; background-image: url('../image/cdc.jpg');">

            <!-- Content -->
            <div class="container py-2 py-sm-4">

                <div class="row justify-content-center">
                    <div class="col-md-7 col-lg-5">
                        <!-- Card -->
                        <div class="card card-lg mb-5">
                            <div class="card-body ">
                                <!-- Form -->
                                <form class="js-validate" action="{{Request::root().'/action-register'}}" method="post">
                                    @csrf
                                    <div class="text-center">
                                        <div class="mb-3">
                                            <div class="mb-3 d-flex align-items-center justify-content-center">
                                                <img src="{{ asset('image/logo code_fun.png')}}" class="img-fluid logo" alt="..." style="height:50px; width:50px;">
                                                <h1 class="display-4 ml-3">- Đăng ký tài khoản mới</h1>
                                            </div>                                            
                                            <h6 class="text-danger">{{empty($err)?'':$err}}</h6>

                                        </div>

                                    </div>

                                    <!-- Form Group -->
                                    <div class="js-form-message mb-3">
                                        <label class="input-label" for="signinSrEmail">Tên hiển thị người dùng</label>

                                        <input type="text" class="form-control form-control-md" name="fullname"
                                            id="signinSrEmail" tabindex="1" placeholder="Tên hiển thị người dùng"
                                            aria-label="email@address.com" required
                                            data-msg="Please enter a valid email address.">
                                    </div>
                                    <!-- End Form Group -->
                                    <!-- Form Group -->
                                    <div class="js-form-message mb-3">
                                        <label class="input-label" for="signinSrEmail">Tên đăng nhập</label>

                                        <input type="text" class="form-control form-control-md" name="username"
                                            id="signinSrEmail" tabindex="1" placeholder="Tên tài khoản"
                                            aria-label="email@address.com" required
                                            data-msg="Please enter a valid email address.">
                                    </div>
                                    <!-- End Form Group -->
                                    <div class="js-form-message mb-3">
                                        <label class="input-label" for="signinSrEmail">Số điện thoại</label>

                                        <input type="text" class="form-control form-control-md" name="phone"
                                            id="signinSrEmail" tabindex="1" placeholder="Số điện thoại"
                                            aria-label="email@address.com" required pattern="[0-9]*" title="Chỉ được nhập số"
                                            data-msg="Please enter a valid email address.">
                                    </div>
                                    <!-- Form Group -->
                                    <div class="js-form-message mb-3">
                                        <label class="input-label" for="signinSrEmail">Email</label>

                                        <input type="email" class="form-control form-control-md" name="email"
                                            id="signinSrEmail" tabindex="1" placeholder="Email"
                                            aria-label="email@address.com" required
                                            data-msg="Please enter a valid email address.">
                                    </div>
                                    <!-- End Form Group -->
                                    <!-- Form Group -->
                                    <div class="js-form-message mb-3">
                                        <label class="input-label" for="signupSrPassword" tabindex="0">
                                            <span class="d-flex justify-content-between align-items-center">
                                                Mật khẩu
                                            </span>
                                        </label>

                                        <div class="input-group input-group-merge">
                                            <input type="password"
                                                class="js-toggle-password form-control form-control-md" name="password"
                                                id="signupSrPassword" placeholder="Mật khẩu"
                                                aria-label="6+ characters required" required pattern=".{6,}"
                                                title="Vui lòng nhập từ 6 kí tự trở lên">
                                            {{-- <div id="changePassTarget" class="input-group-append">
                                                <a class="input-group-text" href="javascript:;">
                                                    <i id="changePassIcon" class="tio-hidden-outlined"></i>
                                                </a>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <!-- End Form Group -->
                                    <!-- Form Group -->
                                    <div class="js-form-message mb-3">
                                        <label class="input-label" for="signupSrConfirmPassword" tabindex="0">
                                            <span class="d-flex justify-content-between align-items-center">
                                                Nhập lại mật khẩu
                                            </span>
                                        </label>

                                        <div class="input-group input-group-merge">
                                            <input type="password"
                                                class="js-toggle-password form-control form-control-md"
                                                name="confirm_password" id="signupSrConfirmPassword"
                                                placeholder="Nhập lại mật khẩu" aria-label="6+ characters required"
                                                required pattern=".{6,}" title="Vui lòng nhập từ 6 kí tự trở lên">
                                            {{-- <div id="changePassTarget" class="input-group-append">
                                                <a class="input-group-text" href="javascript:;">
                                                    <i id="changePassIcon" class="tio-hidden-outlined"></i>
                                                </a>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <!-- End Form Group -->

                                    <button type="submit" class="btn btn-lg btn-block btn-dark">Đăng ký</button>

                                    <div class="text-center mt-3">
                                        <!-- <p style="font-size: 14px;">Khi đăng ký, bạn đã đồng ý với Điều khoản sử dụng và
                                            Chính sách bảo mật của chúng
                                            tôi.</p> -->
                                        <span>Bạn đã có tài khoản? <a href="{{ route('xdsoft.account.login')}}">Đăng
                                                nhập</a></span>
                                    </div>
                                </form>
                                <!-- End Form -->
                            </div>
                        </div>
                        <!-- End Card -->
                        <!-- End Content -->
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- JS Implementing Plugins -->
    <script src="{{Request::root().'/js/js_admin/vendor.min.js'}}"></script>
    <script src="{{Request::root().'/js/js_admin/theme.min.js'}}"></script>

</body>

</html>