<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/createcoupon.css">
</head>
<body>
    <div class="container">
        <div class="title">
            <h2>Add Coupon</h2>
        </div>
        <div class="content">
            <form action="" method="post">
                <div class="left">
                    <h2 class="title">General</h2>
                     <div class="formBx">
                        <div class="chanBx">
                            <h5>Coupon Channel</h5>
                            @foreach ($couponChannels as $channel)
                                <div class="inputBx">
                                    <input type="radio" name="channel" id="{{ $channel }}" value="{{ $channel }}">
                                    <span>{{ $channel }}</span>
                                </div>
                            @endforeach
                        </div>
                     </div>
                </div>
                <div class="right">
                    <h2 class="title">Usage</h2>
                </div>
            </form>
        </div>
    </div>
</body>
</html>