<div class="view-order-info">
    <h5>User Information</h5>
    <table border="0" cellspacing="0" cellpadding="0" class="table table-bordered order-record">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>    
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ucfirst($orderdetails->fname).' '.ucfirst($orderdetails->lname)}}</td>
                <td>{{$orderdetails->email}}</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="view-order-info">
    <h5>Shipping Address</h5>
    <div class="order-record">
        <span>{{$orderdetails->shipping_fname.' '.$orderdetails->shipping_lname}}, {{$orderdetails->ship_address_line_1}}, {{$orderdetails->ship_address_line_2}}</span><br>
        <span>{{$orderdetails->ship_city}} , {{$orderdetails->ship_state}} , {{$orderdetails->shipping_country}} , {{$orderdetails->ship_zipcode}}</span>
        <br>
        <span>{{$orderdetails->ship_telephone}}</span>
    </div>
</div>

<div class="view-order-info">
    <h5>Billing Address</h5> 
    <div class="order-record">
        <span> {{$orderdetails->billing_fname.' '.$orderdetails->shipping_lname}}, {{$orderdetails->address_line_1}}, {{$orderdetails->address_line_2}}</span><br>
        <span>{{$orderdetails->city}} , {{$orderdetails->state}} , {{$orderdetails->billing_country}} , {{$orderdetails->zipcode}}</span>
        <br>
        <span>{{$orderdetails->telephone}}</span>
    </div>
</div>

<div class="view-order-info">
    <h5>Payment Details</h5>

    <table border="0" cellspacing="0" cellpadding="0" class="table table-bordered order-record">
        <thead>
            <tr>
                <th>Amount</th>
                <th>Card</th>    
                <th>Transaction Status</th>    
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>${{number_format((float)(($orderdetails->txn_amount)/100), 2, '.', '')}}</td>
                <td>{{ ($orderdetails->payment_brand) ? $orderdetails->payment_brand.' card ending with XXXXX'.$orderdetails->payment_last4 :''}}</td>
                <td>{{$orderdetails->txn_status}}</td>
            </tr>
        </tbody>
    </table>
</div>

<h5>Purchased On : {{$orderdetails->order_date}}</h5>
<table border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
    <thead>
        <tr>
            <th>Product</th>
            <th style="width:340px;">Product Details</th>
            <th>Unit Price</th>  
            <th>Total</th>
        </tr>
    </thead>  
    <tbody>
        <?php foreach ($orderItems as $orderItem) { ?>
                <tr>
                    <td>
                        <img style="width:50px;" src="{{asset('/uploads/productimages/'.$orderItem->product_image) }}" onerror="this.src='{{asset('/images/no_image.png') }}'">
                    </td>
                    <td style="text-align: left;">{{ucfirst($orderItem->product_name)}}<br> Quantity : </b>{{$orderItem->quantity}}</td>
                    <td>${{$orderItem->sale_price}}</td>
                    <td>${{number_format((float)($orderItem->sale_price * $orderItem->quantity), 2, '.', '')}}</td>               
                </tr>
        <?php } ?>                  
    </tbody>
</table>

<div class="totalAmout">
    Sub Total: <span>${{$orderItem->order_amount}}</span>
</div>
                
            