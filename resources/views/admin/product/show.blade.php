<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product {{$product->id}}</title>
    <link rel="stylesheet" href="/css/showproduct.css">
</head>
<body>
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
            <img src="{{ $product->images->first()->image_path }}" alt="{{$product->name}}" class="product">
        @else
            <p>No image available</p>
        @endif
       <ul class="size">
         <span>Size</span>
         <li>7</li>
         <li>8</li>
         <li>9</li>
         <li>10</li>
       </ul>
       <a href="#" class="btn">Add To Cart</a>
     </div>
    </div> 
    <script>
     function changeImg(anything){
       document.querySelector('.product').src=anything
     }
    </script>
 </body>
</html>