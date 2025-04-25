@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container py-5">
    <!-- Progress Indicator -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 40px; height: 40px; background-color: #6B4E3E;">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <small class="text-muted">Cart</small>
                </div>
                <div class="flex-grow-1">
                    <hr style="border-color: #6B4E3E;">
                </div>
                <div class="text-center">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 40px; height: 40px; background-color: #6B4E3E;">
                        <i class="fas fa-truck"></i>
                    </div>
                    <small class="text-muted">Delivery</small>
                </div>
                <div class="flex-grow-1">
                    <hr style="border-color: #6B4E3E;">
                </div>
                <div class="text-center">
                    <div class="rounded-circle bg-light text-muted d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 40px; height: 40px;">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <small class="text-muted">Payment</small>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold" style="color: #6B4E3E;">Checkout</h1>
        <p class="lead text-muted">Complete your order with us</p>
    </div>

    @if(count($cart) > 0)
        <div class="row">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0" style="color: #6B4E3E;">Order Summary</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead style="background-color: #F5E6D3;">
                                    <tr>
                                        <th class="border-0" style="color: #6B4E3E;">Product</th>
                                        <th class="border-0 text-center" style="color: #6B4E3E;">Quantity</th>
                                        <th class="border-0 text-center" style="color: #6B4E3E;">Price</th>
                                        <th class="border-0 text-center" style="color: #6B4E3E;">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0 @endphp
                                    @foreach($cart as $id => $details)
                                        @php 
                                            $itemTotal = $details['price'] * $details['quantity'];
                                            $total += $itemTotal;
                                        @endphp
                                        <tr>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    @if(isset($details['image']) && $details['image'])
                                                        <img src="{{ asset('storage/products/' . $details['image']) }}" alt="{{ $details['name'] }}" class="img-thumbnail me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                                    @else
                                                        <img src="{{ asset('images/default-product.jpg') }}" alt="{{ $details['name'] }}" class="img-thumbnail me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-1" style="color: #6B4E3E;">{{ $details['name'] }}</h6>
                                                        @if(isset($details['category']))
                                                            <small class="text-muted">{{ $details['category'] }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center" style="color: #6B4E3E;">{{ $details['quantity'] }}</td>
                                            <td class="align-middle text-center" style="color: #6B4E3E;">₹{{ number_format($details['price'], 2) }}</td>
                                            <td class="align-middle text-center" style="color: #6B4E3E;">₹{{ number_format($itemTotal, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0" style="color: #6B4E3E;">Total Amount:</h5>
                            <h4 class="mb-0" style="color: #6B4E3E;">₹{{ number_format($total, 2) }}</h4>
                        </div>
                    </div>
                </div>

                <!-- Delivery Information -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0" style="color: #6B4E3E;">Delivery Information</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('cart.process-checkout') }}" method="POST" id="checkout-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label" style="color: #6B4E3E;">Full Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background-color: #F5E6D3; border-color: #F5E6D3;">
                                            <i class="fas fa-user" style="color: #6B4E3E;"></i>
                                        </span>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label" style="color: #6B4E3E;">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background-color: #F5E6D3; border-color: #F5E6D3;">
                                            <i class="fas fa-envelope" style="color: #6B4E3E;"></i>
                                        </span>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label" style="color: #6B4E3E;">Delivery Address</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: #F5E6D3; border-color: #F5E6D3;">
                                        <i class="fas fa-map-marker-alt" style="color: #6B4E3E;"></i>
                                    </span>
                                    <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label" style="color: #6B4E3E;">Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background-color: #F5E6D3; border-color: #F5E6D3;">
                                            <i class="fas fa-phone" style="color: #6B4E3E;"></i>
                                        </span>
                                        <input type="tel" class="form-control" id="phone" name="phone" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="delivery_time" class="form-label" style="color: #6B4E3E;">Preferred Delivery Time</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background-color: #F5E6D3; border-color: #F5E6D3;">
                                            <i class="fas fa-clock" style="color: #6B4E3E;"></i>
                                        </span>
                                        <select class="form-select" id="delivery_time" name="delivery_time" required>
                                            <option value="">Select time</option>
                                            <option value="morning">Morning (9 AM - 12 PM)</option>
                                            <option value="afternoon">Afternoon (12 PM - 3 PM)</option>
                                            <option value="evening">Evening (3 PM - 6 PM)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #6B4E3E;">Payment Method</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                                        <label class="form-check-label" for="cod" style="color: #6B4E3E;">
                                            <i class="fas fa-money-bill-wave me-2"></i>Cash on Delivery
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="online" value="online">
                                        <label class="form-check-label" for="online" style="color: #6B4E3E;">
                                            <i class="fas fa-credit-card me-2"></i>Online Payment
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn" style="background-color: #6B4E3E; color: white;">
                                    <i class="fas fa-lock me-2"></i>Proceed to Payment
                                </button>
                                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Back to Cart
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Order Summary Card -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0" style="color: #6B4E3E;">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span style="color: #6B4E3E;">Subtotal</span>
                            <span style="color: #6B4E3E;">₹{{ number_format($total, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span style="color: #6B4E3E;">Delivery Fee</span>
                            <span style="color: #6B4E3E;">₹{{ $total >= 1000 ? '0.00' : '50.00' }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-bold" style="color: #6B4E3E;">Total</span>
                            <span class="fw-bold" style="color: #6B4E3E;">₹{{ number_format($total + ($total >= 1000 ? 0 : 50), 2) }}</span>
                        </div>
                        <div class="alert alert-info" style="background-color: #F5E6D3; border-color: #E8C4A2; color: #6B4E3E;">
                            <i class="fas fa-info-circle me-2"></i>
                            Free delivery on orders above ₹1000
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <div class="empty-cart-icon mb-4">
                <i class="fas fa-shopping-cart fa-4x" style="color: #E8C4A2;"></i>
            </div>
            <h3 class="mb-3" style="color: #6B4E3E;">Your cart is empty</h3>
            <p class="text-muted mb-4">Looks like you haven't added any delicious treats to your cart yet!</p>
            <a href="{{ route('products.index') }}" class="btn" style="background-color: #6B4E3E; color: white;">
                <i class="fas fa-utensils me-2"></i>Start Shopping
            </a>
        </div>
    @endif
</div>

@push('styles')
<style>
    .card {
        border-radius: 10px;
        transition: transform 0.2s ease;
    }

    .card:hover {
        transform: translateY(-2px);
    }

    .form-control {
        border-radius: 5px;
        border-color: #F5E6D3;
    }

    .form-control:focus {
        border-color: #6B4E3E;
        box-shadow: 0 0 0 0.2rem rgba(107, 78, 62, 0.25);
    }

    .btn {
        border-radius: 5px;
        transition: all 0.2s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
    }

    .img-thumbnail {
        border-radius: 5px;
        border-color: #F5E6D3;
    }

    .input-group-text {
        border-radius: 5px 0 0 5px;
    }

    .form-select {
        border-radius: 0 5px 5px 0;
    }

    .empty-cart-icon {
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-20px);
        }
        60% {
            transform: translateY(-10px);
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('checkout-form');
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!validateForm()) {
                return;
            }

            const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
            
            if (paymentMethod === 'cod') {
                // For Cash on Delivery, submit the form directly
                form.submit();
            } else {
                // For Online Payment, process through Razorpay
                processOnlinePayment();
            }
        });

        function processOnlinePayment() {
            const formData = new FormData(form);
            
            fetch('{{ route('payment.create') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    name: formData.get('name'),
                    email: formData.get('email'),
                    address: formData.get('address'),
                    phone: formData.get('phone'),
                    delivery_time: formData.get('delivery_time'),
                    payment_method: 'online'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                    return;
                }

                const options = {
                    key: data.key,
                    amount: parseInt(data.amount),
                    currency: data.currency,
                    order_id: data.order_id,
                    name: 'Bakery Delights',
                    description: 'Order Payment',
                    handler: function(response) {
                        // Add payment details to form and submit
                        const paymentInput = document.createElement('input');
                        paymentInput.type = 'hidden';
                        paymentInput.name = 'payment_details';
                        paymentInput.value = JSON.stringify(response);
                        form.appendChild(paymentInput);
                        form.submit();
                    },
                    prefill: {
                        name: formData.get('name'),
                        email: formData.get('email'),
                        contact: formData.get('phone')
                    },
                    theme: {
                        color: '#6B4E3E'
                    }
                };

                const razorpay = new Razorpay(options);
                razorpay.open();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        }

        function validateForm() {
            let isValid = true;
            const requiredFields = ['name', 'email', 'address', 'phone', 'delivery_time'];
            
            requiredFields.forEach(field => {
                const input = document.getElementById(field);
                if (!input.value.trim()) {
                    showError(input, 'This field is required');
                    isValid = false;
                } else {
                    clearError(input);
                }
            });

            // Email validation
            const email = document.getElementById('email');
            if (email.value && !isValidEmail(email.value)) {
                showError(email, 'Please enter a valid email address');
                isValid = false;
            }

            // Phone validation
            const phone = document.getElementById('phone');
            if (phone.value && !isValidPhone(phone.value)) {
                showError(phone, 'Please enter a valid phone number');
                isValid = false;
            }

            return isValid;
        }

        function showError(input, message) {
            const formGroup = input.parentElement;
            const errorDiv = document.createElement('div');
            errorDiv.className = 'invalid-feedback d-block';
            errorDiv.textContent = message;
            formGroup.appendChild(errorDiv);
            input.classList.add('is-invalid');
        }

        function clearError(input) {
            const formGroup = input.parentElement;
            const errorDiv = formGroup.querySelector('.invalid-feedback');
            if (errorDiv) {
                errorDiv.remove();
            }
            input.classList.remove('is-invalid');
        }

        function isValidEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }

        function isValidPhone(phone) {
            return /^[0-9]{10}$/.test(phone);
        }
    });
</script>
@endpush
@endsection 