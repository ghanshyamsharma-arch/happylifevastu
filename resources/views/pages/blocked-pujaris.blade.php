@extends('../layout/' . $layout)

@section('subhead')
    <title>Block Pujari List</title>
@endsection

@section('subcontent')

    <div class="loader"></div>

    <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">Blocked Pujaris</h2>
        <a href="{{ route('pujaris') }}" class="btn btn-secondary shadow-md">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i> Back to Pujaris
        </a>
    </div>

    <div class="intro-y flex flex-wrap items-center mt-5 gap-3">
        <form action="{{ route('blockPujari') }}" method="POST">
            @csrf
            <div class="relative w-56 text-slate-500" style="display:inline-block">
                <input type="text" name="searchString" value="{{ $searchString ?? '' }}"
                       class="form-control w-56 box pr-10" placeholder="Search pujari / user...">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
            </div>
            <button class="btn btn-primary shadow-md ml-2">Search</button>
        </form>
        <a href="{{ route('blockPujari') }}" class="btn btn-secondary">
            <i data-lucide="x" class="w-4 h-4 mr-1"></i> Clear
        </a>
    </div>

    @if(isset($totalRecords) && $totalRecords > 0)
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible mt-5">
        <table class="table table-report -mt-2">
            <thead class="sticky-top">
                <tr>
                    <th class="whitespace-nowrap">#</th>
                    <th class="whitespace-nowrap">Pujari</th>
                    <th class="text-center whitespace-nowrap">Blocked By</th>
                    <th class="text-center whitespace-nowrap">Reason</th>
                    <th class="text-center whitespace-nowrap">Date</th>
                    <th class="text-center whitespace-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 0; @endphp
                @foreach($reportBlocks as $block)
                <tr class="intro-x" id="row_{{ $block->id }}">
                    <td>{{ ($page - 1) * 15 + ++$no }}</td>
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="w-9 h-9 image-fit zoom-in flex-none">
                                <img class="rounded-full"
                                     src="{{ Str::startsWith($block->profileImage ?? '', ['http','http']) ? $block->profileImage : '/' . ($block->profileImage ?? '') }}"
                                     onerror="this.onerror=null;this.src='/build/assets/images/person.png';">
                            </div>
                            <div>
                                <span class="font-medium">{{ $block->pujariName }}</span><br>
                                <span class="text-slate-500 text-xs">{{ $block->pujariContactNo }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        @if($block->userId)
                            <span class="font-medium">{{ $block->userName }}</span><br>
                            <span class="text-slate-500 text-xs">{{ $block->userContactNo }}</span>
                        @else
                            <span class="px-2 py-1 rounded bg-danger/10 text-danger text-xs font-medium">Admin</span>
                        @endif
                    </td>
                    <td class="text-center text-sm">{{ $block->reason ?? '-' }}</td>
                    <td class="text-center text-sm">{{ \Carbon\Carbon::parse($block->created_at)->format('d M Y') }}</td>
                    <td class="text-center">
                        <a href="javascript:;" class="flex items-center justify-center text-danger deleteBlock"
                           data-id="{{ $block->id }}">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </a>
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
                <a class="page-link" href="{{ route('blockPujari', ['page' => $page - 1, 'searchString' => $searchString ?? '']) }}">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i></a>
            </li>
            @for($i = 1; $i <= $totalPages; $i++)
            <li class="page-item {{ $page == $i ? 'active' : '' }}">
                <a class="page-link" href="{{ route('blockPujari', ['page' => $i, 'searchString' => $searchString ?? '']) }}">{{ $i }}</a>
            </li>
            @endfor
            <li class="page-item {{ $page == $totalPages ? 'disabled' : '' }}">
                <a class="page-link" href="{{ route('blockPujari', ['page' => $page + 1, 'searchString' => $searchString ?? '']) }}">
                    <i data-lucide="chevron-right" class="w-4 h-4"></i></a>
            </li>
        </ul>
    </nav>

    @else
    <div class="intro-y mt-5" style="height:60vh;display:flex;align-items:center;">
        <div style="margin:auto;text-align:center;">
            <img src="/build/assets/images/nodata.png" style="height:200px;" alt="No data">
            <h3 class="mt-3">No Blocked Pujaris</h3>
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

    // Delete Block Record
    document.addEventListener('click', function (e) {

        const button = e.target.closest('.deleteBlock');

        if (!button) return;

        const id = button.dataset.id;

        Swal.fire({
            title: 'Remove this block record?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ea5455',
            confirmButtonText: 'Yes, remove',
        })

        .then((result) => {

            if (result.isConfirmed) {

                fetch('{{ route("deleteBlockPujariRecord") }}', {

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

                        const row = document.getElementById('row_' + id);

                        if (row) {

                            row.style.transition = '0.4s';
                            row.style.opacity = '0';

                            setTimeout(() => {
                                row.remove();
                            }, 400);

                        }

                        toastr.success('Block record removed');

                    } else {

                        toastr.error(res.message);

                    }

                })

                .catch(error => {

                    console.error(error);

                    toastr.error('Server error');

                });

            }

        });

    });

});
</script>
@endsection