@extends('client.body.xdsoft.khoahoc.layout_khoa_hoc')
@section('content-right')
<div class="content-left ">
    @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @elseif(session('fail'))
            <div class="alert alert-danger" role="alert">
                {{ session('fail') }}
            </div>
        @endif
    <header class="entry-header">
        <h1 class="entry-title">{{$course->name}}</h1>
        <div class="post-meta my-1">
            <span class="meta-date date updated"><i class="fa fa-calendar me-1"></i>{{$course->created_at}}</span>
        </div>
        <div class="post-meta my-1">
            <span class="meta-date me-3 mt-5 d-block d-md-inline">
                <i class="fa fa-book me-1"></i><span class="meta-date">{{$course->lesson_count}}</span>
                bài học
            </span>
            <span class="meta-date me-3 mt-5 d-block d-md-inline">
                <i class="far fa-eye me-1"></i><span class="meta-date">{{number_format($course->view_count, 0, ',')}}</span> lượt xem
            </span>
        </div>
        <div class="post-meta my-1">
            <span class="meta-date me-1"><i class="fa fa-pencil-square-o me-1"></i>Tác giả/Dịch giả:</span>
            @if ($course->author_course)
            <span class="meta-date"><strong>{{$course->author_course->display_name}}</strong></span>
            @else
            <span class="meta-date"><strong>CodeFun</strong></span>
            @endif

        </div>
    </header>
    <div class="container-fluid">
        @if (!session('account_name'))
            <div class="m-auto py-5">
                <div class="bg-light py-5">
                    <div class="text-center">
                        <h3 class="text-muted fst-italic">Để xem nội dung bài giảng, bạn cần <a href="{{ route('xdsoft.account.login') }}">Đăng nhập</a></h3>
                    </div>
                </div>
            </div>
        @elseif (!$coursePaid)
            <div class="m-auto py-5">
                <div class="bg-light py-5">
                    <div class="text-center">
                        <h3 class="text-muted fst-italic">Bạn chưa mua khóa học này, vui lòng đặt mua ngay</h3>
                        <div class="d-flex justify-content-between container col-4">
                            <a href="{{ route('add_to_cart_now', ['id' => $course->id]) }}" class="btn btn-sm btn-white" 
                               style="border: 1px solid rgba(0,0,0,0.3); border-radius: 10px; width: 48%;">Mua ngay</a>
                            <a href="{{ route('add_to_cart', ['id' => $course->id]) }}" class="btn btn-sm btn-success" 
                               style="border-radius: 10px; width: 48%;">Thêm vào giỏ hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row m-auto py-5">
                <div class="col-lg-8 col-md-12">
                    @if ($lessons && count($lessons) > 0)
                        <div class="posts-md d-block position-relative">
                            <div class="portfolio-image gmap_canvas iframe-wrapper">
                                <div class="iframe-container">
                                    <iframe id="video-frame" loading="lazy" scrolling="no" frameborder="0" allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="posts-md d-block position-relative bg-light h-100">
                            <div class="text-center py-5">
                                <span style="font-size: 14px; font-weight: bolder;">Đang cập nhật bài giảng</span>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-lg-4 col-md-12">
                    <!-- Course Info -->
                    <div class="rounded">
                        <div class="block-header block-header-default bg-success">
                            <h3 class="rounded fs-3 fw-bolder text-white p-3">
                                <i class="fa fa-fw fa-list"></i>
                                Danh sách bài học
                            </h3>
                        </div>
                        <div class="block-content border" style="margin-top: -5px;">
                            <div class="py-2">
                                <div class="block-content p-2">
                                    <div class="input-group mb-2">
                                        <input type="text" id="input-search-lecture" class="form-control"
                                            placeholder="Tìm bài học..."
                                            style="background-color: white !important; color:black !important; font-size:15px;">
                                    </div>
                                </div>
                                <div class="list" style="overflow-y: scroll; max-height: 250px;">
                                    <div class="list-group">
                                        @if ($lessons && count($lessons) > 0)
                                            @foreach ($lessons as $key => $video)
                                                <div class="tab" onclick="showVideo({{ $video->id }})">
                                                    <a id="lecture-{{ $key + 1 }}"
                                                        class="list-group-item list-group-item-action border-0 ">
                                                        <span class="fs-5">{{ $key + 1 }}. </span>
                                                        <span class="fs-5">{{ $video->lesson_title }}</span>
                                                    </a>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="text-center py-5">
                                                <span style="font-size: 14px; font-weight: bolder;">Đang cập nhật bài giảng</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if ($lessons && count($lessons) > 0)
                                <script>
                                    var lessons = {!! json_encode($lessons) !!};
                                    var inputSearch = document.getElementById("input-search-lecture");
                                    inputSearch.addEventListener("input", function() {
                                        var searchText = inputSearch.value.trim().toLowerCase();
                                        var list = document.querySelector(".list");
                                        var searchResultsHTML = [];
                                        for (var i = 0; i < lessons.length; i++) {
                                            var lesson = lessons[i];
                                            if (lesson.lesson_title.toLowerCase().includes(searchText)) {
                                                searchResultsHTML.push(
                                                    '<div class="tab" onclick="showVideo(' +
                                                    lesson.id +
                                                    ')"><a id="lecture-' +
                                                    (i + 1) +
                                                    '" class="list-group-item list-group-item-action border-0 "><span class="fs-5">' +
                                                    (i + 1) +
                                                    '. </span><span class="fs-5">' +
                                                    lesson.lesson_title +
                                                    "</span></a></div>"
                                                );
                                            }
                                        }
                                        list.innerHTML = searchResultsHTML.join("");
                                        if (searchResultsHTML.length === 0) {
                                            list.innerHTML = '<div class="text-center py-5">Không tìm thấy kết quả.</div>';
                                        }
                                    });
                                </script>
                            @endif
                        </div>
                    </div>
                    <!-- END Course Info -->
                </div>
            </div>
        @endif
    </div>
    <div class="entry-content">
        {!! html_entity_decode($course->content) !!}
    </div>
    <div id="post-comment" class="mt-4">
        <h4>Đánh giá khóa học</h4>
        <form action="{{ route('khoahoc.addComment') }}" method="POST">
            @csrf
            <input type="hidden" name="id_post" value="{{ $course->id }}">
            <input type="hidden" name="id_user" value="{{ session('account_id') }}">
            <input type="hidden" name="rate" id="rate" required>
            <div class="mb-3">
                <label for="rate" class="form-label">Đánh giá:</label>
                <div class="stars">
                    <span class="star selected" data-value="1">&#9733;</span>
                    <span class="star" data-value="2">&#9733;</span>
                    <span class="star" data-value="3">&#9733;</span>
                    <span class="star" data-value="4">&#9733;</span>
                    <span class="star" data-value="5">&#9733;</span>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="content" class="form-label">Bình luận:</label>
                <textarea name="content" id="content" class="form-control" placeholder="Nhập bình luận của bạn tại đây"
                    style="background-color: white!important; color:black!important;" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">Gửi</button>
        </form>
    </div>

    <!-- Danh sách bình luận -->
    <div id="comments-list" class="mt-5">
        <h4>Bình luận ({{ $commentCount }})</h4>
        @foreach($comments as $comment)
        <div class="comment-box">
            <div class="user-info">
                <img src="{{ $comment->avatar ? asset($comment->avatar) : asset('image/no_img.jfif') }}" alt="Avatar" class="avatar">
                <div>
                    <div>
                        <strong class="fs-5">{{ $comment->display_name }}</strong>
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="fa fa-star fs-6 {{ $i <= $comment->rate ? 'text-warning' : 'text-secondary' }}"></span>
                        @endfor
                    </div>
                    <small>{{ \Carbon\Carbon::parse($comment->created_at)->format('d-m-Y H:i:s') }}</small>
                    {{-- <p class="fs-6"><strong>Đánh giá:</strong> {{ $comment->rate }} sao</p> --}}
                </div>
            </div>
            <div class="comment-content">
                <p>{{ $comment->content }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
<script>
    window.onload = function() {
        const lessons = @json($lessons);
        showVideo(lessons[0].id); // Tự động chọn video 1 khi trang được tải
    };
    function showVideo(videoIndex) {
        const videoFrame = document.getElementById("video-frame");
        @foreach ($lessons as $video)
        if (videoIndex == {{ $video->id }}) {
            videoFrame.src = "https://www.youtube-nocookie.com/embed/{{ $video->videoID_embeded }}?rel=0&modestbranding=1&disablekb=1";
        }
        @endforeach
        videoFrame.style.display = "block";
    }
    let selectedRating = 1;
    document.getElementById('rate').value = selectedRating;

    document.querySelectorAll('.star').forEach((star) => {
        star.addEventListener('click', function() {
            selectedRating = parseInt(this.getAttribute('data-value'));
            document.getElementById('rate').value = selectedRating;
            updateStars(selectedRating);
        });
        star.addEventListener('mouseover', function() {
            updateStars(parseInt(this.getAttribute('data-value')));
        });
        star.addEventListener('mouseout', function() {
            updateStars(selectedRating);
        });
    });

    function updateStars(rating) {
        document.querySelectorAll('.star').forEach((star, index) => {
            star.classList.toggle('selected', index < rating);
        });
    }
    function validateRating() {
        if (selectedRating < 1) {
            alert('Vui lòng chọn ít nhất 1 sao.');
            return false;
        }
        return true;
    }
</script>
@endsection