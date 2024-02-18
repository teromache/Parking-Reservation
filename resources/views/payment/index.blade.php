<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

    <style>
        body {
            background-image: url('/img/invoice_bg.jpg');
            background-size: cover;
            background-position: center;
            /* background-repeat: no-repeat; */
        }
    </style>
</head>

<body>
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-heading display-table">
                        <h2 class="panel-title">PAYMENT FORM</h2>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('error'))
                        <div class="alert alert-danger text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('error') }}</p>
                        </div>
                        @endif

                        <form id='checkout-form' method='post' action="{{ route('payment.reservation') }}">
                            @csrf
                            <input type='hidden' name='stripeToken' id='stripe-token-id'>
                            <br>
                            <center>
                                <img src="{{ asset('img/visa.jpg') }}" width="300px" height="200px" alt="">
                            </center>
                            <div id="card-element" class="form-control"></div>
                            <button id='pay-btn' class="btn btn-primary mt-3" type="button"
                                style="margin-top: 20px; width: 100%;padding: 7px;" onclick="createToken()">PROCEED
                            </button>
                            <form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
    var stripe = Stripe('{{ env('STRIPE_KEY') }}');
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');

    /*------------------------------------------
    --------------------------------------------
    Create Token Code
    --------------------------------------------
    --------------------------------------------*/
    function createToken() {
        document.getElementById("pay-btn").disabled = true;
        stripe.createToken(cardElement).then(function (result) {

            if (typeof result.error != 'undefined') {
                document.getElementById("pay-btn").disabled = false;
                alert(result.error.message);
            }

            /* creating token success */
            if (typeof result.token != 'undefined') {
                document.getElementById("stripe-token-id").value = result.token.id;
                document.getElementById('checkout-form').submit();
            }
        });
    }
</script>

</html>
