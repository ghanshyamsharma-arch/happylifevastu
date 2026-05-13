
<?php $__env->startSection('content'); ?>
<style>
/* ═══════════════════════════════════════════════════════
   PREMIUM MY ORDERS PAGE — Sacred Luxury Theme
   Matches overall website aesthetic
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
  --success:       #28a745;
  --warning:       #ffc107;
  --danger:        #dc3545;
  --info:          #17a2b8;
}

.orders-section {
  background: linear-gradient(135deg, var(--white) 0%, var(--cream) 100%);
  position: relative;
  min-height: 100vh;
  padding: 1rem 0 4rem;
}

/* Top shimmer line */
.orders-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: linear-gradient(90deg, transparent 0%, var(--gold-light) 40%, var(--gold) 50%, var(--gold-light) 60%, transparent 100%);
  z-index: 2;
}

/* Warm noise texture */
.orders-section::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 0;
}

.orders-section .container {
  position: relative;
  z-index: 1;
}

/* ─── Breadcrumb Styling ─── */
.sacred-breadcrumb {
  background: linear-gradient(135deg, var(--cream) 0%, var(--white) 100%);
  border-bottom: 1px solid var(--border);
  margin-bottom: 0;
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

/* ─── Page Header ─── */
.page-header {
  margin-bottom: 1.5rem;
}

.page-title {
  font-family: 'Cinzel', serif;
  font-size: clamp(28px, 5vw, 42px);
  font-weight: 700;
  color: var(--dark);
  margin: 0 0 0.5rem 0;
  display: inline-flex;
  align-items: center;
  gap: 12px;
}

.page-title i {
  color: var(--gold);
  font-size: 32px;
}

/* Gold divider */
.title-divider {
  display: flex;
  align-items: center;
  gap: 10px;
  margin: 10px 0 15px 0;
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

.page-subtitle {
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  color: var(--text-mid);
}

/* ─── Section Header ─── */
.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  margin-bottom: 20px;
  padding-bottom: 10px;
  border-bottom: 2px solid var(--gold);
}

.section-title {
  font-family: 'Cinzel', serif;
  font-size: 20px;
  font-weight: 700;
  color: var(--dark);
  margin: 0;
}

.section-title i {
  color: var(--gold);
  margin-right: 8px;
}

/* ─── Orders Card ─── */
.orders-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-card);
  overflow: hidden;
  box-shadow: var(--shadow-card);
}

.table-responsive {
  overflow-x: auto;
}

/* ─── Sacred Table ─── */
.sacred-table {
  width: 100%;
  border-collapse: collapse;
  font-family: 'Lato', sans-serif;
}

.sacred-table thead {
  background: linear-gradient(135deg, var(--cream) 0%, var(--gold-pale) 100%);
}

.sacred-table th {
  font-family: 'Cinzel', serif;
  font-size: 12px;
  font-weight: 700;
  color: var(--dark);
  padding: 14px 10px;
  text-align: center;
  border-bottom: 2px solid var(--gold);
}

.sacred-table td {
  padding: 15px 10px;
  text-align: center;
  border-bottom: 1px solid var(--border);
  color: var(--text-mid);
  font-size: 13px;
  vertical-align: middle;
}

.sacred-table tbody tr {
  transition: all var(--transition);
}

.sacred-table tbody tr:hover {
  background: var(--gold-pale);
}

/* Order Header Row */
.order-header-row {
  background: linear-gradient(135deg, var(--cream) 0%, var(--gold-pale) 100%);
  font-weight: 600;
}

.order-item-row {
  border-bottom: 1px solid var(--border);
}

.order-total-row {
  background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
}

.order-total-row td {
  font-weight: 700;
  color: var(--dark);
}

/* Product Image */
.product-img {
  height: 55px;
  width: auto;
  max-width: 80px;
  object-fit: cover;
  border-radius: 10px;
  border: 1px solid var(--border);
  cursor: pointer;
  transition: transform 0.2s ease;
}

.product-img:hover {
  transform: scale(1.05);
  border-color: var(--gold);
}

/* Product Name */
.product-name {
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  color: var(--dark);
}

/* Quantity Badge */
.qty-badge {
  display: inline-block;
  padding: 4px 10px;
  border-radius: 20px;
  background: linear-gradient(135deg, var(--gold-pale) 0%, var(--cream) 100%);
  color: var(--gold);
  font-weight: 600;
  font-size: 12px;
}

