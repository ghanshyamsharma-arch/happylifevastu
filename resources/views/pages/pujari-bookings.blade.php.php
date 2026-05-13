@extends('../layout/' . $layout)

@section('subhead')
    <title>Pujari Bookings</title>
@endsection

@section('subcontent')

    <div class="loader"></div>

    <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">Pujari Bookings</h2>
    </div>

    {{-- Filters --}}
    <div class="intro-y flex flex-wrap items-center gap-3 mt-5">
        <form action="{{ route('pujariBookings') }}" method="POST" class="flex flex-wrap gap-2 items-center">
            @csrf
            <div class="relative w-56 text-slate-500" style="display:inline-block">
                <input type="text" name="searchString" value="{{ $searchString ?? '' }}"
                       class="form-control w-56 box pr-10" placeholder="Search pujari / person...">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
            </div>
            <select name="status" class="form-select w-36 box">
                <option value="">All Status</option>
                <option value="pending"     {{ ($status ?? '') == 'pending'     ? 'selected' : '' }}>Pending</option>
                <option value="confirmed"   {{ ($status ?? '') == 'confirmed'   ? 'selected' : '' }}>Confirmed</option>
                <option value="in_progress" {{ ($status ?? '') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed"   {{ ($status ?? '') == 'completed'   ? 'selected' : '' }}>Completed</option>
                <option value="cancelled"   {{ ($status ?? '') == 'cancelled'   ? 'selected' : '' }}>Cancelled</option>
            </select>
            <input type="date" name="from_date" value="{{ $from_date ?? '' }}" class="form-control w-36 box">
            <input type="date" name="to_date"   value="{{ $to_date ?? '' }}"   class="form-control w-36 box">
            <button class="btn btn-primary shadow-md">Filter</button>
            <a href="{{ route('pujariBookings') }}" class="btn btn-secondary">
                <i data-lucide="x" class="w-4 h-4 mr-1"></i> Clear
            </a>
        </form>
    </div>

    @if(isset($totalRecords) && $totalRecords > 0)
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible mt-5">
        <table class="table table-report -mt-2">
            <thead class="sticky-top">
                <tr>
                    <th>#</th>
                    <th>Pujari</th>
                    <th class="text-center">Customer / Contact</th>
                    <th class="text-center">Puja / Date</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Payment</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 0; @endphp
                @foreach($bookings as $booking)
                <tr class="intro-x" id="row_{{ $booking->id }}">
                    <td>{{ ($page - 1) * 15 + ++$no }}</td>
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 image-fit zoom-in flex-none">
                                <img class="rounded-full"
                                     src="{{ Str::startsWith($booking->profileImage ?? '', 'http') ? $booking->profileImage : '/' . ($booking->profileImage ?? '') }}"
                                     onerror="this.onerror=null;this.src='/build/assets/images/person.png';">
                            </div>
                            <span class="font-medium">{{ $booking->pujariName }}</span>
                        </div>
                    </td>
                    <td class="text-center">
                        <span class="font-medium">{{ $booking->personName }}</span><br>
                        <span class="text-slate-500 text-xs">{{ $booking->personContact }}</span>
                    </td>
                    <td class="text-center">
                        <span class="font-medium">{{ $booking->pujaName ?? 'Session' }}</span><br>
                        <span class="text-slate-500 text-xs">
                            {{ \Carbon\Carbon::parse($booking->bookingDate)->format('d M Y') }}
                            @if($booking->timeSlot) \u00b7 {{ $booking->timeSlot }} @endif
                        </span>
                    </td>
                    <td class="text-center">
                        {{ $currency->value ?? '\u20b9' }}{{ number_format($booking->totalAmount, 2) }}
                        @if($booking->gstAmount > 0)
                        <br><span class="text-slate-500 text-xs">GST: {{ $currency->value ?? '\u20b9' }}{{ number_format($booking->gstAmount, 2) }}</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @php
                            $pColors = ['paid' => 'success', 'pending' => 'warning', 'failed' => 'danger'];
                            $pColor  = $pColors[$booking->paymentStatus] ?? 'secondary';
                        @endphp
                        <span class="px-2 py-1 rounded text-xs bg-{{ $pColor }}/10 text-{{ $pColor }} capitalize">
                            {{ $booking->paymentStatus }}
                        </span>
                        <br><span class="text-slate-500 text-xs">{{ strtoupper($booking->paymentMode) }}</span>
                    </td>
                    <td class="text-center">
                        @php
                            $sColors = ['pending'=>'warning','confirmed'=>'primary','in_progress'=>'info','completed'=>'success','cancelled'=>'danger'];
                            $sColor  = $sColors[$booking->status] ?? 'secondary';
                        @endphp
                        <select class="form-select text-xs py-1 px-2 statusDropdown" data-id="{{ $booking->id }}"
                                style="color: var(--color-{{ $sColor }});">
                            <option value="pending"     {{ $booking->status == 'pending'     ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed"   {{ $booking->status == 'confirmed'   ? 'selected' : '' }}>Confirmed</option>
                            <option value="in_progress" {{ $booking->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed"   {{ $booking->status == 'completed'   ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled"   {{ $booking->status == 'cancelled'   ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </td>
                    <td class="text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('pujariBookingDetail', $booking->id) }}" class="text-primary" title="View Detail">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </a>
                            <a href="javascript:;" class="text-danger deleteBooking" data-id="{{ $booking->id }}" title="Delete">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-inline text-slate-500 pagecount mt-3">
        Showing {{ $start }} to {{ $end }} of {{ $totalRecords }} entries
    </div>
    <nav class="mt-2">
        <ul class="pagination">
            <li class="page-item {{ $page == 1 ? 'disabled' : '' }}">
                <a class="page-link" href="{{ route('pujariBookings', ['page' => $page - 1]) }}">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i></a>
            </li>
            @for($i = 1; $i <= $totalPages; $i++)
            <li class="page-item {{ $page == $i ? 'active' : '' }}">
                <a class="page-link" href="{{ route('pujariBookings', ['page' => $i]) }}">{{ $i }}</a>
            </li>
            @endfor
            <li class="page-item {{ $page == $totalPages ? 'disabled' : '' }}">
                <a class="page-link" href="{{ route('pujariBookings', ['page' => $page + 1]) }}">
                    <i data-lucide="chevron-right" class="w-4 h-4"></i></a>
            </li>
        </ul>
    </nav>

    @else
    <div class="intro-y mt-5" style="height:50vh;display:flex;align-items:center;">
        <div style="margin:auto;text-align:center;">
            <img src="/build/assets/images/nodata.png" style="height:200px;" alt="No data">
            <h3 class="mt-3">No Bookings Found</h3>
        </div>
    </div>
    @endif

@endsection

@section('script')
<script>
    $(window).on('load', function () { $('.loader').hide(); });

    // Status change inline
    $(document).on('change', '.statusDropdown', function () {
        const id     = $(this).data('id');
        const status = $(this).val();
        $.post('{{ route("updatePujariBookingStatus") }}', {
            id: id, status: status, _token: '{{ csrf_token() }}'
        }, function (res) {
            if (res.status == 200) toastr.success('Status updated');
            else toastr.error(res.message);
        });
    });

    // Delete booking
    $(document).on('click', '.deleteBooking', function () {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Delete this booking?', icon: 'warning',
            showCancelButton: true, confirmButtonColor: '#ea5455',
            confirmButtonText: 'Yes, delete',
        }).then((r) => {
            if (r.isConfirmed) {
                $.ajax({
                    url: '{{ route("deletePujariBooking") }}', type: 'DELETE',
                    data: { id: id, _token: '{{ csrf_token() }}' },
                    success: function (res) {
                        if (res.status == 200) {
                            $('#row_' + id).fadeOut(400, function () { $(this).remove(); });
                            toastr.success('Booking deleted');
                        } else { toastr.error(res.message); }
                    }
                });
            }
        });
    });
</script>
@endsection