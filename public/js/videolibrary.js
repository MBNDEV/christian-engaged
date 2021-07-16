
$(document).ready(function () {
    $('#topic, #sort').select2();

    // $("#date").datepicker({
    //     format: "mmm  yyyy",
    //     viewMode: "months",
    //     minViewMode: "months",          
    // }).on('changeDate', function (e) {
    //     $(this).blur();
    //     $(this).datepicker('hide');         
    //     setTimeout(function(){ $("#date").trigger('change'); }, 100);  
    // });

    // $("#date").val('');

    $(document).on('change', '#topic, #sort', function (e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var topic = $("#topic").val();
        var sort = $("#sort").val();
        //console.log(sort); 
        $(".overlay").show();
        $.ajax({
            type: 'GET',
            url: APP_URL + '/load-videos?page=1&topic=' + topic + '&sort=' + sort,
            success: function (data) {
                //$(".video-list").html('');
                $(".video-list").html(data);
                $(".video-list").data('page', 1);
                $(".overlay").hide();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus + errorThrown);
            }
        });
    });


    $(document).on('change', '#topic', function (e) {
        $("#sort").val('').change();
        if ($("#topic").val() == "") {
            //$(".ploading").show();
            $("#sort").val('DESC').change();
        }
    });

//    $(window).scroll(bindScroll); 
});

function loadMore()
{
    var page = $(".video-list").data('page') + 1;
    var topic = $("#topic").val();
    var sort = $("#sort").val();

    $.ajax({
        type: 'GET',
        url: APP_URL + '/load-videos?page=' + page + '&topic=' + topic + '&sort=' + sort,
        beforeSend: function () {
            $(".overlay").show();
        },
        success: function (data) {
            console.log(data);
            if(data == ''){
                $('.load-more').hide();
            }
            $(".video-list").append(data);
            $(".video-list").data('page', page);
//            if (data != ''){
//                $(window).bind('scroll', bindScroll);
//            }
            $(".overlay").hide();

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + errorThrown);
            $(".overlay").hide();
//            $(window).bind('scroll', bindScroll);
        }
    });
//   $(window).bind('scroll', bindScroll);

}



//function bindScroll(){    
//    if ($('.video-loading').height() <= $(window).scrollTop() + $(window).height()) {
//        $(window).unbind('scroll');
//        loadMore();
//    }
//}





