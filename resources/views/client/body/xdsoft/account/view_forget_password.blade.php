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
    <title>Đổi mật khẩu | CodeFun</title>
</head>

<body>
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="main">
        <div class="position-fixed top-0 right-0 left-0 bg-img-hero"
        style=" height:100%; background-image: url('../image/cdc.jpg');">

            <!-- Content -->
            <div class="container py-5 py-sm-7">

                <div class="row justify-content-center">
                    <div class="col-md-7 col-lg-5">
                        <!-- Card -->
                        <div class="card card-lg mb-5">
                            <div class="card-body">
                                <!-- Form -->
                                <form class="js-validate" action="{{Request::root().'/action-forget-password'}}"
                                    method="post">
                                    @csrf
                                    <div class="text-center">
                                        <div class="mb-3">
                                            <div class="mb-3 d-flex align-items-center justify-content-center">
                                                <img src="{{ asset('image/logo code_fun.png')}}" class="img-fluid logo" alt="..." style="height:100px; width:100px;">
                                                <h1 class="display-4 ml-3">- Đổi mật khẩu</h1>
                                            </div>
                                            <h6 class="text-danger">{{empty($err)?'':$err}}</h6>

                                        </div>

                                    </div>

                                    <!-- Form Group -->
                                    <div class="js-form-message mb-3">
                                        <label class="input-label" for="signinSrEmail">Tên tài khoản</label>

                                        <input type="text" class="form-control form-control-md" name="username"
                                            id="signinSrName" tabindex="1" placeholder="Tên tài khoản" required>
                                    </div>
                                    <!-- End Form Group -->

                                    <!-- Form Group -->
                                    <div class="js-form-message mb-3">
                                        <label class="input-label" for="signupSrPassword" tabindex="0">
                                            <span class="d-flex justify-content-between align-items-center">
                                                Email
                                            </span>
                                        </label>

                                        <div class="input-group input-group-merge">
                                            <input type="email" class="form-control form-control-md" name="email"
                                                id="signỉn" placeholder="Email" required>

                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-lg btn-block btn-dark">Hoàn thành</button>
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