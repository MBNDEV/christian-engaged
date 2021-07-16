<script src="https://js.stripe.com/v3/"></script>

<!--<form action="/charge" method="post" id="payment-form">
  <div class="form-row">
    <label for="card-element">
      Credit or debit card
    </label>
    <div id="card-element">
       A Stripe Element will be inserted here. 
    </div>

     Used to display form errors. 
    <div id="card-errors" role="alert"></div>
  </div>

  <button>Submit Payment</button>
</form>-->


<div role="tabpanel" class="tab-pane fade" id="Section3">

    <div class="heading">
        <h3>
            <span>3</span> Payment Method
        </h3>
    </div>

    <div class="gifttype-wrap">
        <div class="cell example che-donation">
            <form id="payment-form" name="payment-form" method="post" action="#"> 
                <div class="center"><img src="{{ asset('images/payemnt.jpg') }}" alt="" /></div>
                <ul class="payment-list">
                    <li>
                        <div class="col-md-4 col-xs-12">
                            <label>Credit Card Number</label>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div id="card-element">
<!--                                <input type="text" name="Phone" id="Phone" class="frm-control">-->
                            </div>
                    </li>
                    <li>
                        <div class="col-md-4 col-xs-12">
                            <label>CVV</label>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div id="card-cvc">

                            </div>
<!--                            <input type="text" name="Phone" id="Phone" class="frm-control">-->
                        </div>
                    </li>
                    <li>
                        <div class="col-md-4 col-xs-12">
                            <label>Expiration Date</label>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div id="card-expire-date">

                            </div>
<!--                            <input type="text" name="Phone" id="Phone" class="frm-control">-->
                        </div>
                    </li>
                </ul>

                <div class="product-cart donate">
                    <div class="table-responsive">
                        <table class="shop_table table table-bordered" id="shop_table" cellspacing="0" border="0">
                            <thead>
                                <tr>
                                    <th class="product-thumb">Product</th>
                                    <th class="product-name">Name</th>
                                    <th class="product-price sizeshowtable">Size</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-qty">Quantity</th>
                                    <th class="product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="cart_item">
                                    <td class="product-thumb">
<!--                                        <a href="#"><img src="http://christianity.loc/images/no_image.png" class="product-image" onerror="this.src='http://christianity.loc/images/no_image.png'" width="60" height="60"></a>-->
                                    </td>
                                    <td class="product-name">
                                        Cary Bag
                                    </td>
                                    <td class="product-price">
                                        $12.00
                                    </td>
                                    <td class="product-qty">
                                        1
                                    </td>
                                    <td class="product-total">
                                        $12.00
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="cart_totals">
                        <h4>Cart Total</h4>
                        <table class="shop_table table table-bordered" cellspacing="0">
                            <tbody>
                                <tr class="order-total">
                                    <td>Subtotal</td>
                                    <td data-title="Total">
                                        <span class="total-amount">
                                            $0.00
                                        </span>
                                    </td>
                                </tr>
                                <tr class="shipping-total">
                                    <td>Shipping</td>
                                    <td data-title="TotalShipping">
                                        <span class="total-shipping-amount">
                                            $0.00
                                        </span>
                                    </td>
                                </tr>
                                <tr class="grand-total">
                                    <td>Total</td>
                                    <td data-title="GrandTotal">
                                        <span class="grand-total-amount">
                                            $0.00
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <input type="hidden" id="reference_id" name="reference_id">
<!--                <input type="hidden" id="stp_token" name="stp_token">-->

                <div class="buttons">
<!--                    <div class="backbutton payment-back">
                        <a href="#Section2" ><span>&nbsp;</span> Back</a>
                    </div>-->
                    <div class="proceedbutton">
                        <a class="complete-order" href="javascript:void(0)">Complete Order</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>








