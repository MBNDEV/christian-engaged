@if($error)
    <section class="invoice-wrap">
        <div class="container">
            <div class="alert alert-danger">
                <strong>Error!</strong> <?php echo $message; ?>
            </div>
        </div>
    </section>
@else    
    <section class="invoice-wrap">
        
        <div class="container">
            <!--<div class="alert alert-success">
                <strong>Success!</strong> <?php //echo $message; ?>
            </div>-->
                <center><h3 style="color:#66ae3d"><i class="fa fa-check-circle"></i> Thank you for your order.</h3></center>
                <center><h4>A confirmation email has been sent to your email address below.</h4></center>
            <div class="row">
                <div class="col-md-12">
                    <h2>Order Invoice</h2>	
                </div>

                <div class="clearfix"></div>

                <div class="col-md-3">
                    <div class="sidebar">

                        <p>
                            Order ID: {{$orderdetails->order_number}}<br>
                            Order Date: {{date('M d, Y', strtotime($orderdetails->order_date))}}<br>                        
                            {{ucfirst($orderdetails->fname).' '.ucfirst($orderdetails->lname)}}<br>
                            {{$orderdetails->email}}
                        </p>

                        <hr>

                        <h4>Billing Address: </h4>
                         <p>
                            {{$orderdetails->billing_fname.' '.$orderdetails->billing_lname}}, {{$orderdetails->address_line_1}}, {{$orderdetails->address_line_2}}<br>
                            {{$orderdetails->city}} , {{$orderdetails->state}} , {{$orderdetails->billing_country}} , {{$orderdetails->zipcode}}<br>
                            {{$orderdetails->telephone}}<br>
                        </p>
                       
                        <hr>
                        <h4>Shipping Address: </h4>
                        <p>
                            {{$orderdetails->shipping_fname.' '.$orderdetails->shipping_lname}}, {{$orderdetails->ship_address_line_1}}, {{$orderdetails->ship_address_line_2}}<br>
                            {{$orderdetails->ship_city}} , {{$orderdetails->ship_state}} , {{$orderdetails->shipping_country}} , {{$orderdetails->ship_zipcode}}<br>
                            {{$orderdetails->ship_telephone}}<br>
                        </p>
                        <hr>

                        <h4>Payment Method: </h4>
                        <p>
                            {{($orderdetails->payment_brand) ? $orderdetails->payment_brand.' card ending with XXXXX'.$orderdetails->payment_last4 :''}}<br>
                        </p>
                    </div>
                </div>

                <div class="col-md-9">

                    <h4>Ordered Product</h4>
                    <?php
                    $sizestyle = "sizecls";
                    if($sizetableshow)
                        $sizestyle = "";

                    ?>
                    <table class="table invoice-table">
                        <thead>
                        <th width="15%">Product</th>    
                        <th width="30%">Product Description</th>
                        <th width="10%" class="{{$sizestyle}}">Size</th>
                        <th width="10%">Price</th>
                        <th width="25%" class="center">Quantity</th>
                        <th class="right">Subtotal</th>
                        </thead>
                        <tbody>

                            <?php
                             foreach ($orderItems as $orderItem) { ?>
                                <tr>
                                    <td><img src="{{url('uploads/productimages/'.$orderItem->product_image)}}" width="60" height="60" onerror=this.src="{{url('images/no_image.png')}}"></td>
                                    <td>{{ucfirst($orderItem->product_name)}} <br>SKU : {{$orderItem->product_sku}}</td>
                                    <td class="{{$sizestyle}}">{{ucfirst($size_list_array[$orderItem->product_sku])}}</td>
                                    <td>${{$orderItem->sale_price}}</td>
                                    <td class="center">{{$orderItem->quantity}}</td>
                                    <td class="right">
                                        ${{number_format((float)($orderItem->sale_price * $orderItem->quantity), 2, '.', '')}}
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <table class="table invoice-table">
                        <tbody>
                            <tr>
                                <td align="right" width="75%">Subtotal :</td>
                                <td align="right">${{$orderItem->order_amount}}</td>
                            </tr>                        
                            <tr>
                                <td align="right" width="75%">Shipping:</td>
                                <td align="right">${{$orderItem->shipping_amount}}</td>
                            </tr>                        
                            <tr>
                                <td align="right" width="75%">Total:</td>
                                <td align="right">${{$orderItem->order_amount + $orderItem->shipping_amount}}</td>
                            </tr>                        

                        </tbody>
                    </table>
                </div>

                <div class="clearfix"></div>

    <!--            <div class="col-md-12">
                    <div class="invoice-button">
                        <a href="#" class="blue-btn">Print Invoice</a>
                    </div>
                </div>-->

            </div>
        </div>
    </section>

<script src="{{ asset ("js/emptyCart.js") }}"></script>
<script >
    $(document).ready(function(){
        $('.sizecls').hide();
    });

</script>
@endif