/* Amount Styling */
.amount-value {
  font-family: 'Cinzel', serif;
  font-weight: 700;
  color: var(--gold);
}

.amount-strong {
  font-family: 'Cinzel', serif;
  font-weight: 800;
  color: var(--gold);
  font-size: 14px;
}

/* Status Badges */
.status-badge {
  display: inline-block;
  padding: 5px 12px;
  border-radius: 30px;
  font-family: 'Cinzel', serif;
  font-size: 11px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.status-pending {
  background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
  color: #856404;
}

.status-completed {
  background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
  color: #155724;
}

.status-cancelled {
  background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
  color: #721c24;
}

.status-delivered {
  background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
  color: #155724;
}

.status-dispatched {
  background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
  color: #0c5460;
}

/* Action Buttons */
.btn-pdf {
  background: transparent;
  border: 1px solid var(--gold);
  border-radius: 30px;
  padding: 6px 16px;
  font-family: 'Cinzel', serif;
  font-size: 12px;
  font-weight: 600;
  color: var(--gold);
  transition: all 0.25s ease;
  text-decoration: none;
  display: inline-block;
}

.btn-pdf:hover {
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  color: var(--white);
  transform: translateY(-2px);
  text-decoration: none;
}

.btn-pdf i {
  margin-right: 4px;
}

.btn-cancel {
  background: linear-gradient(135deg, var(--danger) 0%, #c0392b 100%) !important;
  border: none;
  box-shadow: 0 2px 8px rgba(220,53,69,0.3) !important;
  font-size: 12px !important;
  font-weight: 600 !important;
  border-radius: 40px !important;
  padding: 6px 18px !important;
  color: white !important;
  transition: all 0.25s ease;
  cursor: pointer;
}

.btn-cancel:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(220,53,69,0.4) !important;
}

/* Empty State */
.empty-state {
  text-align: center;
  padding: 60px 20px;
}

.empty-state-icon {
  font-size: 64px;
  color: var(--border);
  margin-bottom: 20px;
}

.empty-state-icon i {
  background: linear-gradient(135deg, var(--border), var(--text-muted));
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}

.empty-state-title {
  font-family: 'Cinzel', serif;
  font-size: 22px;
  font-weight: 600;
  color: var(--text-mid);
  margin-bottom: 10px;
}

.empty-state-text {
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  color: var(--text-muted);
}

/* Responsive */
@media (max-width: 991px) {
  .sacred-table th,
  .sacred-table td {
    padding: 10px 8px;
    font-size: 12px;
  }
  
  .product-img {
    height: 45px;
  }
  
  .btn-pdf,
  .btn-cancel {
    padding: 5px 12px;
    font-size: 10px;
  }
}

@media (max-width: 768px) {
  .sacred-table,
  .sacred-table tbody,
  .sacred-table tr,
  .sacred-table td {
    display: block;
  }
  
  .sacred-table thead {
    display: none;
  }
  
  .sacred-table tr {
    margin-bottom: 20px;
    border: 1px solid var(--border);
    border-radius: var(--radius-card);
    background: var(--white);
  }
  
  .sacred-table td {
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-align: right;
    padding: 12px 15px;
    border-bottom: 1px solid var(--border);
  }
  
  .sacred-table td:last-child {
    border-bottom: none;
  }
  
  .sacred-table td::before {
    content: attr(data-label);
    font-family: 'Cinzel', serif;
    font-weight: 600;
    color: var(--dark);
    font-size: 12px;
  }
  
  .order-total-row td::before {
    display: none;
  }
  
  .order-total-row td {
    justify-content: center;
    text-align: center;
  }
}

@media (max-width: 576px) {
  .orders-section {
    padding: 0.5rem 0 2rem;
  }
  
  .page-title {
    font-size: 24px;
  }
  
  .page-title i {
    font-size: 24px;
  }
  
  .section-title {
    font-size: 18px;
  }
}

/* Animation */
@keyframes fadeSlideUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.orders-card {
  animation: fadeSlideUp 0.45s ease 0.05s backwards;
}

.page-header {
  animation: fadeSlideUp 0.45s ease 0s backwards;
}
</style>

<div class="orders-section">
    <!-- Sacred Breadcrumb -->
    <div class="sacred-breadcrumb pt-3 pb-3 d-none d-md-block">
        <div class="container">
            <div class="row afterLoginDisplay">
                <div class="col-md-12 d-flex align-items-center">
                    <span class="breadcrumbs">
                        <a href="<?php echo e(route('front.home')); ?>">
                            <i class="fa fa-home"></i> Home
                        </a>
                        <i class="fa fa-chevron-right"></i>
                        <span style="color: var(--gold);">Sacred Orders</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="inpage">
                    
                    <!-- Page Header -->
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="fa fa-shopping-bag"></i>
                            Sacred Orders
                        </h1>
                        <div class="title-divider">
                            <span class="gold-diamond"></span>
                        </div>
                        <p class="page-subtitle">
                            <i class="fa fa-history mr-2" style="color: var(--gold);"></i>
                            View your complete order history
                        </p>
                    </div>

                    <!-- Orders Section -->
                    <div class="orders-card">
                        <div class="section-header p-3">
                            <h3 class="section-title">
                                <i class="fa fa-list-ul"></i>
                                Orders History
                            </h3>
                        </div>

                        <div class="table-responsive">
                            <table class="sacred-table">
                                <thead>
                                    <tr>
                                        <th>Invoice</th>
                                        <th>Order ID</th>
                                        <th>Product Name</th>
                                        <th>Image</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Total</th>
                                        <th>Order Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <?php
                                            $order = (array)$order;
                                            $orderItems = isset($order['items']) ? $order['items'] : [];
                                        ?>
                                        
                                        <?php if(!empty($orderItems) && count($orderItems) > 0): ?>
                                            
                                            <?php $__currentLoopData = $orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $item = (array)$item;
                                                ?>
                                                <tr class="order-item-row">
                                                    
                                                    <td data-label="Invoice">
                                                        <?php if($index === 0): ?>
                                                            <a class="btn-pdf" 
                                                               href="<?php echo e(isset($order['invoice_link']) ? $order['invoice_link'] : '#'); ?>">
                                                                <i class="fa fa-file-pdf-o"></i> PDF
                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                    
                                                    
                                                    <td data-label="Order ID">
                                                        <?php if($index === 0): ?>
                                                            <strong class="amount-value">#<?php echo e($order['id'] ?? 'N/A'); ?></strong>
                                                        <?php endif; ?>
                                                    </td>
                                                    
                                                    
                                                    <td data-label="Product Name">
                                                        <span class="product-name">
                                                            <?php echo e($item['productName'] ?? $item['name'] ?? 'N/A'); ?>

                                                        </span>
                                                    </td>
                                                    
                                                    
                                                    <td data-label="Image">
                                                        <?php
                                                            $imageUrl = $item['productImage'] ?? $item['image'] ?? '';
                                                            $imageUrl = Str::startsWith($imageUrl, ['http://', 'https://']) ? $imageUrl : '/' . $imageUrl;
                                                        ?>
                                                        <img class="product-img" 
                                                             src="<?php echo e($imageUrl); ?>" 
                                                             onerror="this.onerror=null;this.src='/build/assets/images/person.png';" 
                                                             alt="Product image" 
                                                             onclick="openImage('<?php echo e($imageUrl); ?>')" />
                                                    </td>
                                                    
                                                    
                                                    <td data-label="Quantity">
                                                        <span class="qty-badge">
                                                            <i class="fa fa-times mr-1"></i><?php echo e($item['quantity'] ?? 1); ?>

                                                        </span>
                                                    </td>
                                                    
                                                    
                                                    <td data-label="Unit Price">
                                                        <span class="amount-value">
                                                            <?php if($walletType == 'coin'): ?>
                                                                <img src="<?php echo e(asset($coinIcon)); ?>" alt="Coin" width="12" style="display:inline; margin-right:2px;">
                                                            <?php else: ?>
                                                                <span><?php echo e($currency['value'] ?? ''); ?></span>
                                                            <?php endif; ?>
                                                            <?php echo e(number_format($item['unitPrice'] ?? 0, 2)); ?>

                                                        </span>
                                                    </td>
                                                    
                                                    
                                                    <td data-label="Total">
                                                        <strong class="amount-strong">
                                                            <?php if($walletType == 'coin'): ?>
                                                                <img src="<?php echo e(asset($coinIcon)); ?>" alt="Coin" width="12" style="display:inline; margin-right:2px;">
                                                            <?php else: ?>
                                                                <span><?php echo e($currency['value'] ?? ''); ?></span>
                                                            <?php endif; ?>
                                                            <?php echo e(number_format($item['totalPrice'] ?? 0, 2)); ?>

                                                        </strong>
                                                    </td>
                                                    
                                                    
                                                    <td data-label="Order Date">
                                                        <?php if($index === 0): ?>
                                                            <?php echo e(\Carbon\Carbon::parse($order['created_at'])->format('d-m-Y')); ?>

                                                        <?php endif; ?>
                                                    </td>
                                                    
                                                    
                                                    <td data-label="Status">
                                                        <?php if($index === 0): ?>
                                                            <?php if($order['orderStatus'] == 'Pending'): ?>
                                                                <span class="status-badge status-pending">
                                                                    <i class="fa fa-hourglass-half mr-1"></i> Pending
                                                                </span>
                                                            <?php elseif($order['orderStatus'] == 'Cancelled'): ?>
                                                                <span class="status-badge status-cancelled">
                                                                    <i class="fa fa-times-circle mr-1"></i> Cancelled
                                                                </span>
                                                            <?php elseif($order['orderStatus'] == 'Delivered'): ?>
                                                                <span class="status-badge status-delivered">
                                                                    <i class="fa fa-check-circle mr-1"></i> Delivered
                                                                </span>
                                                            <?php elseif($order['orderStatus'] == 'Dispatched'): ?>
                                                                <span class="status-badge status-dispatched">
                                                                    <i class="fa fa-truck mr-1"></i> Dispatched
                                                                </span>
                                                            <?php else: ?>
                                                                <span class="status-badge status-completed">
                                                                    <i class="fa fa-check-circle mr-1"></i> <?php echo e($order['orderStatus']); ?>

                                                                </span>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    
                                                    
                                                    <td data-label="Action">
                                                        <?php if($index === 0): ?>
                                                            <?php if($order['orderStatus'] != 'Cancelled' && $order['orderStatus'] != 'Delivered' && $order['orderStatus'] != 'Dispatched'): ?>
                                                                <form class="cancel-form" style="display:inline;">
                                                                    <input type="hidden" value="<?php echo e($order['id']); ?>" name="id">
                                                                    <a class="btn-cancel cancel-btn">
                                                                        <i class="fa fa-ban mr-1"></i> Cancel
                                                                    </a>
                                                                </form>
                                                            <?php else: ?>
                                                                <span class="text-muted">—</span>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                            
                                            <tr class="order-total-row">
                                                <td colspan="6" class="text-right"><strong>Order Total (Including GST):</strong></td>
                                                <td class="text-center">
                                                    <strong class="amount-strong">
                                                        <?php if($walletType == 'coin'): ?>
                                                            <img src="<?php echo e(asset($coinIcon)); ?>" alt="Coin" width="12" style="display:inline; margin-right:2px;">
                                                        <?php else: ?>
                                                            <span><?php echo e($currency['value'] ?? ''); ?></span>
                                                        <?php endif; ?>
                                                        <?php echo e(number_format($order['totalPayable'] ?? 0, 2)); ?>

                                                    </strong>
                                                </td>
                                                <td colspan="3"></td>
                                            </tr>
                                        <?php else: ?>
                                            
                                            <tr class="order-item-row">
                                                <td data-label="Invoice">
                                                    <a class="btn-pdf" href="<?php echo e($order['invoice_link'] ?? '#'); ?>">
                                                        <i class="fa fa-file-pdf-o"></i> PDF
                                                    </a>
                                                </td>
                                                <td data-label="Order ID"><strong class="amount-value">#<?php echo e($order['id'] ?? 'N/A'); ?></strong></td>
                                                <td data-label="Product Name"><span class="product-name"><?php echo e($order['productName'] ?? 'N/A'); ?></span></td>
                                                <td data-label="Image">
                                                    <?php
                                                        $imageUrl = $order['productImage'] ?? '';
                                                        $imageUrl = Str::startsWith($imageUrl, ['http://', 'https://']) ? $imageUrl : '/' . $imageUrl;
                                                    ?>
                                                    <img class="product-img" 
                                                         src="<?php echo e($imageUrl); ?>" 
                                                         onerror="this.onerror=null;this.src='/build/assets/images/person.png';" 
                                                         alt="Product image" 
                                                         onclick="openImage('<?php echo e($imageUrl); ?>')" />
                                                </td>
                                                <td data-label="Quantity"><span class="qty-badge">×1</span></td>
                                                <td data-label="Unit Price">
                                                    <span class="amount-value">
                                                        <?php if($walletType == 'coin'): ?>
                                                            <img src="<?php echo e(asset($coinIcon)); ?>" alt="Coin" width="12" style="display:inline; margin-right:2px;">
                                                        <?php else: ?>
                                                            <span><?php echo e($currency['value'] ?? ''); ?></span>
                                                        <?php endif; ?>
                                                        <?php echo e(number_format($order['payableAmount'] ?? 0, 2)); ?>

                                                    </span>
                                                </td>
                                                <td data-label="Total">
                                                    <strong class="amount-strong">
                                                        <?php if($walletType == 'coin'): ?>
                                                            <img src="<?php echo e(asset($coinIcon)); ?>" alt="Coin" width="12" style="display:inline; margin-right:2px;">
                                                        <?php else: ?>
                                                            <span><?php echo e($currency['value'] ?? ''); ?></span>
                                                        <?php endif; ?>
                                                        <?php echo e(number_format($order['totalPayable'] ?? 0, 2)); ?>

                                                    </strong>
                                                </td>
                                                <td data-label="Order Date"><?php echo e(\Carbon\Carbon::parse($order['created_at'])->format('d-m-Y')); ?></td>
                                                <td data-label="Status">
                                                    <?php if($order['orderStatus'] == 'Pending'): ?>
                                                        <span class="status-badge status-pending"><i class="fa fa-hourglass-half mr-1"></i> Pending</span>
                                                    <?php elseif($order['orderStatus'] == 'Cancelled'): ?>
                                                        <span class="status-badge status-cancelled"><i class="fa fa-times-circle mr-1"></i> Cancelled</span>
                                                    <?php elseif($order['orderStatus'] == 'Delivered'): ?>
                                                        <span class="status-badge status-delivered"><i class="fa fa-check-circle mr-1"></i> Delivered</span>
                                                    <?php elseif($order['orderStatus'] == 'Dispatched'): ?>
                                                        <span class="status-badge status-dispatched"><i class="fa fa-truck mr-1"></i> Dispatched</span>
                                                    <?php else: ?>
                                                        <span class="status-badge status-completed"><i class="fa fa-check-circle mr-1"></i> <?php echo e($order['orderStatus']); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td data-label="Action">
                                                    <?php if($order['orderStatus'] != 'Cancelled' && $order['orderStatus'] != 'Delivered' && $order['orderStatus'] != 'Dispatched'): ?>
                                                        <form class="cancel-form" style="display:inline;">
                                                            <input type="hidden" value="<?php echo e($order['id']); ?>" name="id">
                                                            <a class="btn-cancel cancel-btn"><i class="fa fa-ban mr-1"></i> Cancel</a>
                                                        </form>
                                                    <?php else: ?>
                                                        <span class="text-muted">—</span>
                                                    <?php endif; ?>
                                                </td>
                                            </td>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="10" class="text-center py-5">
                                                <div class="empty-state">
                                                    <div class="empty-state-icon">
                                                        <i class="fa fa-shopping-bag"></i>
                                                    </div>
                                                    <h3 class="empty-state-title">No Orders Found</h3>
                                                    <p class="empty-state-text">You haven't placed any sacred orders yet.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <input type="hidden" value="0" id="flag">
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
$(document).ready(function() {
    $('.cancel-btn').click(function(e) {
        e.preventDefault();

        <?php
            use Symfony\Component\HttpFoundation\Session\Session;
            $session = new Session();
            $token = $session->get('token');
        ?>

        Swal.fire({
            title: 'Cancel Sacred Order?',
            text: "Are you sure you want to cancel this order?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#c9a84c',
            cancelButtonColor: '#6b4c22',
            confirmButtonText: 'Yes, Cancel Order',
            cancelButtonText: 'No, Keep It'
        }).then((result) => {
            if (result.isConfirmed) {
                var $btn = $(this);
                var formData = $btn.closest('.cancel-form').serialize();

                $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin mr-1"></i> Cancelling...');

                $.ajax({
                    url: '<?php echo e(route("api.cancelOrder",['token' => $token])); ?>',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        toastr.success('Order Cancelled Successfully');
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        try {
                            var errorMessage = JSON.parse(xhr.responseText).error.paymentMethod[0];
                            toastr.error(errorMessage);
                        } catch(e) {
                            toastr.error('Unable to cancel order. Please try again.');
                        }
                        $btn.prop('disabled', false).html('<i class="fa fa-ban mr-1"></i> Cancel');
                    }
                });
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/happylifevastu/public_html/resources/views/frontend/pages/my-orders.blade.php ENDPATH**/ ?>