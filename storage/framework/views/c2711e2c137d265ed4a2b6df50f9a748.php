<?php $__env->startSection('subhead'); ?>
    <title>Pujari Bookings</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subcontent'); ?>

    <div class="loader"></div>

    <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">Pujari Bookings</h2>
    </div>

    
    <div class="intro-y flex flex-wrap items-center gap-3 mt-5">
        <form action="<?php echo e(route('pujariBookings')); ?>" method="POST" class="flex flex-wrap gap-2 items-center">
            <?php echo csrf_field(); ?>
            <div class="relative w-56 text-slate-500" style="display:inline-block">
                <input type="text" name="searchString" value="<?php echo e($searchString ?? ''); ?>"
                       class="form-control w-56 box pr-10" placeholder="Search pujari / person...">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
            </div>
            <select name="status" class="form-select w-36 box">
                <option value="">All Status</option>
                <option value="pending"     <?php echo e(($status ?? '') == 'pending'     ? 'selected' : ''); ?>>Pending</option>
                <option value="confirmed"   <?php echo e(($status ?? '') == 'confirmed'   ? 'selected' : ''); ?>>Confirmed</option>
                <option value="in_progress" <?php echo e(($status ?? '') == 'in_progress' ? 'selected' : ''); ?>>In Progress</option>
                <option value="completed"   <?php echo e(($status ?? '') == 'completed'   ? 'selected' : ''); ?>>Completed</option>
                <option value="cancelled"   <?php echo e(($status ?? '') == 'cancelled'   ? 'selected' : ''); ?>>Cancelled</option>
            </select>
            <input type="date" name="from_date" value="<?php echo e($from_date ?? ''); ?>" class="form-control w-36 box">
            <input type="date" name="to_date"   value="<?php echo e($to_date ?? ''); ?>"   class="form-control w-36 box">
            <button class="btn btn-primary shadow-md">Filter</button>
            <a href="<?php echo e(route('pujariBookings')); ?>" class="btn btn-secondary">
                <i data-lucide="x" class="w-4 h-4 mr-1"></i> Clear
            </a>
        </form>
    </div>

    <?php if(isset($totalRecords) && $totalRecords > 0): ?>
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible mt-5">
        <table class="table table-report -mt-2">
            <thead class="sticky-top">
                <tr>
                    <th>#</th>
                    <th>Pujari</th>
                    <th class="text-center">Customer / Contact</th>
                    <th class="text-center">Puja / Date</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Payment</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0; ?>
                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="intro-x" id="row_<?php echo e($booking->id); ?>">
                    <td><?php echo e(($page - 1) * 15 + ++$no); ?></td>
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 image-fit zoom-in flex-none">
                                <img class="rounded-full"
                                     src="<?php echo e($booking->profileImage ? (Str::startsWith($booking->profileImage,'http') ? $booking->profileImage : str_replace('storage/','public/storage/',asset($booking->profileImage))) : '/build/assets/images/person.png'); ?>"
                                     onerror="this.onerror=null;this.src='/build/assets/images/person.png';">
                            </div>
                            <span class="font-medium"><?php echo e($booking->pujariName); ?></span>
                        </div>
                    </td>
                    <td class="text-center">
                        <span class="font-medium"><?php echo e($booking->personName); ?></span><br>
                        <span class="text-slate-500 text-xs"><?php echo e($booking->personContact); ?></span>
                    </td>
                    <td class="text-center">
                        <span class="font-medium"><?php echo e($booking->pujaName ?? 'Session'); ?></span><br>
                        <span class="text-slate-500 text-xs">
                            <?php echo e(\Carbon\Carbon::parse($booking->bookingDate)->format('d M Y')); ?>

                            <?php if($booking->timeSlot): ?> \u00b7 <?php echo e($booking->timeSlot); ?> <?php endif; ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <?php echo e($currency->value ?? '\u20b9'); ?><?php echo e(number_format($booking->totalAmount, 2)); ?>

                        <?php if($booking->gstAmount > 0): ?>
                        <br><span class="text-slate-500 text-xs">GST: <?php echo e($currency->value ?? '\u20b9'); ?><?php echo e(number_format($booking->gstAmount, 2)); ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <?php
                            $pColors = ['paid' => 'success', 'pending' => 'warning', 'failed' => 'danger'];
                            $pColor  = $pColors[$booking->paymentStatus] ?? 'secondary';
                        ?>
                        <span class="px-2 py-1 rounded text-xs bg-<?php echo e($pColor); ?>/10 text-<?php echo e($pColor); ?> capitalize">
                            <?php echo e($booking->paymentStatus); ?>

                        </span>
                        <br><span class="text-slate-500 text-xs"><?php echo e(strtoupper($booking->paymentMode)); ?></span>
                    </td>
                    <td class="text-center">
                        <?php
                            $sColors = ['pending'=>'warning','confirmed'=>'primary','in_progress'=>'info','completed'=>'success','cancelled'=>'danger'];
                            $sColor  = $sColors[$booking->status] ?? 'secondary';
                        ?>
                       <select class="form-select text-xs py-1 px-2 statusDropdown" 
                                data-id="<?php echo e($booking->id); ?>"
                                style="color: var(--color-<?php echo e($sColor); ?>);">
                        
                            <option value="pending" 
                                <?php echo e($booking->status == 'pending' ? 'selected' : ''); ?>>
                                Pending
                            </option>
                        
                            <option value="paid" 
                                <?php echo e($booking->status == 'paid' ? 'selected' : ''); ?>>
                                Paid
                            </option>
                        
                            <option value="failed" 
                                <?php echo e($booking->status == 'failed' ? 'selected' : ''); ?>>
                                Failed
                            </option>
                        
                            <option value="refunded" 
                                <?php echo e($booking->status == 'refunded' ? 'selected' : ''); ?>>
                                Refunded
                            </option>
                        
                            <option value="in_progress" 
                                <?php echo e($booking->status == 'in_progress' ? 'selected' : ''); ?>>
                                In Progress
                            </option>
                        
                        </select>
                    </td>
                    <td class="text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="<?php echo e(route('pujariBookingDetail', $booking->id)); ?>" class="text-primary" title="View Detail">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </a>
                            <a href="javascript:;" class="text-danger deleteBooking" data-id="<?php echo e($booking->id); ?>" title="Delete">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div class="d-inline text-slate-500 pagecount mt-3">
        Showing <?php echo e($start); ?> to <?php echo e($end); ?> of <?php echo e($totalRecords); ?> entries
    </div>
    <nav class="mt-2">
        <ul class="pagination">
            <li class="page-item <?php echo e($page == 1 ? 'disabled' : ''); ?>">
                <a class="page-link" href="<?php echo e(route('pujariBookings', ['page' => $page - 1])); ?>">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i></a>
            </li>
            <?php for($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?php echo e($page == $i ? 'active' : ''); ?>">
                <a class="page-link" href="<?php echo e(route('pujariBookings', ['page' => $i])); ?>"><?php echo e($i); ?></a>
            </li>
            <?php endfor; ?>
            <li class="page-item <?php echo e($page == $totalPages ? 'disabled' : ''); ?>">
                <a class="page-link" href="<?php echo e(route('pujariBookings', ['page' => $page + 1])); ?>">
                    <i data-lucide="chevron-right" class="w-4 h-4"></i></a>
            </li>
        </ul>
    </nav>

    <?php else: ?>
    <div class="intro-y mt-5" style="height:50vh;display:flex;align-items:center;">
        <div style="margin:auto;text-align:center;">
            <img src="/build/assets/images/nodata.png" style="height:200px;" alt="No data">
            <h3 class="mt-3">No Bookings Found</h3>
        </div>
    </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    button.swal2-confirm.swal2-styled {
    background: #28c76f !important;
}
button.swal2-cancel.swal2-styled {
    background: #6e7881 !important;
}
</style>
<?php $__env->startSection('script'); ?>
<script>
window.addEventListener('load', function () {

    const loader = document.querySelector('.loader');

    if (loader) {
        loader.style.display = 'none';
    }

});

// Status Change
document.addEventListener('change', function (e) {

    const dropdown = e.target.closest('.statusDropdown');

    if (!dropdown) return;

    const id = dropdown.dataset.id;
    const status = dropdown.value;

    fetch('<?php echo e(route("updatePujariBookingStatus")); ?>', {

        method: 'POST',

        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
            'Accept': 'application/json'
        },

        body: JSON.stringify({
            id: id,
            status: status
        })

    })

    .then(response => response.json())

    .then(res => {

        if (res.status == 200) {

            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Status updated',
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

// Delete Booking
document.addEventListener('click', function (e) {

    const button = e.target.closest('.deleteBooking');

    if (!button) return;

    const id = button.dataset.id;

    Swal.fire({
        title: 'Delete this booking?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#ea5455',
        confirmButtonText: 'Yes, delete',
    })

    .then((result) => {

        if (!result.isConfirmed) return;

        fetch('<?php echo e(route("deletePujariBooking")); ?>', {

            method: 'DELETE',

            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Accept': 'application/json'
            },

            body: JSON.stringify({
                id: id
            })

        })

        .then(response => response.json())

        .then(res => {

            if (res.status == 200) {

                const row = document.getElementById('row_' + id);

                if (row) {

                    row.style.transition = '0.4s';
                    row.style.opacity = '0';

                    setTimeout(() => {
                        row.remove();
                    }, 400);

                }

                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'Booking deleted',
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

            // showToast('error', 'Server error');
            Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Server error'
                });

        });

    });

});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('../layout/' . $layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/happylifevastu/public_html/resources/views/pages/pujari-bookings.blade.php ENDPATH**/ ?>