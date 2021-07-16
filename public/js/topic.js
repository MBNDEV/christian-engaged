$(document).ready(function () {
    $('.delete').click(function () {
        var url = $(this).attr('data-url')
        $.confirm({
            title: 'Video Topics',
            content: 'Removing this topic will also delete all the videos under this topic. Are you sure you want to delete this topic?',
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

    //validate add new video topic
    $("#add_videotopic, #edit_videotopic").validate({
        rules: {            
            video_topic: {
                required: true,
                maxlength: 190
            },
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

    $('tbody').sortable("disable");
    $(".sort-row").click(function (e) {
        e.preventDefault();
        $('.save-video-sort').show();
        $(".sort-row").hide();
        $("#cancel").show();
        $('tbody').sortable("enable");
    });
    
    $(document).on('click', '.save-video-sort', function (e) {
        var arr = [];
        $("tbody tr").each(function () {
            arr.push(this.id);
        });
        
        $('.save-video-sort').html('Saving....');
        $('.save-video-sort').attr('disabled', 'disabled');

        $.ajax({
            type: "POST",
            url: "/manage/videotopics/topic-sort",
            dataType: "json",
            data: {categorylist: arr},
            success: function (data) {
                
                if (data.success) {                    
//                    var i = 0;
//                    $("tbody tr").each(function () {
//                        $(this).find('.serial_no').html(i);
//                        i++;
//                    });
//                    $('.save-video-sort').hide();
//                    $(".sort-row").show();
//                    $('tbody').sortable("disable");
                    alertify.success('Sorting order saved successfully');
                    document.location.reload();
//                    $('.save-video-sort').html('Save Sorting');
//                    $('.save-video-sort').removeAttr('disabled');
                }

            },
            error: function (error) {
                alertify.error('There is some issue please sort after some times.');        
                $('.save-video-sort').html('Save Sorting');
                $('.save-video-sort').removeAttr('disabled');
            }
        });
    });
    
});

