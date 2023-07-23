<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Admin Info</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="/css/admindashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    @cloudinaryJS
</head>

<body>
    @include('layouts.loader')
    <div class="body">
        <div class="glass">
            <div class="container">
                <div class="navigation">
                    <ul>
                        <li>
                            <a href="/">
                                <span class="icon">
                                    <ion-icon name="logo-apple"></ion-icon>
                                </span>
                                <span class="title">ForexByTeemy</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/dashboard">
                                <span class="icon">
                                    <ion-icon name="home"></ion-icon>
                                </span>
                                <span class="title">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="/product">
                                <span class="icon">
                                    <i class="fa-solid fa-upload" aria-hidden="true"></i>
                                </span>
                                <span class="title">Upload</span>
                            </a>
                        </li>
                        <li>
                            <a href="/store">
                                <span class="icon">
                                    <ion-icon name="storefront"></ion-icon>
                                </span>
                                <span class="title">Store</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/edit">
                                <span class="icon">
                                    <i class="fa-solid fa-lock" aria-hidden="true"></i>
                                </span>
                                <span class="title">Password</span>
                            </a>
                        </li>
                        <li>
                            <a href="/blog">
                                <span class="icon">
                                    <ion-icon name="newspaper"></ion-icon>
                                </span>
                                <span class="title">Blog</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="icon">
                                    <ion-icon name="log-out-outline"></ion-icon>
                                </span>
                                <span class="title">Sign Out</span>
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>

                    </ul>
                </div>
                <!-- main container -->
                <div class="main">
                    <div class="topbar">
                        <div class="toggle">
                            <ion-icon name="menu-outline"></ion-icon>
                        </div>
                        <div class="search">
                            <label for="">
                                <input type="search" name="" placeholder="Search Here" id="">
                                <ion-icon name="search-outline"></ion-icon>
                            </label>
                        </div>
                        <div class="user">
                            <img src="{{ $admin->image_path }}" alt="">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
        let toggle = document.querySelector('.toggle');
        let navigation = document.querySelector('.navigation');
        let main = document.querySelector('.main');

        toggle.onclick = function() {
            navigation.classList.toggle('active')
            main.classList.toggle('active')
        }

        let list = document.querySelectorAll('.navigation li');

        function activeLink() {
            list.forEach((item) =>
                item.classList.remove('hovered'));
            this.classList.add('hovered')
        }
        list.forEach((item) =>
            item.addEventListener('mouseover', activeLink));
    </script>
</body>

</html>
