<div id="slider" class="owl-carousel owl-theme">
    <div class="item">
        <img src="imgs/slider/slider_1.jpg" alt="">
    </div>
    <div class="item">
        <img src="imgs/slider/slider_2.jpg" alt="">
    </div>
    <div class="item">
        <img src="imgs/slider/slider_3.jpg" alt="">
    </div>
    <div class="item">
        <img src="imgs/slider/slider_4.jpg" alt="">
    </div>
    <div class="item">
        <img src="imgs/slider/slider_5.jpg" alt="">
    </div>
    <div class="item">
        <img src="imgs/slider/slider_6.jpg" alt="">
    </div>
</div>


<script>
    jQuery(document).ready(function($) {
        $('.owl-carousel').owlCarousel({
            center: false,
            items: 1,
            loop: true,
            stagePadding: 0,
            margin: 0,
            autoplay: true,
            dots: false,
            nav: false,
            navText: ['<span class="icon-arrow_back">', '<span class="icon-arrow_forward">'],
        })
    })
</script>