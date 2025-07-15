@extends('client.body.xdsoft.tintuc.layout_tin_tuc')

@section('content-left')
    <style>
        #countdownTimer {
        font-size: 2.5rem;
        font-weight: bold;
    }
    #answeredCount {
        font-size: 2rem;
    }
    </style>
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
        <form id="quizForm" method="POST" action="{{ url('/tracnghiem/' . $quiz->id . '/submit') }}">
            @csrf
            @foreach($questions as $question)
                <div class="card mb-3">
                    <div class="card-body">
                        <p><strong>{{ $loop->index + 1 }}.</strong> {{ $question->question }}</p>
                        @foreach(['A', 'B', 'C', 'D'] as $option)
                            <label>
                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option }}">
                                {{ $question->{'option_' . strtolower($option)} }}
                            </label><br>
                        @endforeach
                    </div>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary w-100 mt-3">Nộp bài</button>
        </form>
    </div>
@endsection

@section('content-right')
    <div class="content-right  col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="">
            <div class="card">
                <div class="card-body">
                    <h5>Thời gian còn lại</h5>
                    <h1 id="countdownTimer" class="text-danger">00:00</h1>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5>Số câu đã trả lời</h5>
                    <h1 id="answeredCount" class="text-danger">0 / {{ count($questions) }}</h1>
                </div>
            </div>
            <button onclick="submitForm()" class="btn btn-danger w-100 mt-3">Nộp bài ngay</button>
        </div>
    </div>

    <script>
        const duration = {{ $quiz->duration }};
        let timeRemaining = duration;
    
        const countdownElement = document.getElementById('countdownTimer');
        const interval = setInterval(() => {
            const minutes = Math.floor(timeRemaining / 60).toString().padStart(2, '0');
            const seconds = (timeRemaining % 60).toString().padStart(2, '0');
            countdownElement.textContent = `${minutes}:${seconds}`;
    
            if (timeRemaining <= 0) {
                clearInterval(interval);
                alert('Hết thời gian! Bài của bạn sẽ được tự động nộp.');
                document.getElementById('quizForm').submit();
            }
    
            timeRemaining--;
        }, 1000);
    
        const answeredCountElement = document.getElementById('answeredCount');
        const radios = document.querySelectorAll('input[type="radio"]');
        const totalQuestions = {{ count($questions) }};
    
        radios.forEach(radio => {
            radio.addEventListener('change', () => {
                const answered = new Set();
                radios.forEach(r => {
                    if (r.checked) {
                        answered.add(r.name);
                    }
                });
                answeredCountElement.textContent = `${answered.size} / ${totalQuestions}`;
            });
        });
    
        function submitForm() {
            if (confirm('Bạn có chắc muốn nộp bài?')) {
                document.getElementById('quizForm').submit();
            }
        }
    </script>
@endsection