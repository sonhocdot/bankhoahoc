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
            <form action="{{route('edit_khoa_hoc')}}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- Header -->
                <div class="card-header" style="background-color: rgb(4, 4, 52); ">
                    <h4 class="card-header-title" style="color: white" >Sửa khóa học</h4>
                </div>
                <!-- End Header -->

                <!-- Body -->
                <div class="card-body">
                    <!-- Form Group -->

                    <div class="d-flex justify-content-between">
                        <div class="form-group">
                            <label class="input-label" for="avatarUploader">Ảnh Bài Viết <span class="text-danger">(*)</span></label>
                            <div class="d-flex align-items-center position-relative">
                                <!-- Avatar -->
                                <label class="avatar avatar-xl avatar-circle avatar-uploader mr-5" for="avatarUploader">
                                    <img id="output" class="avatar-img shadow-soft" style="padding: 10px"
                                         src="{{$course_detail->img}}" alt="Image Description">

                                    <span class="avatar-uploader-trigger">
                                    <i class="tio-edit avatar-uploader-icon shadow-soft">+</i>
                                    </span>
                                </label>
                                <input type="file" class="js-file-attach avatar-uploader-input form-control"
                                       id="avatarUploader"
                                       name="image_upload"
                                       accept="image/*"
                                       onchange="loadFile(this)">
                                <!-- End Avatar -->

                                <button type="button" id="deleteImage" onclick="deleteImg(this)"
                                        class="js-file-attach-reset-img btn btn-white">Delete
                                </button>
                            </div>
                        </div>
                        <!-- End Form Group -->
                    </div>
                     <!-- Form Group -->
                     <div class="form-group">
                        <input type="number" class="form-control" name="id"
                               value="{{$course_detail->id}}"
                               id="projectNameProjectSettingsLabel" placeholder="ID"
                               aria-label="Enter project name here" hidden="">
                    </div>
                    <!-- End Form Group -->


                    <!-- Tab Content -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="nav-one-eg1" role="tabpanel"
                             aria-labelledby="nav-one-eg1-tab">
                            <div class="row">
                                <div class="col-6">
                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <label for="tieu_de" class="input-label">Tên khóa học
                                            <b>(<=60)</b>
                                            <span>Có:</span>
                                            <b><span id="count"></span> <span class="text-danger">(*)</span></b>
                                        </label>

                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tio-briefcase-outlined"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="tieu_de"
                                                   id="tieu_de" placeholder="Tiêu đề"
                                                   value="{{$course_detail->name}}"
                                                   aria-label="Enter project name here"
                                                   onchange="onChangeInput(this,'tieu_de')"
                                                   pattern=".{1,60}"
                                                   title="Tiêu đề có độ dài không quá 60 ký tự" required>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->
                                </div>

                                <div class="col-6">
                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <label for="projectNameProjectSettingsLabel" class="input-label">Slug <span class="text-danger">(*)</span><i
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
                                            <input type="text" class="form-control" name="slug"
                                                   value="{{$course_detail->slug}}"
                                                   id="slug" placeholder="VD: file-cad"
                                                   aria-label="Enter project name here"
                                                   title="Không được để trống" required>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <label for="tieu_de" class="input-label">Giá gốc <span class="text-danger">(*)</span>
                                        </label>
    
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tio-briefcase-outlined"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="gia_goc" id="tieu_de" value="{{$course_detail->gia_goc}}"
                                                placeholder="Nhập tổng học phí gốc" aria-label="Enter project name here" required pattern="[0-9]*" title="Chỉ được nhập số">
                                        </div>
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                                
                                <div class="col-6">
                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <label for="tieu_de" class="input-label">Giá giảm <span class="text-danger">(*)</span>
                                        </label>
    
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tio-briefcase-outlined"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="gia_giam" id="tieu_de" value="{{$course_detail->gia_giam}}"
                                                placeholder="Nhập học phí sau khi giảm" aria-label="Enter project name here" required pattern="[0-9]*" title="Chỉ được nhập số">
                                        </div>
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
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
                                            <select name="tac_gia" id="tac_gia"
                                                    class="form-control">
                                                    <optgroup label="Tác giả">
                                                        <option value="" disabled hidden>Chọn tác giả</option>
                                                        @foreach($users as $user)
                                                            <option value="{{$user->id}}" {{($course_detail->id_author == $user->id) ? 'selected' : ''}}>{{$user->display_name}}</option>
                                                        @endforeach        
                                                    </optgroup>

                                            </select>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->
                                </div>

                                <div class="col-6">
                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <label for="projectNameProjectSettingsLabel" class="input-label">Mô tả
                                            <b>(<140)</b>
                                            <span>Có:</span>
                                            <b><span id="count1"></span> <span class="text-danger">(*)</span></b>
                                        </label>

                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tio-briefcase-outlined"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="mo_ta"
                                                   id="mo_ta" placeholder="Tóm tắt nội dung"
                                                   value="{{$course_detail->description}}"
                                                   aria-label="Enter project name here" pattern=".{1,140}"
                                                   title="Mô tả có độ dài không quá 140 ký tự" required>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <label for="projectNameProjectSettingsLabel" class="input-label">Bài giảng<i
                                                class="tio-help-outlined text-body ml-1" data-toggle="tooltip"
                                                data-placement="top" title=""
                                                data-original-title="Displayed on public forums, such as Front."></i></label>
    
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tio-briefcase-outlined"></i>
                                                </div>
                                            </div>
                                            <select name="lessons[]" id="lessons"
                                                class="form-control" multiple multiselect-search="true">
    
                                                @foreach($lessons as $lesson)
                                            <option value="{{$lesson->id}}"
                                                @foreach($lesson_detail as $item) 
                                                    {{($item->id_lesson == $lesson->id) ? 'selected': ''}}
                                                @endforeach>
                                                {{ $lesson->lesson_title }}
                                            </option>

                                            @endforeach
    
                                            </select>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                                <div class="col-6">
                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <label for="projectNameProjectSettingsLabel" class="input-label">Phân loại khóa học<i
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
                                                        <option value="" disabled hidden>Chọn khóa học</option>
                                                        @foreach($course_categories as $category)                                                   
                                                        <option value="{{$category->id}}" {{($course_detail->category == $category->id) ? 'selected' : ''}}>{{$category->name}}</option>
                                                        @endforeach
        
                                                    </optgroup>

                                            </select>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                            </div>
                        </div>

                    </div>


                    <!-- Quill -->
                    <label class="input-label">Nội dung bài viết </label>

                    <div class="quill-custom ql-toolbar-bottom">
                        <input name="noi_dung" id="mytextarea"
                        value="{{$course_detail->content}}"
                        placeholder="Nhập nội dung bài viết">

                    </div>
                    <label class="input-label mt-5">Đánh giá khóa học </label>

                    <div class="quill-custom ql-toolbar-bottom">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Tên người dùng</th>
                                    <th>Đánh giá</th>
                                    <th>Nội dung</th>
                                    <th>Ngày đăng</th>
                                    {{-- <th>Trạng thái</th> --}}
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($comments as $comment)
                                    <tr id="comment{{ $comment->id }}">
                                        <td>{{ $comment->display_name }}</td>
                                        <td>{{ $comment->rate }}/5</td>
                                        <td>{{ $comment->content }}</td>
                                        <td>{{ $comment->created_at }}</td>
                                        
                                        <td>
                                            <button type="button" class="btn btn-primary" onclick="toggleCommentVisibility({{ $comment->id }}, {{ $comment->show }})">
                                                {{ $comment->show ? 'Ẩn' : 'Hiện' }}
                                            </button>
                                            <button type="button" class="btn btn-danger" onclick="deleteComment('{{ $comment->id }}')">Xóa</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- End Quill -->

                <!-- End Body -->

                <!-- Footer -->
                <div class="card-footer d-flex justify-content-end align-items-center">
                    {{--                        <button type="button" class="btn btn-white mr-2">Cancel</button>--}}
                    <button type="submit" class="btn btn-primary">Sửa</button>
                </div>
            </form>
            <!-- End Footer -->
        </div>
        <!-- End Card -->


    </div>
    <script>
        function toggleCommentVisibility(commentId, currentShowStatus) {
            fetch(`/admin/toggle-comment-course-show/${commentId}`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ show: !currentShowStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const toggleButton = document.querySelector(`#comment${commentId} .btn-primary`);
                    toggleButton.textContent = data.show ? 'Ẩn' : 'Hiện';
    
                }
            });
        }
    
        function deleteComment(commentId) {
            if (confirm('Bạn có chắc muốn xóa đánh giá khóa học này không?')) {
                fetch(`/admin/delete-comment-course/${commentId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const commentElement = document.getElementById(`comment${commentId}`);
                        commentElement.remove();
                    }
                });
            }
        }
    </script>
@endsection
