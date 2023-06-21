@extends('sidebar')
@section('content')
<div class="cardBox">
    <div class="cardHeader">
        <h2>Coupons</h2>
        <div class="navigate">
            <div class="toggleMe"><span></span></div>
            <ul class="ul">
                <li style="--i:0"><a href="#">Home</a></li>
                <li style="--i:1"><a href="#">About</a></li>
                <li style="--i:2"><a href="#">Services</a></li>
                <li style="--i:3"><a href="#">Work</a></li>
                <li style="--i:4"><a href="#">Team</a></li>
                <li style="--i:5"><a href="#">Contact</a></li>
            </ul>
        </div>
    </div> 
</div>
<script type="text/javascript">
    let navigation = document.querySelector('.navigate')
    document.querySelector('.toggleMe').onclick = function (){
        this.classList.toggle('active')
        navigation.classList.toggle('active')
    }
</script>
@endsection