<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paid Orders</title>
    <link rel="stylesheet" href="/css/order.css">
    <link rel="stylesheet" href="/css/menu.css">
</head>

<body>
    @include('layouts.loader')
    <div class="container">
        <header>
            <h4>My Paid Orders</h4>
            <div class="navigate">
                <div class="toggleMe"><span></span></div>
                <ul class="ul">
                    <li style="--i:0"><a href="/home">Home</a></li>
                    <li style="--i:1"><a href="/cart">Cart</a></li>
                    <li style="--i:2"><a href="/store">Store</a></li>
                </ul>
            </div>
        </header>
        <div class="order">
            @if ($orders->count() > 0)
                @foreach ($orders as $order)
                    <div class="orderItem">
                        <div class="orderItemHeader">
                            <h3>Order ID: {{ $order->id }}</h3>
                            <h3>Order Date: {{ $order->created_at }}</h3>
                        </div>
                        <div class="orderItemBody">
                            <div class="orderItemBodyLeft">
                                <h3>Product Name</h3>
                                <h3>Product Price</h3>
                                <h3>Product Quantity</h3>
                                <h3>Product Total</h3>
                            </div>
                            <div class="orderItemBodyRight">
                                <h3>{{ $order->product->name }}</h3>
                                <h3>{{ $order->product->price }}</h3>
                                <h3>{{ $order->quantity }}</h3>
                                <h3>{{ $order->total }}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="unpaidBx">
                    <h3>Ooops!!! You have no paid orders yet</h3>
                </div>
            @endif
        </div>
        <script>
            let navigation = document.querySelector('.navigate')
            document.querySelector('.toggleMe').onclick = function() {
                this.classList.toggle('active')
                navigation.classList.toggle('active')
            }
        </script>
        <script src="//code.jquery.com/jquery.js"></script>
        <script>
            $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
        </script>
</body>

</html>
