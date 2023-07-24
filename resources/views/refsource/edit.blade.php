<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Your Referral Source</title>
    <link rel="stylesheet" href="/css/editsource.css">
</head>
<body>
    <div class="container">
        <div class="drop">
            <div class="content">
                <h2>Edit Your Ref Source</h2>
                <form action="/source/{{$refsouce->id}}">
                    @csrf
                    @method('PUT')
                    <div class="inputBox">
                        <input type="text" name="source" placeholder="{{$refsource->source}}" id="">
                    </div>
                    <div class="inputBox">
                        <input type="submit" name="" value='Update' id="">
                    </div>
                </form>
            </div>
        </div>
        <a href="/click" class="btns signup">Go Back</a>
    </div>
</body>
</html>