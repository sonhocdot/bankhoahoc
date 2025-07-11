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
            <form action="{{route('edit_lesson')}}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- Header -->
                <div class="card-header" style="background-color: rgb(4, 4, 52); ">
                    <h4 class="card-header-title" style="color: white" >Sửa bài giảng</h4>
                </div>
                <!-- End Header -->

                <!-- Body -->
                <div class="card-body">
                     <!-- Form Group -->
                     <div class="form-group">
                        <input type="number" class="form-control" name="id"
                               value="{{$lesson_detail->id}}"
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
                                        <label for="tieu_de" class="input-label">Tên bài giảng <span class="text-danger">(*)</span>
                                        </label>

                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tio-briefcase-outlined"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="lesson_title"
                                                   id="tieu_de" placeholder="Tiêu đề"
                                                   value="{{$lesson_detail->lesson_title}}"
                                                   aria-label="Enter project name here" required>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->
                                </div>

                                <div class="col-6">
                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <label for="tieu_de" class="input-label">URL Youtube <span class="text-danger">(*)</span>
                                        </label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tio-briefcase-outlined"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="video_id" id="video_url"
                                                placeholder="Nhập URL" aria-label="Enter project url here" value="{{$lesson_detail->video_id}}"
                                                required>
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
                                                            <option value="{{$user->id}}" {{($lesson_detail->id_author == $user->id) ? 'selected' : ''}}>{{$user->display_name}}</option>
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
                                        <label for="projectNameProjectSettingsLabel" class="input-label">Khóa học <span class="text-danger">(*)</span><i
                                                class="tio-help-outlined text-body ml-1" data-toggle="tooltip"
                                                data-placement="top" title=""
                                                data-original-title="Displayed on public forums, such as Front."></i></label>
    
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tio-briefcase-outlined"></i>
                                                </div>
                                            </div>
                                            <select name="khoa_hoc" id="khoa_hoc"
                                                class="form-control">
    
                                                @foreach($courses as $course)
                                                    <option
                                                        value="{{$course->id}}" {{($lesson_detail->courseID == $course->id) ? 'selected' : ''}}>{{$course->name}}</option>
                                                @endforeach
    
                                            </select>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <label for="projectNameProjectSettingsLabel" class="input-label">Video Demo<i
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
                                            <div class="embed-responsive embed-responsive-16by9" style="display: none;">
                                                <iframe id="video_preview" class="embed-responsive-item" 
                                                        src="" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                            </div>
                        </div>

                    </div>


                    <!-- Quill -->
                    {{-- <label class="input-label">Nội dung bài viết </label>

                    <div class="quill-custom ql-toolbar-bottom">
                        <input name="noi_dung" id="mytextarea"
                        value="{{$lesson_detail->content}}"
                        placeholder="Nhập nội dung bài viết">

                    </div> --}}
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
        document.addEventListener('DOMContentLoaded', async function () {
            const videoUrlInput = document.getElementById('video_url');
            const iframe = document.getElementById('video_preview');
            const embedContainer = iframe.parentElement;
            console.log(videoUrlInput, iframe, embedContainer);
            
            const initialUrl = videoUrlInput.value.trim();
            if (initialUrl) {
                await handleVideoPreview(initialUrl);
            }

            videoUrlInput.addEventListener('input', async function () {
                const urlOrId = this.value.trim();
                await handleVideoPreview(urlOrId);
            });

            async function handleVideoPreview(urlOrId) {
                const videoId = extractVideoId(urlOrId);
                if (videoId) {
                    const isValid = await checkVideoExists(videoId);
                    if (isValid) {
                        iframe.src = `https://www.youtube.com/embed/${videoId}`;
                        embedContainer.style.display = 'block';
                    } else {
                        iframe.src = '';
                        embedContainer.style.display = 'none';
                        alert('Video không tồn tại. Vui lòng kiểm tra lại!');
                    }
                } else {
                    iframe.src = '';
                    embedContainer.style.display = 'none';
                    alert('Video không tồn tại. Vui lòng kiểm tra lại!');
                }
            }

            function extractVideoId(url) {
                const patterns = [
                    /youtu\.be\/([A-Za-z0-9_-]+)/,  
                    /youtube\.com\/v\/([A-Za-z0-9_-]+)/,  
                    /youtube\.com\/vi\/([A-Za-z0-9_-]+)/,
                    /youtube\.com\/.*[?&]v=([A-Za-z0-9_-]+)/,
                    /youtube\.com\/.*[?&]vi=([A-Za-z0-9_-]+)/,
                    /youtube\.com\/embed\/([A-Za-z0-9_-]+)/,
                    /youtube\.com\/watch\?v=([A-Za-z0-9_-]+)/
                ];
                for (const pattern of patterns) {
                    const match = url.match(pattern);
                    if (match) {
                        return match[1];
                    }
                }
                if (/^[A-Za-z0-9_-]{11}$/.test(url)) {
                    return url;
                }
                return null;
            }

            async function checkVideoExists(videoId) {
                try {
                    const response = await fetch(`https://www.googleapis.com/youtube/v3/videos?id=${videoId}&key=AIzaSyCPym2YD3jIf6f9_SFyHyrnoZnheuNx334&part=id`);
                    const data = await response.json();
                    return data.items && data.items.length > 0;
                } catch (error) {
                    console.error('Error checking video:', error);
                    return false;
                }
            }
        });
   
    </script>
@endsection
