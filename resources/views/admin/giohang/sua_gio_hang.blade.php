@extends('admin.layout.layout_admin')

@section('main')
    <div class="col-lg-12">
        <!-- Card -->
        <div class="card card-lg mb-3 mb-lg-5">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @elseif(session('fail'))
                <div class="alert alert-danger" role="alert">
                    {{ session('fail') }}
                </div>
            @endif
            <form action="{{ route('edit_gio_hang') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-header" style="background-color: rgb(4, 4, 52); ">
                    <h4 class="card-header-title" style="color: white">Sửa giỏ hàng</h4>
                </div>

                <!-- Body -->
                <div class="card-body">
                    <!-- Form Group -->
                    <div class="form-group">
                        <input type="number" class="form-control" name="id" value="{{ $cart_detail->id }}"
                            id="projectNameProjectSettingsLabel" placeholder="ID" aria-label="Enter project name here"
                            hidden="">
                    </div>
                    <!-- End Form Group -->
                    <!-- Form Group -->
                    <!-- Tab Content -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="nav-one-eg1" role="tabpanel"
                            aria-labelledby="nav-one-eg1-tab">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <label for="tieu_de" class="input-label">Họ tên khách hàng <span
                                                class="text-danger">(*)</span>
                                        </label>

                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tio-briefcase-outlined"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="ho_ten" id="tieu_de"
                                                value="{{ $cart_detail->ho_ten }}" placeholder="Tên khách hàng"
                                                aria-label="Enter project name here" required>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                                <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <label for="tieu_de" class="input-label">Tài khoản mua hàng <span
                                                class="text-danger">(*)</span>
                                        </label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tio-briefcase-outlined"></i>
                                                </div>
                                            </div>
                                            <select name="id_user" id="projectNameProjectSettingsLabel"
                                                class="form-control">

                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ $cart_detail->id_user == $user->id ? 'selected' : '' }}>
                                                        {{ $user->display_name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                                <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <label for="tieu_de" class="input-label">Số điện thoại <span
                                                class="text-danger">(*)</span>
                                        </label>

                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tio-briefcase-outlined"></i>
                                                </div>
                                            </div>
                                            <input id="so_dien_thoai" name="so_dien_thoai" type="text"
                                                value="{{ $cart_detail->so_dien_thoai }}" placeholder="Nhập số điện thoại"
                                                aria-label="Enter project name here" pattern="[0-9]*"
                                                title="Chỉ được nhập số" class="form-control">
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
                                                value="{{ $cart_detail->email }}" placeholder="Email..."
                                                aria-label="Enter project name here">
                                        </div>
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <label for="tieu_de" class="input-label">Giá gốc <span
                                                class="text-danger">(*)</span>
                                        </label>

                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tio-briefcase-outlined"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="gia_goc" id="gia_goc"
                                                value="{{ $cart_detail->gia_goc }}" placeholder="Nhập tổng học phí gốc"
                                                aria-label="Enter project name here" required pattern="[0-9]*"
                                                title="Chỉ được nhập số">
                                        </div>
                                    </div>
                                    <!-- End Form Group -->
                                </div>

                                <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <label for="tieu_de" class="input-label">Giá giảm <span
                                                class="text-danger">(*)</span>
                                        </label>

                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tio-briefcase-outlined"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="gia_giam" id="gia_giam"
                                                value="{{ $cart_detail->gia_giam }}"
                                                placeholder="Nhập học phí sau khi giảm"
                                                aria-label="Enter project name here" required pattern="[0-9]*"
                                                title="Chỉ được nhập số">
                                        </div>
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                                <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <label for="tieu_de" class="input-label">Trạng thái phiếu <span
                                                class="text-danger">(*)</span>
                                        </label>
                                        <select id="trang_thai" name="trang_thai" value="{{ $cart_detail->trang_thai }}"
                                            class="form-control">
                                            <option value="Chưa mua"
                                                {{ $cart_detail->trang_thai == 'Chưa mua' ? 'selected' : '' }}>Chưa mua
                                            </option>
                                            <option value="Đã đặt mua"
                                                {{ $cart_detail->trang_thai == 'Đã đặt mua' ? 'selected' : '' }}>Đã đặt
                                                mua</option>
                                            <option value="Đã thanh toán"
                                                {{ $cart_detail->trang_thai == 'Đã thanh toán' ? 'selected' : '' }}>Đã
                                                thanh toán</option>
                                            <option value="Lỗi thanh toán"
                                                {{ $cart_detail->trang_thai == 'Lỗi thanh toán' ? 'selected' : '' }}>Lỗi
                                                thanh toán</option>
                                            <option value="Hủy đặt mua"
                                                {{ $cart_detail->trang_thai == 'Hủy đặt mua' ? 'selected' : '' }}>Hủy đặt
                                                mua</option>
                                            <option value="Đã hoàn tiền"
                                                {{ $cart_detail->trang_thai == 'Đã hoàn tiền' ? 'selected' : '' }}>Đã
                                                hoàn tiền</option>
                                            <option value="Lỗi mua hàng"
                                                {{ $cart_detail->trang_thai == 'Lỗi mua hàng' ? 'selected' : '' }}>Lỗi
                                                mua hàng</option>
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
                                                value="{{ $cart_detail->ghi_chu }}" placeholder="Nhập ghi chú (Nếu có)"
                                                aria-label="Enter project name here">
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
                                            <select name="courses[]" id="courses" class="form-control" multiple
                                                multiselect-search="true">

                                                @foreach ($courses as $category)
                                                    <option value="{{ $category->id }}"
                                                        @foreach ($course_list as $item) 
                                                {{ $item->id_course == $category->id ? 'selected' : '' }} @endforeach>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- End Body -->

                    <!-- Footer -->
                    <div class="card-footer d-flex justify-content-end align-items-center">
                        {{-- <button type="button" class="btn btn-white mr-2">Cancel</button> --}}
                        <button type="submit" class="btn btn-success">Sửa</button>
                    </div>
            </form>
            <!-- End Footer -->
        </div>
        <!-- End Card -->
    </div>

    <script>
        const coursesData = @json($courses);
        document.addEventListener("DOMContentLoaded", function() {
            const coursesSelect = document.getElementById("courses");
            const giaGocInput = document.getElementById("gia_goc");
            const giaGiamInput = document.getElementById("gia_giam");
            const coursesData = @json($courses);

            coursesSelect.addEventListener("change", function() {
                let totalGiaGoc = 0;
                let totalGiaGiam = 0;
                const selectedOptions = Array.from(coursesSelect.selectedOptions).map(option => option
                    .value);
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
