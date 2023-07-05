<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Product - {{$product->id}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/createcoupon.css">
    <link rel="stylesheet" href="/css/createproduct.css">
    <link rel="stylesheet" href="/css/flash.css">
    @cloudinaryJS
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body class="cover">
    <div class="container-fluid p-4 m-0">
        <div class="mb-3 fw-bold text-uppercase display-6 d-flex justify-content-between">
            <h2>Edit Product</h2>
            <a href="/product" class="btn btn-dark text-decoration-none px-4">Back</a>
        </div>
        @include('flash::message')
        <div class="content">
            <form action="/product/{{$product->id}}" method="post" class="d-flex gap-4 justify-content-between align-items-center" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="left bg-white w-50">
                    <h2 class="title">General</h2>
                     <div class="formBx">
                        <div class="chanBx">
                            <h5>Product Type</h5>
                            <div class="chan">
                            @foreach($product_types as $type)
                                <div class="inputBx">
                                    <input type="radio" class="form-check-input" name="product_type_id" id="{{ $type->id }}" value="{{ $type->id }}" required
                                    {{ $type->id == $product->product_type_id ? 'checked' : '' }}>
                                    <span>{{ $type->name }}</span>
                                </div>
                            @endforeach
                            </div>
                        </div>
                        <div class="p-3">
                            <div>
                                <div class="form-floating mb-2">
                                  <input type="text" class="form-control" id="floatingInput" placeholder="Product Name" required name="name" value="{{$product->name}}">
                                  <label for="floatingInput">Product Name</label>
                                </div>
                                @error('name')
                                <small>{{$message}} </small> 
                                @enderror
                                <div class="form-floating mb-2" id="percentageInput">
                                  <input type="number" class="form-control" id="percentage" placeholder="Quantity" name="quantity" value="{{$product->quantity}}">
                                  <label for="percentage">Quantity</label>
                                </div>
                                @error('description')
                                <small>{{$quantity}} </small> 
                                @enderror
                                <div class="form-floating mb-2" id="fixedInput">
                                  <input type="number" class="form-control" id="fixed" placeholder="Price" name="price" value="{{$product->price}}" required>
                                  <label for="fixed">Price</label>
                                </div>
                                @error('description')
                                <small>{{$price}} </small> 
                                @enderror
                                <div class="form-floating">
                                    <textarea class="form-control" name="description" required placeholder="Description" id="floatingTextarea" name="description">{{$product->description}}</textarea>
                                    <label for="floatingTextarea">Description</label>
                                </div>
                                @error('description')
                                <small>{{$message}} </small> 
                                @enderror
                            </div>                              
                        </div>
                     </div>
                </div>
                <div class="right bg-white w-50">
                    <h2 class="title">Others</h2>
                        <div class="formBx">
                           <div class="p-3">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Product Image(s)</label>
                                    <input class="form-control" name="images[]" type="file" id="formFile" multiple accept=".jpg,.png,.jpeg,.svg,.gif">
                                </div>
                                <div class="form-floating mb-2">
                                    <input type="number" class="form-control" id="floatingInput" placeholder="Commission" required name="commission" value="{{$product->commission}}">
                                    <label for="floatingInput">Commission</label>
                                </div>
                                <div id="dateInputs">
                                    <div class="form-floating mb-2">
                                        <input type="datetime-local" class="form-control" id="startDate" name="expiration_date" value="{{$product->expiration_date}}">
                                        <label for="startDate">Expiration Date</label>
                                    </div>         
                                </div>   
                                
                                <div class="position-absolute bottom-0 end-0 p-4">
                                    <button class="btn btn-outline-success px-4">Update</button>
                                </div>                                                  
                            </div> 
                        </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
</body>
</html>