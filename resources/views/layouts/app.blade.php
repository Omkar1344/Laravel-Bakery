<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bakery Delights - @yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
    <style>
        body {
            background-color: #F5E6D3;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .main-content {
            background-color: #FFFFFF;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            padding: 20px;
            flex: 1;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .btn-primary {
            background-color: #6B4E3E;
            border-color: #6B4E3E;
        }
        .btn-primary:hover {
            background-color: #8B6B5E;
            border-color: #8B6B5E;
        }
        .btn-outline-primary {
            color: #6B4E3E;
            border-color: #6B4E3E;
        }
        .btn-outline-primary:hover {
            background-color: #6B4E3E;
            border-color: #6B4E3E;
            color: #FFFFFF;
        }
        .page-title {
            color: #6B4E3E;
            margin-bottom: 30px;
        }
        .section-title {
            color: #6B4E3E;
            border-bottom: 2px solid #E8C4A2;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        /* Product Card Styles */
        .product-card {
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        .product-card .card-body {
            display: flex;
            flex-direction: column;
        }
        .product-card img {
            height: 200px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }
        .product-card .card-title {
            color: #6B4E3E;
            font-weight: 600;
        }
        .product-card .card-text {
            flex-grow: 1;
        }
        .product-card .price {
            color: #6B4E3E;
            font-size: 1.25rem;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #6B4E3E 0%, #8B6B5E 100%);">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}" style="font-size: 1.5rem; letter-spacing: 0.5px;">
                <i class="fas fa-birthday-cake me-2" style="color: #E8C4A2;"></i>Bakery Delights
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="{{ route('home') }}" style="font-weight: 500; letter-spacing: 0.3px;">
                            <i class="fas fa-home me-1" style="color: #E8C4A2;"></i>Home
                            <span class="position-absolute bottom-0 start-50 translate-middle-x" style="width: 0; height: 2px; background-color: #E8C4A2; transition: width 0.3s;"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="{{ route('products.index') }}" style="font-weight: 500; letter-spacing: 0.3px;">
                            <i class="fas fa-bread-slice me-1" style="color: #E8C4A2;"></i>Products
                            <span class="position-absolute bottom-0 start-50 translate-middle-x" style="width: 0; height: 2px; background-color: #E8C4A2; transition: width 0.3s;"></span>
                        </a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="{{ route('cart.index') }}" class="btn btn-light position-relative" style="background-color: #E8C4A2; border: none; color: #6B4E3E; font-weight: 500; transition: all 0.3s;">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="background-color: #6B4E3E; color: #E8C4A2;">
                            {{ array_reduce(session('cart', []), function($sum, $item) { return $sum + $item['quantity']; }, 0) }}
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            <div class="main-content">
                @yield('content')
            </div>
        </div>
    </main>

    <footer class="py-5" style="background: linear-gradient(135deg, #6B4E3E 0%, #8B6B5E 100%); color: #F5E6D3;">
        <div class="container">
            <div class="row g-4">
                <!-- About Section -->
                <div class="col-lg-4">
                    <h5 class="mb-4 fw-bold">
                        <i class="fas fa-birthday-cake me-2"></i>Bakery Delights
                    </h5>
                    <p class="mb-4">Freshly baked goods made with love and tradition. We use only the finest ingredients to create memorable treats for every occasion.</p>
                    <div class="social-links">
                        <a href="https://www.facebook.com/bakerydelights" target="_blank" class="me-3" style="color: #F5E6D3;">
                            <i class="fab fa-facebook-f fa-lg"></i>
                        </a>
                        <a href="https://www.instagram.com/bakerydelights" target="_blank" class="me-3" style="color: #F5E6D3;">
                            <i class="fab fa-instagram fa-lg"></i>
                        </a>
                        <a href="https://twitter.com/bakerydelights" target="_blank" class="me-3" style="color: #F5E6D3;">
                            <i class="fab fa-twitter fa-lg"></i>
                        </a>
                        <a href="https://www.pinterest.com/bakerydelights" target="_blank" style="color: #F5E6D3;">
                            <i class="fab fa-pinterest fa-lg"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2">
                    <h5 class="mb-4 fw-bold">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('home') }}" class="text-decoration-none" style="color: #F5E6D3;">
                                <i class="fas fa-chevron-right me-2"></i>Home
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('products.index') }}" class="text-decoration-none" style="color: #F5E6D3;">
                                <i class="fas fa-chevron-right me-2"></i>Products
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('cart.index') }}" class="text-decoration-none" style="color: #F5E6D3;">
                                <i class="fas fa-chevron-right me-2"></i>Cart
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-decoration-none" style="color: #F5E6D3;">
                                <i class="fas fa-chevron-right me-2"></i>About Us
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-4">
                    <h5 class="mb-4 fw-bold">Contact Us</h5>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            123 Bakery Street, City, State 12345
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-phone me-2"></i>
                            +91 1234567890
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-envelope me-2"></i>
                            info@bakerydelights.com
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-clock me-2"></i>
                            Mon-Sat: 8:00 AM - 8:00 PM
                        </li>
                    </ul>
                </div>
            </div>
            <hr style="border-color: #E8C4A2;">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; {{ date('Y') }} Bakery Delights. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-decoration-none me-3" style="color: #F5E6D3;">Privacy Policy</a>
                    <a href="#" class="text-decoration-none" style="color: #F5E6D3;">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html> 