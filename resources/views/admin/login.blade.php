<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <link rel="stylesheet" href="/css/adminform.css">
</head>
<body>
    @include('layouts.loader')
    <section class="section">
       <form method="post" class="signin" action="{{route('admin.signin')}}">
        @csrf
            <div class="content">
                <h2>Sign In</h2>
                <div class="form">
                    <div class="inputBx">
                        <input type="text" required name="username"> 
                        <i>Username Or Email Address</i>
                     </div>
                     @error('username')
                     <small>{{$message}} </small> 
                     @enderror
                     <div class="inputBx">
                        <input type="password" required name="password"> 
                        <i>Password</i>
                    </div>
                    @error('password')
                    <small>{{$message}} </small> 
                    @enderror
                    <div class="links">
                        <a href="#">Forgot Password</a>
                        <a href="{{route('admin.register')}}">Signup</a>
                    </div> 
                    <div class="inputBx">
                        <input type="submit" value="Login">
                     </div>
                </div>
            </div>
       </form>
    </section>
    <script>
        // Get the section element
        var section = document.querySelector('section');
        
        // Get the .signin div element
        var signinDiv = document.querySelector('.signin');
        
        // Create 200 span elements
        for (var i = 0; i < 200; i++) {
          var spanElement = document.createElement('span');
          section.appendChild(spanElement);
        }
        
        // Insert the span elements before the .signin div
        var spans = document.querySelectorAll('section > span');
        spans.forEach(function(span) {
          section.insertBefore(span, signinDiv);
        });

    </script>
</body>
</html>