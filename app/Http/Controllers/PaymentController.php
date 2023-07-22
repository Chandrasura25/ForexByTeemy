<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Facades\Redirect;
use Paystack;
use Illuminate\Http\Request;
class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    private function calculateTotalAmount($carts)
    {
        $totalAmount = 0;
        foreach ($carts as $cart) {
            $totalAmount += $cart->product->price * $cart->quantity;
        }
        return $totalAmount;
    }
    private function generateOrderID() {
        return uniqid(); // Generates a unique identifier based on the current time
    }
    public function index()
    {
        $carts = Cart::with('product', 'product.images')->where('user_id', Auth::user()->id)->get();
        $totalAmount = $this->calculateTotalAmount($carts);
        $orderID = $this->generateOrderID();
        return view('payment',['carts' => $carts, 'totalAmount' => $totalAmount, 'orderID' => $orderID]); 
    }
    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway(Request $request)
    {
       
         return Paystack::getAuthorizationUrl($request->all())->redirectNow();
        try {
        } catch (\Exception $e) {
            return Redirect::back()->withMessage(['msg' => 'The paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
        }
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
//     public function handleGatewayCallback()
//     {
//         $paymentDetails = Paystack::getPaymentData();

//     //     dd($paymentDetails);
//         // Now you have the payment details,
//         // you can store the authorization_code in your db to allow for recurrent subscriptions
//         // you can then redirect or do whatever you want
//    }
   

public function handleGatewayCallback()
{
    try {
        // Get payment data from the query parameters
        $paymentData = request()->query();

        // Retrieve transaction reference from the payment data
        $transactionReference = $paymentData['reference'];

        // Retrieve payment status from the payment data
        $paymentStatus = $paymentData['status'];
  dd($paymentData);
        // Process the payment status accordingly
        // if ($paymentStatus === 'success') {
        //     // Payment successful, update your database and perform necessary actions
        //     // Example: Update the order status, save payment details, etc.

        //     // Redirect to a success page or any other page as desired
        //     return Redirect::route('payment.success')->with('success', 'Payment successful!');
        // } else {
        //     // Payment failed, handle the error as needed

        //     // Redirect to a failure page or any other page as desired
        //     return Redirect::route('payment.failure')->with('error', 'Payment failed!');
        // }
    } catch (\Exception $e) {
        // An error occurred while verifying payment status, handle it accordingly
        return Redirect::back()->withMessage(['msg' => 'An error occurred during payment verification.', 'type' => 'error']);
       
    }
}

   
}
