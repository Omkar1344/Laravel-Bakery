@extends('layouts.app')

@section('title', 'Your Shopping Cart')

@section('content')
<div class="container">
    <h1 class="page-title text-center mb-4">
        <i class="fas fa-shopping-cart me-2"></i>Your Shopping Cart
    </h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(count($cart) > 0)
        <div class="cart-table p-4">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0 @endphp
                        @foreach($cart as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if(isset($details['image']) && $details['image'])
                                            <img src="{{ asset('storage/products/' . $details['image']) }}" alt="{{ $details['name'] }}" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('images/default-product.jpg') }}" alt="{{ $details['name'] }}" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                        @endif
                                        <div class="ms-3">
                                            <h5 class="mb-1">{{ $details['name'] }}</h5>
                                            @if(isset($details['category']))
                                                <small class="text-muted">{{ $details['category'] }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>₹{{ $details['price'] }}</td>
                                <td>
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex align-items-center">
                                        @csrf
                                        @method('PATCH')
                                        <div class="input-group" style="width: 120px;">
                                            <button type="button" class="btn btn-outline-secondary btn-sm quantity-btn" data-action="decrease">-</button>
                                            <input type="number" name="quantity" class="form-control text-center quantity-input" value="{{ $details['quantity'] }}" min="1" readonly>
                                            <button type="button" class="btn btn-outline-secondary btn-sm quantity-btn" data-action="increase">+</button>
                                        </div>
                                    </form>
                                </td>
                                <td>₹{{ $details['price'] * $details['quantity'] }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="cart-total mt-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Total: ₹{{ $total }}</h4>
                    <div>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-primary me-2">
                            <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                        </a>
                        <a href="{{ route('checkout') }}" class="btn btn-primary">
                            <i class="fas fa-credit-card me-2"></i>Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-shopping-cart fa-4x mb-3" style="color: #6B4E3E;"></i>
            <h3>Your cart is empty</h3>
            <p class="text-muted">Looks like you haven't added any items to your cart yet.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">
                <i class="fas fa-utensils me-2"></i>Start Shopping
            </a>
        </div>
    @endif
</div>

@push('scripts')
<script>
    document.querySelectorAll('.quantity-btn').forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('form');
            const input = form.querySelector('.quantity-input');
            const action = this.dataset.action;
            
            if (action === 'increase') {
                input.value = parseInt(input.value) + 1;
            } else if (action === 'decrease' && parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
            
            // Submit the form when quantity changes
            form.submit();
        });
    });
</script>
@endpush
@endsection 