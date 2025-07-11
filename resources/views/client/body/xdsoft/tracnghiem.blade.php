@extends('client.layoutx.xdsoft.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/card.css') }}">
<link rel="stylesheet" href="{{ asset('css/footer.css') }}">
<style>

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
            <div class="col-md-8 mb-4">
                <div class="profile-form-container">
                    <h4 class="text-title"><b>DANH SÁCH BỘ CÂU HỎI TRẮC NGHIỆM</b></h4>
                        <form method="GET" action="{{ route('xdsoft.tracnghiem') }}">
                            <div class="d-flex align-items-center mb-3">
                                <input type="text" class="form-control me-2 w-50" name="search" value="{{ $search }}" placeholder="Tìm kiếm bộ câu hỏi...">
                                <button type="submit" class="btn btn-success mt-0 mb-3">Tìm kiếm</button>
                            </div>
                        </form>
                    
                        @forelse ($quizzes  as $quiz)
                            <a href="{{ url('/tracnghiem/' . $quiz->id) }}">
                                <div class="course-item border p-3 mb-3 rounded row">
                                    <div class="ms-5 px-0">
                                        <p class="fs-3"><strong>{{ $quiz->title }}</strong></p>
                                        <div class="post-meta my-1">
                                            <span class="meta-date me-3 mt-5 d-block d-md-inline">
                                                <i class="fa fa-book me-1"></i><span class="meta-date">{{$quiz->question_count}} câu hỏi</span>
                                            </span>
                                            <span class="meta-date me-3 mt-5 d-block d-md-inline">
                                                <i class="fa fa-clock-o me-1"></i><span class="meta-date">Thời gian làm bài: {{$quiz->duration}}</span> giây
                                            </span>
                                        </div>
                                        <p class="fs-5 text-dark">{{$quiz->description}}</p>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <p>Đang cập nhật bộ câu hỏi.</p>
                        @endforelse
                        {{ $quizzes->links() }}
                </div>
            </div>
            <!-- End User Info Display -->
            <div class="col-4">
                <h4 class="text-title"><b>LỊCH SỬ LÀM BÀI GẦN NHẤT</b></h4>
                @if(count($recentAttempts) > 0)
                    <ul class="list-group">
                        @foreach($recentAttempts as $attempt)
                            <li class="card card-hover list-group-item my-1 p-3">
                                <p class="mb-1"><strong>{{ $attempt->title }}</strong></p>
                                <p class="mb-1 text-muted fs-6 fst-italic">Thời gian làm bài: {{ \Carbon\Carbon::parse($attempt->created_at)->format('d/m/Y H:i') }}</p>
                                <p class="mb-1 text-muted fs-6 fst-italic">Số điểm: {{ $attempt->score }}/{{ $attempt->question_count }}</p>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>Tài khoản này chưa làm bài kiểm tra nào.</p>
                @endif
            </div>
        </div>
    </section>
</main>
@endsection

