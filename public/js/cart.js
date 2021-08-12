$(document).ready(function () {

    document.addEventListener("visibilitychange", function () {
        if (!document.hidden)
            cartItemCount();
    });

    $(document).on('click', '#same_billing_address', function () {
        var check_status = this.checked;
        if (check_status == true) {
            $('#shipping_address_content').show();
        } else {
            $('#shipping_address_content').hide();
        }
    });

    $(document).on("click", ".add-to-cart", function (e) {
        return false;
        // var id = $(this).data('id');
        // var price = $(this).data('price');
        // var size = $(this).data('size');
        // var weight = $(this).data('weight');
        // var productid = $(this).data('productid');
        // var count = (typeof $(this).data('count') != "undefined") ? $(this).data('count') : 1;
        // var name = $(this).data('name');
        // var imageurl = $(this).data('imageurl');

        var id = $(this).attr('data-id');
        var price = $(this).attr('data-price');
        var size = $(this).attr('data-size');
        var weight = $(this).attr('data-weight');
        var productid = $(this).attr('data-productid');
        var count = (typeof $(this).attr('data-count') != "undefined") ? $(this).attr('data-count') : 1;
        var name = $(this).attr('data-name');
        var imageurl = $(this).attr('data-imageurl');
        productToAdd = {};
        productToAdd.menu_id = id;
        productToAdd.name = name;
        productToAdd.price = price;
        productToAdd.count = parseInt(count);
        productToAdd.size = size;
        productToAdd.weight = weight;
        productToAdd.productid = productid;
        productToAdd.imageurl = imageurl;
        product_cart.add_product(productToAdd);

        $(".alertify-notifier").html("");

        var message = JSON.parse(js_arr);
        //console.log(message[]);
        for (var i = 0; i < message.length; i++) {
            if (message[i]['id'] == '1') { // Add Product,id==1
                var NewMessage = message[i]['value'];
            }
        }
        alertify.success(NewMessage);

    });

    $(document).on("click", ".delete-cart-item", function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        $(".alertify-notifier").html("");
        var menu_id = $(this).attr('data-menu-id');
        // console.log(menu_id);        
        if (menu_id) {
            product_cart.delete_cart_item({'menu_id': menu_id});
            var message = JSON.parse(js_arr); //  comming from web-template.php 
            //console.log(message[]);
            for (var i = 0; i < message.length; i++) {
                if (message[i]['id'] == '4') { // Delete Product, id==4
                    var NewMessage = message[i]['value'];
                }
            }
            alertify.success(NewMessage);
            //location.reload();
            setTimeout(function () {
                location.reload();
            }, 1000);  // page refresh after 1 sec
        } else {
            alertify.error('Some error occured. Please refresh the page and try again!');
        }
    });

    $(document).on("submit", "#checkout-form", function (e) {
        e.stopPropagation();
        //e.preventDefault();       

        var count = localStorage.getItem("cart_list") == null ? 0 : localStorage.getItem("cart_list") == null ? [] : JSON.parse(localStorage.getItem("cart_list")).length;

        if (count) {
            $("#place_order").attr('disabled', 'disabled');
            $("#place_order").html('Please wait..');

        } else {
            alertify.error('Your cart is empty');
            return false;
        }

    });


    var product_cart = (function () {
        cart_list = {}, //complete cartlist object , it contains store ir and cart items
                cart_array = [];// array to store items for cart
        init = function () {

            var pre_cart = localStorage.getItem("cart_list") == null ? [] : JSON.parse(localStorage.getItem("cart_list"));// get previous cart value from localstorage.
            i = localStorage.getItem("cart_list") == null ? 0 : pre_cart.length;
            cart_list.store_item = pre_cart;
            cart_array = pre_cart;

            if (pre_cart.length > 0) {//create cart if cart has previous items(On refresh).
                update_cart();
            }

            redefined_counts();

        },
                add_product = function (product) {// Add product to cart.
                console.log(product);
                    i = cart_array.length;
                    if (cart_list.store_item.length > 0) {
                        var is_duplicate = 0;
                        cart_list.store_item.forEach(function (item, index) {

                            var old_product = get_cart_item(index);

                            if (old_product.menu_id == product.menu_id) { // Check if item alrady exist in cart.

                                updated_product = update_product_incerease(index,product.count);// update quantity of product
                                cart_list.store_item[index] = updated_product;// replace product.
                                is_duplicate = 1;

                            }
                        });

                        if (is_duplicate == 0) {// if item is not added yet on cart

                            cart_array[i++] = product;
                            cart_list.store_item = cart_array;

                        }

                    } else {

                        cart_array[i++] = product;
                        cart_list.store_item = cart_array;
                    }

                    update_cart();
                    redefined_counts();
                },
                minus_product = function (product) {
                    if (cart_list.store_item.length > 0) {

                        cart_list.store_item.forEach(function (item, index) {

                            var old_product = get_cart_item(index);
                            if (old_product.menu_id == product.menu_id) { // Check if item alrady exist in cart.

                                var updated_product = update_product_decerease(index);

                                if (updated_product.count == 0) {
                                    cart_list.store_item.splice(index, 1);
                                    $("#menu_" + old_product.menu_id).val('0');
                                } else {
                                    cart_list.store_item[index] = updated_product;
                                }
                                // replace product.

                            }
                        });
                    }

                    update_cart();
                    redefined_counts();
                },
                update_cart = function () {
                    //cart_html = '';
                    var cart_total = 0;
                    if (cart_list.store_item.length == 0) {
                        localStorage.removeItem('cart_list');
                    }
                    cart_list.store_item.forEach(function (item) {

                        if (item == null) {
                            return false;
                        }

                        var total_product_price = 0;
                        var product_name = item.name;
                        var price = item.price * item.count;
                        var unit = item.unit;
                        var image = item.product_image;
                        total_product_price += price;

                    });

                    $('#cartDetail em').html('' + cart_list.store_item.length + '');

                    if (cart_list.store_item.length != 0) {
                        localStorage.setItem("cart_list", JSON.stringify(cart_list.store_item));
                    }



                },
                remove_duplicate = function (cart_list) {

                    var isDuplicate = cart_list.some(function (item, idx) {
                        return cart_list.indexOf(item) != idx
                    });

                },
                update_product_incerease = function (i,count=1) {
                    var product = cart_list.store_item[i];
                    product.count = product.count + count;
                    return product;

                },
                update_product_decerease = function (i) {

                    var product = cart_list.store_item[i];
                    product.count = product.count - 1;
                    return product;

                },
                get_cart_item = function (i) {
                    return cart_list.store_item[i];
                },
                delete_cart_item = function (product) {

                    cart_list.store_item.forEach(function (item, index) {
                        // get cart item

                        var old_product = get_cart_item(index);
                        if (old_product.menu_id == product.menu_id) { // Check if item alrady exist in cart.

                            cart_list.store_item.splice(index, 1);
                            $("#menu_" + old_product.menu_id).val('0');

                        }
                        update_cart();
                        redefined_counts();

                    });

                },
                redefined_counts = function () {
                    cart_list.store_item.forEach(function (item, index) {
                        // get cart item

                        var old_product = get_cart_item(index);

                        $("#menu_" + old_product.menu_id).val(old_product.count);

                    });

                }

        is_empty = function () {
            return !cart_list.length;
        },
                clone = function (arr) {
                    var clonedArray = $.map(arr, function (obj) {
                        return $.extend(true, {}, obj);
                    });

                    return clonedArray;
                }

        // initialize the product Cart
        init();

        return {
            add_product: add_product,
            minus_product: minus_product,
            delete_cart_item: delete_cart_item
        }
    })();

    $(document).on('click', '.incr', function () {
        var name = $(this).data('id');
        var ele = document.getElementsByName(name);
        var currentValue = $(ele).val();
        $(ele).val(parseInt(currentValue) + 1);
        product_cart.add_product({'menu_id': $(this).attr('data-menuid')});
        cartItems();
    });

    $(document).on('click', '.decr', function () {
        var name = $(this).data('id');
        var ele = document.getElementsByName(name);
        var currentValue = $(ele).val();
        if (parseInt(currentValue) - 1 > 0) {
            $(ele).val((currentValue) - 1);
            product_cart.minus_product({'menu_id': $(this).attr('data-menuid')});
            cartItems();
        }
    });

    // product list page
    $(document).on('click', '.quantity-right-plus', function () {
        var name = $(this).find('.incr_list').data('id');
        var product_id = $(this).find('.incr_list').attr('data-menuid');
        var ele = document.getElementsByName(name);
        var currentValue = $(ele).val();
        $(ele).val(parseInt(currentValue) + 1);
        $('.add_to_card_list_page' + product_id).attr('data-count', parseInt(currentValue) + 1);
    });

    $(document).on('click', '.quantity-left-minus', function () {
        
        var name = $(this).find('.decr_list').data('id');
        var product_id = $(this).find('.decr_list').attr('data-menuid');
        var ele = document.getElementsByName(name);
        var currentValue = $(ele).val();
        if (parseInt(currentValue) - 1 > 0) {
            $(ele).val((currentValue) - 1);
            $('.add_to_card_list_page' + product_id).attr('data-count', parseInt(currentValue) - 1);
        }
    });
    // end product list page 

    // recommended product at product details page
    $(document).on('click', '.incr_rec', function () {
        var name = $(this).data('id');
        var product_id = $(this).data('menuid');
        var ele = document.getElementsByName(name);
        var currentValue = $(ele).val();
        $(ele).val(parseInt(currentValue) + 1);
        $('.add_to_card_rec_page' + product_id).attr('data-count', parseInt(currentValue) + 1);
    });

    $(document).on('click', '.decr_rec', function () {
        var name = $(this).data('id');
        var product_id = $(this).data('menuid');
        var ele = document.getElementsByName(name);
        var currentValue = $(ele).val();
        if (parseInt(currentValue) - 1 > 0) {
            $(ele).val((currentValue) - 1);
            $('.add_to_card_rec_page' + product_id).attr('data-count', parseInt(currentValue) - 1);
        }
    });
    // End recommended product at product details page



});


