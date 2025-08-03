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
        <form action="{{route('insert_bao_gia')}}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- Header -->
            <div class="card-header" style="background-color: rgb(4, 4, 52); ">
                    <h4 class="card-header-title" style="color: white">Thêm tư vấn</h4>
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

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <!-- Form Group -->
                                <div class="form-group">
                                    <label for="tieu_de" class="input-label">Tỉnh thành
                                    </label>

                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-briefcase-outlined"></i>
                                            </div>
                                        </div>
                                        @php
                                            $tinh_thanh_list = [
                                                'An Giang',
                                                'Bà Rịa - Vũng Tàu',
                                                'Bạc Liêu',
                                                'Bắc Giang',
                                                'Bắc Kạn',
                                                'Bắc Ninh',
                                                'Bến Tre',
                                                'Bình Dương',
                                                'Bình Định',
                                                'Bình Phước',
                                                'Bình Thuận',
                                                'Cà Mau',
                                                'Cao Bằng',
                                                'Cần Thơ',
                                                'Đà Nẵng',
                                                'Đắk Lắk',
                                                'Đắk Nông',
                                                'Điện Biên',
                                                'Đồng Nai',
                                                'Đồng Tháp',
                                                'Gia Lai',
                                                'Hà Giang',
                                                'Hà Nam',
                                                'Hà Nội',
                                                'Hà Tĩnh',
                                                'Hải Dương',
                                                'Hải Phòng',
                                                'Hậu Giang',
                                                'Hòa Bình',
                                                'Hưng Yên',
                                                'Khánh Hòa',
                                                'Kiên Giang',
                                                'Kon Tum',
                                                'Lai Châu',
                                                'Lâm Đồng',
                                                'Lạng Sơn',
                                                'Lào Cai',
                                                'Long An',
                                                'Nam Định',
                                                'Nghệ An',
                                                'Ninh Bình',
                                                'Ninh Thuận',
                                                'Phú Thọ',
                                                'Phú Yên',
                                                'Quảng Bình',
                                                'Quảng Nam',
                                                'Quảng Ngãi',
                                                'Quảng Ninh',
                                                'Quảng Trị',
                                                'Sóc Trăng',
                                                'Sơn La',
                                                'Tây Ninh',
                                                'Thái Bình',
                                                'Thái Nguyên',
                                                'Thanh Hóa',
                                                'Thừa Thiên Huế',
                                                'Tiền Giang',
                                                'TP. Hồ Chí Minh',
                                                'Trà Vinh',
                                                'Tuyên Quang',
                                                'Vĩnh Long',
                                                'Vĩnh Phúc',
                                                'Yên Bái',
                                            ];
                                        @endphp
                                        <select id="tinh_thanh" name="tinh_thanh" class="form-control">
                                            <option value="">Tỉnh thành</option>
                                            @foreach ($tinh_thanh_list as $tinh)
                                                <option value="{{ $tinh }}">
                                                    {{ $tinh }}
                                                </option>
                                            @endforeach
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
                                    <label for="tieu_de" class="input-label">SĐT khách hàng <span class="text-danger">(*)</span>
                                    </label>

                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-briefcase-outlined"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="phone" id="tieu_de"
                                            placeholder="SĐT khách hàng" aria-label="Enter project name here" pattern="[0-9]*" title="Chỉ được nhập số" required>
                                    </div>
                                </div>
                                <!-- End Form Group -->
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <!-- Form Group -->
                                <div class="form-group">
                                    <label for="tieu_de" class="input-label">Thông tin <span class="text-danger">(*)</span>
                                    </label>

                                    <div class="input-group input-group-merge">
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tio-briefcase-outlined"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="thong_tin" id="tieu_de"
                                                placeholder="Thông tin tư vấn" aria-label="Enter project name here" required>
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
                                    <label for="projectNameProjectSettingsLabel" class="input-label">Người yêu cầu tư vấn <span class="text-danger">(*)</span><i
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
                                                <option value="" selected>Khách không có tài khoản</option>
                                            @foreach($users as $user)
                                                @if(session()->get('tk_user') == $user->username)
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


                    </div>

                </div>
                <!-- End Quill -->
                <!-- End Body -->
                <!-- Footer -->
                <div class="card-footer d-flex justify-content-end align-items-center">
                    {{-- <button type="button" class="btn btn-white mr-2">Cancel</button>--}}
                    <button type="submit" class="btn btn-success">Thêm</button>
                </div>
            </div>
        </form>
        <!-- End Footer -->
    </div>
    <!-- End Card -->


</div>
@endsection