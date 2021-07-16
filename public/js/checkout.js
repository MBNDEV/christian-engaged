
$('.Section1').click(function () {
    if (validateStep1()) {
        $("#billing_first_name").val($("#first_name").val());
        $("#billing_last_name").val($("#last_name").val());
        $("#shiping_first_name").val($("#first_name").val());
        $("#shiping_last_name").val($("#last_name").val());
        $('#Section1').removeClass('active');
        $('#Section2').addClass('active');
        $('#Section2').addClass('in');
        $('.step-2').addClass('active');
    }
});

$('.submit').click(function () {
//    $('#Section2').removeClass('active');
//    $('#Section3').addClass('active');
//    $('#Section3').addClass('in');
//    $('.step-3').addClass('active');

    if (validateStep2()) {
        createOrder();
    }

});


$('#ship').click(function () {
    if ($('#shipping').hasClass('hide')) {
        $('#shipping').removeClass('hide');
        $('#shipping').addClass('show');
    } else {
        $('#shipping').addClass('hide');
        $('#shipping').removeClass('show');
    }

});

$('.billing-back').click(function () {
    $('#Section2').removeClass('active');
    $('#Section1').addClass('active');
    $('.step-2').removeClass('active');
});


function createOrder() {
    var data = $('#info').serialize();
    var action = $('#info').attr('action');
    //alert(action);
    $.ajax({
        type: "POST",
        url: action,
        data: data,
        dataType: "json",
        success: function (result) {
            //alert(result);
            console.log(result);
            if (result.order_id) {
                //$('#payment-check')
                
                $('#reference_id').val(result.order_id);
                $('#Section2').removeClass('active');
                $('#Section3').addClass('active');
                $('#Section3').addClass('in');
                $('.step-3').addClass('active');
                // $.scrollTo('#payment-check');
                $('html, body').animate({
                    scrollTop: $("#donationTabs").offset().top
                }, 700);
            }
        }
    });
}

function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    } else {
        return false;
    }

}

function allLetter(inputtxt)
{
    var letters = /^[A-Za-z]+$/;
    if (inputtxt.match(letters))
    {
        return true;
    } else
    {
        //alert("message");
        return false;
    }
}

function clearInfoError() {
    $('#first_name_error').html('');
    $('#last_name_error').html('');
    $('#phone_error').html('');
    $('#email_error').html('');
}

function validateStep1() {
    clearInfoError();
    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    var phone = $('#phone').val();
    var email = $('#email').val();
    var valid = true;
    if ($.trim(first_name).length == 0) {
        $('#first_name_error').html('First Name required.');
        $('#first_name_error').removeClass('hide');
        valid = false;
    } else {
        if (!allLetter(first_name)) {
            $('#first_name_error').html('First Name should be alphabate.');
            $('#first_name_error').removeClass('hide');
            valid = false;
        }
    }

    if ($.trim(last_name).length == 0) {
        $('#last_name_error').html('Last Name required.');
        $('#last_name_error').removeClass('hide');
        valid = false;
    }else{
        if (!allLetter(last_name)) {
            $('#last_name_error').html('Last Name should be alphabate.');
            $('#last_name_error').removeClass('hide');
            valid = false;
        }
    }

    if ($.trim(phone).length == 0) {
        $('#phone_error').html('Phone number required.');
        $('#phone_error').removeClass('hide');
        valid = false;
    } else {
        if (!validatePhone(phone)) {
            $('#phone_error').html('Invalid phone number formate.');
            $('#phone_error').removeClass('hide');
            valid = false;
        }
    }

    if ($.trim(email).length == 0) {
        $('#email_error').html('Email required.');
        $('#email_error').removeClass('hide');
        valid = false;
    } else {
        if (!validateEmail(email)) {
            $('#email_error').html('Invalid email.');
            $('#email_error').removeClass('hide');
            valid = false;
        }
    }
    return valid;
}

function clearBillingError() {

    $('#billing_first_name_error').html('');
    $('#billing_last_name_error').html('');
    $('#billing_address_line_1_error').html('');
    $('#billing_address_line_2_error').html('');
    $('#billing_country_id_error').html('');
    $('#billing_telephone_error').html('');
    $('#billing_city_error').html('');
    $('#billing_state_error').html('');
    $('#billing_zip_code_error').html('');
}

