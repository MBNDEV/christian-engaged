var CustomModal = function () {
    var initialize = function () {
        $(document).on('click', '.mobile-nav', function () {
            var leftPos = $('.main-nav').position().left;
            if (leftPos == 0) {
                $('.mobile-nav').removeClass('close-nav');
                $('body').removeClass('overflow-hidden');
                $('.main-nav').animate({'left': -100 + '%'});
                $('.header').removeClass('add-nav');
            } else {
                $('body').addClass('overflow-hidden');
                $('.mobile-nav').addClass('close-nav');
                $('.main-nav').animate({'left': 0});
                $('.header').addClass('add-nav');
            }
        });
        $(document).on('click', '.login-btn a', function () {
            $('body').addClass('overflow-hidden');
            $('.overlay').addClass('show-overlay')
            setTimeout(function () {
                $('#login-popup').addClass('show-popupBox');
            }, 300);
        });

        $(document).on('click', '.close-popupBox', function () {
            $('#login-popup').removeClass('show-popupBox');
            $('.overlay').addClass('show-overlay')
            setTimeout(function () {
                $('body').removeClass('overflow-hidden');
                $('.overlay').removeClass('show-overlay');
            }, 300);

        });



        /*$(document).ready(function() {
          $(".header-top-menu a, .join-btn, .merch-btn, .donate-btn a, .view-btn a, .add-to-cart, .proceedbutton a, .wc-proceed-to-checkout a").on("click touchend", function(e) {
            var el = $(this);
            var link = el.attr("href");
            window.location = link;
          });
        });*/

        $(window).bind('scroll', function() {
            var pageURL = $(location).attr("href");

            if (pageURL == APP_URL+'/' || pageURL == APP_URL) {
                var navHeight = $( window ).height();
                if ($(window).scrollTop() > navHeight) {
                     $('.homenav').addClass('headerBg');
                     $('.featured-wrap').addClass('space');
                }
                else {
                    $('.homenav').removeClass('headerBg');
                    $('.featured-wrap').removeClass('space');
                }
            }

            else {
                /*if ($(window).scrollTop() >= 100) {
                    $('.header').addClass('headerBg');
                    $('.body-content').addClass('space');
                }
                else {
                    $('.header').removeClass('headerBg');
                    $('.body-content').removeClass('space');
                }*/
            }
        });



        /*Add window height in Front Wrap */

        $(".front-wrap").css("height", $(window).height());

        if ($(window).width() <= 991) {

            $(".front-wrap").css("height", $(window).height()/2+50);

            $(window).bind('scroll', function() {
                var pageURL = $(location).attr("href");

                if (pageURL == APP_URL+'/' || pageURL == APP_URL) {
                    var navHeight = $( window ).height()/2+50;
                    if ($(window).scrollTop() > navHeight) {
                         $('.homenav').addClass('headerBg');
                         $('.featured-wrap').addClass('space');
                    }
                    else {
                        $('.homenav').removeClass('headerBg');
                        $('.featured-wrap').removeClass('space');
                    }
                }

                else {
                    /*if ($(window).scrollTop() >= 100) {
                        $('.header').addClass('headerBg');
                        $('.body-content').addClass('space');
                    }
                    else {
                        $('.header').removeClass('headerBg');
                        $('.body-content').removeClass('space');
                    }*/
                }
            });
        }


        if ($(window).width() <= 560) {
            $(".front-wrap").css("height", $(window).height()/2-50);
        }

        $( window ).resize(function() {

            $(".front-wrap").css("height", $(window).height());

            if ($(window).width() <= 991) {
               $(".front-wrap").css("height", $(window).height()/2+50);

                $(window).bind('scroll', function() {
                    var pageURL = $(location).attr("href");

                    if (pageURL == APP_URL+'/' || pageURL == APP_URL) {
                        var navHeight = $( window ).height()/2+50;
                        if ($(window).scrollTop() > navHeight) {
                             $('.homenav').addClass('headerBg');
                             $('.featured-wrap').addClass('space');
                        }
                        else {
                            $('.homenav').removeClass('headerBg');
                            $('.featured-wrap').removeClass('space');
                        }
                    }

                    else {
                        /*if ($(window).scrollTop() >= 100) {
                            $('.header').addClass('headerBg');
                            $('.body-content').addClass('space');
                        }
                        else {
                            $('.header').removeClass('headerBg');
                            $('.body-content').removeClass('space');
                        }*/
                    }
                });
            }

            if ($(window).width() <= 560) {
                $(".front-wrap").css("height", $(window).height()/2-50);
            }

        });



        /* End */


        $(".scroll-btn a").click(function() {
            $('html, body').animate({
                scrollTop: $(".body-content").offset().top
            }, 500);
        });

    }

    return {
        init: function () {
            initialize();
        }
    }
}();

