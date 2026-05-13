

<?php $__env->startSection('subhead'); ?>
    <title>Pujari Slots</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subcontent'); ?>
<div class="loader"></div>

<div class="flex items-center mt-8">
    <h2 class="intro-y text-lg font-medium mr-auto">Manage Pujari Slots</h2>
    <button onclick="openAddModal()"
            class="btn btn-primary shadow-md ml-3">
        <i data-lucide="plus" class="w-4 h-4 mr-1"></i> Add Slot
    </button>
</div>


<div class="intro-y flex flex-wrap items-center gap-3 mt-5">
    <form action="<?php echo e(route('pujariSlots')); ?>" method="POST" class="flex flex-wrap gap-2 items-center">
        <?php echo csrf_field(); ?>
        <div class="relative w-44 text-slate-500">
            <input type="text" name="searchString" value="<?php echo e($searchString ?? ''); ?>"
                   class="form-control w-44 box pr-10" placeholder="Search pujari...">
            <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
        </div>
        <select name="pujariId" class="form-select w-40 box">
            <option value="">All Pujaris</option>
            <?php $__currentLoopData = $pujaris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($p->id); ?>" <?php echo e(($pujariId ?? '') == $p->id ? 'selected' : ''); ?>><?php echo e($p->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <select name="dayType" class="form-select w-36 box">
            <option value="">All Types</option>
            <option value="specific"  <?php echo e(($dayType ?? '') == 'specific'  ? 'selected' : ''); ?>>Specific Date</option>
            <option value="recurring" <?php echo e(($dayType ?? '') == 'recurring' ? 'selected' : ''); ?>>Recurring</option>
        </select>
        <select name="status" class="form-select w-32 box">
            <option value="">All Status</option>
            <option value="active"   <?php echo e(($status ?? '') == 'active'   ? 'selected' : ''); ?>>Active</option>
            <option value="inactive" <?php echo e(($status ?? '') == 'inactive' ? 'selected' : ''); ?>>Inactive</option>
            <option value="full"     <?php echo e(($status ?? '') == 'full'     ? 'selected' : ''); ?>>Full</option>
        </select>
        <button class="btn btn-primary shadow-md">Filter</button>
        <a href="<?php echo e(route('pujariSlots')); ?>" class="btn btn-secondary">
            <i data-lucide="x" class="w-4 h-4 mr-1"></i> Clear
        </a>
    </form>
</div>

