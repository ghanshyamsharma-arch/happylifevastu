
<?php $__env->startSection('subhead'); ?>
    <title>Order Complete</title>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Success Message -->
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <i class="fa-solid fa-check-circle" style="font-size: 2.5rem; color: #28a745;"></i>
                <h2 class="mt-3 mb-2">Order Confirmed!</h2>
                <p class="mb-0">Thank you for your order. Your payment has been successfully processed.</p>
            </div>

            <!-- Order Details Card -->
            <div class="card mt-4 mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Order Details</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Order ID:</strong> #<?php echo e($order->id); ?></p>
                            <p><strong>Order Date:</strong> <?php echo e(date('d M Y, H:i A', strtotime($order->created_at))); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Order Status:</strong> 
                                <span class="badge badge-success"><?php echo e($order->orderStatus ?? 'Confirmed'); ?></span>
                            </p>
                            <p><strong>Payment Method:</strong> <?php echo e($order->paymentMethod ?? 'Online'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Items Summary -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Products Ordered</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <thead>
                            <tr style="border-bottom: 2px solid #dee2e6;">
                                <th>Product Name</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-right">Price</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item['name']); ?></td>
                                <td class="text-center"><?php echo e($item['quantity']); ?></td>
                                <td class="text-right">₹<?php echo e(number_format($item['price'], 2)); ?></td>
                                <td class="text-right">₹<?php echo e(number_format($item['total'], 2)); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Price Summary -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Price Summary</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-8 text-right">
                            <strong>Subtotal:</strong>
                        </div>
                        <div class="col-md-4 text-right">
                            <strong>₹<?php echo e(number_format($subtotal, 2)); ?></strong>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-8 text-right">
                            <strong>GST (<?php echo e($gstPercent); ?>%):</strong>
                        </div>
                        <div class="col-md-4 text-right">
                            <strong>₹<?php echo e(number_format($gstAmount, 2)); ?></strong>
                        </div>
                    </div>
                    <div class="row" style="border-top: 2px solid #dee2e6; padding-top: 1rem;">
                        <div class="col-md-8 text-right">
                            <h5 class="mb-0" style="color: #28a745;">Amount Paid:</h5>
                        </div>
                        <div class="col-md-4 text-right">
                            <?php
                            $totalAmount=$subtotal+$gstAmount;
                            ?>
                            <h5 class="mb-0" style="color: #28a745;">₹<?php echo e(number_format($totalAmount, 2)); ?></h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Address -->
            <?php if($order->orderAddress): ?>
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Shipping Address</h5>
                </div>
                <div class="card-body">
                    <p><strong><?php echo e($order->orderAddress->name); ?></strong></p>
                    <p><?php echo e($order->orderAddress->flatNo); ?>, <?php echo e($order->orderAddress->locality); ?></p>
                    <p><?php echo e($order->orderAddress->landmark); ?></p>
                    <p>Pincode: <?php echo e($order->orderAddress->pincode); ?></p>
                    <p>Phone: +<?php echo e($order->orderAddress->countryCode); ?> <?php echo e($order->orderAddress->phoneNumber); ?></p>
                </div>
            </div>
            <?php endif; ?>

            <!-- Action Buttons -->
            <div class="row mt-4 mb-4">
                <div class="col-md-6 mb-2">
                    <a href="<?php echo e(route('front.home')); ?>" class="btn btn-primary btn-block">
                        <i class="fa-solid fa-home"></i> Continue Shopping
                    </a>
                </div>
                <div class="col-md-6 mb-2">
                    <button class="btn btn-success btn-block" id="whatsappShare">
                        <i class="fa-brands fa-whatsapp"></i> Share on WhatsApp
                    </button>
                </div>
            </div>

            <!-- Additional Info -->
            <!--<div class="alert alert-info mt-4" role="alert">-->
            <!--    <h5><i class="fa-solid fa-info-circle"></i> Next Steps</h5>-->
            <!--    <ul class="mb-0 mt-2">-->
            <!--        <li>You will receive a confirmation email shortly</li>-->
            <!--        <li>Track your order from "My Orders" section</li>-->
            <!--        <li>Expected delivery in 5-7 business days</li>-->
            <!--        <li>Contact us for any queries regarding your order</li>-->
            <!--    </ul>-->
            <!--</div>-->
        </div>
    </div>
</div>

 <script>
document.getElementById('whatsappShare').addEventListener('click', function() {

    const orderNumber = '<?php echo e($order->id); ?>';

    const productsList = `<?php echo e(implode("\n", array_map(function($item) {
        return $item['quantity'] . ' x ' . $item['name'] . ' - ₹' . number_format($item['total'], 2);
    }, $items))); ?>`;

    const message = `Hello! I have completed the payment for Order #${orderNumber}.

Product(s):
${productsList}

Subtotal: ₹<?php echo e(number_format($subtotal, 2)); ?>

GST (<?php echo e($gstPercent); ?>%): ₹<?php echo e(number_format($gstAmount, 2)); ?>

Amount Paid: ₹<?php echo e(number_format($totalAmount, 2)); ?>


Please verify and confirm my order. Thank you!`;

    // Proper URL Encoding
    const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(message)}`;

    window.open(whatsappUrl, '_blank');
});
</script>
<style>
    .card {
        border: none;
        border-radius: 0.5rem;
    }
    
    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }
    
    .btn {
        border-radius: 0.5rem;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
    }
    
    .badge {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/happylifevastu/public_html/resources/views/pages/order-success.blade.php ENDPATH**/ ?>