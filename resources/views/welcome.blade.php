<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
       
        <!-- Fonts -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" /> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    </head>
    <body>
        <div>
            <header>
                <nav id="navbar">
                    <a href="#" class="brand">
                        <span><img src="" alt=""></span>
                        <span>Teemy</span>
                    </a>
                    <div class="menuToggle"></div>
                    <ul>
                        <li style="--i:0;">
                            <a href="#">
                                <span>Home</span>
                                <span><i class="fas fa-home"></i></span>
                            </a>
                        </li>
                        <li style="--i:1;">
                            <a href="#about">
                                <span>About</span>
                                <span><i class="fas fa-info-circle"></i></span> 
                            </a>
                        </li>
                        <li style="--i:2;">
                            <a href="#">
                                <span>Affiliates</span>
                                <span><i class="fas fa-handshake"></i></span>
                            </a>
                        </li>
                        <li style="--i:3;">
                            <a href="#">
                                <span>Store</span>
                                <span><i class="fas fa-store"></i></span>
                            </a>
                        </li>
                        <li style="--i:4;">
                            <a href="#">
                                <span>Contact</span>
                                <span><i class="fas fa-envelope"></i></span>
                            </a>
                        </li>
                        <li style="--i:5;">
                            <a href="#">
                                <span>Members</span>
                                <span><i class="fas fa-users"></i></span>
                            </a>
                        </li>
                        <li style="--i:6;">
                            <a href="#">
                                <span>Services</span>
                                <span><i class="fas fa-cogs"></i></span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </header>
            <div class="banner"></div>
            <div id="about"></div>
        </div>
        <script>
            let lastScrollTop =0;
            const menuToggle = document.querySelector('.menuToggle'); 
            navbar = document.getElementById('navbar');
            window.addEventListener("scroll",()=>{
                let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                if(scrollTop > lastScrollTop){
                    navbar.classList.add('icon');
                } else{
                    navbar.classList.remove('icon');
                }
                lastScrollTop = scrollTop;
            })
               menuToggle.addEventListener('click',()=>{
               menuToggle.classList.toggle('active')
               navbar.classList.toggle('active')
            })
           </script>
    </body>
</html>
