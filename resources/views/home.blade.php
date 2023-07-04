
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="/css/modal.css">
    <link href="{{ asset('css/flash.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <section class="body" id="blur">
        <div class="wave wave1"></div>
        <div class="wave wave2"></div>
        <div class="wave wave3"></div>
        <div class="wave wave4"></div>
        <div class="glass">
            <div class="navigation">
                <ul>
                    <li class="list active" data-color="#37d72f">
                        <a href="#">
                            <span class="icon">
                                <i class="fa-solid fa-user" aria-hidden="true"></i>
                            </span>
                            <span class="title">Profile</span>
                        </a>
                    </li>
                    <li class="list" data-color="#3c40c6">
                        <a href="#" onclick="setpass()">
                            <span class="icon"><i class="fa-solid fa-lock" aria-hidden="true"></i></span>
                            <span class="title">Password</span>
                        </a>
                    </li>
                    <li class="list" data-color="#f53b57">
                        <a href="#" onclick="setoggle()">
                            <span class="icon">
                                <i class="fa-solid fa-upload" aria-hidden="true"></i>
                            </span>
                            <span class="title">Upload</span>
                        </a>
                    </li>
                    <li class="list" data-color="#0fbcf9">
                        <a href="/services">
                                <span class="icon"><i class="fas fa-store"></i></span>
                                <span class="title">My Services</span>
                            </a>
                    </li>
                    <li class="list" data-color="#ffa801">
                            <a href="/affiliate">
                                <span class="icon"><i class="fas fa-handshake"></i></span>
                                <span class="title">Affiliate</span>
                            </a>
                    </li>
                    <div class="indicator">
        
                    </div>
                </ul>
            </div>
            <div class="container">
               <div class="left">
                  <div class="contactForm">
                    @include('flash::message')
                    <h2 class="title">Welcome <span>{{$user->username}}</span></h2>
                        <form class="formBox" id="content" method="POST" action="{{route('update')}}">
                            @csrf
                            <div class="inputBox w50">
                                <input type="text" value="{{$user->name}}" disabled name="name">
                                <span>FullName</span>
                            </div>
                            <div class="inputBox w50">
                                <input type="text" value="{{$user->username}}" disabled name="username">
                                <span>Username</span>
                            </div>
                            <div class="inputBox w50">
                                <input type="text" value="{{$user->email}}" disabled name="email">
                                <span>Email Address</span>
                            </div>
                            <div class="inputBox w50">
                                <input type="text" value="{{$user->number}}" disabled name="number">
                                <span>Mobile Number</span>
                            </div>
                            <div class="inputBox w100">
                                <textarea name="bio" disabled>{{$user->bio}}</textarea>
                                <span>Your Bio here...</span>
                            </div>
                            <div class="inputBox w100">
                                <input type="button" id="editButton" value="Edit">
                                <input type="button" id="cancelButton" value="Cancel" style="display: none">
                                <input type="submit" id="updateButton" value="Update" style="display: none">
                            </div>
                        </form>
                    </div>
                </div>
               <div class="right">
                    <div class="cover">
                        <div class="card">
                            <div class="profile">
                                @if($user->profile_pic)
                                  <img src="{{ asset($user->profile_pic) }}" alt="Profile Picture">
                                @else
                                    <img src="{{ asset('/image/avatar.jpg') }}" alt="Default Picture">
                                @endif
                            </div>
                        </div>
                        <div class="content">
                            <h2>{{$user->username}}</h2>
                            <p>{{$user->email}}</p>
                        </div>
                   </div>
                    <div class="box">
                        <canvas id="myChart"></canvas>
                    </div>
               </div>
            </div>
        </div>
    </section>
    <div id="popup">
        <form action="{{route('upload')}}" enctype="multipart/form-data" method="post">
            @csrf
            <h2>Upload Your Profile Picture</h2>
            <span class="close" onclick="setoggle()">&times;</span>
            <input type="file" id="fileInput" name="profile_pic" accept=".jpg,.jpeg,.png,.svg,.gif">
            <button class="closeBtn" onclick="setoggle()">Upload</button>
        </form>
    </div>
    <div id="passup">
        <form action="{{route('updatePass')}}" method="post">
            @csrf
            <h2>Update Your Password</h2>
            <span class="close" onclick="setpass()">&times;</span>
            <input type="password" id="fileInput" name="password" placeholder='Password'>
            <button class="closeBtn" onclick="setpass()">Update</button>
        </form>
    </div>
    <script>
        let popup = document.getElementById('popup')
        let passup = document.getElementById('passup')
        let blur = document.getElementById('blur')
        function setoggle(){
           popup.classList.toggle('active')
           blur.classList.toggle('active')
        }
         function setpass(){
           passup.classList.toggle('active')
           blur.classList.toggle('active')
        }
        let list = document.querySelectorAll('li');
        for (let i = 0; i < list.length; i++) {
            list[i].onmouseover = function (){
                let j = 0;
                while (j < list.length) {
                    list[j++].className = 'list'
                }
                list[i].className = 'list active'
            } ; 
        }

        list.forEach(elements =>{
            elements.addEventListener('mouseenter',function(event){
             let bg = document.querySelector('.body');
             let color = event.target.getAttribute('data-color');
             bg.style.backgroundColor = color
            })
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
    <script>
        const ctx = document.getElementById('myChart');
        const user = @json($user);

        const labels = ['Name', 'Username', 'Email', 'Bio', 'Number','profile_pic'];
        const values = [
            user.name ? 1 : 0,
            user.username ? 1 : 0,
            user.email ? 1 : 0,
            user.bio ? 1 : 0,
            user.number ? 1 : 0,
            user.profile_pic ? 1 : 0,
        ];
        new Chart(ctx, {
            type: 'pie',
            label: 'Profile',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#8C4A8C', '#FF9F40', '#4BFF40'],
                    hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#8C4A8C', '#FF9F40', '#4BFF40']
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
<script>
$(document).ready(function() {
  // Hide the "Update" and "Cancel" buttons initially
  $('#updateButton').hide();
  $('#cancelButton').hide();

  // Handler for the edit button click
  $(document).on('click', '#editButton', function(event) {
    event.preventDefault(); // Prevent form submission

    // Change input elements to editable
    $('#content input:not([type="button"], [type="submit"])').removeAttr('disabled');
    $('#content textarea').removeAttr('disabled');

    // Show the "Update" and "Cancel" buttons
    $('#updateButton').show();
    $('#cancelButton').show();

    // Hide the "Edit" button
    $(this).hide();
  });

  // Handler for the cancel button click
  $(document).on('click', '#cancelButton', function(event) {
    event.preventDefault(); // Prevent form submission

    // Disable the input elements inside the "content" container, excluding buttons
    $('#content input:not([type="button"], [type="submit"])').attr('disabled', true);
    $('#content textarea').attr('disabled', true);

    // Hide the "Update" and "Cancel" buttons
    $('#updateButton').hide();
    $(this).hide();

    // Show the "Edit" button
    $('#editButton').show();
  });
});
</script>
<script src="//code.jquery.com/jquery.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
</body>
</html>