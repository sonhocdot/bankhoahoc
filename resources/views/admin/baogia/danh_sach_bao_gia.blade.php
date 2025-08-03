@extends('admin.layout.layout_admin')
@section("main")
    <div class="card" style="max-height: 100vh">
        @if(session('success'))
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
                    <form action="{{route('find_bao_gia')}}" method="GET">
                        <!-- Search -->
                        <div class="input-group input-group-merge input-group-flush">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tio-search"></i>
                                </div>
                            </div>
                            <input id="datatableSearch" type="search" class="form-control"
                                   value="{{!empty($search_text)?$search_text:""}}"
                                   name="s"
                                   placeholder="Tìm kiếm tư vấn"
                                   aria-label="Search users">
                            <button type="submit" class="btn btn-success pt-1 pb-1 pr-2 pl-2">
                                <i class="fa-solid fa-magnifying-glass" style="color: #f6f9f6;"></i>
                            </button>
                        </div>
                        <!-- End Search -->
                    </form>
                </div>
                <div class="col-sm-6 col-md-4 mb-3 mb-sm-0 d-flex justify-content-end">
                    <a href="{{Request::root()."/".'admin/them-bao-gia'}}" class="btn btn-success pt-1 pb-1 pr-2 pl-2">Thêm
                        mới</a>
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
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                            aria-label="Position: activate to sort column ascending">Họ tên
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                            aria-label="Country: activate to sort column ascending">Tỉnh thành
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                            aria-label="Country: activate to sort column ascending">SĐT
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                            aria-label="Status: activate to sort column ascending">Thông tin 
                        </th>

                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label=""
                        >Hành động
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($ds_bao_gia as $item)
                        <tr role="row" class="odd">
                            
        
                            <td> {{ $item->ho_ten }}</td>
                            @if(!empty($item->tinh_thanh))
                            <td> {{ $item->tinh_thanh }}</td>
                            @else
                            <td>Chưa rõ</td>
                            @endif
                            <td> {{ $item->phone }}</td>
                            <td style="max-width:700px; white-space: pre-wrap;"> {{ $item->thong_tin }}</td>

                            <td>
                                @if(session()->get('role') == 'admin' || session()->get('role') == 'nv')
                                    <a class="btn btn-sm btn-white"
                                       href="{{route('page_edit_bao_gia',['id'=>$item->id])}}">
                                        <i class="fa-solid fa-pen-to-square" style="color: #1d158a;"></i>
                                    </a>
                                @endif
                                @if(session()->get('role') == 'admin')
                                    <a class="btn btn-sm btn-white" href="{{route('delete_bao_gia',['id'=>$item->id])}}"
                                       onclick="return confirm('Bạn có chắc muốn xóa thông tin tư vấn này không?')">
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
                {{ $ds_bao_gia->appends(request()->all())->links()}}
            </div>
            <!-- End Pagination -->
        </div>
        <!-- End Footer -->
    </div>

@endsection
