<?php $__env->startSection('subhead'); ?>
    <title>Booking Detail #<?php echo e($booking->id); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subcontent'); ?>

    <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">
            Booking Detail <span class="text-slate-500 text-sm">#<?php echo e($booking->id); ?></span>
        </h2>
        <a href="<?php echo e(route('pujariBookings')); ?>" class="btn btn-secondary shadow-md">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i> Back
        </a>
    </div>

    <?php
        $sColors = ['pending'=>'warning','confirmed'=>'primary','in_progress'=>'info','completed'=>'success','cancelled'=>'danger'];
        $sColor  = $sColors[$booking->status] ?? 'secondary';
    ?>

    <div class="intro-y grid grid-cols-12 gap-5 mt-5">

        
        <div class="col-span-12 lg:col-span-8">

            
            <div class="intro-y box p-5 mb-5">
                <div class="flex items-center justify-between border-b border-slate-200 pb-3 mb-4">
                    <div class="flex items-center gap-2">
                        <i data-lucide="calendar" class="w-5 h-5 text-primary"></i>
                        <h3 class="font-medium text-base">Booking Information</h3>
                    </div>
                    <span class="px-3 py-1 rounded text-sm font-medium bg-<?php echo e($sColor); ?>/10 text-<?php echo e($sColor); ?> capitalize">
                        <?php echo e(str_replace('_', ' ', $booking->status)); ?>

                    </span>
                </div>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-slate-500 block">Puja Name</span>
                        <span class="font-medium"><?php echo e($booking->pujaName ?? 'General Session'); ?></span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Booking Type</span>
                        <span class="font-medium capitalize"><?php echo e($booking->bookingType); ?></span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Booking Date</span>
                        <span class="font-medium"><?php echo e(\Carbon\Carbon::parse($booking->bookingDate)->format('d M Y, l')); ?></span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Time Slot</span>
                        <span class="font-medium"><?php echo e($booking->timeSlot ?? '-'); ?></span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Location</span>
                        <span class="font-medium capitalize"><?php echo e($booking->location ?? '-'); ?></span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Address</span>
                        <span class="font-medium"><?php echo e($booking->address ?? '-'); ?></span>
                    </div>
                    <?php if($booking->gotra): ?>
                    <div>
                        <span class="text-slate-500 block">Gotra</span>
                        <span class="font-medium"><?php echo e($booking->gotra); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if($booking->familyMemberNames): ?>
                    <div class="col-span-2">
                        <span class="text-slate-500 block">Family Member Names</span>
                        <span class="font-medium"><?php echo e($booking->familyMemberNames); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if($booking->specialRequirement): ?>
                    <div class="col-span-2">
                        <span class="text-slate-500 block">Special Requirement</span>
                        <span class="font-medium"><?php echo e($booking->specialRequirement); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="intro-y box p-5 mb-5">
                <div class="flex items-center border-b border-slate-200 pb-3 mb-4">
                    <i data-lucide="user" class="w-5 h-5 mr-2 text-primary"></i>
                    <h3 class="font-medium text-base">Customer Information</h3>
                </div>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-slate-500 block">Name</span>
                        <span class="font-medium"><?php echo e($booking->personName); ?></span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Contact</span>
                        <span class="font-medium"><?php echo e($booking->personContact); ?></span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Email</span>
                        <span class="font-medium"><?php echo e($booking->personEmail ?? '-'); ?></span>
                    </div>
                    <?php if($booking->customerName): ?>
                    <div>
                        <span class="text-slate-500 block">App User</span>
                        <span class="font-medium"><?php echo e($booking->customerName); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="intro-y box p-5">
                <div class="flex items-center border-b border-slate-200 pb-3 mb-4">
                    <i data-lucide="message-square" class="w-5 h-5 mr-2 text-primary"></i>
                    <h3 class="font-medium text-base">Update Status / Note</h3>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select id="statusSelect" class="form-select">
                        <option value="pending"     <?php echo e($booking->status == 'pending'     ? 'selected' : ''); ?>>Pending</option>
                        <option value="confirmed"   <?php echo e($booking->status == 'confirmed'   ? 'selected' : ''); ?>>Confirmed</option>
                        <option value="in_progress" <?php echo e($booking->status == 'in_progress' ? 'selected' : ''); ?>>In Progress</option>
                        <option value="completed"   <?php echo e($booking->status == 'completed'   ? 'selected' : ''); ?>>Completed</option>
                        <option value="cancelled"   <?php echo e($booking->status == 'cancelled'   ? 'selected' : ''); ?>>Cancelled</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label">Admin Note</label>
                    <textarea id="adminNoteInput" class="form-control" rows="3" placeholder="Internal note..."><?php echo e($booking->adminNote); ?></textarea>
                </div>
                <button id="updateStatusBtn" class="btn btn-primary">
                    <i data-lucide="save" class="w-4 h-4 mr-1"></i> Update
                </button>
            </div>
        </div>

        
        <div class="col-span-12 lg:col-span-4">

            
            <div class="intro-y box p-5 mb-5">
                <div class="text-center pb-4 border-b border-slate-200 mb-4">
                    <div class="w-16 h-16 rounded-full overflow-hidden mx-auto mb-2 image-fit">
                        <img src="<?php echo e($booking->profileImage ? (Str::startsWith($booking->profileImage,'http') ? $booking->profileImage : str_replace('storage/','public/storage/',asset($booking->profileImage))) : '/build/assets/images/person.png'); ?>"
                             onerror="this.onerror=null;this.src='/build/assets/images/person.png';"
                             class="w-full h-full object-cover">
                    </div>
                    <h4 class="font-medium"><?php echo e($booking->pujariName); ?></h4>
                    <p class="text-slate-500 text-sm"><?php echo e($booking->pujariContact); ?></p>
                    <p class="text-slate-500 text-xs"><?php echo e($booking->pujariEmail); ?></p>
                </div>
                <a href="<?php echo e(route('pujari-detail', $booking->pujariId)); ?>" class="btn btn-outline-primary w-full btn-sm">
                    <i data-lucide="external-link" class="w-3 h-3 mr-1"></i> View Pujari Profile
                </a>
            </div>

            
            <div class="intro-y box p-5">
                <div class="flex items-center border-b border-slate-200 pb-3 mb-4">
                    <i data-lucide="credit-card" class="w-5 h-5 mr-2 text-primary"></i>
                    <h3 class="font-medium text-base">Payment Summary</h3>
                </div>
                <div class="text-sm space-y-3">
                    <div class="flex justify-between">
                        <span class="text-slate-500">Amount</span>
                        <span><?php echo e($currency->value ?? '\u20b9'); ?><?php echo e(number_format($booking->amount, 2)); ?></span>
                    </div>
                    <?php if($booking->gstAmount > 0): ?>
                    <div class="flex justify-between">
                        <span class="text-slate-500">GST</span>
                        <span><?php echo e($currency->value ?? '\u20b9'); ?><?php echo e(number_format($booking->gstAmount, 2)); ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="flex justify-between font-bold border-t border-slate-200 pt-2">
                        <span>Total</span>
                        <span class="text-primary"><?php echo e($currency->value ?? '\u20b9'); ?><?php echo e(number_format($booking->totalAmount, 2)); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Payment Mode</span>
                        <span class="capitalize"><?php echo e($booking->paymentMode); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Payment Status</span>
                        <?php $pColors = ['paid'=>'success','pending'=>'warning','failed'=>'danger']; ?>
                        <span class="px-2 py-1 rounded text-xs bg-<?php echo e($pColors[$booking->paymentStatus] ?? 'secondary'); ?>/10 text-<?php echo e($pColors[$booking->paymentStatus] ?? 'secondary'); ?> capitalize">
                            <?php echo e($booking->paymentStatus); ?>

                        </span>
                    </div>
                    <?php if($booking->transactionId): ?>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Transaction ID</span>
                        <span class="text-xs"><?php echo e($booking->transactionId); ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Booked On</span>
                        <span><?php echo e(\Carbon\Carbon::parse($booking->created_at)->format('d M Y')); ?></span>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    button.swal2-confirm.swal2-styled {
    background: #28c76f !important;
}
button.swal2-cancel.swal2-styled {
    background: #6e7881 !important;
}
.tom-select .ts-dropdown .option.active{color:#000 !important;}
</style>
<?php $__env->startSection('script'); ?>
<script>
document.getElementById('updateStatusBtn')?.addEventListener('click', function () {

    fetch('<?php echo e(route("updatePujariBookingStatus")); ?>', {

        method: 'POST',

        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
            'Accept': 'application/json'
        },

        body: JSON.stringify({
            id: <?php echo e($booking->id); ?>,
            status: document.getElementById('statusSelect').value,
            adminNote: document.getElementById('adminNoteInput').value
        })

    })

    .then(response => response.json())

    .then(res => {

        if (res.status == 200) {

            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Updated successfully',
                timer: 1500,
                showConfirmButton: false
            });

        } else {

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: res.message
            });

        }

    })

    .catch(error => {

        console.error(error);

        Swal.fire({
            icon: 'error',
            title: 'Server Error',
            text: 'Something went wrong'
        });

    });

});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('../layout/' . $layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/happylifevastu/public_html/resources/views/pages/pujari-booking-detail.blade.php ENDPATH**/ ?>