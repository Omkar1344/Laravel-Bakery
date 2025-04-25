@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container">
    <h1 class="page-title text-center mb-4">
        <i class="fas fa-credit-card me-2"></i>Checkout
    </h1>

    <div class="row">
        <div class="col-lg-8">
            <div class="checkout-form mb-4">
                <h3 class="section-title">Shipping Information</h3>
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="col-md-6">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="col-md-6">
                            <label for="postal_code" class="form-label">Postal Code</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" required>
                        </div>
                        <div class="col-12">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="order-summary">
                <h3 class="section-title">Order Summary</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0 @endphp
                            @foreach($cart as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                                <tr>
                                    <td>
                                        {{ $details['name'] }} x {{ $details['quantity'] }}
                                    </td>
                                    <td>₹{{ $details['price'] * $details['quantity'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th>₹{{ $total }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-lock me-2"></i>Complete Purchase
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 