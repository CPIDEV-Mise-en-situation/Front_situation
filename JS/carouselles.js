document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.carousel-container .swiper', {
        loop: true,
        slidesPerView: 1,
        centeredSlides: true,
        spaceBetween: 10,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.carousel-container .swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 5000,
        },
    });

    new Swiper('.partners-swiper', {
        loop: true,
        slidesPerView: 3,
        spaceBetween: 10,
        autoplay: {
            delay: 2000,
        },
        pagination: {
            el: '.partners-swiper .swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 4,
            },
            1024: {
                slidesPerView: 5,
            },
        },
    });
});