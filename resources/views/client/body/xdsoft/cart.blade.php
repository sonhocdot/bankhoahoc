@extends('client.layoutx.xdsoft.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <style>
        #softwareitem {
            color: #3581c4;
            border-bottom: 2.4px solid #3581c4
        }
    </style>
@endsection

@section('content')
    <style>
        .form-control {
            background-color: #fff !important;
            color: black !important;
            margin: 5px;
        }

        .form-control:hover {
            background-color: #fff !important;
            color: black !important;

        }

        input {
            color: black !important;
        }
    </style>
    <div style="height: 24px"></div>
    <main class="h-100 mt-5">
        <section class="container-fluid h-100 mt-5 text-center p-5" style="width:90%">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @elseif(session('fail'))
                <div class="alert alert-danger" role="alert">
                    {{ session('fail') }}
                </div>
            @endif

            <body>
                <h4 class="text-title"><b>Giỏ hàng</b></h4>

                <form action="{{ route('insert_cart') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-shopping">

                        <div class="modal-container-shopping row">
                            <div class="cart-inner col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9">

                                <table id="datatable"
                                    class="table table-lg table-borderless table-thead-bordered table-nowrap table-align-middle card-table dataTable no-footer"
                                    role="grid" aria-describedby="datatable_info">
                                    <thead class="thead-light" style="background-color: #FCFCFC; font-size:18px;">
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                                colspan="1" aria-label="Country: activate to sort column ascending">Ảnh
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                                colspan="1" style="width:50%"
                                                aria-label="Country: activate to sort column ascending">Tên sản phẩm
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                                colspan="1" aria-label="Country: activate to sort column ascending">Giá
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                                colspan="1" aria-label="Status: activate to sort column ascending"><a
                                                    class="fa-solid fa-trash text-danger"
                                                    href="{{ route('delete_all_cart') }}"
                                                    onclick="return confirm('Bạn có muốn xóa tất cả khóa học đang có trong giỏ hàng không?')"></a>
                                            </th>
                                        </tr>
                                    </thead>
                                    @if ($cartItems->isNotEmpty())
                                        <tbody style="background-color: white; font-size:18px">
                                            @foreach ($cartItems as $item)
                                                <tr role="row" class="odd" rowId="{{ $item->cart_item_id }}">
                                                    <td><img src="{{ $item->img }}" class="card-img-top"
                                                            style="max-width:180px; max-height:120px" /></td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ number_format($item->gia_giam) }}đ</td>
                                                    <td class="actions">
                                                        <a class="btn btn-outline-danger cart-remove"><i
                                                                class="fa fa-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @endif
                                </table>
                            </div>
                            <div class="cart-total-prices col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 col-xxl-3">
                                <div class="cart-total-prices_inner">
                                    <div class="infor-customer"
                                        style="background-color: #FCFCFC; padding:10px 20px 20px 20px" ;>
                                        <p class="text-title"><b style="font-size: 18px">Khách hàng</b></p>
                                        <span class="input-customer name-customer">
                                            <input type="text" name="ho_ten" class="form-control"
                                                id="validationDefault01" placeholder="Họ tên (*)" required
                                                value="{{ $current_user->display_name }}">
                                        </span>
                                        <span class="input-customer number-customer">
                                            <input type="text" name="so_dien_thoai" class="form-control"
                                                value="{{ $current_user->phone }}" id="validationDefault02"
                                                placeholder="Số điện thoại (*)" required pattern="[0-9]*"
                                                title="Chỉ được nhập số">
                                        </span>
                                        <span class="input-customer email-customer">
                                            <input type="email" name="email" class="form-control"
                                                id="validationDefault03" placeholder="Email (*)" required
                                                value="{{ $current_user->email }}">
                                        </span>
                                        {{-- <span class="input-customer address-customer">
                                        <input type="text" name="dia_chi" class="form-control" id="validationDefault04"
                                            placeholder="Địa chỉ" value="" required>
                                    </span> --}}
                                        <span class="input-customer node-customer">
                                            <input style="height: 56px" type="text" name="ghi_chu" class="form-control"
                                                id="validationDefault05" placeholder="Ghi chú" value="">
                                        </span>

                                    </div>
                                    <br />
                                    <div class="payment" style="background-color: #FCFCFC; padding:10px 20px 0 20px" ;>
                                        <div class="price-item">
                                            @php
                                                $tuition_fee_before_reduction = $cartItems->sum('gia_goc');
                                                $total = $cartItems->sum('gia_giam');
                                                $reduction = $tuition_fee_before_reduction - $total;
                                            @endphp


                                            <div class="row">
                                                <p class="col-9 col-sm-9 col-md-8 col-lg-8 col-xl-6 text"><span
                                                        class="text-title">Giá gốc</span></p>
                                                <p
                                                    class="col-3 col-sm-3 col-md-4 col-lg-4 col-xl-6 m-text-center number-text text-price">
                                                    <span style="font-family: Exo,sans-serif !important; color:#3581c4">
                                                        {{ number_format($tuition_fee_before_reduction) }}đ</span>
                                                    <input id="tieu_de" type="hidden" name="gia_goc"
                                                        value="{{ $tuition_fee_before_reduction }}">

                                                </p>
                                            </div>
                                            <div class="row">
                                                <p class="col-9 col-sm-9 col-md-8 col-lg-8 col-xl-6 text"><span
                                                        class="text-title">Giảm giá</span></p>
                                                <p
                                                    class="col-3 col-sm-3 col-md-4 col-lg-4 col-xl-6 m-text-center number-text text-price">
                                                    <span
                                                        style="font-family: Exo,sans-serif !important; color:#3581c4">{{ number_format($reduction) }}đ</span>
                                                </p>
                                            </div>
                                        </div>

                                        <hr />
                                        <div class="price-total">
                                            <div class="row">
                                                <p class="col-9 col-sm-9 col-md-8 col-lg-8 col-xl-6 text">
                                                    <span class="text-title">Thành tiền</span>
                                                </p>
                                                <p
                                                    class="col-3 col-sm-3 col-md-4 col-lg-4 col-xl-6 m-text-center number-text text-price">
                                                    <span name="gia_giam" value="{{ $total }}"
                                                        style="font-family: Exo,sans-serif !important; color:#3581c4">
                                                        {{ number_format($total) }}đ</span>
                                                    <input id="tieu_de" type="hidden" name="gia_giam"
                                                        value="{{ $total }}">
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="card-footer d-flex justify-content-center align-items-center">
                                        <button id="normal-payment" type="submit" class="btn btn-primary me-2">Mua
                                            hàng</button>
                                        <button id="vnpay-payment" type="button" class="btn btn-success ms-2">Thanh toán
                                            VNPay</button>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="related-product-title text-title">KHÓA HỌC NỔI BẬT</div>
                        <div class="r-product-container">

                        </div> --}}
                        </div>
                </form>
                <form id="vnpayForm" action="{{ route('vnpay.payment') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="amount" value="{{ $total }}">
                    <input type="hidden" name="gia_goc" value="{{ $tuition_fee_before_reduction }}">
                    <input type="hidden" name="gia_giam" value="{{ $total }}">
                    <input type="hidden" name="ho_ten" value="{{ $current_user->display_name }}">
                    <input type="hidden" name="email" value="{{ $current_user->email }}">
                    <input type="hidden" name="so_dien_thoai" value="{{ $current_user->phone }}">
                    <input type="hidden" name="ghi_chu" value="">

                    @foreach ($cartItems as $item)
                        <input type="hidden" name="id_course[]" value="{{ $item->cart_item_id }}">
                    @endforeach
                </form>
            </body>
        </section>
        <script type="text/javascript">
            $(".cart-remove").click(function(e) {
                e.preventDefault();

                var ele = $(this);

                if (confirm("Bạn có thực sự muốn xóa khóa học?")) {
                    $.ajax({
                        url: '{{ route('delete_cart_item') }}',
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: ele.parents("tr").attr("rowId")
                        },
                        success: function(response) {
                            alert(response.message);
                            location.reload();
                        },
                        error: function(error) {
                            console.error("Lỗi:", error);
                            alert("Không thể xóa khóa học. Vui lòng thử lại!");
                        }
                    });
                }
            });

            document.getElementById('normal-payment').addEventListener('click', function() {
                const cartItemCount = {{ $cartItems->count() }};
                if (cartItemCount <= 0) {
                    alert("Bạn cần thêm ít nhất 1 khóa học vào giỏ hàng để thanh toán.");
                }
            });
            document.getElementById('vnpay-payment').addEventListener('click', function() {
                const cartItemCount = {{ $cartItems->count() }};
                if (cartItemCount > 0) {
                    const hoTen = document.querySelector('input[name="ho_ten"]').value;
                    const soDienThoai = document.querySelector('input[name="so_dien_thoai"]').value;
                    const email = document.querySelector('input[name="email"]').value;
                    const ghiChu = document.querySelector('input[name="ghi_chu"]').value;

                    // Gán giá trị vào form ẩn
                    document.querySelector('#vnpayForm input[name="ho_ten"]').value = hoTen;
                    document.querySelector('#vnpayForm input[name="so_dien_thoai"]').value = soDienThoai;
                    document.querySelector('#vnpayForm input[name="email"]').value = email;
                    document.querySelector('#vnpayForm input[name="ghi_chu"]').value = ghiChu;
                    document.getElementById('vnpayForm').submit();
                } else {
                    alert("Bạn cần thêm ít nhất 1 khóa học vào giỏ hàng để thanh toán.");
                }
            });
        </script>
    </main>
@endsection
