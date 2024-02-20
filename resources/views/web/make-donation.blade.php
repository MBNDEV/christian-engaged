<?php session(['donation_page' => 1]); ?>
<section class="banner">
    <figure>
        <img src="{{ asset('images/donate-hero-bg.png') }} " alt="Donate">
        <figcaption>
            <div class="content">
                <h1>DONATE</h1>
                <img src="{{ asset('images/symbol.png') }}" width="104" height="104" class="hero-logo" />  
            </div>
        </figcaption>
    </figure>
</section><!-- End banner -->
<section class="donation-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- <h1>Donate</h1> -->
                <h2 style="color: #337ab7; text-align: center;">
                    Our videos are free to view, but not free to produce. <br>Your generous donation today helps fund the production of new videos. 
                </h2>
                <div class="tab" role="tabpanel">
                    <ul class="nav nav-tabs" role="tablist" id='donationTabs'>
                        <li role="presentation" class="active donation-active" data-rel='1'>
                            <a href="#Section1" data-id='1' aria-controls="home" role="tab" data-toggle="tab">1  GIFT TYPE</a>
                        </li>
                        <li role="presentation" data-rel='2'>
                            <a href="#Section2" data-id='2' aria-controls="profile" role="tab" data-toggle="tab">2  GIFT AMOUNT</a>
                        </li>
                        <li role="presentation" data-rel='3'>
                            <a href="#Section3" data-id='3' aria-controls="messages" role="tab" data-toggle="tab">3  Payment Method</a>
                        </li>
                        <li role="presentation" data-rel='4'>
                            <a href="#Section4" data-id='4' aria-controls="messages" role="tab" data-toggle="tab">4  Your Information</a>
                        </li>
                        <li role="presentation" data-rel='5'>
                            <a href="#Section5" data-id='5' aria-controls="messages" role="tab" data-toggle="tab">5  Billing Address</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                            <div class="heading">
                                <h3>
                                    <span>1</span> I want to make a:
                                </h3>
                            </div>

                            <div class="gifttype-wrap">
                                <h5>Monthly donations help us plan much more efficiently. Please consider making a monthly gift. </h5>
                                <ul class="checkbox-list">
                                    <li>
                                        <input type="radio" name="gift" id="gift" value="one_time" class="css-radio" checked="checked"/>
                                        <label for="gift" class="css-labell">One Time Gift</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="gift" id="mgift" value="monthly" class="css-radio" />
                                        <label for="mgift" class="css-labell">Monthly Gift</label>
                                    </li>
                                </ul>
                                <div class="buttons fullwidth">

                                    <div class="proceedbutton">
                                        <a href="javascript:void(0)" onclick="validatestep1()">PROCEED <span>&nbsp;</span></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="Section2">
                            <div class="heading">
                                <h3>
                                    <span>2</span> Gift Amount 
                                </h3>
                            </div>
                            <div class="gifttype-wrap">
                                <ul class="gift-list" id="onetime-gift">                                    
                                    <li>
                                        <input type="radio" id="gift50" name="gift_amount" value='50' class="css-radio" checked="checked"/>
                                        <label for="gift50" class="css-labell">$50</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="gift101" name="gift_amount" value='100' class="css-radio" />
                                        <label for="gift101" class="css-labell">$100</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="gift250" name="gift_amount" value='250' class="css-radio" />
                                        <label for="gift250" class="css-labell">$250</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="gift500" name="gift_amount" value='500' class="css-radio" />
                                        <label for="gift500" class="css-labell">$500</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="gift1000" name="gift_amount" value='1000' class="css-radio" />
                                        <label for="gift1000" class="css-labell">$1000</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="gift5000" name="gift_amount" value='5000' class="css-radio" />
                                        <label for="gift5000" class="css-labell">$5000</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="giftcustom1" name="gift_amount" value='custom' class="css-radio" />
                                        <label for="giftcustom1" class="css-labell">Other</label>
                                    </li>
                                    <li class="fullwidth last">
                                        <label>Enter Amount</label>
                                        <input type="text" name="custom_gift_amount" id="custom_gift_amount1" class="frm-control">

                                    </li>
                                    <li class="fullwidth">
                                        <span class="error hide" id="custom_gift_amount_error1">
                                            Invalid amount (Numbers upto 2 decimal places allowed)
                                        </span>
                                    </li>
                                </ul>

                                <ul class="gift-list hide" id="monthly-gift">                                    
                                    <li>
                                        <input type="radio" id="gift10" name="gift_amount" value='10' class="css-radio"/>
                                        <label for="gift10" class="css-labell">$10/Month</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="gift40" name="gift_amount" value='40' class="css-radio" />
                                        <label for="gift40" class="css-labell">$40/Month</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="gift75" name="gift_amount" value='75' class="css-radio" />
                                        <label for="gift75" class="css-labell">$75/Month</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="gift100" name="gift_amount" value='100' class="css-radio" />
                                        <label for="gift100" class="css-labell">$100/Month</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="gift200" name="gift_amount" value='200' class="css-radio" />
                                        <label for="gift200" class="css-labell">$200/Month</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="giftcustom" name="gift_amount" value='custom' class="css-radio" />
                                        <label for="giftcustom" class="css-labell">Other</label>
                                    </li>
                                    <li class="fullwidth last">
                                        <label>Enter Amount</label>
                                        <input type="text" name="custom_gift_amount" id="custom_gift_amount" class="frm-control"><br>
                                        <span class="error hide" id="custom_gift_amount_error">
                                            Invalid amount (Numbers upto 2 decimal places allowed)
                                        </span>
                                    </li>
                                </ul>
                                <div class="buttons fullwidth">
                                    <div class="backbutton">
                                        <a href="javascript:void(0)" onclick="movetoStep1()"><span>&nbsp;</span> Back</a>
                                    </div>
                                    <div class="proceedbutton">
                                        <input type="hidden" name="donation_amount" id="donation_amount" data-value="50" data-type="onetime-gift">
                                        <a href="javascript:void(0)" onclick="validatestep2()">PROCEED <span>&nbsp;</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="Section3">

                            <div class="heading">
                                <h3>
                                    <span>3</span> Payment Method
                                </h3>
                            </div>

                            <div class="gifttype-wrap">
                                <div class="cell example che-donation">
                                    <form> 
                                        <div class="center"><img src="{{ asset('images/payemnt.jpg') }}" alt="" /></div>
                                        <ul class="payment-list">
                                            <li>
                                                <div class="col-md-4 col-xs-12">
                                                    <label>Credit Card Number</label>
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    <div id="che-donation-card-number" class="field empty"></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col-md-4 col-xs-12">
                                                    <label>CVV</label>
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    <div id="che-donation-card-cvc" class="field empty half-width"></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col-md-4 col-xs-12">
                                                    <label>Expiration Date</label>
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    <div id="che-donation-card-expiry" class="field empty half-width"></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col-md-4 col-xs-12">
                                                    <label>&nbsp;</label>
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="error" role="alert"><span class="message"></span></div>
                                                </div>
                                            </li>                  
                                        </ul>
                                        <div class="buttons fullwidth">
                                            <div class="backbutton">
                                                <a href="javascript:void(0)" onclick="movetoStep2()"><span>&nbsp;</span> Back</a>
                                            </div>
                                            <div class="proceedbutton">
                                                <button type="submit" data-tid="elements_examples.form.pay_button">Proceed <span>&nbsp;</span></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="Section4">

                            <div class="heading">
                                <h3>
                                    <span>4</span> Your Information
                                </h3>
                            </div>

                            <div class="gifttype-wrap">
                                <ul class="payment-list">
                                    <li>
                                        <div class="col-md-4 col-xs-12">
                                            <label>First Name</label>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <input type="text" name="first_name" id="first_name" class="frm-control">
                                            <span class="error hide" id="first_name_error">
                                                First Name is required
                                            </span>
                                        </div>

                                    </li>
                                    <li>
                                        <div class="col-md-4 col-xs-12">
                                            <label>Last Name</label>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <input type="text" name="last_name" id="last_name" class="frm-control">
                                            <span class="error hide" id="last_name_error">
                                                Last Name is required
                                            </span>
                                        </div>

                                    </li>
                                    <li>
                                        <div class="col-md-4 col-xs-12">
                                            <label>Phone Number</label>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <input type="text" name="phone" id="phone" onkeypress="javascript:return isNumber(event)" maxlength='10' class="frm-control">
                                            <span class="error hide" id="phone_error">
                                                Phone Number is required
                                            </span>
                                        </div>                                        
                                    </li>
                                    <li>
                                        <div class="col-md-4 col-xs-12">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <input type="text" name="email" id="email" class="frm-control">
                                            <span class="error hide" id="email_error">
                                                Invalid Email
                                            </span>
                                        </div>

                                    </li>
                                </ul>
                                <div class="buttons fullwidth">
                                    <div class="backbutton">
                                        <a href="javascript:void(0)" onclick="movetoStep3()"><span>&nbsp;</span> Back</a>
                                    </div>
                                    <div class="proceedbutton">
                                        <a href="javascript:void(0)" onclick="validatestep4()">PROCEED <span>&nbsp;</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="Section5">

                            <div class="heading">
                                <h3>
                                    <span>5</span> Billing Address
                                </h3>
                            </div>

                            <div class="gifttype-wrap">

                                <ul class="payment-list">
                                    <li>
                                        <div class="col-md-4 col-xs-12">
                                            <label>Address</label>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <input type="text" name="address_line_1" id="address_line_1" class="frm-control">
                                            <span class="error hide" id="address_line_1_error">
                                                Address is required
                                            </span>
                                        </div>

                                    </li>
                                    <li>
                                        <div class="col-md-4 col-xs-12">
                                            <label>Address Line 2</label>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <input type="text" name="address_line_2" id="address_line_2" class="frm-control">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-md-4 col-xs-12">
                                            <label>City</label>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <input type="text" name="city" id="city" class="frm-control">
                                            <span class="error hide" id="city_error">
                                                City is required
                                            </span>
                                        </div>

                                    </li>

                                    <li>
                                        <div class="col-md-4 col-xs-12">
                                            <label>Country</label>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <select name="country" id="country" class="">
                                                <option value="">Select a country</option>
                                                <?php foreach ($countryList as $country) { ?>
                                                    <option value="<?php echo $country->id; ?>" <?php if ($country->id == 231) echo "selected=selected" ?>>
                                                        <?php echo $country->country_name; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            <span class="error hide" id="country_error">
                                                Country is required
                                            </span>
                                        </div>

                                    </li>

                                    <li>
                                        <div class="col-md-4 col-xs-12">
                                            <label>State</label>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <input type="text" name="state" id="state" class="frm-control">
                                            <span class="error hide" id="state_error">
                                                State is required
                                            </span>
                                        </div>

                                        <div class="col-md-1 col-xs-12">
                                            <label>Zip</label>
                                        </div>
                                        <div class="col-md-2 col-xs-12">
                                            <input type="text" name="zipcode" id="zipcode" class="frm-control">
                                            <span class="error hide" id="zipcode_error">
                                                Zipcode is required
                                            </span>
                                        </div>

                                    </li>
                                </ul>

                                <input type="hidden" name='stp_token' value="" id='stp_token'>
                                <input type="hidden" name='reference_id' value="{{$encrypt}}" id='reference_id'>

                                <div class="buttons">
                                    <div class="backbutton">
                                        <a href="javascript:void(0)" onclick="movetoStep4()"><span>&nbsp;</span> Back</a>
                                    </div>
                                    <div class="proceedbutton">
                                        <a href="javascript:void(0)" onclick="validatestep5()" id='submit-donation'>Submit</a>
                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="donate-way">
            <div class="heading">
            <h3>Other Ways to Give:</h3>
            </div>
            <div class="col-lg-6 text-center">
                <a href="https://www.paypal.com/paypalme/ChristianityEngaged" target="_blank">
                    <img src="/images/donate-pp.png" />    
                </a>
            </div>
            <div class="col-lg-6 text-center">
                <a href="https://www.venmo.com/ChristianityEngaged" target="_blank">
                    <img src="/images/venmo.png" />
                </a>
            </div>

            <h4>Mail a Check to:</h4>
            <div class="col-lg-12 address-section">
                <div class="address-box">
                    <img src="/images/address-icon.png" class="img-responsive" /> <p>Christianity Engaged, 2600 East Springfield Place Unit 73, Chandler, AZ 85286</p>
                </div>

                <hr />

                <p>You can also give through a donor-advised fund such as the <a href="https://www.ncfgiving.com/" target="_blank">National Christian Foundation</a></p>
            </div>
        </div>
    </div>
</section>
<style>
    .donate-way {
        max-width: 700px;
        margin: 20px auto;
    }

    .donate-way h3 {
        color: #464646;
        text-align: center;
        margin-bottom: 20px;
    }

    .donate-way img {
        margin-bottom: 30px;
        cursor: pointer;
        max-width: 320px;
    }

    .donate-way h4 {
        color: #347AB7;
        font-size: 20px;
        text-align: center;
        margin-top: 10px;
    }

    .address-box {
        display: flex; 
        gap: 12px;
        margin: 0 auto;
        max-width: 600px;
        text-align: center;
    }

    .address-box p {
        font-size: 18px;
        padding: 5px 0;
    }

    .address-section {
        text-align: center;
    }

    .address-section p, .address-section a {
        text-align: center;
        font-size: 18px;
    }

    .address-section hr {
        width: 100%;
        border-top: 1px solid #23AAE1;
        margin-top: 0!important;

    }

    @media screen and (max-width: 767px) {
        .donate-way {
            max-width: 100%;
        }

        .address-box {
            max-width: 500px;
        }
        .address-box p {
            font-size: 14px;
        }

        .address-box img {
            max-width: 30px;
        }
    }

</style>
<script>
<?php if(env('APP_ENV') == 'local' || env('APP_ENV') == 'staging'){ ?>
   STRIPE_PK = '{{ env('STRIPE_TEST_PK') }}';
<?php }else{?>
    STRIPE_PK = '{{ env('STRIPE_LIVE_PK') }}';
<?php }?>
  // STRIPE_PK = 'pk_test_06UOJ1NFIBOZbtt4u5IbArgD';
</script>
<script src="https://js.stripe.com/v3/"></script>
<script src="{{asset('js/donation-stripe.js')}}"></script>

<script>
    $('input[type=radio][name=gift_amount]').on('change', function () {
        var checkedval = $('input[name=gift_amount]:checked').val();
         //alert(checkedval)
         
         var donation_type = $('#donation_amount').data('type');
         
        $('#' + donation_type + ' input[name=custom_gift_amount]').val(checkedval);

        if (checkedval == 'custom') {
            $('#' + donation_type + ' input[name=custom_gift_amount]').val('');
        }

    });

    $('input[name=custom_gift_amount]').on('focusout', function () {
        var donation_type = $('#donation_amount').data('type');
        var gift_amount = $('#' + donation_type + ' input[name=custom_gift_amount]').val();
        
        var arr = [];
        if(donation_type ==  'onetime-gift'){
            arr = [ "50", "100", "250", "500" ,"1000" ];
        }else{
            arr = [ "10", "40", "75", "100" ,"200" ]; 
        }
       
       $("#" + donation_type + " input[name=gift_amount][value='" + gift_amount + "']").prop('checked', true);
        if ( -1 == arr.indexOf(gift_amount )) {
            $("#" + donation_type + " input[name=gift_amount][value=custom]").prop('checked', true);
        }

    });


</script>

