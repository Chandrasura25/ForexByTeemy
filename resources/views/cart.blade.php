<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Cart</title>
    <link rel="stylesheet" href="/css/cart.css">
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
                        <img src="/image/avatar.jpg" alt="">
                        <div>
                            <h5>Product Name</h5>
                            <p>Product Description</p>
                        </div>
                    </span>
                    <span>
                        <h4>Size</h4>
                    </span>
                    <span>
                        <input type="number" value="1" min="1">

                    </span>
                    <span>
                        <form action="" method="post">
                            <input type="hidden" name="id" value="">
                            <button class="remove">Remove</button>
                        </form>
                    </span>
                    <span>
                        <h4>Price</h4>
                    </span>
                </li>
            </ul>
        </div>
    </section>
</body>
</html>