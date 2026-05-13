@extends('../layout/' . $layout)

@section('subhead')
    <title>Pujari Reviews</title>
@endsection

@section('subcontent')

    <div class="loader"></div>

    <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">Pujari Reviews</h2>
        <button class="btn btn-primary shadow-md" data-tw-toggle="modal" data-tw-target="#addReviewModal">
            <i data-lucide="plus" class="w-4 h-4 mr-1"></i> Add Review
        </button>
    </div>

    @if(isset($totalRecords) && $totalRecords > 0)
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible mt-5">
        <table class="table table-report -mt-2">
            <thead class="sticky-top">
                <tr>
                    <th>#</th>
                    <th>Pujari</th>
                    <th class="text-center">Reviewer</th>
                    <th class="text-center">Rating</th>
                    <th class="text-center">Review</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 0; @endphp
                @foreach($reviews as $review)
                <tr class="intro-x" id="row_{{ $review->id }}">
                    <td>{{ ($page - 1) * 15 + ++$no }}</td>
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 image-fit zoom-in flex-none">
                                <img class="rounded-full"
                                     src="{{ Str::startsWith($review->profileImage ?? '', 'http') ? $review->profileImage : '/' . ($review->profileImage ?? '') }}"
                                     onerror="this.onerror=null;this.src='/build/assets/images/person.png';">
                            </div>
                            <span class="font-medium">{{ $review->pujariName }}</span>
                        </div>
                    </td>
                    <td class="text-center">{{ $review->reviewerName }}</td>
                    <td class="text-center">
                        <div class="flex items-center justify-center gap-1">
                            @for($s = 1; $s <= 5; $s++)
                                <i data-lucide="star" class="w-3 h-3 {{ $s <= $review->rating ? 'text-warning fill-warning' : 'text-slate-300' }}"></i>
                            @endfor
                            <span class="ml-1 text-xs">({{ number_format($review->rating, 1) }})</span>
                        </div>
                    </td>
                    <td class="text-center max-w-xs">
                        <p class="text-sm line-clamp-2">{{ $review->review ?? '-' }}</p>
                    </td>
                    <td class="text-center text-sm">{{ \Carbon\Carbon::parse($review->created_at)->format('d M Y') }}</td>
                    <td class="text-center">
                        <a href="javascript:;" class="text-danger deleteReview" data-id="{{ $review->id }}">
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
                <a class="page-link" href="{{ route('pujariReviews', ['page' => $page - 1]) }}">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i></a>
            </li>
            @for($i = 1; $i <= $totalPages; $i++)
            <li class="page-item {{ $page == $i ? 'active' : '' }}">
                <a class="page-link" href="{{ route('pujariReviews', ['page' => $i]) }}">{{ $i }}</a>
            </li>
            @endfor
            <li class="page-item {{ $page == $totalPages ? 'disabled' : '' }}">
                <a class="page-link" href="{{ route('pujariReviews', ['page' => $page + 1]) }}">
                    <i data-lucide="chevron-right" class="w-4 h-4"></i></a>
            </li>
        </ul>
    </nav>

    @else
    <div class="intro-y mt-5" style="height:50vh;display:flex;align-items:center;">
        <div style="margin:auto;text-align:center;">
            <img src="/build/assets/images/nodata.png" style="height:200px;" alt="No data">
            <h3 class="mt-3">No Reviews Yet</h3>
        </div>
    </div>
    @endif

    {{-- Add Review Modal --}}
    <div id="addReviewModal" class="modal" data-tw-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="font-medium text-base">Add Pujari Review</h2>
                    <a data-tw-dismiss="modal" href="javascript:;"><i data-lucide="x" class="w-8 h-8 text-slate-400"></i></a>
                </div>
                <div class="modal-body p-5">
                    <form id="addReviewForm">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label">Pujari <span class="text-danger">*</span></label>
                            <select name="pujariId" class="form-select tom-select" required>
                                <option value="">-- Select Pujari --</option>
                                @foreach($pujaris as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Reviewer Name <span class="text-danger">*</span></label>
                            <input type="text" name="user_name" class="form-control" placeholder="Reviewer name" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Rating <span class="text-danger">*</span></label>
                            <div class="flex gap-2 starRating" id="starSelector">
                                @for($s = 1; $s <= 5; $s++)
                                <i data-lucide="star" data-val="{{ $s }}" class="w-7 h-7 cursor-pointer text-slate-300 star-icon"></i>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="ratingVal" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Review</label>
                            <textarea name="review" class="form-control" rows="3" placeholder="Write review..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button data-tw-dismiss="modal" class="btn btn-secondary w-20 mr-2">Cancel</button>
                    <button id="submitReviewBtn" class="btn btn-primary">
                        <i data-lucide="save" class="w-4 h-4 mr-1"></i> Save Review
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script>
    $(window).on('load', function () { $('.loader').hide(); });

    // Star rating
    $(document).on('click', '.star-icon', function () {
        const val = $(this).data('val');
        $('#ratingVal').val(val);
        $('.star-icon').each(function (i) {
            if (i < val) {
                $(this).removeClass('text-slate-300').addClass('text-warning');
            } else {
                $(this).removeClass('text-warning').addClass('text-slate-300');
            }
        });
    });

    // Submit review
    $('#submitReviewBtn').on('click', function () {
        const rating = $('#ratingVal').val();
        if (!rating) { toastr.error('Please select a rating'); return; }
        $.post('{{ route("addPujariReview") }}', $('#addReviewForm').serialize(), function (res) {
            if (res.status == 200) {
                Swal.fire('Saved!', res.message, 'success').then(() => location.reload());
            } else {
                toastr.error(res.message);
            }
        });
    });

    // Delete review
    $(document).on('click', '.deleteReview', function () {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Delete this review?', icon: 'warning',
            showCancelButton: true, confirmButtonColor: '#ea5455',
            confirmButtonText: 'Yes, delete',
        }).then((r) => {
            if (r.isConfirmed) {
                $.ajax({
                    url: '{{ route("deletePujariReview") }}', type: 'DELETE',
                    data: { id: id, _token: '{{ csrf_token() }}' },
                    success: function (res) {
                        if (res.status == 200) {
                            $('#row_' + id).fadeOut(400, function () { $(this).remove(); });
                            toastr.success('Review deleted');
                        } else { toastr.error(res.message); }
                    }
                });
            }
        });
    });
</script>
@endsection