<?php if(isset($totalRecords) && $totalRecords > 0): ?>
<div class="intro-y col-span-12 overflow-auto lg:overflow-visible mt-5">
    <table class="table table-report -mt-2">
        <thead>
            <tr>
                <th>#</th>
                <th>Pujari</th>
                <th class="text-center">Day / Date</th>
                <th class="text-center">Time</th>
                <th class="text-center">Bookings</th>
                <th class="text-center">Type</th>
                <th class="text-center">Status</th>
                <th class="text-center">Note</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
                $no = 0;
                
            ?>
            <?php $__currentLoopData = $slots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="intro-x" id="slotRow_<?php echo e($slot->id); ?>">
                <td><?php echo e(($page - 1) * 20 + ++$no); ?></td>
                <td>
                    <div class="flex items-center gap-2">
                       <img src="<?php echo e(url('public/' . $slot->pujariImage)); ?>"
     onerror="this.src='<?php echo e(asset('build/assets/images/person.png')); ?>'"
     class="w-8 h-8 rounded-full object-cover">
                            
                        <div>
                            <div class="font-medium whitespace-nowrap"><?php echo e($slot->pujariName); ?></div>
                            <div class="text-slate-500 text-xs"><?php echo e($slot->pujariContact); ?></div>
                        </div>
                    </div>
                </td>
                <td class="text-center">
                    <?php if($slot->dayType === 'recurring'): ?>
                        <span class="font-medium"><?php echo e($days[$slot->dayOfWeek] ?? '--'); ?></span>
                        <div class="text-slate-400 text-xs">Every week</div>
                    <?php else: ?>
                        <span class="font-medium"><?php echo e($slot->slotDate ? \Carbon\Carbon::parse($slot->slotDate)->format('d M Y') : '--'); ?></span>
                    <?php endif; ?>
                </td>
                <td class="text-center font-medium">
                    <?php echo e(date('h:i A', strtotime($slot->startTime))); ?> -
                    <?php echo e(date('h:i A', strtotime($slot->endTime))); ?>

                </td>
                <td class="text-center">
                    <div class="font-medium"><?php echo e($slot->bookedCount); ?>/<?php echo e($slot->maxBookings); ?></div>
                    <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                        <?php $pct = $slot->maxBookings > 0 ? round(($slot->bookedCount / $slot->maxBookings) * 100) : 0; ?>
                        <div class="h-1.5 rounded-full <?php echo e($pct >= 100 ? 'bg-red-500' : ($pct >= 70 ? 'bg-yellow-400' : 'bg-green-500')); ?>"
                             style="width:<?php echo e($pct); ?>%"></div>
                    </div>
                </td>
                <td class="text-center">
                    <span class="px-2 py-0.5 rounded text-xs font-semibold
                        <?php echo e($slot->dayType === 'recurring' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700'); ?>">
                        <?php echo e($slot->dayType === 'recurring' ? 'Recurring' : 'Specific'); ?>

                    </span>
                </td>
                <td class="text-center">
                    <button onclick="toggleSlotStatus(<?php echo e($slot->id); ?>, this)"
                            class="btn btn-sm <?php echo e($slot->status === 'active' ? 'btn-success' : ($slot->status === 'full' ? 'btn-warning' : 'btn-danger')); ?> py-1 px-3"
                            data-status="<?php echo e($slot->status); ?>"
                            <?php echo e($slot->status === 'full' ? 'disabled' : ''); ?>>
                        <?php echo e(ucfirst($slot->status)); ?>

                    </button>
                </td>
                <td class="text-center text-slate-500 text-xs"><?php echo e($slot->note ?? '--'); ?></td>
                <td class="text-center">
                    <div class="flex justify-center gap-2">
                        <button onclick='editSlot(<?php echo json_encode($slot, 15, 512) ?>)'
                                class="btn btn-sm btn-outline-secondary py-1 px-2">
                            <i data-lucide="edit" class="w-4 h-4"></i>
                        </button>
                        <button onclick="deleteSlot(<?php echo e($slot->id); ?>)"
                                class="btn btn-sm btn-danger py-1 px-2">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>


<div class="intro-y flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-3">
    <nav class="w-full sm:w-auto sm:mr-auto">
        <ul class="pagination">
            <?php for($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?php echo e($page == $i ? 'active' : ''); ?>">
                <a class="page-link" href="<?php echo e(route('pujariSlots')); ?>?page=<?php echo e($i); ?>&searchString=<?php echo e($searchString ?? ''); ?>&pujariId=<?php echo e($pujariId ?? ''); ?>&dayType=<?php echo e($dayType ?? ''); ?>&status=<?php echo e($status ?? ''); ?>"><?php echo e($i); ?></a>
            </li>
            <?php endfor; ?>
        </ul>
    </nav>
    <div class="hidden md:block text-slate-500 ml-auto">
        Showing <?php echo e($start ?? 1); ?> to <?php echo e($end ?? $totalRecords); ?> of <?php echo e($totalRecords); ?> entries
    </div>
</div>

<?php else: ?>
<div class="intro-y col-span-12 mt-10">
    <div class="box p-10 text-center">
        <img src="<?php echo e(asset('build/assets/images/nodata.png')); ?>" class="w-24 mx-auto mb-4" onerror="this.style.display='none'">
        <p class="text-slate-500">No slots found. Click <strong>Add Slot</strong> to create one.</p>
    </div>
</div>
<?php endif; ?>


<div id="slotModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:9999;overflow-y:auto;">
    <div style="max-width:480px;margin:40px auto;background:white;border-radius:16px;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,0.2);">
        <div style="background:linear-gradient(135deg,#3b82f6,#1e40af);padding:16px 20px;display:flex;justify-content:space-between;align-items:center;">
            <h5 id="slotModalTitle" style="color:white;font-weight:700;margin:0;">Add Slot</h5>
            <button onclick="closeSlotModal()" style="background:rgba(255,255,255,0.2);border:none;color:white;width:30px;height:30px;border-radius:50%;font-size:18px;cursor:pointer;">×</button>
        </div>
        <div style="padding:24px;">
            <input type="hidden" id="slotId">
            
            <div style="margin-bottom:16px;">
                <label style="font-size:13px;font-weight:600;display:block;margin-bottom:6px;">
                    Select Pujari *
                </label>
            
                <select id="slotPujariId"
                        style="width:100%;padding:10px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;background:white;">
            
                    <option value="">-- Select Pujari --</option>
            
                    <?php $__currentLoopData = $pujaris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pujari): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($pujari->id); ?>">
                            <?php echo e($pujari->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
                </select>
            </div>
            
            <div style="margin-bottom:16px;">
                <label style="font-size:13px;font-weight:600;display:block;margin-bottom:6px;">Slot Type *</label>
                <div style="display:flex;background:#f1f5f9;border-radius:8px;padding:3px;">
                    <button type="button" id="btnRecurring" onclick="switchSlotType('recurring')"
                            style="flex:1;padding:7px;border-radius:6px;border:none;font-size:13px;font-weight:600;cursor:pointer;background:#3b82f6;color:white;">
                        🔁 Recurring
                    </button>
                    <button type="button" id="btnSpecific" onclick="switchSlotType('specific')"
                            style="flex:1;padding:7px;border-radius:6px;border:none;font-size:13px;font-weight:600;cursor:pointer;background:transparent;color:#64748b;">
                        📅 Specific Date
                    </button>
                </div>
            </div>

            
            <div id="dayOfWeekWrap" style="margin-bottom:16px;">
                <label style="font-size:13px;font-weight:600;display:block;margin-bottom:8px;">Select Day *</label>
                <div style="display:flex;gap:6px;flex-wrap:wrap;">
                    <?php $__currentLoopData = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $di => $dn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button type="button" onclick="selectSlotDay(<?php echo e($di); ?>, this)"
                            class="daySelectBtn" data-day="<?php echo e($di); ?>"
                            style="padding:8px 12px;border-radius:8px;border:1.5px solid #e2e8f0;font-size:13px;font-weight:600;cursor:pointer;background:white;color:#64748b;">
                        <?php echo e($dn); ?>

                    </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <input type="hidden" id="slotDayOfWeek">
            </div>

            
            <div id="specificDateWrap" style="display:none;margin-bottom:16px;">
                <label style="font-size:13px;font-weight:600;display:block;margin-bottom:6px;">Date *</label>
                <input type="date" id="slotDate" min="<?php echo e(date('Y-m-d')); ?>"
                       style="width:100%;padding:9px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;">
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px;">
                <div>
                    <label style="font-size:13px;font-weight:600;display:block;margin-bottom:5px;">Start Time *</label>
                    <input type="time" id="slotStart" style="width:100%;padding:9px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;">
                </div>
                <div>
                    <label style="font-size:13px;font-weight:600;display:block;margin-bottom:5px;">End Time *</label>
                    <input type="time" id="slotEnd" style="width:100%;padding:9px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;">
                </div>
                <div>
                    <label style="font-size:13px;font-weight:600;display:block;margin-bottom:5px;">Max Bookings *</label>
                    <input type="number" id="slotMax" value="1" min="1" max="50"
                           style="width:100%;padding:9px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;">
                </div>
                <div>
                    <label style="font-size:13px;font-weight:600;display:block;margin-bottom:5px;">Rate *</label>
                    <input type="number" id="slotRate" value="0" min="0"
                           style="width:100%;padding:9px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;">
                </div>
            </div>

            <div style="margin-bottom:14px;">
                <label style="font-size:13px;font-weight:600;display:block;margin-bottom:5px;">Note (Optional)</label>
                <input type="text" id="slotNote" placeholder="e.g. Online only"
                       style="width:100%;padding:9px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;">
            </div>

            <div id="slotModalError" style="display:none;background:#fef2f2;border:1px solid #fca5a5;color:#dc2626;padding:10px 14px;border-radius:8px;font-size:13px;margin-bottom:12px;"></div>

            <button onclick="saveAdminSlot()" id="saveSlotBtn"
                    style="width:100%;padding:12px;background:linear-gradient(135deg,#3b82f6,#1e40af);color:white;border:none;border-radius:10px;font-size:15px;font-weight:700;cursor:pointer;">
                Save Slot
            </button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    button.swal2-confirm.swal2-styled { background: #28c76f !important; }
    button.swal2-cancel.swal2-styled { background: #6e7881 !important; }
</style>

<script>
window.onload = function () {

    const loader = document.querySelector('.loader');

    if (loader) {
        loader.style.display = 'none';
    }

};

let slotSelectedDay = null;
let slotCurrentType = 'recurring';

function switchSlotType(type) {

    slotCurrentType = type;

    const isRec = type === 'recurring';

    document.getElementById('dayOfWeekWrap').style.display = isRec ? '' : 'none';
    document.getElementById('specificDateWrap').style.display = isRec ? 'none' : '';

    document.getElementById('btnRecurring').style.background = isRec ? '#3b82f6' : 'transparent';
    document.getElementById('btnRecurring').style.color = isRec ? 'white' : '#64748b';

    document.getElementById('btnSpecific').style.background = isRec ? 'transparent' : '#3b82f6';
    document.getElementById('btnSpecific').style.color = isRec ? '#64748b' : 'white';

}

function selectSlotDay(day, btn) {

    document.querySelectorAll('.daySelectBtn').forEach(b => {
        b.style.background = 'white';
        b.style.color = '#64748b';
        b.style.borderColor = '#e2e8f0';
    });

    btn.style.background = '#3b82f6';
    btn.style.color = 'white';
    btn.style.borderColor = '#3b82f6';

    slotSelectedDay = day;

    document.getElementById('slotDayOfWeek').value = day;

}

function openAddModal() {

    document.getElementById('slotModalTitle').textContent = 'Add Slot';

    document.getElementById('slotId').value = '';

    // ADD
    document.getElementById('slotPujariId').value = '';

    document.getElementById('slotStart').value = '';
    document.getElementById('slotEnd').value = '';

    document.getElementById('slotMax').value = 1;

    document.getElementById('slotRate').value = 0;

    document.getElementById('slotNote').value = '';

    document.getElementById('slotDate').value = '';

    document.getElementById('slotModalError').style.display = 'none';

    slotSelectedDay = null;

    document.querySelectorAll('.daySelectBtn').forEach(b => {

        b.style.background = 'white';
        b.style.color = '#64748b';
        b.style.borderColor = '#e2e8f0';

    });

    switchSlotType('recurring');

    document.getElementById('slotModal').style.display = 'block';

    document.body.style.overflow = 'hidden';

}

function editSlot(slot) {

    document.getElementById('slotModalTitle').textContent = 'Edit Slot';

    document.getElementById('slotId').value = slot.id;

    // ADD
    if (slot.pujariId) {
        document.getElementById('slotPujariId').value = slot.pujariId;
    }

    document.getElementById('slotStart').value = slot.startTime;

    document.getElementById('slotEnd').value = slot.endTime;

    document.getElementById('slotMax').value = slot.maxBookings;

    document.getElementById('slotRate').value = slot.rate || 0;

    document.getElementById('slotNote').value = slot.note || '';

    document.getElementById('slotModalError').style.display = 'none';

    if (slot.dayType === 'recurring') {

        switchSlotType('recurring');

        slotSelectedDay = slot.dayOfWeek;

        document.getElementById('slotDayOfWeek').value = slot.dayOfWeek;

        document.querySelectorAll('.daySelectBtn').forEach(b => {

            const active = parseInt(b.dataset.day) === slotSelectedDay;

            b.style.background = active ? '#3b82f6' : 'white';
            b.style.color = active ? 'white' : '#64748b';
            b.style.borderColor = active ? '#3b82f6' : '#e2e8f0';

        });

    } else {

        switchSlotType('specific');

        document.getElementById('slotDate').value = slot.slotDate;

    }

    document.getElementById('slotModal').style.display = 'block';

    document.body.style.overflow = 'hidden';

}

function closeSlotModal() {

    document.getElementById('slotModal').style.display = 'none';

    document.body.style.overflow = '';

}

document.getElementById('slotModal').addEventListener('click', function(e) {

    if (e.target === this) closeSlotModal();

});

function saveAdminSlot() {

    const id = document.getElementById('slotId').value;

    // ADD
    const pujariId = document.getElementById('slotPujariId').value;
    const dayType = slotCurrentType;

    const start = document.getElementById('slotStart').value;

    const end = document.getElementById('slotEnd').value;

    const max = document.getElementById('slotMax').value;

    const rate = document.getElementById('slotRate').value;

    const note = document.getElementById('slotNote').value;

    const errEl = document.getElementById('slotModalError');

    errEl.style.display = 'none';

    // ADD
    if (!pujariId) {

        errEl.textContent = 'Please select a pujari.';

        errEl.style.display = '';

        return;

    }

    if (!start || !end) {

        errEl.textContent = 'Please enter start and end time.';

        errEl.style.display = '';

        return;

    }

    if (start >= end) {

        errEl.textContent = 'End time must be after start time.';

        errEl.style.display = '';

        return;

    }

    // ADD pujariId
    const payload = {
        pujariId,
        dayType,
        startTime: start,
        endTime: end,
        maxBookings: max,
        rate,
        note,
        id
    };

    if (dayType === 'recurring') {

        if (slotSelectedDay === null) {

            errEl.textContent = 'Please select a day.';

            errEl.style.display = '';

            return;

        }

        payload.dayOfWeek = slotSelectedDay;

    } else {

        const d = document.getElementById('slotDate').value;

        if (!d) {

            errEl.textContent = 'Please select a date.';

            errEl.style.display = '';

            return;

        }

        payload.slotDate = d;

    }

    const btn = document.getElementById('saveSlotBtn');

    btn.disabled = true;

    btn.textContent = 'Saving...';

    fetch('<?php echo e(route("addPujariSlot")); ?>', {

        method: 'POST',

        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
        },

        body: JSON.stringify(payload),

    })

    .then(r => r.json())

    .then(res => {

        btn.disabled = false;

        btn.textContent = 'Save Slot';

        if (res.status == 200) {

            closeSlotModal();

            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Slot saved successfully'
            }).then(() => {
                location.reload();
            });

        } else {

            errEl.textContent = res.message;

            errEl.style.display = '';

        }

    })

    .catch(error => {

        btn.disabled = false;

        btn.textContent = 'Save Slot';

        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Server error'
        });

    });

}

