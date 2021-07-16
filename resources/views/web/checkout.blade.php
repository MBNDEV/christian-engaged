@if (\Session::has('error')) 
<div class="alert alert-danger">
    <?php
    $error = \Session::get('error');
    echo $error[0];
    ?>
</div>
@endif
<script type="text/javascript">
    var shipping_cost_list = <?php echo json_encode($shipping)?>;
</script>

<div id="page-wrapper">
    <section class="donation-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Your Cart</h1>

                    <div class="tab" role="tabpanel">
                        <ul class="nav nav-tabs" role="tablist" id='donationTabs'>
                            
<!--                            <li role="presentation" data-rel='1' class="step-0 active donation-active">
                                <a href="#" data-id='1' aria-controls="messages" role="tab" data-toggle="tab">1  Cart</a>
                            </li>-->

                            <li role="presentation" data-rel='1' class="step-1 active donation-active">
                                <a href="#" data-id='2' aria-controls="messages" role="tab" data-toggle="tab">1  Your Information</a>
                            </li>
                            <li role="presentation" data-rel='2' class="step-2">
                                <a href="#" data-id='3' aria-controls="messages" role="tab" data-toggle="tab">2  Billing Address</a>
                            </li>
                            <li role="presentation" data-rel='3' class="step-3" >
                                <a href="#" data-id='4' aria-controls="messages" role="tab" data-toggle="tab">3  Payment Method</a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <div role="tabpanel" class="tab-pane fade in active" id="Section1">

                                <div class="heading">
                                    <h3>
                                        <span>1</span> Your Information
                                    </h3>
                                </div>
                                <form id="info" method="post" action="{{url('checkout')}}">
                                    <input type="hidden" name="order_amount" id="order_amount">
                                    <input type="hidden" name="shipping_amount" id="shipping_amount">
                                    <input type="hidden" name="products" id="products">
                                    <div id="payment-check" class="gifttype-wrap">
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
                                                    <input type="text" name="phone" id="phone" maxlength='10' class="frm-control">
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
                                                <a href="{{url('cart')}}"><span>&nbsp;</span> Back</a>
                                            </div>
                                            <div class="proceedbutton">
                                                <a class="Section1" href="javascript:void(0)">PROCEED <span>&nbsp;</span></a>
                                            </div>
                                        </div>
                                    </div>

                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="Section2">

                                <div class="heading">
                                    <h3>
                                        <span>2</span> Billing Address
                                    </h3>
                                </div>

                                <div class="gifttype-wrap">

                                    <ul class="payment-list">
                                        <li>
                                            <div class="col-md-4 col-xs-12">
                                                <label>First Name</label>
                                            </div>
                                            <div class="col-md-6 col-xs-12">
                                                <input type="text" name="billing_first_name" id="billing_first_name" class="frm-control">
                                                <span class="error hide" id="billing_first_name_error"></span>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="col-md-4 col-xs-12">
                                                <label>Last Name</label>
                                            </div>
                                            <div class="col-md-6 col-xs-12">
                                                <input type="text" name="billing_last_name" id="billing_last_name" class="frm-control">
                                                <span class="error hide" id="billing_last_name_error"></span>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="col-md-4 col-xs-12">
                                                <label>Address 1</label>
                                            </div>
                                            <div class="col-md-6 col-xs-12">
                                                <input type="text" name="billing_address_line_1" id="billing_address_line_1" class="frm-control">
                                                <span class="error hide" id="billing_address_line_1_error"></span>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="col-md-4 col-xs-12">
                                                <label>Address 2</label>
                                            </div>
                                            <div class="col-md-6 col-xs-12">
                                                <input type="text" name="billing_address_line_2" id="billing_address_line_2" class="frm-control">
                                                <span class="error hide" id="billing_address_line_2_error"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col-md-4 col-xs-12">
                                                <label>Country</label>
                                            </div>
                                            <div class="col-md-6 col-xs-12">
                                                <select name="billing_country_id" id="billing_country_id" class="frm-control">
                                                    <option value="">Select a country</option>
                                                    <?php foreach ($countryList as $country): ?>
                                                        <option value="<?= $country->id ?>" <?php if ($country->id == 231) echo "selected=selected" ?>><?= $country->country_name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="error hide" id="billing_country_id_error"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col-md-4 col-xs-12">
                                                <label>City</label>
                                            </div>
                                            <div class="col-md-6 col-xs-12">
                                                <input type="text" name="billing_city" id="billing_city" class="frm-control">
                                                <span class="error hide" id="billing_city_error"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col-md-4 col-xs-12">
                                                <label>State</label>
                                            </div>
                                            <div class="col-md-6 col-xs-12">
                                                <input type="text" name="billing_state" id="billing_state" class="frm-control">
                                                <span class="error hide" id="billing_state_error"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col-md-4 col-xs-12">
                                                <label>Zipcode</label>
                                            </div>
                                            <div class="col-md-6 col-xs-12">
                                                <input type="text" name="billing_zip_code" id="billing_zip_code" class="frm-control">
                                                <span class="error hide" id="billing_zip_code_error"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col-md-4 col-xs-12">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6 col-xs-12">
                                                <input type="text" name="billing_telephone" maxlength="10" id="billing_telephone" class="frm-control">
                                                <span class="error hide" id="billing_telephone_error"></span>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="col-xs-12">
                                                <div class="dfrship">
                                                    <input type="checkbox" name="same_billing_address" id="ship" value="1" class="css-checkbox"/>
                                                    <label for="ship" class="css-label">Ship to a different address</label>
                                                </div>
                                            </div>
                                        </li> 
                                    </ul>
                                    <div class="shipping hide" id="shipping">
                                        <div class="heading">
                                            <h3>
                                                Shipping Address
                                            </h3>
                                        </div>

                                        <ul class="payment-list">
                                            <li>
                                                <div class="col-md-4 col-xs-12">
                                                    <label>First Name</label>
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    <input type="text" name="shiping_first_name" id="shiping_first_name" class="frm-control">
                                                    <span class="error hide" id="shiping_first_name_error"></span>
                                                </div>

                                            </li>
                                            <li>
                                                <div class="col-md-4 col-xs-12">
                                                    <label>Last Name</label>
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    <input type="text" name="shiping_last_name" id="shiping_last_name" class="frm-control">
                                                    <span class="error hide" id="shiping_last_name_error"></span>
                                                </div>

                                            </li>
                                            <li>
                                                <div class="col-md-4 col-xs-12">
                                                    <label>Address 1</label>
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    <input type="text" name="shiping_address_line_1" id="shiping_address_line_1" class="frm-control">
                                                    <span class="error hide" id="shiping_address_line_1_error"></span>
                                                </div>

                                            </li>
                                            <li>
                                                <div class="col-md-4 col-xs-12">
                                                    <label>Address 2</label>
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    <input type="text" name="shiping_address_line_2" id="shiping_address_line_2" class="frm-control">
                                                    <span class="error hide" id="shiping_address_line_2_error"></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col-md-4 col-xs-12">
                                                    <label>Country</label>
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    <select name="shiping_country_id" id="shiping_country_id" class="frm-control">
                                                        <option value="">Select a country</option>
                                                        <?php foreach ($countryList as $country): ?>
                                                            <option value="<?= $country->id ?>" <?php if ($country->id == 231) echo "selected=selected" ?>><?= $country->country_name ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <span class="error hide" id="shiping_country_id_error"></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col-md-4 col-xs-12">
                                                    <label>City</label>
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    <input type="text" name="shiping_city" id="shiping_city" class="frm-control">
                                                    <span class="error hide" id="shiping_city_error"></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col-md-4 col-xs-12">
                                                    <label>State</label>
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    <input type="text" name="shiping_state" id="shiping_state" class="frm-control">
                                                    <span class="error hide" id="shiping_state_error"></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col-md-4 col-xs-12">
                                                    <label>Zipcode</label>
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    <input type="text" name="shiping_zip_code" id="shiping_zip_code" class="frm-control">
                                                    <span class="error hide" id="shiping_zip_code_error"></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col-md-4 col-xs-12">
                                                    <label>Phone</label>
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    <input type="text" name="shiping_telephone" id="shiping_telephone" maxlength="10" class="frm-control">
                                                    <span class="error hide" id="shiping_telephone_error"></span>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>

                                    <div class="buttons fullwidth">
                                        <div class="backbutton billing-back">
                                            <a  href="#Section1"><span>&nbsp;</span> Back</a>
                                        </div>
                                        <div class="proceedbutton">
                                            <button class="submit" type="button">Proceed <span>&nbsp;</span></button>
                                        </div>
                                    </div>

                                    </form>       

                                </div>
                            </div>

                            @include('web.new-payment')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    
<?php if(env('APP_ENV') == 'local' || env('APP_ENV') == 'staging'){ ?>
    STRIPE_PK = '{{ env('STRIPE_TEST_PK') }}';
<?php }else{?>
    STRIPE_PK = '{{ env('STRIPE_LIVE_PK') }}';
<?php }?>
   // STRIPE_PK = '{{ env('STRIPE_TEST_PK') }}';
  // STRIPE_PK = 'pk_test_06UOJ1NFIBOZbtt4u5IbArgD';
</script>

<script src="{{ asset ("js/checkout.js") }}"></script>



