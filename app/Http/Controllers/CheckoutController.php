<?php

namespace App\Http\Controllers;

use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    protected $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    public function checkout(Request $request)
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('cart.checkout', compact('cart'));
    }

    public function createCheckoutSession(Request $request)
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }

        try {
            $session = $this->stripeService->createCheckoutSession(
                $cart,
                route('checkout.success'),
                route('checkout.cancel'),
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address
                ]
            );

            return response()->json(['id' => $session->id]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function success()
    {
        Session::forget('cart');
        return view('checkout.success');
    }

    public function cancel()
    {
        return redirect()->route('cart.index')->with('error', 'Payment was cancelled.');
    }
} 