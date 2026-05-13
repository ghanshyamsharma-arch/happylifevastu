

<?php $__env->startSection('subhead'); ?>
    <title>Edit Pujari - <?php echo e($pujari->name); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subcontent'); ?>

    <div class="loader"></div>

    <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">Edit Pujari — <?php echo e($pujari->name); ?></h2>
        <a href="<?php echo e(route('pujari-detail', $pujari->id)); ?>" class="btn btn-secondary shadow-md">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i> Back to Detail
        </a>
    </div>

    <div class="intro-y box p-5 mt-5">
        <form id="editPujariForm" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id" value="<?php echo e($pujari->id); ?>">

            
            <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 pb-3 mb-5">
                <i data-lucide="user" class="w-5 h-5 mr-2 text-primary"></i>
                <h3 class="font-medium text-base">Basic Information</h3>
            </div>
            <div class="grid grid-cols-12 gap-4 mb-6">
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="<?php echo e($pujari->name); ?>" required>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="<?php echo e($pujari->email); ?>" required>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Contact No <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <select name="countryCode" class="form-select flex-none w-20">
                            <option value="+91" <?php echo e(($pujari->countryCode ?? '') == '+91' ? 'selected' : ''); ?>>+91</option>
                            <option value="+1"  <?php echo e(($pujari->countryCode ?? '') == '+1'  ? 'selected' : ''); ?>>+1</option>
                            <option value="+44" <?php echo e(($pujari->countryCode ?? '') == '+44' ? 'selected' : ''); ?>>+44</option>
                        </select>
                        <input type="text" name="contactNo" class="form-control" value="<?php echo e($pujari->contactNo); ?>" required>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">WhatsApp No</label>
                    <input type="text" name="whatsappNo" class="form-control" value="<?php echo e($pujari->whatsappNo); ?>">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Gender <span class="text-danger">*</span></label>
                    <select name="gender" class="form-select" required>
                        <option value="male"   <?php echo e(($pujari->gender ?? '') == 'male'   ? 'selected' : ''); ?>>Male</option>
                        <option value="female" <?php echo e(($pujari->gender ?? '') == 'female' ? 'selected' : ''); ?>>Female</option>
                        <option value="other"  <?php echo e(($pujari->gender ?? '') == 'other'  ? 'selected' : ''); ?>>Other</option>
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Birth Date</label>
                    <input type="date" name="birthDate" class="form-control"
                           value="<?php echo e($pujari->birthDate ? \Carbon\Carbon::parse($pujari->birthDate)->format('Y-m-d') : ''); ?>">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">City</label>
                    <input type="text" name="currentCity" class="form-control" value="<?php echo e($pujari->currentCity); ?>">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Verified</label>
                    <select name="isVerified" class="form-select">
                        <option value="1" <?php echo e($pujari->isVerified ? 'selected' : ''); ?>>Yes</option>
                        <option value="0" <?php echo e(!$pujari->isVerified ? 'selected' : ''); ?>>No</option>
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Profile Image</label>
                    <input type="file" name="profileImage" class="form-control" id="profileImageInput" accept="image/*">
                    <div class="mt-2">
                        <img id="profilePreview"
                             src="<?php echo e($pujari->profileImage ? (Str::startsWith($pujari->profileImage,'http') ? $pujari->profileImage : str_replace('storage/','public/storage/',asset($pujari->profileImage))) : '/build/assets/images/person.png'); ?>"
                             class="w-16 h-16 rounded-full object-cover border border-slate-200">
                    </div>
                </div>
            </div>

            
            <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 pb-3 mb-5">
                <i data-lucide="briefcase" class="w-5 h-5 mr-2 text-primary"></i>
                <h3 class="font-medium text-base">Professional Details</h3>
            </div>
            <div class="grid grid-cols-12 gap-4 mb-6">
                <div class="col-span-12 sm:col-span-6">
                    <label class="form-label">Primary Skill <span class="text-danger">*</span></label>
                    <input type="text" name="primarySkill" class="form-control" value="<?php echo e($pujari->primarySkill); ?>" required>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label class="form-label">All Skills <span class="text-danger">*</span></label>
                    <input type="text" name="allSkill" class="form-control" value="<?php echo e($pujari->allSkill); ?>" required>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Languages Known</label>
                    <input type="text" name="languageKnown" class="form-control" value="<?php echo e($pujari->languageKnown); ?>">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Experience (Years)</label>
                    <input type="number" name="experienceInYears" class="form-control" value="<?php echo e($pujari->experienceInYears); ?>" min="0">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Consultation Rate (₹) <span class="text-danger">*</span></label>
                    <input type="number" name="reportRate" class="form-control" value="<?php echo e($pujari->reportRate); ?>" min="0" required>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Highest Qualification</label>
                    <input type="text" name="highestQualification" class="form-control" value="<?php echo e($pujari->highestQualification); ?>">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Degree</label>
                    <input type="text" name="degree" class="form-control" value="<?php echo e($pujari->degree); ?>">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">College</label>
                    <input type="text" name="college" class="form-control" value="<?php echo e($pujari->college); ?>">
                </div>
                <div class="col-span-12">
                    <label class="form-label">Bio</label>
                    <textarea name="loginBio" class="form-control" rows="3"><?php echo e($pujari->loginBio); ?></textarea>
                </div>
            </div>

            
            <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 pb-3 mb-5">
                <i data-lucide="credit-card" class="w-5 h-5 mr-2 text-primary"></i>
                <h3 class="font-medium text-base">Bank Details</h3>
            </div>
            <div class="grid grid-cols-12 gap-4 mb-6">
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Bank Name</label>
                    <input type="text" name="bankName" class="form-control" value="<?php echo e($pujari->bankName); ?>">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Branch</label>
                    <input type="text" name="bankBranch" class="form-control" value="<?php echo e($pujari->bankBranch); ?>">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Account Number</label>
                    <input type="text" name="accountNumber" class="form-control" value="<?php echo e($pujari->accountNumber); ?>">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">IFSC Code</label>
                    <input type="text" name="ifscCode" class="form-control" value="<?php echo e($pujari->ifscCode); ?>">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Account Type</label>
                    <select name="accountType" class="form-select">
                        <option value="Saving"  <?php echo e(($pujari->accountType ?? '') == 'Saving'  ? 'selected' : ''); ?>>Saving</option>
                        <option value="Current" <?php echo e(($pujari->accountType ?? '') == 'Current' ? 'selected' : ''); ?>>Current</option>
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">UPI ID</label>
                    <input type="text" name="upi" class="form-control" value="<?php echo e($pujari->upi); ?>">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Aadhar No</label>
                    <input type="text" name="aadharNo" class="form-control" value="<?php echo e($pujari->aadharNo); ?>">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">PAN No</label>
                    <input type="text" name="pancardNo" class="form-control" value="<?php echo e($pujari->pancardNo); ?>">
                </div>
            </div>

            
            <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 pb-3 mb-5">
                <i data-lucide="file" class="w-5 h-5 mr-2 text-primary"></i>
                <h3 class="font-medium text-base">Documents <span class="text-slate-500 text-sm font-normal">(leave blank to keep existing)</span></h3>
            </div>
            <div class="grid grid-cols-12 gap-4 mb-6">
                <?php $__currentLoopData = ['aadhar_card' => 'Aadhar Card', 'pan_card' => 'PAN Card', 'certificate' => 'Certificate']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label"><?php echo e($label); ?></label>
                    <?php if($pujari->$field): ?>
                    <div class="mb-1">
                        <a href="<?php echo e(Str::startsWith($pujari->$field,'http') ? $pujari->$field : asset($pujari->$field)); ?>"
                           target="_blank" class="text-primary text-xs flex items-center">
                            <i data-lucide="external-link" class="w-3 h-3 mr-1"></i> View current file
                        </a>
                    </div>
                    <?php endif; ?>
                    <input type="file" name="<?php echo e($field); ?>" class="form-control" accept="image/*,.pdf">
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="flex justify-end gap-2 mt-5 border-t border-slate-200 dark:border-darkmode-400 pt-5">
                <a href="<?php echo e(route('pujari-detail', $pujari->id)); ?>" class="btn btn-secondary w-24">Cancel</a>
                <button type="submit" class="btn btn-warning" id="submitBtn">
                    <i data-lucide="save" class="w-4 h-4 mr-1"></i> Update Pujari
                </button>
            </div>
        </form>
    </div>

