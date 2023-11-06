(function($) {
    window.onload = function() {
        $(document).ready(function() {
            stuckHeader();
            backToTop();
            animateAOS();
            showLanguage();
            sliderPage();
            showPopUpCircle();
            countUpNumber();
            showContentField();
            checkVideo();
            sliderStory();
            sliderSolution();
            showSolution();
            showActiveNavPage();
            showContentGov();
            controlVideo();
            govCompanion();
            customFormInput();
            checkItemWhyUs();
            showContentErp();
            resizeSliderTab();
            handleFormSearch();
            dynamicPopUp();
            scrollDown();
            dynamicBanner();
            timeLineHistory();
            showProgress();
            handleVideoGene();
            showContentTabSolution();
            customTabTOC();
            showListPolicy();
            handleHover();
            imageBeforeAfter();
            handleDownloadAllBtn();
            sameHeight();
            setMargintop();
            checkVideoContent();
        });
    };
})(jQuery);

function backToTop() {
    var $backToTop = $(".back-to-top");
    $backToTop.hide();

    $(window).on("scroll", function() {
        if ($(this).scrollTop() > 200) {
            $backToTop.fadeIn();
        } else {
            $backToTop.fadeOut();
        }
    });

    $backToTop.on("click", function(e) {
        $("html, body").animate({ scrollTop: 0 }, 50);
    });
}

function stuckHeader() {
    var header__home = $(".gnws-body_home .header");
    var header__page = $(".header__wrapper");

    if ($(".gnws-body_home").length) {
        if (header__home == null) {
            return 0;
        } else {
            window.addEventListener("scroll", function() {
                if (window.scrollY > 100) {
                    header__home.addClass("header-active");
                } else {
                    header__home.removeClass("header-active");
                }
            });
        }
    } else {
        var navTop = header__page.offset().top;

        function fixNav() {
            if (window.scrollY >= navTop) {
                header__page.addClass("header-active");
            } else {
                header__page.removeClass("header-active");
            }
        }
        window.addEventListener("scroll", fixNav);
    }
}

function showLanguage() {
    if ($(".language-dropdown").length) {
        $(".language-toggle").click(function(e) {
            e.preventDefault();
            e.stopPropagation();

            $(this).next(".language-dropdown").toggleClass("active");
        });
    }

    $(document).click(function(e) {
        if (!$(e.target).closest(".language-switcher").length) {
            $(".language-dropdown").removeClass("active");
        }
    });
}

function animateAOS() {
    AOS.init({
        once: true,
        disable: function() {
            var maxWidth = 991;
            return window.innerWidth < maxWidth;
        },
    });
    AOS.refresh();
}
// Wrap sub-menu megamenu

if ($(".menu-type-2").length) {
    $(".menu-type-2").each(function() {
        $(this)
            .children(".sub-menu")
            .find("> li")
            .wrapAll("<div class='sub-menu-wrapper' />");
        $(this).hover(function() {
            $(this).find(".sub-menu-wrapper > li:first-child").addClass("active");
            $(this)
                .find(".sub-menu-wrapper > li:first-child")
                .siblings()
                .removeClass("active");
        });
    });

    $(".menu-type-2 .sub-menu-wrapper > li > .sub-menu").each(function() {
        let subMenuTitle = $(this).prev().text().trim();
        $(this).prepend(
            "<h4 class='title-menu font-heading'>" + subMenuTitle + "</h4>"
        );
    });

    $(".menu-type-2 > .sub-menu > .sub-menu-wrapper > li").hover(function() {
        $(".menu-type-2 > .sub-menu > .sub-menu-wrapper > li").removeClass(
            "active"
        );
        $(this).addClass("active");
    });
}

