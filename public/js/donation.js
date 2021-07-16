$(document).ready(function () {
    $('.delete').click(function () {
        var url = $(this).attr('data-url')
        $.confirm({
            title: 'Remove Donation Goal',
            content: 'Are you sure, you want to delete this Donation Goal!',
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

    //validate add/edit new goals
    $("#add_goal, #edit_goal").validate({
        rules: {
            title: {
                required: true
            },
            goal_amount: {
                required: true
            },
            background_image: {
                required: true,
                accept: "png|jpe?g|gif",
                filesize: 1048576
            }
        },
        messages: {
            background_image: "Background image must be jpeg,png,jpg,gif,svg, less than 1MB and must have the resolution 1000×563 or higher"
        },
    });

    $('#remove_background_image').click(function () {
        $("#backg_img_div").hide();
        $("#backgroundImageStatus").val(1);
        $("#background_image").removeAttr("disabled");
    });

});

function view_donation_details(donation, is_recurring)
{
    $('.modal-body').html('');
    var id = $(donation).data('id');
    $.ajax({
        type: "GET",
        url: APP_URL + "/manage/donation-detail?donation_id="+id+'&is_recurring='+is_recurring,
        success: function(data) {
            $('.modal-body').html(data);
            $('#donation_modal').modal('show') ;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + errorThrown);
        },
    });
}
function close_monthly_donation(donation)
{
    var id = $(donation).data('id');
    if(id.length <=0){
        return false;
    }
    $.confirm({
        title: 'Monthly Donation',
        content: 'Are you sure, you want to cancel this monthly donation!',
        buttons: {
            Yes: {
                btnClass: 'btn-danger',
                action: function () {
                    $("#donation_id").val(id);
                    $("#close-monthly-recurring").submit();
                }
            },
            No: {
                btnClass: 'btn-blue'
            }
        }
    });
}
