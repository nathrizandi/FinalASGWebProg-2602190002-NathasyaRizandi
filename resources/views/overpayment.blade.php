<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow-sm" style="width: 100%; max-width: 1000px;">
        <div class="card-body text-center">
            <div style="display: flex; align-items: center; justify-content: center">
                <h1 class="card-title mb-4" style="font-weight: bold; margin: 0;">Overpayment</h1>
                <img src="/assets/logo.png" style="width: 5vw; margin-left: 10px;">
            </div>            
            <p class="mb-4">You overpaid for ${{ number_format($amount, 2) }}. Enter that amount into the wallet?
            </p>

            <form method="POST" action="{{ route('process.overpayment') }}">
                @csrf
                <input type="hidden" name="amount" value="{{ $amount }}">
                <input type="hidden" name="payment_amount" value="{{ $payment_amount }}">
                <input type="hidden" name="price" value="{{ $price }}">

                <div class="d-grid gap-2 d-md-block">
                    <button type="submit" name="action" value="accept" class="btn btn-outline-primary me-2">Yes</button>
                    <button type="submit" name="action" value="decline" class="btn btn-outline-danger">No</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
