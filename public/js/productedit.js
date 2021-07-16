$(document).ready(function () {
    var optionstr = '';

    for(var val in sizearray){
        optionstr += '<option value="'+val+'">'+sizearray[val]+'</option>';
    }

    $(document).on('click','#addsizebtn',function(){
        if(count >= 1){
            $('#removesizebtn').show();
            $('#removesizebtn').attr('disabled',false);        
        }
        if(count >= 6)
            $(this).attr('disabled',true);
        if(count >= 7)
            return false;
        count++;
        var str = '<div class="row sizearea'+count+'"> <div class="col-md-2"> <label for="product_size'+count+'">Product Size</label> <select name="product_size'+count+'" class="form-control" id="product_size'+count+'"> '+optionstr+'</select> <span class="help-block" id="product_size_error'+count+'" style="color:red;"> </span> </div> <div class="col-md-2"> <label for="product_sku'+count+'">Product SKU </label> <input type="text" class="form-control" maxlength="50" class="form-control" name="product_sku'+count+'" id="product_sku'+count+'" value="" placeholder="Enter Product SKU"> <span class="help-block" id="product_sku_error'+count+'" style="color:red;"> </span> </div> <div class="col-md-2"> <label for="product_weight'+count+'">Product Weight </label> <input type="number" class="form-control" min="0" name="product_weight'+count+'" id="product_weight'+count+'" value="" placeholder="Enter Product Weight"> <span class="help-block" id="product_weight_error'+count+'" style="color:red;"> </span> </div> </div>';
        $('#sizearea').append(str);
    });
    $(document).on('click','#removesizebtn',function(){
        if(count <= 7)
            $('#addsizebtn').attr('disabled',false);        
        if(count <= 2){
            $(this).hide();
            $(this).attr('disabled',true);
        }
        if(count < 1)
            return false;

        $(".sizearea"+count).remove();
        count--;
    });

    $('.addsize').click(function(){
        if($("#sizeyes").is(":checked")){
            count=1;
            $('#sizearea').html('<div class="row"> <div class="col-md-6"> <button class="btn btn-primary" type="button" id="addsizebtn">Add Size</button> <button type="button" class="btn btn-danger" id="removesizebtn" disabled="" style="display:none;">Remove last row</button> </div> </div> <div class="row sizearea'+count+'"> <div class="col-md-2"> <label for="product_size'+count+'">Product Size</label> <select name="product_size'+count+'" class="form-control" id="product_size'+count+'"> '+optionstr+'</select> <span class="help-block" id="product_size_error'+count+'" style="color:red;"> </span> </div> <div class="col-md-2"> <label for="product_sku'+count+'">Product SKU </label> <input type="text" class="form-control" maxlength="50" class="form-control" name="product_sku'+count+'" id="product_sku'+count+'" value="" placeholder="Enter Product SKU"> <span class="help-block" id="product_sku_error'+count+'" style="color:red;"> </span> </div> <div class="col-md-2"> <label for="product_weight'+count+'">Product Weight </label> <input type="number" class="form-control" min="0" name="product_weight'+count+'" id="product_weight'+count+'" value="" placeholder="Enter Product Weight"> <span class="help-block" id="product_weight_error'+count+'" style="color:red;"> </span> </div> </div>');
            $("#sku").val('');
            $("#sku").attr("disabled", true);
            $("#weight").val('');
            $("#weight").attr("disabled", true);
            $('#sizearea').show();
            $("#sizerange").val('1');
        }else{ 
            $.confirm({
                title: 'Remove Product Size',
                content: 'Are you sure, you want to remove product size!',
                buttons: {
                    confirm: {
                        btnClass: 'btn-danger',
                        action: function () {
                            $('#sizearea').html('');
                            $("#sku").attr("disabled", false);
                            $("#weight").attr("disabled", false);
                            // $('#sizearea').hide();
                            $("#sizerange").val('0');
                        }
                    },
                    cancel: {
                        btnClass: 'btn-blue',
                        action: function () {
                             $("#sizeyes").prop("checked", true);
                             $("#sizeno").prop("checked", false);
                        }
                    }
                }
            });
        }
    });
    function clearerror(){
        $(".help-block").html('');
    }
    $('#submitbtn').click(function(){
        clearerror();
        if($("#sizeyes").is(":checked")){
            var uniqueSKU = [];
            var uniqueSize = [];
            var skuset = {};
            var temp_size_array = Object.keys(sizearray);
            for (var i = 1; i <= count; i++) {
                if($("#product_size"+i).val().length<=0 || temp_size_array.indexOf($("#product_size"+i).val()) =='-1'){
                    $("#product_size_error"+i).html('Invalid Product Size');
                    return false;
                }
                if(uniqueSize.indexOf($("#product_size"+i).val()) !='-1'){
                    $("#product_size_error"+i).html('Every Size should be different.');
                    return false;                    
                }
                if($("#product_sku"+i).val().length<=0){
                    $("#product_sku_error"+i).html('Invalid SKU');
                    return false;
                }
                var reg = new RegExp(/^[a-zA-z]{1}[a-zA-Z0-9-]+$/);
                if(uniqueSKU.indexOf($("#product_sku"+i).val()) !='-1' || !reg.test($("#product_sku"+i).val())){
                    $("#product_sku_error"+i).html('The sku may only contain letters, numbers, dashes and unique.');
                    return false;
                }
                reg = new RegExp(/^((\.\d+)|(\d+(\.\d+)?))$/);
                if($("#product_weight"+i).val().length<=0 || $("#product_weight"+i).val()<=0 || !reg.test($("#product_weight"+i).val())){
                    $("#product_weight_error"+i).html('Invalid weight');
                    return false;
                }
                uniqueSKU.push($("#product_sku"+i).val());
                uniqueSize.push($("#product_size"+i).val());
                skuset["#product_sku_error"+i] = $("#product_sku"+i).val();
            }
            $.ajax({
                type : "POST",
                url  : APP_URL + "/manage/product/checkuniquesuk",   
                data : {'type':'edit','productid':productid,'sku':skuset},
                success: function(data) {
                    var result = JSON.parse(data);
                    if(result.status=='success'){
                        for(var sukid in result.data){
                            if(result.data[sukid].length > 0){
                                $(sukid).html("The sku has already been taken!");
                                return false;
                            }
                        }
                        $('#size').val($('#product_size1').val());
                        $('#sku').val($('#product_sku1').val());
                        $('#weight').val($('#product_weight1').val());
                        $("#sku").attr("disabled", false);
                        $("#weight").attr("disabled", false);
                        $("#add_category").submit();
                    }else{
                        return false;
                        alertify.error(result.message);
                    }       
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus + errorThrown);
                },
            });
        }else{
            $("#add_category").submit();
            $('#size').val('');            
        }

    });




    $('.delete').click(function () {
        var url = $(this).attr('data-url')
        $.confirm({
            title: 'Remove Product',
            content: 'Are you sure to remove this product!',
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
    $("#add_category, #edit_category").validate({
        rules: {            
            product_category: {
                required: true
            },
        }
    });

    $('#removeProductImage').click(function () {
        
        $("#product_pic_div").hide();
        $("#profileImageStatus").val(1);
        $("#productImage").removeAttr("disabled");
    });
    $('#removeProductImage1').click(function () {
        
        $("#product_pic1_div").hide();
        $("#profileImage1Status").val(1);
        $("#productImage1").removeAttr("disabled");
    });
    $('#removeProductImage2').click(function () {
        
        $("#product_pic2_div").hide();
        $("#profileImage2Status").val(1);
        $("#productImage2").removeAttr("disabled");
    });

});

CKEDITOR.replace( 'product_description' );