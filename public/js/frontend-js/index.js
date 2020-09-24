// let owl = $('.full-width-owl-carousel').owlCarousel({
//     autoplay: true,
//     items:1,
//     loop:true,
//     center:true,
//     margin:10,

//     autoplayHoverPause:true,
//     // startPosition: 'URLHash',
//     dots:true,
//     dotsData:true,
// });

// $('.owl-dot').click(function() {
//         owl.trigger('to.full-width-owl-carousel', [$(this).index(), 1000]);
//     })

(function( $ ) {

    //Function to animate slider captions
    function doAnimations( elems ) {
        //Cache the animationend event in a variable
        var animEndEv = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

        elems.each(function () {
            var $this = $(this),
                $animationType = $this.data('animation');
            $this.addClass($animationType).one(animEndEv, function () {
                $this.removeClass($animationType);
            });
        });
    }

    //Variables on page load
    var $myCarousel = $('.main-slider'),
        $firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");

    //Initialize carousel
    $myCarousel.carousel({
			interval: 6000
		});

    //Animate captions in first slide on page load
    doAnimations($firstAnimatingElems);

    //Pause carousel
    //$myCarousel.carousel('pause');


    //Other slides to be animated on carousel slide event
    $myCarousel.on('slide.bs.carousel', function (e) {
        var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
        doAnimations($animatingElems);
    });

})(jQuery);

$(document).ready(function(){
    let owl = $(".full-width-owl-carousel").owlCarousel({
        
        autoplay: true,
        autoplayTimeout: 3000,
        dots: true,
        dotsData:true,
        loop: true,
        margin: 30,
        nav: false,
        center: false,
        items: 1
    });

    $('.owl-dot').click(function() {
        owl.trigger('to.owl.carousel', [$(this).index(), 1000]);
    })


$('.insta-owl-carousel').owlCarousel({
    stagePadding: 50,
    autoplay: true,
    loop:true,
    margin:10,
    nav:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:3
        }
    }
})
});
