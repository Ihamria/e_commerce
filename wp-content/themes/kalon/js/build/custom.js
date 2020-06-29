jQuery(document).ready(function($){
    
    /** Variables from Customizer for Slider settings */
    var slider_auto, slider_loop, slider_control, slider_animation, rtl, mrtl;
    
    if( kalon_data.auto == '1' ){
        slider_auto = true;
    }else{
        slider_auto = false;
    }
    
    if( kalon_data.loop == '1' ){
        slider_loop = true;
    }else{
        slider_loop = false;
    }
    
    if( kalon_data.control == '1' ){
        slider_control = true;
    }else{
        slider_control = false;
    }

    if( kalon_data.mode == 'slide' ){
        slider_animation = '';
    }else{
        slider_animation = 'fadeOut';
    }

    if( kalon_data.rtl == '1' ){
        rtl = true;
        mrtl = false;
    }else{
        rtl = false;
        mrtl = true;
    }

    /** Home Page Slider */
    $("#lightSlider").owlCarousel({
        items           : 1,
        margin          : 0,
        loop            : slider_loop,
        autoplay        : slider_auto,
        nav             : false,
        dots            : slider_control,
        animateOut      : slider_animation,
        lazyLoad        : true,
        mouseDrag       : false,
        rtl             : rtl,
        autoplaySpeed   : kalon_data.speed,
    });

    //mobile-menu
    $('.btn-menu-opener').click(function(){
        $('body').addClass('menu-open');

        $('.btn-close-menu').click(function(){
            $('body').removeClass('menu-open');
        });
    });
    
    $('.overlay').click(function(){
        $('body').removeClass('menu-open');
    });

    $('.mobile-menu').prepend('<div class="btn-close-menu"></div>');

    $('.mobile-main-navigation ul .menu-item-has-children').append('<div class="angle-down"></div>');

    $('.mobile-main-navigation ul li .angle-down').click(function(){
        $(this).prev().slideToggle();
        $(this).toggleClass('active');
    });

    //accessible menu in IE
    $("#site-navigation ul li a").focus(function(){
        $(this).parents("li").addClass("focus");
    }).blur(function(){
        $(this).parents("li").removeClass("focus");
   });        
});
