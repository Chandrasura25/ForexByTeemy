<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Cart</title>
    <link rel="stylesheet" href="/css/cart.css">
    {{-- font awesome cdn 6.0 --}}
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
</head>
<body>
    @include('layouts.loader')
    <section>
        <header>
            <h4>My Shopping Cart</h4>
        </header>
        <div class="container">
            <ul>
                <li class='head'>
                    <span>Description</span>
                    <span>Size</span>
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
                            <h5>Product Name</h5>
                            <p>Product Description</p>
                        </div>
                    </span>
                    <span>
                        <h4>Size</h4>
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
</body>
</html>