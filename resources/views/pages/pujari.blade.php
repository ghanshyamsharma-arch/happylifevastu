@extends('../layout/' . $layout)

@section('subhead')
    <title>Pujari List</title>
@endsection

@section('subcontent')
    @php
        $currency = DB::table('systemflag')->where('name', 'currencySymbol')->select('value')->first();
    @endphp

    <div class="loader"></div>

    <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">Pujaris</h2>
        <a href="{{ route('addPujari') }}" class="btn btn-primary shadow-md mr-2">
            <i data-lucide="plus" class="w-4 h-4 mr-1"></i> Add Pujari
        </a>
        <a href="{{ route('pending-pujari-requests') }}" class="btn btn-warning shadow-md">
            <i data-lucide="clock" class="w-4 h-4 mr-1"></i> Pending Requests
        </a>
    </div>

    {{-- Search & Filter --}}
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-5 gap-3">
        <form action="{{ route('pujaris') }}" method="POST">
            @csrf
            <div class="w-56 relative text-slate-500" style="display:inline-block">
                <input value="{{ $searchString ?? '' }}" type="text" class="form-control w-56 box pr-10"
                    placeholder="Search name / phone..." name="searchString">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
            </div>
            <button class="btn btn-primary shadow-md ml-2">Search</button>
        </form>

        <form action="{{ route('pujaris') }}" method="GET" class="flex items-center gap-2">
            <label class="font-bold">From:</label>
            <input type="date" name="from_date" value="{{ $from_date ?? '' }}" class="form-control w-40 box">
            <label class="font-bold">To:</label>
            <input type="date" name="to_date" value="{{ $to_date ?? '' }}" class="form-control w-40 box">
            <button class="btn btn-primary shadow-md">Filter</button>
            <a href="{{ route('pujaris') }}" class="btn btn-secondary">
                <i data-lucide="x" class="w-4 h-4 mr-1"></i> Clear
            </a>
        </form>
    </div>

    @if(isset($totalRecords) && $totalRecords > 0)
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible list-table mt-5">
        <table class="table table-report -mt-2">
            <thead class="sticky-top">
                <tr>
                    <th class="whitespace-nowrap">#</th>
                    <th class="whitespace-nowrap">Profile</th>
                    <th class="whitespace-nowrap">Name</th>
                    <th class="text-center whitespace-nowrap">Contact</th>
                    <th class="text-center whitespace-nowrap">Skill</th>
                    <th class="text-center whitespace-nowrap">Experience</th>
                    <!--<th class="text-center whitespace-nowrap">Rate</th>-->
                    <th class="text-center whitespace-nowrap">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 0; @endphp
                @foreach($pujaris as $pujari)
                <tr class="intro-x">
                    <td>{{ ($page - 1) * 15 + ++$no }}</td>
                    <td>
                        <div class="w-10 h-10 image-fit zoom-in">
                            <img class="rounded-full"
                                 src="{{ $pujari->profileImage ? (Str::startsWith($pujari->profileImage,'http') ? $pujari->profileImage : str_replace('storage/','public/storage/',asset($pujari->profileImage))) : '/build/assets/images/person.png' }}"
                                 onerror="this.onerror=null;this.src='/build/assets/images/person.png';">
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('pujari-detail', $pujari->id) }}" class="font-medium whitespace-nowrap">
                            {{ $pujari->name }}
                        </a><br>
                        <span class="text-slate-500 text-xs">
                            @if($pujari->isActive)
                                <span class="text-success">Active</span>
                            @else
                                <span class="text-danger">Inactive</span>
                            @endif
                            &nbsp;|&nbsp;
                            @if($pujari->isVerified)
                                <span class="text-success">Verified</span>
                            @else
                                <span class="text-warning">Pending</span>
                            @endif
                        </span>
                    </td>
                    <td class="text-center">
                        {{ $pujari->contactNo }}<br>
                        <span class="text-slate-500 text-xs">{{ $pujari->email }}</span>
                    </td>
                    <td class="text-center">{{ Str::limit($pujari->primarySkill, 28) }}</td>
                    <td class="text-center">{{ $pujari->experienceInYears ?? '-' }} Yrs</td>
                    <!--<td class="text-center">-->
                    <!--    {{ $currency->value ?? '₹' }}{{ number_format($pujari->reportRate, 0) }}/session-->
                    <!--</td>-->
                    <td class="text-center">
                        <div class="flex items-center justify-center gap-3">
                            <a href="{{ route('pujari-detail', $pujari->id) }}" class="flex items-center text-primary" title="View">
                                <i data-lucide="eye" class="w-4 h-4 mr-1"></i>
                            </a>
                            <a href="{{ route('edit-pujari', $pujari->id) }}" class="flex items-center text-warning" title="Edit">
                                <i data-lucide="edit" class="w-4 h-4 mr-1"></i>
                            </a>
                            <a href="javascript:;" class="flex items-center text-danger deletePujari" data-id="{{ $pujari->id }}" title="Delete">
                                <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
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
    <div class="d-inline addbtn intro-y col-span-12">
        <nav class="w-full sm:w-auto sm:mr-auto">
            <ul class="pagination mt-2">
                <li class="page-item {{ $page == 1 ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ route('pujaris', ['page' => $page - 1, 'searchString' => $searchString ?? '']) }}">
                        <i class="w-4 h-4" data-lucide="chevron-left"></i>
                    </a>
                </li>
                @for($i = 0; $i < $totalPages; $i++)
                <li class="page-item {{ $page == $i + 1 ? 'active' : '' }}">
                    <a class="page-link" href="{{ route('pujaris', ['page' => $i + 1, 'searchString' => $searchString ?? '']) }}">{{ $i + 1 }}</a>
                </li>
                @endfor
                <li class="page-item {{ $page == $totalPages ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ route('pujaris', ['page' => $page + 1, 'searchString' => $searchString ?? '']) }}">
                        <i class="w-4 h-4" data-lucide="chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    @else
    <div class="intro-y mt-5" style="height:60vh;display:flex;align-items:center;">
        <div style="margin:auto;text-align:center;">
            <img src="/build/assets/images/nodata.png" style="height:200px;" alt="No data">
            <h3 class="mt-3">No Pujaris Found</h3>
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
document.addEventListener('DOMContentLoaded', function () {

    // Hide Loader
    window.addEventListener('load', function () {

        document.querySelector('.loader')?.style.setProperty('display', 'none');

    });

    // Delete Pujari
    document.addEventListener('click', function (e) {

        const button = e.target.closest('.deletePujari');

        if (!button) return;

        const id = button.dataset.id;

        Swal.fire({
            title: 'Are you sure?',
            text: 'This pujari will be deleted.',
            icon: 'error',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            confirmButtonColor: '#ea5455',
        })

        .then((result) => {

            if (result.isConfirmed) {

                fetch('{{ route("deletePujari") }}', {

                    method: 'DELETE',

                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },

                    body: JSON.stringify({
                        id: id
                    })

                })

                .then(response => response.json())

                .then(res => {

                    if (res.status == 200) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: res.message
                        })

                        .then(() => {

                            location.reload();

                        });

                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: res.message ?? 'Something went wrong'
                        });

                    }

                })

                .catch(error => {

                    console.error(error);

                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Server error'
                    });

                });

            }

        });

    });

});
</script>
@endsection