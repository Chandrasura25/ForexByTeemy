@extends('layouts.app')  

@section('content')
<div class="body">
    <form method="POST" action="{{ isset($referrer) ? route('registerbylink') : route('register')  }}"> 
        @include('flash::message')
           <h2>{{ __('Register') }}</h2>
            @csrf
            <div class="inputBox">
                <input id="username" type="text" class="@error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                <label for="username">{{ __('Username') }}</label>
                @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="inputBox">
                <input id="email" type="text"  name="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror" required autofocus autocomplete="email">
                <label for="email">{{ __('Email Address') }}</label>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="inputBox">
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                <label for="password">{{ __('Password') }}</label>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="inputBox">
                <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
            </div>
            <div class="inputBox">
                <input type="text" name="coupon_code" class="@error('coupon_code') is-invalid @enderror" autocomplete="new-coupon_code">
                <label for="coupon_code">{{__('Coupon Code')}}</label>
                @error('coupon_code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>            
            @if (isset($referrer))
            <div class="inputBox" style="display: none">
                <input id="referrer" type="text" name="referrer" value="{{$referrer}}" readonly>
                <label for="referrer">{{ __('Referrer') }}</label>
            </div>
            @if (isset($ref_source))
                <div class="inputBox" style="display: none">
                    <input id="ref_source" type="text" name="ref_source" value="{{$ref_source}}" readonly>
                    <label for="ref_source">{{ __('Ref_source') }}</label>
                </div>
            @else
                <div class="inputBox" style="display: none">
                    <input id="ref_source" type="hidden" name="ref_source" value="">
                    <label for="ref_source">{{ __('Ref_source') }}</label>
                </div>
            @endif
        @endif
           
        <div class="inputBox">
            <input type="submit" value="{{ __('Register') }}">
        </div>
        

    </form>
</div>
<script>
    let label = document.querySelectorAll('label').forEach(label=>{ 
        label.innerHTML = label.innerText.split('').map((letters,i)=> `<span style="transition-delay:${i * 50}ms">${letters}</span>`).join('');
    })
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
@endsection
