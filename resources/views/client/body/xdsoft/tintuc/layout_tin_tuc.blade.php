@extends('client.layoutx.xdsoft.app')


@section('css')
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <style>
        .comment-box {
        margin-bottom: 15px;
    }

    .user-info {
        display: flex;
    }

    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .comment-content {
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-left: 50px;
        padding: 10px 10px 0 10px;
    }
    .comment-content p {
        font-size: 12px;
    }

    .comment-actions {
        text-align: right;
    }
    .comment-box, .reply-box {
    scroll-margin-top: 80px; /* Đảm bảo giá trị này đúng và được áp dụng */
}
    </style>
@endsection
@section('content')
    <div class="content container mb-4 nav-top">

        {{--    <a href="{{Request::root().'/'}}" class="ms-4 mt-3 title">--}}
        {{--        <img src="https://thoitrangwiki.com/wp-content/uploads/2016/03/nha-dep-4-1.png">--}}
        {{--    </a>--}}

        <div class="row mt-4">
            @yield('content-left')
            @yield('content-right')
        </div>
    </div>

@endsection
