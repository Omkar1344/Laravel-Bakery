@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
<div class="container py-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <img src="{{ $product->image_url }}" class="card-img-top product-detail-image" alt="{{ $product->name }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h1 class="display-5 fw-bold" style="color: #6B4E3E;">{{ $product->name }}</h1>
                    <div class="d-flex align-items-center mb-4">
                        <span class="badge" style="background-color: #F5E6D3; color: #6B4E3E;">{{ $product->category }}</span>
                        @if($product->stock > 0)
                            <span class="badge ms-2" style="background-color: #E8C4A2; color: #6B4E3E;">In Stock</span>
                        @else
                            <span class="badge bg-danger ms-2">Out of Stock</span>
                        @endif
                    </div>
                    
                    <div class="price-display mb-4">
                        <span class="h2" style="color: #6B4E3E;">₹{{ number_format($product->price, 2) }}</span>
                    </div>

                    <p class="lead mb-4" style="color: #6B4E3E;">{{ $product->description }}</p>
                    
                    @if($product->stock > 0)
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="mb-3">
                                <label for="quantity" class="form-label fw-bold" style="color: #6B4E3E;">Quantity</label>
                                <div class="input-group" style="width: 150px;">
                                    <button type="button" class="btn" style="background-color: #F5E6D3; color: #6B4E3E;" onclick="decrementQuantity()">-</button>
                                    <input type="number" class="form-control text-center" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}" style="border-color: #F5E6D3;">
                                    <button type="button" class="btn" style="background-color: #F5E6D3; color: #6B4E3E;" onclick="incrementQuantity()">+</button>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-lg w-100" style="background-color: #6B4E3E; color: white;">
                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                            </button>
                        </form>
                        <p class="text-success mb-4">
                            <i class="fas fa-check-circle me-2"></i>In Stock: {{ $product->stock }} items available
                        </p>
                    @else
                        <div class="alert alert-warning mb-4">
                            <i class="fas fa-exclamation-circle me-2"></i>This product is currently out of stock
                        </div>
                    @endif
                    
                    <a href="{{ route('products.index') }}" class="btn" style="background-color: #F5E6D3; color: #6B4E3E;">
                        <i class="fas fa-arrow-left me-2"></i>Back to Products
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .product-detail-image {
        height: 500px;
        object-fit: cover;
        border-radius: 15px;
    }

    .price-display {
        padding: 1rem;
        background: #F5E6D3;
        border-radius: 10px;
        display: inline-block;
    }

    .input-group button {
        width: 40px;
        border: 1px solid #F5E6D3;
    }

    .input-group input {
        border-left: none;
        border-right: none;
        border-color: #F5E6D3;
    }

    .badge {
        font-size: 0.9rem;
        padding: 0.5em 0.75em;
        border-radius: 5px;
    }

    .btn {
        border-radius: 5px;
        transition: all 0.2s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
    }
</style>
@endpush

@push('scripts')
<script>
    function incrementQuantity() {
        const input = document.getElementById('quantity');
        const max = parseInt(input.getAttribute('max'));
        if (parseInt(input.value) < max) {
            input.value = parseInt(input.value) + 1;
        }
    }

    function decrementQuantity() {
        const input = document.getElementById('quantity');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
</script>
@endpush
@endsection 