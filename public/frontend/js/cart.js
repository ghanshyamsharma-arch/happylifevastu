// === GLOBAL CART JS ===

// Load cart count on page load
document.addEventListener('DOMContentLoaded', function() {
    fetchCartCount();
});

function fetchCartCount() {
    fetch('/cart/count')
        .then(r => r.json())
        .then(data => updateCartBadge(data.count))
        .catch(() => {});
}

function updateCartBadge(count) {
    const badge = document.querySelector('.cart-badge');
    if (!badge) return;
    badge.textContent = count;
    badge.style.display = count > 0 ? 'block' : 'none';
}

// Handle all "Add to Cart" buttons (delegated)
document.addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-add-cart');
    if (!btn) return;

    const productId   = btn.dataset.productId;
    const productName = btn.dataset.productName || 'Item';

    // Get qty from nearby input (product detail page)
    const qtyInput = document.getElementById('product-qty');
    const quantity = qtyInput ? parseInt(qtyInput.value) || 1 : 1;

    btn.disabled = true;
    const originalHTML = btn.innerHTML;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Adding...';

    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ productId, quantity })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            // Animate cart icon
            cartBounceAnimation();
            updateCartBadge(data.cart_count);
            showCartToast(productName);
            btn.innerHTML = '<i class="fas fa-check me-1"></i> Added!';
            btn.classList.replace('btn-primary', 'btn-success');
            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.classList.replace('btn-success', 'btn-primary');
                btn.disabled = false;
            }, 2000);
        } else {
            btn.innerHTML = originalHTML;
            btn.disabled = false;
            if (data.redirect) window.location.href = data.redirect;
            else alert(data.message || 'Failed to add to cart');
        }
    })
    .catch(() => {
        btn.innerHTML = originalHTML;
        btn.disabled = false;
    });
});

// Bounce animation on cart icon
function cartBounceAnimation() {
    const icon = document.querySelector('.nav-cart-icon');
    if (!icon) return;
    icon.classList.add('cart-bounce');
    setTimeout(() => icon.classList.remove('cart-bounce'), 600);
}

// Toast notification
function showCartToast(productName) {
    let toast = document.getElementById('cart-toast');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'cart-toast';
        toast.style.cssText = `
            position:fixed;bottom:20px;right:20px;z-index:9999;
            background:#28a745;color:#fff;padding:12px 20px;
            border-radius:8px;box-shadow:0 4px 15px rgba(0,0,0,0.2);
            display:none;animation:slideIn .3s ease;
        `;
        document.body.appendChild(toast);
    }
    toast.innerHTML = `<i class="fas fa-check-circle me-2"></i>${productName} added to cart!`;
    toast.style.display = 'block';
    setTimeout(() => toast.style.display = 'none', 3000);
}

// Qty controls (product detail page)
const qtyMinus = document.querySelector('.qty-minus');
const qtyPlus  = document.querySelector('.qty-plus');
const qtyInput = document.getElementById('product-qty');

if (qtyMinus && qtyPlus && qtyInput) {
    qtyMinus.addEventListener('click', () => {
        let v = parseInt(qtyInput.value);
        if (v > 1) qtyInput.value = v - 1;
    });
    qtyPlus.addEventListener('click', () => {
        let v = parseInt(qtyInput.value);
        if (v < 99) qtyInput.value = v + 1;
    });
}