function sliderPage() {
    if ($(".home__banner-item").length > 1) {
        $(".home__banner").flickity({
            pageDots: true,
            prevNextButtons: false,
            contain: true,
            cellAlign: "left",
            imagesLoaded: true,
            draggable: true,
            wrapAround: true,
            autoPlay: false,
        });
    }

    $(".review__content-slider").each(function(index, element) {
        var $contentSlider = $(element);
        var $navSlider = $contentSlider
            .parent()
            .parent()
            .prev()
            .find(".review__nav");
        if ($contentSlider.find(".review__content-item").length > 1) {
            $contentSlider.flickity({
                pageDots: true,
                prevNextButtons: false,
                contain: true,
                cellAlign: "left",
                imagesLoaded: true,
                draggable: true,
                wrapAround: true,
                autoPlay: 4000,
            });
            $navSlider.flickity({
                pageDots: false,
                prevNextButtons: false,
                contain: true,
                cellAlign: "left",
                imagesLoaded: true,
                draggable: false,
                wrapAround: false,
                autoPlay: false,
                asNavFor: element,
            });
        }
    });

    if ($(".block__field-item").length > 4) {
        $(".block__field-list").flickity({
            pageDots: false,
            prevNextButtons: true,
            contain: true,
            cellAlign: "left",
            imagesLoaded: true,
            draggable: true,
            wrapAround: true,
            autoPlay: 3000,
        });
    }
    if ($(".partner__slider .cell-item").length > 1) {
        $(".partner__slider").flickity({
            pageDots: true,
            prevNextButtons: false,
            contain: true,
            cellAlign: "left",
            imagesLoaded: true,
            draggable: true,
            wrapAround: true,
            autoPlay: 3000,
        });
    }
    if ($(".customer__slider .gini-carousel-item").length > 5) {
        $(".customer__slider").flickity({
            pageDots: false,
            prevNextButtons: true,
            contain: true,
            cellAlign: "left",
            imagesLoaded: true,
            draggable: true,
            wrapAround: true,
            autoPlay: false,
        });
    }
    if ($(".slider__review-list .slider__review-item").length > 1) {
        $(".slider__review-list").flickity({
            pageDots: false,
            prevNextButtons: true,
            contain: true,
            cellAlign: "left",
            imagesLoaded: true,
            draggable: true,
            wrapAround: true,
            autoPlay: 3000,
        });
    }

    if ($(".home__platforms-item").length > 1) {
        $(".home__platforms-list").flickity({
            pageDots: true,
            prevNextButtons: false,
            contain: true,
            cellAlign: "left",
            imagesLoaded: true,
            draggable: true,
            wrapAround: true,
            autoPlay: 4000,
        });
    }
    if ($(".home__field-item").length > 1) {
        $(".home__field-list").flickity({
            pageDots: false,
            prevNextButtons: true,
            contain: true,
            cellAlign: "left",
            imagesLoaded: true,
            draggable: true,
            wrapAround: true,
            autoPlay: 4000,
        });
    }

    if ($(".home__story-slider .cell-item").length > 3) {
        $(".home__story-slider").flickity({
            pageDots: false,
            prevNextButtons: false,
            contain: true,
            cellAlign: "left",
            imagesLoaded: true,
            draggable: true,
            wrapAround: true,
            autoPlay: 4000,
        });
        $(".home__story-content .slider-control").show();
    }

    if ($(".gov__expert-list .gini-carousel-item").length > 3) {
        $(".gov__expert-list").flickity({
            pageDots: false,
            prevNextButtons: true,
            contain: true,
            cellAlign: "left",
            imagesLoaded: true,
            draggable: true,
            wrapAround: false,
            autoPlay: 4000,
        });
    }

    if ($(".solution__slider .gini-carousel-item").length > 4) {
        $(".solution__slider .before-carousel").flickity({
            pageDots: false,
            prevNextButtons: true,
            contain: true,
            cellAlign: "left",
            imagesLoaded: true,
            draggable: true,
            wrapAround: false,
            autoPlay: 4000,
        });
    }

    $(".block__solution-list").each(function() {
        var $solutionList = $(this);
        var $carouselItems = $solutionList.find(".gini-carousel-item");

        if ($carouselItems.length > 4) {
            $solutionList.flickity({
                pageDots: false,
                prevNextButtons: true,
                contain: true,
                cellAlign: "left",
                imagesLoaded: true,
                draggable: true,
                wrapAround: false,
                autoPlay: 4000,
            });
        }
    });

    if ($(".home__cirle-list .home__cirle-item").length > 5) {
        $(".home__cirle-list").flickity({
            pageDots: false,
            prevNextButtons: true,
            contain: true,
            cellAlign: "left",
            imagesLoaded: true,
            draggable: true,
            wrapAround: false,
            autoPlay: false,
        });
    }

    if ($(".paper__overview-award .carousel-cell").length > 1) {
        $(".paper__overview-award .list-award").flickity({
            pageDots: false,
            prevNextButtons: true,
            contain: true,
            cellAlign: "left",
            imagesLoaded: true,
            draggable: true,
            wrapAround: false,
            autoPlay: false,
        });
    }
    if ($(".gini__tab-slider .gini-carousel-item").length > 3) {
        $(".gini__tab-slider").flickity({
            pageDots: false,
            prevNextButtons: false,
            contain: true,
            cellAlign: "left",
            imagesLoaded: true,
            draggable: true,
            wrapAround: true,
            autoPlay: 4000,
        });

        $(".gini__tab-content .slider-control").show();
    }
    if ($(".block__award-slider .gini-carousel-item").length > 1) {
        $(".block__award-slider ").flickity({
            pageDots: false,
            prevNextButtons: true,
            contain: true,
            cellAlign: "center",
            imagesLoaded: true,
            draggable: true,
            wrapAround: true,
            autoPlay: false,
        });
    }
    if ($(".slider-news .gini-carousel-item").length > 4) {
        $(".slider-news").flickity({
            pageDots: false,
            prevNextButtons: true,
            contain: true,
            cellAlign: "left",
            imagesLoaded: true,
            draggable: true,
            wrapAround: false,
            autoPlay: true,
        });
    }
    if ($(".block__credit-list .gini-carousel-item").length > 2) {
        $(".block__credit-list").flickity({
            pageDots: false,
            prevNextButtons: true,
            contain: true,
            cellAlign: "left",
            imagesLoaded: true,
            draggable: true,
            wrapAround: false,
            autoPlay: true,
        });
    }
    if ($(".block__project-list .gini-carousel-item").length > 3) {
        $(".block__project-list").flickity({
            pageDots: false,
            prevNextButtons: true,
            contain: true,
            cellAlign: "left",
            imagesLoaded: true,
            draggable: true,
            wrapAround: false,
            autoPlay: true,
        });
    }
    if ($(".block__advantage-list .gini-carousel-item").length) {
        $(".block__advantage-list").flickity({
            pageDots: false,
            prevNextButtons: false,
            contain: true,
            cellAlign: "left",
            imagesLoaded: true,
            draggable: true,
            wrapAround: true,
            autoPlay: true,
        });

        $(".block__advantage-main").flickity({
            pageDots: false,
            prevNextButtons: false,
            contain: true,
            cellAlign: "left",
            imagesLoaded: true,
            draggable: false,
            wrapAround: true,
            autoPlay: false,
            asNavFor: ".block__advantage-list",
        });
    }

    if ($(".block__quality-list.show-4-item .gini-carousel-item").length > 4) {
        $(".block__quality-list.show-4-item").flickity({
            pageDots: false,
            prevNextButtons: true,
            contain: true,
            cellAlign: "left",
            imagesLoaded: true,
            draggable: true,
            wrapAround: false,
            autoPlay: false,
        });
    }
    if ($(".block__quality-list.show-5-item .gini-carousel-item").length > 5) {
        $(".block__quality-list.show-5-item").flickity({
            pageDots: false,
            prevNextButtons: true,
            contain: true,
            cellAlign: "left",
            imagesLoaded: true,
            draggable: true,
            wrapAround: false,
            autoPlay: false,
        });
    }
    if ($(".slider__enterprise  .gini-carousel-item").length > 4) {
        $(".slider__enterprise").flickity({
            pageDots: false,
            prevNextButtons: true,
            contain: true,
            cellAlign: "left",
            imagesLoaded: true,
            draggable: true,
            wrapAround: false,
            autoPlay: true,
        });
    }
}

