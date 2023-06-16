<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="/css/adminform.css">
    @cloudinaryJS
</head>
<body>
    <section class="section">
       <form method="post" class="signin" action="{{route('admin.signup')}}" enctype="multipart/form-data">
        @csrf
            <div class="content">
                <h2>Sign Up</h2>
                <div class="form">
                    <div class="inputBx">
                       <input type="text" required name="username"> 
                       <i>Username</i>
                    </div>
                    @error('username')
                    <small>{{$message}} </small> 
                    @enderror
                    <div class="inputBx">
                        <input type="email" required name="email" autofocus> 
                        <i>Email Address</i> 
                    </div>
                    @error('email')
                    <small>{{$message}} </small> 
                    @enderror
                    <div class="inputBx">
                        <input type="password" required name="password"> 
                        <i>Password</i>
                    </div>
                    @error('password')
                    <small>{{$message}} </small> 
                    @enderror
                    <div class="inputBx">
                        <input type="file" required name="image_path" accept=".jpg,.png,.gif,.svg" > 
                        <i>Picture</i>
                    </div>
                    @error('image_path')
                    <small>{{$message}} </small> 
                    @enderror
                    <div class="links">
                        <a href="#"></a>
                        <a href="{{route('admin.login')}}">Signin</a>
                    </div> 
                    <div class="inputBx">
                        <input type="submit" value="Register">
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