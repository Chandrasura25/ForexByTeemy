<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products Available</title>
    <link rel="stylesheet" href="/css/product.css">
    @cloudinaryJS
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Products Available</h1>
            <a href="/product/create">Add Product</a>
        </div>
        <div class="content">
            <section>
                <div class="items">
                    <ul>
                        <li class="list active" data-filter="All">All</li>
                        <li class="list" data-filter="services">Services</li>
                        <li class="list" data-filter="physical">Physical</li>
                        <li class="list" data-filter="download">Download</li>
                    </ul>
                </div>
                <div class="product">
                    <div class="itemBox mobile"><img src="img/76.jfif" alt=""></div>
                    <div class="itemBox camera"><img src="img/img3.jpg" alt=""></div>
                    <div class="itemBox watch"><img src="img/22.jpg" alt=""></div>
                    <div class="itemBox shoe"><img src="img/113.jpg" alt=""></div>
                    <div class="itemBox headphone"><img src="img/82.jfif" alt=""></div>
                    <div class="itemBox mobile"><img src="img/100.jfif" alt=""></div>
                    <div class="itemBox watch"><img src="img/25.jpg" alt=""></div>
                    <div class="itemBox headphone"><img src="img/109.jfif" alt=""></div>
                    <div class="itemBox mobile"><img src="img/31.png" alt=""></div>
                    <div class="itemBox watch"><img src="img/49.png" alt=""></div>
                    <div class="itemBox mobile"><img src="img/77.jfif" alt=""></div>
                    <div class="itemBox headphone"><img src="img/83.jfif" alt=""></div>
                    <div class="itemBox watch"><img src="img/103.jfif" alt=""></div>
                    <div class="itemBox shoe"><img src="img/33.jpg" alt=""></div>
                    <div class="itemBox watch"><img src="img/107.jfif" alt=""></div>
                    <div class="itemBox headphone"><img src="img/110.jfif" alt=""></div>
                </div>
            </section>
        </div>
    </div>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.list').click(function(){
                const value = $(this).attr('data-filter');
                if(value == 'All'){
                    $('.itemBox').show('1000')
                }
                else{
                    $('.itemBox').not('.'+value).hide('1000')
                    $('.itemBox').filter('.'+value).show('1000')
                }
            })
            $('.list').click(function(){
                $(this).addClass('active').siblings().removeClass('active')
            })
        })
    </script>
</body>
</html>