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
        var str = '<div class="row sizearea'+count+'"> <div class="col-md-2"> <label for="product_size'+count+'">Product Size</label> <select name="product_size'+count+'" id="product_size'+count+'" class="form-control"> '+optionstr+'</select> <span class="help-block" id="product_size_error'+count+'" style="color:red;"> </span> </div> <div class="col-md-2"> <label for="product_sku'+count+'">Product SKU </label> <input type="text" class="form-control" maxlength="50" class="form-control" name="product_sku'+count+'" id="product_sku'+count+'" value="" placeholder="Enter Product SKU '+count+'"> <span class="help-block" id="product_sku_error'+count+'" style="color:red;"> </span> </div> <div class="col-md-2"> <label for="product_weight'+count+'">Product Weight </label> <input type="number" class="form-control" name="product_weight'+count+'" id="product_weight'+count+'" value="" placeholder="Enter Product Weight '+count+'"> <span class="help-block" id="product_weight_error'+count+'" style="color:red;"> </span> </div> </div>';
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
            $('#sizearea').html('<div class="row"> <div class="col-md-6"> <button class="btn btn-primary" type="button" id="addsizebtn">Add Size</button> <button type="button" class="btn btn-danger" id="removesizebtn" disabled="" style="display:none;">Remove last row</button> </div> </div> <div class="row sizearea'+count+'"> <div class="col-md-2"> <label for="product_size'+count+'">Product Size</label> <select name="product_size'+count+'" id="product_size'+count+'"  class="form-control"> '+optionstr+'</select> <span class="help-block" id="product_size_error'+count+'" style="color:red;"> </span> </div> <div class="col-md-2"> <label for="product_sku'+count+'">Product SKU </label> <input type="text" class="form-control" maxlength="50" class="form-control" name="product_sku'+count+'" id="product_sku'+count+'" value="" placeholder="Enter Product SKU '+count+'"> <span class="help-block" id="product_sku_error'+count+'" style="color:red;"> </span> </div> <div class="col-md-2"> <label for="product_weight'+count+'">Product Weight </label> <input type="number" class="form-control" name="product_weight'+count+'" id="product_weight'+count+'" value="" placeholder="Enter Product Weight '+count+'"> <span class="help-block" id="product_weight_error'+count+'" style="color:red;"> </span> </div> </div>');
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
                            $('#sizearea').hide();
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
                skuset["#product_sku_error"+i] = $("#product_sku"+i).val();
                uniqueSize.push($("#product_size"+i).val());
            }
            $.ajax({
                type : "POST",
                url  : APP_URL + "/manage/product/checkuniquesuk",   
                data : {'type':'add','sku':skuset},
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
    
    $('#change_status_order').on('submit', function(e){
        e.preventDefault();
        var formData = $(this).serializeArray();
        $.ajax({
            type : "POST",
            url  : APP_URL + "/manage/orders/change_status",   
            data : formData,
            success: function(data) {
                var result = JSON.parse(data);
                if(result.status=='success'){
                    $('#changestatus_modal').modal('hide') ; 
                    alertify.success('Status updated successfully');
                    $('#changestatus_modal').on('hidden.bs.modal', function () {                        
                        window.location.reload();
                    });
                }else{
                    alertify.error(result.message);
                }       
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus + errorThrown);
            },
        });
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
        $('.save-product-sort').show();
        $(".sort-row").hide();
        $("#cancel").show();
        $('tbody').sortable("enable");
    });
    
    $(document).on('click', '.save-product-sort', function (e) {
        var arr = [];
        $("tbody tr").each(function () {
            arr.push(this.id);
        });
        
        $('.save-product-sort').html('Saving....');
        $('.save-product-sort').attr('disabled', 'disabled');

        $.ajax({
            type: "POST",
            url: "/manage/product-categories/category-sort",
            dataType: "json",
            data: {categorylist: arr},
            success: function (data) {
                
                if (data.success) {
                    alertify.success('Sorting order saved successfully');
                    document.location.reload();
                }

            },
            error: function (error) {
                alertify.error('There is some issue please sort after some times.');        
                $('.save-product-sort').html('Save Sorting');
                $('.save-product-sort').removeAttr('disabled');
            }
        });
    });

});

$(document).on('click','#cancel',function(e){
    location.reload();
});

function view_order(order)
{
    $('#order_modal .modal-body').html('');
    var id = $(order).data('id');    
    $.ajax({
        type: "GET",
        url: APP_URL + "/manage/orders/detail?order_id="+id,        
        success: function(data) {
            $('#order_modal .modal-body').html(data);
            $('#order_modal').modal('show') ;            
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + errorThrown);
        },
    });
}

function change_order_status(order)
{    
    $('#order_id').val($(order).data('id'));
    $('#order_status').val($(order).data('status'));
    $('#changestatus_modal').modal('show') ;    
}

CKEDITOR.replace( 'product_description' );