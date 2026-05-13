<?php $__env->startSection('subhead'); ?>
    <title>Pujari Reviews</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subcontent'); ?>

    <div class="loader"></div>

    <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">Pujari Reviews</h2>
        <button class="btn btn-primary shadow-md" data-tw-toggle="modal" data-tw-target="#addReviewModal">
            <i data-lucide="plus" class="w-4 h-4 mr-1"></i> Add Review
        </button>
    </div>

    <?php if(isset($totalRecords) && $totalRecords > 0): ?>
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible mt-5">
        <table class="table table-report -mt-2">
            <thead class="sticky-top">
                <tr>
                    <th>#</th>
                    <th>Pujari</th>
                    <th class="text-center">Reviewer</th>
                    <th class="text-center">Rating</th>
                    <th class="text-center">Review</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0; ?>
                <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="intro-x" id="row_<?php echo e($review->id); ?>">
                    <td><?php echo e(($page - 1) * 15 + ++$no); ?></td>
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 image-fit zoom-in flex-none">
                                <img class="rounded-full"
                                     src="<?php echo e(Str::startsWith($review->profileImage ?? '', 'http') ? $review->profileImage : '/' . ($review->profileImage ?? '')); ?>"
                                     onerror="this.onerror=null;this.src='/build/assets/images/person.png';">
                            </div>
                            <span class="font-medium"><?php echo e($review->pujariName); ?></span>
                        </div>
                    </td>
                    <td class="text-center"><?php echo e($review->reviewerName); ?></td>
                    <td class="text-center">
                        <div class="flex items-center justify-center gap-1">
                            <?php for($s = 1; $s <= 5; $s++): ?>
                                <i data-lucide="star" class="w-3 h-3 <?php echo e($s <= $review->rating ? 'text-warning fill-warning' : 'text-slate-300'); ?>"></i>
                            <?php endfor; ?>
                            <span class="ml-1 text-xs">(<?php echo e(number_format($review->rating, 1)); ?>)</span>
                        </div>
                    </td>
                    <td class="text-center max-w-xs">
                        <p class="text-sm line-clamp-2"><?php echo e($review->review ?? '-'); ?></p>
                    </td>
                    <td class="text-center text-sm"><?php echo e(\Carbon\Carbon::parse($review->created_at)->format('d M Y')); ?></td>
                    <td class="text-center">
                        <a href="javascript:;" class="text-danger deleteReview" data-id="<?php echo e($review->id); ?>">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </a>
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
                <a class="page-link" href="<?php echo e(route('pujariReviews', ['page' => $page - 1])); ?>">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i></a>
            </li>
            <?php for($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?php echo e($page == $i ? 'active' : ''); ?>">
                <a class="page-link" href="<?php echo e(route('pujariReviews', ['page' => $i])); ?>"><?php echo e($i); ?></a>
            </li>
            <?php endfor; ?>
            <li class="page-item <?php echo e($page == $totalPages ? 'disabled' : ''); ?>">
                <a class="page-link" href="<?php echo e(route('pujariReviews', ['page' => $page + 1])); ?>">
                    <i data-lucide="chevron-right" class="w-4 h-4"></i></a>
            </li>
        </ul>
    </nav>

    <?php else: ?>
    <div class="intro-y mt-5" style="height:50vh;display:flex;align-items:center;">
        <div style="margin:auto;text-align:center;">
            <img src="/build/assets/images/nodata.png" style="height:200px;" alt="No data">
            <h3 class="mt-3">No Reviews Yet</h3>
        </div>
    </div>
    <?php endif; ?>

    
    <div id="addReviewModal" class="modal" data-tw-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="font-medium text-base">Add Pujari Review</h2>
                    <a data-tw-dismiss="modal" href="javascript:;"><i data-lucide="x" class="w-8 h-8 text-slate-400"></i></a>
                </div>
                <div class="modal-body p-5">
                    <form id="addReviewForm">
                        <?php echo csrf_field(); ?>
                        <div class="mb-4">
                            <label class="form-label">Pujari <span class="text-danger">*</span></label>
                            <select name="pujariId" class="form-select tom-select" required>
                                <option value="">-- Select Pujari --</option>
                                <?php $__currentLoopData = $pujaris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($p->id); ?>"><?php echo e($p->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Reviewer Name <span class="text-danger">*</span></label>
                            <input type="text" name="user_name" class="form-control" placeholder="Reviewer name" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Rating <span class="text-danger">*</span></label>
                            <div class="flex gap-2 starRating" id="starSelector">
                                <?php for($s = 1; $s <= 5; $s++): ?>
                                <i data-lucide="star" data-val="<?php echo e($s); ?>" class="w-7 h-7 cursor-pointer text-slate-300 star-icon"></i>
                                <?php endfor; ?>
                            </div>
                            <input type="hidden" name="rating" id="ratingVal" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Review</label>
                            <textarea name="review" class="form-control" rows="3" placeholder="Write review..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button data-tw-dismiss="modal" class="btn btn-secondary w-20 mr-2">Cancel</button>
                    <button id="submitReviewBtn" class="btn btn-primary">
                        <i data-lucide="save" class="w-4 h-4 mr-1"></i> Save Review
                    </button>
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
window.addEventListener('load', function () {

    const loader = document.querySelector('.loader');

    if (loader) {
        loader.style.display = 'none';
    }

});

// Star Rating
document.addEventListener('click', function (e) {

    const star = e.target.closest('.star-icon');

    if (!star) return;

    const val = star.dataset.val;

    document.getElementById('ratingVal').value = val;

    document.querySelectorAll('.star-icon').forEach(function (item, index) {

        if (index < val) {

            item.classList.remove('text-slate-300');
            item.classList.add('text-warning');

        } else {

            item.classList.remove('text-warning');
            item.classList.add('text-slate-300');

        }

    });

});

// Submit Review
document.getElementById('submitReviewBtn')?.addEventListener('click', function () {

    const rating = document.getElementById('ratingVal').value;

    if (!rating) {

        showToast('error', 'Please select a rating');
        return;

    }

    const form = document.getElementById('addReviewForm');

    fetch('<?php echo e(route("addPujariReview")); ?>', {

        method: 'POST',

        headers: {
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
            'Accept': 'application/json'
        },

        body: new FormData(form)

    })

    .then(response => response.json())

    .then(res => {

        if (res.status == 200) {

            Swal.fire({
                icon: 'success',
                title: 'Saved!',
                text: res.message
            })

            .then(() => {

                location.reload();

            });

        } else {

            showToast('error', res.message);

        }

    })

    .catch(error => {

        console.error(error);

        showToast('error', 'Server error');

    });

});

// Delete Review
document.addEventListener('click', function (e) {

    const button = e.target.closest('.deleteReview');

    if (!button) return;

    const id = button.dataset.id;

    Swal.fire({
        title: 'Delete this review?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#ea5455',
        confirmButtonText: 'Yes, delete',
    })

    .then((result) => {

        if (!result.isConfirmed) return;

        fetch('<?php echo e(route("deletePujariReview")); ?>', {

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

                showToast('success', 'Review deleted');

            } else {

                showToast('error', res.message);

            }

        })

        .catch(error => {

            console.error(error);

            showToast('error', 'Server error');

        });

    });

});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('../layout/' . $layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/happylifevastu/public_html/resources/views/pages/pujari-reviews.blade.php ENDPATH**/ ?>