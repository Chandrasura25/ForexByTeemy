<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <link rel="stylesheet" href="/css/store.css">
</head>
<body>
    @include('layouts.loader')
    <div class="container">
        <header>
            <a href="/" class="logo">ForexBy<span>Teemy</span></a>
            @if (Auth::check())
             <ul class="navigation">
                <li><a href="/" >Home</a></li>
                <li><a href="#" class="active">Store</a></li>
                <li><a href="/cart">Cart</a></li>
                <li><a href="/home">Dashboard</a></li>
             </ul>  
            @else
             <ul class="navigation">
                <li><a href="/" >Home</a></li>
                <li><a href="#" class="active">Store</a></li>
                <li><a href="/register">Register</a></li>
                <li><a href="/login">Login</a></li>
             </ul>
            @endif
              <span class="menuIcon" onclick="menuToggle()"></span>
        </header>
        <div class="content">
         
        </div>
    </div>
    <script>
        function menuToggle(){
         var nav = document.querySelector('header') 
            nav.classList.toggle('active') 
        }
    </script>
</body>
</html>