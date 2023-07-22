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
                <div class="shadow col-5 p-3">
                    <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal"
                        role="form">
                        <h4 class="text-uppercase mb-2">It's almost done...</h4>
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput"
                                value="{{ Auth::user()->username }}" readonly>
                            <label for="floatingInput">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput"
                                value="{{ Auth::user()->email }}">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" id="floatingAmount" name="amount" value="{{ $totalAmount }}"
                                readonly class="form-control mb-2">
                            <label for="floatingAmount">Total Amount</label>
                        </div>
                        <input type="hidden" class="form-control" name="orderID" value="">
                        <input type="hidden" name="currency" value="NGN">
                        <input type="hidden" name="metadata"
                            value="{{ json_encode($array = ['key_name' => 'value']) }}">
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
                <div class="shadow col-5 p-3 bg-white">
                    @foreach ($carts as $cart)
                    <div class="shadow p-2 mb-3 ">
                        <div class="imgBx">
                            <img src="{{ $cart->product->images->first()->file_path }}" alt="{{$cart->product->name}}">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
{{-- <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
            <div class="row" style="margin-bottom:40px;">
                <div class="col-md-8 col-md-offset-2">
                    <p>
                        <div>
                            Lagos Eyo Print Tee Shirt
                            ₦ 2,950
                        </div>
                    </p>
                   <input type="hidden" name="email" value="{{Auth::user()->email}}">
                  {{--  <input type="hidden" name="orderID" value="345">
                    <input type="number" name="amount" value="800" required> {{-- required in kobo --}}
{{-- <input type="hidden" name="quantity" value="3">
                    <input type="hidden" name="currency" value="NGN">
                    <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value',]) }}" >  For other necessary things you want to add to your payload. it is optional though --}}
{{-- <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">  --}}
{{-- required --}}

{{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}



{{-- <p>
                        <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
                            <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                        </button>
                    </p> --}}
{{-- </div>
            </div>
        </form> --}}
