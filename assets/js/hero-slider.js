jQuery(document).ready(function($) {
    $('.heroslider').each(function(index, el) {
        var heroSliderDisplay = $(el).data('display');
        var heroSlider = new Swiper($('.swiper-container', el), {
            loop: true,
            autoplay: 6666,
            autoHeight: true,
            pagination: '.swiper-pagination',
            paginationClickable: true,
            effect: ('gallery' === heroSliderDisplay) ? 'fade' : 'slide'
        });
    });
});