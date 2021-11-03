/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor. * 
 */
    //validate add new page
    $("#edit-template").validate({
        ignore: [],
        debug: false,
        rules: {
            subject: {
                required: true     
            },
            publish_status: {
                required: true,
            },
            
            message: {
                required: function (textarea) {
                    CKEDITOR.instances[textarea.id].updateElement(); // update textarea
                    var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
                    return editorcontent.length === 0;
                }
            }

        },
        errorPlacement: function (error, element) {
            if (element.attr("subject") == "template") {
                error.appendTo('#cke_editor1');
            } else {
                error.insertAfter(element);
            }
        }

    });


    // this is for template management 
    $(function () {
        // Replace the <textarea id="editor_eml_temp"> with a CKEditor
        CKEDITOR.replace('editor_eml_temp', {
            fullPage: true,
            allowedContent: true
        })
    });

    //send test email
    $('.temp-err').css('margin-top', '5px');
    $('.temp-err').css('color', 'red');
    $('.temp-err').hide();
    $('#temp_send_btn').on('click', function() {
        $('.temp-err').hide();
        $.ajax({
            type : "POST",
            dataType : "json",
            url : "/manage/send-test-email",
            data : {
                email: $('#test_email').val(),
                subject: $('#test_subject').val(),
                message: $('#test_message').val(),
                temp_id: $('#test_id').val(),
            },
            success: function(response) {
                console.log(response)
                if(response['status'] == true) {
                    $('.temp-err').css('color', 'green');
                    $('.temp-err').text('email sent')
                    $('.temp-err').show()
                } else {
                $('.temp-err').text('sending mail error')
                $('.temp-err').show()
                }
            },
            error: function(err) {
                console.log(err)
                $('.temp-err').text('input required fields')
                $('.temp-err').show()
            }
        })
    })