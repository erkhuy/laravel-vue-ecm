// $(function() {

//     $('.header__menu__nav').find("ul li").each(function() {
//         if ($(this).find("ul>li").length > 0) {
//             $(this).append('<i class="fa fa-chevron-right  btn-menu2 active" ></i>');
//         }
//     });
//     if ($(window).width() < 768) {
//         $('.header__menu__btn ').click(function() {
//             if ($(this).hasClass('active')) {
//                 $(this).removeClass('active');
//                 $('.header__menu__btn a>i').removeClass('fa-times');
//                 $('.header__menu__btn a>i').addClass('fa-bars');
//                 $('.header__menu__nav').removeClass('menu-eff');
//             } else {
//                 $(this).addClass('active');
//                 $('.header__menu__btn a>i').removeClass('fa-bars');
//                 $('.header__menu__btn a>i').addClass('fa-times');
//                 $('.header__menu__nav').addClass('menu-eff');
//             }

//         });
//         $('.btn-menu2').click(function() {
//             if ($(this).hasClass('active')) {
//                 $(this).removeClass('active');
//                 $(this).removeClass('fa-chevron-right');
//                 $(this).addClass('fa-chevron-down');
//                 $(this).parent('li').children('ul').slideDown(300);
//             } else {
//                 $(this).addClass('active');
//                 $(this).removeClass('fa-chevron-down');
//                 $(this).addClass('fa-chevron-right');
//                 $(this).parent('li').children('ul').slideUp(300);
//             };
//         });
//     }
//     // $('.slide__wrap').slick({
//     //     dots: true,
//     //     slidesToShow: 1,
//     //     autoplay: true,
//     //     autoplaySpeed: 3000,
//     //     arrows: true,
//     //     nextArrow: '<i class="text-center d-inline-block next-btn cspoint fa fa-angle-right" aria-hidden="true"></i>',
//     //     prevArrow: '<i class="text-center d-inline-block prev-btn cspoint fa fa-angle-left" aria-hidden="true"></i>',
//     // });
// });