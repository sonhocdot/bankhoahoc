setInterval(() => {
    if (window.innerWidth < 992) {
        $(".head-navbar").removeClass("border-start-2");
        $(".head-navbar").addClass("border-start-0");
        $(".nav-item").removeClass("me-3");
        $(".banner1").addClass("d-none");
        $(".banner2").removeClass("d-none");
        if (window.innerWidth < 576) {
            $(".carousel-caption").removeClass("d-md-block");
            $(".banner2").removeClass("d-none");
            $(".banner1").addClass("d-none");
        }
        // else{
        //     $(".carousel-caption").addClass("d-md-block");
        //     $(".banner2").removeClass("d-none");
        //     $(".banner1").addClass("d-none");
        // }
    }
    else {
        $(".nav-item").addClass("me-4");
        if (window.innerWidth < 1200) {
            $(".carousel-caption").addClass("d-md-block");
        }
        else{

            $(".carousel-caption").addClass("d-md-block");
        }
        $(".banner2").addClass("d-none");
        $(".banner1").removeClass("d-none");
        $(".head-navbar").removeClass("border-start-0");
        $(".head-navbar").addClass("border-start-2");
    }
    $(".banner2").css("height", window.innerHeight);

}, 1000);
