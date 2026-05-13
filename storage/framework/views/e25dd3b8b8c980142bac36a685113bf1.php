

<?php $__env->startSection('content'); ?>
<style>
/* ═══════════════════════════════════════════════════════
   PREMIUM SHOPPING CART — Sacred Luxury Theme
   Matches Blog Detail aesthetic
   ═══════════════════════════════════════════════════════ */

@import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Lato:wght@300;400;700&display=swap');

:root {
  --gold:          #c9a84c;
  --gold-light:    #e0c068;
  --gold-pale:     #fdf6e3;
  --gold-glow:     rgba(201,168,76,0.18);
  --dark:          #1a0e05;
  --white:         #ffffff;
  --cream:         #faf4ea;
  --cream-mid:     #f2e8d0;
  --border:        #e8d5b0;
  --text-dark:     #2c1a08;
  --text-mid:      #6b4c22;
  --text-muted:    #b08a55;
  --shadow-card:   0 4px 20px rgba(30,15,0,0.07);
  --shadow-hover:  0 16px 40px rgba(201,168,76,0.14), 0 4px 12px rgba(30,15,0,0.08);
  --radius-card:   20px;
  --transition:    0.32s cubic-bezier(0.22, 0.9, 0.36, 1);
}

.cart-section *,
.cart-section *::before,
.cart-section *::after {
  box-sizing: border-box;
}

/* ─── Page wrapper ─── */
.cart-section {
  background: var(--white);
  position: relative;
  padding: 2rem 0 5rem;
  min-height: 80vh;
}

/* Top shimmer line */
.cart-section::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, transparent 0%, var(--gold-light) 40%, var(--gold) 50%, var(--gold-light) 60%, transparent 100%);
}

/* Warm noise texture */
.cart-section::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 0;
}

.cart-section .container {
  position: relative;
  z-index: 1;
}

/* ─── Breadcrumb Styling ─── */
.sacred-breadcrumb {
  background: linear-gradient(135deg, var(--cream) 0%, var(--white) 100%);
  border-bottom: 1px solid var(--border);
  margin-bottom: 0;
  position: relative;
  overflow: hidden;
}

.sacred-breadcrumb .breadcrumbs {
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  letter-spacing: 0.5px;
}

.sacred-breadcrumb .breadcrumbs a {
  color: var(--text-mid);
  transition: color 0.2s ease;
}

.sacred-breadcrumb .breadcrumbs a:hover {
  color: var(--gold);
  text-decoration: none;
}

.sacred-breadcrumb .breadcrumbs i {
  font-size: 11px;
  color: var(--gold);
  margin: 0 6px;
}

/* ─── Page Title ─── */
.cart-title {
  font-family: 'Cinzel', serif;
  font-size: clamp(22px, 4vw, 32px);
  font-weight: 700;
  color: var(--dark);
  margin: 0;
  position: relative;
  display: inline-block;
}

/* Gold divider under title */
.title-divider {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-top: 0.5rem;
}

.title-divider::before {
  content: '';
  display: block;
  width: 48px;
  height: 1px;
  background: linear-gradient(to right, transparent, var(--gold));
}

.title-divider::after {
  content: '';
  display: block;
  flex: 1;
  height: 1px;
  background: linear-gradient(to right, var(--gold), transparent);
}

.gold-diamond {
  width: 7px;
  height: 7px;
  background: var(--gold);
  transform: rotate(45deg);
  display: inline-block;
  flex-shrink: 0;
}

/* ─── Cart Cards ─── */
.cart-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-card);
  box-shadow: var(--shadow-card);
  position: relative;
  overflow: hidden;
  transition: box-shadow var(--transition);
}

.cart-card:hover {
  box-shadow: var(--shadow-hover);
}

.cart-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