function showPopUpCircle() {
    if ($(".home__cirle-item").length) {
        $(".home__cirle-item").click(function() {
            let htmlSlider = $(this).find(".data-slider").html();
            let popupContainer = $(".home__cirle-wrapper");
            popupContainer.empty();
            popupContainer.append(htmlSlider);
            let popUpSlider = $(".home__cirle-popup .data-slider-content");
            if ($(popUpSlider).length) {
                $(popUpSlider).flickity({
                    pageDots: true,
                    prevNextButtons: true,
                    contain: true,
                    cellAlign: "left",
                    imagesLoaded: true,
                    draggable: true,
                    wrapAround: false,
                    autoPlay: false,
                });
            }
            $(popUpSlider).flickity("resize");
            $(popUpSlider).flickity("reposition");
            $(".home__cirle-popup,.overlay").addClass("show");
        });

        $(document).on("click", ".overlay", function() {
            $(".home__cirle-popup,.overlay").removeClass("show");
        });
    }
}

function countUpNumber() {
    if ($(".section__count").length) {
        var counted = 0;
        $(window).scroll(function() {
            var oTop = $(".section__count").offset().top - window.innerHeight;
            if (counted == 0 && $(".count").length && $(window).scrollTop() > oTop) {
                $(".count").each(function() {
                    var $this = $(this),
                        countTo = $this.attr("data-count");
                    $({
                        countNum: $this.text(),
                    }).animate({
                            countNum: countTo,
                        },

                        {
                            duration: 2000,
                            easing: "swing",
                            step: function() {
                                $this.text(Math.floor(this.countNum));
                            },
                            complete: function() {
                                $this.text(this.countNum);
                                //alert('finished');
                            },
                        }
                    );
                });
                counted = 1;
            }
        });
    }
}

function showContentField() {
    if ($(".home__field-item").length) {
        $(document).on("click", ".home__field-item", function() {
            $(this)
                .children(".home__field-inner")
                .toggleClass("active")
                .find(".home__field-desc")
                .slideToggle(500);
            $(this)
                .siblings()
                .children(".home__field-inner")
                .removeClass("active")
                .find(".home__field-desc")
                .slideUp(500);
        });
    }
}

function sliderStory() {
    // previous
    if ($(".gini-carousel").length) {
        const $previousButton = $(".gini__carousel-prev").on("click", function() {
            $(".gini-carousel").flickity("previous");
        });
        // next
        const $nextButton = $(".gini__carousel-next").on("click", function() {
            $(".gini-carousel").flickity("next");
        });
    }
    //show popup video story
    if ($(".gini__thumb.has-video").length) {
        $(".gini__thumb.has-video:not(.no-video)").click(function(e) {
            e.preventDefault();

            var videoHref = $(this).find("a").attr("href");
            var imgSrc = $(this).find("img").attr("src");

            $(".gini__thumb-popup a").attr("href", videoHref);
            $(".gini__thumb-popup img").attr("src", imgSrc);

            $(".gini__thumb-popup").addClass("show");

            $(".overlay").addClass("show");
        });

        $(".gini__thumb-popup .close,.overlay").click(function() {
            $(".gini__thumb-popup,.overlay").removeClass("show");
        });

        $(".gini__thumb-popup > a").fancybox({
            beforeShow: function(instance, current) {
                $(".gini__thumb-popup .close").trigger("click");
            },
        });
    }
}

function showSolution() {
    if ($(".home__solution".length)) {
        $(".home__solution-slider-list").each(function(index, elm) {
            var $this = $(this);
            var $carouselStatus = $this.next().find(".carousel-status");

            var solutionItemCount = $this.find(".solution__item").length;
            var wrapAround = solutionItemCount > 3;

            var homeSolution = $this.flickity({
                pageDots: false,
                prevNextButtons: false,
                contain: true,
                cellAlign: "left",
                imagesLoaded: true,
                draggable: true,
                wrapAround: wrapAround,
                autoPlay: false,
            });

            if (wrapAround) {
                $this.next(".progress-wrapper").show();
            } else {
                $this.next(".progress-wrapper").hide();
            }

            var flkty = homeSolution.data("flickity");

            function updateStatus() {
                var cellNumber = flkty.selectedIndex + 1;
                $carouselStatus.text(cellNumber + "/" + flkty.slides.length);
            }

            updateStatus();
            homeSolution.on("change.flickity", updateStatus);
        });

        $(".home__solution__item").click(function(e) {
            e.stopPropagation();
            var solutionNumber = $(this).data("solution");

            // Hiển thị "home__solution-content" và thêm class "show"
            $(".home__solution-content").addClass("show");
            $(".home__solution-top").addClass("hide");

            // Hiển thị "home__solution-content-item" tương ứng và thêm class "active"
            $(".home__solution-content-item[data-solution=" + solutionNumber + "]")
                .addClass("active")
                .find(".home__solution-slider")
                .show()
                .find(".home__solution-slider-list")
                .flickity("resize");
        });

        // Khi bấm vào "home__solution-block"
        $(".home__solution-block").click(function(event) {
            event.stopPropagation();
            $(this)
                .parent(".home__solution-content-item")
                .addClass("active")
                .siblings(".home__solution-content-item")
                .removeClass("active")
                .find(".home__solution-slider")
                .hide();
            $(this).next(".home__solution-slider").show();
            $(this)
                .next(".home__solution-slider")
                .find(".home__solution-slider-list")
                .flickity("resize");
        });

        // Khi bấm ra ngoài
        $(document).click(function(event) {
            if (!$(event.target).closest(".home__solution-content").length) {
                $(".home__solution-content").removeClass("show");
                $(".home__solution-top").removeClass("hide");
                $(".home__solution-slider").hide();
                $(".home__solution-content-item").removeClass("active");
            }
        });
    }
}

