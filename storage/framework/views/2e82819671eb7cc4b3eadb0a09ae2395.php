

<?php $__env->startSection('subhead'); ?>
    <title>Add Pujari</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subcontent'); ?>

    <div class="loader"></div>

    <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">Add Pujari</h2>
        <a href="<?php echo e(route('pujaris')); ?>" class="btn btn-secondary shadow-md">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i> Back to List
        </a>
    </div>

    <div class="intro-y box p-5 mt-5">
        <form id="addPujariForm" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            
            <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 pb-3 mb-5">
                <i data-lucide="user" class="w-5 h-5 mr-2 text-primary"></i>
                <h3 class="font-medium text-base">Basic Information</h3>
            </div>
            <div class="grid grid-cols-12 gap-4 mb-6">
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Contact No <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <select name="countryCode" class="form-select flex-none w-20">
                            <option value="+91">+91</option>
                            <option value="+1">+1</option>
                            <option value="+44">+44</option>
                        </select>
                        <input type="text" name="contactNo" class="form-control" placeholder="10 digit number" maxlength="10" required>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">WhatsApp No</label>
                    <input type="text" name="whatsappNo" class="form-control" placeholder="WhatsApp number">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Gender <span class="text-danger">*</span></label>
                    <select name="gender" class="form-select" required>
                        <option value="">-- Select --</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Birth Date</label>
                    <input type="date" name="birthDate" class="form-control">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">City</label>
                    <input type="text" name="currentCity" class="form-control" placeholder="Current city">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Profile Image</label>
                    <input type="file" name="profileImage" class="form-control" id="profileImageInput" accept="image/*">
                    <div class="mt-2">
                        <img id="profilePreview" src="/build/assets/images/person.png"
                             class="w-16 h-16 rounded-full object-cover border border-slate-200" style="display:none;">
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
                    <input type="text" name="primarySkill" class="form-control" placeholder="e.g. Vedic Puja, Havan" required>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label class="form-label">All Skills <span class="text-danger">*</span></label>
                    <input type="text" name="allSkill" class="form-control" placeholder="All skill names (comma separated)" required>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Languages Known</label>
                    <input type="text" name="languageKnown" class="form-control" placeholder="e.g. Hindi, Sanskrit">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Experience (Years) <span class="text-danger">*</span></label>
                    <input type="number" name="experienceInYears" class="form-control" placeholder="Years of experience" min="0" required>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Consultation Rate (₹) <span class="text-danger">*</span></label>
                    <input type="number" name="reportRate" class="form-control" placeholder="Per session rate" min="0" required>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Highest Qualification</label>
                    <input type="text" name="highestQualification" class="form-control" placeholder="e.g. Graduate">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Degree</label>
                    <input type="text" name="degree" class="form-control" placeholder="Degree">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">College</label>
                    <input type="text" name="college" class="form-control" placeholder="College name">
                </div>
                <div class="col-span-12">
                    <label class="form-label">Bio / About</label>
                    <textarea name="loginBio" class="form-control" rows="3" placeholder="Brief description about the pujari..."></textarea>
                </div>
            </div>

            
            <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 pb-3 mb-5">
                <i data-lucide="credit-card" class="w-5 h-5 mr-2 text-primary"></i>
                <h3 class="font-medium text-base">Bank Details</h3>
            </div>
            <div class="grid grid-cols-12 gap-4 mb-6">
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Bank Name</label>
                    <input type="text" name="bankName" class="form-control" placeholder="Bank name">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Branch</label>
                    <input type="text" name="bankBranch" class="form-control" placeholder="Branch">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Account Number</label>
                    <input type="text" name="accountNumber" class="form-control" placeholder="Account number">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">IFSC Code</label>
                    <input type="text" name="ifscCode" class="form-control" placeholder="IFSC code">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Account Type</label>
                    <select name="accountType" class="form-select">
                        <option value="">-- Select --</option>
                        <option value="Saving">Saving</option>
                        <option value="Current">Current</option>
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">UPI ID</label>
                    <input type="text" name="upi" class="form-control" placeholder="UPI ID">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Aadhar No</label>
                    <input type="text" name="aadharNo" class="form-control" placeholder="Aadhar number">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">PAN No</label>
                    <input type="text" name="pancardNo" class="form-control" placeholder="PAN number">
                </div>
            </div>

            
            <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 pb-3 mb-5">
                <i data-lucide="file" class="w-5 h-5 mr-2 text-primary"></i>
                <h3 class="font-medium text-base">Documents</h3>
            </div>
            <div class="grid grid-cols-12 gap-4 mb-6">
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Aadhar Card</label>
                    <input type="file" name="aadhar_card" class="form-control" accept="image/*,.pdf">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">PAN Card</label>
                    <input type="file" name="pan_card" class="form-control" accept="image/*,.pdf">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label class="form-label">Certificate</label>
                    <input type="file" name="certificate" class="form-control" accept="image/*,.pdf">
                </div>
            </div>

            <div class="flex justify-end gap-2 mt-5 border-t border-slate-200 dark:border-darkmode-400 pt-5">
                <a href="<?php echo e(route('pujaris')); ?>" class="btn btn-secondary w-24">Cancel</a>
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i data-lucide="save" class="w-4 h-4 mr-1"></i> Save Pujari
                </button>
            </div>
        </form>
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

                const preview = document.getElementById('profilePreview');

                preview.src = e.target.result;
                preview.style.display = 'block';

            };

            reader.readAsDataURL(file);
        }
    });

    // Form Submit
    document.getElementById('addPujariForm')?.addEventListener('submit', function (e) {

        e.preventDefault();

        const form = this;
        const btn = document.getElementById('submitBtn');

        btn.disabled = true;

        btn.innerHTML =
            '<i data-lucide="loader" class="w-4 h-4 mr-1 animate-spin"></i> Saving...';

        lucide.createIcons();

        fetch('<?php echo e(route("addPujariApi")); ?>', {

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
                '<i data-lucide="save" class="w-4 h-4 mr-1"></i> Save Pujari';

            lucide.createIcons();

            if (res.status == 200) {

                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
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
                '<i data-lucide="save" class="w-4 h-4 mr-1"></i> Save Pujari';

            lucide.createIcons();

            toastr.error('Something went wrong');

        });

    });

});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('../layout/' . $layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/happylifevastu/public_html/resources/views/pages/add-pujari.blade.php ENDPATH**/ ?>