.cart-card-header {
  background: linear-gradient(135deg, var(--cream) 0%, var(--gold-pale) 100%);
  font-family: 'Cinzel', serif;
  font-size: 14px;
  font-weight: 600;
  color: var(--gold);
  text-align: center;
  padding: 12px 20px;
  border-bottom: 1px solid var(--border);
  letter-spacing: 1px;
}

/* ─── Cart Table ─── */
.cart-table-wrapper {
  overflow-x: auto;
  padding: 0 20px 20px 20px;
}

.cart-table {
  width: 100%;
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  color: var(--text-mid);
  border-collapse: collapse;
}

.cart-table thead tr {
  background: linear-gradient(135deg, var(--cream) 0%, var(--gold-pale) 100%);
  border-bottom: 2px solid var(--gold);
}

.cart-table th {
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  color: var(--dark);
  padding: 14px 12px;
  text-align: center;
}

.cart-table td {
  padding: 16px 12px;
  border-bottom: 1px solid var(--border);
  vertical-align: middle;
  text-align: center;
}

/* Product image */
.cart-product-img {
  width: 60px;
  height: 60px;
  object-fit: cover;
  border-radius: 12px;
  border: 1px solid var(--border);
  transition: border-color var(--transition);
}

.cart-product-img:hover {
  border-color: var(--gold);
}

.cart-product-name {
  font-family: 'Cinzel', serif;
  font-size: 14px;
  font-weight: 600;
  color: var(--dark);
  margin: 0;
  text-align: left;
}

/* Quantity selector */
.qty-wrapper {
  display: inline-flex;
  align-items: center;
  border: 1px solid var(--border);
  border-radius: 30px;
  background: var(--white);
  overflow: hidden;
}

.qty-btn {
  width: 32px;
  height: 32px;
  border: none;
  background: transparent;
  font-size: 16px;
  font-weight: 600;
  color: var(--gold);
  cursor: pointer;
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}

.qty-btn:hover {
  background: var(--gold-pale);
  color: var(--gold);
}

.qty-input {
  width: 45px;
  text-align: center;
  border: none;
  padding: 6px 0;
  font-size: 13px;
  font-weight: 600;
  color: var(--dark);
  background: transparent;
}

.qty-input:focus {
  outline: none;
}

/* Price & Total */
.cart-price {
  font-weight: 700;
  color: var(--gold);
  font-size: 15px;
}

.cart-total {
  font-weight: 800;
  color: var(--gold);
  font-size: 16px;
}

/* Remove button */
.remove-btn {
  background: transparent;
  border: 1px solid var(--border);
  border-radius: 50%;
  width: 32px;
  height: 32px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  color: var(--text-muted);
  transition: all 0.2s ease;
  cursor: pointer;
}

.remove-btn:hover {
  background: #fceaea;
  border-color: #dc3545;
  color: #dc3545;
}

/* Continue Shopping button */
.continue-shopping {
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  font-weight: 600;
  color: var(--gold);
  background: transparent;
  border: 1px solid var(--gold);
  border-radius: 30px;
  padding: 8px 24px;
  transition: all 0.25s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.continue-shopping:hover {
  background: var(--gold);
  color: var(--white);
  text-decoration: none;
}

/* ─── Order Summary Card ─── */
.summary-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-card);
  box-shadow: var(--shadow-card);
  position: relative;
  overflow: hidden;
}

.summary-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

.summary-card-header {
  background: linear-gradient(135deg, var(--cream) 0%, var(--gold-pale) 100%);
  font-family: 'Cinzel', serif;
  font-size: 14px;
  font-weight: 600;
  color: var(--gold);
  text-align: center;
  padding: 12px 20px;
  border-bottom: 1px solid var(--border);
}

.summary-content {
  padding: 20px;
}

.summary-row {
  display: flex;
  justify-content: space-between;
  padding: 12px 0;
  border-bottom: 1px solid var(--border);
  font-family: 'Lato', sans-serif;
  font-size: 14px;
}

.summary-row:last-of-type {
  border-bottom: none;
}

.summary-label {
  color: var(--text-mid);
}

