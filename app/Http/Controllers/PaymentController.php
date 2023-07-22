<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Paystack;

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
    private function generateOrderID()
    {
        return uniqid(); // Generates a unique identifier based on the current time
    }
    public function index()
    {
        $carts = Cart::with('product', 'product.images')->where('user_id', Auth::user()->id)->get();
        $totalAmount = $this->calculateTotalAmount($carts);
        $orderID = $this->generateOrderID();
        return view('payment', ['carts' => $carts, 'totalAmount' => $totalAmount, 'orderID' => $orderID]);
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
    public function handleGatewayCallback(Request $request)
    {
        $paymentData = Paystack::getPaymentData();
        Payment::create([
            'payment_id' => $paymentData['data']['id'],
            'status' => $paymentData['data']['status'],
            'reference' => $paymentData['data']['reference'],
            'amount' => $paymentData['data']['amount'],
            'channel' => $paymentData['data']['channel'],
            'currency' => $paymentData['data']['currency'],
            'user_id' => $paymentData['data']['metadata']['user_id'],
            'email' => $paymentData['data']['customer']['email'],
        ]);
        if ($paymentData['data']['status'] == 'success') {
            $carts = Cart::where('user_id', Auth::user()->id)->get();
            foreach ($carts as $cart) {
                $cart->delete();
            }
            flash('Payment was successful. Your order will be processed shortly.')->success();
            return redirect()->route('store');
        } else {
            flash('Payment was not successful. Please try again.')->error();
            return redirect()->route('store');
        }
    }

}