function clearShippingError() {

    $('#shiping_first_name_error').html('');
    $('#shiping_last_name_error').html('');
    $('#shiping_address_line_1_error').html('');
    $('#shiping_address_line_2_error').html('');
    $('#shiping_country_id_error').html('');
    $('#shiping_city_error').html('');
    $('#shiping_state_error').html('');
    $('#shiping_zip_code_error').html('');
    $('#shiping_telephone_error').html('');
}

function validatePhone(phone) {

    var a = phone;
    var filter = /^[0-9-+]+$/;
    if (filter.test(a)) {

        return true;
    } else {

        return false;
    }

}

function validateStep2() {
    clearBillingError();
    var first_name = $('#billing_first_name').val();
    var last_name = $('#billing_last_name').val();
    var address_line_1 = $('#billing_address_line_1').val();
    var address_line_2 = $('#billing_address_line_2').val();
    var country = $('#billing_country_id').val();
    var phone = $('#billing_telephone').val();
    var city = $('#billing_city').val();
    var state = $('#billing_state').val();
    var zipcode = $('#billing_zip_code').val();
    var valid = true;
    if ($.trim(first_name).length == 0) {
        $('#billing_first_name_error').html('First Name required.');
        $('#billing_first_name_error').removeClass('hide');
        valid = false;
    }else{
        if (!allLetter(first_name)) {
            $('#billing_first_name_error').html('First Name should be alphabate.');
            $('#billing_first_name_error').removeClass('hide');
            valid = false;
        }
    }

    if ($.trim(last_name).length == 0) {
        $('#billing_last_name_error').html('Last Name required.');
        $('#billing_last_name_error').removeClass('hide');
        valid = false;
    }else{
        if (!allLetter(last_name)) {
            $('#billing_last_name_error').html('Last Name should be alphabate.');
            $('#billing_last_name_error').removeClass('hide');
            valid = false;
        }
    }

    if ($.trim(address_line_1).length == 0) {
        $('#billing_address_line_1_error').html('Address Line 1 required.');
        $('#billing_address_line_1_error').removeClass('hide');
        valid = false;
    }
    // if ($.trim(address_line_2).length == 0) {
    //     $('#billing_address_line_2_error').html('Address Line 2 required.');
    //     $('#billing_address_line_2_error').removeClass('hide');
    //     valid = false;
    // }
    if ($.trim(country).length == 0) {
        $('#billing_country_id_error').html('Country required.');
        $('#billing_country_id_error').removeClass('hide');
        valid = false;
    }
    if ($.trim(city).length == 0) {
        $('#billing_city_error').html('City required.');
        $('#billing_city_error').removeClass('hide');
        valid = false;
    }
    if ($.trim(state).length == 0) {
        $('#billing_state_error').html('State required.');
        $('#billing_state_error').removeClass('hide');
        valid = false;
    }
    if ($.trim(zipcode).length == 0) {
        $('#billing_zip_code_error').html('Zip code required.');
        $('#billing_zip_code_error').removeClass('hide');
        valid = false;
    }



    if ($.trim(phone).length == 0) {
        $('#billing_telephone_error').html('Phone number required.');
        $('#billing_telephone_error').removeClass('hide');
        valid = false;
    } else {
        if (!validatePhone(phone)) {
            $('#billing_telephone_error').html('Invalid phone number formate.');
            $('#billing_telephone_error').removeClass('hide');
            valid = false;
        }
    }

    if ($('#ship').is(":checked")) {
        //console.log('ewe');
        valid = validateShipping();
    } else {
        //console.log('sdds');
    }


    return valid;
}

