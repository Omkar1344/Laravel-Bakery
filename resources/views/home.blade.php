@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron text-center">
                <h1 class="display-4">Welcome to Our Bakery</h1>
                <p class="lead">Discover our delicious selection of freshly baked goods</p>
                <hr class="my-4">
                <p>We use the finest ingredients to create memorable treats for every occasion.</p>
                <a class="btn btn-primary btn-lg" href="{{ route('products.index') }}" role="button">View Our Products</a>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h3>Fresh Daily</h3>
                    <p>All our products are baked fresh every day</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h3>Quality Ingredients</h3>
                    <p>We use only the finest ingredients in our recipes</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h3>Custom Orders</h3>
                    <p>Special orders welcome for any occasion</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 