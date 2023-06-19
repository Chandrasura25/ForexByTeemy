<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="/css/modal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    @cloudinaryJS
</head>
<body>
    <div class="container" id="blur">
        <div class="navigation">
            <ul>
                <li>
                    <a href="/">
                        <span class="icon"><ion-icon name="logo-apple"></ion-icon></span>
                        <span class="title">ForexByTeemy</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="setoggle()">
                        <span class="icon"><i class="fas fa-upload" aria-hidden="true"></i></span>
                        <span class="title">Upload</span>
                    </a>
                </li>
                <li>
                    <a href="/profile">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <span class="title">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class="fas fa-handshake"></i></span>
                        <span class="title">Affiliates</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class="fas fa-store"></i></span>
                        <span class="title">Store Purchases</span>
                    </a>
                </li>
                <li>
                    <a href="/settings">
                        <span class="icon"><i class="fas fa-cogs"></i></span>
                        <span class="title">My Services</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="help-outline"></ion-icon></span>
                        <span class="title">Help</span>
                    </a>
                </li>
                
                <li>
                    <a  href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">    
                        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>    
                        <span class="title">Sign Out</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
                <img src="{{$user->profile_pic}}" alt="">
            </div>
          </div>
          <!-- card -->
          <div class="cardBox">
            <div class="card">
               <div>
                <div class="numbers">04</div>
                <div class="cardName">Credits</div>
               </div> 
               <div class="iconBx">
                <i class="fa-solid fa-coins" aria-hidden="true"></i>
               </div>
            </div>
            <div class="card">
                <div>
                    <div class="numbers">50</div>
                    <div class="cardName">Clicks & Conversion</div>
                </div> 
                <div class="iconBx">
                 <i class="fa-solid fa-chart-line" aria-hidden="true"></i>
                </div>
             </div>
             <div class="card">
                <div>
                 <div class="numbers">04</div>
                 <div class="cardName">Sales & Commission</div>
                </div> 
                <div class="iconBx">
                 <ion-icon name="cart-outline"></ion-icon>
                </div>
             </div>
             <div class="card">
                <div>
                 <div class="numbers">$04</div>
                 <div class="cardName">Status Paid</div>
                </div> 
                <div class="iconBx">
                 <ion-icon name="cash-outline"></ion-icon>
                </div>
             </div>
             
          </div>
          <!-- graph -->
           <div class="graphBox">
            <div class="box">
                <canvas id="myChart"></canvas>
            </div>
            <div class="box">
                <canvas id="earning"></canvas>
            </div>
           </div>

          <div class="details">
               <!-- list -->
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Sales & Commission</h2>
                    <a href="#" class="btn">View All</a>
                </div>
                <table>
                    <thead>
                      <tr>
                       <td>Name</td>
                       <td>Price</td>
                       <td>Payment</td>
                       <td>Status</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Casual shoes</td>
                        <td>$100</td>
                        <td>Paid</td>
                        <td><span class="status delivered">Delivered</span></td>
                      </tr>
                      <tr>
                        <td>Denim Shirts</td>
                        <td>$110</td>
                        <td>Paid</td>
                        <td><span class="status inprogress">In Progress</span></td>
                      </tr>
                      <tr>
                        <td>Star Refrigerator</td>
                        <td>$1200</td>
                        <td>Paid</td>
                        <td><span class="status delivered">Delivered </span></td>
                      </tr>
                      <tr>
                          <td>Freezer</td>
                          <td>$1300</td>
                          <td>Due</td>
                        <td><span class="status pending">Pending</span></td>
                      </tr>
                      <tr>
                          <td>Trouser</td>
                          <td>$300</td>
                          <td>Due</td>
                          <td><span class="status return">Return</span></td>
                        </tr>
                        <tr>
                          <td>Refrigerator</td>
                          <td>$1200</td>
                          <td>Paid</td>
                          <td><span class="status delivered">Delivered </span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- new customer -->
            <div class="recentCustomers">
                <div class="cardHeader">
                    <h2>Recent SignUps</h2>
                </div>
                <table>
                    <tr>
                        <td><div class="imgBx"><img src="images/img1.jpg" alt=""></div></td>
                        <td><h4>David<br><span>Italy</span></h4></td>
                    </tr>
                    <tr>
                        <td><div class="imgBx"><img src="images/img2.jpg" alt=""></div></td>
                        <td><h4>Muhammed<br><span>India</span></h4></td>
                    </tr>
                    <tr>
                        <td><div class="imgBx"><img src="images/img3.jpg" alt=""></div></td>
                        <td><h4>Amelia<br><span>France</span></h4></td>
                    </tr>
                    <tr>
                        <td><div class="imgBx"><img src="images/img4.jpg" alt=""></div></td>
                        <td><h4>Olivia<br><span>USA</span></h4></td>
                    </tr>
                    <tr>
                        <td><div class="imgBx"><img src="images/img5.jpg" alt=""></div></td>
                        <td><h4>Amit<br><span>Japan</span></h4></td>
                    </tr>
                    <tr>
                        <td><div class="imgBx"><img src="images/img6.jpg" alt=""></div></td>
                        <td><h4>Ashraf<br><span>India</span></h4></td>
                    </tr>
                    <tr>
                        <td><div class="imgBx"><img src="images/img7.jpg" alt=""></div></td>
                        <td><h4>Diana<br><span>Malaysia</span></h4></td>
                    </tr>
                    <tr>
                        <td><div class="imgBx"><img src="images/img8.jpg" alt=""></div></td>
                        <td><h4>Amit<br><span>India</span></h4></td>
                    </tr>
                </table>
            </div>
           </div>
        </div>
    </div>
    <div id="popup">
        <form action="{{route('upload')}}" enctype="multipart/form-data" method="post">
            @csrf
            <h2>Upload Your Profile Picture</h2>
            <span class="close" onclick="setoggle()">&times;</span>
            <input type="file" id="fileInput" name="profile_pic" accept=".jpg,.jpeg,.png,.svg,.gif">
            <button class="closeBtn" onclick="setoggle()">Upload</button>
        </form>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
    <script>
        let popup = document.getElementById('popup')
        let blur = document.getElementById('blur')
        function setoggle(){
           popup.classList.toggle('active')
           blur.classList.toggle('active')
        }
       let toggle = document.querySelector('.toggle');
       let navigation = document.querySelector('.navigation');
       let main = document.querySelector('.main');
        
       toggle.onclick = function(){
        navigation.classList.toggle('active')
        main.classList.toggle('active')
       }

       let list = document.querySelectorAll('.navigation li');
       function activeLink(){
        list.forEach((item)=>
        item.classList.remove('hovered'));  
        this.classList.add('hovered')
       } 
       list.forEach((item)=>
       item.addEventListener('mouseover',activeLink));
    </script>    
     
    <script>
        const ctx = document.getElementById('myChart'); 
        const earning = document.getElementById('earning'); 

        new Chart(ctx, { 
            type: 'doughnut',
            data: {
                labels: ['Facebook', 'Youtube', 'Instagram'], 
                datasets: [{
                    label: 'Affiliate Sales',
                    data: [120, 190, 300],
                    backgroundColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54,162,235,1)',
                        'rgba(255,206,86,1)'
                    ]
                }]
            },
            options: {
                responsive: true
            }
        });


        var data = {
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          datasets: [
            {
              label: 'Clicks',
              backgroundColor: 'rgba(54,162,235,1)',
              data: [100, 150, 120, 200, 180, 250, 220, 210, 190, 170, 220, 240]
            },
            {
              label: 'Sales',
              backgroundColor: 'rgba(255, 99, 132, 1)',
              data: [50, 80, 70, 90, 100, 120, 110, 100, 95, 85, 100, 110]
            },
            {
              label: 'Earnings',
              backgroundColor: 'rgba(255,206,86,1)',
              data: [500, 600, 550, 700, 650, 800, 750, 720, 680, 620, 750, 780]
            }
          ]
        };

        // Chart configuration
        var config = {
          type: 'bar',
          data: data,
          options: {
            plugins: {
              title: {
                display: true,
                text: 'Yearly Metrics',
                font: {
                  size: 18
                }
              }
            },
            responsive: true,
            scales: {
              x: {
                stacked: true,
              },
              y: {
                stacked: true,
                beginAtZero: true
            }
            }
        }
        };
        var myChart = new Chart(document.getElementById('earning'), config);

        
    </script>  
</body>
</html>