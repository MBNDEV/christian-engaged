$(document).ready(function () {
    $('.delete').click(function () {
        var url = $(this).attr('data-url')
        $.confirm({
            title: 'Remove page',
            content: 'Are you sure to remove this leader!.',
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
    
    $('#removeprofileImage').click(function () {     
        $("#profile_pic_div").hide();
        $("#profilepicStatus").val(1);
        $("#profile_pic").removeAttr("disabled");
    });
    
});