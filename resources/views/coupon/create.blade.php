<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Coupons</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/createcoupon.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body class="body">
    <div class="container-fluid p-4 m-0">
        <div class="mb-3 fw-bold text-uppercase display-6 d-flex justify-content-between">
            <h2>Add Coupon</h2>
            <a href="/credit" class="btn btn-secondary text-decoration-none">Go Back</a>
        </div>
        @if (isset($message))  
            <div class="alert alert-{{$success?'success':'danger'}}  py-2 w-50" role="alert">
                {{ $message }}
            </div>
        @endif 
        <div class="content">
            <form action="/coupon" method="post" class="d-flex gap-4 justify-content-between align-items-center">
                @csrf
                <div class="left bg-white w-50">
                    <h2 class="title">General</h2>
                     <div class="formBx">
                        <div class="chanBx">
                            <h5>Coupon Channel</h5>
                            <div class="chan">
                            @foreach($channels as $channel)
                                <div class="inputBx">
                                    <input type="radio" class="form-check-input" name="coupon_channel_id" id="{{ $channel->id }}" value="{{ $channel->id }}" required>
                                    <span>{{ $channel->name }}</span>
                                </div>
                            @endforeach
                            </div>
                        </div>
                        <div class="p-3">
                            <div>
                                <div class="form-floating mb-2">
                                  <input type="text" class="form-control" id="floatingInput" placeholder="Coupon Code" required name="coupon_code" readonly value="{{$coupon_code}}">
                                  <label for="floatingInput">Coupon Code</label>
                                </div>
                                <div class="form-floating mb-2">
                                  <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="coupon_type" required>
                                    <option selected disabled>Select your coupon type</option>
                                    <option value="Percentage">Percentage</option>
                                    <option value="Fixed">Fixed</option>
                                  </select>
                                  <label for="floatingSelect">Coupon Type</label>
                                </div>
                                <div class="form-floating" id="percentageInput">
                                  <input type="number" class="form-control" id="percentage" placeholder="Percentage off" name="percentage_off">
                                  <label for="percentage">Percentage off</label>
                                </div>
                                <div class="form-floating" id="fixedInput">
                                  <input type="number" class="form-control" id="fixed" placeholder="Fixed amount" name="fixed_amount">
                                  <label for="fixed">Fixed amount</label>
                                </div>
                                <div class="form-floating mt-2">
                                    <textarea class="form-control" name="description" required placeholder="Description" id="floatingTextarea" name="description"></textarea>
                                    <label for="floatingTextarea">Description</label>
                                </div>
                                @error('description')
                                <small>{{$message}} </small> 
                                @enderror
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
                                      <option value="first purchases">first purchases</option>
                                      <option value="unlimited usage">unlimited usage</option>
                                    </select>
                                    <label for="floatingEffect">Coupon Effectivity</label>
                                </div>
                                <div id="dateInputs" style="display: none;">
                                    <div class="form-floating mb-2">
                                        <input type="datetime-local" class="form-control" id="startDate" name="start_date">
                                        <label for="startDate">Start Date</label>
                                    </div>         
                                    <div class="form-floating mb-2">
                                        <input type="datetime-local" class="form-control" id="endDate" name="end_date">
                                        <label for="endDate">End Date</label>
                                    </div>
                                </div>   
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">This coupon requires a minimum purchase</label>
                                </div>
                                <div class="form-floating mt-2" id="minimumPurchaseInput" style="display: none;">
                                    <input type="text" class="form-control" id="minimumPurchase" placeholder="Minimum Purchase" name="minimum_purchase">
                                    <label for="minimumPurchase">Minimum Purchase</label>
                                </div> 
                                <div class="position-absolute bottom-0 end-0 p-4">
                                    <button class="btn btn-outline-primary px-4">Save</button>
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
    // Hide the percentage and fixed input fields initially
    $('#percentageInput').hide();
    $('#fixedInput').hide();

    // Show/hide input fields based on the selected coupon type
    $('#floatingSelect').change(function() {
      var selectedType = $(this).val();

      if (selectedType === 'Percentage') {
        $('#percentageInput').show();
        $('#fixedInput').hide();
      } else if (selectedType === 'Fixed') {
        $('#percentageInput').hide();
        $('#fixedInput').show();
      } else {
        $('#percentageInput').hide();
        $('#fixedInput').hide();
      }
    });
  });
  $(document).ready(function() {
    // Hide the date inputs initially
    $('#dateInputs').hide();

    // Show/hide date inputs based on the selected effectivity
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
    $('#flexCheckDefault').change(function() {
      if ($(this).is(':checked')) {
        $('#minimumPurchaseInput').show();
      } else {
        $('#minimumPurchaseInput').hide();
      }
    });
  });
</script>

</body>
</html>