function validateShipping() {
    clearShippingError();
    var first_name = $('#shiping_first_name').val();
    var last_name = $('#shiping_last_name').val();
    var address_line_1 = $('#shiping_address_line_1').val();
    var address_line_2 = $('#shiping_address_line_2').val();
    var country = $('#shiping_country_id').val();
    var phone = $('#shiping_telephone').val();
    var city = $('#shiping_city').val();
    var state = $('#shiping_state').val();
    var zipcode = $('#shiping_zip_code').val();
    var valid = true;
    if ($.trim(first_name).length == 0) {
        $('#shiping_first_name_error').html('First Name required.');
        $('#shiping_first_name_error').removeClass('hide');
        valid = false;
    }else{
        if (!allLetter(first_name)) {
            $('#shiping_first_name_error').html('First Name should be alphabate.');
            $('#shiping_first_name_error').removeClass('hide');
            valid = false;
        }
    }

    if ($.trim(last_name).length == 0) {
        $('#shiping_last_name_error').html('Last Name required.');
        $('#shiping_last_name_error').removeClass('hide');
        valid = false;
    }else{
        if (!allLetter(last_name)) {
            $('#shiping_last_name_error').html('Last Name should be alphabate.');
            $('#shiping_last_name_error').removeClass('hide');
            valid = false;
        }
    }

    if ($.trim(address_line_1).length == 0) {
        $('#shiping_address_line_1_error').html('Address Line 1 required.');
        $('#shiping_address_line_1_error').removeClass('hide');
        valid = false;
    }
    // if ($.trim(address_line_2).length == 0) {
    //     $('#shiping_address_line_2_error').html('Address Line 2 required.');
    //     $('#shiping_address_line_2_error').removeClass('hide');
    //     valid = false;
    // }
    if ($.trim(country).length == 0) {
        $('#shiping_country_id_error').html('Country required.');
        $('#shiping_country_id_error').removeClass('hide');
        valid = false;
    }
    if ($.trim(city).length == 0) {
        $('#shiping_city_error').html('City required.');
        $('#shiping_city_error').removeClass('hide');
        valid = false;
    }
    if ($.trim(state).length == 0) {
        $('#shiping_state_error').html('State required.');
        $('#shiping_state_error').removeClass('hide');
        valid = false;
    }
    if ($.trim(zipcode).length == 0) {
        $('#shiping_zip_code_error').html('Zip code required.');
        $('#shiping_zip_code_error').removeClass('hide');
        valid = false;
    }

    if ($.trim(phone).length == 0) {
        $('#shiping_telephone_error').html('Phone number required.');
        $('#shiping_telephone_error').removeClass('hide');
        valid = false;
    } else {
        if (!validatePhone(phone)) {
            $('#shiping_telephone_error').html('Invalid phone number formate.');
            $('#shiping_telephone_error').removeClass('hide');
            valid = false;
        }
    }


    return valid;

}


checkoutItems();



//var stripe = Stripe('pk_test_06UOJ1NFIBOZbtt4u5IbArgD');
var stripe = Stripe(STRIPE_PK);
//var action = //{{url('payment/make-payment')}}
var action = window.location.origin + "/payment/make-payment";
//var stripe = Stripe('pk_test_sDTOTFx1gcAU2QdKaZnqsXYv');
//alert(action);

// Create an instance of Elements.
var elements = stripe.elements();

var card = elements.create('cardNumber');
card.mount('#card-element');

var cardCvc = elements.create('cardCvc');
cardCvc.mount('#card-cvc');

var cardExpiry = elements.create('cardExpiry');
cardExpiry.mount('#card-expire-date');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function (event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});

$(".complete-order").on('click', function (e) {
    e.preventDefault();
    $('.complete-order').css("pointer-events", "none");
    $('.complete-order').html('processing..');
    stripe.createToken(card).then(function (result) {
        if (result.error) {
            $('.complete-order').css("pointer-events", "auto");
            $('.complete-order').html('Complete Order');
            alertify.error(result.error.message);
            console.log(result.error);
            // $('.complete-order').css("pointer-events", "none");
        } else {
            var reference = $('#reference_id').val();

            $.ajax({
                type: "POST",
                url: action,
                data: {
                    reference_id: reference,
                    stp_token: result.token.id
                },
                dataType: "json",
                success: function (result) {
                    
                    if(parseInt(result.status) == 0){
                        $('#page-wrapper').html(result.html);
                        $('#cartDetail em').html('' + 0 + '');
                    }else{
                        $('#page-wrapper').html(result.html);
                    }
                    $('html, body').animate({
                        scrollTop: $('.body-content').offset().top-40
                    }, 100);
                }
            });

            // console.log(result.token);

        }
    });
});


