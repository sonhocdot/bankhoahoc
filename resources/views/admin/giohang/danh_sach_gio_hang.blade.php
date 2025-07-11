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
                    <form action="{{ route('find_gio_hang') }}" method="GET">
                        <!-- Search -->
                        <div class="input-group input-group-merge input-group-flush">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tio-search"></i>
                                </div>
                            </div>
                            <input id="datatableSearch" type="search" class="form-control"
                                value="{{ !empty($search_text) ? $search_text : '' }}" name="s"
                                placeholder="Tìm kiếm giỏ hàng" aria-label="Search users">

                            <button type="submit" class="btn btn-success pt-1 pb-1 pr-2 pl-2">
                                <i class="fa-solid fa-magnifying-glass" style="color: #f6f9f6;"></i>
                            </button>
                        </div>
                        <!-- End Search -->
                    </form>
                </div>
                <div class="col-sm-6 col-md-4 mb-3 mb-sm-0 d-flex justify-content-end">
                    <a href="{{ Request::root() . '/' . 'admin/them-gio-hang' }}"
                        class="btn btn-success pt-1 pb-1 pr-2 pl-2">Thêm
                        mới</a>
                </div>
            </div>
            <!-- End Row -->
        </div>
        <!-- End Header -->

        <!-- Table -->
        <div class="table-responsive datatable-custom">
            <div id="datatable_wrapper" class="dataTables_wrapper no-footer">
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="bg-primary p-3 rounded text-center">
                            <strong class="text-light">Số đơn đặt mua</strong>
                            <hr>
                            <h4 class="text-light">{{ $datMua }}</h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="bg-success p-3 rounded text-center">
                            <strong class="text-light">Số đơn đã thanh toán</strong>
                            <hr>
                            <h4 class="text-light">{{ $daThanhToan }}</h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="bg-danger p-3 rounded text-center">
                            <strong class="text-light">Tổng số đơn hàng</strong>
                            <hr>
                            <h4 class="text-light">{{ $tongDonHang }}</h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="bg-warning p-3 rounded text-center">
                            <strong class="text-dark">Tổng doanh thu</strong>
                            <hr>
                            <h4 class="text-dark">{{ number_format($tongDoanhThu, 0, ',', '.') }} VNĐ</h4>
                        </div>
                    </div>
                </div>

                <table id="datatable"
                    class="table table-lg table-borderless table-thead-bordered table-nowrap table-align-middle card-table dataTable no-footer"
                    role="grid" aria-describedby="datatable_info">
                    <thead class="thead-dark">
                        <tr role="row">


                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Country: activate to sort column ascending">Họ và tên
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Country: activate to sort column ascending">Tổng học phí
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Country: activate to sort column ascending">Số điện thoại
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Status: activate to sort column ascending">Email
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Status: activate to sort column ascending">Ghi chú
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Status: activate to sort column ascending">Trạng thái
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Role: activate to sort column ascending">Ngày tạo
                            </th>

                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Role: activate to sort column ascending">Xử lí
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($ds_invoices as $item)
                            <tr role="row" class="odd">
                                <td>{{ $item->ho_ten }}</td>
                                <td>{{ number_format($item->gia_giam, 0, ',', '.') }}</td>
                                <td>{{ $item->so_dien_thoai }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->ghi_chu }}</td>
                                {{-- <td>{{$item->trang_thai}}</td> --}}
                                @if (!empty($item->trang_thai))
                                    <td> {{ $item->trang_thai }}</td>
                                @else
                                    <td>Chưa gọi</td>
                                @endif
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    @if (session()->get('role') == 'admin' || session()->get('role') == 'nv')
                                        <a class="btn btn-sm btn-white"
                                            href="{{ route('page_edit_gio_hang', ['id' => $item->id]) }}">
                                            <i class="fa-solid fa-pen-to-square" style="color: #1d158a;"></i>
                                        </a>
                                    @endif
                                    @if (session()->get('role') == 'admin')
                                        <a class="btn btn-sm btn-white"
                                            href="{{ route('delete_gio_hang', ['id' => $item->id]) }}"
                                            onclick="return confirm('Bạn có chắc muốn xóa giỏ hàng này không?')">
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
                {{ $ds_invoices->appends(request()->all())->links() }}
            </div>
            <!-- End Pagination -->
        </div>
        <!-- End Footer -->
    </div>
@endsection
