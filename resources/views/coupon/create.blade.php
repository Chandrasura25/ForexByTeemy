<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/createcoupon.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid p-4 m-0">
        <div class="mb-3 fw-bold text-uppercase display-6">
            <h2>Add Coupon</h2>
        </div>
        <div class="content">
            <form action="" method="post" class="d-flex gap-4 justify-content-between align-items-center">
                <div class="left bg-white w-50">
                    <h2 class="title">General</h2>
                     <div class="formBx">
                        <div class="chanBx">
                            <h5>Coupon Channel</h5>
                            <div class="chan">
                            @foreach($channels as $channel)
                                <div class="inputBx">
                                    <input type="radio" name="channel_id" id="{{ $channel->id }}" value="{{ $channel->id }}">
                                    <span>{{ $channel->name }}</span>
                                </div>
                            @endforeach
                            </div>
                           <input type="hidden" name="channel_id" id="channel_id">
                        </div>
                        <div class="p-3">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Coupon Code"  required name="coupon_code">
                                <label for="floatingInput">Coupon Code</label>
                            </div>
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                  <option selected>select your coupon type</option>
                                  <option value="Percentage">Percentage</option>
                                  <option value="Fixed">Fixed</option>
                                </select>
                                <label for="floatingSelect">Coupon Type</label>
                              </div>
                        </div>
                     </div>
                </div>
                <div class="right bg-white w-50">
                    <h2 class="title">Usage</h2>
                </div>
            </form>
        </div>
    </div>
</body>
</html>