$('.owl-carousel4').owlCarousel({
		loop: true,
		margin: 15,
		nav: true,
		responsive: {
			0: {
				items: 1
			},
			600: {
				items: 2
			},
			1000: {
				items: 4
			}
		}
	});



      $('#customer-testimonoals').owlCarousel({
                    loop: true,
                    center: true,
                    items: 3,
                    margin: 0,
                    autoplay: true,
                    dots: true,
                    autoplayTimeout: 8500,
                    smartSpeed: 450,
                    nav: false,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 3
                        },
                        1000: {
                            items: 3
                        }
                    }
                });

/*================================================== 

    Testimonials

=====================================================*/

// (function () {
//   "use strict";

//   var carousels = function () {
//     $(".owl-carousel1").owlCarousel({
//       loop: true,
//       center: true,
//       margin: 0,
//       responsiveClass: true,
//       nav: false,
//       responsive: {
//         0: {
//           items: 1,
//           nav: false
//         },
//         680: {
//           items: 2,
//           nav: false,
//           loop: false
//         },
//         1000: {
//           items: 3,
//           nav: true
//         }
//       }
//     });
//   };

//   (function ($) {
//     carousels();
//   })(jQuery);
// })();






//   all ------------------
// function initParadoxWay() {
//     "use strict";
   
//     if ($(".testimonials-carousel").length > 0) {
//         var j2 = new Swiper(".testimonials-carousel .swiper-container", {
//             preloadImages: false,
//             slidesPerView: 1,
//             spaceBetween: 20,
//             loop: true,
//             grabCursor: true,
//             mousewheel: false,
//             centeredSlides: true,
//             pagination: {
//                 el: '.tc-pagination',   
//                 clickable: true,
//                 dynamicBullets: true,
//             },
//             navigation: {
//                 nextEl: '.listing-carousel-button-next',
//                 prevEl: '.listing-carousel-button-prev',
//             },
//             breakpoints: {
//                 1024: {
//                     slidesPerView: 3,
//                 },
                
//             }
//         });
//     }
    
// bubbles -----------------
    
    
//     setInterval(function () {
//         var size = randomValue(sArray);
//         $('.bubbles').append('<div class="individual-bubble" style="left: ' + randomValue(bArray) + 'px; width: ' + size + 'px; height:' + size + 'px;"></div>');
//         $('.individual-bubble').animate({
//             'bottom': '100%',
//             'opacity': '-=0.7'
//         }, 4000, function () {
//             $(this).remove()
//         });
//     }, 350);
    
// }

//   Init All ------------------
// $(document).ready(function () {
//     initParadoxWay();
// });
/*================================================== 

    FAQs Page

=====================================================*/

$('.nav-tabs-dropdown').each(function(i, elm) {
            $(elm).text($(elm).next('ul').find('li.active a').text());
        });
        $('.nav-tabs-dropdown').on('click', function(e) {
            e.preventDefault();
            $(e.target).toggleClass('open').next('ul').slideToggle();
        });
        $('#nav-tabs-wrapper a[data-toggle="tab"]').on('click', function(e) {
            e.preventDefault();
            $(e.target).closest('ul').hide().prev('a').removeClass('open').text($(this).text());
        });
        $('.brand-carousel').owlCarousel({
            loop: true,
            margin: 10,
            autoplay: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        });
        $(function() {
            //$(".chevron-down").
            $("div[data-toggle=collapse]").click(function() {
                $(this).children('span').toggleClass("fa-chevron-down fa-chevron-up");
            });
        })

/*================================================== 

    Banner form

=====================================================*/

// $(document).ready(function() {
// $(".btn-pref .btn").click(function () {
//     $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
//     // $(".tab").addClass("active"); // instead of this do the below 
//     $(this).removeClass("btn-default").addClass("btn-primary");   
// });
// });
