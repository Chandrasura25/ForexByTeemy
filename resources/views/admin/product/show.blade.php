<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product {{$product->id}}</title>
    <link rel="stylesheet" href="/css/showproduct.css">
    <link rel="stylesheet" href="/css/menu.css">
</head>
<body>
    @include('layouts.loader')
    <div class="navigate">
        <div class="toggleMe"><span></span></div>
        <ul class="ul">
            @if ($isAdmin)
            <li style="--i:0"><a href="/product">Product</a></li>
            <li style="--i:0"><a href="/product/create">Create Product</a></li>
            <li style="--i:1"><a href="/admin/dashboard">Dashboard</a></li>
            @else
            <li style="--i:0"><a href="/home">Home</a></li>
            <li style="--i:1"><a href="/cart">Cart</a></li>
            <li style="--i:2"><a href="/store">Store</a></li>
            @endif
        </ul>
    </div>
    <div class="container">
        <ul class="thumb">
            @if ($product->images->count() > 0)
                @foreach ($product->images as $image)
                <li onmouseover="changeImg('{{ $image->file_path }}')">
                    <img src="{{ $image->file_path }}" alt="{{ $product->name }}">
                </li>
                @endforeach
            @else
                <p>No image available</p>
            @endif
        </ul>
     <div class="imgBox">
       <h2>{{$product->name}}</h2>
       @if ($product->images->count() > 0)
            <img src="{{ $product->images->first()->file_path }}" alt="{{$product->name}}" class="product">
        @else
            <p>No image available</p>
        @endif
       <ul class="size">
         <span>Price</span>
         <li>{{$product->price}}</li>
       </ul>
       <form action="/cart" method="post" class="cart">
        @csrf
         <input type="hidden" name="product_id" value="{{$product->id}}">
         <button class="btn">Add To Cart</button>
       </form>
     </div>
    </div> 
    <script>
     function changeImg(anything){
       document.querySelector('.product').src=anything
     }
        let navigation = document.querySelector('.navigate')
        document.querySelector('.toggleMe').onclick = function (){
            this.classList.toggle('active')
            navigation.classList.toggle('active')
        }
    </script>
 </body>
</html>