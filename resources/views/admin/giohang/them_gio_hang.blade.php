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
        <form action="{{route('insert_gio_hang')}}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- Header -->
            <div class="card-header" style="background-color: rgb(4, 4, 52); ">
                    <h4 class="card-header-title" style="color: white" >Thêm đơn hàng</h4>
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
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                <!-- Form Group -->
                                <div class="form-group">
                                    <label for="tieu_de" class="input-label">Họ tên khách hàng <span class="text-danger">(*)</span>
                                    </label>

                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-briefcase-outlined"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="ho_ten" id="tieu_de"
                                            placeholder="Tên khách hàng" aria-label="Enter project name here" required>
                                    </div>
                                </div>
                                <!-- End Form Group -->
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                <!-- Form Group -->
                                <div class="form-group">
                                    <label for="tieu_de" class="input-label">Tài khoản mua hàng <span class="text-danger">(*)</span>
                                    </label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-briefcase-outlined"></i>
                                            </div>
                                        </div>
                                        <select name="id_user" id="projectNameProjectSettingsLabel"
                                                    class="form-control">

                                                @foreach($users as $user)
                                                    <option
                                                        value="{{$user->id}}">{{$user->display_name}}</option>
                                                @endforeach

                                            </select>
                                    </div>
                                </div>
                                <!-- End Form Group -->
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                <!-- Form Group -->
                                <div class="form-group">
                                    <label for="tieu_de" class="input-label">Số điện thoại <span class="text-danger">(*)</span>
                                    </label>

                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-briefcase-outlined"></i>
                                            </div>
                                        </div>
                                        <input id="so_dien_thoai" name="so_dien_thoai" type="text" 
                                        placeholder="Nhập số điện thoại" aria-label="Enter project name here"
                                        class="form-control" pattern="[0-9]*" title="Chỉ được nhập số">
                                    </div>
                                </div>
                                <!-- End Form Group -->
                            </div>

                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                <!-- Form Group -->
                                <div class="form-group">
                                    <label for="tieu_de" class="input-label">Email <span class="text-danger">(*)</span>
                                    </label>

                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-briefcase-outlined"></i>
                                            </div>
                                        </div>
                                        <input type="email" class="form-control" name="email" id="tieu_de"
                                            placeholder="Email..." aria-label="Enter project name here">
                                    </div>
                                </div>
                                <!-- End Form Group -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
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
                                        <input type="text" class="form-control" name="gia_goc" id="gia_goc" pattern="[0-9]*" title="Chỉ được nhập số"
                                            placeholder="Nhập tổng học phí gốc" aria-label="Enter project name here" required>
                                    </div>
                                </div>
                                <!-- End Form Group -->
                            </div>
                            
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
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
                                        <input type="text" class="form-control" name="gia_giam" id="gia_giam" pattern="[0-9]*" title="Chỉ được nhập số"
                                            placeholder="Nhập học phí sau khi giảm" aria-label="Enter project name here" required>
                                    </div>
                                </div>
                                <!-- End Form Group -->
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                <!-- Form Group -->
                                <div class="form-group">
                                    <label for="tieu_de" class="input-label">Trạng thái phiếu <span class="text-danger">(*)</span>
                                    </label>
                                    <select id="trang_thai" name="trang_thai" class="form-control">
                                        <option value="Chưa mua" selected>Chưa mua</option>
                                        <option value="Đã đặt mua">Đã đặt mua</option>
                                        <option value="Đã thanh toán">Đã thanh toán</option>
                                        <option value="Lỗi thanh toán">Lỗi thanh toán</option>
                                        <option value="Hủy đặt mua">Hủy đặt mua</option>
                                        <option value="Đã hoàn tiền">Đã hoàn tiền</option>
                                        <option value="Lỗi mua hàng">Lỗi mua hàng</option>
                                    </select>
                                </div>
                                <!-- End Form Group -->  
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                <!-- Form Group -->
                                <div class="form-group">
                                    <label for="tieu_de" class="input-label">Ghi chú
                                    </label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-briefcase-outlined"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="ghi_chu" id="tieu_de"
                                            placeholder="Nhập ghi chú (Nếu có)" aria-label="Enter project name here">
                                    </div>
                                </div>
                                <!-- End Form Group -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <!-- Form Group -->
                                <div class="form-group">
                                    <label for="projectNameProjectSettingsLabel" class="input-label">Khóa học <i
                                            class="tio-help-outlined text-body ml-1" data-toggle="tooltip"
                                            data-placement="top" title=""
                                            data-original-title="Displayed on public forums, such as Front."></i></label>

                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-briefcase-outlined"></i>
                                            </div>
                                        </div>
                                        <select name="courses[]" id="courses"
                                            class="form-control" multiple multiselect-search="true">

                                            @foreach($courses as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach

                                        </select>
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
                    <button type="submit" class="btn btn-success">Thêm</button>
                </div>
        </form>
        <!-- End Footer -->
    </div>
    <!-- End Card -->


</div>
<script>
    const coursesData = @json($courses);
    document.addEventListener("DOMContentLoaded", function () {
    const coursesSelect = document.getElementById("courses");
    const giaGocInput = document.getElementById("gia_goc");
    const giaGiamInput = document.getElementById("gia_giam");
    const coursesData = @json($courses);
    coursesSelect.addEventListener("change", function () {
        let totalGiaGoc = 0;
        let totalGiaGiam = 0;
        const selectedOptions = Array.from(coursesSelect.selectedOptions).map(option => option.value);
        selectedOptions.forEach(courseId => {
            const course = coursesData.find(item => item.id == courseId);
            if (course) {
                totalGiaGoc += parseInt(course.gia_goc || 0, 10);
                totalGiaGiam += parseInt(course.gia_giam || 0, 10);
            }
        });

        giaGocInput.value = totalGiaGoc; 
        giaGiamInput.value = totalGiaGiam;
    });
});

</script>

@endsection