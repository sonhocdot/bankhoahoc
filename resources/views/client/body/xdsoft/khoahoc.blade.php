@extends('client.body.xdsoft.khoahoc.layout_khoa_hoc')



@section('content-right')
<style>
  .form-control, .form-control:hover { background-color: #fff!important; color: black!important;}

</style>

<link rel="stylesheet" href="{{ asset('css/card.css') }}">


<main class=" pe-0 ps-0 mb-5">
  <div class="entry-content">
    <p><strong class="bold">CodeFun</strong> - Đỉnh cao lập trình, kiến tạo tương lai số của bạn.</p>
    <h4><strong>Những Gì Chúng Tôi Cung Cấp:</strong></h4>
    <ol>
      <li><p><strong>Đa dạng và Chuyên sâu: </strong>Chúng tôi cung cấp hàng trăm khóa học lập trình từ cơ bản đến nâng cao, bao phủ các ngôn ngữ và công nghệ hot nhất hiện nay như Python, JavaScript, Java, C++, Khoa học Dữ liệu, Trí tuệ Nhân tạo và Phát triển Web/Mobile. Phù hợp cho mọi đối tượng, từ người mới bắt đầu đến lập trình viên muốn nâng cấp kỹ năng.</p></li>
      <li><p><strong>Giảng viên Thực chiến: </strong>Các khóa học được biên soạn và giảng dạy bởi những lập trình viên, kiến trúc sư phần mềm và chuyên gia công nghệ hàng đầu, có kinh nghiệm làm việc thực tế tại các công ty lớn. Bạn sẽ học được những kiến thức chuyên sâu và kinh nghiệm xử lý dự án thực tế.</p></li>
      <li><p><strong>Tương tác Cao & Hỗ trợ Liên tục:</strong> Chúng tôi xây dựng môi trường học tập tương tác với các buổi live code, workshop thực hành, diễn đàn hỏi đáp 24/7 và hệ thống hỗ trợ cá nhân. Giảng viên và đội ngũ trợ giảng luôn sẵn sàng giải đáp mọi vướng mắc, giúp bạn tiến bộ nhanh chóng.</p></li>
      <li><p><strong>Giá trị Thực tiễn & Cơ hội Nghề nghiệp: </strong>Hoàn thành khóa học, bạn sẽ sở hữu những kỹ năng lập trình vững chắc, có khả năng xây dựng các dự án thực tế và tự tin ứng tuyển vào các vị trí mong muốn. CodeFun còn hỗ trợ bạn định hướng phát triển sự nghiệp và kết nối với mạng lưới các nhà tuyển dụng hàng đầu trong ngành công nghệ thông tin.</p></li>
    </ol>
  </div>
  @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @elseif(session('fail'))
        <div class="alert alert-danger" role="alert">
            {{ session('fail') }}
        </div>
    @endif
  <div class="row justify-content-center align-items-center g-2">
    <div class="col-11 p-0">
      <div class="container pt-5 pb-2 text-center border--bottom--203864 w-350px border--bottom--203864 p-0 pb-2">
        <a href="#" class="h3 text--115a80 text-decoration-none main--title--text">DANH SÁCH KHÓA HỌC</a>
      </div>

      <section class="container ps-5 pe-5 ps-xl-1 pe-xl-1 pt-0 mt-4">
        <form action="{{ route('xdsoft.khoahoc') }}" method="GET" class="mb-4">
          <div class="row">
              <!-- Keyword Search -->
              <div class="col-md-4 mb-1">
                <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm khóa học" value="{{ request('keyword') }}">
              </div>

              <!-- Course Category Filter -->
              <div class="col-md-3 mb-1">
                  <select name="course_category" class="form-control">
                      <option value="">Tất cả danh mục</option>
                      @foreach ($ds_category as $category)
                          <option value="{{ $category->slug }}" {{ request('course_category') == $category->slug ? 'selected' : '' }}>
                              {{ $category->name }}
                          </option>
                      @endforeach
                  </select>
              </div>
  
              <!-- Sort By Filter -->
              <div class="col-md-3 mb-1">
                  <select name="sort_by" class="form-control">
                      <option value="">Sắp xếp</option>
                      <option value="newest" {{ request('sort_by') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                      <option value="most_watch" {{ request('sort_by') == 'most_watch' ? 'selected' : '' }}>Xem nhiều nhất</option>
                  </select>
              </div>
              <div class="col-md-2 mb-1">
                <button type="submit" class="btn btn-success">Tìm kiếm</button>
            </div>
          </div>
          {{-- <div class="row mt-3">
            <div class="col-md-12">
              <button type="submit" class="btn btn-primary">Lọc khóa học</button>
            </div>
          </div> --}}
      </form>
        <div class="row justify-content-center g-0 ps-0 pe-0">
          <p class="text-center fw-bold fs-3">Khóa học miễn phí</p>
          @if($freeCourses)
          <div class="free-courses-carousel owl-carousel">
            @foreach ($freeCourses as $item)
            <div class="item p-3" title="{{ $item->name }} - {{ $item->description }} (Ngày tạo: {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }})">
                <a href="{{route('khoahoc.post',['slug'=>$item->slug])}}" class="text-decoration-none">
                    <div class="card card-hover border-0 text-start">
                        <img src="{{$item->img}}" class="card-img-top img-fluid w-100" alt="...">
                        <div class="card-body">
                          <div class="favorite-icon-container position-absolute top-0 end-0 p-2">
                            @php
                                $isFavorite = DB::table('favorite_courses')
                                    ->where('id_user', session('account_id'))
                                    ->where('id_course', $item->id)
                                    ->exists();
                            @endphp
                            <i 
                                class="fa fa-heart favorite-icon" 
                                data-course-id="{{ $item->id }}" 
                                style="font-size: 2rem; color: {{ $isFavorite ? '#fe5f75' : '#adacad' }}; cursor: pointer;"
                            ></i>
                          </div>
                            <h5 class="card-title text-dark fw-bolder">{{$item->name}}</h5>
                            <div class="star-rating mb-2" data-rating="{{ $item->average_rate ?? 0 }}"></div>
                            <div class="text-muted">
                                <div class="d-inline-block">
                                    <i class="fa fa-fw fa-book"></i>
                                    <strong>{{$item->lesson_count}}</strong> bài học
                                </div>
                                @if($item->view_count > 0)
                                <div class="d-inline-block">
                                    <i class="fa fa-eye"></i>
                                    <strong>{{number_format($item->view_count, 0, ',')}}</strong> lượt xem
                                </div>
                                @endif
                            </div>
                            <div class="text-muted">
                                Tác giả: 
                                <strong>{{ $item->author_course->display_name ?? 'CodeFun' }}</strong>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        
          @else
            <div class="text-center py-3">
              <h3 class="text-muted fst-italic">Đang cập nhật danh sách khóa học phù hợp...</h3>
            </div>
          @endif
          <p class="text-center fw-bold fs-3">Khóa học trả phí</p>
          @if($paidCourses)
          <div class="paid-courses-carousel owl-carousel">
            @foreach ($paidCourses as $item)
            <div class="item p-3" title="{{ $item->name }} - {{ $item->description }} (Ngày tạo: {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }})">
                <a href="{{ route('khoahoc.post', ['slug' => $item->slug]) }}" class="text-decoration-none">
                    <div class="card card-hover border-0 text-start">
                        <img src="{{ $item->img }}" class="card-img-top img-fluid w-100 rounded" alt="...">
                        <div class="card-body">
                          <div class="favorite-icon-container position-absolute top-0 end-0 p-2">
                            @php
                                $isFavorite = DB::table('favorite_courses')
                                    ->where('id_user', session('account_id'))
                                    ->where('id_course', $item->id)
                                    ->exists();
                                    
                            @endphp
       
                            <i 
                                class="fa fa-heart favorite-icon" 
                                data-course-id="{{ $item->id }}" 
                                style="font-size: 2rem; color: {{ $isFavorite ? '#fe5f75' : '#adacad' }}; cursor: pointer;"
                            ></i>
                          </div>
                            <h5 class="card-title overflow-hidden text-dark fw-bolder">{{ $item->name }}</h5>
                            <div class="star-rating mb-2" data-rating="{{ $item->average_rate ?? 0 }}"></div>
                            <div class="text-muted">
                                <div class="d-inline-block">
                                    <i class="fa fa-fw fa-book"></i>
                                    <strong>{{ $item->lesson_count }}</strong> bài học
                                </div>
                                @if($item->view_count > 0)
                                <div class="d-inline-block">
                                    <i class="fa fa-eye"></i>
                                    <strong>{{ number_format($item->view_count, 0, ',') }}</strong> lượt xem
                                </div>
                                @endif
                            </div>
                            <div class="text-muted mt-3">
                                Tác giả/Dịch giả: 
                                <strong>{{ $item->author_course->display_name ?? 'CodeFun' }}</strong>
                            </div>
                            <div class="row">
                              <span class="col-6 text-decoration-line-through text-secondary" style="font-size:14px; padding-top:2px;">{{ number_format($item->gia_goc, 0, ',') }}đ</span>
                              <span class="card-text fw-bold col-6 text-end" style="color: #0092ad; font-size:16px;">{{number_format($item->gia_giam, 0, ',')}}đ</span>
                            </div>
                            <div class="mt-3">
                                @if ($item->bought)
                                <button class="btn btn-success w-100" style="border-radius: 10px;">Đã mua</button>
                                @else
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('add_to_cart_now', ['id' => $item->id]) }}" class="btn btn-sm btn-white" 
                                       style="border: 1px solid rgba(0,0,0,0.3); border-radius: 10px; width: 48%;">Mua ngay</a>
                                    <a href="{{ route('add_to_cart', ['id' => $item->id]) }}" class="btn btn-sm btn-success" 
                                       style="border-radius: 10px; width: 48%;">Thêm vào giỏ hàng</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        
          @else
            <div class="text-center py-3">
              <h3 class="text-muted fst-italic">Đang cập nhật danh sách khóa học phù hợp...</h3>
            </div>
          @endif
        </div>
      </section>
    </div>
  </div>
</main>

<script>
  $('.free-courses-carousel').owlCarousel({
    loop: false,
    nav: true,
    responsive: {
        0: { items: 1 },
        768: { items: 2 },
        1200: { items: 3 }
    }
  });

  $('.paid-courses-carousel').owlCarousel({
      loop: false,
      nav: true,
      responsive: {
          0: { items: 1 },
          768: { items: 2 },
          1200: { items: 3 }
      }
  });
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.favorite-icon').forEach(icon => {
        icon.addEventListener('click', function (event) {
            event.preventDefault(); // Ngăn chuyển trang
            const courseId = this.getAttribute('data-course-id');

            fetch('/courses/favorite', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ course_id: courseId }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.style.color = data.is_favorite ? '#fe5f75' : '#adacad';
                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    alert('Đã xảy ra lỗi, vui lòng thử lại sau!');
                });
        });
    });
});



</script>
@endsection

