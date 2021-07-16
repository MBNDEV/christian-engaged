<div class="view-order-info">
    <h5>User Information</h5>
    <table class="table table-bordered order-record">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>    
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ucfirst($donationdetails->first_name).' '.ucfirst($donationdetails->last_name)}}</td>
                <td>{{$donationdetails->email}}</td>
                <td>{{$donationdetails->phone}}</td>
            </tr>
        </tbody>
    </table>
     <table class="table table-bordered order-record">
        <thead>
            <tr>
                <th>Address</th>   
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$donationdetails->address_line_1.', '.$donationdetails->address_line_2}}</td>
            </tr>
        </tbody>
    </table>
<table class="table table-bordered order-record">
        <thead>
            <tr>
                <th>City</th>
                <th>State</th>  
                <th>Country</th>  
                <th>Zipcode</th>  

            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$donationdetails->city}}</td>
                <td>{{$donationdetails->state}}</td>
                <td>{{$countrydetails->country_name}}</td>
                <td>{{$donationdetails->zipcode}}</td>
            </tr>
        </tbody>
    </table>

</div>

<div class="view-order-info">
    <h5>Transaction Details</h5>

    <table class="table table-bordered order-record">
        <thead>
            <tr>
                <th>Amount</th>
                <th>Card</th>    
                <th>Transaction Date</th>
                <th>Transaction Status</th>
            </tr>
        </thead>
        <tbody>
            @if($is_recurring)
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>${{number_format((float)(($transaction->txn_amount)/100), 2, '.', '')}}</td>
                        <td>{{ ($transaction->payment_brand) ? $transaction->payment_brand.' card ending with XXXXX'.$transaction->payment_last4 :''}}</td>
                        <td>{{$transaction->created_at}}</td>
                        <td>{{$transaction->txn_status}}</td>
                    </tr>
                @endforeach                 
            @else
                <tr>
                    <td>${{number_format((float)(($donationdetails->txn_amount)/100), 2, '.', '')}}</td>
                    <td>{{ ($donationdetails->payment_brand) ? $donationdetails->payment_brand.' card ending with XXXXX'.$donationdetails->payment_last4 :''}}</td>
                    <td>{{$donationdetails->created_at}}</td>
                    <td>{{$donationdetails->txn_status}}</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>