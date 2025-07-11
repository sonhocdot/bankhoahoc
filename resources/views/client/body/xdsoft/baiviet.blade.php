@extends('client.body.xdsoft.tintuc.layout_tin_tuc')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <style>
        html,
        body {
            height: 100%;
        }

        #body {
            display: flex;
            flex-direction: column;
            min-height: 100%;
        }

        .content {
            /* Định dạng cho nội dung trang */
            flex-grow: 1;
            /* Đảm bảo nội dung có thể mở rộng để lấp đầy không gian còn trống */
        }

        .menu-tintuc {
            margin-top: 30px;
            margin-bottom: 30px;
            font-size: 14px;
            line-height: 1.5;
        }

        .menu-tintuc li {
            padding-left: 5px !important;
            padding-right: 5px !important;
        }

        .menu-tintuc li a {
            color: black;
            border-radius: 3px;
            padding: 5px 10px;
        }


        .menu-tintuc li a.active,
        .menu-tintuc li a:hover {
            color: rgb(0, 170, 255) !important;
            background: #fff;
            border: 1px solid rgb(0, 170, 255);
            transition: 0.3s;
            text-decoration: none;
        }

        .phan_trang ul.pagination {
            font-size: 1.4rem;
            margin: 10px 0 20px 0 !important;
            padding-left: 10px !important;
        }

        .form-control,
        .form-control:hover {
            background-color: #fff !important;
            color: black !important;
        }
    </style>
@endsection

@section('content-left')
    <div class="container">

        @if (!empty($ds_category))
            <div class="menu-tintuc">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item mb-3"><a
                            class="text-uppercase {{ !empty($GET['cur_category']) ? 'active' : '' }}"
                            href="{{ route('xdsoft.baiviet', array_merge(request()->all(), ['cur_category' => null])) }}">tất
                            cả</a>
                    </li>
                    @foreach ($ds_category as $item)
                        <li class="list-inline-item mb-3">
                            <a class="text-uppercase {{ $item->slug == $cur_category ? 'active' : '' }}"
                                href="{{ route('xdsoft.baiviet', array_merge(request()->all(), ['cur_category' => $item->slug])) }}">{{ $item->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row tintuc">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                <div class="row mb-4">
                    <form action="{{ route('xdsoft.baiviet') }}" method="GET" class="form-inline row">
                        <div class="col-5">
                            <input type="text" name="keyword" class="form-control mr-2" placeholder="Tìm kiếm bài viết"
                                value="{{ request()->keyword }}">
                        </div>
                        <div class="col-5">
                            <select name="sort_by" class="form-control mr-2">
                                <option value="">Lọc theo</option>
                                <option value="newest" {{ request()->sort_by == 'newest' ? 'selected' : '' }}>Bài viết mới
                                    nhất</option>
                                <option value="popular" {{ request()->sort_by == 'popular' ? 'selected' : '' }}>Bài viết
                                    được xem nhiều nhất</option>
                                <option value="discuss" {{ request()->sort_by == 'discuss' ? 'selected' : '' }}>Bài viết
                                    được thảo luận nhiều nhất</option>

                            </select>
                        </div>

                        <button type="submit" class="btn btn-success col-2">Tìm kiếm</button>
                    </form>
                </div>
                @if ($post->count() > 0)
                    <div class="row top_1">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <a href="{{ route('tintuc.post', ['slug' => $post[0]->slug]) }}">
                                <img {{-- data-src="https://laptopxaydung.com/upload/assets/large/2023/0707/ne/01/i9/29-2023-07-07-3-17-53.png" --}} src="{{ $post[0]->post_image }}"
                                    alt="{{ $post[0]->post_title }}" class="img-responsive img_1 lazy"
                                    style="height: 350px; width:650px; object-fit:cover;">
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <a href="{{ route('tintuc.post', ['slug' => $post[0]->slug]) }}" title="">
                                <p class="text-uppercase py-4 text-dark " style="font-size: 22px; font-weight:bold;">
                                    {{ $post[0]->post_title }}</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="top_2">

                            <div class="top_2_1">
                                <div class="row">
                                    <div class="list-baiviet-second">
                                        @foreach ($post as $key => $item)
                                            @if ($key > 0)
                                                <div class="py-2">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-55">
                                                            <a class="thumnail-baiviet"
                                                                href="{{ route('tintuc.post', ['slug' => $item->slug]) }}">
                                                                <img class="mr-3 img-fluid" src="{{ $item->post_image }}"
                                                                    alt="{{ $item->post_title }}"
                                                                    style="height: 180px; width:240px; object-fit:cover;">
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                                                            <div class="media-body">
                                                                <div class="title-baiviet"><a
                                                                        style="font-size: 18px; font-weight:600;"
                                                                        href="{{ route('tintuc.post', ['slug' => $item->slug]) }}">{{ $item->post_title }}</a>
                                                                </div>
                                                                <div class="description-baiviet"
                                                                    style="font-size: 14px; margin: 10px 0 10px 0;">
                                                                    {{ $item->description }}</div>
                                                                <div class="info-baiviet"><span class="date-create"
                                                                        style=" color: #9f9f9f; font-size: 12px;">{{ date('d/m/Y', strtotime($item->post_date)) }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

                            </div>

                        </div>
                    </div>
                @endif
                <div class="phan_trang">
                    <div class="row justify-content-center align-items-sm-center">
                        {{ $post->links() }}
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 pl-5 pd-col-right">
                <div class="top_2">
                    <div class="top_2_5">
                        <div class="row block_1">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                                <p class="fw-bold m-0 fs-3"
                                    style="color:rgb(0, 170, 255);border-bottom: 1px solid #dcdcdc ;">Tin nổi bật
                                </p>
                            </div>
                        </div>
                        <div class="row p-3">
                            <div class="">
                                <div class="row pb-5">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="row">
                                            @foreach ($list_chu_de_noi_bat as $item)
                                                <div class="d-flex my-2" style="padding-left: 0; padding-right:0;">
                                                    <div style="width:30%">
                                                        <img src="{{ $item->post_image }}" alt="{{ $item->slug }}"
                                                            style="height: 70px; width:100px; object-fit:cover;">
                                                    </div>
                                                    <div style="width:70%">
                                                        <a href="{{ route('tintuc.post', ['slug' => $item->slug]) }}"
                                                            title="{{ $item->slug }}">
                                                            <p
                                                                style="font-size: 14px; margin-left:10px; font-weight:bold; color:black;">
                                                                {{ $item->post_title }}</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
