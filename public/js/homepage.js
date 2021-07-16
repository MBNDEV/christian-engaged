/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function () {

    var defaults = {
        itemSelector: ".item", // item selecor ;-)
        resize: true, // automatic reload grid on window size change
        //rowHeight: $(window).height() / 2, // looks best, but needs highres thumbs
        callback: function () {} // fires when layouting grid is done
    };

});

/* End Photo Grid */


$(document).ready(function () {
//    var frontH = $(".front-wrap").innerHeight();
//    $(".front-wrap").css('height', frontH);
//
    //Set cart item count
    var count = localStorage.getItem("cart_list") == null ? 0 : localStorage.getItem("cart_list") == null ? [] : JSON.parse(localStorage.getItem("cart_list")).length;
    $('#cartDetail em').html(''+count+'');    

});
//$('.scroll-btn a').click(function () {
//    scrollDown();
//    $('.photoGrid').photoGrid({});
//    $('.product-slide').bxSlider({
//        minSlides: 3,
//        maxSlides: 2,
//        adaptiveHeight: true,
//        slideWidth: 600,
//        slideMargin: 50
//    });
//});
//$(window).scroll(function () {
//    if ($(this).scrollTop() > 0)
//    {
//        setTimeout(function () {
//            $('.photoGrid').photoGrid({});
//            scrollDown();
//        }, 1000);
//    }
//
//});
//
//document.getElementById("front-wrap").addEventListener("wheel", scrollButton);
//function scrollButton() {
//    scrollDown();
//}
//function scrollDown() {
//    $('.mainpage').fadeIn();
//    $('.front-wrap').fadeOut();
//    
//}

//

 
    

