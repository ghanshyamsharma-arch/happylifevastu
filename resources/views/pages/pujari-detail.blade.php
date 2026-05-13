@extends('../layout/' . $layout)

@section('subhead')
    <title>Pujari Detail - {{ $pujari->name }}</title>
@endsection

@section('subcontent')

<div class="loader"></div>

<div class="flex items-center mt-8">
    <h2 class="intro-y text-lg font-medium mr-auto">Pujari Detail</h2>
    <div class="flex gap-2">
        <a href="{{ route('edit-pujari', $pujari->id) }}" class="btn btn-warning shadow-md">
            <i data-lucide="edit-2" class="w-4 h-4 mr-1"></i> Edit
        </a>
        <a href="{{ route('pujaris') }}" class="btn btn-secondary shadow-md">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i> Back
        </a>
    </div>
</div>

<div class="intro-y grid grid-cols-12 gap-5 mt-5">

    {{-- \u2500\u2500 Left: Profile Card \u2500\u2500 --}}
    <div class="col-span-12 lg:col-span-4">
        <div class="intro-y box p-5">
            <div class="text-center pb-5 border-b border-slate-200 dark:border-darkmode-400">
                <div class="w-24 h-24 rounded-full overflow-hidden mx-auto mb-3 image-fit">
                    <img src="{{ Str::startsWith($pujari->profileImage ?? '', ['http://','https://']) ? $pujari->profileImage : '/' . ($pujari->profileImage ?? '') }}"
                         onerror="this.src='/build/assets/images/person.png';"
                         class="w-full h-full object-cover">
                </div>
                <h3 class="font-medium text-base">{{ $pujari->name }}</h3>
                <p class="text-slate-500 mt-1 text-sm">{{ $pujari->primarySkill }}</p>
                <p class="text-slate-500 text-xs mt-1">
                    <i data-lucide="map-pin" class="w-3 h-3 inline mr-1"></i>
                    {{ $pujari->currentCity ?? 'N/A' }}
                </p>
                <div class="mt-2 flex justify-center gap-2">
                    <span class="px-2 py-1 rounded text-xs {{ $pujari->isVerified ? 'bg-success/10 text-success' : 'bg-warning/10 text-warning' }}">
                        {{ $pujari->isVerified ? 'Verified' : 'Pending' }}
                    </span>
                    <span class="px-2 py-1 rounded text-xs {{ $pujari->isActive ? 'bg-primary/10 text-primary' : 'bg-slate-200 text-slate-500' }}">
                        {{ $pujari->isActive ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>

            <div class="flex text-center mt-4">
                <div class="flex-1 border-r border-slate-200 dark:border-darkmode-400">
                    <div class="font-medium text-base">{{ $pujari->experienceInYears ?? 0 }}</div>
                    <div class="text-slate-500 text-xs mt-1">Yrs Exp</div>
                </div>
                <div class="flex-1 border-r border-slate-200 dark:border-darkmode-400">
                    <div class="font-medium text-base">{{ $pujari->totalOrder ?? 0 }}</div>
                    <div class="text-slate-500 text-xs mt-1">Pujas Done</div>
                </div>
                <div class="flex-1">
                    <div class="font-medium text-base">
                        {{ $currency->value ?? '\u20b9' }}{{ number_format($pujari->reportRate, 0) }}
                    </div>
                    <div class="text-slate-500 text-xs mt-1">Rate/Session</div>
                </div>
            </div>

            <div class="mt-5 flex flex-col gap-2">
                @if(!$pujari->isVerified)
                <button class="btn btn-success w-full approvePujari" data-id="{{ $pujari->id }}">
                    <i data-lucide="check" class="w-4 h-4 mr-1"></i> Approve Pujari
                </button>
                @endif
                <button class="btn btn-danger w-full deletePujari" data-id="{{ $pujari->id }}">
                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete Pujari
                </button>
                <button class="btn btn-{{ $pujari->isActive ? 'danger' : 'success' }} w-full toggleBlockPujari"
                    data-id="{{ $pujari->id }}" data-active="{{ $pujari->isActive }}">
                    <i data-lucide="{{ $pujari->isActive ? 'slash' : 'check-circle' }}" class="w-4 h-4 mr-1"></i>
                    {{ $pujari->isActive ? 'Block Pujari' : 'Unblock Pujari' }}
                </button>
            </div>
        </div>
    </div>

    {{-- \u2500\u2500 Right: Details \u2500\u2500 --}}
    <div class="col-span-12 lg:col-span-8">

        {{-- Personal Info --}}
        <div class="intro-y box p-5 mb-5">
            <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 pb-3 mb-4">
                <i data-lucide="user" class="w-5 h-5 mr-2 text-primary"></i>
                <h3 class="font-medium text-base">Personal Information</h3>
            </div>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><span class="text-slate-500 block">Full Name</span><span class="font-medium">{{ $pujari->name }}</span></div>
                <div><span class="text-slate-500 block">Email</span><span class="font-medium">{{ $pujari->email }}</span></div>
                <div><span class="text-slate-500 block">Contact</span><span class="font-medium">{{ $pujari->countryCode ?? '' }} {{ $pujari->contactNo }}</span></div>
                <div><span class="text-slate-500 block">WhatsApp</span><span class="font-medium">{{ $pujari->whatsappNo ?? '-' }}</span></div>
                <div><span class="text-slate-500 block">Gender</span><span class="font-medium">{{ ucfirst($pujari->gender ?? '-') }}</span></div>
                <div><span class="text-slate-500 block">Birth Date</span><span class="font-medium">{{ $pujari->birthDate ? \Carbon\Carbon::parse($pujari->birthDate)->format('d M Y') : '-' }}</span></div>
                <div><span class="text-slate-500 block">City</span><span class="font-medium">{{ $pujari->currentCity ?? '-' }}</span></div>
                <div><span class="text-slate-500 block">Country</span><span class="font-medium">{{ ucfirst($pujari->country ?? '-') }}</span></div>
            </div>
        </div>

        {{-- Professional Info --}}
        <div class="intro-y box p-5 mb-5">
            <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 pb-3 mb-4">
                <i data-lucide="briefcase" class="w-5 h-5 mr-2 text-primary"></i>
                <h3 class="font-medium text-base">Professional Details</h3>
            </div>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><span class="text-slate-500 block">Primary Skill</span><span class="font-medium">{{ $pujari->primarySkill ?? '-' }}</span></div>
                <div><span class="text-slate-500 block">All Skills</span><span class="font-medium">{{ $pujari->allSkill ?? '-' }}</span></div>
                <div><span class="text-slate-500 block">Languages</span><span class="font-medium">{{ $pujari->languageKnown ?? '-' }}</span></div>
                <div><span class="text-slate-500 block">Experience</span><span class="font-medium">{{ $pujari->experienceInYears ?? '-' }} Years</span></div>
                <div><span class="text-slate-500 block">Qualification</span><span class="font-medium">{{ $pujari->highestQualification ?? '-' }}</span></div>
                <div><span class="text-slate-500 block">Rate</span><span class="font-medium text-primary">{{ $currency->value ?? '\u20b9' }}{{ number_format($pujari->reportRate, 0) }} / session</span></div>
            </div>
            @if($pujari->loginBio)
            <div class="mt-4 pt-4 border-t border-slate-200">
                <span class="text-slate-500 text-sm block mb-1">Bio</span>
                <p class="text-sm">{{ $pujari->loginBio }}</p>
            </div>
            @endif
        </div>

        {{-- \u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550
             PUJA PACKAGES SECTION \u2014 NEW
        \u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550 --}}
        

        {{-- Bank Details --}}
        <div class="intro-y box p-5 mb-5">
            <div class="flex items-center border-b border-slate-200 pb-3 mb-4">
                <i data-lucide="credit-card" class="w-5 h-5 mr-2 text-primary"></i>
                <h3 class="font-medium text-base">Bank Details</h3>
            </div>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><span class="text-slate-500 block">Bank Name</span><span class="font-medium">{{ $pujari->bankName ?? '-' }}</span></div>
                <div><span class="text-slate-500 block">Branch</span><span class="font-medium">{{ $pujari->bankBranch ?? '-' }}</span></div>
                <div><span class="text-slate-500 block">Account Number</span><span class="font-medium">{{ $pujari->accountNumber ?? '-' }}</span></div>
                <div><span class="text-slate-500 block">IFSC Code</span><span class="font-medium">{{ $pujari->ifscCode ?? '-' }}</span></div>
                <div><span class="text-slate-500 block">Account Type</span><span class="font-medium">{{ $pujari->accountType ?? '-' }}</span></div>
                <div><span class="text-slate-500 block">UPI ID</span><span class="font-medium">{{ $pujari->upi ?? '-' }}</span></div>
            </div>
        </div>

        {{-- Documents --}}
        <div class="intro-y box p-5">
            <div class="flex items-center border-b border-slate-200 pb-3 mb-4">
                <i data-lucide="file-text" class="w-5 h-5 mr-2 text-primary"></i>
                <h3 class="font-medium text-base">Documents</h3>
            </div>
            <div class="grid grid-cols-3 gap-4 text-center text-sm">
                @foreach(['aadhar_card' => 'Aadhar Card', 'pan_card' => 'PAN Card', 'certificate' => 'Certificate'] as $field => $label)
                <div>
                    <span class="text-slate-500 block mb-2">{{ $label }}</span>
                    @if($pujari->$field)
                    <a href="{{ Str::startsWith($pujari->$field,'http') ? $pujari->$field : asset($pujari->$field) }}" target="_blank">
                        <img src="{{ Str::startsWith($pujari->$field,'http') ? $pujari->$field : asset($pujari->$field) }}"
                             onerror="this.src='/build/assets/images/person.png';"
                             class="w-20 h-20 object-cover rounded mx-auto border border-slate-200">
                    </a>
                    @else
                    <span class="text-slate-400 text-xs">Not uploaded</span>
                    @endif
                </div>
                @endforeach
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
@section('script')
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
            fetch('{{ route("verifiedPujariApi") }}', {
                method:'POST',
                headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
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
            fetch('{{ route("deletePujari") }}', {
                method:'DELETE',
                headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
                body: JSON.stringify({ id })
            }).then(r=>r.json()).then(res => {
                if (res.status == 200) Swal.fire('Deleted!','','success').then(()=> window.location='{{ route("pujaris") }}');
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
            fetch('{{ route("toggleBlockPujari") }}', {
                method:'POST',
                headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
                body: JSON.stringify({ pujariId: id, userId: {{ auth()->id() }} })
            }).then(r=>r.json()).then(res => {
                if (res.status==200) { toastr.success(res.message); setTimeout(()=>location.reload(),800); }
                else toastr.error(res.message);
            });
        });
    });
});
</script>
@endsection

<style>
.swal2-actions .swal2-confirm { background-color:#28c76f !important; color:#fff !important; border-radius:6px !important; padding:8px 20px !important; font-weight:600; }
.swal2-actions .swal2-deny   { background-color:#ea5455 !important; color:#fff !important; border-radius:6px !important; }
.swal2-actions .swal2-cancel { background-color:#6c757d !important; color:#fff !important; border-radius:6px !important; }
</style>
@endsection