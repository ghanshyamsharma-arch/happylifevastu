{{--
  ================================================================
  SLOT PICKER \u2014 Add this to pujari-details.blade.php
  Replace Step 2 date/time fields with slot-aware version
  ================================================================
--}}

{{-- STEP 2: Puja Details (Slot-aware version) --}}
<div id="bookStep2" style="display:none;">
    <div class="row">
        <div class="col-12 mb-3">
            <label class="bk-lbl">Preferred Date *</label>
            <input type="date" id="bkDate" class="bk-inp"
                   min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                   onchange="loadSlotsForDate(this.value)">
        </div>

        {{-- SLOT PICKER (shows after date selected) --}}
        <div class="col-12 mb-3" id="slotPickerWrap" style="display:none;">
            <label class="bk-lbl">Available Time Slots *</label>
            <div id="slotPickerLoading" style="font-size:13px;color:#64748b;display:none;">Loading slots...</div>
            <div id="slotGrid" style="display:flex;flex-wrap:wrap;gap:8px;margin-top:6px;"></div>
            <div id="noSlotsMsg" style="display:none;font-size:13px;color:#94a3b8;margin-top:4px;">
                No available slots for this date. You can still enter a custom time below.
            </div>
            <input type="hidden" id="selectedSlotId">
            <input type="hidden" id="selectedSlotLabel">
        </div>

        {{-- Manual time (fallback / when no slots) --}}
        <div class="col-6 mb-3" id="manualTimeWrap">
            <label class="bk-lbl">Custom Time Slot</label>
            <input type="text" id="bkTimeSlot" class="bk-inp" placeholder="e.g. 10:00 AM"
                   oninput="clearSlotSelection()">
        </div>

        <div class="col-6 mb-3">
            <label class="bk-lbl">Puja Name</label>
            <input type="text" id="bkPujaName" class="bk-inp" placeholder="e.g. Satyanarayan Katha">
        </div>
        <div class="col-6 mb-3">
            <label class="bk-lbl">Gotra</label>
            <input type="text" id="bkGotra" class="bk-inp" placeholder="Your gotra">
        </div>
        <div class="col-12 mb-3">
            <label class="bk-lbl">Family Member Names</label>
            <input type="text" id="bkFamilyNames" class="bk-inp" placeholder="Names of participating members">
        </div>
        <div class="col-6 mb-3">
            <label class="bk-lbl">Location</label>
            <select id="bkLocation" class="bk-inp">
                <option value="online">Online (Video Call)</option>
                <option value="at_home">At Home</option>
                <option value="temple">At Temple</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div class="col-6 mb-3">
            <label class="bk-lbl">Address (if at home)</label>
            <input type="text" id="bkAddress" class="bk-inp" placeholder="Full address">
        </div>
        <div class="col-12 mb-3">
            <label class="bk-lbl">Special Requirement</label>
            <textarea id="bkSpecial" class="bk-inp" rows="2"
                      placeholder="Any special requests..."></textarea>
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <button onclick="goStep(1)" class="bk-btn-secondary">\u2190 Back</button>
        <button onclick="goStep(3)" class="bk-btn-primary">Next \u2192</button>
    </div>
</div>

{{-- \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
     SLOT PICKER JAVASCRIPT \u2014 Add inside <script> in pujari-details
\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500 --}}
<script>
// \u2500\u2500 Load available slots for a selected date \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
function loadSlotsForDate(date) {
    if (!date) return;

    const grid    = document.getElementById('slotGrid');
    const loading = document.getElementById('slotPickerLoading');
    const wrap    = document.getElementById('slotPickerWrap');
    const noMsg   = document.getElementById('noSlotsMsg');

    grid.innerHTML = '';
    noMsg.style.display  = 'none';
    loading.style.display = '';
    wrap.style.display    = '';

    // Reset selection
    document.getElementById('selectedSlotId').value    = '';
    document.getElementById('selectedSlotLabel').value = '';

    fetch(`/pujari/slots-for-date?pujariId={{ $pujari->id }}&date=${date}`, {
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    })
    .then(r => r.json())
    .then(res => {
        loading.style.display = 'none';
        if (res.status == 200 && res.slots.length > 0) {
            res.slots.forEach(slot => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.dataset.slotId    = slot.id;
                btn.dataset.slotLabel = slot.label;

                if (!slot.available) {
                    btn.innerHTML = `${slot.label}<br><small style="font-size:10px;">Full</small>`;
                    btn.style.cssText = 'padding:8px 14px;border-radius:8px;border:1.5px solid #e2e8f0;background:#f8fafc;color:#94a3b8;font-size:12px;cursor:not-allowed;text-align:center;';
                    btn.disabled = true;
                } else {
                    btn.innerHTML = `${slot.label}${slot.remaining < slot.available ? `<br><small style="font-size:10px;color:#16a34a;">${slot.remaining} left</small>` : ''}`;
                    btn.style.cssText = 'padding:8px 14px;border-radius:8px;border:1.5px solid #e2e8f0;background:white;color:#1e293b;font-size:12px;cursor:pointer;transition:.15s;text-align:center;';
                    if (slot.note) btn.title = slot.note;

                    btn.onclick = function () {
                        // Reset all slot buttons
                        document.querySelectorAll('.slot-option').forEach(b => {
                            b.style.background   = 'white';
                            b.style.borderColor  = '#e2e8f0';
                            b.style.color        = '#1e293b';
                        });
                        // Highlight selected
                        this.style.background  = '#ee4e5e';
                        this.style.borderColor = '#ee4e5e';
                        this.style.color       = 'white';

                        document.getElementById('selectedSlotId').value    = this.dataset.slotId;
                        document.getElementById('selectedSlotLabel').value = this.dataset.slotLabel;
                        document.getElementById('bkTimeSlot').value        = '';  // clear manual
                    };
                    btn.classList.add('slot-option');
                }

                grid.appendChild(btn);
            });
        } else {
            noMsg.style.display = '';
        }
    })
    .catch(() => {
        loading.style.display = 'none';
        noMsg.style.display   = '';
    });
}

