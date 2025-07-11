@extends('client.layout.xdsoft.app')


@section('css')
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <style>
        .text-decoration-underline{
            margin-bottom: 30px;
        }
        .slide-item img {
            height: 404px;
            object-fit: cover;
        }
        @media screen and (max-width: 1400px) {
            .slide-item img {
                height: 350px;
                object-fit: cover;
            }
        }
        @media screen and (max-width: 1200px) {
            .slide-item img {
                height: 295px ;
                object-fit: cover;
            }
        }
        @media screen and (max-width: 992px) {
            .slide-item img {
                height: 333px ;
                object-fit: cover;
            }
        }
        @media screen and (max-width: 768px) {
            .slide-item img {
                height: 502px ;
                object-fit: cover;
            }
            .category_tin_tuc{
                display: block!important;
            }
        }
        @media screen and (max-width: 391px) {
            .slide-item img {
                height: 360px ;
                object-fit: cover;
            }
        }
        h2{
            font-weight: 800!important;
        }
        .category-item{
            padding: 0 20px;
        }
        .category_tin_tuc{
            display: flex;
        }

    </style>
    <script>
      $(document).ready(function () {
          $("#youtubeCarousel").owlCarousel({
              margin: 20, // Margin between items
              loop: true, // Infinite loop
              nav: true, // Display navigation arrows
              // lazyLoad:true,
              navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"], // Custom navigation arrows
              responsive: {
                  0: { items: 1 },
                  768: { items: 2 },
                  1112: { items: 3 },
                  1450:{ items: 4 },
              },
          });

          $("#facebookCarousel").owlCarousel({
              margin: 20, // Margin between items
              loop: true, // Infinite loop
              nav: true, // Display navigation arrows
              // lazyLoad:true,
              navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"], // Custom navigation arrows
              responsive: {
                  0: { items: 1 },
                  768: { items: 2 },
                  1112: { items: 3 },
                  1450:{ items: 4 },
              },
          });
      });

  </script>
  
  
@endsection

@section('content')
<nav id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <!-- Carousel Indicators -->
  <ol class="carousel-indicators" style="top:490px">
    @foreach ($head_carousels as $key => $head_carousel)
      <li data-bs-target="#carouselExampleFade" data-bs-slide-to="{{ $key }}" class="{{ $loop->first ? 'active' : '' }}"
        style="width: 10px; height: 10px; border-radius: 100%; margin:0 3px 0 3px !important;"></li>
    @endforeach
  </ol>

  <div class="carousel-inner banner">
    @foreach ($head_carousels as $key => $head_carousel)
    <div class="carousel-item overflow-hidden position-relative {{ $loop->first ? 'active' : '' }}" data-bs-interval="30000">
      <img src="{{ asset( $head_carousel) }}" loading="lazy" class="w-100 position-relative" alt="Banner {{ $key + 1 }} - Description" style="height: 600px; object-fit: cover;" />
    </div>
    @endforeach
  </div>
  
  <button class="carousel-control-prev text-light" type="button" data-bs-target="#carouselExampleFade"
    data-bs-slide="prev" aria-label="Previous Slide">
    <span class="carousel-control-prev-icon border border-2 pt-4 pb-2 rounded-4" aria-hidden="false"></span>
    <span class="visually-hidden text-black">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next" aria-label="Next Slide">
    <span class="carousel-control-next-icon border border-2 rounded-4 pt-4 pb-2" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</nav>

