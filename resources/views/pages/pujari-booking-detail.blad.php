@extends('../layout/' . $layout)

@section('subhead')
    <title>Booking Detail #{{ $booking->id }}</title>
@endsection

@section('subcontent')

    <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">
            Booking Detail <span class="text-slate-500 text-sm">#{{ $booking->id }}</span>
        </h2>
        <a href="{{ route('pujariBookings') }}" class="btn btn-secondary shadow-md">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i> Back
        </a>
    </div>

    @php
        $sColors = ['pending'=>'warning','confirmed'=>'primary','in_progress'=>'info','completed'=>'success','cancelled'=>'danger'];
        $sColor  = $sColors[$booking->status] ?? 'secondary';
    @endphp

    <div class="intro-y grid grid-cols-12 gap-5 mt-5">

        {{-- Left column --}}
        <div class="col-span-12 lg:col-span-8">

            {{-- Booking info --}}
            <div class="intro-y box p-5 mb-5">
                <div class="flex items-center justify-between border-b border-slate-200 pb-3 mb-4">
                    <div class="flex items-center gap-2">
                        <i data-lucide="calendar" class="w-5 h-5 text-primary"></i>
                        <h3 class="font-medium text-base">Booking Information</h3>
                    </div>
                    <span class="px-3 py-1 rounded text-sm font-medium bg-{{ $sColor }}/10 text-{{ $sColor }} capitalize">
                        {{ str_replace('_', ' ', $booking->status) }}
                    </span>
                </div>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-slate-500 block">Puja Name</span>
                        <span class="font-medium">{{ $booking->pujaName ?? 'General Session' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Booking Type</span>
                        <span class="font-medium capitalize">{{ $booking->bookingType }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Booking Date</span>
                        <span class="font-medium">{{ \Carbon\Carbon::parse($booking->bookingDate)->format('d M Y, l') }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Time Slot</span>
                        <span class="font-medium">{{ $booking->timeSlot ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Location</span>
                        <span class="font-medium capitalize">{{ $booking->location ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Address</span>
                        <span class="font-medium">{{ $booking->address ?? '-' }}</span>
                    </div>
                    @if($booking->gotra)
                    <div>
                        <span class="text-slate-500 block">Gotra</span>
                        <span class="font-medium">{{ $booking->gotra }}</span>
                    </div>
                    @endif
                    @if($booking->familyMemberNames)
                    <div class="col-span-2">
                        <span class="text-slate-500 block">Family Member Names</span>
                        <span class="font-medium">{{ $booking->familyMemberNames }}</span>
                    </div>
                    @endif
                    @if($booking->specialRequirement)
                    <div class="col-span-2">
                        <span class="text-slate-500 block">Special Requirement</span>
                        <span class="font-medium">{{ $booking->specialRequirement }}</span>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Customer info --}}
            <div class="intro-y box p-5 mb-5">
                <div class="flex items-center border-b border-slate-200 pb-3 mb-4">
                    <i data-lucide="user" class="w-5 h-5 mr-2 text-primary"></i>
                    <h3 class="font-medium text-base">Customer Information</h3>
                </div>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-slate-500 block">Name</span>
                        <span class="font-medium">{{ $booking->personName }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Contact</span>
                        <span class="font-medium">{{ $booking->personContact }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Email</span>
                        <span class="font-medium">{{ $booking->personEmail ?? '-' }}</span>
                    </div>
                    @if($booking->customerName)
                    <div>
                        <span class="text-slate-500 block">App User</span>
                        <span class="font-medium">{{ $booking->customerName }}</span>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Admin Note --}}
            <div class="intro-y box p-5">
                <div class="flex items-center border-b border-slate-200 pb-3 mb-4">
                    <i data-lucide="message-square" class="w-5 h-5 mr-2 text-primary"></i>
                    <h3 class="font-medium text-base">Update Status / Note</h3>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select id="statusSelect" class="form-select">
                        <option value="pending"     {{ $booking->status == 'pending'     ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed"   {{ $booking->status == 'confirmed'   ? 'selected' : '' }}>Confirmed</option>
                        <option value="in_progress" {{ $booking->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed"   {{ $booking->status == 'completed'   ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled"   {{ $booking->status == 'cancelled'   ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label">Admin Note</label>
                    <textarea id="adminNoteInput" class="form-control" rows="3" placeholder="Internal note...">{{ $booking->adminNote }}</textarea>
                </div>
                <button id="updateStatusBtn" class="btn btn-primary">
                    <i data-lucide="save" class="w-4 h-4 mr-1"></i> Update
                </button>
            </div>
        </div>

        {{-- Right column --}}
        <div class="col-span-12 lg:col-span-4">

            {{-- Pujari card --}}
            <div class="intro-y box p-5 mb-5">
                <div class="text-center pb-4 border-b border-slate-200 mb-4">
                    <div class="w-16 h-16 rounded-full overflow-hidden mx-auto mb-2 image-fit">
                        <img src="{{ Str::startsWith($booking->profileImage ?? '', 'http') ? $booking->profileImage : '/' . ($booking->profileImage ?? '') }}"
                             onerror="this.onerror=null;this.src='/build/assets/images/person.png';"
                             class="w-full h-full object-cover">
                    </div>
                    <h4 class="font-medium">{{ $booking->pujariName }}</h4>
                    <p class="text-slate-500 text-sm">{{ $booking->pujariContact }}</p>
                    <p class="text-slate-500 text-xs">{{ $booking->pujariEmail }}</p>
                </div>
                <a href="{{ route('pujari-detail', $booking->pujariId) }}" class="btn btn-outline-primary w-full btn-sm">
                    <i data-lucide="external-link" class="w-3 h-3 mr-1"></i> View Pujari Profile
                </a>
            </div>

            {{-- Payment summary --}}
            <div class="intro-y box p-5">
                <div class="flex items-center border-b border-slate-200 pb-3 mb-4">
                    <i data-lucide="credit-card" class="w-5 h-5 mr-2 text-primary"></i>
                    <h3 class="font-medium text-base">Payment Summary</h3>
                </div>
                <div class="text-sm space-y-3">
                    <div class="flex justify-between">
                        <span class="text-slate-500">Amount</span>
                        <span>{{ $currency->value ?? '\u20b9' }}{{ number_format($booking->amount, 2) }}</span>
                    </div>
                    @if($booking->gstAmount > 0)
                    <div class="flex justify-between">
                        <span class="text-slate-500">GST</span>
                        <span>{{ $currency->value ?? '\u20b9' }}{{ number_format($booking->gstAmount, 2) }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between font-bold border-t border-slate-200 pt-2">
                        <span>Total</span>
                        <span class="text-primary">{{ $currency->value ?? '\u20b9' }}{{ number_format($booking->totalAmount, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Payment Mode</span>
                        <span class="capitalize">{{ $booking->paymentMode }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Payment Status</span>
                        @php $pColors = ['paid'=>'success','pending'=>'warning','failed'=>'danger']; @endphp
                        <span class="px-2 py-1 rounded text-xs bg-{{ $pColors[$booking->paymentStatus] ?? 'secondary' }}/10 text-{{ $pColors[$booking->paymentStatus] ?? 'secondary' }} capitalize">
                            {{ $booking->paymentStatus }}
                        </span>
                    </div>
                    @if($booking->transactionId)
                    <div class="flex justify-between">
                        <span class="text-slate-500">Transaction ID</span>
                        <span class="text-xs">{{ $booking->transactionId }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="text-slate-500">Booked On</span>
                        <span>{{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y') }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('script')
<script>
    $('#updateStatusBtn').on('click', function () {
        $.post('{{ route("updatePujariBookingStatus") }}', {
            id: {{ $booking->id }},
            status: $('#statusSelect').val(),
            adminNote: $('#adminNoteInput').val(),
            _token: '{{ csrf_token() }}'
        }, function (res) {
            if (res.status == 200) toastr.success('Updated successfully');
            else toastr.error(res.message);
        });
    });
</script>
@endsection