function cartItems() {
    //Get cart item count
    var count = localStorage.getItem("cart_list") == null ? 0 : localStorage.getItem("cart_list") == null ? [] : JSON.parse(localStorage.getItem("cart_list")).length;
    var orderhtml = '';
    var sizecheckdisplay = true;
    if (count) {

        var cart_list = localStorage.getItem("cart_list");
        var product_image = '';
        var product_name = '';
        var product_price = '';
        var product_size = '';
        var product_weight = '';
        var product_sku = '';
        var product_productid = '';
        var product_qty = '';
        var product_id = '';
        var total_amount = 0;
        var total_weight = 0;
        var total_shipping_cost = 0;

        $(jQuery.parseJSON(cart_list)).each(function () {

            product_id = this.menu_id;
            product_image = this.imageurl;
            product_size = this.size;
            product_weight = parseFloat(this.weight).toFixed(2);
            product_sku = this.menu_id;
            product_productid = this.productid;
            product_price = parseFloat(this.price).toFixed(2);
            product_name = this.name;
            product_qty = this.count;
            total_amount += (product_qty * product_price);
            total_weight += (product_qty * product_weight);

            //Table row html start
            orderhtml += "<tr class='cart_item'>";

            orderhtml += "<td class='product-thumb'><a href='#'><img src='" + product_image + "' class='product-image'  width='60' height='60' onerror=this.src='" + APP_URL + "/images/no_image.png'></a></td>";
            orderhtml += "<td class='product-name' data-title='Product'><a href='#'>" + product_name + "</a></td>";
            if(product_size.length > 0)
                sizecheckdisplay = false;

            product_size = product_size.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });
            orderhtml += "<td class='product-price sizeshowtable' data-title='Size'>" + product_size + "</td>";
            orderhtml += "<td class='product-price' data-title='Price'>$" + product_price + "</td>";
            orderhtml += "<td class='product-qty' data-title='Quantity'><div class='qty'><span class='decr' data-id=cart[" + product_id + "][qty]  data-menuid=" + product_id + ">-</span><input id='cart_qnty' class='' value='" + product_qty + "' min='0' max='' name='cart[" + product_id + "][qty]' value='1' title='Qty' size='4' pattern='[0-9]*' inputmode='numeric' autocomplete='off' type='text'><span class='incr' data-id=cart[" + product_id + "][qty] data-menuid=" + product_id + ">+</span></div></td>";
            orderhtml += "<td class='product-total' data-title='Total'>$" + parseFloat(product_price * product_qty).toFixed(2) + "</td>";
            orderhtml += "<td class='product-action'><a href='javascript:void(0)' class='delete-cart-item' title='Remove this item' data-menu-id='" + product_id + "'><i class='fa fa-trash-o'></i></a></td>";

            orderhtml += "</tr>";
            //Table row html end

        });
        for(var cost in shipping_cost_list){
            if(parseFloat(shipping_cost_list[cost]['start_range']) <= total_weight && total_weight <= parseFloat(shipping_cost_list[cost]['end_range'])){
                total_shipping_cost = parseFloat(shipping_cost_list[cost]['cost']).toFixed(2);
                break;
            }
        }
        $('#shop_table tbody').html(orderhtml);
        $('.total-amount').html('$' + parseFloat(total_amount).toFixed(2));
        $('.total-shipping-amount').html('$' + parseFloat(total_shipping_cost).toFixed(2));
        $('.grand-total-amount').html('$' + parseFloat((total_amount+ parseFloat(total_shipping_cost))).toFixed(2));
        $('.cart_totals').show();
    } else {
        $('#shop_table tbody').html('<tr><td colspan=6>Cart is empty</td></tr>');
        $('.cart_totals').hide();
    }
    if(sizecheckdisplay){
        $('.sizeshowtable').hide();
    }
}

