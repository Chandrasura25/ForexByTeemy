@extends('layouts.app')

@section('content')
    <div class="body">
        <form method="POST" action="{{ isset($referrer) ? route('registerbylink') : route('register') }}">
            @include('flash::message')
            <h2>{{ __('Register') }}</h2>
            @csrf
            <div class="inputBox">
                <input id="username" type="text" class="@error('username') is-invalid @enderror" name="username"
                    value="{{ old('username') }}" required autocomplete="username" autofocus>
                <label for="username">{{ __('Username') }}</label>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="inputBox">
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                    class="@error('email') is-invalid @enderror" required autofocus autocomplete="email">
                <label for="email">Email&nbsp;Address</label>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="inputBox">
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password"
                    required autocomplete="new-password">
                <label for="password">{{ __('Password') }}</label>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="inputBox">
                <input id="password-confirm" type="password" name="password_confirmation" required
                    autocomplete="new-password">
                <label for="password-confirm">Confirm&nbsp;Password</label>
            </div>
            <div class="inputBox">
                <input id="coupon_code" type="text" name="coupon_code" value="{{ old('coupon_code') }}"
                    class="@error('coupon_code') is-invalid @enderror" autofocus autocomplete="coupon_code" readonly>
                <label for="coupon_code">coupon&nbsp;code</label>
                @error('coupon_code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            @if (isset($referrer))
                <div class="inputBox" style="display: none">
                    <input id="referrer" type="text" name="referrer" value="{{ $referrer }}" readonly>
                    <label for="referrer">{{ __('Referrer') }}</label>
                </div>
                @if (isset($ref_source))
                    <div class="inputBox" style="display: none">
                        <input id="ref_source" type="text" name="ref_source" value="{{ $ref_source }}" readonly>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        let label = document.querySelectorAll('label').forEach(label => {
            label.innerHTML = label.innerText.split('').map((letters, i) =>
                `<span style="transition-delay:${i * 50}ms">${letters}</span>`).join('');
        })
    </script>
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
   <script>
    $(document).ready(function() {
      // Function to remove the "readonly" attribute from the input with id "coupon_code" on focus
      function removeReadonlyOnFocus() {
        $("#coupon_code").removeAttr("readonly");
      }

      // Function to add back the "readonly" attribute to the input with id "coupon_code" on blur (when focus is removed)
      function addReadonlyOnBlur() {
        $("#coupon_code").attr("readonly", "readonly");
      }

      // Attach event handlers to the input with id "coupon_code"
      $("#coupon_code").focus(removeReadonlyOnFocus).blur(addReadonlyOnBlur);
    });
  </script>
@endsection
