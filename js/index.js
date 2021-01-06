$(document).ready(function () {
    initScrollAnimations();
    scrollAnimation();
    readScroll();
});

function scrollAnimation() {
    $(document).on('click', 'a[href^="#"]', function (event) {
        event.preventDefault();

        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top - 150
        }, 500);
    });
}

function readScroll() {
    $(window).scroll(function () {
        if ($(document).scrollTop() > 200) {
            $('nav').addClass('navChanged').removeClass('navInactive');
        } else {
            $('nav').removeClass('navChanged').addClass('navInactive');
        }
    });
}

function initScrollAnimations() {
    AOS.init();
}