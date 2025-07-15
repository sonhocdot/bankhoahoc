@extends('client.body.xdsoft.tintuc.layout_tin_tuc')

@section('content-left')
    @if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @elseif(session('fail'))
    <div class="alert alert-danger" role="alert">
        {{ session('fail') }}
    </div>
    @endif
    <div class="content-left col-xxl-9 col-xl-9 col-lg-2 col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <header class="entry-header">
            <h1 class="entry-title">{{$quiz->title}}</h1>
        </header>
        <p>{{ $quiz->description }}</p>
        @foreach($results as $result)
            <div class="card {{ $result['isCorrect'] ? 'border-success' : 'border-danger' }} px-3 py-2 my-2">
                <p class="fs-4 mb-1">{{ $loop->index + 1 }}. {{ $result['question']->question }}</p>
                @foreach(['A', 'B', 'C', 'D'] as $option)
                    <p class="fs-4 mb-1 {{ $result['question']->correct_option == $option ? 'text-success' : '' }} {{ $result['userAnswer'] == $option && !$result['isCorrect'] ? 'text-danger' : '' }}">
                        {{ $option.". ". $result['question']->{'option_' . strtolower($option)} }}
                    </p>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection

@section('content-right')
    <div class="content-right  col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="">
            <div class="card">
                <div class="card-body">
                    <h5>Kết quả kiểm tra:</h5>
                    <h1 class="text-danger"> {{ $score }}/{{ count($results) }} </h1>
                </div>
            </div>
            <a href="{{ route('xdsoft.tracnghiem')}}">
                <button class="btn btn-danger w-100 mt-3">Quay lại List trắc nghiệm</button>
            </a>
        </div> 
    </div>
@endsection
