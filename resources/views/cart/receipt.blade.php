@extends('layouts.app')

@section('title', 'Order Receipt')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-4">
                    <div class="text-center">
                        <i class="fas fa-check-circle fa-4x mb-3" style="color: #6B4E3E;"></i>
                        <h2 class="mb-2" style="color: #6B4E3E;">Order Confirmed!</h2>
                        <p class="text-muted">Thank you for your order</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="mb-3" style="color: #6B4E3E;">Order Details</h5>
                            <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                            <p><strong>Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                            <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                            <p><strong>Payment Status:</strong> 
                                <span class="badge" style="background-color: {{ $order->payment_status === 'completed' ? '#28a745' : '#ffc107' }}; color: white;">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-3" style="color: #6B4E3E;">Delivery Information</h5>
                            <p><strong>Name:</strong> {{ $order->name }}</p>
                            <p><strong>Email:</strong> {{ $order->email }}</p>
                            <p><strong>Phone:</strong> {{ $order->phone }}</p>
                            <p><strong>Address:</strong> {{ $order->address }}</p>
                            <p><strong>Delivery Time:</strong> {{ ucfirst($order->delivery_time) }}</p>
                        </div>
                    </div>

                    <div class="table-responsive mb-4">
                        <table class="table">
                            <thead style="background-color: #F5E6D3;">
                                <tr>
                                    <th style="color: #6B4E3E;">Product</th>
                                    <th class="text-center" style="color: #6B4E3E;">Quantity</th>
                                    <th class="text-center" style="color: #6B4E3E;">Price</th>
                                    <th class="text-center" style="color: #6B4E3E;">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($item->product->image)
                                                    <img src="{{ asset('storage/products/' . $item->product->image) }}" 
                                                         alt="{{ $item->product->name }}" 
                                                         class="img-thumbnail me-3" 
                                                         style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('images/default-product.jpg') }}" 
                                                         alt="{{ $item->product->name }}" 
                                                         class="img-thumbnail me-3" 
                                                         style="width: 60px; height: 60px; object-fit: cover;">
                                                @endif
                                                <div>
                                                    <h6 class="mb-1" style="color: #6B4E3E;">{{ $item->product->name }}</h6>
                                                    <small class="text-muted">{{ $item->product->category }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">{{ $item->quantity }}</td>
                                        <td class="align-middle text-center">₹{{ number_format($item->price, 2) }}</td>
                                        <td class="align-middle text-center">₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Subtotal:</strong></td>
                                    <td class="text-center">₹{{ number_format($order->total - $order->delivery_fee, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Delivery Fee:</strong></td>
                                    <td class="text-center">₹{{ number_format($order->delivery_fee, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                    <td class="text-center"><strong>₹{{ number_format($order->total, 2) }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('products.index') }}" class="btn" style="background-color: #6B4E3E; color: white;">
                            <i class="fas fa-utensils me-2"></i>Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 