<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <link rel="stylesheet" href="/css/store.css">
</head>
<body>
    <div class="container">
        <header>
            <a href="/" class="logo">ForexBy<span>Teemy</span></a>
            <ul class="navigation">
                <li><a href="/" >Home</a></li>
                <li><a href="#" class="active">Store</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#">Contact</a></li>
              </ul>
              <span class="menuIcon" onclick="menuToggle()"></span>
        </header>
        <div class="content">
         
        </div>
        
    </div>
    <script>
        function menuToggle(){
            var navigation = document.querySelector('.navigation');
            var menuIcon = document.querySelector('.menuIcon');
            navigation.classList.toggle('active');
            menuIcon.classList.toggle('active');
        }
</body>
</html>