/**
 * Created by alexeivolodin on 01.11.16.
 */
$(document).ready(function() {
    var slider= $('.slider');
    slider.show();
    slider.slick({
        autoplay:true,
        autoplaySpeed:3000,
        arrows:false,
        pauseOnHover:false,
        dots:true,
        pauseOnDotsHover:true,
        responsive: [
            {
                breakpoint: 900,
                settings: {

                    dots: false
                }
            }

        ]
    });
    

});