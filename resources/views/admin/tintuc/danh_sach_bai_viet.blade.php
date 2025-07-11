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
                    <form action="{{ route('timkiemBV') }}" method="GET">
                        <!-- Search -->
                        <div class="input-group input-group-merge input-group-flush">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tio-search"></i>
                                </div>
                            </div>
                            <input id="datatableSearch" type="search" class="form-control"
                                value="{{ !empty($search_text) ? $search_text : '' }}" name="s"
                                placeholder="Tìm kiếm bài viết" aria-label="Search users">
                            <button type="submit" class="btn btn-success pt-1 pb-1 pr-2 pl-2"><i
                                    class="fa-solid fa-magnifying-glass" style="color: #f6f9f6;"></i></button>
                        </div>
                        <!-- End Search -->
                    </form>
                </div>
                <div class="col-sm-6 col-md-4 mb-3 mb-sm-0 d-flex justify-content-end">
                    <a href="{{ route('themBV') }}" class="btn btn-success pt-1 pb-1 pr-2 pl-2">Thêm mới</a>
                </div>
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

                            {{--                        <th class="table-column-pl-0 sorting text-center p-1 align-middle" tabindex="0" aria-controls="datatable" rowspan="1" --}}
                            {{--                            colspan="1" aria-label="Name: activate to sort column ascending"> --}}
                            {{--                            STT --}}
                            {{--                        </th> --}}
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Position: activate to sort column ascending">Ảnh
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Country: activate to sort column ascending">Tên bài
                                viết
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
                        @foreach ($ds_bai_viet as $item)
                            <tr role="row" class="odd">


                                {{--                            <td class="table-column-pl-0 text-center"> --}}
                                {{--                                @if (empty(Request::get('page'))) --}}
                                {{--                                    {{$loop->index + 1+ Request::get('page')* count($ds_bai_viet)}} --}}
                                {{--                                @else --}}
                                {{--                                    {{$loop->index + 1 + Request::get('page')* count($ds_bai_viet) -15}} --}}
                                {{--                                @endif --}}
                                {{--                            </td> --}}
                                <td>
                                    {{--                                <img src="{{asset('storage/images/'.$item->twitter_image)}}" alt="" style="width: 80px;height: 80px"> --}}
                                    {{--                                <img src="{{ $item->twitter_image }}" alt="" style="width: 80px;height: 80px"> --}}
                                    @if (preg_match_all('((http|https)\:\/\/)', $item->post_image))
                                        <img src="{{ $item->post_image }}" alt="" style="width: 80px;height: 80px">
                                    @else
                                        <img src="{{ asset('images/' . $item->post_image) }}" alt=""
                                            style="width: 80px;height: 80px">
                                    @endif

                                </td>

                                <td><a href="{{ route('tintuc.post', ['slug' => $item->slug]) }}">{{ $item->post_title }}</a>
                                </td>

                                @if (!empty($item->author_name))
                                    <td> {{ $item->author_name }}</td>
                                @else
                                    <td>Admin</td>
                                @endif
                                <td>{{ $item->post_date }}</td>
                                <td>
                                    @if (session()->get('role') == 'admin' || session()->get('role') == 'nv')
                                        <a class="btn btn-sm btn-white" href="{{ route('suaBV', ['id' => $item->ID]) }}">
                                            <i class="fa-solid fa-pen-to-square" style="color: #1d158a;"></i>
                                        </a>
                                    @endif
                                    @if (session()->get('role') == 'admin')
                                        <a class="btn btn-sm btn-white" href="{{ route('xoaBV', ['id' => $item->ID]) }}"
                                            onclick="return confirm('Bạn có chắc muốn xóa bài viết {{ $item->post_title }} không?')">
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
                {{ $ds_bai_viet->appends(request()->all())->links() }}
            </div>
            <!-- End Pagination -->
        </div>
        <!-- End Footer -->
    </div>
@endsection
