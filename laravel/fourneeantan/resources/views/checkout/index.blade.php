@extends('layouts.app')

@section('extra-meta')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('extra-script')
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')
<h1 class="h1 m-8">Procéder au paiement</h1>

{{-- @if (session()->has('message')) --}}
@if (session()->has('message'))
  <div class="border border-green 700 text-green-700 bg-green-200 px-1 py-2 rounded">
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
  </div>
@endif

{{-- @endif --}}

<div class="border p-8 text-four w-full lg:w-1/2 bg-white mt-8">
     {{-- <form action="{{ route('checkout.store') }}" method="post" id="payment-form"> --}}
        <form action="{{ route('checkout.store') }}" method="POST" id="payment-form">
        @csrf
        <div class="text-black text-justify mb-8">Vous avez choisi de payer par carte bancaire. Veuillez compléter le présent formulaire pour procéder à ce règlement.
            <p>Nous ne conservons aucune de ces informations sur notre site, elles sont directement transmises à notre prestataire de paiement <a href="https://stripe.com/fr">Stripe</a>.</p>
            <p>La transmission de ces informations est entièrement sécurisée.</p>
        </div>
        <h2 class="text-center mb-8">INFORMATIONS DE FACTURATION</h2>
        <label for="nomprenom" class="label">Titulaire de la carte :</label>
        <input class="input" type="text" name="cardholder-name" id="nomprenom" required placeholder="Votre nom et prénom"/>
            <div class="mt-8">
            <label>
                <div id="card-element" class="input"></div>
            </label>
            </div>

        <div class="outcome">
            <div class="error" id="card-errors"></div>
        </div>
        <div class="flex w-full h-16 mt-8 justify-center items-center content-center flex-wrap">
            <div class="text-center w-full lg:w-1/3">
                <a href="{{ route('cart.index') }}" class="text-red-500">Revenir au panier</a>
            </div>

            <div class="flex justify-center w-full lg:w-2/3">
                <input type="hidden" id="stripeToken" name="stripeToken">
                <button class="btn mt-3 bouton" id="submit">
                    <i class="fa fa-credit-card" aria-hidden="true"></i> <span class="text-lg"> Payer maintenant ({{ Cart::total() }} €)</span>
                </button>
            </div>
        </div>
            </form>
        </div>

<div class="mt-8 mb-32">Carte de test : 4242424242424242</div>

@endsection

@section('extra-js')
<script>
    // Paiement Stripe
    var stripe = Stripe('pk_test_51Iom7WFHaO8s4QhUJZfGrRBWJQq7wmiZtpGMq5wAIXAtX8l4JgpoWMtfYeqrUJpJvqyYWkPcv4OgZqmV5ivP9LQP00eznKPuaX');
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
            displayError.classList.add('alert', 'alert-warning', 'mt-3');
            displayError.textContent = error.message;
        } else {
            displayError.classList.remove('alert', 'alert-warning', 'mt-3');
            displayError.textContent = '';
        }
    });
    var submitButton = document.getElementById('submit');
    submitButton.addEventListener('click', function(ev) {
    ev.preventDefault();
    submitButton.disabled = true;
    stripe.confirmCardPayment("{{ $clientSecret }}", {
        payment_method: {
            card: card
        }
        }).then(function(result) {
            if (result.error) {
            // Show error to your customer (e.g., insufficient funds)
            submitButton.disabled = false;
            console.log(result.error.message);
            } else {
                // The payment has been processed!
                if (result.paymentIntent.status === 'succeeded') {
                    var paymentIntent = result.paymentIntent;
                    var infoCommande = "{{ $infoCommande }}";
                    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    var form = document.getElementById('payment-form');
                    var url = form.action;
                    var redirect = '/merci';
                    fetch(
                        url,
                        {
                            headers: {
                                "Content-Type": "application/json",
                                "Accept": "application/json, text-plain, */*",
                                "X-Requested-With": "XMLHttpRequest",
                                "X-CSRF-TOKEN": token
                            },
                            method: 'post',
                            body: JSON.stringify({
                                payment_intent: paymentIntent,
                                infoCommande:infoCommande
                            })
                        }).then((data) => {
                            console.log(data);
                            form.reset();
                            window.location.href = redirect;
                    }).catch((error) => {
                        console.log(error)
                    })
                }
            }
        });
    });
</script>
@endsection



