@extends('frontend.layout.master')

@section('content')

<section style="padding: 60px 0; background: #f8fafc;">
    <div style="max-width: 760px; margin: 0 auto; padding: 0 16px;">

        <!-- Pujari Info Card -->
        <div style="background:white; border-radius:16px; padding:20px; display:flex; align-items:center; gap:16px; margin-bottom:24px; box-shadow:0 2px 8px rgba(0,0,0,0.07);">
            <img src="{{ $pujari->profileImage ? (Str::startsWith($pujari->profileImage,'http') ? $pujari->profileImage : str_replace('storage/','public/storage/',asset($pujari->profileImage))) : '/build/assets/images/person.png' }}"
                 onerror="this.onerror=null; this.src='/build/assets/images/person.png';"
                 style="width:64px; height:64px; border-radius:50%; object-fit:cover;">
            <div>
                <h2 style="font-size:18px; font-weight:700; margin-bottom:4px;">Booking for {{ $pujari->name }}</h2>
                <p style="color:#64748b; font-size:14px;">{{ $pujari->primarySkill }} · {{ $pujari->experienceInYears ?? 0 }} yrs exp</p>
                <!--<p style="color:#f97316; font-weight:700; margin-top:4px;">{{ $currency }}</p>-->
                <!--<p style="color:#f97316; font-weight:700; margin-top:4px;">{{ $currency }}<span id="displayRate">{{ number_format($pujari->reportRate, 0) }}</span> / per slot</p>-->
            </div>
        </div>

        <!-- Booking Form -->
        <div style="background:white; border-radius:16px; padding:28px; box-shadow:0 2px 8px rgba(0,0,0,0.07);">
            <h3 style="font-size:18px; font-weight:700; margin-bottom:24px;">Complete Your Booking</h3>

            <input type="hidden" id="pujariId" value="{{ $pujari->id }}">
            <input type="hidden" id="gstPct" value="{{ $gstPct }}">
            <input type="hidden" id="currency" value="{{ $currency }}">

            <!-- Section 1: Available Slots -->
            <div style="margin-bottom:28px;">
                <h4 style="font-size:14px; font-weight:700; color:#f97316; margin-bottom:12px; text-transform:uppercase; letter-spacing:.5px;">Select Date & Time *</h4>
                
                @if($slots && count($slots) > 0)
                    <div id="slotsContainer" style="display:grid; grid-template-columns:1fr; gap:12px; margin-bottom:16px;">
                        @foreach($slots as $slot)
                        <label style="display:flex; align-items:center; padding:14px; border:2px solid #e2e8f0; border-radius:10px; cursor:pointer; transition:all 0.3s;">
                            <input type="radio" name="slotId" value="{{ $slot->id }}" 
                                   data-date="{{ $slot->slotDate }}"
                                   data-time="{{ date('h:i A', strtotime($slot->startTime)) }} – {{ date('h:i A', strtotime($slot->endTime)) }}"
                                   data-rate="{{ $slot->rate }}"
                                   onchange="updateSlot(this)"
                                   style="width:18px; height:18px; cursor:pointer;">
                            <div style="flex:1; margin-left:12px;">
                                <div style="font-weight:600; color:#1f2937;">{{ date('d M, Y', strtotime($slot->slotDate)) }}</div>
                                <div style="font-size:14px; color:#64748b;">{{ date('h:i A', strtotime($slot->startTime)) }} – {{ date('h:i A', strtotime($slot->endTime)) }}</div>
                            </div>
                            <div style="text-align:right;">
                                <div style="font-weight:700; color:#f97316;">{{ $currency }}{{ number_format($slot->rate, 0) }}</div>
                            </div>
                        </label>
                        @endforeach
                    </div>
                @else
                    <div style="padding:20px; background:#fef2f2; border:1px solid #fecaca; border-radius:8px; color:#991b1b;">
                        <strong>⚠️ No slots available</strong><br>
                        <small>This Pujari hasn't created any available slots. Please check back later or contact the Pujari directly.</small>
                    </div>
                @endif
            </div>

            <!-- Section 2: Your Details (Auto-filled if logged in) -->
            <div style="margin-bottom:28px;">
                <h4 style="font-size:14px; font-weight:700; color:#f97316; margin-bottom:12px; text-transform:uppercase; letter-spacing:.5px;">Your Details</h4>
                @php
                    $user = authcheck();
                @endphp
                
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                    
                    <div>
                        <label class="field-label">Full Name *</label>
                        <input type="text" 
                               id="personName" 
                               class="field-input"
                               value="{{ $user->name ?? '' }}"
                               placeholder="Your full name" 
                               required>
                    </div>
                
                    <div>
                        <label class="field-label">Contact Number *</label>
                        <input type="tel" 
                               id="personContact" 
                               class="field-input"
                               value="{{ $user->contactNo ?? '' }}"
                               placeholder="10-digit mobile" 
                               required>
                    </div>
                
                    <div>
                        <label class="field-label">Email</label>
                        <input type="email" 
                               id="personEmail" 
                               class="field-input"
                               value="{{ $user->email ?? '' }}"
                               placeholder="Email address">
                    </div>
                
                </div>
            </div>

            <!-- Section 3: Selected Slot Date & Time (Display Only) -->
            <div style="margin-bottom:28px;">
                <h4 style="font-size:14px; font-weight:700; color:#f97316; margin-bottom:12px; text-transform:uppercase; letter-spacing:.5px;">Booking Date & Time</h4>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                    <div>
                        <label class="field-label">Date</label>
                        <input type="text" id="displayDate" class="field-input" 
                               placeholder="Select slot first" disabled 
                               style="background:#f3f4f6; cursor:not-allowed;">
                    </div>
                    <div>
                        <label class="field-label">Time</label>
                        <input type="text" id="displayTime" class="field-input" 
                               placeholder="Select slot first" disabled 
                               style="background:#f3f4f6; cursor:not-allowed;">
                    </div>
                </div>
            </div>

            <!-- Section 4: Puja Details -->
            <div style="margin-bottom:28px;">
                <h4 style="font-size:14px; font-weight:700; color:#f97316; margin-bottom:12px; text-transform:uppercase; letter-spacing:.5px;">Puja Details</h4>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                    <div>
                        <label class="field-label">Puja Name</label>
                        <input type="text" id="pujaName" class="field-input" placeholder="e.g. Satyanarayan Katha">
                    </div>
                    <div>
                        <label class="field-label">Gotra</label>
                        <input type="text" id="gotra" class="field-input" placeholder="Your gotra">
                    </div>
                    <div style="grid-column: 1/-1;">
                        <label class="field-label">Family Member Names</label>
                        <input type="text" id="familyMemberNames" class="field-input" placeholder="Names of family members participating">
                    </div>
                </div>
            </div>

            <!-- Section 5: Location & Address -->
            <div style="margin-bottom:28px;">
                <h4 style="font-size:14px; font-weight:700; color:#f97316; margin-bottom:12px; text-transform:uppercase; letter-spacing:.5px;">Location</h4>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                    <div>
                        <label class="field-label">Location Type</label>
                        <select id="location" class="field-input" onchange="toggleAddressField()">
                            <!--<option value="online">Online (Video Call)</option>-->
                            <option value="at_home">At Home</option>
                            <option value="temple">At Temple</option>
                            <option value="other">Other Location</option>
                        </select>
                    </div>
                    <div id="addressDiv" style="display:none;">
                        <label class="field-label">Full Address</label>
                        <input type="text" id="address" class="field-input" placeholder="Street, City, State, Zip">
                    </div>
                </div>
            </div>

            <!-- Section 6: Special Requirements -->
            <div style="margin-bottom:28px;">
                <label class="field-label">Special Requirements / Notes</label>
                <textarea id="specialRequirement" class="field-input" 
                          style="resize:vertical; min-height:80px;" 
                          placeholder="Any special requests or requirements for this booking..."></textarea>
            </div>

            <!-- Payment Summary -->
            @php
                $rate = (float) ($pujari->reportRate ?? 0);
                $gstAmount = $rate * ($gstPct / 100);
                 $total = $rate + $gstAmount;
            @endphp
            <div style="background:#f8fafc; border-radius:12px; padding:16px; margin-bottom:24px;">
                <h4 style="font-size:14px; font-weight:700; margin-bottom:12px;">📋 Payment Summary</h4>
                <div style="display:flex; justify-content:space-between; margin-bottom:6px; font-size:14px;">
                    <span style="color:#64748b;">Slot Rate</span>
                    <span id="amountDisplay">{{ $currency }}{{ number_format($rate, 2) }}</span>
                </div>
                
                @if($gstPct > 0)
                <div style="display:flex; justify-content:space-between; margin-bottom:6px; font-size:14px;">
                    <span style="color:#64748b;">GST ({{ $gstPct }}%)</span>
                    <span id="gstDisplay">{{ $currency }}{{ number_format($gstAmount, 2) }}</span>
                </div>
                @endif
                
                <div style="display:flex; justify-content:space-between; font-size:16px; font-weight:700; border-top:1px solid #e2e8f0; padding-top:10px; margin-top:6px;">
                    <span>Total Amount</span>
                    <span id="totalDisplay" style="color:#f97316;">
                        {{ $currency }}{{ number_format($total, 2) }}
                    </span>
                </div>
                <div style="margin-top:12px;">
                    <label class="field-label">Payment Method</label>
                    <select id="paymentMode" class="field-input">
                        <option value="manual">Manual / Bank Transfer</option>
                        <option value="online">Online Payment</option>
                        <option value="cash">Cash on Visit</option>
                    </select>
                </div>
            </div>

            <!-- Terms & CTA -->
            <button onclick="placeBooking()" id="bookBtn"
                    style="width:100%; padding:14px; background:linear-gradient(135deg, #f97316, #dc2626); color:white; border:none; border-radius:10px; font-size:16px; font-weight:700; cursor:pointer; transition:all 0.3s;">
                ✓ Confirm Booking
            </button>

            <!--<p style="text-align:center; font-size:12px; color:#94a3b8; margin-top:12px;">-->
            <!--    <strong>*</strong> We will confirm your booking within 24 hours. You will receive a confirmation SMS/Email.-->
            <!--</p>-->
        </div>
    </div>