function toggleSlotStatus(id, btn) {

    fetch('<?php echo e(route("togglePujariSlotStatus")); ?>', {

        method: 'POST',

        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
        },

        body: JSON.stringify({ id }),

    })

    .then(r => r.json())

    .then(res => {

        if (res.status == 200) {

            btn.dataset.status = res.newStatus;

            btn.textContent = res.newStatus.charAt(0).toUpperCase() + res.newStatus.slice(1);

            btn.className = 'btn btn-sm py-1 px-3 ' +
                (res.newStatus === 'active' ? 'btn-success' : 'btn-danger');

            Swal.fire({
                icon: 'success',
                title: 'Updated',
                text: 'Slot status updated successfully',
                timer: 1500,
                showConfirmButton: false
            });

        }

    });

}

function deleteSlot(id) {

    Swal.fire({

        title: 'Delete this slot?',

        text: 'This cannot be undone.',

        icon: 'error',

        showCancelButton: true,

        confirmButtonText: 'Delete',

        confirmButtonColor: '#d33',

    })

    .then(result => {

        if (!result.isConfirmed) return;

        fetch('<?php echo e(route("deletePujariSlot")); ?>', {

            method: 'POST',

            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },

            body: JSON.stringify({ id }),

        })

        .then(r => r.json())

        .then(res => {

            if (res.status == 200) {

                document.getElementById('slotRow_' + id)?.remove();

                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'Slot deleted successfully'
                });

            }

        });

    });

}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('../layout/' . $layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/happylifevastu/public_html/resources/views/pages/pujari-slots.blade.php ENDPATH**/ ?>