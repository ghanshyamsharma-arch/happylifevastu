

<?php $__env->startSection('subhead'); ?>
    <title>Pujari List</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subcontent'); ?>
    <?php
        $currency = DB::table('systemflag')->where('name', 'currencySymbol')->select('value')->first();
    ?>

    <div class="loader"></div>

    <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">Pujaris</h2>
        <a href="<?php echo e(route('addPujari')); ?>" class="btn btn-primary shadow-md mr-2">
            <i data-lucide="plus" class="w-4 h-4 mr-1"></i> Add Pujari
        </a>
        <a href="<?php echo e(route('pending-pujari-requests')); ?>" class="btn btn-warning shadow-md">
            <i data-lucide="clock" class="w-4 h-4 mr-1"></i> Pending Requests
        </a>
    </div>

    
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-5 gap-3">
        <form action="<?php echo e(route('pujaris')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="w-56 relative text-slate-500" style="display:inline-block">
                <input value="<?php echo e($searchString ?? ''); ?>" type="text" class="form-control w-56 box pr-10"
                    placeholder="Search name / phone..." name="searchString">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
            </div>
            <button class="btn btn-primary shadow-md ml-2">Search</button>
        </form>

        <form action="<?php echo e(route('pujaris')); ?>" method="GET" class="flex items-center gap-2">
            <label class="font-bold">From:</label>
            <input type="date" name="from_date" value="<?php echo e($from_date ?? ''); ?>" class="form-control w-40 box">
            <label class="font-bold">To:</label>
            <input type="date" name="to_date" value="<?php echo e($to_date ?? ''); ?>" class="form-control w-40 box">
            <button class="btn btn-primary shadow-md">Filter</button>
            <a href="<?php echo e(route('pujaris')); ?>" class="btn btn-secondary">
                <i data-lucide="x" class="w-4 h-4 mr-1"></i> Clear
            </a>
        </form>
    </div>

    <?php if(isset($totalRecords) && $totalRecords > 0): ?>
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible list-table mt-5">
        <table class="table table-report -mt-2">
            <thead class="sticky-top">
                <tr>
                    <th class="whitespace-nowrap">#</th>
                    <th class="whitespace-nowrap">Profile</th>
                    <th class="whitespace-nowrap">Name</th>
                    <th class="text-center whitespace-nowrap">Contact</th>
                    <th class="text-center whitespace-nowrap">Skill</th>
                    <th class="text-center whitespace-nowrap">Experience</th>
                    <!--<th class="text-center whitespace-nowrap">Rate</th>-->
                    <th class="text-center whitespace-nowrap">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0; ?>
                <?php $__currentLoopData = $pujaris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pujari): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="intro-x">
                    <td><?php echo e(($page - 1) * 15 + ++$no); ?></td>
                    <td>
                        <div class="w-10 h-10 image-fit zoom-in">
                            <img class="rounded-full"
                                 src="<?php echo e($pujari->profileImage ? (Str::startsWith($pujari->profileImage,'http') ? $pujari->profileImage : str_replace('storage/','public/storage/',asset($pujari->profileImage))) : '/build/assets/images/person.png'); ?>"
                                 onerror="this.onerror=null;this.src='/build/assets/images/person.png';">
                        </div>
                    </td>
                    <td>
                        <a href="<?php echo e(route('pujari-detail', $pujari->id)); ?>" class="font-medium whitespace-nowrap">
                            <?php echo e($pujari->name); ?>

                        </a><br>
                        <span class="text-slate-500 text-xs">
                            <?php if($pujari->isActive): ?>
                                <span class="text-success">Active</span>
                            <?php else: ?>
                                <span class="text-danger">Inactive</span>
                            <?php endif; ?>
                            &nbsp;|&nbsp;
                            <?php if($pujari->isVerified): ?>
                                <span class="text-success">Verified</span>
                            <?php else: ?>
                                <span class="text-warning">Pending</span>
                            <?php endif; ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <?php echo e($pujari->contactNo); ?><br>
                        <span class="text-slate-500 text-xs"><?php echo e($pujari->email); ?></span>
                    </td>
                    <td class="text-center"><?php echo e(Str::limit($pujari->primarySkill, 28)); ?></td>
                    <td class="text-center"><?php echo e($pujari->experienceInYears ?? '-'); ?> Yrs</td>
                    <!--<td class="text-center">-->
                    <!--    <?php echo e($currency->value ?? '₹'); ?><?php echo e(number_format($pujari->reportRate, 0)); ?>/session-->
                    <!--</td>-->
                    <td class="text-center">
                        <div class="flex items-center justify-center gap-3">
                            <a href="<?php echo e(route('pujari-detail', $pujari->id)); ?>" class="flex items-center text-primary" title="View">
                                <i data-lucide="eye" class="w-4 h-4 mr-1"></i>
                            </a>
                            <a href="<?php echo e(route('edit-pujari', $pujari->id)); ?>" class="flex items-center text-warning" title="Edit">
                                <i data-lucide="edit" class="w-4 h-4 mr-1"></i>
                            </a>
                            <a href="javascript:;" class="flex items-center text-danger deletePujari" data-id="<?php echo e($pujari->id); ?>" title="Delete">
                                <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
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
    <div class="d-inline addbtn intro-y col-span-12">
        <nav class="w-full sm:w-auto sm:mr-auto">
            <ul class="pagination mt-2">
                <li class="page-item <?php echo e($page == 1 ? 'disabled' : ''); ?>">
                    <a class="page-link" href="<?php echo e(route('pujaris', ['page' => $page - 1, 'searchString' => $searchString ?? ''])); ?>">
                        <i class="w-4 h-4" data-lucide="chevron-left"></i>
                    </a>
                </li>
                <?php for($i = 0; $i < $totalPages; $i++): ?>
                <li class="page-item <?php echo e($page == $i + 1 ? 'active' : ''); ?>">
                    <a class="page-link" href="<?php echo e(route('pujaris', ['page' => $i + 1, 'searchString' => $searchString ?? ''])); ?>"><?php echo e($i + 1); ?></a>
                </li>
                <?php endfor; ?>
                <li class="page-item <?php echo e($page == $totalPages ? 'disabled' : ''); ?>">
                    <a class="page-link" href="<?php echo e(route('pujaris', ['page' => $page + 1, 'searchString' => $searchString ?? ''])); ?>">
                        <i class="w-4 h-4" data-lucide="chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <?php else: ?>
    <div class="intro-y mt-5" style="height:60vh;display:flex;align-items:center;">
        <div style="margin:auto;text-align:center;">
            <img src="/build/assets/images/nodata.png" style="height:200px;" alt="No data">
            <h3 class="mt-3">No Pujaris Found</h3>
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

    // Delete Pujari
    document.addEventListener('click', function (e) {

        const button = e.target.closest('.deletePujari');

        if (!button) return;

        const id = button.dataset.id;

        Swal.fire({
            title: 'Are you sure?',
            text: 'This pujari will be deleted.',
            icon: 'error',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            confirmButtonColor: '#ea5455',
        })

        .then((result) => {

            if (result.isConfirmed) {

                fetch('<?php echo e(route("deletePujari")); ?>', {

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

                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: res.message
                        })

                        .then(() => {

                            location.reload();

                        });

                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: res.message ?? 'Something went wrong'
                        });

                    }

                })

                .catch(error => {

                    console.error(error);

                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Server error'
                    });

                });

            }

        });

    });

});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('../layout/' . $layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/happylifevastu/public_html/resources/views/pages/pujari.blade.php ENDPATH**/ ?>