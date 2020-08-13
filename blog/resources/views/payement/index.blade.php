@extends('layouts.app')

@section('extra-meta')
<!-- pour renforce la secrite quan en utilise une requete ajax au nivean de cette page index en ce mettant une nouvelle meta -->

<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('extra-script')
  <script src="https://js.stripe.com/v3/"></script>
@endsection



@section('content')
<div class="col-md-12">
	<h2><i class="fa fa-star"></i> page de paiement</h2>
	<div class="raw">
	<form action="{{ route('payement.store') }}" method="Post" id="payment-form">
		@csrf

			<div id="card-element">
    			<!-- Elements will create input elements here -->
  		</div>

  				<!-- We'll put the error messages in this element -->
  			<div id="card-errors" role="alert"></div>

  			<button class="button button-primary mt-4" id="submit">Proceder au payement</button>
	</form>
	</div>	
</div>

@endsection
@section('extra-js')
<script>
var stripe = Stripe('pk_test_sTomNvPtcquNDsrwiElgRtRB00CJBCpH9a');
var elements = stripe.elements();
var style = {
    base: {
      color: "#32325d",
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSmoothing: "antialiased",
      fontSize: "16px",
      "::placeholder": {
        color: "#aab7c4"
      }
    },
    invalid: {
      color: "#fa755a",
      iconColor: "#fa755a"
    }
  };

var card = elements.create("card", { style: style });
    card.mount("#card-element");

card.addEventListener('change', ({error}) => {
  const displayError = document.getElementById('card-errors');
  if (error) {
  	displayError.classList.add('alert','alert-warning');
    displayError.textContent = error.message;
  } else {
  	  	displayError.classList.remove('alert','alert-warning');

    displayError.textContent = '';
  }
});

var form = document.getElementById('payment-form');

form.addEventListener('submit', function(ev) {
  ev.preventDefault();
  stripe.confirmCardPayment("{{ $clientSecret }}", {
    payment_method: {
      card: card,
      
    }
  }).then(function(result) {
    if (result.error) {
      // Show error to your customer (e.g., insufficient funds)
      console.log(result.error.message);
    } else {
      // The payment has been processed!
      if (result.paymentIntent.status === 'succeeded') {
      	var paymentIntent = result.paymentIntent;
      	var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        var form = document.getElementById('payment-form');
        var url = form.action;//on va recuperie url de l'action sur form
        var redirect = '/merci';

        fetch(
        		url,
        		{
        			headers: {

        			     "Content-Type":"application/json",//pour force le json
        			     "Accept":"application/json, test-plain",
        			     "X-Requested-With":"XMLHttpRequest",
        			     "X-CSRF-TOKEN":token
        					},
        			methode:'post',
        			body: JSON.stringgify({
        				paymentIntent = paymentIntent
        			})
        		}
        	).then((data)=>{
        		window.location.href = redirect;
        	}).catch((error)=>{
        		console.log(error)
        	})
      }
    }
  });
});

</script>
@endsection