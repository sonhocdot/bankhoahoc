<!doctype html>
<html lang="en">

<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('image/logo code_fun.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('image/logo code_fun.png') }}" type="image/x-icon">
    <!-- ============= Title  ============= -->
    <title>CodeFun</title>
    <meta charset="utf-8">
    <meta http-equiv="content-style-type" content="text/css">
    <meta http-equiv="content-language" content="en-vi">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;600&display=swap" rel="stylesheet">
    @include('client.layoutx.lib.css_owl_carousel')
    <meta name="copyright" content="Copyright © 2021 SPEC LEARNING">
    <link rel="stylesheet" href="{{ asset('client/css/homepage.css') }}">
    <script src="https://kit.fontawesome.com/9ee42ba343.js" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
    @include('client.layoutx.lib.css_bs5')
    @include('client.layoutx.lib.jquery')
    @include('client.layoutx.lib.js_owl_carousel')
    @yield('css')

</head>

<body>
    <div id="body">
        @include('client.base.xdsoft.header')
        @yield('content')
        @include('client.base.xdsoft.modal')
        @include('client.base.xdsoft.block_wiget')
        @include('client.base.xdsoft.footer')
    </div>

    <script>
        $(document).ready(function() {
            //for testimonial
            var owl = $('.owl-testmonial');
            owl.owlCarousel({
                items: 1,
                loop: true,
                nav: true,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 2500,
                autoplayHoverPause: true
            });
            $('.owl-services').owlCarousel({
                items: 3,
                lazyLoad: false,
                loop: true,
                margin: 2,
                dots: false,
                nav: false,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                responsive: {
                    300: {
                        items: 1,
                    },
                    900: {
                        items: 2,
                    },
                    1100: {
                        items: 3,
                    },
                },
            });
            $('.owl-carousel').owlCarousel({
                lazyLoad: true,
                lazyLoadEager: 4
            });
            const thumbSlide = $("#thumb_carousel")
                .on("initialize.owl.carousel", function(event) {
                    $("#owl-nav-unloaded").remove();
                })
                .owlCarousel({
                    margin: 5,
                    dots: false,
                    nav: false,
                    loop: false,
                    autoplay: false,
                    lazyLoad: false,
                    responsive: {
                        300: {
                            items: 3,
                        },
                        900: {
                            items: 4,
                        },
                        1100: {
                            items: 5,
                        },
                        1900: {
                            items: 6,
                        },
                    },
                });
            $(".itemthumb").click(function() {
                const offsetSlide = $(this).data("id");
                mainSlide.trigger("to.owl.carousel", [+offsetSlide]);
            });
        });
    </script>
    <script>
        function checkScroll() {
            var startY = $('.navbar').height() * 0.5; //The point where the navbar changes in px

            if ($(window).scrollTop() > startY) {
                $('.navbar').addClass("scrolled");
            } else {
                $('.navbar').removeClass("scrolled");
            }
        }

        if ($('.navbar').length > 0) {
            $(window).on("scroll load resize", function() {
                checkScroll();
            });
        }
    </script>
    <script>
        function ele_reveal() {
            var reveals = document.querySelectorAll(".ele-reveal");

            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                var elementVisible = 100;

                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("ele-active");
                } else {
                    reveals[i].classList.remove("ele-active");
                }
            }
        }

        window.addEventListener("scroll", ele_reveal);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    {{-- @include("client.layout.lib.js_bs5") --}}
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="{{ asset('js/header.js') }}"></script>

</body>

</html>