function sliderSolution() {
    if ($(".timeline").length) {
        var flickityCarousel = $(".home__solution-slider");
        for (let i = 0; i < flickityCarousel.length; i++) {
            let $carouselGallery = $(flickityCarousel[i]).find(
                    ".home__solution-slider-list"
                ),
                $progressBar = $(flickityCarousel[i]).find(".timeline .process");
            var flkty = $carouselGallery.data("flickity");
            $carouselGallery.on("scroll.flickity", function(event, progress) {
                progress = Math.max(0.05, Math.min(1, progress));
                $progressBar.width(progress * 100 + "%");
            });

            $(flickityCarousel[i])
                .find(".button--prev")
                .click(function() {
                    $carouselGallery.flickity("previous");
                });
            $(flickityCarousel[i])
                .find(".button--next")
                .click(function() {
                    $carouselGallery.flickity("next");
                });
        }
    }
}

function showActiveNavPage() {
    if ($(".page__nav").length) {
        $(".page__nav a").click(function(e) {
            $(".page__nav a").removeClass("active");
            $(this).addClass("active");
        });
    }
}

function showContentGov() {
    if (
        $(".gov__capacity-item").length < 4 &&
        $(".gov__capacity-item").length > 0
    ) {
        $(".gov__capacity-item:first").addClass("active");

        $(".gov__capacity-item").hover(function() {
            $(this).addClass("active").find(".desc").slideDown(300);
            $(this).siblings().removeClass("active").find(".desc").slideUp(300);
        });
    }
    if ($(".gov__capacity-item").length > 3) {
        $(".gov__capacity-list").flickity({
            pageDots: false,
            prevNextButtons: true,
            contain: true,
            cellAlign: "left",
            imagesLoaded: true,
            draggable: false,
            wrapAround: true,
            autoPlay: false,
        });
        $(".gov__capacity-list").flickity("resize");
        $(".gov__capacity-list .flickity-button").click(function() {
            $(".gov__capacity-list").flickity("resize");
        });
    }
}

$(document).ready(function() {
    if ($(".gov__capacity-list.flickity-enabled").length) {
        $(".gov__capacity-list").flickity("resize");
    }
});

function controlVideo() {
    if ($(".gov__video-item video").length || $(".accompany__video").length) {
        var video = $(".gov__video-item video,.accompany__video-item video")[0];

        $(".pause-video").click(function() {
            $(this).find("svg").toggle();
            if (video.paused) {
                video.play();
            } else {
                video.pause();
            }
        });
    }
}

function govCompanion() {
    if ($(".gov__companion").length) {
        $(".gov__companion-item .button-link").click(function(e) {
            e.stopPropagation();
            e.preventDefault();
            var companionNumber = $(this).parent().data("companion");

            $(".gov__companion-list").hide();

            $(
                ".gov__companion-detail-item[data-companion=" + companionNumber + "]"
            ).fadeIn(300);
        });
        $(".gov__companion-detail-item .button-link").click(function() {
            var $item = $(this).parents(".gov__companion-detail-item");
            $item.fadeOut(function() {
                $item.siblings().fadeIn();
                $("html, body").animate({
                        scrollTop: $item.siblings().offset().top - 150,
                    },
                    100
                );
            });
        });

        $(document).click(function(event) {
            if (!$(event.target).closest(".gov__companion-detail-item").length) {
                $(".gov__companion-detail-item").fadeOut();
                $(".gov__companion-list").show();
            }
        });
    }
}
// Custom placeholder form
function customFormInput() {
    if ($(".form__contact").length) {
        $(".form__contact input").focus(function() {
            $(this).parent().next("label").fadeOut();
            $(this).next("label").fadeOut();
        });
        $(".form__contact input").focusout(function() {
            if ($(this).val().length == 0) {
                $(this).parent().next("label").fadeIn();
                $(this).next("label").fadeIn();
            }
        });
    }
}

function checkItemWhyUs() {
    if ($(".block__whyus").length) {
        let leftItemCount = $(".block__whyus-left li").length;
        let rightItemCount = $(".block__whyus-right li").length;
        let centerElement = $(".block__whyus-center");

        if (leftItemCount + rightItemCount === 6) {
            centerElement.addClass("six-item");
        } else if (leftItemCount + rightItemCount === 4) {
            centerElement.addClass("four-item");
        }

        if (leftItemCount === 2 && rightItemCount === 3) {
            centerElement.addClass("two-left-item");
        } else if (leftItemCount === 3 && rightItemCount === 2) {
            centerElement.addClass("two-right-item");
        }
    }
}

