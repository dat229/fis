$(document).ready(function(){
    $('.featured-works-slider').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        autoplaySpeed: 1000,
        speed: 1000, 
        responsive:[
            {
                breakpoint: 480,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 1,
                }
            },
        ]
    });
    $('.info-image').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        dots: true,
        autoplaySpeed: 1000,
        speed: 1000,
    });
    $('.partner-slider').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        autoplaySpeed: 1000,
        speed: 500,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 1,
                  infinite: true,
                }
            },
            {
                breakpoint: 480,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 1,
                  infinite: true,
                }
            },
        ]
    });
    $('.btn-menu').click(function(){
        $('.menu').toggleClass("active-menu")
        $('.over-lay-mobie').toggleClass("active-overlay")
    })
    $('.over-lay-mobie').click(function(){
        $('.menu').toggleClass("active-menu")
        $('.over-lay-mobie').toggleClass("active-overlay")
    })
    $('.close').click(function(){
        $('.menu').toggleClass("active-menu")
        $('.over-lay-mobie').toggleClass("active-overlay")
    })
    $('.btn-show-info').click(function(){
        $('.pockup-info').fadeIn()
        $('.overlay').fadeIn()
    })
    $('.overlay').click(function(){
        $('.pockup-info').fadeOut()
        $('.overlay').fadeOut()
    })
});
$(document).ready(function () {
    var accToggles = document.getElementsByClassName('tabs-child');
    var tabClick = function(el){
        var targetParent = el.target.closest('.tabs-child');
        Array.prototype.forEach.call(accToggles, function(tog){
            var tabParent = tog.closest('.tabs-child');
            if (tabParent != targetParent){
                tabParent.classList.remove('showw');
            } else {
                targetParent.classList.toggle('showw');
            }
        });
    };
    Array.prototype.forEach.call(accToggles, function(tog, index) {
        tog.addEventListener('click', tabClick, false);
    });

    // tabcontent = document.getElementsByClassName("tabs-content");
    //
    // for (i = 0; i < tabcontent.length; i++) {
    //     console.log(tabcontent[i]);
    //     tabcontent[i].style.display = "none";
    // }
    // document.getElementById("defaultOpen").click();

});

function  openCityOne(){
    tabcontent = document.getElementsByClassName("tabs-content");

    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    document.getElementById("defaultOpen").click();
}

function openCity(evt, tabsName) {
    console.log(evt.currentTarget);
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabs-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tabs-link");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabsName).style.display = "block";
    evt.currentTarget.className += " active";
}

(function () {
    var $window = $(window),
        $document = $(document);

    var defaultTheme = {
        isElementInViewport: function (el) {
            if (typeof jQuery === "function" && el instanceof jQuery) {
                el = el[0];
            }
            var rect = el.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.top <= (window.innerHeight || document.documentElement.clientHeight)
            );
        },
        stickyNav: function () {}
    }

    window.defaultTheme = defaultTheme;
    var numbCount = function (el) {
        var html = el.innerHTML.trim();
        var to = parseInt(html, 10);
        var inc = 120;
        if (to > 20) inc = 60;
        if (to > 60) inc = 40;
        if (to > 120) inc = 10;
        if (to > 320) inc = 5;
        if (to > 1220) inc = 3;
        if (to > 5000) inc = 1;
        if (!isNaN(to)) {
            var time = 10;
            for (var i = 1; i <= to; i++) {
                time += inc;
                (function (time, i, el) {
                    setTimeout(function () {
                        el.innerHTML = i;
                    }, time)
                })(time, i, el)
            }
        }
    }
    $.fn.isOnScreen = function () {
        var win = $window;

        var viewport = {
            top: win.scrollTop(),
            left: win.scrollLeft()
        };
        viewport.right = viewport.left + win.width();
        viewport.bottom = viewport.top + win.height();

        var bounds = this.offset();
        bounds.right = bounds.left + this.outerWidth();
        bounds.bottom = bounds.top + this.outerHeight();

        return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
    };
    $window.on('load resize scroll', function () {
        setTimeout(function () {
            $('[data-counter]').each(function () {
                if ($(this).isOnScreen()) {
                    $(this).css({'visibility': 'visible'});
                    $(this).removeClass('js-start-from-zero');
                    if (!this.__activated) {

                        this.__activated = true;
                        numbCount(this);
                    }
                }
            });
        }, 10);

        $(".menu").css('maxHeight', ($window.height() - $(".navigation").outerHeight()))
    });
})();
$(document).ready(function(){
    $(window).scroll(function(event){
        var body = $('html,body').scrollTop();
        if(body > 80){
            $('.section-menu-1').addClass('fixed');
        }
        else {
            $('.section-menu-1').removeClass('fixed');
        }
    })
})
  
