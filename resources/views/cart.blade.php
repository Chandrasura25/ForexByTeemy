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
                            <input type="hidden" name="id" value="{{$cart->id}}">
                            <button class="remove" type="submit">Delete</button>
                        </form>
                    </span>
                    <span>
                        <h4 class="total-price">{{ $cart->total_price }}</h4>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", () => { 
        const minusBtn = document.querySelector(".minus");
        const plusBtn = document.querySelector(".plus");
        const quantityInput = document.querySelector(".quantity-input");
        const totalPriceElement = document.querySelector(".total-price");

        minusBtn.addEventListener("click", () => updateQuantity(-1));
        plusBtn.addEventListener("click", () => updateQuantity(1));

        function updateQuantity(quantityChange) {
            const productId = quantityInput.getAttribute("data-product-id");
            let currentQuantity = parseInt(quantityInput.value);

            // Calculate the new quantity and ensure it's at least 1
            const newQuantity = Math.max(currentQuantity + quantityChange, 1);

            // Make an Axios POST request to update the quantity on the server
            axios.post("/updateQuantity", {
                product_id: productId,
                quantity: newQuantity
            })
            .then(response => {
                // Update the quantity input value with the new quantity
                quantityInput.value = newQuantity;
                totalPriceElement.innerText = response.data.carts[0].total_price; // Update the total price
            })
            .catch(error => {
                console.error("Failed to update quantity:", error);
            });
        }
       });
    </script>
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
      </script>
</body>
</html>