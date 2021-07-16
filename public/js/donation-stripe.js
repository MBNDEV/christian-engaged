
// Create a Stripe client.
var stripe = Stripe(STRIPE_PK);

var elements = stripe.elements();

var elementStyles = {
    base: {
        //color: '#fff',
        fontWeight: 600,
        fontFamily: 'Quicksand, Open Sans, Segoe UI, sans-serif',
        fontSize: '16px',
        fontSmoothing: 'antialiased',

        ':focus': {
            color: '#424770',
        },

        '::placeholder': {
            color: '#9BACC8',
        },

        ':focus::placeholder': {
            color: '#CFD7DF',
        },
    },
    invalid: {
        color: '#fff',
        ':focus': {
            color: '#FA755A',
        },
        '::placeholder': {
            color: '#FFCCA5',
        },
    },
};

var elementClasses = {
    focus: 'focus',
    empty: 'empty',
    invalid: 'invalid',
};

var cardNumber = elements.create('cardNumber', {
    style: elementStyles,
    classes: elementClasses,
});
cardNumber.mount('#che-donation-card-number');

var cardExpiry = elements.create('cardExpiry', {
    style: elementStyles,
    classes: elementClasses,
});
cardExpiry.mount('#che-donation-card-expiry');

var cardCvc = elements.create('cardCvc', {
    style: elementStyles,
    classes: elementClasses,
});
cardCvc.mount('#che-donation-card-cvc');

registerElements([cardNumber, cardExpiry, cardCvc], 'che-donation');



function registerElements(elements, exampleName) {
    var formClass = '.' + exampleName;
    var example = document.querySelector(formClass);

    var form = example.querySelector('form');
    var error = form.querySelector('.error');
    var errorMessage = error.querySelector('.message');

    function enableInputs() {
        Array.prototype.forEach.call(
                form.querySelectorAll(
                        "input[type='text'], input[type='email'], input[type='tel']"
                        ),
                function (input) {
                    input.removeAttribute('disabled');
                }
        );
    }

    function disableInputs() {
        Array.prototype.forEach.call(
                form.querySelectorAll(
                        "input[type='text'], input[type='email'], input[type='tel']"
                        ),
                function (input) {
                    input.setAttribute('disabled', 'true');
                }
        );
    }

    function triggerBrowserValidation() {
        // The only way to trigger HTML5 form validation UI is to fake a user submit
        // event.
        var submit = document.createElement('input');
        submit.type = 'submit';
        submit.style.display = 'none';
        form.appendChild(submit);
        submit.click();
        submit.remove();
    }

    // Listen for errors from each Element, and show error messages in the UI.
    var savedErrors = {};
    elements.forEach(function (element, idx) {
        element.on('change', function (event) {
            if (event.error) {
                error.classList.add('visible');
                savedErrors[idx] = event.error.message;
                errorMessage.innerText = event.error.message;
            } else {
                savedErrors[idx] = null;

                // Loop over the saved errors and find the first one, if any.
                var nextError = Object.keys(savedErrors)
                        .sort()
                        .reduce(function (maybeFoundError, key) {
                            return maybeFoundError || savedErrors[key];
                        }, null);

                if (nextError) {
                    // Now that they've fixed the current error, show another one.
                    errorMessage.innerText = nextError;
                } else {
                    // The user fixed the last error; no more errors.
                    error.classList.remove('visible');
                }
            }
        });
    });

    // Listen on the form's 'submit' handler...
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // Trigger HTML5 validation UI on the form if any of the inputs fail
        // validation.
        var plainInputsValid = true;
        Array.prototype.forEach.call(form.querySelectorAll('input'), function (
                input
                ) {
            if (input.checkValidity && !input.checkValidity()) {
                plainInputsValid = false;
                return;
            }
        });
        if (!plainInputsValid) {
            triggerBrowserValidation();
            return;
        }

        // Show a loading screen...
        example.classList.add('submitting');

        // Disable all inputs.
        disableInputs();

        // Use Stripe.js to create a token. We only need to pass in one Element
        // from the Element group in order to create a token. We can also pass
        // in the additional customer data we collected in our form.
        stripe.createToken(elements[0]).then(function (result) {
            // Stop loading!
            example.classList.remove('submitting');

            if (result.token) {
                $('#stp_token').val(result.token.id);
                movetoStep4();
                example.classList.add('submitted');
                $('html, body').animate({
                    scrollTop: $('.body-content').offset().top-40
                }, 100);
            } else {
                alertify.error(result.error.message);
                // Otherwise, un-disable inputs.
                enableInputs();
            }
        });
    });
}

