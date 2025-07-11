<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    {{--    <link rel="icon" href="%PUBLIC_URL%/favicon.ico"/> --}}
    <link rel="icon" href="{{ asset('image/logo code_fun.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('image/logo code_fun.png') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="description" content="Web site created using create-react-app" />

    <link rel="apple-touch-icon" href="{{ asset('image/logo code_fun.png') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&amp;display=swap" rel="stylesheet" />
    <link rel="manifest" href="%PUBLIC_URL%/manifest.json" />

    <link rel="stylesheet" href="{{ asset('/css/css_admin/theme.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/css_admin/vendor.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/js/libs_admin/icon-set/style.css') }}" />
    <title>Quản trị CodeFun</title>
</head>

<body>
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="main">
        <div class="position-fixed top-0 right-0 left-0 bg-img-hero"
            style=" height:100%; background-image: url('../image/cdc.jpg');">
        </div>

        <!-- Content -->
        <div class="container py-5 py-sm-7">

            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <!-- Card -->
                    <div class="card card-lg mb-5">
                        <div class="card-body">
                            <!-- Form -->
                            <form class="js-validate" action="{{ asset('/admin/action-login') }}" method="post"
                                novalidate="novalidate">
                                @csrf
                                <div class="text-center">
                                    <div class="mb-5">
                                        <h1 class="display-4">Đăng nhập trang Quản trị</h1>

                                    </div>
                                    @if (session('err'))
                                        <h6 class="text-danger">
                                            {{ session('err') }}
                                        </h6>
                                    @endif

                                </div>

                                <!-- Form Group -->
                                <div class="js-form-message form-group">
                                    <label class="input-label" for="signinSrEmail">Tên tài khoản <span
                                            class="text-danger">(*)</span></label>

                                    <input type="email" class="form-control form-control-lg" name="username"
                                        id="signinSrEmail" tabindex="1" placeholder="email@address.com"
                                        aria-label="email@address.com" required=""
                                        data-msg="Please enter a valid email address." value="{{ old('username') }}">
                                    @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End Form Group -->

                                <!-- Form Group -->
                                <div class="js-form-message form-group">
                                    <label class="input-label" for="signinSrEmail">Mật khẩu <span
                                            class="text-danger">(*)</span></label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" class="js-toggle-password form-control form-control-lg"
                                            name="password" id="signupSrPassword" placeholder="6+ characters required"
                                            aria-label="6+ characters required" required="" pattern=".{6,}"
                                            title="Vui lòng nhập từ 6 kí tự trở lên">

                                        <div id="changePassTarget" class="input-group-append">
                                            <a class="input-group-text" href="javascript:;">
                                                <i id="changePassIcon" class="tio-hidden-outlined"></i>
                                            </a>
                                        </div>

                                    </div>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End Form Group -->

                                <button type="submit" class="btn btn-lg btn-block btn-dark">Đăng nhập</button>
                            </form>
                            <!-- End Form -->
                        </div>
                    </div>
                    <!-- End Card -->


                </div>
            </div>
        </div>
        <!-- End Content -->
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
    <!-- End New project Modal -->
    <!-- ========== END SECONDARY CONTENTS ========== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- JS Implementing Plugins -->
    <script src="{{ Request::root() . '/js/js_admin/vendor.min.js' }}"></script>
    <script src="{{ Request::root() . '/js/js_admin/theme.min.js' }}"></script>
</body>

</html>
