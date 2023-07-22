<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Make A Payment</title>
    <link rel="stylesheet" href="/css/payment.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid m-0 p-0">
        <h4 class="text-uppercase text-center mt-4 display-4">Make Payments</h4>
        <div class="mt-2 p-4 d-flex justify-content-center align-items-center">
            <div class="col-11 d-flex justify-content-between flex-wrap align-items-center">
                <div class="shadow col-md-5 p-3 col-sm-11">
                    <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal"
                        role="form">
                        <h4 class="text-uppercase mb-2">It's almost done...</h4>
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput"
                                value="{{ Auth::user()->username }}" readonly name="username">
                            <label for="floatingInput">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput"
                                value="{{ Auth::user()->email }}" name="email">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" id="floatingAmount" value="{{ $totalAmount }}"
                                readonly class="form-control mb-2">
                            <label for="floatingAmount">Total Amount</label>
                        </div>
                        <input type="hidden" name="amount" value="{{ $totalAmount * 100 }}">
                        <input type="hidden" name="orderID" value="{{$orderID}}">
                        <input type="hidden" name="currency" value="NGN">
                        <input type="hidden" name="metadata" value="{{ json_encode(['user_id' => Auth::user()->id]) }}">
                        <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput"
                                value="{{ Auth::user()->number ?? '00000000000' }}">
                            <label for="floatingInput">Phone Number</label>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="/cart" class="btn btn-warning text-white">Go Back</a>
                            <button class="btn btn-success" type="submit">Make Payment</button>
                        </div>
                    </form>
                </div>
                <div class="shadow col-md-5 col-sm-11 p-3 bg-white">
                    @foreach ($carts as $cart)
                    <div class="shadow p-3 mb-3 d-flex justify-content-between align-items-center">
                        <div class="imgBx">
                            <img src="{{ $cart->product->images->first()->file_path }}" alt="{{$cart->product->name}}">
                        </div>
                        <div>
                            <p class="fs-4 text-capitalize">{{$cart->product->name}}</p>
                        </div>
                        <div>
                            <p class="fs-4 fw-bold">₦{{ $cart->product->price }} x {{ $cart->quantity }}</p>
                        </div>
                    </div>
                    @endforeach
                    <div class="d-flex justify-content-between">
                        <p class="fs-4 fw-bold">Total Amount</p>
                        <p class="fs-4 fw-bold border border-2 px-3 py-2">₦{{ $totalAmount }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
