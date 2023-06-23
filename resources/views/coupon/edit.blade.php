<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Coupon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/createcoupon.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid p-4 m-0">
        <div class="mb-3 fw-bold text-uppercase display-6 d-flex justify-content-between">
            <h2>Edit Coupon</h2>
            <a href="/credit" class="btn btn-secondary text-decoration-none">Go Back</a>
        </div>
        <div class="content">
            <form action="/coupon/{{$coupon->id}}" method="post" class="d-flex gap-4 justify-content-between align-items-center">
                @csrf
                @method('PUT')
                <div class="left bg-white w-50">
                    <h2 class="title">General</h2>
                     <div class="formBx">
                        <div class="chanBx">
                            <h5>Coupon Channel</h5>
                            <div class="chan">
                                @foreach($channels as $channel)
                                <div class="inputBx">
                                    <input type="radio" class="form-check-input" name="coupon_channel_id" id="{{ $channel->id }}" value="{{ $channel->id }}" required
                                    {{ $channel->id == $coupon->coupon_channel_id ? 'checked' : '' }}>
                                    <span>{{ $channel->name }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="p-3">
                            <div>
                                <div class="form-floating mb-2">
                                  <input type="text" class="form-control" id="floatingInput" placeholder="Coupon Code" required name="coupon_code" value="{{$coupon->coupon_code}}" disabled>
                                  <label for="floatingInput">Coupon Code</label>
                                </div>
                                <div class="form-floating mb-2">
                                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="coupon_type" required>
                                        <option disabled>Select your coupon type</option>
                                        <option value="Percentage" {{ $coupon->coupon_type == 'Percentage' ? 'selected' : '' }}>Percentage</option>
                                        <option value="Fixed" {{ $coupon->coupon_type == 'Fixed' ? 'selected' : '' }}>Fixed</option>
                                    </select>
                                    <label for="floatingSelect">Coupon Type</label>
                                </div>
                                <div class="form-floating" id="percentageInput">
                                    <input type="number" class="form-control" id="percentage" placeholder="Percentage off" name="percentage_off" value="{{ $coupon->percentage_off }}">
                                    <label for="percentage">Percentage off</label>
                                </div>
                                <div class="form-floating" id="fixedInput">
                                    <input type="number" class="form-control" id="fixed" placeholder="Fixed amount" name="fixed_amount" value="{{ $coupon->fixed_amount }}">
                                    <label for="fixed">Fixed amount</label>
                                </div>                                
                                <div class="form-floating mt-2">
                                    <textarea class="form-control" name="description" required placeholder="Description" id="floatingTextarea">{{ $coupon->description }}</textarea>
                                    <label for="floatingTextarea">Description</label>
                                </div>
                                
                            </div>                              
                        </div>
                     </div>
                </div>
                <div class="right bg-white w-50">
                    <h2 class="title">Usage</h2>
                        <div class="formBx">
                           <div class="p-3">
                                <div class="form-floating mb-2">
                                    <select class="form-select" name="effectivity" id="floatingEffect" aria-label="Floating label select example" required>
                                        <option selected disabled>Select your coupon effectivity</option>
                                        <option value="first purchases" {{ $coupon->effectivity === 'first purchases' ? 'selected' : '' }}>first purchases</option>
                                        <option value="unlimited usage" {{ $coupon->effectivity === 'unlimited usage' ? 'selected' : '' }}>unlimited usage</option>
                                    </select>
                                    <label for="floatingEffect">Coupon Effectivity</label>
                                </div>
                                <div id="dateInputs" {{ $coupon->effectivity === 'unlimited usage' ? '' : 'style=display:none' }}>
                                    <div class="form-floating mb-2">
                                        <input type="datetime-local" class="form-control" id="startDate" name="start_date" value="{{ $coupon->start_date }}">
                                        <label for="startDate">Start Date</label>
                                    </div>
                                    <div class="form-floating mb-2">
                                        <input type="datetime-local" class="form-control" id="endDate" name="end_date" value="{{ $coupon->end_date }}">
                                        <label for="endDate">End Date</label>
                                    </div>
                                </div>
                             
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" id="flexCheckDefault" {{ $coupon->minimum_purchase ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault">This coupon requires a minimum purchase</label>
                                </div>
                                <div class="form-floating mt-2" id="minimumPurchaseInput" {{ $coupon->minimum_purchase ? '' : 'style=display:none' }}>
                                    <input type="text" class="form-control" id="minimumPurchase" placeholder="Minimum Purchase" name="minimum_purchase" value="{{ $coupon->minimum_purchase }}">
                                    <label for="minimumPurchase">Minimum Purchase</label>
                                </div>                                
                                <div class="position-absolute bottom-0 end-0 p-4">
                                    <button class="btn btn-outline-primary px-4" type="submit">Update</button>
                                </div>                                                  
                            </div> 
                        </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $(document).ready(function() {
    // Show/hide date inputs based on the selected effectivity
    var selectedEffectivity = $('#floatingEffect').val();
    if (selectedEffectivity === 'unlimited usage') {
        $('#dateInputs').show();
    } else {
        $('#dateInputs').hide();
    }

    // Show/hide date inputs when the effectivity is changed
    $('#floatingEffect').change(function() {
        var selectedEffectivity = $(this).val();
        if (selectedEffectivity === 'unlimited usage') {
            $('#dateInputs').show();
        } else {
            $('#dateInputs').hide();
        }
    });
  });

    $(document).ready(function() {
        // Show/hide minimum purchase input based on the checkbox status
        var isChecked = $('#flexCheckDefault').prop('checked');
        if (isChecked) {
            $('#minimumPurchaseInput').show();
        } else {
            $('#minimumPurchaseInput').hide();
        }
    
        // Show/hide minimum purchase input when the checkbox is clicked
        $('#flexCheckDefault').change(function() {
            var isChecked = $(this).prop('checked');
            if (isChecked) {
                $('#minimumPurchaseInput').show();
            } else {
                $('#minimumPurchaseInput').hide();
            }
        });
    });

</script>
<script>
    $(document).ready(function() {
  // Get the initial coupon type value
  var initialCouponType = $('#floatingSelect').val();

  // Hide/show input fields based on the selected coupon type
  function toggleInputFields() {
    var selectedType = $('#floatingSelect').val();

    if (selectedType === 'Percentage') {
      // Clear the value of fixed_amount input
      $('#fixed').val('');

      // Show/hide input fields
      $('#percentageInput').show();
      $('#fixedInput').hide();
    } else if (selectedType === 'Fixed') {
      // Clear the value of percentage_off input
      $('#percentage').val('');

      // Show/hide input fields
      $('#percentageInput').hide();
      $('#fixedInput').show();
    } else {
      // Clear the values of both inputs
      $('#percentage').val('');
      $('#fixed').val('');

      // Hide both input fields
      $('#percentageInput').hide();
      $('#fixedInput').hide();
    }
  }

  // Call the function initially to set the input fields based on the initial coupon type
  toggleInputFields();

  // Handle the change event of coupon_type select input
  $('#floatingSelect').change(function() {
    toggleInputFields();
  });
});
</script>
</body>
</html>