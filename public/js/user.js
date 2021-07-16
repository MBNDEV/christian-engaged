$(document).ready(function () {
    $('.delete').click(function () {
        var url = $(this).attr('data-url')
        $.confirm({
            title: 'Remove user',
            content: 'Are you sure to remove this user!',
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

    //add new method for  email validation
    jQuery.validator.addMethod("accept", function (value, element, param) {
        return value.match(new RegExp("^" + param + "$"));
    }, 'Please enter a valid email address.');

    jQuery.validator.addMethod("alpha", function (value, element, param) {
        return value.match(new RegExp("^" + param + "$"));
    }, 'This field should be alphabets.');

    jQuery.validator.addMethod("phone", function (value, element, param) {
        return value.match(new RegExp("^" + param + "$"));
    }, 'Phone number should be 10 digits.');


    // validate admin login
    $("#login-form").validate({
        rules: {
            email: {
                required: true,
                accept: "[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}"
            },
            password: {
                required: true
            }
        }
    });


    //validate add new user
    $("#add_user").validate({
        rules: {
            first_name: {
                required: true,
                maxlength: 190
                //alpha: "[a-zA-Z\s]+"

            },
            last_name: {
                required: true,
                maxlength: 190
                //alpha: "[a-zA-Z\s]+"
            },
            email: {
                required: true,
                maxlength: 190,
                accept: "[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}"
            },            
            password: {
                required: true,
                minlength: 6
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            }

        }
    });

    //validate on update user
    $("#edit_user").validate({
        rules: {
            first_name: {
                required: true,
                maxlength: 190
               // alpha: "[a-zA-Z\s]+"

            },
            last_name: {
                required: true,
                maxlength: 190
                //alpha: "[a-zA-Z\s]+"
            },
            email: {
                required: true,
                maxlength: 190,
                accept: "[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}"
            },
            password: {
                required: function(element) {
                    return $('#password').val() || $('#password_confirmation').val();
                },
                minlength: 6
            },
            password_confirmation: {
                required: function(element) {
                    return $('#password').val() || $('#password_confirmation').val();
                },
                equalTo: "#password"
            }

        }
    });
    
    //Check/Uncheck the main checkbox on click
    $('#check_all_user').on('click', function() {
        
        var check_status = this.checked;
        
        if (check_status == true) {
            $('#change_status_user').show();
            $("input[name='check_user[]']").prop("checked", true);
        } else {
            $('#change_status_user').hide();
            $("input[name='check_user[]']").prop("checked", false);
        }
    });
    
    //Check/Uncheck the main checkbox on click of child checkboxes
    $("input[name='check_user[]']").click(function () {    
        
        if($("input[name='check_user[]']:checked").length)
            $('#change_status_user').show();
        else
            $('#change_status_user').hide();

        if($("input[name='check_user[]']:checked").length == $("input[name='check_user[]']").length)
        {
            $('#check_all_user').prop('checked', true);
        } else {
            $('#check_all_user').prop('checked', false);
        }
    });
    
    
    
    $('#change_status_user .change_status').on('click', function() {
        var status_value = $(this).data("val");        
        if($.isNumeric(status_value)){
            
            var records = $("input[name='check_user[]']:checked");
            var checked_elements = records.length;
            
            if(checked_elements == 0){
                alert('Please select atleast one record first');
                $('#change_status_user').val('');
                return false;
            } else {
                
                if(status_value == 3){
                    var confirm_msg = "Are you sure you want to delete selected item(s)?";
                    var success_mg = "Record(s) deleted successfully";
                } else {
                    var confirm_msg = "Are you sure you want to change status of selected item(s)?";
                    var success_mg = "Status changed successfully";
                }
                
                var chkd_values = [];
                $(records).each(function(){
                    chkd_values.push($(this).data("id"));
                });

                $.confirm({
                    title: 'Change User Status',
                    content: confirm_msg,
                    buttons: {
                        confirm: {
                            btnClass: 'btn-danger',
                            action: function () {
                                $('#bulkuserUpdate').submit();
                            }
                        },
                        cancel: {
                            btnClass: 'btn-blue'
                        }
                    }
                });
                
            }
        }
    });
    
    
    
    


});

