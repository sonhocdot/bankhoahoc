@extends('admin.layout.layout_admin')
@section("main")
    <div class="row justify-content-lg-center">
        <div class="col-lg-8">


            <!-- Content Step Form -->
            <div id="addUserStepFormContent">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @elseif(session('fail'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('fail') }}
                    </div>
                @endif
                <h2 class="text-center">Thêm Tài khoản người dùng</h2>
                <!-- Card -->
                <form action="{{Request::root().'/admin/insert-user'}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div id="addUserStepProfile" class="card card-lg active" style="">
                        @if(!empty($err))
                            <h6 class="text-danger">Lỗi: {{$err}} </h6>
                        @endif
                        <!-- Body -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="form-group">
                                    <label class="input-label" for="avatarUploader">Ảnh đại diện <span class="text-danger">(*)</span></label>
                                    <div class="d-flex align-items-center position-relative">
                                        <!-- Avatar -->
                                        <label class="avatar avatar-xl avatar-circle avatar-uploader mr-5" for="avatarUploader">
                                            <img id="output" class="avatar-img shadow-soft" style="padding: 10px"
                                                 src="{{asset('image/no_img.jfif')}}" alt="Image Description">
        
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
                            <div class="row form-group">
                                <label for="emailLabel" class="col-sm-3 col-form-label input-label">Username <span class="text-danger">(*)</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="username" id="" required
                                           placeholder="Tài khoản đăng nhập" aria-label="clarice@example.com">
                                </div>
                            </div>
                            <!-- End Form Group -->
                            <!-- Form Group -->
                            <div class="row form-group">
                                <label for="emailLabel" class="col-sm-3 col-form-label input-label">Tên hiển thị <span class="text-danger">(*)</span></label>
                                <div class="col-sm-9">
                                    
                                    <input type="text" class="form-control" name="full_name" id="" required
                                           placeholder="Tên user..." aria-label="clarice@example.com">
                                </div>
                            </div>
                            <!-- End Form Group -->
                            <!-- Form Group -->
                            <div class="row form-group">
                                <label for="emailLabel" class="col-sm-3 col-form-label input-label">Email <span class="text-danger">(*)</span></label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="email" id="emailLabel" value=" "
                                           placeholder="VD: techwave@example.com..." aria-label="clarice@example.com">
                                </div>
                            </div>
                            <!-- End Form Group -->
                            <!-- Form Group -->
                            <div class="row form-group">
                                <label for="emailLabel" class="col-sm-3 col-form-label input-label">Số điện thoại <span class="text-danger">(*)</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="phone" id="emailLabel" pattern="[0-9]*" title="Chỉ được nhập số"
                                           placeholder="Số điện thoại" aria-label="clarice@example.com">
                                </div>
                            </div>
                            <!-- End Form Group -->
                            <!-- Form Group -->
                            <div class="row form-group">
                                <label for="emailLabel" class="col-sm-3 col-form-label input-label">Password <span class="text-danger">(*)</span></label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control"
                                           pattern=".{6,}" title="Vui lòng nhập từ 6 kí tự trở lên"
                                           name="password" id="password" required
                                           placeholder="Mật khẩu đăng nhập">
                                </div>
                            </div>

                            <!-- End Form Group -->
                            <div class="form-group row">
                                <label for="inputGroupMergeGenderSelect" class=" col-sm-3  input-label">Phân quyền <span class="text-danger">(*)</span></label>
                                <div class="col-sm-9">
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="tio-user-outlined"></i>
                                        </span>
                                        </div>
                                        <select id="inputGroupMergeGenderSelect" name="quyen" class="custom-select"
                                                required>
                                            <option value="user">User</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputGroupMergeGenderSelect" class=" col-sm-3 input-label">Khóa học đang theo dõi</label>
                                <div class="col-sm-9">
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="tio-user-outlined"></i>
                                        </span>
                                        </div>
                                        <select name="favorite_courses[]" id="favorite_courses"
                                                class="form-control" multiple multiselect-search="true">
    
                                                @foreach($courses as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Body -->

                        <!-- Footer -->
                        <div class="card-footer d-flex justify-content-end align-items-center">
                            <button type="submit" class="btn btn-success">
                                Thêm <i class="tio-chevron-right"></i>
                            </button>
                        </div>
                        <!-- End Footer -->
                    </div>
                    <!-- End Card -->

                </form>
            </div>
            <!-- End Content Step Form -->


        </div>
    </div>
@endsection