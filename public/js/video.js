$(document).ready(function () {
       
    $('.delete').click(function () {
        var url = $(this).attr('data-url')
        $.confirm({
            title: 'Remove Video',
            content: 'Are you sure, you want to delete this video!',
            buttons: {
                confirm: {
                    btnClass: 'btn-danger',
                    action: function () {
                        window.location = url;
                    }
                },
                cancel: {
                    btnClass: 'btn-blue'
                }
            }
        });
    });

    //validate add/edit new video
    $("#add_video, #edit_video").validate({
        
        ignore: [],
        debug: false,
        rules: {            
            video_title: {
                required: true
            },
            video_url: {
                required: true
            },
            topic_id: {
                required: true
            },
            video_image: { 
                required: true, 
                accept: "png|jpe?g|gif|jpg|gif|svg", 
                filesize: 1048576  
            }, 
            source: {
                required: function(textarea) {
                CKEDITOR.instances[textarea.id].updateElement();
                var editorcontent = textarea.value.replace(/<[^>]*>/gi, '');
                return editorcontent.length === 0;
                }
            },
            transcript: {
                required: function(textarea) {
                    CKEDITOR.instances[textarea.id].updateElement();
                    var editorcontent = textarea.value.replace(/<[^>]*>/gi, '');
                    return editorcontent.length === 0;
                }
            },
            
            video_description: {
                required: function (textarea) {
                    CKEDITOR.instances[textarea.id].updateElement(); // update textarea
                    var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
                    return editorcontent.length === 0;
                }
            },            
            video_duration : {
                required: true
            }            
        },

        errorPlacement: function (error, element) {            
            if (element.attr("name") == "source") {                
                error.insertAfter('#cke_source');
            } else if (element.attr("name") == "transcript") {
                error.insertAfter('#cke_transcript');
            } else if (element.attr("name") == "video_description") {
                error.insertAfter('#cke_video_description');
            } else {
                error.insertAfter(element);
            }
        }   
    });

    var fixHelper = function (e, ui) {
        ui.children().each(function () {
            $(this).width($(this).width());
        });
        return ui;
    };
    
    $('tbody').sortable({
        helper: fixHelper,
        start: function (event, ui) {
            ui.item.css('background-color', '#fafafa');
        },
        stop: function (event, ui) {
            // ui.item.addClass("ui-state-highlight");
            ui.item.css('background-color', '#fff');
        },
        cancel: ".disable-sort-item"
    });
    
    $('div.video-list').sortable({
        helper: fixHelper,
        start: function (event, ui) {
            ui.item.css('background-color', '#fafafa');
        },
        stop: function (event, ui) {
            // ui.item.addClass("ui-state-highlight");
            ui.item.css('background-color', '#fff');
        }
    });

    $('div.video-list').sortable("disable");
    $('tbody').sortable("disable");
    $(".sort-row").click(function (e) {
        e.preventDefault();
        $('.save-video-sort').show();
        $(".sort-row").hide();
        $('tbody').sortable("enable");
        $('#cancel-video').removeClass('hide');
    });
    $("#cancel-video").click(function (e) {
        e.preventDefault();
        $('#cancel-video').addClass('hide');
        $('.save-video-sort').hide();
        $(".sort-row").show();
        $('tbody').sortable("disable");
    });
    
    $("#enable-featured-sort").click(function (e) {
        e.preventDefault();
        $('#cancel-featured').removeClass('hide');
        $('#save-featured').removeClass('hide');
        $("#enable-featured-sort").addClass('hide');
        $('div.video-list').sortable("enable");
    });
    
    $("#cancel-featured").click(function (e) {
        e.preventDefault();
        $('#cancel-featured').addClass('hide');
        $('#save-featured').addClass('hide');
        $("#enable-featured-sort").removeClass('hide');
        $('div.video-list').sortable("disable");
    });
    
    $(document).on('click', '#save-featured', function (e) {
        var url = $(this).data('url');
        var arr = [];
        $("div.video-list div").each(function () {
            arr.push(this.id);
        });
        
        $('#save-featured').html('Saving....');
        $('#save-featured').attr('disabled', 'disabled');

        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {videoList: arr},
            success: function (data) {
                
                if (data.success) {
                    alertify.success('Sorting order saved successfully');
                    document.location.reload();
                }

            },
            error: function (error) {
                alertify.error('There is some issue please sort after some times.'); 
                $('#save-featured').html('Save Sorting');
                $('#save-featured').removeAttr('disabled');
            }
        });
    });
    
    $(document).on('click', '.save-video-sort', function (e) {
        var url = $(this).data('url');
        var arr = [];
        $("tbody tr").each(function () {
            arr.push(this.id);
        });
        
        $('.save-video-sort').html('Saving....');
        $('.save-video-sort').attr('disabled', 'disabled');

        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {videoList: arr},
            success: function (data) {
                
                if (data.success) {
                    alertify.success('Sorting order saved successfully');
                    document.location.reload();
                }

            },
            error: function (error) {
                alertify.error('There is some issue please sort after some times.'); 
                $('.save-video-sort').html('Save Sorting');
                $('.save-video-sort').removeAttr('disabled');
            }
        });
    });

    $('#selectTopicFilter').on('change', function () {
        var a = $('#selectTopicFilter :selected').val();
        if (a == "all") {
           window.location.href = '/manage/videos/';
           return;
        }
        if (a == "") {
            return false;
        }
        window.location.href = '/manage/videos/' + a;
    });

    $('#remove_vedio_image').click(function () {
        $("#vedio_image_div").hide();
        $("#vedioImageStatus").val(1);
        $("#video_image").removeAttr("disabled");
    });
    
    $('#remove_spdf_image').click(function () {
        $("#spdf_image_div").hide();
        $("#spdfImageStatus").val(1);
        $("#source_pdf").removeAttr("disabled");
    });

    $('#remove_tpdf_image').click(function () {
        $("#tpdf_image_div").hide();
        $("#tpdfImageStatus").val(1);
        $("#transcript_pdf").removeAttr("disabled");
    });

    $(document).on('click', '#remove_featured_image', function (e) {        
        $("#featured_image_div").hide();
        $("#featuredImageStatus").val(1);
        $("#featured_image").removeAttr("disabled");
    });


 $(document).on('click','#cancel-video',function(){
   location.reload();
  })    

});

$('.new-video').click(function(event){
    var id = $(this).val();
       $.ajax({
            type: "POST",
            url: "/manage/update-new-video",
            dataType: "json",
            data: {id: id},
            success: function (data) {
                if (data.success) {
                    alertify.success('New video updated successfully');
                    document.location.reload();
                }

            },
            error: function (error) {
                alertify.error('There is some issue please sort after some times.'); 
            }
        });
});



CKEDITOR.replace( 'source' );    
CKEDITOR.replace( 'transcript' );
CKEDITOR.replace( 'video_description' );