.summary-value {
  font-weight: 700;
  color: var(--dark);
}

.summary-total {
  padding: 16px 0 8px;
  border-top: 2px solid var(--gold);
  margin-top: 8px;
}

.summary-total .summary-label {
  font-family: 'Cinzel', serif;
  font-size: 16px;
  font-weight: 700;
  color: var(--dark);
}

.summary-total .summary-value {
  font-family: 'Cinzel', serif;
  font-size: 20px;
  font-weight: 800;
  color: var(--gold);
}

.checkout-btn {
  display: block;
  width: 100%;
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border: none;
  border-radius: 40px;
  padding: 14px 20px;
  font-family: 'Cinzel', serif;
  font-size: 14px;
  font-weight: 600;
  color: var(--white);
  text-align: center;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: all 0.25s ease;
  margin-top: 20px;
}

.checkout-btn:hover {
  background: linear-gradient(135deg, var(--gold-light) 0%, var(--gold) 100%);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(201,168,76,0.3);
  text-decoration: none;
  color: var(--white);
}

/* Empty cart styling */
.empty-cart {
  text-align: center;
  padding: 60px 20px;
}

.empty-cart-icon {
  font-size: 70px;
  color: var(--border);
  margin-bottom: 20px;
  display: inline-block;
}

.empty-cart-text {
  font-family: 'Lato', sans-serif;
  font-size: 16px;
  color: var(--text-mid);
  margin-bottom: 24px;
}

.shop-now-btn {
  display: inline-block;
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border: none;
  border-radius: 40px;
  padding: 12px 32px;
  font-family: 'Cinzel', serif;
  font-size: 14px;
  font-weight: 600;
  color: var(--white);
  transition: all 0.25s ease;
}

.shop-now-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(201,168,76,0.3);
  text-decoration: none;
  color: var(--white);
}

/* Responsive */
@media (max-width: 991px) {
  .cart-section {
    padding: 1.5rem 0 3rem;
  }
  
  .cart-table thead {
    display: none;
  }
  
  .cart-table tbody tr {
    display: block;
    margin-bottom: 20px;
    border: 1px solid var(--border);
    border-radius: var(--radius-card);
    padding: 15px;
  }
  
  .cart-table tbody td {
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-align: right;
    padding: 10px 0;
    border-bottom: 1px solid var(--border);
  }
  
  .cart-table tbody td:last-child {
    border-bottom: none;
  }
  
  .cart-table tbody td::before {
    content: attr(data-label);
    font-family: 'Cinzel', serif;
    font-weight: 600;
    color: var(--dark);
    text-align: left;
  }
  
  .cart-product-name {
    text-align: right;
  }
}

@media (max-width: 576px) {
  .cart-product-img {
    width: 50px;
    height: 50px;
  }
  
  .qty-btn {
    width: 28px;
    height: 28px;
  }
  
  .qty-input {
    width: 38px;
  }
}

/* Animation */
@keyframes fadeSlideUp {
  from { opacity: 0; transform: translateY(20px); }
  to   { opacity: 1; transform: translateY(0); }
}

.cart-main-content { animation: fadeSlideUp 0.45s ease 0.05s backwards; }
.cart-sidebar-content { animation: fadeSlideUp 0.45s ease 0.15s backwards; }
</style>

