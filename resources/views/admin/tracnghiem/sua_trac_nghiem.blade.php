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
            <form action="{{route('edit_trac_nghiem')}}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- Header -->
            <div class="card-header">
                <h4 class="card-header-title">Sửa bộ đề kiểm tra trắc nghiệm</h4>
            </div>
            <!-- End Header -->

            <!-- Body -->
            <div class="card-body">
                <!-- Form Group -->
                <div class="form-group">
                    <input type="number" class="form-control" name="id"
                           value="{{$quiz_detail->id}}"
                           id="projectNameProjectSettingsLabel" placeholder="ID"
                           aria-label="Enter project name here" hidden="">
                </div>
                <!-- End Form Group -->
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
                                        <input type="text" class="form-control" name="title" id="title" value="{{ $quiz_detail->title }}"
                                            placeholder="Tên đề kiểm tra" aria-label="Enter project name here" required>
                                    </div>
                                </div>
                                <!-- End Form Group -->
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <!-- Form Group -->
                                <div class="form-group">
                                    <label for="projectNameProjectSettingsLabel" class="input-label">Phân loại<i
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
                                        <select name="category" id="category"
                                                class="form-control">
                                                <optgroup label="Phân loại khóa học">
                                                    <option value="" disabled hidden>-- Chọn một lựa chọn --</option>
                                                    @foreach($course_categories as $category)                                                   
                                                    <option value="{{$category->id}}" {{($quiz_detail->category == $category->id) ? 'selected' : ''}}>{{$category->name}}</option>
                                                    @endforeach
    
                                                </optgroup>

                                        </select>
                                    </div>
                                </div>
                                <!-- End Form Group -->
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <!-- Form Group -->
                                <div class="form-group">
                                    <label for="tieu_de" class="input-label">Thời gian làm bài <span class="text-danger">(*)</span>
                                    </label>

                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-briefcase-outlined"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="duration" id="tieu_de" value="{{ $quiz_detail->duration }}"
                                            placeholder="Thời gian làm bài (tính bằng giây)" aria-label="Enter project name here" pattern="[0-9]*" title="Chỉ được nhập số" required>
                                    </div>
                                </div>
                                <!-- End Form Group -->
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <!-- Form Group -->
                                <div class="form-group">
                                    <label for="tieu_de" class="input-label">Mô tả <span class="text-danger">(*)</span>
                                    </label>

                                    <div class="input-group input-group-merge">
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tio-briefcase-outlined"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="description" id="tieu_de" value="{{ $quiz_detail->description }}"
                                                placeholder="Mô tả đề kiểm tra" aria-label="Enter project name here" required>
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- End Form Group -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <!-- Form Group -->
                                <div class="form-group">
                                    <label for="projectNameProjectSettingsLabel" class="input-label">Tác giả <span class="text-danger">(*)</span><i
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
                                        <select name="id_author" id="tac_gia"
                                                class="form-control">
                                            @foreach($users as $user)                                                
                                                <option value="{{$user->id}}" {{($quiz_detail->id_author == $user->id) ? 'selected' : ''}}>{{$user->display_name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <!-- End Form Group -->
                            </div>
                        </div>
                        <div class="">
                            <h4>Danh Sách Câu Hỏi: </h4>
                            <button type="button" class="btn btn-success mb-3" id="add-question">Thêm Câu Hỏi</button>

                            <div id="questions-container" class="mb-3">
                                @foreach($question_detail as $index => $question)
                                    <div class="card mb-3 question-card" id="question-{{ $index }}">
                                        <div class="card-body">
                                            <h5 class="question-title">Câu Hỏi {{ $index + 1 }}</h5>
                                            <div class="mb-3 row">
                                                <label class="form-label col-2">Câu hỏi</label>
                                                <input type="text" class="form-control col-10" name="questions[{{ $index }}][question_title]" value="{{ $question->question }}" required>
                                            </div>

                                            <!-- Các đáp án -->
                                            @foreach(['A', 'B', 'C', 'D'] as $option)
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-1">
                                                        <input type="radio" name="questions[{{ $index }}][correct_option]" value="{{ $option }}" {{ $question->correct_option == $option ? 'checked' : '' }}>
                                                    </div>
                                                    <div class="col-1">
                                                        <label>{{ $option }}:</label>
                                                    </div>
                                                    <div class="col-10">
                                                        <input type="text" class="form-control" name="questions[{{ $index }}][option_{{ strtolower($option) }}]" value="{{ $question->{'option_' . strtolower($option)} }}" required>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <button type="button" class="btn btn-danger remove-question">Xóa Câu Hỏi</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                    
                        </div>


                    </div>

                </div>
                <!-- End Quill -->
                <!-- End Body -->
                <!-- Footer -->
                <div class="card-footer d-flex justify-content-end align-items-center">
                    {{-- <button type="button" class="btn btn-white mr-2">Cancel</button>--}}
                    <button type="submit" class="btn btn-primary">Sửa</button>
                </div>
            </div>
            </form>
            <!-- End Footer -->
        </div>
        <!-- End Card -->

        <script>
            let questionIndex = document.querySelectorAll('.question-card').length;
        
            document.getElementById('add-question').addEventListener('click', function() {
                const container = document.getElementById('questions-container');
        
                const questionHtml = `
                <div class="card mb-3 question-card" id="question-${questionIndex}">
                    <div class="card-body">
                        <h5 class="question-title">Câu Hỏi ${questionIndex + 1}</h5>
    
                        <div class="mb-3 row">
                            <label class="form-label col-2">Câu hỏi</label>
                            <input type="text" class="form-control col-10" name="questions[${questionIndex}][question_title]" required>
                        </div>
    
                        <!-- Các câu trả lời -->
                        <div class="mb-3">
                            <label class="form-label">Các câu trả lời (tích chọn đáp án đúng)</label>
                            
                            <div class="row mb-2 align-items-center">
                                <div class="col-1 pb-4">
                                    <input class="form-check-input" type="radio" name="questions[${questionIndex}][correct_option]" value="A" required>
                                </div>
                                <div class="col-1">
                                    <label>A:</label>
                                </div>
                                <div class="col-10">
                                    <input type="text" class="form-control" name="questions[${questionIndex}][option_a]" required>
                                </div>
                            </div>
                            <div class="row mb-2 align-items-center">
                                <div class="col-1 pb-4">
                                    <input class="form-check-input" type="radio" name="questions[${questionIndex}][correct_option]" value="B" required>
                                </div>
                                <div class="col-1">
                                    <label>B:</label>
                                </div>
                                <div class="col-10">
                                    <input type="text" class="form-control" name="questions[${questionIndex}][option_b]" required>
                                </div>
                            </div>
                            <div class="row mb-2 align-items-center">
                                <div class="col-1 pb-4">
                                    <input class="form-check-input" type="radio" name="questions[${questionIndex}][correct_option]" value="C" required>
                                </div>
                                <div class="col-1">
                                    <label>C:</label>
                                </div>
                                <div class="col-10">
                                    <input type="text" class="form-control" name="questions[${questionIndex}][option_c]" required>
                                </div>
                            </div>
                            <div class="row mb-2 align-items-center">
                                <div class="col-1 pb-4">
                                    <input class="form-check-input" type="radio" name="questions[${questionIndex}][correct_option]" value="D" required>
                                </div>
                                <div class="col-1">
                                    <label>D:</label>
                                </div>
                                <div class="col-10">
                                    <input type="text" class="form-control" name="questions[${questionIndex}][option_d]" required>
                                </div>
                            </div>
                        </div>
    
                        <button type="button" class="btn btn-danger remove-question" data-index="${questionIndex}">Xóa Câu Hỏi</button>
                    </div>
                </div>`;
        
                container.insertAdjacentHTML('beforeend', questionHtml);
                questionIndex++;
            });
        
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-question')) {
                    const card = event.target.closest('.question-card');
                    card.remove();
        
                    // Reorder questions after deletion
                    reorderQuestions();
                }
            });
        
            function reorderQuestions() {
                const questions = document.querySelectorAll('.question-card');
                questionIndex = 0;
        
                questions.forEach((card, index) => {
                    // Update card id
                    card.id = `question-${index}`;
        
                    // Update question title
                    const title = card.querySelector('.question-title');
                    title.textContent = `Câu Hỏi ${index + 1}`;
        
                    // Update input names
                    const inputs = card.querySelectorAll('input, textarea');
                    inputs.forEach(input => {
                        if (input.name) {
                            input.name = input.name.replace(/\[\d+\]/, `[${index}]`);
                        }
                    });
        
                    // Update radio buttons
                    const radios = card.querySelectorAll('.form-check-input');
                    radios.forEach(radio => {
                        radio.name = `questions[${index}][correct_option]`;
                    });
        
                    questionIndex++;
                });
            }
        </script>
    </div>
@endsection
