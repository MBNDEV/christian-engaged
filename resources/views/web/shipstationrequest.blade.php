<?xml version="1.0" encoding="utf-8"?>

<Orders pages="1">

    @foreach ($orders as $order)
        <?php $orderdetails = $order->orderdetails; $orderItems = $order->orderItems;
        $status = 'unpaid';
        // if ($order->payment_status == 0)
        //     $status = 'unpaid';
        // else
        if ($order->payment_status == 1)
            $status = 'paid';

        if ($order->order_status == 3)
            $status = 'shipped';
        elseif ($order->order_status == 4)
            $status = 'on_hold';
        elseif ($order->order_status == 5)
            $status = 'cancelled';

        ?>
    <Order>

        <OrderID><![CDATA[{{$order->order_number}}]]></OrderID>

        <OrderNumber><![CDATA[{{$order->order_number}}]]></OrderNumber>

        <OrderDate>{{date('m/d/Y H:m',strtotime($order->order_date))}}</OrderDate>

        <OrderStatus><![CDATA[{{$status}}]]></OrderStatus>

        <LastModified>{{date('m/d/Y H:m',strtotime($order->updated_at))}}</LastModified>

        <PaymentMethod><![CDATA[Credit Card]]></PaymentMethod>

        <OrderTotal>{{$order->order_amount}}</OrderTotal>

        <TaxAmount>0.00</TaxAmount>

        <ShippingAmount>0.00</ShippingAmount>

        <Customer>

            <CustomerCode><![CDATA[{{$order->first_name.' '.$order->last_name}}]]></CustomerCode>

            <BillTo>

                <Name><![CDATA[{{$orderdetails->billing_fname.' '.$orderdetails->billing_lname}}]]></Name>

                <Address1><![CDATA[{{$orderdetails->address_line_1}}]]></Address1>

                <Address2><![CDATA[{{$orderdetails->address_line_2}}]]></Address2>

                <City><![CDATA[{{$orderdetails->city}}]]></City>

                <State><![CDATA[{{$orderdetails->state}}]]></State>

                <PostalCode><![CDATA[{{$orderdetails->zipcode}}]]></PostalCode>

                <Country><![CDATA[{{$orderdetails->billing_country_code}}]]></Country>

                <Phone><![CDATA[{{$orderdetails->telephone}}]]></Phone>
                <Email><![CDATA[{{$orderdetails->email}}]]></Email>

            </BillTo>

            <ShipTo>

                <Name><![CDATA[{{$orderdetails->shipping_fname.' '.$orderdetails->shipping_lname}}]]></Name>

                <Address1><![CDATA[{{$orderdetails->ship_address_line_1}}]]></Address1>

                <Address2><![CDATA[{{$orderdetails->ship_address_line_2}}]]></Address2>

                <City><![CDATA[{{$orderdetails->ship_city}}]]></City>

                <State><![CDATA[{{$orderdetails->ship_state}}]]></State>

                <PostalCode><![CDATA[{{$orderdetails->ship_zipcode}}]]></PostalCode>

                <Country><![CDATA[{{$orderdetails->shipping_country_code}}]]></Country>

                <Phone><![CDATA[{{$orderdetails->ship_telephone}}]]></Phone>

            </ShipTo>

        </Customer>

        <Items>
            @foreach ($orderItems as $orderItem)
            <Item>

                <SKU><![CDATA[{{$orderItem->sku}}]]></SKU>

                <Name><![CDATA[{{$orderItem->product_name}}]]></Name>

                <ImageUrl><![CDATA[{{asset('/uploads/productimages/'.$orderItem->product_image) }}]]></ImageUrl>

                <Quantity>{{$orderItem->quantity}}</Quantity>

                <UnitPrice>{{$orderItem->sale_price}}</UnitPrice>

            </Item>
            @endforeach
        </Items>

    </Order>
    @endforeach
</Orders>
