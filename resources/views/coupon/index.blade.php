@extends('sidebar')
@section('content')
<div class="cardBox">
    <div class="cardHeader">
        <h2>Coupons</h2>
        <div class="navigate">
            <div class="toggleMe"><span></span></div>
            <ul class="ul">
                <li style="--i:0"><a href="/coupon/create">Create Coupon</a></li>
                <li style="--i:1"><a href="/store">Store</a></li>
                {{-- <li style="--i:2"><a href="#">Services</a></li>
                <li style="--i:3"><a href="#">Work</a></li> --}}
            </ul>
        </div>
    </div> 
</div>
<div class="cardBox">
    <a href="#" class="card">
       <div>
        <div class="numbers">00</div>
        <div class="cardName">Total Customers</div>
       </div> 
    </a>
    <a href="#" class="card">
        <div>
            <div class="numbers">{{$user->personal_coupon}}</div>
            <div class="cardName">Personal Coupons</div>
        </div> 
     </a>
     <a href="/sales" class="card">
        <div>
         <div class="numbers">{{$user->credits}}</div> 
         <div class="cardName">Total Credits</div>
        </div>
    </a>
     <a href="/status" class="card">
        <div>
         <div class="numbers">{{$couponCount}}</div>
         <div class="cardName">Available Coupons</div>
        </div>
     </a>
  </div>
   <div class="coupons">
        @if ($coupons->count() > 0)
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
                   <td>Actions</td>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $coupon)
                        <tr>
                            <td>{{ $coupon->coupon_code }}</td>
                            <td>{{ $coupon->coupon_type }}</td>
                            <td>{{$coupon->couponChannel->name}}</td>
                            <td>{{ $coupon->description }}</td>
                            <td>{{ $coupon->effectivity }}</td>
                            <td>
                                @if ($coupon->percentage_off)
                                    {{ $coupon->percentage_off }}
                                @else
                                    {{ $coupon->fixed_amount }}
                                @endif
                            </td>
                            <td>
                                <form action="/status/{{$coupon->id}}" method="post">
                                @csrf
                                  <button type="submit" class="{{ $coupon->status === 'active' ? 'delivered':'pending' }}">
                                      {{ $coupon->status }}
                                  </button>   
                                </form>                     
                            </td>
                            <td>
                                <div class="actionBx">
                                    <a href="/coupon/{{$coupon->id}}/edit"><i class="fas fa-pen"></i></a>
                                    <form action="/coupon/{{$coupon->id}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {{ $coupons->links() }}
            </div>
        </div>
        @else
         <h2>No Available Coupon! <span>Create Coupons</span></h2>
         <p>You get a 20% free coupon as an affiliate</p>
        @endif
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