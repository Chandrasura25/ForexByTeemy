<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ForexByTeemy</title>
       
        <!-- Fonts -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" /> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    </head>
    <body>
        @include('layouts.loader')
        <div> 
            <header>
                <nav id="navbar">
                    <a href="#" class="brand">
                        <span><img src="{{asset('image/logo.jpg')}}" alt=""></span>
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
                            <a href="{{ route('login') }}">
                                <span>Affiliates</span>
                                <span><i class="fas fa-handshake"></i></span>
                            </a>
                        </li>
                        <li style="--i:3;">
                            <a href="/store">
                                <span>Store</span>
                                <span><i class="fas fa-store"></i></span>
                            </a>
                        </li>
                        <li style="--i:4;">
                            <a href="/blog">
                                <span>Blog</span>
                                <span><i class="fas fa-blog"></i></span>
                            </a>
                        </li>
                        <li style="--i:5;">
                            <a href="#services">
                                <span>Services</span>
                                <span><i class="fas fa-cogs"></i></span>
                            </a>
                        </li>
                        <li style="--i:6;">
                            <a href="#contact">
                                <span>Contact</span>
                                <span><i class="fas fa-envelope"></i></span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </header>
            <div class="banner">
                <div class="textBox">
                    <h2 class="name" data-text="Forex By Teemy">Forex By Teemy</h2>
                    <p>
                        This is a place for all your forex needs. Whether you are a novice looking to learn forex trading or an experienced trader seeking advanced services, we have got you covered. Our comprehensive range of offerings includes forex trading training, coding of expert advisors, providing well-analyzed trading signals, and much more.
                    </p>
                    <a href="#">Read More</a>
                  </div>
                  <div class="imgBox">
                    <img src="{{asset('image/img2.jpg')}}" alt="" />
                  </div>
            </div>
            <div class="marquee">
                <span>Under Reconstruction</span>
                <span>Under Reconstruction</span>
            </div>
            <section id="about" class="about">
                <div class="row">
                    <div class="col50">
                        <h2 class="titleText"><span>A</span>bout Us</h2>
                        <p>
                           <span> Teemy helps clients to create amazing Forex experience.</span>
                            <br><br><span>Teemy can help you unlock better trading opportunities through convenient tools and one on one consultation.</span>
                            <br><br>
                            <span>Our Forex Analyst knows collaboration is the essence of any project. It’s a simple philosophy we followed for nearly two decades. And it delivers results.</span>
                        </p>
                    </div>
                    <div class="col50">
                        <div class="imgBx">
                            <img src="{{asset('image/img3.jpg')}}" alt="">
                        </div>
                    </div>
                </div>
            </section>
            <section class="portfolio">
                    <div class="title">
                        <h2 class="titleText">The <span>P</span>ortfolio</h2>
                        <p>Diversify. Grow. Succeed. Build a winning portfolio for financial prosperity.</p>
                        <div class="content">
                            <div class="box">
                                <div class="imgBx">
                                    <img src="/image/port3.png" alt="">
                                </div>
                                <div class="text">
                                    <h3>1st Place Gainer 2012</h3>
                                </div>
                            </div>
                            <div class="box">
                                <div class="imgBx">
                                    <img src="/image/port2.png" alt="">
                                </div>
                                <div class="text">
                                    <h3>3rd Place Aprill 11 2012</h3>
                                </div>
                            </div>
                            <div class="box">
                                <div class="imgBx">
                                    <img src="/image/port1.png" alt="">
                                </div>
                                <div class="text">
                                    <h3>1st Place Gainer, 2011</h3>
                                </div>
                            </div>
                            <div class="box">
                                <div class="imgBx">
                                    <img src="/image/port6.png" alt="">
                                </div>
                                <div class="text">
                                    <h3>10th Place Gainer, 2015</h3>
                                </div>
                            </div>
                            <div class="box">
                                <div class="imgBx">
                                    <img src="/image/port5.png" alt="">
                                </div>
                                <div class="text">
                                    <h3>6th Place June 2015</h3>
                                </div>
                            </div>
                            <div class="box">
                                <div class="imgBx">
                                    <img src="/image/port4.png" alt="">
                                </div>
                                <div class="text">
                                    <h3>8th Place Gainer 2014</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="title">
                        <a href="#" class="btn">View All</a>
                    </div>
            </section>
            <section class="services" id="services">
                <div class="title">
                    <h2 class="titleText">Our <span>S</span>ervices</h2>
                    <p>Comprehensive services to meet all your needs. Quality, reliability, and expertise guaranteed. </p>
                </div>
                <div class="container">
                    <div class="serviceBox">
                      <div class="icon" style="--i: #4eb7ff">
                        <i class="fas fa-chart-line"></i>
                      </div>
                      <div class="content">
                        <h2>Signals</h2>
                        <p>
                            Accurate and timely forex signals for informed trading decisions.Stay informed, make smart decisions, and increase your chances of success in the forex market.
                        </p>
                      </div>
                    </div>
                    <div class="serviceBox">
                        <div class="icon" style="--i: #fd6494">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="content">
                          <h2>Consultations</h2>
                          <p>
                            Expert forex consultation for personalized guidance, strategy development, and maximizing profitability. 
                          </p>
                        </div>
                      </div>
                      <div class="serviceBox">
                        <div class="icon" style="--i: #43f390">
                            <i class="fas fa-search"></i>
                        </div>
                        <div class="content">
                          <h2>SEO</h2>
                          <p>
                            Effective SEO strategies to boost your online presence, drive organic traffic, and improve search engine rankings for sustainable business growth.
                          </p>
                        </div>
                      </div>
                      <div class="serviceBox">
                        <div class="icon" style="--i: #ffb508">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <div class="content">
                          <h2>Tickets</h2>
                          <p>
                            Secure your tickets today for unforgettable experiences. Concerts, sports events, theater shows—find and purchase tickets conveniently with us.
                          </p>
                        </div>
                      </div>
                </div>
            </section>
            <section class="contact" id="contact">
                <div class="title">
                    <h2 class="titleText">Our <span>C</span>ontacts</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
                <div class="contactForm">
                    <h3>Send Message</h3>
                    @if (isset($message)) 
                        <div class="alert alert-{{$success?'success':'danger'}}" role="alert">
                            {{ $message }}
                        </div>
                    @endif 
                <form action="{{route('send-email')}}" method="POST">
                        @csrf
                    <div class="inputBox">
                        <input type="text" placeholder="Name" name="name">
                        @if($errors->get('name')!==null)  
                        <p class="text-danger text-sm">{{$errors->first('name')}}</p>
                        @endif
                    </div>
                    <div class="inputBox">
                        <input type="email" placeholder="Email" name="email">
                        @if($errors->get('email')!==null)
                        <p class="text-danger text-sm">{{$errors->first('email')}}</p>
                        @endif
                    </div>
                    <div class="inputBox">
                        <textarea placeholder="Your Message..." name="message"></textarea>
                        @if($errors->get('message')!==null)
                        <p class="text-danger text-sm">{{$errors->first('message')}}</p>
                        @endif
                    </div>
                    <div class="inputBox">
                        <input type="submit" value="Submit">
                    </div>
                  </form>
                </div>
            </section>
        <div class="copyrightText">
          <p>Copyright 2023 <a href="/">ForexByTeemy</a>. All Right Reserved</p>
         </div>
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
