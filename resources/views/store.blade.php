<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <link rel="stylesheet" href="/css/store.css">
    <link rel="stylesheet" href="/css/product.css">
    <link rel="stylesheet" href="/css/card.css">
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
        <div class="contain">
         <section class="carousel"></section>
         <section class="recent">
            @if ($products->count() > 0)
            <h2>Recent Products</h2>
            <div class="firstSection">
                @foreach ($products->sortByDesc('created_at') as $product)
                        <div class="ui-card">
                            @if ($product->images->count() > 0)
                               <img src="{{ $product->images->first()->file_path }}" alt="{{$product->name}}">
                            @else
                                <p>No image available</p>
                            @endif
                            <div class="description">
                                <h3>{{$product->name}}</h3>
                                <p>{{$product->description}}</p>
                                <div class="amount">
                                    <span>Price: {{$product->price}}</span>
                                    <span>Quantity: {{$product->quantity}}</span>
                                </div>
                                <a href="product/{{$product->id}}">See More</a>
                                <a href="/cart">Add to Cart</a>
                            </div>
                        </div>
                @endforeach
            </div>
           @endif
         </section>
         <section class="product">
            <div class="content">
                @if ($products->count() > 0)
                    <section class="section">
                        <div class="items">
                            <ul>
                                <li class="list active" data-filter="All">All</li>
                                <li class="list" data-filter="Services">Services</li>
                                <li class="list" data-filter="Physical">Physical</li>
                                <li class="list" data-filter="Download">Download</li>
                            </ul>
                        </div>
                        <div class="products">
                            @foreach ($products->sortBy('created_at') as $product)
                                <div class="box itemBox {{$product->productType->name}}">  
                                    <div class="figure">
                                        @if ($product->images->count() > 0)
                                         <img src="{{ $product->images->first()->file_path }}" alt="{{$product->name}}">
                                        @else
                                            <p>No image available</p>
                                        @endif
                                        <div class="caption">
                                            <div class="about">
                                                <h2>{{$product->name}}</h2>
                                                <p>{{$product->description}}</p>
                                                <div class="amount">
                                                    <span>Price: {{$product->price}}</span>
                                                    <span>Quantity: {{$product->quantity}}</span>
                                                </div>
                                                <a href="product/{{$product->id}}">See More</a>
                                                <div class="action">
                                                    <a href="/cart">Add to Cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </section>
                @else
                    <div class="create">
                        <h2>There is no product available</h2>
                    </div>
                @endif
            </div>
         </section>
        </div>
    </div>
    <script>
        function menuToggle(){
         var nav = document.querySelector('header') 
            nav.classList.toggle('active') 
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
       <script>
        $(document).ready(function(){
            $('.list').click(function(){
                const value = $(this).attr('data-filter');
                if(value == 'All'){
                    $('.itemBox').show('1000')
                }
                else{
                    $('.itemBox').not('.'+value).hide('1000')
                    $('.itemBox').filter('.'+value).show('1000')
                }
            })
            $('.list').click(function(){
                $(this).addClass('active').siblings().removeClass('active')
            })
        })
    </script>
</body>
</html>