<div class="cart-section">
    
    <!-- Sacred Breadcrumb -->
    <div class="sacred-breadcrumb pt-3 pb-3">
        <div class="container">
            <div class="row afterLoginDisplay">
                <div class="col-md-12 d-flex align-items-center">
                    <span style="text-transform: capitalize;">
                        <span class="breadcrumbs">
                            <a href="<?php echo e(route('front.home')); ?>" style="text-decoration:none">
                                <i class="fa fa-home"></i> Home
                            </a>
                            <i class="fa fa-chevron-right"></i>
                            <a href="<?php echo e(route('front.getproducts')); ?>" style="text-decoration:none">Products</a>
                            <i class="fa fa-chevron-right"></i>
                            <span style="color: var(--gold);">Shopping Cart</span>
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-4">
        
        <!-- Page Title -->
        <div class="col-12 mb-4">
            <h1 class="cart-title">Shopping Cart</h1>
            <div class="title-divider">
                <span class="gold-diamond"></span>
            </div>
        </div>

        <?php if($cartItems->isEmpty()): ?>
            <div class="empty-cart">
                <div class="empty-cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <p class="empty-cart-text">Your cart is currently empty.</p>
                <a href="<?php echo e(route('front.getproducts')); ?>" class="shop-now-btn">
                    Browse Products <i class="fa fa-arrow-right ml-2"></i>
                </a>
            </div>
        <?php else: ?>
        <div class="row g-4">
            
            
            <div class="col-lg-8 col-12 cart-main-content">
                <div class="cart-card">
                    <div class="cart-card-header">
                        <i class="fa fa-shopping-bag mr-2"></i> CART ITEMS
                    </div>
                    
                    <div class="cart-table-wrapper">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="cart-table-body">
                            <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($item->product): ?>
                            <tr id="cart-row-<?php echo e($item->productId); ?>">
                                <td data-label="Product" style="text-align: left;">
                                    <div class="d-flex align-items-center gap-3" style="gap: 12px;">
                                        <img src="<?php echo e(asset($item->product->productImage)); ?>"
                                             class="cart-product-img"
                                             onerror="this.src='/build/assets/images/person.png'"
                                             alt="<?php echo e($item->product->name); ?>">
                                        <strong class="cart-product-name"><?php echo e($item->product->name); ?></strong>
                                    </div>
                                </td>
                                <td data-label="Price" class="cart-price">
                                    <?php echo e($currency->value ?? '₹'); ?><?php echo e(number_format($item->product->amount, 2)); ?>

                                </td>
                                <td data-label="Quantity">
                                    <div class="qty-wrapper">
                                        <button class="qty-btn cart-qty-minus"
                                                data-product-id="<?php echo e($item->productId); ?>">-</button>
                                        <input type="number"
                                               class="qty-input cart-qty-input"
                                               value="<?php echo e($item->quantity); ?>"
                                               min="1" max="99"
                                               data-product-id="<?php echo e($item->productId); ?>"
                                               step="1">
                                        <button class="qty-btn cart-qty-plus"
                                                data-product-id="<?php echo e($item->productId); ?>">+</button>
                                    </div>
                                </td>
                                <td data-label="Total" class="cart-total" id="item-total-<?php echo e($item->productId); ?>">
                                    <?php echo e($currency->value ?? '₹'); ?><?php echo e(number_format($item->product->amount * $item->quantity, 2)); ?>

                                </td>
                                <td data-label="">
                                    <button class="remove-btn cart-remove"
                                            data-product-id="<?php echo e($item->productId); ?>"
                                            title="Remove item">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="pb-3 px-3">
                        <a href="<?php echo e(route('front.getproducts')); ?>" class="continue-shopping">
                            <i class="fa fa-arrow-left"></i> Continue Shopping
                        </a>
                    </div>
                </div>
            </div>

            
            <div class="col-lg-4 col-12 cart-sidebar-content">
                <div class="summary-card">
                    <div class="summary-card-header">
                        <i class="fa fa-receipt mr-2"></i> ORDER SUMMARY
                    </div>
                    <div class="summary-content">
                        <div class="summary-row">
                            <span class="summary-label">Subtotal (<?php echo e($cartItems->count()); ?> item<?php echo e($cartItems->count() > 1 ? 's' : ''); ?>)</span>
                            <span class="summary-value" id="summary-subtotal">
                                <?php echo e($currency->value ?? '₹'); ?><?php echo e(number_format($subtotal, 2)); ?>

                            </span>
                        </div>
                        <?php if($gstPercent > 0): ?>
                        <div class="summary-row">
                            <span class="summary-label">GST (<?php echo e($gstPercent); ?>%)</span>
                            <span class="summary-value" id="summary-gst">
                                <?php echo e($currency->value ?? '₹'); ?><?php echo e(number_format($gstAmount, 2)); ?>

                            </span>
                        </div>
                        <?php endif; ?>
                        <div class="summary-row summary-total">
                            <span class="summary-label">Total</span>
                            <span class="summary-value" id="summary-total">
                                <?php echo e($currency->value ?? '₹'); ?><?php echo e(number_format($total, 2)); ?>

                            </span>
                        </div>
                        <a href="<?php echo e(route('front.checkout', $cartItems->first()->productId)); ?>" class="checkout-btn">
                            Proceed to Checkout <i class="fa fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
        <?php endif; ?>
    </div>
