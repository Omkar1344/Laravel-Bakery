@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Payment Successful!</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                        <h3 class="mt-3">Thank You for Your Order!</h3>
                        <p class="text-muted">Your order has been placed successfully.</p>
                    </div>

                    <div class="order-details">
                        <h5 class="mb-3">Order Details</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Order ID:</th>
                                    <td>{{ $order->razorpay_order_id }}</td>
                                </tr>
                                <tr>
                                    <th>Payment ID:</th>
                                    <td>{{ $order->razorpay_payment_id }}</td>
                                </tr>
                                <tr>
                                    <th>Date:</th>
                                    <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td><span class="badge bg-success">{{ ucfirst($order->status) }}</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="customer-details mt-4">
                        <h5 class="mb-3">Customer Information</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $order->customer_name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $order->customer_email }}</td>
                                </tr>
                                <tr>
                                    <th>Address:</th>
                                    <td>{{ $order->customer_address }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="amount-details mt-4">
                        <h5 class="mb-3">Amount Details</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Total Amount:</th>
                                    <td>₹{{ number_format($order->amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Currency:</th>
                                    <td>{{ strtoupper($order->currency) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('products.index') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-bag"></i> Continue Shopping
                        </a>
                        <button onclick="window.print()" class="btn btn-outline-primary ms-2">
                            <i class="fas fa-print"></i> Print Receipt
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        .btn {
            display: none !important;
        }
        .card {
            border: none !important;
        }
        .card-header {
            background-color: #fff !important;
            color: #000 !important;
            border-bottom: 2px solid #000 !important;
        }
    }
</style>
@endsection 