<main>
  <div class="pe-0 ps-0">
    <div class="row justify-content-center align-items-center g-2 m-auto" style="max-width:100%;">
      <div class="col-12 p-0">
        <aside class="p-0 mb-3 rounded pb-5" style="background-color: rgba(240, 240, 240, 0.5); background-blend-mode: multiply;">
          <article>
          {{-- <img src="{{ asset('image/TrangChu/why choose.jpg') }}" class="w-100 position-absolute" alt="banner1" style="height: 600px; object-fit: cover; opacity:0.3;"/> --}}
            <section class="container-fluid g-2 text-center mb-2 pt-4">
              <div class=" text-center w-75 mx-auto" style="margin-top:-100px; position:relative; z-index:1;">
                <div class="row text-center mb-5">
                  <div class="col-12 col-md-4 col-lg-4">
                    <div class="shadow-sm bg-white p-3 mb-3 h-100">
                      <div>
                        <i class="fa fa-graduation-cap" aria-hidden="true" style="font-size: 45px; margin-top:10px; color:#145982"></i>
                      </div>
                      <hr />
                      <div>
                          <p style="color: #145982; font-size:22px;">Học từ chuyên gia</p>
                          <p style="color: #145982; font-size:14px;">Các khóa học được xây dựng và giảng dạy bởi những chuyên gia hàng đầu trong lĩnh vực</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-4 col-lg-4">
                    <div class="shadow-sm bg-white p-3 mb-3 h-100">
                      <div>
                        <i class="fa fa-certificate" aria-hidden="true" style="font-size: 45px; margin-top:10px; color:#145982"></i>
                      </div>
                      <hr />
                      <div>
                          <p style="color: #145982; font-size:22px;">Nhận chứng chỉ uy tín</p>
                          <p style="color: #145982; font-size:14px;">Hoàn thành khóa học và nhận chứng chỉ có giá trị, giúp bạn thăng tiến trong sự nghiệp</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-4 col-lg-4">
                    <div class="shadow-sm bg-white p-3 mb-3 h-100">
                      <div>
                        <i class="fa fa-desktop" aria-hidden="true" style="font-size: 45px; margin-top:10px; color:#145982"></i>
                    </div>
                    <hr />
                    <div>
                        <p style="color: #145982; font-size:22px;">Học mọi lúc, mọi nơi</p>
                        <p style="color: #145982; font-size:14px;">Truy cập nội dung khóa học trên mọi thiết bị với thời gian linh hoạt</p>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            {{-- <section class="container-fluid g-2 text-center mb-2 pt-4">
              <div class="row justify-content-center align-items-center g-2">
                <div class="col-12">
                  <h2 class="text-decoration-underline text--115a80" style="font-family: 'Segoe UI', Arial, sans-serif; font-weight:600!important;">
                    DỊCH VỤ CỦA CHÚNG TÔI
                  </h2>
                </div>
              </div>
            </section> --}}

            <section class="container-fluid p-0 ">
              <div class="row g-0 ps-xxl-0 pe-xxl-0 ps-xl-0 pe-xl-0 mx-auto" style="width:80%; padding:50px 0 100px 0;">
                <div class="col-12 col-lg-4 p-0">
                  <div class="row justify-content-start align-items-center g-2">
                    <div class="col-12 col-lg-10">
                      <div class="col-12 ele-reveal left" style="background-color: rgba(248, 248, 248, 0.7)">
                        <p class="text--115a80 fw-bold fst-italic" style="font-family: 'Segoe UI', Arial, sans-serif; font-size:40px">
                          DỊCH VỤ<br/> CỦA CHÚNG TÔI
                        </p>
                        <p style="text-align: justify; padding:10px 10px 20px 10px;font-family: 'Segoe UI', Arial, sans-serif; font-weight:400; font-style:italic;">Chúng tôi cam kết mang đến các khóa học công nghệ chất lượng, 
                          hỗ trợ học viên từ việc phát triển kỹ năng chuyên môn đến định hướng sự nghiệp lâu dài.</p>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="col-12 col-lg-8 p-0">
                  <div class="row g-0 ele-reveal left rectangle-img">
                    <div class="col-12 col-md-5 col-lg-6 p-0 m-1 dv-each position-relative">
                      <a href="#">
                        <img src="{{ asset('image/TrangChu/rectangleLogo1.jpg') }}" loading="lazy" class="img-fluid w-100" alt="...">
                        <div class="overlay-dvtext"><p style="font-size: 20px;">Khóa học công nghệ</p></div>
                        <div class="overlay">
                          <div class="text w-100 h-100 overlay-content px-3 py-5 d-flex align-items-center">
                            <div class="text-dark " style="font-size: 16px;font-family: 'Segoe UI', Arial, sans-serif;">Các khóa học trực tuyến chuyên sâu được giảng dạy bởi những chuyên gia hàng đầu
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                    <div class="col-12 col-md-5 col-lg-5 p-0 m-1 align-self-end dv-each position-relative">
                      <a href="#">
                        <img src="{{ asset('image/TrangChu/rectangleLogo2.jpg') }}" loading="lazy" class="img-fluid w-100 " alt="...">
                        <div class="overlay-dvtext"><p style="font-size: 20px;">Tư vấn nghề nghiệp</p></div>
                        <div class="overlay">
                          <div class="text w-100 h-100 overlay-content px-3 py-4 d-flex align-items-center">
                            <div class="text-dark" style="font-size: 16px;font-family: 'Segoe UI', Arial, sans-serif;">Hỗ trợ học viên xây dựng lộ trình sự nghiệp và kỹ năng mềm thiết yếu
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                    <div class="col-12 col-md-0 col-lg-1 p-0">
                    </div>
                    <div class="col-12 col-md-5 col-lg-5 p-0 m-1 dv-each position-relative">
                      <a href="#">
                        <img src="{{ asset('image/TrangChu/rectangleLogo3.jpg') }}" loading="lazy" class="img-fluid w-100" alt="...">
                        <div class="overlay-dvtext"><p style="font-size: 20px;">Hợp tác doanh nghiệp</p></div>
                        <div class="overlay">
                          <div class="text w-100 h-100 overlay-content px-3 py-4 d-flex align-items-center">
                            <div class="text-dark" style="font-size: 16px;font-family: 'Segoe UI', Arial, sans-serif;">Cung cấp giải pháp đào tạo nội bộ cho các công ty công nghệ hàng đầu
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                    <div class="col-12 col-md-5 col-lg-4 p-0 m-1 dv-each position-relative h-75">
                      <a href="#">
                        <img src="{{ asset('image/TrangChu/rectangleLogo4.jpg') }}" loading="lazy" class="img-fluid w-100" alt="...">
                        <div class="overlay-dvtext"><p style="font-size: 20px;">Hỗ trợ 24/7</p></div>
                        <div class="overlay">
                          <div class="text w-100 h-100 overlay-content px-3 py-4 d-flex align-items-center">
                            <div class="text-dark" style="font-size: 16px;font-family: 'Segoe UI', Arial, sans-serif;">Dịch vụ hỗ trợ nhanh chóng, sẵn sàng giải đáp mọi thắc mắc của học viên
                            </div>
                            {{-- <div style="display: flex; justify-content: flex-end;">
                              <a href="{{ route('xdsoft.thietke')}}">
                                <div class="bg-145982 text-white p-2">Xem thêm</div>
                              </a>
                            </div> --}}
                          </div>
                        </div>
                        </a>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </article>

          <article>
            <div class="ele-reveal bot container-fluid pb-5" >
              <section class=" g-2 text-start mb-2 ">
                <div class="row justify-content-center align-items-center g-2 w-100  ele-reveal left">
                  <div style="width: 85%; max-width:1400px; padding-top: 4rem;">
                    <h1 class="text--115a80 fw-bolder" style="font-family: 'Segoe UI', Arial, sans-serif; font-weight:600!important;">
                      KHÓA HỌC MỚI NHẤT
                      <hr class="text--115a80 m-0 new--title" />
                    </h5>
                  </div>
                </div>
              </section>
            <section class="container-fluid ps-3 pe-3 ps-xl-1 pe-xl-1 pt-0" style="width:85%; max-width:1400px;">
              <div class="row justify-content-center g-0 ps-0 pe-0">
                @foreach ($khoa_hoc as $item)
                      <div class="col-12 col-xl-3 col-md-6 mb-5 p-3 pt-0">
                        <div style="height:100%; max-width:265px; margin:auto">
                          <a href="{{route('khoahoc.post',['slug'=>$item->slug])}}" class="text-decoration-none">
                            <div class="card card-hover w-100 p-0 container border-0 text-start h-100">
                              <img src="{{$item->img}}" loading="lazy" class="rounded mx-auto d-block card-img-top img-fluid w-100 " alt="...">
                                  <div class="card-body mb-2">
                                      <h5 class="card-title overflow-hidden fw-bold" style="color:#145982; height:55px;">{{$item->name}}</h5>
                                      <h6 class="card-title overflow-hidden text-dark" style="height: 70px">{{$item->description}}</h6>
                                      <div class="row">
                                        <span class="col-6 text-decoration-line-through text-secondary" style="font-size:14px; padding-top:2px;">{{ number_format($item->gia_goc, 0, ',') }}đ</span>
                                        <span class="card-text fw-bold col-6 text-end" style="color: #0092ad; font-size:16px;">{{number_format($item->gia_giam, 0, ',')}}đ</span>
                                      </div>
                                  </div>
                                </div>
                              </a>
                        </div>
                      </div>
                    <br>
                @endforeach
              </div>
            </section>

            <section class="container text-center ">
              <div class="row justify-content-center align-items-center g-2">
                <div class="col-8 col-lg-3">
                  <a href="{{ route('xdsoft.khoahoc')}}" class="btn btn-outline-dark rounded-pill all--detail w-100 fw-3 btn-full-link bg-white">
                    Xem tất cả khóa học
                  </a>
                </div>
              </div>
            </section>
            </div>
          </article>

          <article style="margin-bottom: 30px;  background-image: url({{url('/image/Singapur_vector_0003_b.jpg')}});
          background-color: #e8e8e8; background-blend-mode: multiply;
          background-size: cover; margin:auto;" >
            <div class="container ele-reveal left">

              <section class="container g-2 text-center mb-0 mt-4">
                <div class="row justify-content-center align-items-center g-2">
                  <div class="col-4 pt-4" style="font-family: 'Segoe UI', Arial, sans-serif; font-weight:600!important;">
                    <h1 class="text--115a80">HỌC VIÊN ĐÁNH GIÁ </h2>
                    <h1 class="text-decoration-underline text--115a80">VỀ TECHWAVE</h1>
                  </div>
                </div>
              </section>
              <nav id="carouselComment" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner pb-5" style="width: 85%; margin:auto; padding-top:80px;">
                  <div class="carousel-item position-relative active" data-bs-interval="15000">
                    <div class="position-relative border border-primary" style="border-radius:10px;">
                      <img src="{{ asset('image/quote_frame.jpg')}}" loading="lazy" class="w-100 d-block" alt="banner1" style="height: 250px; object-fit: cover; opacity:0.8; border-radius:10px;"/>
                      <div class="carousel-caption d-md-block text-dark" style="font-family:Arial, Helvetica, sans-serif; width:75%; position: absolute; top: 45%; left: 55%; transform: translate(-50%, -50%);">
                        <p style="text-align: justify; overflow:hidden; text-overflow:ellipsis; font-style:italic; font-size:20px;">"Các khóa học trên nền tảng rất chất lượng, dễ hiểu và hữu ích. 
                          Mình luôn nhận được sự hỗ trợ nhiệt tình từ đội ngũ hỗ trợ khi có thắc mắc. Việc học trực tuyến chưa bao giờ tiện lợi và hiệu quả như vậy!"
                        </p>
                        <br/>
                        <p style="text-align: right;margin-bottom: 0; font-weight:bolder;">Bạn Kim Long</p>
                        <p class="d-none d-md-block mb-0" style="text-align: right;">quận Ba Đình, Hà Nội</p>
                      </div>
                    </div>
                    <div class="position-absolute" style="top: -70px; left: 20px; z-index:99">
                      <img src="{{ asset('image/TrangChu/nhan_xet/nhanxet-hocvien.png')}}" loading="lazy"
                        class="rounded-circle shadow-2" alt="Pic-2" style="width:140px; height:140px; object-fit:cover;">
                    </div>
                  </div>
                </div>
                
              </nav>
          </div>
          </article>
          <article>
            <section class=" g-2 text-start mb-2 ">
              <div class="row justify-content-center align-items-center g-2 w-100  ele-reveal left">
                <div style="width: 85%; max-width:1400px; padding-top: 4rem;">
                  <h1 class="text--115a80 fw-bolder" style="font-family: 'Segoe UI', Arial, sans-serif; font-weight:600!important;">
                    BÀI VIẾT MỚI NHẤT
                    <hr class="text--115a80 m-0 new--title" />
                  </h5>
                </div>
              </div>
            </section>
            @if ($post && count($post) >4)
            <section class="w-100 g-2 mb-2 row justify-content-center">
                <div class="category-item " style="width:85%; max-width:1400px;">
                    <section class="category_tin_tuc ele-reveal left">
                        <div class="arti-left col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 p-0">
                          <div class=" pt-3">
                            <div class="me-3">
                              <a href="{{route('tintuc.post',['slug'=>$post[0]->slug])}}">
                                <div class="position-relative text-start">
                                  <img class="text-dark" loading="lazy" style="width: 100%;height: 400px;border-radius:10px; object-fit: cover;" src="{{$post[0]->post_image}}" alt="{{$post[0]->post_title}}" />
                                  <div class="overlay-shadow"></div>
                                  <div class="position-absolute px-5 w-100" style="top: 90%;
                                  transform: translate(0, -50%); z-index:2">
                                  <p style="font-size: 20px; color:rgb(0, 170, 255); font-weight:600; margin-bottom:0;">{{date("d/m/Y", strtotime($post[0]->post_date))}}</p>
                                  <p style="font-size: 20px; color:white; font-weight:600; overflow:hidden;  white-space: nowrap; text-overflow: ellipsis;">{{$post[0]->post_title}}</p>
                                  </div>  
                                </div>
                              </a>
                            </div>
                          </div>
                        </div>

                        <div class="arti-right col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 ps-5">
                      
                          @for($i=1;$i<=3;$i++) <ul class="list-topic">
                            <li class="itemtopic pb-3 pt-3">
                              <div class="d-flex">
                                <div class="me-3">
                                  <a href="{{route('tintuc.post',['slug'=>$post[$i]->slug])}}"><img class="text-dark" loading="lazy"
                                      style="width: 150px;height: 110px;object-fit: cover;" src="{{$post[$i]->post_image}}" alt="{{$post[$i]->post_title}}" /></a>
                                </div>
                                <div class="col-9 pb-2">
                                  <a href="{{route('tintuc.post',['slug'=>$post[$i]->slug])}}" class="text-dark" style="font-size: 20px;">
                                    {{$post[$i]->post_title}}
                                  </a>
                                  <p style="font-size: 12px; color:rgb(0, 170, 255); margin-bottom:0;"> {{date("d/m/Y", strtotime($post[0]->post_date))}}</p>
                                  <p style="font-size: 12px; overflow:hidden">{{$post[$i]->description}}</p>
                                </div>
                              </div>
                            </li>
                            </ul>
                            @endfor
                        </div>
                    </section>
                </div>
            </section>
            @endif
          </article>

        </aside>
      </div>
    </div>
  </div>
</main>
@endsection
