<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;

class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function createCheckoutSession(array $cartItems, string $successUrl, string $cancelUrl)
    {
        try {
            $lineItems = collect($cartItems)->map(function ($item) {
                return [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $item['name'],
                        ],
                        'unit_amount' => $item['price'] * 100, // Convert to cents
                    ],
                    'quantity' => $item['quantity'],
                ];
            })->toArray();

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => $successUrl,
                'cancel_url' => $cancelUrl,
            ]);

            return $session;
        } catch (\Exception $e) {
            Log::error('Stripe checkout session creation failed: ' . $e->getMessage());
            throw $e;
        }
    }
} 