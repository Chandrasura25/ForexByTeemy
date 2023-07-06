<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products Available</title>
    <link rel="stylesheet" href="/css/product.css">
    <link rel="stylesheet" href="/css/menu.css">
    <link rel="stylesheet" href="/css/card.css">
    <link rel="stylesheet" href="/css/flash.css">
    @cloudinaryJS
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Products Available</h1>
            <div class="navigate">
                <div class="toggleMe"><span></span></div>
                <ul class="ul">
                    <li style="--i:0"><a href="/product/create">Create Product</a></li>
                    <li style="--i:1"><a href="/admin/dashboard">Dashboard</a></li>
                    <li style="--i:2"><a href="#">Services</a></li>
                    <li style="--i:3"><a href="#">Work</a></li>
                </ul>
            </div>
        </div>
        @include('flash::message')
        <div class="content">
            @if ($products->count() > 0)
                <section>
                    <div class="items">
                        <ul>
                            <li class="list active" data-filter="All">All</li>
                            <li class="list" data-filter="Services">Services</li>
                            <li class="list" data-filter="Physical">Physical</li>
                            <li class="list" data-filter="Download">Download</li>
                        </ul>
                    </div>
                    <div class="products">
                        @foreach ($products as $product)
                           <div class="ui-card itemBox {{$product->productType->name}}">
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
                                <div class="action">
                                    <a href="/product/{{$product->id}}/edit">Edit</a>
                                    <form action="/product/{{$product->id}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
            @else
                <div class="create">
                    <h2>Create New <a href="/product/create">Product</a></h2>
                </div>
            @endif
        </div>
    </div>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
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
    <script type="text/javascript">
        let navigation = document.querySelector('.navigate')
        document.querySelector('.toggleMe').onclick = function (){
            this.classList.toggle('active')
            navigation.classList.toggle('active')
        }
    </script>
</body>
</html>