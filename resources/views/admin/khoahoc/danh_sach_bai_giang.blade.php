@extends('admin.layout.layout_admin')
@section('main')
    <div class="card" style="max-height: 100vh">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @elseif(session('fail'))
            <div class="alert alert-danger" role="alert">
                {{ session('fail') }}
            </div>
        @endif
        <!-- Header -->
        <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col-sm-6 col-md-4 mb-3 mb-sm-0">
                    <form action="{{ route('find_lesson') }}" method="GET">
                        <!-- Search -->
                        <div class="input-group input-group-merge input-group-flush">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tio-search"></i>
                                </div>
                            </div>
                            <input id="datatableSearch" type="search" class="form-control"
                                value="{{ !empty($search_text) ? $search_text : '' }}" name="s"
                                placeholder="Tìm kiếm bài giảng" aria-label="Search users">
                            <button type="submit" class="btn btn-success pt-1 pb-1 pr-2 pl-2"><i
                                    class="fa-solid fa-magnifying-glass" style="color: #f6f9f6;"></i></button>
                        </div>
                        <!-- End Search -->
                    </form>
                </div>
                <div class="col-sm-6 col-md-4 mb-3 mb-sm-0 d-flex justify-content-end">
                    <a href="{{ route('them_lesson') }}" class="btn btn-success pt-1 pb-1 pr-2 pl-2">Thêm mới</a>
                </div>
                {{-- <div class="col-sm-6 col-md-4 mb-3 mb-sm-0"> --}}
                {{--                    <form method="POST" action="{{route('import_js')}}" enctype="multipart/form-data"> --}}
                {{--                        <div class="input-group input-group-merge input-group-flush"> --}}
                {{--                            <input type="file" accept=".json" id="up" name="file"/> --}}
                {{--                            --}}{{--                    <div class="spinner-border text-primary sspinner d-none"></div> --}}
                {{--                            <button type="submit" class="btn btn-primary pt-1 pb-1 pr-2 pl-2" style="margin: 7px 0">Import</button> --}}
                {{--                        </div> --}}
                {{--                    </form> --}}
                {{--                </div> --}}
            </div>
            <!-- End Row -->
        </div>
        <!-- End Header -->

        <!-- Table -->
        <div class="table-responsive datatable-custom">
            <div id="datatable_wrapper" class="dataTables_wrapper no-footer">

                <table id="datatable"
                    class="table table-lg table-borderless table-thead-bordered table-nowrap table-align-middle card-table dataTable no-footer"
                    role="grid" aria-describedby="datatable_info">
                    <thead class="thead-dark">
                        <tr role="row">
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Country: activate to sort column ascending">Ảnh
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Country: activate to sort column ascending">Tên bài giảng
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Country: activate to sort column ascending">Khóa học
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Status: activate to sort column ascending">Tác giả
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Role: activate to sort column ascending">Ngày tạo
                            </th>
                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="">Hành động
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($ds_lesson as $item)
                            <tr role="row" class="odd">
                                <td>
                                    @if ($item->video_id)
                                        <?php
                                        $videoId = $item->video_id;
                                        $patterns = [
                                            '/youtu\.be\/([A-Za-z0-9_-]+)/', // Dạng ngắn gọn
                                            '/youtube\.com\/v\/([A-Za-z0-9_-]+)/', // Dạng /v/
                                            '/youtube\.com\/vi\/([A-Za-z0-9_-]+)/', // Dạng /vi/
                                            '/youtube\.com\/.*[?&]v=([A-Za-z0-9_-]+)/', // Dạng ?v=
                                            '/youtube\.com\/.*[?&]vi=([A-Za-z0-9_-]+)/', // Dạng ?vi=
                                            '/youtube\.com\/embed\/([A-Za-z0-9_-]+)/', // Dạng embed/
                                            '/youtube\.com\/watch\?v=([A-Za-z0-9_-]+)/', // Dạng watch?v=
                                        ];
                                        
                                        foreach ($patterns as $pattern) {
                                            if (preg_match($pattern, $videoId, $matches)) {
                                                $videoId = $matches[1];
                                                break;
                                            }
                                        }
                                        ?>
                                        <img src="https://i3.ytimg.com/vi/{{ $videoId }}/maxresdefault.jpg"
                                            alt="" style="width: 100px; height: 80px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('image/no_img.jfif') }}" alt=""
                                            style="width: 100px; height: 80px; object-fit: cover;">
                                    @endif
                                </td>

                                <td><a>{{ $item->lesson_title }}</a></td>

                                <td>{{ $item->courseName }}</td>

                                @if (!empty($item->author_name))
                                    <td> {{ $item->author_name }}</td>
                                @else
                                    <td>Admin</td>
                                @endif

                                <td>{{ $item->created_at }}</td>
                                <td>
                                    @if (session()->get('role') == 'admin' || session()->get('role') == 'nv')
                                        <a class="btn btn-sm btn-white"
                                            href="{{ route('page_edit_lesson', ['id' => $item->id]) }}">
                                            <i class="fa-solid fa-pen-to-square" style="color: #1d158a;"></i>
                                        </a>
                                    @endif
                                    @if (session()->get('role') == 'admin')
                                        <a class="btn btn-sm btn-white"
                                            href="{{ route('delete_lesson', ['id' => $item->id]) }}"
                                            onclick="return confirm('Bạn có chắc muốn xóa bài giảng {{ $item->lesson_title }} không?')">
                                            <i class="fa-solid fa-trash" style="color: #c13829;"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">Showing 1 to 15 of 24
                    entries
                </div>
            </div>
        </div>
        <!-- End Table -->

        <!-- Footer -->
        <div class="card-footer">
            <!-- Pagination -->
            <div class="row justify-content-center align-items-sm-center">
                {{ $ds_lesson->appends(request()->all())->links() }}
            </div>
            <!-- End Pagination -->
        </div>
        <!-- End Footer -->
    </div>
@endsection
