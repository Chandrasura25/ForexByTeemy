@extends('layouts.app')

@section('content')
<div class="body">
    
    <form method="POST" action="{{ route('password.confirm') }}">
        <small class="text-light">{{ __('Please confirm your password before continuing.') }}</small>
        <h2>{{ __('Confirm Password') }}</h2>
         @csrf
           <div class="inputBox">
               <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                <label for="password">{{ __('Password') }}</label>
                <span class="invalid-feedback" role="alert">
                    @error('password')
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="inputBox">
                <input type="submit" value="{{ __('Confirm Password') }}">      
            </div>
            <div class="row mb-0">
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
    </form>
</div>
@endsection