$(".nav-tabs a[data-toggle=tab]").on("click", function (e) {
    if (!$(this).parent('li').hasClass("donation-active")) {
        e.preventDefault();
        return false;
    }
});

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

    var tabIndex = $(this).data('id');

    $('ul#donationTabs li').each(function (i)
    {
        if ($(this).data('rel') <= tabIndex) {
            $(this).addClass('donation-active');
        } else {
            $(this).removeClass('donation-active');
        }
    });
});


function movetoStep1() {

    $('.nav-tabs a[href="#Section1"]').tab('show');
}
function movetoStep2() {
    $('.nav-tabs a[href="#Section2"]').tab('show');
    var gifttype = $('input[name=gift]:checked').val();
    if (gifttype == 'one_time') {
        $('#monthly-gift').addClass('hide');
        $('#onetime-gift').removeClass('hide');
    } else {
        $('#onetime-gift').addClass('hide');
        $('#monthly-gift').removeClass('hide');
    }
    $('[name="gift_amount"]').removeAttr('checked');

    var donation_type = $('#donation_amount').data('type');
    var donation_amount = $('#donation_amount').data('value');

    //$('input[name=custom_gift_amount]').attr('disabled', 'disabled');
    $('input[name=custom_gift_amount]').val(donation_amount);

    $("#" + donation_type + " input[name=gift_amount][value=" + donation_amount + "]").prop('checked', true);

}
function movetoStep3() {
    $('.nav-tabs a[href="#Section3"]').tab('show');
}
function movetoStep4() {
    $('.nav-tabs a[href="#Section4"]').tab('show');
}
function movetoStep5() {
    $('html, body').animate({
        scrollTop: $('.body-content').offset().top-40
    }, 100);
    $('.nav-tabs a[href="#Section5"]').tab('show');
}

function validatestep1() {
    var gifttype = $('input[name=gift]:checked').val();
    if (gifttype == 'one_time') {
        $('#donation_amount').data('value', 50);
        $('#donation_amount').data('type', 'onetime-gift');
    } else {
        $('#donation_amount').data('value', 10);
        $('#donation_amount').data('type', 'monthly-gift');
    }
    movetoStep2();
}


function validatestep2() {
    var checkedval = $('input[name=gift_amount]:checked').val();
    var type = $('input[name=gift_amount]:checked').closest('ul').attr('id');
    $('#donation_amount').data('type', type);

    if($("#custom_gift_amount").val().length < 1 && $('input[name=gift]:checked').val() == "monthly"){
        $('#custom_gift_amount_error').removeClass('hide');
        return false;
    }
    if($("#custom_gift_amount1").val().length < 1 && $('input[name=gift]:checked').val() == "one_time"){
        $('#custom_gift_amount_error1').removeClass('hide');
        return false;
    }
    if($("#custom_gift_amount").val().length >= 1 && !validateGiftAmount($("#custom_gift_amount").val())){
        return false;
    }
    if($("#custom_gift_amount1").val().length >= 1 && !validateGiftAmount($("#custom_gift_amount1").val())) {
        return false;
    }

    if (checkedval == 'custom') {
        var amount = $("#custom_gift_amount").val();
        if (amount == "") {
            amount = $("#custom_gift_amount1").val();
        }

        if (validateGiftAmount(amount)) {
            $('#donation_amount').data('value', amount);
            movetoStep3();
        }
    } else {
        $('#donation_amount').data('value', checkedval);
        movetoStep3();
    }
}
// $("input[name=gift_amount]").click(function(){
//         var checkedval = $('input[name=gift_amount]:checked').val();
//         if(checkedval == 'custom'){
//             $('#custom_gift_amount1').attr('disabled',false);
//         }else{
//             $('#custom_gift_amount1').attr('disabled',true);
//         }
// }); 

function validatestep4() {
    $('#first_name_error').addClass('hide');
    $('#last_name_error').addClass('hide');
    $('#phone_error').addClass('hide');
    $('#email_error').addClass('hide');

    $error = false;

    if ($('#first_name').val() == '') {
        $('#first_name_error').removeClass('hide');
        $error = true;
    }

    if ($('#last_name').val() == '') {
        $('#last_name_error').removeClass('hide');
        $error = true;
    }

    if ($('#phone').val() == '') {
        $('#phone_error').removeClass('hide');
        $error = true;
    }

    if ($('#email').val() == '' || ($('#email').val() && !validateEmail($('#email').val()))) {
        $('#email_error').removeClass('hide');
        $error = true;
    }

    if ($error)
        return false;
    else
        movetoStep5();
}

