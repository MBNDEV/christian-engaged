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