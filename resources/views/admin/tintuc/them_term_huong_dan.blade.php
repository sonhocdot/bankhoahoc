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
                <h2 class="text-center">Thêm Phân loại bài viết</h2>
                <!-- Card -->
                <form action="{{Request::root().'/admin/insert-term-huong-dan'}}" method="post">
                    @csrf
                    <div id="addUserStepProfile" class="card card-lg active" style="">
                        <!-- Body -->
                        <div class="card-body">
                            <!-- Form Group -->
                            <div class="row form-group">
                                <label for="emailLabel" class="col-sm-3 col-form-label input-label">Name <span class="text-danger">(*)</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="term_name" required
                                           placeholder="VD: Hướng dẫn...">
                                </div>
                            </div>
                            <!-- End Form Group -->
                            <!-- Form Group -->
                            <div class="row form-group">
                                <label for="emailLabel" class="col-sm-3 col-form-label input-label">Slug <span class="text-danger">(*)</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="term_slug" required
                                           placeholder="VD: huongdan, huong-dan,...">
                                </div>
                            </div>
                            <!-- End Form Group -->


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