function showContentErp() {
    if ($(".erp__field-item").length) {
        function showDescription() {
            $(this).toggleClass("active").find(".erp__field-bottom").slideToggle();
        }
        $(".erp__field-list").on(
            "mouseenter mouseleave",
            ".erp__field-item",
            showDescription
        );
    }
}

function resizeSliderTab() {
    var tabResize = $(".tab-resize.flickity-enabled");
    tabResize.flickity({
        pageDots: false,
        prevNextButtons: false,
        cellAlign: "left",
    });

    var awardSlider = $(".block__award-slider");

    $(".nav").on("shown.bs.tab", function(e) {
        if ($(tabResize).length) {
            tabResize.flickity("resize");
        }
        if ($(awardSlider).length) {
            awardSlider.flickity("resize");
        }
        countUpNumber();
        AOS.refreshHard();
        setMargintop();
        $(".block__advantage-list").on("change.flickity", sameHeight());
    });
    $(".nav").on("hidden.bs.tab", function(e) {
        AOS.refreshHard();
        countUpNumber();
    });
}
$(document).on("shown.bs.tab", sameHeight);

function dynamicPopUp() {
    if ($(".erp__field-item").length) {
        $(".erp__field-item .more-btn").click(function() {
            let erpFieldItem = $(this).closest(".erp__field-item");
            let fieldContent = erpFieldItem.find(".erp__field-data-popup").html();
            let popupContainer = $(".popup__field-content");
            popupContainer.empty();
            popupContainer.append(fieldContent);
        });
    }
}

function handleFormSearch() {
    if ($(".block__product-search") || $(".post__filter-search ").length) {
        $(".cate-selected").on("click", function(e) {
            $(".block__product-cate-list,.post__filter-cate-list").toggleClass(
                "active"
            );
            e.stopPropagation();
        });
        // Filter tags
        $(".block__product-tags li").click(function() {
            let selectedTag = $(this).data("tag");

            // Lặp qua từng sản phẩm
            $(".product__item").each(function() {
                let productTags = $(this).data("tag").split(","); // Tách các giá trị thành một mảng

                // Kiểm tra xem có bất kỳ giá trị nào trong mảng sản phẩm khớp với thẻ li được chọn
                let match = productTags.some(function(tag) {
                    return tag.trim() === selectedTag;
                });

                if (match) {
                    $(this).parent().removeClass("d-none");
                } else {
                    $(this).parent().addClass("d-none");
                }
            });
        });

        // Filter categories
        $(".block__product-cate-list li").on("click", function() {
            let itemValue = $(this).data("selected");
            let selectedCat = $(this).data("cat");
            $(".block__product-cate-list li").removeClass("active");
            $(this).addClass("active");
            $(".cate-selected").text($(this).text()).attr("data-selected", itemValue);
            $(".block__product-cate-list").toggleClass("active");
            $(".product__item").each(function() {
                if ($(this).data("cat") === selectedCat) {
                    $(this).parent().removeClass("d-none");
                } else {
                    $(this).parent().addClass("d-none");
                }
            });
        });

        $(".post__filter-cate-list li").on("click", function() {
            let itemValue = $(this).data("selected");
            let selectedCat = $(this).data("cat");
            $(".post__filter-cate-list li").removeClass("active");
            $(this).addClass("active");
            $(".cate-selected").text($(this).text()).attr("data-selected", itemValue);
            $(".post__filter-cate-list").toggleClass("active");
        });

        $(document).click(function(e) {
            if (!$(e.target).closest(".block__product-cate,.post__filter-cate").length) {
                $(".block__product-cate-list,.post__filter-cate-list").removeClass(
                    "active"
                );
            }
        });

        //Filter Search

        $(".block__product-input:not(.gnws_form-search_ajax):not(.gnws-not-inlude_input) .input-search").keyup(
            function() {
                const searchText = $(this).val().toLowerCase();

                filter(searchText);
            }
        );

        $(".block__product-input:not(.gnws_form-search_ajax):not(.gnws-not-inlude_input) .button-link").click(
            function() {
                $(".product__item")
                    .parent()
                    .removeClass("d-none")
                    .css("display", "block");
                $(".no-result").css("display", "none");
                $(".block__product-input:not(.gnws_form-search_ajax):not(.gnws-not-inlude_input) input").val("");
            }
        );

        function filter(x) {
            var isMatch = false;
            $(".product__item").each(function(i) {
                var content = $(this).data("search");

                if (content.toLowerCase().indexOf(x) == -1) {
                    $(this).parent().hide();
                } else {
                    isMatch = true;
                    $(this).parent().show();
                }
            });

            var ccs = $(".product__item").filter(function() {
                return $(this).parent().css("display") !== "none";
            }).length;

            $(".no-result").toggle(!isMatch);
        }

        var ccs = $(".product__item").filter(function() {
            return $(this).parent().css("display") !== "none";
        }).length;
    }
    if ($(".filter-item").length) {
        $(".filter-item .title").click(function() {
            $(this).toggleClass("active");
            $(this).next().slideToggle();
        });
        $(".filter-item:first .title").trigger("click");
    }
}

