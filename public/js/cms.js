// @Author: Mukesh kumar jha

$(document).ready(function () {
    $('.delete').click(function () {
        var url = $(this).attr('data-url')
        $.confirm({
            title: 'Remove page',
            content: 'Are you sure to remove this page!.',
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

    jQuery.validator.addMethod("alpha", function (value, element, param) {
        return value.match(new RegExp("^" + param + "$"));
    }, 'This field should be alphabets.');



    //validate add new page
    $("#add_page").validate({
        ignore: [],
        debug: false,
        rules: {
            page_title: {
                required: true
                //maxlength: 60,
               // alpha: "[a-zA-Z\s]+"

            },
            page_url: {
                required: true
                //maxlength: 60,
                //alpha: "[a-zA-Z]+"
            },
            status: {
                required: true
            },
            page_content: {
                required: function (textarea) {
                    CKEDITOR.instances[textarea.id].updateElement(); // update textarea
                    var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
                    return editorcontent.length === 0;
                }
            }

        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "page_content") {
                error.appendTo('#cke_editor1');
            } else {
                error.insertAfter(element);
            }
        }

    });


//validate add new page
    $("#edit_page").validate({
        ignore: [],
        debug: false,
        rules: {
            page_title: {
                required: true
               // maxlength: 60,
                //alpha: "[a-zA-Z\s]+"

            },
            page_url: {
                required: true
                //maxlength: 60,
               // alpha: "[a-zA-Z]+"
            },
            status: {
                required: true
            },
            page_content: {
                required: function (textarea) {
                    CKEDITOR.instances[textarea.id].updateElement(); // update textarea
                    var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
                    return editorcontent.length === 0;
                }
            }

        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "page_content") {
                error.appendTo('#cke_editor1');
            } else {
                error.insertAfter(element);
            }
        }

    });



});