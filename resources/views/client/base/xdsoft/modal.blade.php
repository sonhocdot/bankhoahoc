<style>
    #myModal0 .modal-header button {
        background-color: white;
        border: none;
        margin-top: -10px;
        margin-bottom: -10px;
    }

    #myModal0 .modal-header button span {
        font-size: 25px;
    }

    #myModal0 .modal-body .modal-title-blue,
    #myModal0 .modal-body .modal-title-blue:hover {
        color: #00659f !important;
    }

    #myModal0 .modal-body {
        font-size: 16px;
        font-family: Arial, Helvetica, sans-serif;
        line-height: 24px;
    }

    @media (max-width: 580px) {
        #myModal0 .modal-body div.modal-advice-img {
            display: none;
        }
    }

    #myModal0 .modal-body textarea {
        height: 50px;
    }

    #myModal0 .modal-body select option {
        color: black;
    }

    #myModal0 .modal-body .form-control {
        background-color: white !important;
        color: gray !important;
    }

    #myModal0 .modal-body .form-group label {
        font-weight: bolder;
    }

    #myModal0 .modal-body .im {
        color: red;
    }
</style>

<script>
    $(document).ready(function() {
        $('.showModalButton').click(function(event) {
            event.preventDefault();
            $('#myModal0').modal('show');
        });
        $('.modal-close').click(function() {
            $('#myModal0').modal('hide');
        });
    });
</script>

<div class="modal fade" id="myModal0" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width:640px; border-radius:10px;">
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
                <h5 class="modal-title fw-bolder" id="exampleModalLabel">Code Fun</h5>
                <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <form action="{{ route('xdsoft.create.baogia') }}" id="form2"
                    style=" border-radius: 6px; margin: 0px;" method="post" accept-charset="utf-8">
                    @csrf
                    <div class="row w-100 m-auto modal-advice-img">
                        <div style="height: 265px; padding:0;">
                            <img style=" width:100%;height:100%;object-fit:cover;"
                                src="/image/TrangChu/tv.jpg" alt="">
                        </div>
                    </div>
                    {{-- <div style="display:none;"><input type="hidden" name="_method" value="POST"></div><input
                        type="hidden" name="data[Project][unit_payment]" value="VNĐ" id="ProjectUnitPayment"><input
                        type="hidden" name="data[Project][exit_popup]" value="1" id="ProjectExitPopup"> --}}
                    <div class="p-4">
                        <div class="row">
                            <div class="col-xs-12 m-b-15 mt-3 mb-3">
                                <h3 style="font-weight: bold; text-align: center; color: red;" class=" m-b-15">TƯ VẤN
                                    MIỄN
                                    PHÍ</h3>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="ProjectDescription" class="col-xs-12 col-sm-5 col-md-3 col-lg-4">Thông tin cần
                                tư vấn<span class="im">*</span></label>
                            <div class="col-xs-12 col-sm-7 col-md-9 col-lg-8 fix-height required" aria-required="true">
                                <textarea name="data_description" placeholder="Mô tả chi tiết những gì bạn cần tư vấn." required class="form-control"
                                    cols="30" rows="6" id="ProjectDescription" aria-required="true"></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="ProjectProvinceId" class="col-xs-12 col-sm-5 col-md-3 col-lg-4">Địa điểm tư
                                vấn</label>
                            <div class="col-xs-12 col-sm-7 col-md-5 col-lg-5 required" aria-required="true">
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
                                <select name="data_province" class="form-control"
                                    div="col-xs-12 col-sm-7 col-md-9 col-lg-8 required" id="ProjectProvinceId">
                                    <option value="">Hỗ trợ 24/7, ngay tại nhà</option>
                                    @foreach ($tinh_thanh_list as $tinh)
                                        <option value="{{ $tinh }}">
                                            {{ $tinh }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="ProjectName" class="col-xs-12 col-sm-5 col-md-3 col-lg-4">Họ và tên<span
                                    class="im">*</span></label>
                            <div class="col-xs-12 col-sm-7 col-md-5 col-lg-5 required" aria-required="true">
                                <input name="data_name" placeholder="Họ và tên của bạn" class="form-control"
                                    id="name" type="text" required />
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="Member_newbiePhone" class="col-xs-12 col-sm-5 col-md-3 col-lg-4">Số điện
                                thoại<span class="im">*</span></label>
                            <div class="col-xs-12 col-sm-7 col-md-5 col-lg-5 required" aria-required="true"><input
                                    name="data_phone" maxlength="12" required
                                    placeholder="Số điện thoại đi động của bạn" class="form-control" id="phone2"
                                    oninput="if (!window.__cfRLUnblockHandlers) return false; this.value=this.value.replace(/[^0-9]/g,&quot;&quot;)"
                                    type="text" pattern="[0-9]+" title="Chỉ nhập chữ số" /></div>
                        </div>


                        <div class="form-group m-t-15 mb-3">
                            <div class="text-center submit">
                                <button type="submit" class="btn btn-success btn_registion btn-primary"
                                    id="post_baogia2"><span style="font-size: 16px;">Gửi Thông Tin</span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
