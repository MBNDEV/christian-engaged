@if (\Session::has('error')) 
    <div class="alert alert-denger">
        <?php echo \Session::get('error'); ?>
    </div>
@endif

<script src="https://js.stripe.com/v3/"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
//put on layout after design final    
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });    
</script>

<div class="paymentwrap">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <form action="/charge" method="post" id="payment-form" class="payment-form">
          <div class="form-row">
            <h4 for="card-element">
              Credit or debit card
            </h4>
            <div id="card-element">
              <!-- A Stripe Element will be inserted here. -->
            </div>

            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert"></div>
          </div>

          <button id='paynow' class="blue-btn">Pay ${{$order->order_amount}}</button>
        </form>

        <form action="{{url('payment/make-payment')}}" method="post" id="make-payment">
            {{ csrf_field() }}
            <input type="hidden" name='reference_id' value="{{$encrypted}}">
            <input type="hidden" name='stp_token' value="" id='stp_token'>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
<?php if(env('APP_ENV') == 'local' || env('APP_ENV') == 'staging'){ ?>
   var stripe = '{{ env('STRIPE_TEST_PK') }}';
<?php }else{?>
   var stripe = '{{ env('STRIPE_LIVE_PK') }}';
<?php }?>
  // STRIPE_PK = 'pk_test_06UOJ1NFIBOZbtt4u5IbArgD';

// Create a Stripe client.
// var stripe = Stripe('{{ env('STRIPE_TEST_PK') }}');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    lineHeight: '18px',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {      
       
      var tokenObject = result.token;
      $('#stp_token').val(tokenObject.id);
      $('#make-payment').submit();
      
    }
  });
});


</script>