@extends('sidebar')
@section('content')
<link rel="stylesheet" href="/css/click.css">
<link rel="stylesheet" href="/css/flash.css">
<div class="Box">
    <div class="title">
        <h2>Refer Friends <span>And Get Reward</span></h2>
        <p><span>Unlock the power of referrals and earn a certain percenatage!</span><br> Share your unique referral code with friends and family, and when they sign up using your code, you both receive a bonus of 30 credits. Start referring today and watch your credits grow as you and your loved ones reap the benefits of this referral program.</p>
    </div> 
    @include('flash::message')
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
        <div class="ref_no">
            <div class="drop">
                <div class="">
                 <h2>Total Commissions</h2>
                 <span>{{$user->credits}}</span>
                </div>
               <div class="">
                <h2>Total Referred</h2>
                <span>{{$totalReferred}}</span>
               </div>
            </div>
        </div>
        <div class="ref_source">
            <div class="drop">
                <div class="content">
                    <h2>Add A Referral Source</h2>
                    <form action="/source" method="POST">
                        @csrf
                        <div class="inputBox">
                            <input type="text" name="source" placeholder="Referrer Source" id="ref_source">
                        </div>
                        <div class="inputBox">
                            <input type="submit" value='Submit'>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="coupons">
        @if  ($ref_sources->count() > 0)
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Available Referral Sources</h2>
                <a href="#" class="btn">View All</a>
            </div>
            <table>
                <thead>
                  <tr>
                   <td>Serial Number</td>
                   <td>Source</td>
                   <td>Referral Link</td>
                   <td>Actions</td>
                  </tr>
                </thead>
               <tbody>
                    @foreach ($ref_sources as $ref)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ref->source }}</td>
                            <td>{{ url('/register/' . $user->username . '/' . $ref->source) }}</td>
                            <td>
                                <div class="actionBx">
                                    <a href="/source/{{$ref->id}}/edit"><i class="fas fa-pen"></i></a>
                                    <form action="/source/{{$ref->id}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"><i class="fas fa-trash"></i></button>
                                    </form>
                                    <div class="ref_copy">
                                        <input type="button" id="copySourceButton" data-clipboard-text="{{ url('/register/' . $user->username . '/' . $ref->source) }}" value='Copy'>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody> 
            </table>
            <div class="pagination">
                {{-- {{ $ref_sources->links() }} --}}
            </div>
        </div>
        @endif
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
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
    
    <script>
        document.getElementById("copySourceButton").addEventListener("click", function() {
            var referrerLink = document.getElementById("referrerLink");
            var copiedText = referrerLink.value.trim();
            copyToClipboard(copiedText);
            changeButtonValue();
            removeCopiedText();
        });
    
        function copyToClipboard(text) {
            var tempInput = document.createElement("input");
            tempInput.value = text;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);
        }
    
        function changeButtonValue() {
            var copyButton = document.getElementById("copySourceButton");
            copyButton.value = "Copied";
            setTimeout(function() {
                copyButton.value = "Copy";
            }, 60000); // 1 minute
        }
    
        function removeCopiedText() {
            setTimeout(function() {
                var referrerLink = document.getElementById("referrerLink");
                referrerLink.value = "";
            }, 60000); // 1 minute
        }
    </script>
@endsection