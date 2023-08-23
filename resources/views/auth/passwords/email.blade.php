@extends('layouts.app')

@section('content')
    <div class="body">
        <div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                <h2>{{ __('Reset Password') }}</h2>
                @csrf
                <div class="inputBox">
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <label for="email">{{ __('Email Address') }}</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row mb-0">
                    <button type="submit" class="btn btn-success">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        let label = document.querySelectorAll('label').forEach(label => {
            label.innerHTML = label.innerText.split('').map((letters, i) =>
                `<span style="transition-delay:${i * 50}ms">${letters}</span>`).join('');
        })
    </script>
@endsection
