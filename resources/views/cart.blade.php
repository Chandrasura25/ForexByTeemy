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
            <ul>
                <li class='head'>
                    <span>Description</span>
                    <span>Name</span>
                    <span>Quantity</span>
                    <span>Remove</span>
                    <span>Price</span>
                </li>
                <li>
                    <span>
                        <div class="imgBx">
                            <img src="/image/avatar.jpg" alt="">
                        </div>
                        <div>
                            <p>Product Description</p>
                        </div>
                    </span>
                    <span>
                        <h4>Product Name</h4>
                    </span>
                    <span>
                        <form action="" method="post">
                           <i class="minus"><i class="fa fa-minus" aria-hidden="true"></i></i>
                           <input type="text" class="quantity-input" name="quantity" value="1" min="1">
                           <i class="plus"><i class="fa fa-plus" aria-hidden="true"></i></i>
                        </form>
                    </span>
                    <span>
                        <form action="" method="post">
                            <input type="hidden" name="id" value="">
                            <button class="remove">
                                <a href="#" class="btn"><i></i><text>Delete</text></a> 
                            </button>
                        </form>
                    </span>
                    <span>
                        <h4>Price</h4>
                    </span>
                </li>
            </ul>
        </div>
    </section>
    <script>
        let btn = document.querySelector('.btn');
        btn.onclick = function(){
           btn.classList.toggle('active') 
        }
    </script>
    <script>
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