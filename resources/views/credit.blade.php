@extends('sidebar')
@section('content')
<div class="cardBox">
    <div class="cardHeader">
        <h2>Coupons</h2>
        <div class="navigate">
            <div class="toggleMe"><span></span></div>
            <ul class="ul">
                <li style="--i:0"><a href="/coupon/create">Create Coupon</a></li>
                <li style="--i:1"><a href="#">About</a></li>
                <li style="--i:2"><a href="#">Services</a></li>
                <li style="--i:3"><a href="#">Work</a></li>
                <li style="--i:4"><a href="#">Team</a></li>
                <li style="--i:5"><a href="#">Contact</a></li>
            </ul>
        </div>
    </div> 
</div>
<div class="cardBox">
    <a href="#" class="card">
       <div>
        <div class="numbers">04</div>
        <div class="cardName">Total Customers</div>
       </div> 
    </a>
    <a href="#" class="card">
        <div>
            <div class="numbers">50</div>
            <div class="cardName">Total Orders</div>
        </div> 
     </a>
     <a href="/sales" class="card">
        <div>
         <div class="numbers">$04</div>
         <div class="cardName">Total Credits</div>
        </div>
    </a>
     <a href="/status" class="card">
        <div>
         <div class="numbers">04</div>
         <div class="cardName">Available Coupons</div>
        </div>
     </a>
  </div>
  <div class="details">
    <div class="recentOrders">
     <div class="cardHeader">
         <h2>Available Coupons</h2>
         <a href="#" class="btn">View All</a>
     </div>
     <table>
         <thead>
           <tr>
            <td>Coupon Code</td>
            <td>Coupon Type</td>
            <td>Coupon Channel</td>
            <td>Description</td>
            <td>Effectivity</td>
            <td>Percent Off / Fixed Amount</td>
            <td>Status</td>
           </tr>
         </thead>
     </table>
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