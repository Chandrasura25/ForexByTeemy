<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Make A Payment</title>
    <link rel="stylesheet" href="/css/payment.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid m-0 p-0">
      
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
  {{--<form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
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
                    {{--<input type="hidden" name="quantity" value="3">
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