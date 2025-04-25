<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $razorpay;

    public function __construct()
    {
        $this->razorpay = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    }

    public function create(Request $request)
    {
        try {
            $cart = session()->get('cart', []);
            $total = array_reduce($cart, function($sum, $item) {
                return $sum + ($item['price'] * $item['quantity']);
            }, 0);

            // Add delivery fee only if total is less than 1000
            if ($total < 1000) {
                $total += 50; // ₹50 delivery fee
            }

            // Ensure total is an integer (convert to paise)
            $amount = (int)($total * 100);

            // Create Razorpay order
            $order = $this->razorpay->order->create([
                'amount' => $amount,
                'currency' => 'INR',
                'receipt' => 'order_' . time(),
            ]);

            return response()->json([
                'order_id' => $order->id,
                'amount' => $amount,
                'currency' => 'INR',
                'key' => env('RAZORPAY_KEY')
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function success(Request $request)
    {
        try {
            $attributes = [
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            $this->razorpay->utility->verifyPaymentSignature($attributes);

            // Payment successful, redirect to receipt
            return redirect()->route('cart.receipt')->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            return redirect()->route('cart.checkout')->with('error', 'Payment verification failed.');
        }
    }

    public function showReceipt(Order $order)
    {
        Log::info('Showing receipt for order:', ['order' => $order->toArray()]);
        return view('checkout.receipt', compact('order'));
    }
} 