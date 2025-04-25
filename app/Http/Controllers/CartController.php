<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->quantity ?? 1;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'quantity' => $request->quantity ?? 1,
                'price' => $product->price,
                'image' => $product->image,
                'category' => $product->category
            ];
        }

        session()->put('cart', $cart);
        
        if ($request->ajax()) {
            return response()->json([
                'count' => array_reduce($cart, function($sum, $item) {
                    return $sum + $item['quantity'];
                }, 0),
                'message' => 'Product added to cart successfully!'
            ]);
        }
        
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }

    public function update(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$product->id])) {
            if($request->action === 'increase') {
                $cart[$product->id]['quantity']++;
            } elseif($request->action === 'decrease' && $cart[$product->id]['quantity'] > 1) {
                $cart[$product->id]['quantity']--;
            } elseif(isset($request->quantity)) {
                $cart[$product->id]['quantity'] = max(1, intval($request->quantity));
            }
            
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Cart updated successfully!');
        }

        return redirect()->back()->with('error', 'Product not found in cart!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        return view('cart.checkout', compact('cart'));
    }

    public function getCount()
    {
        $cart = session()->get('cart', []);
        $count = array_reduce($cart, function($sum, $item) {
            return $sum + $item['quantity'];
        }, 0);
        
        return response()->json(['count' => $count]);
    }

    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Calculate total
        $total = array_reduce($cart, function($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);

        // Add delivery fee only if total is less than 1000
        $deliveryFee = $total >= 1000 ? 0 : 50;
        $total += $deliveryFee;

        // Create order
        $order = new Order();
        $order->name = $request->name;
        $order->email = $request->email;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->delivery_time = $request->delivery_time;
        $order->payment_method = $request->payment_method;
        $order->total = $total;
        $order->delivery_fee = $deliveryFee;

        if ($request->payment_method === 'online') {
            $paymentDetails = json_decode($request->payment_details, true);
            $order->payment_id = $paymentDetails['razorpay_payment_id'];
            $order->payment_status = 'completed';
        } else {
            $order->payment_status = 'pending';
        }

        $order->save();

        // Create order items
        foreach ($cart as $id => $details) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $id;
            $orderItem->quantity = $details['quantity'];
            $orderItem->price = $details['price'];
            $orderItem->save();
        }

        // Clear cart
        session()->forget('cart');

        return view('cart.receipt', compact('order', 'cart'));
    }

    public function receipt(Order $order)
    {
        $cart = session()->get('cart', []);
        return view('cart.receipt', compact('order', 'cart'));
    }
} 