function clearSlotSelection() {
    document.getElementById('selectedSlotId').value    = '';
    document.getElementById('selectedSlotLabel').value = '';
    document.querySelectorAll('.slot-option').forEach(b => {
        b.style.background  = 'white';
        b.style.borderColor = '#e2e8f0';
        b.style.color       = '#1e293b';
    });
}

// \u2500\u2500 Override goStep to validate slot in step 2 \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
const _originalGoStep = typeof goStep === 'function' ? goStep : null;

function goStep(step) {
    if (step === 3) {
        const date     = document.getElementById('bkDate').value;
        const slotId   = document.getElementById('selectedSlotId').value;
        const timeFree = document.getElementById('bkTimeSlot').value.trim();

        if (!date) { alert('Please select a preferred date'); return; }
        if (!slotId && !timeFree) {
            alert('Please select an available slot or enter a custom time'); return;
        }

        // Fill summary
        document.getElementById('sumName').textContent     = document.getElementById('bkName').value;
        document.getElementById('sumContact').textContent  = document.getElementById('bkContact').value;
        document.getElementById('sumDate').textContent     = date;
        document.getElementById('sumPuja').textContent     = document.getElementById('bkPujaName').value || 'General Session';
        document.getElementById('sumLocation').textContent = document.getElementById('bkLocation').value;

        // Show selected slot in summary
        const slotLabel = document.getElementById('selectedSlotLabel').value || timeFree;
        document.getElementById('sumTime').textContent = slotLabel;
    }

    [1,2,3].forEach(s => {
        document.getElementById('bookStep' + s).style.display = s === step ? 'block' : 'none';
        const ind = document.getElementById('step' + s + 'ind');
        if (ind) {
            ind.style.borderBottomColor = s === step ? '#ee4e5e' : '#e2e8f0';
            ind.style.color = s === step ? '#ee4e5e' : '#94a3b8';
        }
    });
}

// \u2500\u2500 Override confirmBooking to include slotId \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
function confirmBooking() {
    const btn = document.getElementById('confirmBtn');
    btn.disabled = true; btn.textContent = 'Confirming...';
    document.getElementById('bkErrorMsg').style.display = 'none';

    const slotId = document.getElementById('selectedSlotId').value;

    fetch('{{ route("front.pujariPlaceBooking") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({
            pujariId:           {{ $pujari->id }},
            slotId:             slotId || null,
            personName:         document.getElementById('bkName').value,
            personContact:      document.getElementById('bkContact').value,
            personEmail:        document.getElementById('bkEmail').value,
            bookingDate:        document.getElementById('bkDate').value,
            timeSlot:           document.getElementById('selectedSlotLabel').value || document.getElementById('bkTimeSlot').value,
            pujaName:           document.getElementById('bkPujaName').value,
            gotra:              document.getElementById('bkGotra').value,
            familyMemberNames:  document.getElementById('bkFamilyNames').value,
            location:           document.getElementById('bkLocation').value,
            address:            document.getElementById('bkAddress').value,
            specialRequirement: document.getElementById('bkSpecial').value,
            paymentMode:        document.getElementById('bkPayMode').value,
            amount:             {{ $pujari->reportRate }},
        })
    })
    .then(r => r.json())
    .then(res => {
        if (res.status == 401) { window.location.href = res.redirect || '{{ route("front.login") }}'; return; }
        if (res.status == 200) {
            document.getElementById('bkSuccessMsg').style.display = '';
            document.getElementById('bkSuccessMsg').textContent = '\u2705 ' + res.message;
            const el = document.getElementById('totalBookingCount');
            if (el) el.textContent = parseInt(el.textContent) + 1;
            btn.textContent = '\u2713 Booked!';
            setTimeout(() => closeBookingModal(), 2500);
        } else {
            document.getElementById('bkErrorMsg').style.display = '';
            document.getElementById('bkErrorMsg').textContent = res.message || 'Something went wrong';
            btn.disabled = false; btn.textContent = '\u2713 Confirm Booking';
        }
    })
    .catch(() => {
        document.getElementById('bkErrorMsg').style.display = '';
        document.getElementById('bkErrorMsg').textContent = 'Network error. Please try again.';
        btn.disabled = false; btn.textContent = '\u2713 Confirm Booking';
    });
}
</script>