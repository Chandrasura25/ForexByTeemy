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
                            <i class="minus" data-product-id="{{ $cart->product->id }}" data-quantity="{{ $cart->quantity - 1 }}">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                            </i>
                            <input type="text" class="quantity-input" name="quantity" value="{{$cart->quantity}}" min="1" data-product-id="{{ $cart->product->id }}">
                            <i class="plus" data-product-id="{{ $cart->product->id }}" data-quantity="{{ $cart->quantity + 1 }}">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </i>
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
         $(document).ready(function() {
        // Attach event listeners to the minus and plus buttons
        $("i.minus, i.plus").on("click", function() {
            let product_id = $(this).data("product-id");
            let value = $(this).data("quantity");

            updateCartQuantity(product_id, value);
        });
    });
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
        function updateCartQuantity(product_id, quantity) {
        $.ajax({
            type: 'POST',
            url: '{{ route('updateQuantity') }}',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: product_id,
                quantity: quantity
            },
            success: function(response) {
                // Update the cart display on success
                // For example, you can update the cart icon or cart total
                // Example:
                // $('#cart-total').text(response.cart_total);
                response.carts.forEach(function (cart) {
                        let inputElement = document.querySelector(`[data-product-id="${cart.product.id}"]`);
                        if (inputElement) {
                            inputElement.value = cart.quantity;
                        }
                        console.log(cart.product.id, cart.quantity, inputElement.value);
                    });
                },
            error: function(xhr, status, error) {
                // Handle errors here

                // Flash an error message
                flash('Failed to update cart quantity. Please try again.', 'error');
            }
        });
    }
      </script>
      <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
</body>
</html>