function scrollDown() {
    $(".scroll__icon").click(function() {
        var sectionScroll = $(this).parents(".accompany__heading").next();
        if (sectionScroll.length) {
            $("html, body").animate({
                    scrollTop: $(sectionScroll).offset().top - 200,
                },
                50
            );
        }
    });
}

function dynamicBanner() {
    if ($(".about__banner").length) {
        var originalBackground = $(".about__banner").css("background-image");
        var bannerTitle = $(".about__banner-title");
        $(".about__nav button").click(function() {
            var dataBanner = $(this).attr("data-banner");
            var dataTitle = $(this).find(".data-title").html();
            bannerTitle.empty();
            bannerTitle.append(dataTitle);
            if (dataBanner !== "") {
                $(".about__banner").css("background-image", "url(" + dataBanner + ")");
            } else {
                $(".about__banner").css("background-image", originalBackground);
            }
        });
        $(".about__nav .nav-item:last button").click(function() {
            countUpNumber();
        });
    }
}

function timeLineHistory() {
    if ($(".time__line-nav").length) {
        $(".time__line-nav .nav-item").click(function() {
            $(".time__line-nav .nav-item").removeClass("active");
            $(this).addClass("active");
            $(this).prevAll().addClass("active");
        });
        $(".time__line-nav .nav-item:first").trigger("click");
    }
}

function handleVideoGene() {
    if ($(".accompany__gene-video video").length) {
        let videoGene = $(".accompany__gene-video video")[0];
        var itemList = $(".accompany__gene-list").find(".accompany__gene-item");
        videoGene.addEventListener("timeupdate", function() {
            var currentTime = videoGene.currentTime;
            if (currentTime >= 4.5) {
                $(".accompany__gene-title").addClass("show");
            }
        });
        videoGene.addEventListener("ended", function() {
            addClassSequentially(itemList, "show", 1000);
        });

        function addClassSequentially(elements, className, delay) {
            var currentIndex = 0;

            function addNextClass() {
                if (currentIndex < elements.length) {
                    elements.eq(currentIndex).addClass(className);
                    currentIndex++;
                    setTimeout(addNextClass, delay);
                }
            }
            addNextClass();
        }
    }
}

function showProgress() {
    var $carousel = $(".block__major-nav .nav");
    var $progressBar = $(".progress-bar");
    $(".block__major-nav .nav-item button").click(function() {
        $(this).addClass("active");
        $(this).parent().siblings().find("button").removeClass("active");
    });
    if ($(".block__major-nav .nav-item").length > 5) {
        $carousel.flickity({
            pageDots: false,
            prevNextButtons: false,
            contain: true,
            cellAlign: "left",
            imagesLoaded: true,
            draggable: true,
            wrapAround: false,
            autoPlay: false,
        });
        $(".progress-wrapper").show();
    }

    $carousel.on("scroll.flickity", function(event, progress) {
        progress = Math.max(0, Math.min(1, progress));
        $progressBar.width(progress * 100 + "%");
    });
}

function checkVideo() {
    if ($(".gov__slider-list").length) {
        $(".gov__slider-item").each(function(index, item) {
            var $link = $(item).find(".gov__slider-img a");
            var hrefValue = $link.attr("href");

            if (!hrefValue || hrefValue.trim() === "") {
                $link.addClass("no-video");
                $link.attr("href", "javascript:void(0)");
                $link.removeAttr("data-fancybox");
            }
        });
    }
    if ($(".gini__thumb").length) {
        $(".gini__thumb").each(function(index, item) {
            var $link = $(item).find("a");
            var hrefValue = $link.attr("href");

            if (!hrefValue || hrefValue.trim() === "") {
                $link.parent().addClass("no-video");
                $link.attr("href", "javascript:void(0)");
                $link.removeAttr("data-fancybox");
            }
        });
    }
}

