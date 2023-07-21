<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Cart</title>
    <link rel="stylesheet" href="/css/cartbtn.css">
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
                <li class="list">
                    <span>
                        <div class="imgBx">
                            <img src="{{ $cart->product->images->first()->file_path }}" alt="{{$cart->product->name}}">
                        </div>
                        <div>
                            <p class="desc">{{$cart->product->description}}</p>
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
                <li class="tail">
                    <div>
                        <span>
                            <a href="/store" class="btn">Swipe Back<span><i class="fa fa-arrow-left" aria-hidden="true"></i></span></a> 
                        </span>
                        <span>
                            <h4>Total</h4>
                            <p class="total-amount">{{$totalAmount}}</p>
                        </span>
                    </div>
                </li>
                <li class="discount">
                    <div class="coupon_code">
                        <h5>If you have a coupon code, please enter here</h5>
                        <form action="" method="POST">
                            @csrf
                            <input type="text" placeholder="Please enter your code here">
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                    <div class="center">
                        <a href="{{route('payment')}}" class="a">
                            <div>
                                <div>
                                    <span>Buy Now</span>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <span><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>    
                    </div>
                </li>
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
            const minusBtns = document.querySelectorAll(".minus");
            const plusBtns = document.querySelectorAll(".plus");
            const quantityInputs = document.querySelectorAll(".quantity-input");
            const totalPrices = document.querySelectorAll(".total-price");
            const totalAmountElement = document.querySelector(".total-amount");
    
            minusBtns.forEach((btn) => btn.addEventListener("click", () => updateQuantity(btn, -1)));
            plusBtns.forEach((btn) => btn.addEventListener("click", () => updateQuantity(btn, 1)));
    
            function updateQuantity(clickedBtn, quantityChange) {
                const productId = clickedBtn.getAttribute("data-product-id");
                const quantityInput = clickedBtn.parentNode.querySelector(".quantity-input");
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
    
                    // Update the total price for the specific cart item
                    const cartIndex = Array.from(quantityInputs).indexOf(quantityInput);
                    totalPrices[cartIndex].innerText = response.data.carts[cartIndex].total_price;
    
                    // Calculate and update the total amount for all cart items
                    const totalAmount = Array.from(totalPrices).reduce((total, el) => total + parseFloat(el.innerText), 0);
                    totalAmountElement.innerText = totalAmount.toFixed(2);
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