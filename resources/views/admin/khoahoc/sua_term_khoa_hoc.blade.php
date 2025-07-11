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
                <h2 class="text-center">Sửa Phân loại khóa học</h2>
                <!-- Card -->
                <form action="{{Request::root().'/admin/edit-term-khoa-hoc'}}" method="post">
                    @csrf
                    <div id="addUserStepProfile" class="card card-lg active" style="">
                        <!-- Body -->
                        <div class="card-body">
                            <!-- Form Group -->
                            <div class="row form-group">
                                <div class="col-sm-9">
                                    <input type="number" class="form-control"
                                           name="id" id="emailLabel" value="{{$term_detail->id}}"
                                           placeholder="VD: techwave@example.com..." aria-label="clarice@example.com" hidden="">
                                </div>
                            </div>
                            <!-- End Form Group -->

                            <!-- Form Group -->
                            <div class="row form-group">
                                <label for="emailLabel" class="col-sm-3 col-form-label input-label">Name <span class="text-danger">(*)</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="term_name" required
                                    value="{{$term_detail->name}}"
                                           placeholder="VD: Hướng dẫn...">
                                </div>
                            </div>
                            <!-- End Form Group -->
                            <!-- Form Group -->
                            <div class="row form-group">
                                <label for="emailLabel" class="col-sm-3 col-form-label input-label">Slug <span class="text-danger">(*)</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="term_slug" required
                                    value="{{$term_detail->slug}}"
                                           placeholder="VD: huongdan, huong-dan,...">
                                </div>
                            </div>
                            <!-- End Form Group -->


                        </div>
                        <!-- End Body -->


                        <!-- Footer -->
                        <div class="card-footer d-flex justify-content-end align-items-center">
                            <button type="submit" class="btn btn-primary">
                                Sửa <i class="tio-chevron-right"></i>
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
