@extends('layouts.app') 

@section('content')
<div class="body">
    <form method="POST"  action="{{ isset($ref_source) ? route('registerbylink') : route('register')  }}">
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
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
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
            @if ( isset($ref_source ))
            <div class="inputBox">
                <input id="ref_source" type="text" name="ref_source" value="{{$ref_source}}" readonly>
                <label for="ref_source">{{ __('Ref_source') }}</label>
            </div>
            <div class="inputBox">
                <input id="referrer" type="text" name="referrer" value="{{$referrer}}" readonly>
                <label for="referrer">{{ __('Referrer') }}</label>
            </div>
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
@endsection
