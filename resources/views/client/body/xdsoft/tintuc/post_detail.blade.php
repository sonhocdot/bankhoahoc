@extends('client.body.xdsoft.tintuc.layout_tin_tuc')

@section('content-left')

    <div class="content-left col-xxl-9 col-xl-9 col-lg-2 col-lg-9 col-md-9 col-sm-12 col-xs-12  ">
        <header class="entry-header">
            <h1 class="entry-title">{{ $post->post_title }}</h1>
            <div class="post-meta my-2">
                <span class="meta-date date updated"><i class="fa fa-calendar"></i>{{ $post->post_date }}</span>
            </div>
        </header>
        <div class="entry-content">
            {!! html_entity_decode($post->post_content) !!}
        </div>
        <div id="show_post_related">
            <div class="row">
                <div class="border-top mt-5 pt-3 col-xs-12">
                    <h3><span class=" title_text primary-color text-uppercase font-bold">Bài viết liên quan</span>
                    </h3>
                    <div class="row auto-clear fix-safari" style="margin-top: 30px">

                        @foreach ($list_post_lien_quan as $item)
                            <div class="col-12 col-xl-4 col-md-6 mb-5 p-3 pt-0">
                                <a href="{{ route('tintuc.post', ['slug' => $item->slug]) }}" class="text-decoration-none">
                                    <div class="card card-hover w-100 p-0 container border-0 text-start">
                                        <img src="{{ $item->post_image }}" class="rounded mx-auto d-block img-fluid"
                                            style="width:250px; height:180px;" alt="...">
                                        <div class="card-body mb-3">
                                            <h5 class="card-title overflow-hidden text-black">{{ $item->post_title }}</h5>
                                            <h6 class="card-title overflow-hidden text-dark text-decrip-2"
                                                style="height: 40px">{{ $item->description }}</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <br>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <div id="post-comment" class="mt-4">
            <h4>Viết bình luận</h4>
            <form action="{{ route('tintuc.addComment') }}" method="POST">
                @csrf
                <input type="hidden" name="id_post" value="{{ $post->id }}">
                <input type="hidden" name="id_user" value="{{ session('account_id') }}">
                <div class="mb-3">
                    <label for="content" class="form-label">Bình luận:</label>
                    <textarea name="content" id="content" class="form-control"
                        style="background-color: white!important; color:black!important;" placeholder="Nhập bình luận của bạn"
                        rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Gửi</button>
            </form>
        </div>

        <!-- Danh sách bình luận -->
        <div id="comments-list" class="mt-5">
            <h4>Bình luận ({{ $post->comment_count }})</h4>
            @foreach ($comments as $comment)
                <div class="comment-box mb-4" id="comment-{{ $comment->id }}" >
                    <div class="user-info" >
                        <img src="{{ $comment->avatar ? asset($comment->avatar) : asset('image/no_img.jfif') }}"
                            alt="Avatar" class="avatar">
                        <strong class="fs-5">{{ $comment->display_name }}</strong>
                        <div class="ms-3"><small>Bình luận lúc
                                {{ \Carbon\Carbon::parse($comment->created_at)->format('d-m-Y H:i:s') }}</small></div>
                    </div>
                    <div class="">
                        <div class="comment-content mb-1">
                            @if ($comment->show == 1)
                                <p>{{ $comment->content }}</p>
                            @else
                                <p class="text-muted fst-italic">Bình luận đã được ẩn</p>
                            @endif
                        </div>
                        {{-- HIỂN THỊ THÔNG BÁO NGAY ĐÂY --}}
                        @if (session('highlight_comment_id') == $comment->id)
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show mt-2 py-2" role="alert"
                                    id="flash-message-{{ $comment->id }}">
                                    {{ session('success') }}
                                    
                                </div>
                            @endif
                            {{-- Bạn cũng có thể thêm cho session('fail') nếu muốn hiển thị lỗi cụ thể cho bình luận đó --}}
                        @endif
                        <div class="comment-actions text-right mb-1" style="text-align: right;">
                            <button class="btn btn-success btn-sm" onclick="toggleReplyForm({{ $comment->id }})">Trả
                                lời</button>
                            @if ($comment->id_user != session('account_id'))
                                <button class="btn btn-danger btn-sm" onclick="reportComment({{ $comment->id }})">Báo
                                    cáo</button>
                            @endif
                        </div>

                        <!-- Form trả lời -->
                        <div id="reply-form-{{ $comment->id }}" class="reply-form mt-2" style="display: none;">
                            <form action="{{ route('tintuc.replyComment') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_post" value="{{ $post->id }}">
                                <input type="hidden" name="id_parent" value="{{ $comment->id }}">
                                <input type="hidden" name="id_user" value="{{ session('account_id') }}">
                                <textarea name="content" class="form-control mb-2" rows="2"
                                    style="background-color: white!important; color:black!important;" placeholder="Nhập phản hồi của bạn" required></textarea>
                                <button type="submit" class="btn btn-sm btn-success ">Gửi phản hồi</button>
                            </form>
                        </div>

                        <!-- Hiển thị các phản hồi -->
                        <div class="replies mt-3" style="margin-left: 50px;">
                            @foreach ($comment->replies as $reply)
                                <div class="reply-box ml-3 mb-2" id="comment-{{ $reply->id }}" >
                                    <div class="user-info" >
                                        <img src="{{ $reply->avatar ? asset($reply->avatar) : asset('image/no_img.jfif') }}"
                                            alt="Avatar" class="avatar">
                                        <strong class="fs-5">{{ $reply->display_name }}</strong>
                                        <div class="ms-3"><small>Bình luận lúc
                                                {{ \Carbon\Carbon::parse($reply->created_at)->format('d-m-Y H:i:s') }}</small>
                                        </div>
                                    </div>




                                    <div class="">
                                        <div class="comment-content mb-1">
                                            @if ($reply->show == 1)
                                                <p>{{ $reply->content }}</p>
                                            @else
                                                <p class="text-muted fst-italic">Bình luận đã được ẩn</p>
                                            @endif
                                        </div>
                                        {{-- HIỂN THỊ THÔNG BÁO CHO TRẢ LỜI --}}
                                        @if (session('highlight_comment_id') == $reply->id)
                                            @if (session('success'))
                                                <div class="alert alert-success alert-dismissible fade show mt-2 py-2"
                                                    role="alert" id="flash-message-{{ $reply->id }}">
                                                    {{ session('success') }}
                                         
                                                </div>
                                            @endif
                                        @endif
                                        <div class="comment-actions text-right mb-1" style="text-align: right;">
                                            <button class="btn btn-success btn-sm"
                                                onclick="toggleReplyForm({{ $reply->id }})">Trả lời</button>
                                            @if ($reply->id_user != session('account_id'))
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="reportComment({{ $reply->id }})">Báo cáo</button>
                                            @endif
                                        </div>

                                        <!-- Form trả lời cho phản hồi -->
                                        <div id="reply-form-{{ $reply->id }}" class="reply-form mt-2"
                                            style="display: none;">
                                            <form action="{{ route('tintuc.replyComment') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id_post" value="{{ $post->id }}">
                                                <input type="hidden" name="id_parent" value="{{ $reply->id }}">
                                                <input type="hidden" name="id_user"
                                                    value="{{ session('account_id') }}">
                                                <textarea name="content" class="form-control mb-2" rows="2"
                                                    style="background-color: white!important; color:black!important;" placeholder="Nhập phản hồi của bạn" required></textarea>
                                                <button type="submit" class="btn btn-success btn-sm mb-2">Gửi phản
                                                    hồi</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    <script>
        function toggleReplyForm(commentId) {
            const replyForm = document.getElementById('reply-form-' + commentId);
            replyForm.style.display = replyForm.style.display === 'none' ? 'block' : 'none';
        }

        function reportComment(commentId) {
            fetch("{{ route('tintuc.reportComment') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        id: commentId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                })
                .catch(error => console.error("Lỗi báo cáo:", error));
        }
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy ID bình luận cần highlight từ session flash data (được truyền từ Controller)
        const highlightCommentId = "{{ session('highlight_comment_id') }}";

        if (highlightCommentId) {
            // Xóa flash data sau khi dùng để tránh highlight lại khi refresh
            // (Bạn cần thêm logic xóa session flash data ở backend nếu muốn)
            // Ví dụ: sessionStorage.removeItem('highlight_comment_id');

            const commentElement = document.getElementById('comment-' + highlightCommentId);
            const fixedHeaderHeight = 56; // Thay đổi giá trị này thành chiều cao navbar/header của bạn

            if (commentElement) {
                // Cuộn bằng JavaScript
                window.scrollTo({
                    top: commentElement.offsetTop - fixedHeaderHeight,
                    behavior: 'smooth' // Cuộn mượt
                });

                // (Tùy chọn) Thêm hiệu ứng highlight cho bình luận
                commentElement.style.transition = 'background-color 0.5s ease';
                commentElement.style.backgroundColor = '#e6ffed'; // Màu highlight
                setTimeout(() => {
                    commentElement.style.backgroundColor = ''; // Bỏ highlight sau vài giây
                }, 3000);
            }
        }
    });
</script>
@endsection
@section('content-right')
    <div class="content-right  col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
        <div class="hsidebar">
            <div class="title-theme fs-3 mb-3 pb-3" style="border-bottom: 1px solid rgba(138, 137, 137, 0.212);">
                <strong>Chủ đề nổi bật</strong>
            </div>

            <div class="inner">
                @if (!empty($list_chu_de_noi_bat))
                    @foreach ($list_chu_de_noi_bat as $item)
                        <div class="pull-left">
                            <div style="width: 100%;">
                                <a href="{{ route('tintuc.post', ['slug' => $item->slug]) }}"
                                    title="{{ $item->post_title }}" target="_self" class=""><img
                                        src="{{ $item->post_image }}" alt="{{ $item->post_title }}" width="332"
                                        height="265" class=" m-r-15" /></a>
                            </div>
                            <a href="{{ route('tintuc.post', ['slug' => $item->slug]) }}"
                                title="{{ $item->post_title }}" target="_self" class="name font-bold"
                                style="font-size: 16px ">{{ $item->post_title }}</a>
                            <span class="text-decrip-2 fs-5">
                                {{ $item->description }}</span>
                            <hr>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    {{-- Hiển thị thông báo --}}

@endsection
