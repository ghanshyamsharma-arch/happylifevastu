<?php $__env->startSection('subhead'); ?>
    <title>Block Pujari List</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subcontent'); ?>

    <div class="loader"></div>

    <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">Blocked Pujaris</h2>
        <a href="<?php echo e(route('pujaris')); ?>" class="btn btn-secondary shadow-md">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i> Back to Pujaris
        </a>
    </div>

    <div class="intro-y flex flex-wrap items-center mt-5 gap-3">
        <form action="<?php echo e(route('blockPujari')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="relative w-56 text-slate-500" style="display:inline-block">
                <input type="text" name="searchString" value="<?php echo e($searchString ?? ''); ?>"
                       class="form-control w-56 box pr-10" placeholder="Search pujari / user...">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
            </div>
            <button class="btn btn-primary shadow-md ml-2">Search</button>
        </form>
        <a href="<?php echo e(route('blockPujari')); ?>" class="btn btn-secondary">
            <i data-lucide="x" class="w-4 h-4 mr-1"></i> Clear
        </a>
    </div>

    <?php if(isset($totalRecords) && $totalRecords > 0): ?>
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible mt-5">
        <table class="table table-report -mt-2">
            <thead class="sticky-top">
                <tr>
                    <th class="whitespace-nowrap">#</th>
                    <th class="whitespace-nowrap">Pujari</th>
                    <th class="text-center whitespace-nowrap">Blocked By</th>
                    <th class="text-center whitespace-nowrap">Reason</th>
                    <th class="text-center whitespace-nowrap">Date</th>
                    <th class="text-center whitespace-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0; ?>
                <?php $__currentLoopData = $reportBlocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="intro-x" id="row_<?php echo e($block->id); ?>">
                    <td><?php echo e(($page - 1) * 15 + ++$no); ?></td>
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="w-9 h-9 image-fit zoom-in flex-none">
                                <img class="rounded-full"
                                     src="<?php echo e(Str::startsWith($block->profileImage ?? '', ['http','http']) ? $block->profileImage : '/' . ($block->profileImage ?? '')); ?>"
                                     onerror="this.onerror=null;this.src='/build/assets/images/person.png';">
                            </div>
                            <div>
                                <span class="font-medium"><?php echo e($block->pujariName); ?></span><br>
                                <span class="text-slate-500 text-xs"><?php echo e($block->pujariContactNo); ?></span>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <?php if($block->userId): ?>
                            <span class="font-medium"><?php echo e($block->userName); ?></span><br>
                            <span class="text-slate-500 text-xs"><?php echo e($block->userContactNo); ?></span>
                        <?php else: ?>
                            <span class="px-2 py-1 rounded bg-danger/10 text-danger text-xs font-medium">Admin</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center text-sm"><?php echo e($block->reason ?? '-'); ?></td>
                    <td class="text-center text-sm"><?php echo e(\Carbon\Carbon::parse($block->created_at)->format('d M Y')); ?></td>
                    <td class="text-center">
                        <a href="javascript:;" class="flex items-center justify-center text-danger deleteBlock"
                           data-id="<?php echo e($block->id); ?>">
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
                <a class="page-link" href="<?php echo e(route('blockPujari', ['page' => $page - 1, 'searchString' => $searchString ?? ''])); ?>">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i></a>
            </li>
            <?php for($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?php echo e($page == $i ? 'active' : ''); ?>">
                <a class="page-link" href="<?php echo e(route('blockPujari', ['page' => $i, 'searchString' => $searchString ?? ''])); ?>"><?php echo e($i); ?></a>
            </li>
            <?php endfor; ?>
            <li class="page-item <?php echo e($page == $totalPages ? 'disabled' : ''); ?>">
                <a class="page-link" href="<?php echo e(route('blockPujari', ['page' => $page + 1, 'searchString' => $searchString ?? ''])); ?>">
                    <i data-lucide="chevron-right" class="w-4 h-4"></i></a>
            </li>
        </ul>
    </nav>

    <?php else: ?>
    <div class="intro-y mt-5" style="height:60vh;display:flex;align-items:center;">
        <div style="margin:auto;text-align:center;">
            <img src="/build/assets/images/nodata.png" style="height:200px;" alt="No data">
            <h3 class="mt-3">No Blocked Pujaris</h3>
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
document.addEventListener('DOMContentLoaded', function () {

    // Hide Loader
    window.addEventListener('load', function () {

        document.querySelector('.loader')?.style.setProperty('display', 'none');

    });

    // Delete Block Record
    document.addEventListener('click', function (e) {

        const button = e.target.closest('.deleteBlock');

        if (!button) return;

        const id = button.dataset.id;

        Swal.fire({
            title: 'Remove this block record?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ea5455',
            confirmButtonText: 'Yes, remove',
        })

        .then((result) => {

            if (result.isConfirmed) {

                fetch('<?php echo e(route("deleteBlockPujariRecord")); ?>', {

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

                        toastr.success('Block record removed');

                    } else {

                        toastr.error(res.message);

                    }

                })

                .catch(error => {

                    console.error(error);

                    toastr.error('Server error');

                });

            }

        });

    });

});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('../layout/' . $layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/happylifevastu/public_html/resources/views/pages/blocked-pujaris.blade.php ENDPATH**/ ?>