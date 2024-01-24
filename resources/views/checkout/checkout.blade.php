<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>Checkout</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('/css/checkout.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            @if ($message = Session::get('success'))
                <div class="alert alert-success col-8">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <form action="{{ url('purchase') }}" method="post" id="payment-form">
                @csrf
                <h1>
                    <i class="fas fa-shipping-fast"></i>
                    Shipping Details
                </h1>
                <div class="name">
                    <div>
                        <label for="f-name">First</label>
                        <input type="text" name="f-name" id="f-name" value="">
                    </div>
                    <div>
                        <label for="email">E-mail</label>
                        <input type="text" name="email" id="email" value="">
                    </div>
                </div>
                <div class="street">
                    <label for="name">Street</label>
                    <input type="text" name="address" id="address" value="">
                </div>
                <div class="address-info">
                    <div>
                        <label for="city">City</label>
                        <input type="text" name="city" id="city" value="">
                    </div>
                    <div>
                        <label for="state">State</label>
                        <input type="text" name="state" id="state" value="">
                    </div>
                    <div>
                        <label for="zip">Zip</label>
                        <input type="text" name="zip" id="zip" value="">
                    </div>
                </div>
                <h1>
                    <i class="far fa-credit-card"></i> Payment Information
                </h1>
                <div id="card-elements"></div>
                <input type="hidden" name="amount" id="amount" value="{{ $subtotal }}">
                <div class="btns">
                    <button id="card-button" data-secret="{{ $client_secret }}">Purchase</button>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_PUBLIC_KEY') }}');
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-elements');

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (e) => {
            const cardBtn = document.getElementById('card-button');
            const cardHolderName = $('#f-name').val();
            const amount = $('#amount').val();
            e.preventDefault()

            const { setupIntent, error } = await stripe.confirmCardSetup(
            cardBtn.dataset.secret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.value,
                        amount: amount.value
                    }
                }
            })

            if(error){
                console.log(error);
            }else{
                $('#card-elements').append('<input type="text" name="token" value="'+setupIntent.payment_method+'">');
                form.submit();
            }
        });
    </script>

</body>