function showContentTabSolution() {
    if ($(".tab__solution").length) {
        $(".tab__solution button").click(function() {
            if ($(this).hasClass("active")) {
                const content = $(this).next(".content");
                const contentSiblings = $(this).parent().siblings().find(".content");
                content.slideDown();
                contentSiblings.slideUp();
            }
        });
        $(".tab__solution .nav-item:first button").trigger("click");
    }
}

function customTabTOC() {
    if ($(".about__policy-content").length) {
        var tabs = $(".about__policy-content .tab-pane");

        tabs.each(function(tabIndex) {
            let tab = $(this);
            let tabId = tab.attr("id");
            let tabContent = tab.find(".main__content");
            let tabTitle = tab.find(".title span").text().trim();
            let navButton = $(
                '.toc-custom .nav-item button[data-bs-target="#' + tabId + '"]'
            );
            navButton.text(tabTitle);

            let sectionTitle = tabContent.find("h2, h3, h4, h5, h6");
            sectionTitle.each(function(headingIndex) {
                let headingId = tabId + "-h" + headingIndex;
                $(this).attr("id", headingId);
            });

            const tocList = $("<ul>").addClass("toc-list");
            sectionTitle.each(function() {
                const link = $("<a>")
                    .attr("href", `#${$(this).attr("id")}`)
                    .text($(this).text());
                const listItem = $("<li>").append(link);
                tocList.append(listItem);
            });
            navButton.parent(".nav-item").append(tocList);
            $(".toc-list li").click(function() {
                $(".toc-list li").removeClass("active");
                $(this).addClass("active");
                $(this).prevAll().addClass("active");
            });
            $(".toc-custom button").click(function() {
                //scroll to top khi tab active
                var $activeTab = $(".about__policy-content .tab-pane.active");
                $("html, body").animate({
                        scrollTop: $activeTab.offset().top - 100,
                    },
                    0
                );

                $(this).next(".toc-list").slideDown();
                $(this).parent().siblings().find(".toc-list").slideUp();
            });
            $(".toc-custom .nav-item:first button").trigger("click");

            $(".toc-list a").on("click", function(e) {
                e.preventDefault();

                var targetId = $(this).attr("href");

                if ($(targetId).length > 0) {
                    $("html, body").animate({
                            scrollTop: $(targetId).offset().top - 100,
                        },
                        0
                    );
                }
            });

            $(".toc-list li a").each(function() {
                var text = $(this).text();
                var newText = text.replace(/\d+\,/g, "");
                $(this).text(newText);
            });
        });
    }
}

function showListPolicy() {
    if ($(".show-more").length) {
        $(".show-more").click(function() {
            $(".about__report-list .accordion-item:nth-child(n+4)").slideToggle(500);
            $(this).hide();
        });
    }
}

function handleHover() {
    if ($(".block__credit-item").length) {
        $(".block__credit-item").hover(function() {
            $(this).find(".desc-md,.button-link").slideToggle();
        });
    }
}

function imageBeforeAfter() {
    if ($(".block__before-after").length) {
        $("#slider").on("input change", (e) => {
            const sliderPos = e.target.value;
            $(".block__before-img:nth-child(2)").css("width", `${sliderPos}%`);
            $(".block__before-button").css("left", `${sliderPos}%`);
        });
    }
}

function handleDownloadAllBtn() {
    if ($(".about__report-list").length) {
        $(".download_all_link").click(function() {
            var links = document.querySelectorAll(".about__report-list a[download]");
            for (var i = 0; i < links.length; i++) {
                var link = links[i];
                var url = link.href;
                var fileName = link.getAttribute("download");
                var anchor = document.createElement("a");
                anchor.href = url;
                anchor.download = fileName;
                anchor.target = "_self";
                anchor.click();
            }
        });
    }
}

function sameHeight() {
    if ($(".block_sameheight")) {
        $(".block_sameheight:not(.block__advantage-list)").each(function() {
            var h = 0;

            $(this)
                .find(".sameheight_item")
                .each(function() {
                    if ($(this).outerHeight() > h) {
                        h = $(this).outerHeight();
                    }
                });

            $(this).find(".sameheight_item").css({
                height: h,
            });
        });
    }
}

function setMargintop() {
    if ($(".block__advantage-list").length) {
        $(".block__advantage-list ").each(function() {
            let itemHeight = $(this).find(".flickity-viewport").outerHeight() / 2;
            $(this).css("margin-top", -itemHeight);
        });
    }
}

function checkVideoContent() {
    let content = $(".page__content-detail");
    if (content.length) {
        content.find("a").each(function() {
            if ($(this).find("img").length > 0) {
                $(this).addClass("has-video");
            }
        });
    }
}