<?php $__env->stopSection(); ?>
<script src="https://unpkg.com/lucide@latest"></script>
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

    // Image Preview
    document.getElementById('profileImageInput')?.addEventListener('change', function () {

        const file = this.files[0];

        if (file) {

            const reader = new FileReader();

            reader.onload = function (e) {

                document.getElementById('profilePreview').src = e.target.result;

            };

            reader.readAsDataURL(file);
        }
    });

    // Form Submit
    document.getElementById('editPujariForm')?.addEventListener('submit', function (e) {

        e.preventDefault();

        const form = this;
        const btn = document.getElementById('submitBtn');

        btn.disabled = true;

        btn.innerHTML =
            '<i data-lucide="loader" class="w-4 h-4 mr-1 animate-spin"></i> Updating...';

        lucide.createIcons({ icons: lucide.icons });

        fetch('<?php echo e(route("editPujariApi")); ?>', {

            method: 'POST',

            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Accept': 'application/json'
            },

            body: new FormData(form)

        })
        .then(response => response.json())

        .then(res => {

            btn.disabled = false;

            btn.innerHTML =
                '<i data-lucide="save" class="w-4 h-4 mr-1"></i> Update Pujari';

            lucide.createIcons({ icons: lucide.icons });

            if (res.status == 200) {

                Swal.fire({
                    icon: 'success',
                    title: 'Updated!',
                    text: res.message
                }).then(() => {

                    window.location = '<?php echo e(route("pujaris")); ?>';

                });

            } else {

                let errors = '';

                if (res.error) {

                    Object.keys(res.error).forEach(function (key) {

                        errors += '<li>' + res.error[key] + '</li>';

                    });

                }

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: errors || res.message
                });

            }

        })

        .catch(error => {

            console.error(error);

            btn.disabled = false;

            btn.innerHTML =
                '<i data-lucide="save" class="w-4 h-4 mr-1"></i> Update Pujari';

            lucide.createIcons({ icons: lucide.icons });

            toastr.error('Something went wrong');

        });

    });

});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('../layout/' . $layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/happylifevastu/public_html/resources/views/pages/edit-pujari.blade.php ENDPATH**/ ?>