CustomModal.init();


/* Start Animation */
wow = new WOW(
        {
            animateClass: 'animated',
            offset: 100,
            callback: function (box) {
                //console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
            }
        }
);
wow.init();
/* End Animation */

$("#close_newsletter").click(function(){
    $('#newsletter_message').html("");
    $("#newsletter_email").val('');
    $("#newsletter_confirm_email").val('');
});

$(document).on("submit", "#newsletterForm", function (e) {
    e.preventDefault();
    e.stopPropagation();

    $("#newsletter_subscribe").attr('disabled','disabled');
    $("#newsletter_subscribe").html('Subscribing..');
    $('#newsletter_message').html("");
    if($('#newsletter_confirm_email').val() != $('#newsletter_email').val()){
        $("#newsletter_subscribe").removeAttr('disabled');
        $("#newsletter_subscribe").html('JOIN US');
        $('#newsletter_message').html("Email and Confirm Email should be the same.");
        return false;
    }
    $.ajax({
        type: 'POST',
        url: $('#newsletterForm').attr('action'),
        data: {'email': $('#newsletter_email').val(),'confirm_email':$('#newsletter_confirm_email').val()},
        success: function (data) {

            var result = JSON.parse(data);
            grecaptcha.reset();
            if(result.message){
               $("#newsletter_message").css('display','block'); 
                setTimeout(function(){
                   $('#newsletter_message').hide();// or fade, css display however you'd like.
                }, 3000);
            }
            $('#newsletter_message').html(result.message);
            $("#newsletter_subscribe").removeAttr('disabled');
            $("#newsletter_subscribe").html('JOIN US');
            $("#newsletter_email").val('');
            $("#newsletter_confirm_email").val('');

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + errorThrown);
            $("#newsletter_subscribe").removeAttr('disabled');
            $("#newsletter_subscribe").html('JOIN US');
        }
    });
});

$('.bar-percentage[data-percentage]').each(function () {
    var progress = $(this);
    var percentage = Math.ceil($(this).attr('data-percentage'));
    $({countNum: 0}).animate({countNum: percentage}, {
        duration: 2000,
        easing: 'linear',
        step: function () {
            // What todo on every count
            var pct = '';
            if (percentage == 0) {
                pct = '0%';
                $('#appendHtml').remove();
            } else {
                pct = Math.floor(this.countNum + 1) + '%';
            }
            progress.text(pct) && progress.siblings().children().css('width', pct);
            $('.bar-percentage').append('<span id="appendHtml">COMPLETE</span>');
            if (percentage == 100)
                $('.bar-container .bar').addClass('complete');
            else
                $('.bar-container .bar').removeClass('complete');
        }
    })
});

$(document).on("click","#play",function(e){
    $('#videoIframe').removeClass('hide');
    $('#close-video').removeClass('hide');

    //SetAutoplay on
    var src = $('#videoIframe iframe').attr('src');
    $('#videoIframe iframe').attr('src', src+= "&autoplay=1&rel=0");

});

$(document).on("click","#close-video",function(){
    $('#videoIframe').addClass('hide');
    $('#close-video').addClass('hide');

    var src = $('#videoIframe iframe').attr('src');
    var newsrc = src.replace("&autoplay=1", "");
    $('#videoIframe iframe').attr('src', newsrc);

});

$(document).ready(function () {

    $('.country, #country, .size, #select').select2();
    $(".country, #country").select2("val", 231);

});


$(document).ready(function () {
    
    (function() {
 
  // store the slider in a local variable
    var $window = $(window),
      flexslider = { vars:{} };
 
  // tiny helper function to add breakpoints
  function getGridSize() {
    return (window.innerWidth < 560) ? 1 :
           (window.innerWidth < 767) ? 2 :
           (window.innerWidth < 900) ? 3 : 3;
  }
 
  $(function() {
    SyntaxHighlighter.all();
  });
 
  $window.load(function() {
    $('.flexslider').flexslider({
      animation: "slide",
      animationLoop: false,
      itemWidth: 210,
      itemMargin: 40,
      minItems: getGridSize(), // use function to pull in initial value
      maxItems: getGridSize(), // use function to pull in initial value
    });

  });
 
  // check grid size on resize event
  $window.resize(function() {
    var gridSize = getGridSize();
 
    flexslider.vars.minItems = gridSize;
    flexslider.vars.maxItems = gridSize;
  });

  setTimeout(function() {
    var c = $(".flexslider .slides > li").length
    if(c < 4) {
        console.log(true)
        $('.flex-direction-nav').css('display: none');
    }
  }, 5000)


}());
    
    /*setTimeout(function () {
        $('.photoGrid').photoGrid({});           
    }, 1000);*/
    
    
});   