@extends('client.layoutx.xdsoft.app')


@section('css')
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/footer.css') }}">
<style>
  .sidebar {
    margin: 0;
    padding: 0;
    /* z-index: -1; */
    width: 200px;
    background-color: #f1f1f1;
    position: fixed;
    overflow: auto;
    flex-direction: column;
  }

  .sidebar a {
    font-size: 13px;
    font-weight: 600;
    display: block;
    color: black;
    padding: 16px;
    text-decoration: none;
  }

  .sidebar a.active:hover {
    color: white !important;
  }

  .sidebar a:hover:not(.active) {
    background-color: #f1f1f1;
  }

  div.content {
    margin-left: 200px;
    padding: 1px 16px;
    /* height: 1000px; */
  }

  @media screen and (max-width: 990px) {
    .sidebar {
      width: 100%;
      height: auto;
      position: relative;
      flex-direction: row;
    }

    .sidebar a {
      float: left;
    }

    div.content {
      margin-left: 0;
    }
    
  }
  @media screen and (max-width: 400px) {
    .sidebar a {
      text-align: center;
      float: none;
    }
    .sidebar .text-ellipsis {
      max-width: 300px;
    }
  }

  .star-rating {
    font-size: 20px;
    color: gold; /* Màu ngôi sao golden */
  }

  .star-rating > span {
    color: #ccc; /* Màu chữ như text-muted */
    display: inline-block;
    position: relative;
    width: 1.1em;
  }

 
  .star-rating > span:hover:before,
  .star-rating > span:hover ~ span:before {
    color: gold; /* Màu ngôi sao golden khi di chuột qua */
  }

  .stars {
        display: inline-flex;
        cursor: pointer;
    }

    .star {
        font-size: 2rem;
        color: gray;
        transition: color 0.2s;
    }

    .star.selected,
    .star.hovered {
        color: gold;
    }

    .tab-container {
        display: flex;
        margin: 20px;
    }

    .tab {
        cursor: pointer;
        /* margin-right: 20px; */
    }

    .tab img {
        max-width: 100px;
        height: auto;
        border: 1px solid #ccc;
    }

    .video-container {
        margin: 20px;
    }

    .iframe-wrapper {
        /* max-width: 800px; */
        width: 100%;
    }

    .iframe-container {
        position: relative;
        padding-top: 56.25%;
        /* Tỉ lệ 16:9 */
    }

    .iframe-container iframe {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }

    .comment-box {
        margin-bottom: 15px;
    }

    .user-info {
        display: flex;
    }

    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .comment-content {
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-left: 50px;
        padding: 10px 0 0 10px;
    }
    .comment-content p {
        font-size: 12px;
    }
</style>
@endsection
@section('content')
<div class="row m-auto">
  <div class="d-flex flex-shrink-0 p-3 text-dark bg-white sidebar">
      @if(session('account_name'))
      <a class="active bg-success text-white" href="#home">
        <div class="overflow-hidden text-ellipsis">
          <i class="fa fa-user-circle-o" aria-hidden="true"></i>
          {{session('account_name')}}
        </div>
      </a>
      @else
      <a class="active bg-success text-white" href="{{ route('xdsoft.account.login')}}">
        <div class="overflow-hidden text-ellipsis fs-4">
          <i class="fa fa-user-circle-o" aria-hidden="true"></i>
          Đăng nhập
        </div>
      </a>
      @endif
      <a href="{{ route('xdsoft.account.profile')}}"><i class="fa fa-bookmark-o" aria-hidden="true"></i>
        Khóa học đã mua</a>
      {{-- <a href="#"><i class="fa fa-question-circle-o" aria-hidden="true"></i>
        Hỏi đáp</a> --}}
  </div>
  <div class="content container mb-4 nav-top col-lg-10 px-5 col-md-12">
    <div class="  mt-4">
      @yield('content-right')
    </div>
  </div>
  <script>
    const ratingDivs = document.querySelectorAll('.star-rating');
  
      ratingDivs.forEach(ratingDiv => {
    const rating = parseFloat(ratingDiv.dataset.rating);
    ratingDiv.innerHTML = generateStars(rating) + '<span style="width:40px;">(' + rating.toFixed(1) + ')</span>';
  });
  
  function generateStars(rating) {
    let stars = '';
    for (let i = 1; i <= 5; i++) {
      if (i <= rating) {
        stars += '&#9733;'; // Ký hiệu sao đầy đủ
      } else {
        stars += '&#9734;'; // Ký hiệu sao trống
      }
    }
    return stars;
  }
  </script>
</div>


@endsection