</div>

<script>
// ─────────────────────────────────────────────────────────────
// CART FUNCTIONALITY (PRESERVED FROM ORIGINAL)
// ─────────────────────────────────────────────────────────────

// Qty Minus
document.querySelectorAll('.cart-qty-minus').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var pid   = this.dataset.productId;
        var input = document.querySelector('.cart-qty-input[data-product-id="' + pid + '"]');
        var val   = parseInt(input.value);
        if (val > 1) {
            input.value = val - 1;
            updateCartQty(pid, val - 1);
        }
    });
});

// Qty Plus
document.querySelectorAll('.cart-qty-plus').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var pid   = this.dataset.productId;
        var input = document.querySelector('.cart-qty-input[data-product-id="' + pid + '"]');
        var val   = parseInt(input.value);
        if (val < 99) {
            input.value = val + 1;
            updateCartQty(pid, val + 1);
        }
    });
});

// Qty Input Change
document.querySelectorAll('.cart-qty-input').forEach(function(input) {
    input.addEventListener('change', function() {
        var val = parseInt(this.value);
        if (val < 1)  val = 1;
        if (val > 99) val = 99;
        this.value = val;
        updateCartQty(this.dataset.productId, val);
    });
});

// Update Qty AJAX (PRESERVED)
function updateCartQty(productId, quantity) {
    fetch('<?php echo e(route("cart.update")); ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
        },
        body: JSON.stringify({ productId: productId, quantity: quantity })
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        if (data.success) {
            var curr = '<?php echo e($currency->value ?? "₹"); ?>';
            document.getElementById('item-total-' + productId).textContent = curr + data.item_total;
            document.getElementById('summary-subtotal').textContent = curr + data.cart_subtotal;
            document.getElementById('summary-total').textContent    = curr + data.cart_total;
            if (typeof updateCartBadge === 'function') updateCartBadge(data.cart_count);
        }
    })
    .catch(function(err) { console.error('Cart update error:', err); });
}

// Remove Item AJAX (PRESERVED)
document.querySelectorAll('.cart-remove').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var pid = this.dataset.productId;
        if (!confirm('Remove this item from cart?')) return;

        fetch('<?php echo e(route("cart.remove")); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            body: JSON.stringify({ productId: pid })
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data.success) {
                var row = document.getElementById('cart-row-' + pid);
                if (row) row.remove();

                var curr = '<?php echo e($currency->value ?? "₹"); ?>';
                var subtotalEl = document.getElementById('summary-subtotal');
                var totalEl    = document.getElementById('summary-total');
                if (subtotalEl) subtotalEl.textContent = curr + data.cart_subtotal;
                if (totalEl)    totalEl.textContent    = curr + data.cart_total;

                if (typeof updateCartBadge === 'function') updateCartBadge(data.cart_count);

                // Reload if cart empty
                if (parseInt(data.cart_count) === 0) {
                    setTimeout(function() { location.reload(); }, 300);
                }
            }
        })
        .catch(function(err) { console.error('Cart remove error:', err); });
    });
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/happylifevastu/public_html/resources/views/frontend/pages/cart.blade.php ENDPATH**/ ?>