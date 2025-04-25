// Update cart count
function updateCartCount() {
    fetch('/cart/count')
        .then(response => response.json())
        .then(data => {
            const cartCount = document.getElementById('cart-count');
            if (cartCount) {
                cartCount.textContent = data.count;
            }
        });
}

// Show success message
function showSuccessMessage(message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-success alert-dismissible fade show position-fixed bottom-0 end-0 m-3';
    alertDiv.style.zIndex = '1000';
    alertDiv.style.maxWidth = '300px';
    alertDiv.style.fontSize = '0.9rem';
    alertDiv.style.padding = '0.5rem 1rem';
    alertDiv.innerHTML = `
        <span>${message}</span>
        <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert" style="padding: 0.5rem;"></button>
    `;
    document.body.appendChild(alertDiv);
    
    // Remove alert after 2 seconds
    setTimeout(() => {
        alertDiv.remove();
    }, 2000);
}

// Initialize cart count on page load
document.addEventListener('DOMContentLoaded', function() {
    updateCartCount();
    
    // Check for success message in session
    const successMessage = document.querySelector('.alert-success');
    if (successMessage) {
        showSuccessMessage(successMessage.textContent.trim());
        successMessage.remove(); // Remove the original alert
    }

    // Handle form submissions
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            // Update cart count after form submission
            setTimeout(updateCartCount, 500);
        });
    });

    // Handle quantity input changes
    const quantityInputs = document.querySelectorAll('input[name="quantity"]');
    quantityInputs.forEach(input => {
        input.addEventListener('change', function() {
            if (this.value < 1) {
                this.value = 1;
            }
            this.closest('form').submit();
        });
    });

    // Auto-hide alerts after 3 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 3000);
    });
}); 