function validatestep5() {
    $('#address_line_1_error').addClass('hide');
    $('#city_error').addClass('hide');
    $('#state_error').addClass('hide');
    $('#country_error').addClass('hide');
    $('#zipcode_error').addClass('hide');

    $error = false;

    if ($('#address_line_1').val() == '') {
        $('#address_line_1_error').removeClass('hide');
        $error = true;
    }

    if ($('#city').val() == '') {
        $('#city_error').removeClass('hide');
        $error = true;
    }

    if ($('#state').val() == '') {
        $('#state_error').removeClass('hide');
        $error = true;
    }

    if ($('#country').val() == '') {
        $('#country_error').removeClass('hide');
        $error = true;
    }

    if ($('#zipcode').val() == '') {
        $('#zipcode_error').removeClass('hide');
        $error = true;
    }

    if ($error)
        return false;
    else
        submitform();
}




$("#custom_gift_amount").on('keyup', function () {
    var amount = $("#custom_gift_amount").val();
    if (amount == "") {
        amount = $("#custom_gift_amount1").val();
    }
    validateGiftAmount(amount,'#custom_gift_amount_error');
});
$("#custom_gift_amount1").on('keyup', function () {
    var amount = $("#custom_gift_amount1").val();
    if (amount == "") {
        amount = $("#custom_gift_amount").val();
    }
    validateGiftAmount(amount,'#custom_gift_amount_error1');
});

function validateGiftAmount(amount,id = '#custom_gift_amount_error') {

    if (amount == '') {
        $(id).removeClass('hide');
        return false;
    }

    var validateAmount = function (amount) {
        return /^[0-9]*(\.[0-9][0-9]?)?$/.test(amount);
    }

    if (validateAmount(amount)) {
        $(id).addClass('hide');
        return true;
    } else {
        $(id).removeClass('hide');
        return false;
    }
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}


function isNumber(evt) {
    var iKeyCode = (evt.which) ? evt.which : evt.keyCode
    if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
        return false;

    return true;
}

function submitform() {
    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    var phone = $('#phone').val();

    var amount = $('input[name=gift_amount]:checked').val();
    var gifttype = $('input[name=gift]:checked').val();
   // alert(gifttype);
   // alert(amount)
    if (amount == 'custom') {
        if (gifttype == 'one_time') {
            amount = $("#custom_gift_amount1").val();
        } else {
            var amount = $("#custom_gift_amount").val();
        }
       //alert(amount) ;
    }
    //alert(amount);
    var email = $('#email').val();
    var address_line_1 = $('#address_line_1').val();
    var address_line_2 = $('#address_line_2').val();
    var city = $('#city').val();
    var state = $('#state').val();
    var country = $('#country').val();
    var zipcode = $('#zipcode').val();
    var stp_token = $('#stp_token').val();
    var reference_id = $('#reference_id').val();

    $("#submit-donation").attr('disabled', 'disabled');
    $("#submit-donation").html('Please Wait..');

    $.ajax({
        type: 'POST',
        url: APP_URL + '/donation/make-donation',
        data: {'first_name': first_name,
            'last_name': last_name,
            'phone': phone,
            'amount': amount,
            'email': email,
            'address_line_1': address_line_1,
            'address_line_2': address_line_2,
            'city': city,
            'state': state,
            'country': country,
            'zipcode': zipcode,
            'stp_token': stp_token,
            'reference_id': reference_id,
            'gifttype': gifttype
        },
        success: function (data) {
            var result = JSON.parse(data);

            if (result.success) {
                alertify.success(result.message);

                $("#submit-donation").removeAttr('disabled');
                $("#submit-donation").html('Submit');

                if (result.donation_id)
                    window.location.href = APP_URL + '/donation/donation-receipt/' + result.donation_id;


            } else {
                alertify.error(result.message);
                $("#submit-donation").removeAttr('disabled');
                $("#submit-donation").html('Submit');
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + errorThrown);
            $("#submit-donation").removeAttr('disabled');
            $("#submit-donation").html('Submit');
        }
    });

}

