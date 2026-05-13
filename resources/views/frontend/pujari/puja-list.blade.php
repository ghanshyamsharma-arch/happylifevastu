@extends('frontend.pujari.layouts.portal')
@section('title', 'My Pujas')

@section('content')

{{-- \u2500\u2500 Page Styles \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500 --}}
<style>
    /* \u2500\u2500 Page Header \u2500\u2500 */
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 22px;
    }
    .page-title {
        font-size: 22px;
        font-weight: 700;
        color: #1e293b;
    }
    .page-subtitle {
        font-size: 13px;
        color: #64748b;
        margin-top: 2px;
    }

    /* \u2500\u2500 Add Button \u2500\u2500 */
    .btn-add-puja {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: linear-gradient(135deg, #f97316, #c2410c);
        color: white;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: opacity .2s;
    }
    .btn-add-puja:hover { opacity: .88; color: white; }

    /* \u2500\u2500 Alert \u2500\u2500 */
    .alert-box {
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 13px;
        margin-bottom: 18px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }
    .alert-info    { background: #eff6ff; border: 1px solid #bfdbfe; color: #1d4ed8; }
    .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; }
    .alert-error   { background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; }

    /* \u2500\u2500 Table Card \u2500\u2500 */
    .table-card {
        background: white;
        border-radius: 14px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.07);
        overflow: hidden;
    }
    .table-card table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    .table-card thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        padding: 12px 16px;
        border-bottom: 1px solid #e2e8f0;
        white-space: nowrap;
    }
    .table-card tbody tr {
        border-bottom: 1px solid #f1f5f9;
        transition: background .15s;
    }
    .table-card tbody tr:last-child { border-bottom: none; }
    .table-card tbody tr:hover { background: #fafafa; }
    .table-card tbody td {
        padding: 14px 16px;
        color: #1e293b;
        vertical-align: middle;
    }

    /* \u2500\u2500 Puja Image in table \u2500\u2500 */
    .puja-thumb {
        width: 52px;
        height: 52px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
    }
    .puja-title-cell { font-weight: 600; color: #1e293b; max-width: 200px; }
    .puja-place      { font-size: 12px; color: #64748b; margin-top: 2px; }

    /* \u2500\u2500 Status Badges \u2500\u2500 */
    .status-badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }
    .badge-pending  { background: #fef9c3; color: #92400e; }
    .badge-approved { background: #dcfce7; color: #14532d; }
    .badge-rejected { background: #fee2e2; color: #991b1b; }

    /* \u2500\u2500 Action Buttons \u2500\u2500 */
    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 6px 12px;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 600;
        border: 1.5px solid transparent;
        cursor: pointer;
        text-decoration: none;
        transition: all .2s;
    }
    .btn-edit   { background: #eff6ff; color: #2563eb; border-color: #bfdbfe; }
    .btn-edit:hover { background: #2563eb; color: white; }
    .btn-delete { background: #fef2f2; color: #dc2626; border-color: #fecaca; }
    .btn-delete:hover { background: #dc2626; color: white; }

    /* \u2500\u2500 Empty State \u2500\u2500 */
    .empty-state {
        text-align: center;
        padding: 64px 24px;
        color: #94a3b8;
    }
    .empty-state .empty-icon {
        font-size: 56px;
        margin-bottom: 14px;
        display: block;
    }
    .empty-state h5 { font-size: 16px; color: #475569; margin-bottom: 8px; }
    .empty-state p  { font-size: 13px; margin-bottom: 20px; }

    /* \u2500\u2500 Mobile responsive \u2500\u2500 */
    @media (max-width: 700px) {
        .table-card { overflow-x: auto; }
        .hide-mobile { display: none; }
    }
</style>

{{-- \u2500\u2500 Page Header \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500 --}}
<div class="page-header">
    <div>
        <div class="page-title">My Pujas</div>
        <div class="page-subtitle">Manage your puja packages. Approved pujas appear on your public profile.</div>
    </div>
    <a href="{{ route('front.puja-create') }}" class="btn-add-puja">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
        </svg>
        Add New Puja
    </a>
</div>

{{-- \u2500\u2500 Flash Messages \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500 --}}
@if(session('success'))
<div class="alert-box alert-success">
    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert-box alert-error">
    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    {{ session('error') }}
</div>
@endif

{{-- \u2500\u2500 Info Notice \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500 --}}
<div class="alert-box alert-info">
    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="flex-shrink:0">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <span>
        New pujas require <strong>admin approval</strong> before they are visible to users.
        You can edit or delete a puja while it is in <strong>Pending</strong> status.
        Approved pujas cannot be edited \u2014 contact admin for changes.
    </span>
</div>

{{-- \u2500\u2500 Puja Table \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500 --}}
@if(isset($pujas) && $pujas->count() > 0)

<div class="table-card">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Puja</th>
                <th class="hide-mobile">Date & Time</th>
                <th class="hide-mobile">Duration</th>
                <th>Price</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pujas as $index => $puja)
            @php
                // puja_images comes through accessor as full URLs \u2014 get raw for display
                $rawImgs = $puja->getRawOriginal('puja_images');
                $imgs    = $rawImgs ? json_decode($rawImgs, true) : [];
                $thumb   = !empty($imgs[0])
                    ? (Str::startsWith($imgs[0], ['http://','https://']) ? $imgs[0] : asset($imgs[0]))
                    : asset('build/assets/images/person.png');

                $badgeClass = match($puja->isAdminApproved) {
                    'Approved' => 'badge-approved',
                    'Rejected' => 'badge-rejected',
                    default    => 'badge-pending',
                };

                $canEdit = $puja->isAdminApproved === 'Pending'
                        && \Carbon\Carbon::now()->lt(\Carbon\Carbon::parse($puja->puja_start_datetime));
            @endphp
            <tr>
                {{-- # --}}
                <td style="color:#94a3b8;font-size:12px;">{{ $index + 1 }}</td>

                {{-- Puja Info --}}
                <td>
                    <div style="display:flex;align-items:center;gap:12px;">
                        <img src="{{ $thumb }}"
                             onerror="this.src='{{ asset('build/assets/images/person.png') }}'"
                             class="puja-thumb" alt="">
                        <div>
                            <div class="puja-title-cell">{{ $puja->puja_title }}</div>
                            <div class="puja-place">
                                <svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:inline;vertical-align:middle;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $puja->puja_place ?? 'Online' }}
                            </div>
                        </div>
                    </div>
                </td>

                {{-- Date --}}
                <td class="hide-mobile" style="white-space:nowrap;font-size:12px;color:#475569;">
                    @if($puja->puja_start_datetime)
                        {{ \Carbon\Carbon::parse($puja->puja_start_datetime)->format('d M Y') }}<br>
                        <span style="color:#94a3b8;">{{ \Carbon\Carbon::parse($puja->puja_start_datetime)->format('h:i A') }}</span>
                    @else
                        \u2014
                    @endif
                </td>

                {{-- Duration --}}
                <td class="hide-mobile" style="font-size:12px;color:#475569;white-space:nowrap;">
                    {{ $puja->puja_duration }} mins
                </td>

                {{-- Price --}}
                <td style="font-weight:700;color:#f97316;white-space:nowrap;">
                    {{ $currency->value ?? '\u20b9' }}{{ number_format($puja->puja_price, 0) }}
                </td>

                {{-- Status --}}
                <td>
                    <span class="status-badge {{ $badgeClass }}">{{ $puja->isAdminApproved ?? 'Pending' }}</span>
                </td>

                {{-- Actions --}}
                <td style="text-align:center;">
                    <div style="display:flex;align-items:center;justify-content:center;gap:6px;flex-wrap:wrap;">

                        {{-- Edit \u2014 only when Pending + future date --}}
                        @if($canEdit)
                        <a href="{{ route('front.puja-edit', $puja->id) }}" class="action-btn btn-edit">
                            <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        @endif

                        {{-- Delete --}}
                        <form action="{{ route('front.puja-delete', $puja->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this puja?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn btn-delete">
                                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete
                            </button>
                        </form>

                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@else

{{-- \u2500\u2500 Empty State \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500 --}}
<div class="table-card">
    <div class="empty-state">
        <span class="empty-icon">\ud83d\ude4f</span>
        <h5>No Pujas Created Yet</h5>
        <p>Create your first puja service to start receiving bookings from users on your profile.</p>
        <a href="{{ route('front.puja-create') }}" class="btn-add-puja" style="display:inline-flex;">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
            </svg>
            Create Your First Puja
        </a>
    </div>
</div>

@endif

@endsection