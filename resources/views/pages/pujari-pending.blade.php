@extends('../layout/' . $layout)

@section('subhead')
    <title>Pending Pujari Requests</title>
@endsection

@section('subcontent')

    <div class="loader"></div>

    <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">
            Pending Pujari Requests
            @if(isset($pujaris) && count($pujaris) > 0)
                <span class="ml-2 px-2 py-1 text-xs rounded-full bg-warning text-white">{{ count($pujaris) }}</span>
            @endif
        </h2>
        <a href="{{ route('pujaris') }}" class="btn btn-secondary shadow-md">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i> Back to Pujaris
        </a>
    </div>

    @if(isset($pujaris) && count($pujaris) > 0)
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible list-table mt-5">
        <table class="table table-report -mt-2">
            <thead class="sticky-top">
                <tr>
                    <th class="whitespace-nowrap">#</th>
                    <th class="whitespace-nowrap">Profile</th>
                    <th class="whitespace-nowrap">Name</th>
                    <th class="text-center whitespace-nowrap">Contact</th>
                    <th class="text-center whitespace-nowrap">Skill</th>
                    <th class="text-center whitespace-nowrap">City</th>
                    <th class="text-center whitespace-nowrap">Registered On</th>
                    <th class="text-center whitespace-nowrap">Approve / Reject</th>
                    <th class="text-center whitespace-nowrap">View</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 0; @endphp
                @foreach($pujaris as $pujari)
                <tr class="intro-x" id="row_{{ $pujari->id }}">
                    <td>{{ ++$no }}</td>
                    <td>
                        <div class="w-10 h-10 image-fit zoom-in">
                            <img class="rounded-full"
                                 src="{{ $pujari->profileImage ? (Str::startsWith($pujari->profileImage,'http') ? $pujari->profileImage : str_replace('storage/','public/storage/',asset($pujari->profileImage))) : '/build/assets/images/person.png' }}"
                                 onerror="this.onerror=null;this.src='/build/assets/images/person.png';">
                        </div>
                    </td>
                    <td class="font-medium">{{ $pujari->name }}</td>
                    <td class="text-center">
                        {{ $pujari->contactNo }}<br>
                        <span class="text-slate-500 text-xs">{{ $pujari->email }}</span>
                    </td>
                    <td class="text-center">{{ Str::limit($pujari->primarySkill, 30) }}</td>
                    <td class="text-center">{{ $pujari->currentCity ?? '-' }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($pujari->created_at)->format('d M Y') }}</td>
                    <td class="text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button class="btn btn-sm btn-success shadow-sm approvePujari" data-id="{{ $pujari->id }}">
                                <i data-lucide="check" class="w-3 h-3 mr-1"></i> Approve
                            </button>
                            <button class="btn btn-sm btn-danger shadow-sm rejectPujari" data-id="{{ $pujari->id }}">
                                <i data-lucide="x" class="w-3 h-3 mr-1"></i> Reject
                            </button>
                        </div>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('pujari-detail', $pujari->id) }}" class="flex items-center justify-center text-primary">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @else
    <div class="intro-y mt-5" style="height:60vh;display:flex;align-items:center;">
        <div style="margin:auto;text-align:center;">
            <i data-lucide="check-circle" style="width:64px;height:64px;color:#28c76f;display:block;margin:0 auto;"></i>
            <h3 class="mt-4">No Pending Requests!</h3>
            <p class="text-slate-500">All pujari registrations have been processed.</p>
        </div>
    </div>
    @endif

@endsection
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
 var $ = jQuery;
    $(window).on('load', function () { $('.loader').hide(); });

    function verifyPujari(id, val) {
        const label = val == 1 ? 'Approve' : 'Reject';
        Swal.fire({
            title: label + ' this pujari?',
            icon: val == 1 ? 'success' : 'error',
            showCancelButton: true,
            confirmButtonText: 'Yes, ' + label,
            confirmButtonColor: val == 1 ? '#28c76f' : '#ea5455',
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('{{ route("verifiedPujariApi") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        id: id,
                        isVerified: val
                    })
                })
                .then(response => response.json())
                .then(res => {
                
                    if (res.status == 200) {
                
                        $('#row_' + id).fadeOut(400, function () {
                            $(this).remove();
                        });
                
                        toastr.success(label + 'd successfully');
                
                    } else {
                
                        toastr.error(res.message ?? 'Something went wrong');
                
                    }
                
                })
                .catch(error => {
                    console.error(error);
                    toastr.error('Server error');
                });
            }
        });
    }

    $(document).on('click', '.approvePujari', function () { verifyPujari($(this).data('id'), 1); });
    $(document).on('click', '.rejectPujari',  function () { verifyPujari($(this).data('id'), 0); });
</script>
@endsection