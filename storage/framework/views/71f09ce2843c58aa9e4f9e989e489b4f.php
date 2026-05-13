

<?php $__env->startSection('subhead'); ?>
    <title>Order Detail #<?php echo e($order->id); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subcontent'); ?>
<?php
    $currSym = $currency->value ?? '₹';
?>

<div class="loader"></div>


<div class="flex items-center mt-8">
    <h2 class="intro-y text-lg font-medium mr-auto">
        Order Detail &nbsp;
        <span class="text-slate-500 font-normal text-base">#<?php echo e($order->id); ?></span>
    </h2>
    <a href="<?php echo e(route('orders')); ?>" class="btn btn-secondary shadow-md">
        <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i> Back to Orders
    </a>
</div>

<div class="intro-y grid grid-cols-12 gap-5 mt-5">

    
    <div class="col-span-12 lg:col-span-8">

        
        <div class="intro-y box p-5 mb-5">
            <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 pb-3 mb-3">
                <i data-lucide="shopping-bag" class="w-5 h-5 mr-2 text-primary"></i>
                <h3 class="font-medium text-base">Products Ordered</h3>
                <span class="ml-auto text-slate-500 text-sm">
                    <?php echo e(count($orderItems)); ?> item(s)
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="table table-bordered" style="min-width:460px;">
                    <thead>
                        <tr class="bg-slate-100 dark:bg-darkmode-800">
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">Product</th>
                            <th class="text-center whitespace-nowrap">Image</th>
                            <th class="text-center whitespace-nowrap">Qty</th>
                            <th class="text-center whitespace-nowrap">Unit Price</th>
                            <th class="text-center whitespace-nowrap">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($idx + 1); ?></td>
                            <td>
                                <div class="flex items-center">
                                    <span class="font-medium"><?php echo e($item->productName ?? '-'); ?></span>
                                </div>
                            </td>
                            <td class="text-center">
                                <?php if($item->productImage): ?>
                                    <div class="w-10 h-10 image-fit zoom-in flex-shrink-0 mx-auto">
                                        <img class="rounded-lg cursor-pointer"
                                             src="<?php echo e(Str::startsWith($item->productImage ?? '', ['http://','https://']) ? $item->productImage : '/' . ($item->productImage ?? '')); ?>"
                                             onerror="this.onerror=null;this.src='/build/assets/images/person.png';"
                                             alt="<?php echo e($item->productName); ?>"
                                             onclick="viewImage('<?php echo e(Str::startsWith($item->productImage ?? '', ['http://','https://']) ? $item->productImage : '/' . ($item->productImage ?? '')); ?>')">
                                    </div>
                                <?php else: ?>
                                    <span class="text-slate-400">No image</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center"><?php echo e($item->quantity ?? 1); ?></td>
                            <td class="text-center"><?php echo e($currSym); ?><?php echo e(number_format($item->unitPrice ?? 0, 2)); ?></td>
                            <td class="text-center font-medium"><?php echo e($currSym); ?><?php echo e(number_format($item->totalPrice ?? 0, 2)); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-right font-medium">Subtotal:</td>
                            <td class="text-center font-medium"><?php echo e($currSym); ?><?php echo e(number_format($order->payableAmount ?? 0, 2)); ?></td>
                        </tr>
                        <?php if($order->gstPercent > 0): ?>
                        <tr>
                            <td colspan="5" class="text-right text-slate-500">GST (<?php echo e($order->gstPercent); ?>%):</td>
                            <td class="text-center text-slate-500"><?php echo e($currSym); ?><?php echo e(number_format(($order->payableAmount * $order->gstPercent / 100), 2)); ?></td>
                        </tr>
                        <?php endif; ?>
                        <tr class="bg-slate-50 dark:bg-darkmode-700">
                            <td colspan="5" class="text-right font-bold">Total Payable:</td>
                            <td class="text-center font-bold text-primary"><?php echo e($currSym); ?><?php echo e(number_format($order->totalPayable ?? $order->payableAmount ?? 0, 2)); ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        
        <div class="intro-y box p-5">
            <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 pb-3 mb-4">
                <i data-lucide="map-pin" class="w-5 h-5 mr-2 text-primary"></i>
                <h3 class="font-medium text-base">Shipping Address</h3>
            </div>
            <?php if($order->addrName || $order->flatNo): ?>
            <div class="grid grid-cols-2 gap-3 text-sm">
                <div>
                    <span class="text-slate-500">Recipient Name</span>
                    <div class="font-medium mt-1"><?php echo e($order->addrName ?? '-'); ?></div>
                </div>
                <div>
                    <span class="text-slate-500">Phone</span>
                    <div class="font-medium mt-1"><?php echo e($order->phoneNumber ?? '-'); ?></div>
                </div>
                <div class="col-span-2">
                    <span class="text-slate-500">Address</span>
                    <div class="font-medium mt-1">
                        <?php echo e(implode(', ', array_filter([
                            $order->flatNo,
                            $order->locality,
                            $order->landmark,
                            $order->city,
                            $order->state,
                            $order->country,
                            $order->pincode
                        ]))); ?>

                    </div>
                </div>
            </div>
            <?php else: ?>
            <p class="text-slate-500 text-sm">No address on record.</p>
            <?php endif; ?>
        </div>

    </div>

    
    <div class="col-span-12 lg:col-span-4">

        
        <div class="intro-y box p-5 mb-5">
            <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 pb-3 mb-4">
                <i data-lucide="file-text" class="w-5 h-5 mr-2 text-primary"></i>
                <h3 class="font-medium text-base">Order Info</h3>
            </div>
            <div class="text-sm space-y-2">
                <div class="flex justify-between">
                    <span class="text-slate-500">Order ID</span>
                    <span class="font-medium">#<?php echo e($order->id); ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Date</span>
                    <span class="font-medium"><?php echo e(date('d M Y, h:i A', strtotime($order->created_at))); ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Payment Method</span>
                    <span class="font-medium capitalize"><?php echo e($order->paymentMethod ?? '-'); ?></span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-slate-500">Order Status</span>
                    <span class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'font-medium px-2 py-1 rounded text-xs',
                        'text-success bg-success/10' => $order->orderStatus == 'Confirmed' || $order->orderStatus == 'Delivered',
                        'text-danger bg-danger/10'   => $order->orderStatus == 'Pending' || $order->orderStatus == 'Cancelled',
                        'text-warning bg-warning/10' => $order->orderStatus == 'Packed' || $order->orderStatus == 'Dispatched',
                    ]) ?>"><?php echo e($order->orderStatus); ?></span>
                </div>
            </div>

            
            <?php if($order->orderStatus && $order->orderStatus != 'Cancelled' && $order->orderStatus != 'Delivered'): ?>
            <div class="mt-4 pt-3 border-t border-slate-200 dark:border-darkmode-400">
                <label class="form-label text-xs text-slate-500 mb-1">Change Status</label>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary btn-sm w-full dropdown-toggle"
                            aria-expanded="false" data-tw-toggle="dropdown">
                        <span id="currentStatusLabel"><?php echo e($order->orderStatus); ?></span>
                        <i data-lucide="chevron-down" class="w-4 h-4 ml-auto"></i>
                    </button>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <?php $__currentLoopData = ['Confirmed','Packed','Dispatched','Delivered','Cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="javascript:;"
                                   class="dropdown-item <?php echo e($s=='Cancelled' ? 'text-danger' : ($s=='Confirmed'||$s=='Delivered' ? 'text-success' : '')); ?>"
                                   onclick="changeStatus(<?php echo e($order->id); ?>,'<?php echo e($s); ?>',<?php echo e($order->userId); ?>)"
                                   data-tw-target="#status-change" data-tw-toggle="modal">
                                    <?php echo e($s); ?>

                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            
            <div class="mt-3">
                <a target="_blank"
                   href="<?php echo e(route('order.invoice', ['id' => $order->id])); ?>"
                   class="btn btn-primary w-full">
                    <i data-lucide="download" class="w-4 h-4 mr-2"></i>
                    Download Invoice
                </a>
            </div>
        </div>

        
        <div class="intro-y box p-5">
            <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 pb-3 mb-4">
                <i data-lucide="user" class="w-5 h-5 mr-2 text-primary"></i>
                <h3 class="font-medium text-base">Customer</h3>
            </div>
            <div>
                <div class="font-medium"><?php echo e($order->userName); ?></div>
                <div class="text-slate-500 text-xs"><?php echo e($order->email ?? '-'); ?></div>
            </div>
            <div class="text-sm space-y-2 mt-3">
                <div class="flex items-center gap-2">
                    <i data-lucide="phone" class="w-4 h-4 text-slate-400"></i>
                    <span><?php echo e($order->contactNo ?? '-'); ?></span>
                </div>
            </div>
        </div>

    </div>
</div>


<div id="status-change" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-5 text-center">
                    <i data-lucide="check-circle" class="w-16 h-16 text-success mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">Are You Sure?</div>
                    <div class="text-slate-500 mt-2" id="active">You want change Status!</div>
                </div>
                <form action="<?php echo e(route('changeOrder')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="userId" name="userId">
                    <input type="hidden" id="status" name="status">
                    <div class="px-5 pb-8 text-center">
                        <button class="btn btn-primary mr-3" id="btnActive">Yes, Change it!</button>
                        <a type="button" data-tw-dismiss="modal" class="btn btn-secondary w-24">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div id="imageModal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body p-0 text-center bg-dark">
                <button type="button" data-tw-dismiss="modal" class="btn-close btn-close-white position-absolute top-0 end-0"></button>
                <img id="modalImage" src="" class="w-full" style="max-height: 600px; object-fit: contain;">
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    function changeStatus(orderId, status, userId) {
        $("#id").val(orderId);
        $("#status").val(status);
        $("#userId").val(userId);
        document.getElementById('active').innerHTML = "You want to change status to <strong>" + status + "</strong>";
    }

    function viewImage(src) {
        document.getElementById('modalImage').src = src;
        const modal = document.getElementById('imageModal');
        // Using Tabler's modal if available
        if (typeof Modal !== 'undefined') {
            new Modal(modal).show();
        } else {
            modal.style.display = 'block';
        }
    }

    $(window).on('load', function () {
        $('.loader').hide();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('../layout/' . $layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/happylifevastu/public_html/resources/views/pages/admin-order-detail.blade.php ENDPATH**/ ?>