function checkoutItems() {
    //Get cart item count
    var count = localStorage.getItem("cart_list") == null ? 0 : localStorage.getItem("cart_list") == null ? [] : JSON.parse(localStorage.getItem("cart_list")).length;
    var orderhtml = '';
    var sizecheckdisplay = true;
    if (count) {

        var cart_list = localStorage.getItem("cart_list");
        var product_image = '';
        var product_name = '';
        var product_price = '';
        var product_qty = '';
        var product_id = '';
        var product_size = '';
        var product_weight = '';
        var product_sku = '';
        var product_productid = '';
        var total_amount = 0;
        var products = [];
        var total_weight = 0;
        var total_shipping_cost = 0;

        $(jQuery.parseJSON(cart_list)).each(function () {

            product_id = this.menu_id;
            product_image = this.imageurl;
            product_price = parseFloat(this.price).toFixed(2);
            product_name = this.name;
            product_qty = this.count;
            product_size = this.size;
            product_weight = parseFloat(this.weight).toFixed(2);
            product_sku = this.menu_id;
            product_productid = this.productid;
            total_amount += (product_qty * product_price);
            total_weight += (product_qty * product_weight);

            products.push({'product_sku':this.menu_id,'product_id': this.productid, 'sale_price': this.price, 'quantity': this.count});


            //Table row html start
            orderhtml += "<tr class='cart_item'>";
            orderhtml += "<td class='product-thumb'><a href='#'><img src='" + product_image + "' class='product-image'  width='60' height='60' onerror=this.src='" + APP_URL + "/images/no_image.png'></a></td>";
            orderhtml += "<td class='product-name' data-title='Product'>" + product_name + "</td>";
            if(product_size.length > 0)
               sizecheckdisplay = false;
            product_size = product_size.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });
            orderhtml += "<td class='product-price sizeshowtable'>" + product_size + "</td>";
            orderhtml += "<td class='product-price'>" + product_price + "</td>";
            orderhtml += "<td class='product-qty'>" + product_qty + "</td>";
            orderhtml += "<td class='product-subtotal' data-title='Total'>$" + product_price + " * " + product_qty + " = $" + parseFloat(product_price * product_qty).toFixed(2) + "</td>";

            orderhtml += "</tr>";
            //Table row html end

        });
        for(var cost in shipping_cost_list){
            if(parseFloat(shipping_cost_list[cost]['start_range']) <= total_weight && total_weight <= parseFloat(shipping_cost_list[cost]['end_range'])){
                total_shipping_cost = parseFloat(shipping_cost_list[cost]['cost']).toFixed(2);
                break;
            }
        }
        $('#products').val(JSON.stringify(products));

        $('#order_amount').val(total_amount);
        $('#shipping_amount').val(parseFloat(total_shipping_cost).toFixed(2));

        $('#shop_table tbody').html(orderhtml);
        $('.total-amount').html('$' + parseFloat(total_amount).toFixed(2));
        $('.total-shipping-amount').html('$' + parseFloat(total_shipping_cost).toFixed(2));
        $('.grand-total-amount').html('$' + parseFloat((total_amount+ parseFloat(total_shipping_cost))).toFixed(2));
        $('.cart_totals').show();
    } else {
        $('#checkout_table tbody').html('<tr><td colspan=6>Cart is empty</td></tr>');
        $('.cart_totals').hide();
    }
    if(sizecheckdisplay){
        $(".sizeshowtable").hide();
    }
}

function cartItemCount() {
    var count = localStorage.getItem("cart_list") == null ? 0 : localStorage.getItem("cart_list") == null ? [] : JSON.parse(localStorage.getItem("cart_list")).length;
    $('#cartDetail em').html('' + count + '');
    //cartItems();
    //checkoutItems();
}





