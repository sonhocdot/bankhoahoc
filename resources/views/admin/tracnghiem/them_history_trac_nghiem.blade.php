@extends('admin.layout.layout_admin')

@section('main')

<div class="col-lg-12">
    <!-- Card -->
    <div class="card card-lg mb-3 mb-lg-5">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @elseif(session('fail'))
            <div class="alert alert-danger" role="alert">
                {{ session('fail') }}
            </div>
        @endif
        <form action="{{route('insert_history_trac_nghiem')}}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- Header -->
            <div class="card-header" style="background-color: rgb(4, 4, 52); ">
                    <h4 class="card-header-title" style="color: white" >Thêm lịch sử trắc nghiệm</h4>
                </div>
            <!-- End Header -->

            <!-- Body -->
            <div class="card-body">
                <!-- Form Group -->
                <!-- Tab Content -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="nav-one-eg1" role="tabpanel"
                        aria-labelledby="nav-one-eg1-tab">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <!-- Form Group -->
                                <div class="form-group">
                                    <label for="tieu_de" class="input-label">Tên đề kiểm tra <span class="text-danger">(*)</span>
                                    </label>

                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-briefcase-outlined"></i>
                                            </div>
                                        </div>
                                        <select name="id_quiz" id="id_quiz" class="form-control">
                                            @foreach($ds_quiz as $quiz)
                                                <option value="{{ $quiz->id }}" data-question-count="{{ $quiz->question_count }}">
                                                    {{ $quiz->title }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <!-- End Form Group -->
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <!-- Form Group -->
                                <div class="form-group">
                                    <label for="projectNameProjectSettingsLabel" class="input-label">Người làm kiểm tra <span class="text-danger">(*)</span><i
                                            class="tio-help-outlined text-body ml-1" data-toggle="tooltip"
                                            data-placement="top"
                                            title=""
                                            data-original-title="Displayed on public forums, such as Front."></i></label>

                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-briefcase-outlined"></i>
                                            </div>
                                        </div>
                                        <select name="id_user" id="tac_gia"
                                                class="form-control">
                                            @foreach($users as $user)
                                                @if(session()->get('tk_user')[0] == $user->username)
                                                    <option value="{{$user->id}}"
                                                            >{{$user->display_name}}</option>
                                                @else
                                                    <option value="{{$user->id}}">{{$user->display_name}}</option>
                                                @endif

                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <!-- End Form Group -->
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                <!-- Form Group -->
                                <div class="form-group">
                                    <label for="tieu_de" class="input-label">Điểm số <span class="text-danger">(*)</span>
                                    </label>

                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-briefcase-outlined"></i>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="score" id="score" placeholder="Số câu trả lời đúng" 
                                                   pattern="[0-9]*" title="Chỉ được nhập số" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="question-count-display">/ 0</span>
                                            </div>
                                        </div>
                                        <small id="score-warning" class="text-danger" style="display: none;">Số câu trả lời đúng không được vượt quá số câu hỏi! Tự động lấy số điểm cao nhất</small>
                                    </div>
                                </div>
                                <!-- End Form Group -->
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- End Quill -->
                <!-- End Body -->
                <!-- Footer -->
                <div class="card-footer d-flex justify-content-end align-items-center">
                    {{-- <button type="button" class="btn btn-white mr-2">Cancel</button>--}}
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </div>
        </form>
        <!-- End Footer -->
    </div>
    <!-- End Card -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const quizSelect = document.getElementById('id_quiz');
        const scoreInput = document.getElementById('score');
        const questionCountDisplay = document.getElementById('question-count-display');
        const scoreWarning = document.getElementById('score-warning');

        let maxQuestions = 0;

        function updateQuestionCount() {
            const selectedOption = quizSelect.options[quizSelect.selectedIndex];
            maxQuestions = parseInt(selectedOption.getAttribute('data-question-count')) || 0;
            questionCountDisplay.textContent = `/ ${maxQuestions}`;
            scoreInput.value = '';
            scoreWarning.style.display = 'none';
        }
        function validateScoreInput() {
            const scoreValue = parseInt(scoreInput.value) || 0;
            if (scoreValue > maxQuestions) {
                scoreInput.value = maxQuestions;
                scoreWarning.style.display = 'block';
            } else {
                scoreWarning.style.display = 'none';
            }
        }
        quizSelect.addEventListener('change', updateQuestionCount);
        scoreInput.addEventListener('input', validateScoreInput);
        updateQuestionCount();
    });

    </script>
</div>
@endsection