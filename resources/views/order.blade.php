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
        @include('layouts.share')
        <div class="order">
            @if ($orders->count() > 0)
            <table>
                <thead>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Payment Status</th>
                    <th>Payment Channel</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                    <th>Product Total</th>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->payment_status }}</td>
                            <td>{{ $order->payment_channel }}</td>
                            <td>{{ $order->product->name }}</td>
                            <td>{{ $order->product->price }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->total_price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="unpaidBx">
                    <h3>Ooops!!! You have no paid orders yet!!!</h3>
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
