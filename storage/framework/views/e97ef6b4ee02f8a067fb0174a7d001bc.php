
<style>
    .puja-brodcast-btn {
    background: gold;
    box-shadow: 0 2px 3px #ffd70080;
    font-size: 15px;
    font-weight: 600;
    border-radius: 40px;
    padding: 2px 20px;
    margin: 0 5px;
    white-space: nowrap;
    position: relative;
    color: black;
}
.blinking-text {
    font-size: 12px;
    top: -7px;
    right: -5px;
    position: absolute;
    animation: blink 1s step-start infinite;
    color: #ff0000;
}

@keyframes blink {
    50% {
        opacity: 0;
    }
}

@media (min-width: 1199px) {
    .container {
        max-width: 1300px !important;
    }
}

.inpage table td {
    white-space: unset !important;
}
</style>
<?php $__env->startSection('content'); ?>
<div class="pt-1 pb-1 bg-red d-none d-md-block astroway-breadcrumb">
    <div class="container">
        <div class="row afterLoginDisplay">
            <div class="col-md-12 d-flex align-items-center">
                <span style="text-transform: capitalize; ">
                    <span class="text-white breadcrumbs">
                        <a href="<?php echo e(route('front.astrologerindex')); ?>" style="color:white;text-decoration:none">
                            <i class="fa fa-home font-18"></i>
                        </a>
                        <i class="fa fa-chevron-right"></i> <a href="<?php echo e(route('front.getAstrologerChat')); ?>"
                            style="color:white;text-decoration:none">My Puja List</a>
                    </span>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="inpage">
                <div class="text-left pb-md-4 pb-2">
                    <h1 class="h2 font-weight-bold colorblack">My Puja</h1>
                    <p>Check your puja list here..</p>
                </div>
                <div class="table-responsive" id="walletTransactionTable">
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center" style="padding-left:0px !important;">Assign <?php echo e($professionTitle); ?></th>
                                    <th class="text-center" style="width:22% !important;">Puja Name</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Package Details</th>
                                     <th class="text-center">Puja Broadcast Link</th>
                                     <th class="text-center">Puja Date</th>
                                     <th class="text-center">Puja Duration</th>
                                     <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($astrologerPujaList->isEmpty()): ?>
                                    <tr>
                                        <td class="text-center" colspan="6">
                                            <p>No Puja Found !</p>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                <?php $__currentLoopData = $astrologerPujaList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pujadata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($pujadata)): ?>
                                        <tr>
                                            <td class="text-center" style="padding-left:0px !important;">
                                                <div>
                                                    <p><?php echo e($pujadata->astrologer->name ?? 'Not Assigned'); ?></p>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div>
                                                    <span><?php echo e($pujadata->puja_name); ?></span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div>
                                                    <span>(-) <?php if(systemflag('walletType') == 'Coin'): ?>
                                                    <img src="<?php echo e(asset($coinIcon)); ?>" alt="Wallet Icon" width="15">
                                                    <?php else: ?>
                                                    ₹
                                                    <?php endif; ?><?php echo e(number_format($pujadata->order_total_price,2)); ?></span>
                                                </div>
                                            </td>

                                            <td class="text-center" style="cursor:pointer;">
                                                <a class="color-red" data-toggle="modal" data-target="#packageDetailsModal"
                                                    data-package="<?php echo e(json_encode($pujadata->package)); ?>">
                                                    <?php echo e(($pujadata->package->title) ?? '---'); ?>

                                                </a>
                                            </td>

                                            <?php if(empty($pujadata->astrologer->name)): ?>
                                            <td class="text-center">
                                                Link will be available soon
                                            </td>
                                            <?php else: ?>
                                            <td class="text-center">
                                                <?php echo $pujadata->pujabroadcast; ?>

                                            </td>
                                            <?php endif; ?>
                                             <td class="text-center">
                                                 <?php
                                                    // Assuming $pujadata->puja_start_datetime and $pujadata->puja_end_datetime are in the format 'Y-m-d H:i:s'
                                                    $startDateTime = \Carbon\Carbon::parse($pujadata->puja_start_datetime);
                                                    $endDateTime = \Carbon\Carbon::parse($pujadata->puja_end_datetime);
                                                ?>
                                                <?php echo e($startDateTime->format('d-m-Y h:i a')); ?>

                                            </td>
                                            <td>
                                                <?php echo e($pujadata->puja_duration); ?> mins
                                            </td>
                                            
                                            <td class="text-center">
                                                <?php if($pujadata->pujabroadcast=='Incomplete Puja' && $pujadata->puja_refund_status!=true): ?>
                                                <a href="javascript::void();" class="btn btn-report refundBtn" data-puja-id="<?php echo e($pujadata->id); ?>">Get Refund</a>
                                                <?php elseif($pujadata->puja_refund_status!=false): ?>
                                                <span class="text-success">Refunded</span>
                                                <?php else: ?>
                                                ---
                                                <?php endif; ?>
                                            </td>
                                           
                                        </tr>
                                       <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="packageDetailsModal" tabindex="-1" role="dialog" aria-labelledby="packageDetailsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="packageDetailsModalLabel">Package Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Package details will be injected here -->
                <div id="packageDetailsContent" class="p-3"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
$(document).ready(function() {
    $('a[data-toggle="modal"]').click(function() {

        var packageData = $(this).data('package');

        var content = '<p><strong>Package Name :</strong> '  + packageData.title + '</p>';
        content += `<p><strong>Price:</strong> 
        <?php if(systemflag('walletType') == 'Coin'): ?>
            <img src="<?php echo e(asset($coinIcon)); ?>" alt="Wallet Icon" width="15">
        <?php else: ?>
            ₹
        <?php endif; ?>
        ${packageData.package_price}</p>`;
        content += '<p><strong>For:</strong> '  + packageData.person + ' persons</p>';
        content += '<p><strong>Description:</strong></p><ul>';

        // Loop through the description array and add items to the list
        packageData.description.forEach(function(desc) {
            content += '<li>' + desc + '</li>';
        });

        content += '</ul>';

        // Inject the content into the modal
        $('#packageDetailsContent').html(content);
    });
});

$(document).on('click', '.refundBtn', function(e) {
    e.preventDefault();
    if (!confirm('Are you sure you want to request a refund for this puja?')) {
        return false;
    }
    var pujaId=$(this).data('puja-id');

    $.ajax({
        url: '<?php echo e(route('getPujaRefund')); ?>',
        type: 'POST',
        data: {
            id: pujaId,
        },
        success: function(response) {
            toastr.success('Puja Amount Refunded Successfully');
            window.location.reload();
            
        },
        error: function(xhr, status, error) {
            toastr.error(xhr.responseText);
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/happylifevastu/public_html/resources/views/frontend/pages/my-puja-list.blade.php ENDPATH**/ ?>