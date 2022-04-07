$(window).load(function () {

    var rnd = 1500;

    $('.progress').css("animation", "loading " + rnd + "ms linear");

    setTimeout(function () {

        $('#loader').hide();
        $('#page').removeClass('hidden');

    }, rnd);

});


var swiper3 = new Swiper(".mySwiper3", {
    
    spaceBetween: 20,
    breakpoints: {
        320:{slidesPerView: 3,},
        640:{
            slidesPerView: 6,
        }
    }
});


var swiper = new Swiper(".mySwiper", {});
