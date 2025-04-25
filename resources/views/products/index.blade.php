@extends('layouts.app')

@section('title', 'Our Delicious Products')

@section('content')
<div class="container">
    <h1 class="page-title text-center mb-4">
        <i class="fas fa-birthday-cake me-2"></i>Our Delicious Products
    </h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($products as $product)
            <div class="col">
                <div class="card product-card h-100">
                    <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($product->description, 100) }}</p>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="price h5 mb-0" style="color: #6B4E3E;">₹{{ $product->price }}</span>
                                <span class="badge bg-success">{{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}</span>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary flex-grow-1">
                                    <i class="fas fa-eye me-2"></i>View Details
                                </a>
                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-grow-1">
                                    @csrf
                                    <button type="submit" class="btn btn-primary w-100" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                        <i class="fas fa-cart-plus me-2"></i>Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection 