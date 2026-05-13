

<?php $__env->startSection('subhead'); ?>
    <title>Pujari Detail - <?php echo e($pujari->name); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subcontent'); ?>

<div class="loader"></div>

<div class="flex items-center mt-8">
    <h2 class="intro-y text-lg font-medium mr-auto">Pujari Detail</h2>
    <div class="flex gap-2">
        <a href="<?php echo e(route('edit-pujari', $pujari->id)); ?>" class="btn btn-warning shadow-md">
            <i data-lucide="edit-2" class="w-4 h-4 mr-1"></i> Edit
        </a>
        <a href="<?php echo e(route('pujaris')); ?>" class="btn btn-secondary shadow-md">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i> Back
        </a>
    </div>
</div>

<div class="intro-y grid grid-cols-12 gap-5 mt-5">

    
    <div class="col-span-12 lg:col-span-4">
        <div class="intro-y box p-5">
            <div class="text-center pb-5 border-b border-slate-200 dark:border-darkmode-400">
                <div class="w-24 h-24 rounded-full overflow-hidden mx-auto mb-3 image-fit">
                    <img src="<?php echo e(Str::startsWith($pujari->profileImage ?? '', ['http://','https://']) ? $pujari->profileImage : '/' . ($pujari->profileImage ?? '')); ?>"
                         onerror="this.src='/build/assets/images/person.png';"
                         class="w-full h-full object-cover">
                </div>
                <h3 class="font-medium text-base"><?php echo e($pujari->name); ?></h3>
                <p class="text-slate-500 mt-1 text-sm"><?php echo e($pujari->primarySkill); ?></p>
                <p class="text-slate-500 text-xs mt-1">
                    <i data-lucide="map-pin" class="w-3 h-3 inline mr-1"></i>
                    <?php echo e($pujari->currentCity ?? 'N/A'); ?>

                </p>
                <div class="mt-2 flex justify-center gap-2">
                    <span class="px-2 py-1 rounded text-xs <?php echo e($pujari->isVerified ? 'bg-success/10 text-success' : 'bg-warning/10 text-warning'); ?>">
                        <?php echo e($pujari->isVerified ? 'Verified' : 'Pending'); ?>

                    </span>
                    <span class="px-2 py-1 rounded text-xs <?php echo e($pujari->isActive ? 'bg-primary/10 text-primary' : 'bg-slate-200 text-slate-500'); ?>">
                        <?php echo e($pujari->isActive ? 'Active' : 'Inactive'); ?>

                    </span>
                </div>
            </div>

            <div class="flex text-center mt-4">
                <div class="flex-1 border-r border-slate-200 dark:border-darkmode-400">
                    <div class="font-medium text-base"><?php echo e($pujari->experienceInYears ?? 0); ?></div>
                    <div class="text-slate-500 text-xs mt-1">Yrs Exp</div>
                </div>
                <div class="flex-1 border-r border-slate-200 dark:border-darkmode-400">
                    <div class="font-medium text-base"><?php echo e($pujari->totalOrder ?? 0); ?></div>
                    <div class="text-slate-500 text-xs mt-1">Pujas Done</div>
                </div>
                <div class="flex-1">
                    <div class="font-medium text-base">
                        <?php echo e($currency->value ?? '\u20b9'); ?><?php echo e(number_format($pujari->reportRate, 0)); ?>

                    </div>
                    <div class="text-slate-500 text-xs mt-1">Rate/Session</div>
                </div>
            </div>

            <div class="mt-5 flex flex-col gap-2">
                <?php if(!$pujari->isVerified): ?>
                <button class="btn btn-success w-full approvePujari" data-id="<?php echo e($pujari->id); ?>">
                    <i data-lucide="check" class="w-4 h-4 mr-1"></i> Approve Pujari
                </button>
                <?php endif; ?>
                <button class="btn btn-danger w-full deletePujari" data-id="<?php echo e($pujari->id); ?>">
                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete Pujari
                </button>
                <button class="btn btn-<?php echo e($pujari->isActive ? 'danger' : 'success'); ?> w-full toggleBlockPujari"
                    data-id="<?php echo e($pujari->id); ?>" data-active="<?php echo e($pujari->isActive); ?>">
                    <i data-lucide="<?php echo e($pujari->isActive ? 'slash' : 'check-circle'); ?>" class="w-4 h-4 mr-1"></i>
                    <?php echo e($pujari->isActive ? 'Block Pujari' : 'Unblock Pujari'); ?>

                </button>
            </div>
        </div>
    </div>

    
    <div class="col-span-12 lg:col-span-8">

        
        <div class="intro-y box p-5 mb-5">
            <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 pb-3 mb-4">
                <i data-lucide="user" class="w-5 h-5 mr-2 text-primary"></i>
                <h3 class="font-medium text-base">Personal Information</h3>
            </div>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><span class="text-slate-500 block">Full Name</span><span class="font-medium"><?php echo e($pujari->name); ?></span></div>
                <div><span class="text-slate-500 block">Email</span><span class="font-medium"><?php echo e($pujari->email); ?></span></div>
                <div><span class="text-slate-500 block">Contact</span><span class="font-medium"><?php echo e($pujari->countryCode ?? ''); ?> <?php echo e($pujari->contactNo); ?></span></div>
                <div><span class="text-slate-500 block">WhatsApp</span><span class="font-medium"><?php echo e($pujari->whatsappNo ?? '-'); ?></span></div>
                <div><span class="text-slate-500 block">Gender</span><span class="font-medium"><?php echo e(ucfirst($pujari->gender ?? '-')); ?></span></div>
                <div><span class="text-slate-500 block">Birth Date</span><span class="font-medium"><?php echo e($pujari->birthDate ? \Carbon\Carbon::parse($pujari->birthDate)->format('d M Y') : '-'); ?></span></div>
                <div><span class="text-slate-500 block">City</span><span class="font-medium"><?php echo e($pujari->currentCity ?? '-'); ?></span></div>
                <div><span class="text-slate-500 block">Country</span><span class="font-medium"><?php echo e(ucfirst($pujari->country ?? '-')); ?></span></div>
            </div>
        </div>

        
        <div class="intro-y box p-5 mb-5">
            <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 pb-3 mb-4">
                <i data-lucide="briefcase" class="w-5 h-5 mr-2 text-primary"></i>
                <h3 class="font-medium text-base">Professional Details</h3>
            </div>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><span class="text-slate-500 block">Primary Skill</span><span class="font-medium"><?php echo e($pujari->primarySkill ?? '-'); ?></span></div>
                <div><span class="text-slate-500 block">All Skills</span><span class="font-medium"><?php echo e($pujari->allSkill ?? '-'); ?></span></div>
                <div><span class="text-slate-500 block">Languages</span><span class="font-medium"><?php echo e($pujari->languageKnown ?? '-'); ?></span></div>
                <div><span class="text-slate-500 block">Experience</span><span class="font-medium"><?php echo e($pujari->experienceInYears ?? '-'); ?> Years</span></div>
                <div><span class="text-slate-500 block">Qualification</span><span class="font-medium"><?php echo e($pujari->highestQualification ?? '-'); ?></span></div>
                <div><span class="text-slate-500 block">Rate</span><span class="font-medium text-primary"><?php echo e($currency->value ?? '\u20b9'); ?><?php echo e(number_format($pujari->reportRate, 0)); ?> / session</span></div>
            </div>
            <?php if($pujari->loginBio): ?>
            <div class="mt-4 pt-4 border-t border-slate-200">
                <span class="text-slate-500 text-sm block mb-1">Bio</span>
                <p class="text-sm"><?php echo e($pujari->loginBio); ?></p>
            </div>
            <?php endif; ?>
        </div>

        
        

        
        <div class="intro-y box p-5 mb-5">
            <div class="flex items-center border-b border-slate-200 pb-3 mb-4">
                <i data-lucide="credit-card" class="w-5 h-5 mr-2 text-primary"></i>
                <h3 class="font-medium text-base">Bank Details</h3>
            </div>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><span class="text-slate-500 block">Bank Name</span><span class="font-medium"><?php echo e($pujari->bankName ?? '-'); ?></span></div>
                <div><span class="text-slate-500 block">Branch</span><span class="font-medium"><?php echo e($pujari->bankBranch ?? '-'); ?></span></div>
                <div><span class="text-slate-500 block">Account Number</span><span class="font-medium"><?php echo e($pujari->accountNumber ?? '-'); ?></span></div>
                <div><span class="text-slate-500 block">IFSC Code</span><span class="font-medium"><?php echo e($pujari->ifscCode ?? '-'); ?></span></div>
                <div><span class="text-slate-500 block">Account Type</span><span class="font-medium"><?php echo e($pujari->accountType ?? '-'); ?></span></div>
                <div><span class="text-slate-500 block">UPI ID</span><span class="font-medium"><?php echo e($pujari->upi ?? '-'); ?></span></div>
            </div>
        </div>

        
        <div class="intro-y box p-5">
            <div class="flex items-center border-b border-slate-200 pb-3 mb-4">
                <i data-lucide="file-text" class="w-5 h-5 mr-2 text-primary"></i>
                <h3 class="font-medium text-base">Documents</h3>
            </div>
            <div class="grid grid-cols-3 gap-4 text-center text-sm">
                <?php $__currentLoopData = ['aadhar_card' => 'Aadhar Card', 'pan_card' => 'PAN Card', 'certificate' => 'Certificate']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div>
                    <span class="text-slate-500 block mb-2"><?php echo e($label); ?></span>
                    <?php if($pujari->$field): ?>
                    <a href="<?php echo e(Str::startsWith($pujari->$field,'http') ? $pujari->$field : asset($pujari->$field)); ?>" target="_blank">
                        <img src="<?php echo e(Str::startsWith($pujari->$field,'http') ? $pujari->$field : asset($pujari->$field)); ?>"
                             onerror="this.src='/build/assets/images/person.png';"
                             class="w-20 h-20 object-cover rounded mx-auto border border-slate-200">
                    </a>
                    <?php else: ?>
                    <span class="text-slate-400 text-xs">Not uploaded</span>
                    <?php endif; ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
    if (loader) loader.style.display = 'none';
});

function showToast(type, msg) {
    typeof toastr !== 'undefined' ? toastr[type](msg) : alert(msg);
}

// \u2500\u2500 Approve / Reject puja \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
function approvePuja(pujaId, status) {
   
}

// \u2500\u2500 Approve Pujari \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
document.addEventListener('click', function(e) {
    if (e.target.closest('.approvePujari')) {
        const id = e.target.closest('.approvePujari').dataset.id;
        Swal.fire({ title:'Approve this Pujari?', icon:'success', showCancelButton:true, confirmButtonColor:'#28c76f', confirmButtonText:'Yes, Approve' })
        .then(result => {
            if (!result.isConfirmed) return;
            fetch('<?php echo e(route("verifiedPujariApi")); ?>', {
                method:'POST',
                headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>'},
                body: JSON.stringify({ id, isVerified: 1 })
            }).then(r=>r.json()).then(res => {
                if (res.status == 200) { showToast('success','Pujari approved!'); setTimeout(()=>location.reload(),1000); }
                else showToast('error', res.message);
            });
        });
    }
    if (e.target.closest('.deletePujari')) {
        const id = e.target.closest('.deletePujari').dataset.id;
        Swal.fire({ title:'Delete this Pujari?', icon:'error', showCancelButton:true, confirmButtonColor:'#ea5455', confirmButtonText:'Yes, delete' })
        .then(result => {
            if (!result.isConfirmed) return;
            fetch('<?php echo e(route("deletePujari")); ?>', {
                method:'DELETE',
                headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>'},
                body: JSON.stringify({ id })
            }).then(r=>r.json()).then(res => {
                if (res.status == 200) Swal.fire('Deleted!','','success').then(()=> window.location='<?php echo e(route("pujaris")); ?>');
                else showToast('error', res.message);
            });
        });
    }
});

// \u2500\u2500 Block / Unblock \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
document.querySelectorAll('.toggleBlockPujari').forEach(btn => {
    btn.addEventListener('click', function() {
        const id = this.dataset.id, active = this.dataset.active;
        const action = active == 1 ? 'Block' : 'Unblock';
        Swal.fire({ title: action+' this Pujari?', icon:'error', showCancelButton:true, confirmButtonColor: active==1?'#ea5455':'#28c76f', confirmButtonText:'Yes, '+action })
        .then(result => {
            if (!result.isConfirmed) return;
            fetch('<?php echo e(route("toggleBlockPujari")); ?>', {
                method:'POST',
                headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>'},
                body: JSON.stringify({ pujariId: id, userId: <?php echo e(auth()->id()); ?> })
            }).then(r=>r.json()).then(res => {
                if (res.status==200) { toastr.success(res.message); setTimeout(()=>location.reload(),800); }
                else toastr.error(res.message);
            });
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<style>
.swal2-actions .swal2-confirm { background-color:#28c76f !important; color:#fff !important; border-radius:6px !important; padding:8px 20px !important; font-weight:600; }
.swal2-actions .swal2-deny   { background-color:#ea5455 !important; color:#fff !important; border-radius:6px !important; }
.swal2-actions .swal2-cancel { background-color:#6c757d !important; color:#fff !important; border-radius:6px !important; }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('../layout/' . $layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/happylifevastu/public_html/resources/views/pages/pujari-detail.blade.php ENDPATH**/ ?>