</section>

<style>
    .field-label { 
        display: block; 
        font-size: 13px; 
        font-weight: 600; 
        color: #374151; 
        margin-bottom: 6px; 
    }
    
    .field-input { 
        width: 100%; 
        padding: 10px 14px; 
        border: 1.5px solid #e2e8f0; 
        border-radius: 8px; 
        font-size: 14px; 
        font-family: inherit; 
        box-sizing: border-box;
    }
    
    .field-input:focus { 
        outline: none; 
        border-color: #f97316; 
        box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
    }

    input[type="radio"]:checked + label {
        border-color: #f97316 !important;
        background: rgba(249, 115, 22, 0.05) !important;
    }
</style>

<script>
    function toggleAddressField() {
        const location = document.getElementById('location').value;
        const addressDiv = document.getElementById('addressDiv');
        if (location !== 'online') {
            addressDiv.style.display = 'block';
            document.getElementById('address').required = true;
        } else {
            addressDiv.style.display = 'none';
            document.getElementById('address').required = false;
        }
    }

    function updateSlot(radio) {

    const rate = parseFloat(radio.dataset.rate || 0);
    const gstPct = parseFloat(document.getElementById('gstPct').value || 0);
    const currency = document.getElementById('currency').value;

    const slotDate = radio.dataset.date;
    const slotTime = radio.dataset.time;

    // Update date/time
    const dateObj = new Date(slotDate);

    const formattedDate = dateObj.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    });

    document.getElementById('displayDate').value = formattedDate;
    document.getElementById('displayTime').value = slotTime;

    // Amounts
    const gstAmount = gstPct > 0 ? (rate * gstPct / 100) : 0;
    const total = rate + gstAmount;

    // Update UI
    document.getElementById('amountDisplay').textContent =
        currency + formatAmount(rate);

    // check if gst element exists
    const gstDisplay = document.getElementById('gstDisplay');

    if (gstDisplay) {
        gstDisplay.textContent = currency + formatAmount(gstAmount);
    }

    document.getElementById('totalDisplay').textContent =
        currency + formatAmount(total);

    document.getElementById('displayRate').textContent =
        formatAmount(rate);
}

    function formatAmount(amount) {
        return parseFloat(amount).toFixed(2);
    }

    function placeBooking() {
        const slotId = document.querySelector('input[name="slotId"]:checked');
        const personName = document.getElementById('personName').value.trim();
        const personContact = document.getElementById('personContact').value.trim();

        if (!slotId) {
            alert('❌ Please select a date and time slot');
            return;
        }

        if (!personName || !personContact) {
            alert('❌ Please fill all required fields (Name, Contact)');
            return;
        }

        if (personContact.length !== 10 || !/^\d{10}$/.test(personContact)) {
            alert('❌ Please enter a valid 10-digit mobile number');
            return;
        }

        const btn = document.getElementById('bookBtn');
        btn.disabled = true;
        btn.textContent = '⏳ Processing...';

        const rate = parseFloat(slotId.dataset.rate);
        const gstPct = parseFloat(document.getElementById('gstPct').value);
        const gstAmount = gstPct > 0 ? (rate * gstPct / 100) : 0;
        const totalAmount = rate + gstAmount;

        const bookingData = {
            pujariId: document.getElementById('pujariId').value,
            slotId: slotId.value,
            personName: personName,
            personContact: personContact,
            personEmail: document.getElementById('personEmail').value,
            pujaName: document.getElementById('pujaName').value,
            gotra: document.getElementById('gotra').value,
            familyMemberNames: document.getElementById('familyMemberNames').value,
            address: document.getElementById('address').value,
            location: document.getElementById('location').value,
            specialRequirement: document.getElementById('specialRequirement').value,
            paymentMode: document.getElementById('paymentMode').value,
            amount: rate,
            gstAmount: gstAmount,
            totalAmount: totalAmount,
        };

        fetch('{{ route("front.pujariPlaceBooking") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(bookingData)
        })
        .then(r => r.json())
        .then(res => {
            if (res.status === 200) {
                alert('✅ ' + res.message);
                window.location.href = '{{ route("front.pujariList") }}';
            } else if (res.status === 401) {
                alert('⚠️ ' + res.message);
                window.location.href = res.redirect || '{{ route("front.pujariLogin") }}';
            } else {
                alert('❌ ' + (res.message || 'Something went wrong'));
                btn.disabled = false;
                btn.textContent = '✓ Confirm Booking';
            }
        })
        .catch(err => {
            console.error('Error:', err);
            alert('❌ Network error. Please try again.');
            btn.disabled = false;
            btn.textContent = '✓ Confirm Booking';
        });
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        const firstSlot = document.querySelector('input[name="slotId"]');
        if (firstSlot) {
            firstSlot.click();
        }
    });
</script>

@endsection