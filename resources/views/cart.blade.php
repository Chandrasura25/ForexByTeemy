<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Cart</title>
    <link rel="stylesheet" href="/css/cart.css">
    <link rel="stylesheet" href="/css/flash.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    @include('layouts.loader')
    <section>
        <header>
            <h4>My Shopping Cart</h4>
            @include('flash::message')
        </header>
        <div class="container">
            @if ($carts->count() > 0)
            <ul>
                <li class='head'>
                    <span>Description</span>
                    <span>Name</span>
                    <span>Quantity</span>
                    <span>Remove</span>
                    <span>Price</span>
                </li>
                @foreach ($carts as $cart)
                <li>
                    <span>
                        <div class="imgBx">
                            <img src="{{ $cart->product->images->first()->file_path }}" alt="{{$cart->product->name}}">
                        </div>
                        <div>
                            <p>{{$cart->product->description}}</p>
                        </div>
                    </span>
                    <span>
                        <h4>{{$cart->product->name}}</h4>
                    </span>
                    <span>
                        <form action="" method="post">
                           <i class="minus"><i class="fa fa-minus" aria-hidden="true"></i></i>
                           <input type="text" class="quantity-input" name="quantity" value="{{$cart->quantity}}" min="1">
                           <i class="plus"><i class="fa fa-plus" aria-hidden="true"></i></i>
                        </form>
                    </span>
                    <span>
                        <form action="/cart/{{$cart->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="">
                            <button class="remove">
                                <a href="#" class="btn"><i></i><text>Delete</text></a> 
                            </button>
                        </form>
                    </span>
                    <span>
                        <h4>{{$cart->product->price}}</h4>
                    </span>
                </li>
                @endforeach
            </ul>
            @else
            <div class="visit">
                <h3>Ooops!! Looks like you do not have any product in your cart, why don't you visit the <a href="/store">Store</a>?</h3>
            </div>
            @endif
        </div>
    </section>
    <script>
        let btn = document.querySelector('.btn');
        btn.onclick = function(){
           btn.classList.toggle('active') 
        }
        document.addEventListener("DOMContentLoaded", function() {
          const minusButton = document.querySelector(".minus");
          const plusButton = document.querySelector(".plus");
          const quantityInput = document.querySelector(".quantity-input");
      
          minusButton.addEventListener("click", function() {
            updateQuantity(-1);
          });
      
          plusButton.addEventListener("click", function() {
            updateQuantity(1);
          });
      
          function updateQuantity(value) {
            let newValue = parseInt(quantityInput.value) + value;
            if (newValue < 1) {
              newValue = 1;
            }
            quantityInput.value = newValue;
          }
        });
      </script>
      <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
</body>
</html>