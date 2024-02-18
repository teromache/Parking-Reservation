<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

    <!-- SweetAlert scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <style>
        body {
            background-image: url('/img/invoice_bg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .col-md-6 {
            display: inline-block;
            /* Make sure the element can have margins */
            margin-left: auto;
            /* Push the element to the center */
            margin-right: auto;
            /* Push the element to the center */
            float: none;
            /* Prevent floating */
        }
    </style>
</head>

<body>
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            html: "The payment is success",
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK',
        })
    </script>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 body-main">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <img class="img" alt="Invoce Template"
                                src="http://pngimg.com/uploads/shopping_cart/shopping_cart_PNG59.png" />
                        </div>
                        <div class="col-md-8 text-right">
                            <h4 style="color: #F81D2D;"><i class="fas fa-car"></i><strong> Putera
                                    Parking</strong>
                            </h4>
                            <p>Seri Kembangan</p>
                            <p>013-12345678</p>
                            <p>puteraparking@gmail.com</p>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2>INVOICE #{{ $transaction_id }}</h2>
                            <div>
                                <div class="col-md-12">
                                    <p><b>Date :</b> {{ $date }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <h5>Description</h5>
                                    </th>
                                    <th>
                                        <h5>Amount</h5>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-md-9">Parking <strong>({{ $size }} ;
                                            {{ $duration }}
                                            hour)</strong></td>
                                    <td class="col-md-3"><strong>RM</strong> {{ $price_hour }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                        <p>
                                            <strong>Shipment and Taxes:</strong>
                                        </p>
                                        <p>
                                            <strong>Total Amount: </strong>
                                        </p>
                                    </td>
                                    <td>
                                        <p>
                                            <strong> None
                                            </strong>
                                        </p>
                                        <p>
                                            <strong>RM {{ $price }} ({{ number_format($price_hour, 2) }} X
                                                {{ $duration }}
                                                hours)</strong>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="color: #F81D2D;">
                                    <td class="text-right">
                                        <h4><strong>Total:</strong></h4>
                                    </td>
                                    <td class="text-left">
                                        <h4><strong>RM {{ $price }}</strong></h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <center>
                        <button class="btn btn-primary btn-sm" onclick="printReceipt()">
                            <i class="fas fa-print"></i> Print Receipt
                        </button>

                        <button class="btn btn-info btn-sm" onclick="redirectToMerchant()">
                            <i class="fas fa-store-alt"></i> Return to Merchant
                        </button>
                    </center>
                </div>
            </div>
        </div>
    </div>

</body>

<script>
    function printReceipt() {
        window.print()

    }
</script>
<script>
    function redirectToMerchant() {
        window.location.href = "{{ route('dashboard') }}"
    }
</script>

</html>
