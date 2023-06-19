
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="/css/modal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
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
                        <a href="/affiliate">
                            <span class="icon"><i class="fa-solid fa-house" aria-hidden="true"></i></span>
                            <span class="title">Home</span>
                        </a>
                    </li>
                    <li class="list" data-color="#f53b57">
                        <a href="#">
                            <span class="icon">
                                <i class="fa-solid fa-lock" aria-hidden="true"></i>
                            </span>
                            <span class="title">Password</span>
                        </a>
                    </li>
                    <li class="list" data-color="#0fbcf9">
                        <a href="#" onclick="setoggle()">
                            <span class="icon">
                                <i class="fa-solid fa-upload" aria-hidden="true"></i>
                            </span>
                            <span class="title">Upload</span>
                        </a>
                    </li>
                    <li class="list" data-color="#ffa801">
                        <a href="#">
                            <span class="icon">
                                <i class="fa-solid fa-gear" aria-hidden="true"></i>
                            </span>
                            <span class="title">Settings</span>
                        </a>
                    </li>
                    <div class="indicator">
        
                    </div>
                </ul>
            </div>
            <div class="container">
               <div class="left">
                   <div class="card">
                        <div class="profile">
                            <form>
                                @if($user->profile_pic)
                                  <img src="{{ asset($user->profile_pic) }}" alt="Profile Picture">
                                @else
                                    <img src="{{ asset('/image/avatar.jpg') }}" alt="Default Picture">
                                @endif
                            </form>
                        </div>
                        <div class="content">
                            <h2>Username - <span>{{$user->username}}</span></h2>
                            <h3>Fullname - <span>{{$user->name}}</span></h3>
                            <h4>Number - <span>{{$user->number}}</span></h2>
                            <p>Email Address - <span>{{$user->email}}</span></p>
                        </div>
                   </div>
                   <div class="card">
                    <h2>About <span>{{$user->username}}</span></h2>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum quisquam odio aut provident ipsam atque eveniet sequi cupiditate distinctio eum nobis perferendis id unde, incidunt sunt eaque ullam eligendi culpa. A, beatae fugiat repellat ratione veniam, id nihil ducimus doloremque natus, delectus tempore dicta distinctio voluptatibus perferendis.</p>
                   </div>
                </div>
               <div class="right">
                <section class='section'>
                    <div class="box">
                        <div class="form">
                            <h2>Add More Details</h2>
                            <form action="">
                                <div class="inputBx">
                                    <input type="text"placeholder="Fullname"name="" id="">
                                </div>
                                <div class="inputBx">
                                    <input type="text" placeholder="Phone Number"name="" id="">
                                </div>
                                <div class="inputBx">
                                    <textarea name="" id="" placeholder="Tell us a little bit about yourself"></textarea>
                                </div>
                                <div class="inputBx">
                                    <input type="submit" value="Save">
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
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
    <script>
        let popup = document.getElementById('popup')
        let blur = document.getElementById('blur')
        function setoggle(){
           popup.classList.toggle('active')
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
</body>
</html>