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

    <div class="card shadow-sm" style="width: 100%; max-width: 800px; height: 50%;">
        <div class="card-body mb-5 mt-5">
            <div style="display: flex; align-items: center; justify-content: center">
                <h1 class="card-title text-center mb-4" style="margin: 0; font-weight: bold">Payment</h1>
                <img src="/assets/logo.png" style="width: 4vw; margin-left: 5px;">
            </div>
            

            <h5 class="text-center mb-4 mt-2">Your Payment Amount: {{ $price }}</h5>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('updatePaid') }}">
                @csrf
                <div class="mb-3">
                    <label for="payment_amount" class="form-label">Enter Payment Amount:</label>
                    <input type="number" id="payment_amount" name="payment_amount" class="form-control" placeholder="Please input the exact amount" required>
                </div>

                <input type="hidden" id="price" name="price" value="{{ $price }}">

                <div class="d-grid">
                    <button type="submit" class="btn btn-outline-primary">Pay</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
