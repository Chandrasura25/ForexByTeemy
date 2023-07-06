@if($admin)
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="/css/admindashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    @cloudinaryJS
</head>
<body>
    <div class="body">
        <div class="glass">
            <div class="container">
                <div class="navigation">
                    <ul>
                        <li>
                            <a href="/">
                                <span class="icon"><ion-icon name="logo-apple"></ion-icon></span>
                                <span class="title">ForexByTeemy</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon"><ion-icon name="home"></ion-icon></span>
                                <span class="title">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="/product">
                                <span class="icon"><ion-icon name="cube"></ion-icon>
                                </span>
                                <span class="title">Products</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon"><ion-icon name="person-add"></ion-icon>
                                </span>
                                <span class="title">All Affiliates</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon"><ion-icon name="storefront"></ion-icon>
                                </span>
                                <span class="title">Store</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/edit">
                                <span class="icon"><ion-icon name="settings"></ion-icon>
                                </span>
                                <span class="title">Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="/blog">
                                <span class="icon"><ion-icon name="newspaper"></ion-icon>
                                </span>
                                <span class="title">Blog</span>
                            </a>
                        </li>
                        
                        <li>
                            <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
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
                        <img src="{{$admin->image_path }}" alt="">
                    </div>
                  </div>
                  <!-- card -->
                  <div class="cardBox">
                    <div class="card">
                       <div>
                        <div class="numbers">{{$productCount}}</div>
                        <div class="cardName">Products</div>
                       </div> 
                       <div class="iconBx">
                        <ion-icon name="cube-outline"></ion-icon>
                       </div>
                    </div>
                    <div class="card">
                        <div>
                         <div class="numbers">50</div>
                         <div class="cardName">Sales</div>
                        </div> 
                        <div class="iconBx">
                         <ion-icon name="cart-outline"></ion-icon>
                        </div>
                     </div>
                     <div class="card">
                        <div>
                         <div class="numbers">{{$userCount}}</div>
                         <div class="cardName">Users</div>
                        </div> 
                        <div class="iconBx">
                         <ion-icon name="people-outline"></ion-icon>
                        </div>
                     </div>
                     <div class="card">
                        <div>
                         <div class="numbers">$6,504</div>
                         <div class="cardName">Earning</div>
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
                            <h2>Recent Orders</h2>
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
                                <td><span class="status delivered">Delivered </span></td>
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
                            </tbody>
                        </table>
                    </div>
                    <!-- new customer -->
                    <div class="recentCustomers">
                        <div class="cardHeader">
                            <h2>Recent Customers</h2>
                        </div>
                        @if ($users->count() <= 0)
                        <h2>No User Registered Yet</h2>
                        @else
                          <table>
                             @foreach ($users as $user)
                              <tr>
                                  <td><div class="imgBx"><img src="{{$user->profile_pic}}" alt="{{$user->username}}"></div></td>
                                  <td><h4>{{$user->username}}<br><span>{{$user->number}}</span></h4></td>
                              </tr>
                              @endforeach 
                          </table> 
                        @endif
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
</body>
</html>
@else
    <p>Admin not logged in</p>
@endif