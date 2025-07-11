<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZGDC9EN97L"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-ZGDC9EN97L');
    </script>
    <meta charset="utf-8" />
    {{--
    <link rel="icon" href="%PUBLIC_URL%/favicon.ico" /> --}}
    <link rel="shortcut icon" href="{{ asset('image/logo code_fun.png') }}" type="image/x-icon">

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="description" content="Web site created using create-react-app" />

    <link rel="apple-touch-icon" href="{{ asset('image/techwave-logo.png') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&amp;display=swap" rel="stylesheet" />
    <link rel="manifest" href="%PUBLIC_URL%/manifest.json" />
    <link rel="stylesheet" href="{{ Request::root() . '/css/css_admin/theme.min.css' }}" />
    <link rel="stylesheet" href="{{ Request::root() . '/css/css_admin/vendor.min.css' }}" />
    <link rel="stylesheet" href="{{ Request::root() . '/js/libs_admin/icon-set/style.css' }}" />
    <title>Đăng nhập | CodeFun</title>
</head>

<body>
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="main">
        <div class="position-fixed top-0 right-0 left-0 bg-img-hero"
            style=" height:100%; background-image: url('../image/cdc.jpg ');">


            <!-- Content -->
            <div class="container py-5 py-sm-7">

                <div class="row justify-content-center">
                    <div class="col-md-7 col-lg-5">
                        <!-- Card -->
                        <div class="card card-lg mb-5">
                            <div class="card-body">
                                <!-- Form -->
                                <form class="js-validate" action="{{ Request::root() . '/action-login' }}"
                                    method="post">
                                    @csrf
                                    <div class="text-center">
                                        <div class="mb-3">
                                            <div class="mb-3 d-flex align-items-center justify-content-center">
                                                <img src="{{ asset('image/logo code_fun.png') }}" class="img-fluid logo"
                                                    alt="..." style="height:100px; width:100px;">
                                                <h1 class="display-4 ml-3">- Đăng nhập</h1>
                                            </div>
                                            <h6 class="text-danger">{{ empty($err) ? '' : $err }}</h6>
                                            @if (session('tb'))
                                                <h5 class="text-success">{{ session('tb') }} </h5>
                                            @endif
                                        </div>

                                    </div>

                                    <!-- Form Group -->
                                    <div class="js-form-message mb-3">
                                        <label class="input-label" for="signinSrEmail">Tên tài khoản</label>

                                        <input type="text" class="form-control form-control-md" name="username"
                                            id="signinSrEmail" tabindex="1" placeholder="Tên tài khoản"
                                            aria-label="email@address.com" required
                                            data-msg="Please enter a valid email address.">
                                    </div>
                                    <!-- End Form Group -->

                                    <!-- Form Group -->
                                    <div class="js-form-message mb-3">
                                        <label class="input-label" for="signupSrPassword" tabindex="0">
                                            <span class="d-flex justify-content-between align-items-center">
                                                Mật khẩu
                                                <a class="input-label-secondary"
                                                    href="{{ route('xdsoft.account.forgetPassword') }}">Quên mật
                                                    khẩu?</a>
                                            </span>
                                        </label>
                                        <div class="input-group input-group-merge">
                                            <input type="password"
                                                class="js-toggle-password form-control form-control-md" name="password"
                                                id="signupSrPassword" placeholder="Mật khẩu"
                                                aria-label="6+ characters required" required pattern=".{6,}"
                                                title="Vui lòng nhập từ 6 kí tự trở lên">

                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-lg btn-block btn-dark">Đăng nhập</button>

                                    <div class="text-center mt-3">
                                        <span>Bạn chưa có tài khoản? <a
                                                href="{{ route('xdsoft.account.register') }}">Đăng
                                                ký</a></span>
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
    <script src="{{ Request::root() . '/js/js_admin/vendor.min.js' }}"></script>
    <script src="{{ Request::root() . '/js/js_admin/theme.min.js' }}"></script>
</body>

</html>
