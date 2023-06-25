@extends('sidebar')
@section('content')
<link rel="stylesheet" href="/css/click.css">
<div class="Box">
    <div class="title">
        <h2>Refer Friends <span>And Get Reward</span></h2>
        <p><span>Unlock the power of referrals and earn 30 credits!</span><br> Share your unique referral code with friends and family, and when they sign up using your code, you both receive a bonus of 30 credits. Start referring today and watch your credits grow as you and your loved ones reap the benefits of this referral program.</p>
    </div> 
    <div class="cardBx">
        <div class="ref_link">
            <div class="drop">
                <div class="content">
                    <h2>Your Personal Referral Link</h2>
                    <form action="">
                        <div class="inputBox">
                            <input type="text" name="" value="{{$myRefLink}}" readonly placeholder="Referrer Link" id="">
                        </div>
                        <div class="inputBox">
                            <input type="button" id="copyButton" data-clipboard-text="{{ $myRefLink }}" value='Copy' id="">
                        </div>
                    </form>
                </div>
        </div>
        </div>
        <div class="ref_no"></div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#copyButton').click(function () {
            var button = $(this); // Store the button element
            
            var referralLink = button.data('clipboard-text');
            
            
            // // Create a temporary input element and append it to the body
            var tempInput = $('<input>');
            $('body').append(tempInput);
            
            // // Set the input value to the referral link
            tempInput.val(referralLink).select();
            
            // // Copy the value to the clipboard
            document.execCommand('copy');
            
            // // Remove the temporary input element
            tempInput.remove();
            
            // Change the button text to "Copied" for a minute
            button.val('Copied');
            
            // Reset the button text after a minute
            setTimeout(function () {
                button.val('Copy');
            }, 60000); // 60000 milliseconds = 1 minute 60000 milliseconds = 1 minute
        });
    });
    </script>
    

@endsection