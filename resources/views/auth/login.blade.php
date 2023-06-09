@extends('layouts.app')

@section('content')
    <div class="body">
        <form method="POST" action="{{ route('login') }}">
           @csrf
            <h2>{{ __('Login') }}</h2>
            <div class="inputBox">
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <label for="email">{{ __('Email Address') }}</label>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="inputBox">
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                <label for="password">{{ __('Password') }}</label>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row mb-3">
                <div class="col-md-8 offset-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="text-light fw-bold fs-5">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>
                <div class="inputBox">
                    <input type="submit" value="{{ __('Login') }}"/>
                </div>    
                <div class="row">
                    @if (Route::has('password.request')) 
                        <a class="btn btn-link text-light" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
        </form>
    </div>
      
<script>
    let label = document.querySelectorAll('label').forEach(label=>{ 
        label.innerHTML = label.innerText.split('').map((letters,i)=> `<span style="transition-delay:${i * 50}ms">${letters}</span>`).join('');
    })
</script>
@endsection
