
$(function () {
    window.onscroll = function() {myFunction()};
    myFunction()
})
function myFunction() {
    let x = $("#heightcol").height()
    let header = document.getElementById("c-course-detail");
    if (window.pageYOffset > 500) {
        header.classList.add("fixed");
    } else {
        header.classList.remove("fixed");
    }
    if (window.pageYOffset > (x-200)) {
        header.classList.remove("fixed");
    }
}