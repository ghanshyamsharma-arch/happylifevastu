<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pujari : Manage Slots</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f8fafc; color: #1e293b; }

        /* \u2500\u2500 Sidebar \u2500\u2500 */
        .sidebar { width: 240px; min-height: 100vh; background: linear-gradient(180deg, #f97316, #c2410c); position: fixed; top: 0; left: 0; z-index: 100; padding-top: 20px; }
        .sidebar-logo { padding: 0 20px 20px; border-bottom: 1px solid rgba(255,255,255,0.2); text-align: center; }
        .sidebar-logo img { height: 50px; margin-bottom: 6px; }
        .sidebar-logo p { color: rgba(255,255,255,0.8); font-size: 12px; }
        .sidebar-nav { padding: 16px 0; }
        .sidebar-nav a { display: flex; align-items: center; gap: 10px; padding: 12px 20px; color: rgba(255,255,255,0.85); text-decoration: none; font-size: 14px; transition: background .2s; }
        .sidebar-nav a:hover, .sidebar-nav a.active { background: rgba(255,255,255,0.15); color: white; }
        .sidebar-nav .nav-icon { width: 18px; height: 18px; flex-shrink: 0; }

        /* \u2500\u2500 Main Content \u2500\u2500 */
        .main { margin-left: 240px; padding: 24px; }
        .topbar { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
        .topbar h1 { font-size: 22px; font-weight: 700; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .avatar { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #f97316; }
        .pujari-name { font-size: 14px; font-weight: 600; }

        /* \u2500\u2500 Stats Cards \u2500\u2500 */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin-bottom: 24px; }
        .stat-card { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
        .stat-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 12px; }
        .stat-val { font-size: 26px; font-weight: 700; margin-bottom: 4px; }
        .stat-lbl { font-size: 13px; color: #64748b; }
        .icon-orange { background: #fff7ed; color: #f97316; }
        .icon-blue { background: #eff6ff; color: #3b82f6; }
        .icon-green { background: #f0fdf4; color: #16a34a; }
        .icon-yellow { background: #fffbeb; color: #d97706; }
        .icon-purple { background: #f5f3ff; color: #7c3aed; }

        /* \u2500\u2500 Tables \u2500\u2500 */
        .section-card { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); margin-bottom: 20px; }
        .section-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; }
        .section-title { font-size: 15px; font-weight: 700; }
        .view-all { font-size: 12px; color: #f97316; text-decoration: none; font-weight: 600; }
        table { width: 100%; border-collapse: collapse; font-size: 13px; }
        th { text-align: left; padding: 8px 12px; background: #f8fafc; color: #64748b; font-size: 11px; text-transform: uppercase; font-weight: 600; }
        td { padding: 10px 12px; border-bottom: 1px solid #f1f5f9; }
        tr:last-child td { border-bottom: none; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 20px; font-size: 11px; font-weight: 600; }
        .badge-pending { background: #fffbeb; color: #d97706; }
        .badge-confirmed { background: #eff6ff; color: #3b82f6; }
        .badge-completed { background: #f0fdf4; color: #16a34a; }
        .badge-cancelled { background: #fef2f2; color: #dc2626; }
        .badge-in_progress { background: #f0f9ff; color: #0ea5e9; }
        .star-filled { color: #f59e0b; }

        /* \u2500\u2500 Profile card \u2500\u2500 */
        .profile-card { background: linear-gradient(135deg, #f97316, #c2410c); border-radius: 12px; padding: 24px; color: white; margin-bottom: 20px; }
        .profile-avatar { width: 64px; height: 64px; border-radius: 50%; border: 3px solid rgba(255,255,255,0.5); object-fit: cover; margin-bottom: 10px; }

        @media(max-width:768px) {
            .sidebar { transform: translateX(-100%); }
            .main { margin-left: 0; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>
<body>

{{-- \u2500\u2500 Sidebar \u2500\u2500 --}}
<div class="sidebar">
    <div class="sidebar-logo">
        @php $logo = \Illuminate\Support\Facades\DB::table('systemflag')->where('name','logo')->value('value'); @endphp
        @if($logo)
            <img src="{{ Str::startsWith($logo,'http') ? $logo : asset($logo) }}" alt="Logo"
                 onerror="this.style.display='none'">
        @endif
        <p>Pujari Portal</p>
    </div>
    <nav class="sidebar-nav">
        <a href="{{ route('front.pujariDashboard') }}" >
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Dashboard
        </a>
        <a href="{{ route('front.pujariBookings') }}" >
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            My Bookings
        </a>
        <a href="{{ route('front.pujariReviews') }}" >
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
            Reviews
        </a>
        <a href="{{ route('front.pujariSlots') }}" class="active">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
            Slots
        </a>
        <a href="{{ route('front.pujariEditProfile') }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Edit Profile
        </a>
        <a href="{{ route('front.pujariLogout') }}" style="margin-top:auto; color: rgba(255,255,255,0.6);">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
            Logout
        </a>
    </nav>
</div>
<div class="main">
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:10px;">
    <h1 style="font-size:20px;font-weight:700;">My Availability Slots</h1>
    <button onclick="openAddModal()"
            style="background:#f97316;color:white;border:none;padding:10px 20px;border-radius:10px;font-size:14px;font-weight:600;cursor:pointer;">
        + Add Slot
    </button>
</div>

@if(session('success'))
<div style="background:#dcfce7;padding:10px 14px;border-radius:8px;color:#166534;margin-bottom:14px;font-size:13px;">\u2705 {{ session('success') }}</div>
@endif
@if(session('error'))
<div style="background:#fee2e2;padding:10px 14px;border-radius:8px;color:#991b1b;margin-bottom:14px;font-size:13px;">\u26a0\ufe0f {{ session('error') }}</div>
@endif

@php
    $recurring = $slots->where('dayType','recurring');
    $specific  = $slots->where('dayType','specific');
    $days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
@endphp

{{-- Recurring Slots --}}
@if($recurring->count() > 0)
<div style="background:white;border-radius:14px;padding:20px;box-shadow:0 1px 4px rgba(0,0,0,0.07);margin-bottom:20px;">
    <h3 style="font-size:14px;font-weight:700;color:#f97316;text-transform:uppercase;letter-spacing:.5px;margin-bottom:14px;">\ud83d\udd01 Recurring Weekly Slots</h3>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:12px;">
        @foreach($recurring as $slot)
        @php $pct = $slot->maxBookings > 0 ? round(($slot->bookedCount / $slot->maxBookings) * 100) : 0; @endphp
        <div id="slotCard_{{ $slot->id }}" style="border:1.5px solid #f1f5f9;border-radius:10px;padding:14px;background:#fafafa;">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:8px;">
                <div>
                    <div style="font-weight:700;font-size:15px;">{{ $days[$slot->dayOfWeek] ?? '--' }}</div>
                    <div style="font-size:13px;color:#64748b;margin-top:2px;">
                        {{ date('h:i A', strtotime($slot->startTime)) }} – {{ date('h:i A', strtotime($slot->endTime)) }}
                    </div>
                </div>
                <span id="badge_{{ $slot->id }}"
                      style="padding:2px 10px;border-radius:20px;font-size:11px;font-weight:700;
                             {{ $slot->status === 'active' ? 'background:#f0fdf4;color:#16a34a;' : ($slot->status === 'full' ? 'background:#fffbeb;color:#d97706;' : 'background:#fef2f2;color:#dc2626;') }}">
                    {{ ucfirst($slot->status) }}
                </span>
            </div>
            <div style="margin-bottom:8px;">
                <div style="display:flex;justify-content:space-between;font-size:12px;color:#64748b;margin-bottom:3px;">
                    <span>Bookings</span><span>{{ $slot->bookedCount }}/{{ $slot->maxBookings }}</span>
                </div>
                <div style="background:#e2e8f0;border-radius:4px;height:6px;">
                    <div style="background:{{ $pct >= 100 ? '#ef4444' : ($pct >= 70 ? '#f59e0b' : '#22c55e') }};height:6px;border-radius:4px;width:{{ $pct }}%;"></div>
                </div>
            </div>
            @if($slot->note)
            <div style="font-size:12px;color:#94a3b8;margin-bottom:8px;">\ud83d\udccc {{ $slot->note }}</div>
            @endif
            <div style="display:flex;gap:6px;">
                @if($slot->status !== 'full')
                <button onclick="toggleStatus({{ $slot->id }}, this)"
                        data-status="{{ $slot->status }}"
                        style="flex:1;padding:6px;border-radius:7px;font-size:12px;font-weight:600;cursor:pointer;border:1px solid;
                               {{ $slot->status === 'active' ? 'background:#fef2f2;color:#dc2626;border-color:#fca5a5;' : 'background:#f0fdf4;color:#16a34a;border-color:#86efac;' }}">
                    {{ $slot->status === 'active' ? 'Deactivate' : 'Activate' }}
                </button>
                @endif
                <button onclick='editSlot(@json($slot))'
                        style="flex:1;padding:6px;border-radius:7px;font-size:12px;font-weight:600;cursor:pointer;background:#eff6ff;color:#3b82f6;border:1px solid #bfdbfe;">
                    ✏️ Edit
                </button>
                <button onclick="deleteSlot({{ $slot->id }})"
                        style="padding:6px 10px;border-radius:7px;font-size:12px;cursor:pointer;background:#fef2f2;color:#dc2626;border:1px solid #fca5a5;">
                    🗑
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

{{-- Specific Date Slots --}}
@if($specific->count() > 0)
<div style="background:white;border-radius:14px;padding:20px;box-shadow:0 1px 4px rgba(0,0,0,0.07);margin-bottom:20px;">
    <h3 style="font-size:14px;font-weight:700;color:#7c3aed;text-transform:uppercase;letter-spacing:.5px;margin-bottom:14px;">\ud83d\udcc5 Specific Date Slots</h3>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:12px;">
        @foreach($specific as $slot)
        @php $pct = $slot->maxBookings > 0 ? round(($slot->bookedCount / $slot->maxBookings) * 100) : 0; @endphp
        <div id="slotCard_{{ $slot->id }}" style="border:1.5px solid #f1f5f9;border-radius:10px;padding:14px;background:#fafafa;">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:8px;">
                <div>
                    <div style="font-weight:700;font-size:15px;">{{ $slot->slotDate ? \Carbon\Carbon::parse($slot->slotDate)->format('d M Y') : '--' }}</div>
                    <div style="font-size:13px;color:#64748b;margin-top:2px;">
                        {{ date('h:i A', strtotime($slot->startTime)) }} \u2013 {{ date('h:i A', strtotime($slot->endTime)) }}
                    </div>
                </div>
                <span id="badge_{{ $slot->id }}"
                      style="padding:2px 10px;border-radius:20px;font-size:11px;font-weight:700;
                             {{ $slot->status === 'active' ? 'background:#f0fdf4;color:#16a34a;' : ($slot->status === 'full' ? 'background:#fffbeb;color:#d97706;' : 'background:#fef2f2;color:#dc2626;') }}">
                    {{ ucfirst($slot->status) }}
                </span>
            </div>
            <div style="margin-bottom:8px;">
                <div style="display:flex;justify-content:space-between;font-size:12px;color:#64748b;margin-bottom:3px;">
                    <span>Bookings</span><span>{{ $slot->bookedCount }}/{{ $slot->maxBookings }}</span>
                </div>
                <div style="background:#e2e8f0;border-radius:4px;height:6px;">
                    <div style="background:{{ $pct >= 100 ? '#ef4444' : ($pct >= 70 ? '#f59e0b' : '#22c55e') }};height:6px;border-radius:4px;width:{{ $pct }}%;"></div>
                </div>
            </div>
            @if($slot->note)<div style="font-size:12px;color:#94a3b8;margin-bottom:8px;">\ud83d\udccc {{ $slot->note }}</div>@endif
            <div style="display:flex;gap:6px;">
                @if($slot->status !== 'full')
                <button onclick="toggleStatus({{ $slot->id }}, this)"
                        data-status="{{ $slot->status }}"
                        style="flex:1;padding:6px;border-radius:7px;font-size:12px;font-weight:600;cursor:pointer;border:1px solid;
                               {{ $slot->status === 'active' ? 'background:#fef2f2;color:#dc2626;border-color:#fca5a5;' : 'background:#f0fdf4;color:#16a34a;border-color:#86efac;' }}">
                    {{ $slot->status === 'active' ? 'Deactivate' : 'Activate' }}
                </button>
                @endif
                <button onclick='editSlot(@json($slot))'
                        style="flex:1;padding:6px;border-radius:7px;font-size:12px;font-weight:600;cursor:pointer;background:#eff6ff;color:#3b82f6;border:1px solid #bfdbfe;">
                    ✏️ Edit
                </button>
                <button onclick="deleteSlot({{ $slot->id }})"
                        style="padding:6px 10px;border-radius:7px;font-size:12px;cursor:pointer;background:#fef2f2;color:#dc2626;border:1px solid #fca5a5;">
                    🗑
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

@if($slots->isEmpty())
<div style="text-align:center;padding:60px;background:white;border-radius:14px;box-shadow:0 1px 3px rgba(0,0,0,0.07);">
    <div style="font-size:52px;margin-bottom:14px;"><span class="emoji">🕐</span></div>
    <h3 style="color:#64748b;font-weight:600;">No slots added yet</h3>
    <p style="color:#94a3b8;font-size:13px;margin-top:6px;">Click <strong>+ Add Slot</strong> to define your available times</p>
</div>
@endif

{{-- \u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550 ADD / EDIT MODAL \u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550\u2550 --}}
<div id="slotModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:9999;overflow-y:auto;">
    <div style="max-width:480px;margin:40px auto;background:white;border-radius:16px;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,0.2);">
        <div style="background:linear-gradient(135deg,#f97316,#c2410c);padding:16px 20px;display:flex;justify-content:space-between;align-items:center;">
            <h5 id="modalTitle" style="color:white;font-weight:700;margin:0;">Add Slot</h5>
            <button onclick="closeModal()" style="background:rgba(255,255,255,0.2);border:none;color:white;width:30px;height:30px;border-radius:50%;font-size:18px;cursor:pointer;">×</button>
        </div>
        <div style="padding:24px;">
            <input type="hidden" id="editSlotId">

            {{-- Type Toggle --}}
            <div style="margin-bottom:16px;">
                <label style="font-size:13px;font-weight:600;display:block;margin-bottom:6px;">Slot Type</label>
                <div style="display:flex;background:#f1f5f9;border-radius:8px;padding:3px;">
                    <button type="button" id="btnRecurring" onclick="switchType('recurring')"
                            style="flex:1;padding:7px;border-radius:6px;border:none;font-size:13px;font-weight:600;cursor:pointer;background:#f97316;color:white;">
                        🔁 Recurring
                    </button>
                    <button type="button" id="btnSpecific" onclick="switchType('specific')"
                            style="flex:1;padding:7px;border-radius:6px;border:none;font-size:13px;font-weight:600;cursor:pointer;background:transparent;color:#64748b;">
                        📅 Specific Date
                    </button>
                </div>
                <input type="hidden" id="slotDayType" value="recurring">
            </div>

            {{-- Day buttons --}}
            <div id="weekdayWrap" style="margin-bottom:16px;">
                <label style="font-size:13px;font-weight:600;display:block;margin-bottom:8px;">Select Day *</label>
                <div style="display:flex;gap:6px;flex-wrap:wrap;" id="dayBtnsWrap">
                    @foreach(['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $di => $dn)
                    <button type="button" onclick="pickDay({{ $di }}, this)"
                            class="dayPickBtn" data-day="{{ $di }}"
                            style="padding:8px 12px;border-radius:8px;border:1.5px solid #e2e8f0;font-size:13px;font-weight:600;cursor:pointer;background:white;color:#64748b;transition:.15s;">
                        {{ $dn }}
                    </button>
                    @endforeach
                </div>
                <input type="hidden" id="slotDayOfWeek">
            </div>

            {{-- Specific date --}}
            <div id="specificWrap" style="display:none;margin-bottom:16px;">
                <label style="font-size:13px;font-weight:600;display:block;margin-bottom:6px;">Date *</label>
                <input type="date" id="slotSpecificDate" min="{{ date('Y-m-d') }}"
                       style="width:100%;padding:9px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;">
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px;">
                <div>
                    <label style="font-size:13px;font-weight:600;display:block;margin-bottom:5px;">Start Time *</label>
                    <input type="time" id="slotStart" style="width:100%;padding:9px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;">
                </div>
                <div>
                    <label style="font-size:13px;font-weight:600;display:block;margin-bottom:5px;">End Time *</label>
                    <input type="time" id="slotEnd" style="width:100%;padding:9px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;">
                </div>
                <div>
                    <label style="font-size:13px;font-weight:600;display:block;margin-bottom:5px;">Max Bookings</label>
                    <input type="number" id="slotMax" value="1" min="1" max="50"
                           style="width:100%;padding:9px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;">
                </div>
                <div>
                    <label style="font-size:13px;font-weight:600;display:block;margin-bottom:5px;">Price</label>
                    <input type="number" id="rate" value="1" min="1" 
                           style="width:100%;padding:9px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;">
                </div>
                <div>
                    <label style="font-size:13px;font-weight:600;display:block;margin-bottom:5px;">Note (optional)</label>
                    <input type="text" id="slotNote" placeholder="e.g. Online only"
                           style="width:100%;padding:9px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;">
                </div>
            </div>

            <div id="portalSlotErr" style="display:none;background:#fef2f2;border:1px solid #fca5a5;color:#dc2626;padding:10px 14px;border-radius:8px;font-size:13px;margin-bottom:12px;"></div>

            <button onclick="savePortalSlot()" id="savePortalSlotBtn"
                    style="width:100%;padding:12px;background:linear-gradient(135deg,#f97316,#c2410c);color:white;border:none;border-radius:10px;font-size:15px;font-weight:700;cursor:pointer;">
                Save Slot
            </button>
        </div>
    </div>
</div>

<script>
let selectedDayVal = null;
let currentDayType = 'recurring';

function switchType(type) {
    currentDayType = type;
    document.getElementById('slotDayType').value = type;

    const isRec = type === 'recurring';
    document.getElementById('weekdayWrap').style.display  = isRec ? '' : 'none';
    document.getElementById('specificWrap').style.display = isRec ? 'none' : '';

    document.getElementById('btnRecurring').style.background = isRec ? '#f97316' : 'transparent';
    document.getElementById('btnRecurring').style.color      = isRec ? 'white' : '#64748b';
    document.getElementById('btnSpecific').style.background  = isRec ? 'transparent' : '#f97316';
    document.getElementById('btnSpecific').style.color       = isRec ? '#64748b' : 'white';
}

function pickDay(day, btn) {
    document.querySelectorAll('.dayPickBtn').forEach(b => {
        b.style.background = 'white'; b.style.color = '#64748b'; b.style.borderColor = '#e2e8f0';
    });
    btn.style.background = '#f97316'; btn.style.color = 'white'; btn.style.borderColor = '#f97316';
    selectedDayVal = day;
    document.getElementById('slotDayOfWeek').value = day;
}

function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Add Slot';
    document.getElementById('editSlotId').value = '';
    document.getElementById('slotStart').value  = '';
    document.getElementById('slotEnd').value    = '';
    document.getElementById('slotMax').value    = 1;
    document.getElementById('rate').value    = 1;
    document.getElementById('slotNote').value   = '';
    document.getElementById('slotSpecificDate').value = '';
    document.getElementById('slotDayOfWeek').value    = '';
    document.getElementById('portalSlotErr').style.display = 'none';
    selectedDayVal = null;
    document.querySelectorAll('.dayPickBtn').forEach(b => {
        b.style.background = 'white'; b.style.color = '#64748b'; b.style.borderColor = '#e2e8f0';
    });
    switchType('recurring');
    document.getElementById('slotModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function editSlot(slot) {
    document.getElementById('modalTitle').textContent = 'Edit Slot';
    document.getElementById('editSlotId').value = slot.id;
    document.getElementById('slotStart').value  = slot.start_time ?? slot.startTime;
    document.getElementById('slotEnd').value    = slot.end_time ?? slot.endTime;
    document.getElementById('slotMax').value    = slot.max_bookings ?? slot.maxBookings;
    document.getElementById('rate').value    = slot.rate ?? slot.rate;
    document.getElementById('slotNote').value   = slot.note ?? '';
    document.getElementById('portalSlotErr').style.display = 'none';

    const type = slot.day_type ?? slot.dayType;
    switchType(type);

    if (type === 'recurring') {
        const day = slot.day_of_week ?? slot.dayOfWeek;
        selectedDayVal = parseInt(day);
        document.getElementById('slotDayOfWeek').value = day;
        document.querySelectorAll('.dayPickBtn').forEach(b => {
            const active = parseInt(b.dataset.day) === selectedDayVal;
            b.style.background   = active ? '#f97316' : 'white';
            b.style.color        = active ? 'white' : '#64748b';
            b.style.borderColor  = active ? '#f97316' : '#e2e8f0';
        });
    } else {
        document.getElementById('slotSpecificDate').value = slot.slot_date ?? slot.slotDate ?? '';
    }

    document.getElementById('slotModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('slotModal').style.display = 'none';
    document.body.style.overflow = '';
}

document.getElementById('slotModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});

function savePortalSlot() {
    const id      = document.getElementById('editSlotId').value;
    const dayType = document.getElementById('slotDayType').value;
    const start   = document.getElementById('slotStart').value;
    const end     = document.getElementById('slotEnd').value;
    const max     = document.getElementById('slotMax').value;
    const note    = document.getElementById('slotNote').value;
    const rate    = document.getElementById('rate').value;
    const errEl   = document.getElementById('portalSlotErr');

    errEl.style.display = 'none';
    if (!start || !end) { errEl.textContent = 'Please enter start and end time.'; errEl.style.display = ''; return; }
    if (start >= end)   { errEl.textContent = 'End time must be after start time.'; errEl.style.display = ''; return; }

    const payload = { id, dayType, startTime: start, endTime: end, maxBookings: max, note,rate };

    if (dayType === 'recurring') {
        if (selectedDayVal === null) { errEl.textContent = 'Please select a day.'; errEl.style.display = ''; return; }
        payload.dayOfWeek = selectedDayVal;
    } else {
        const d = document.getElementById('slotSpecificDate').value;
        if (!d) { errEl.textContent = 'Please select a date.'; errEl.style.display = ''; return; }
        payload.slotDate = d;
    }

    const btn = document.getElementById('savePortalSlotBtn');
    btn.disabled = true; btn.textContent = 'Saving...';

   const url = id
    ? `{{ url('/pujari-portal/slots') }}/${id}`
    : '{{ route("front.pujariSlotsCreate") }}';

    fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify(payload),
    })
    .then(r => r.json())
    .then(res => {
        btn.disabled = false; btn.textContent = 'Save Slot';
        if (res.status == 200) { 
            closeModal(); 
            location.reload();
            }
        else { errEl.textContent = res.message; errEl.style.display = ''; }
    });
}

function toggleStatus(id, btn) {
   fetch('{{ route("front.pujariSlotsToggleStatus") }}', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json'
    },
    body: JSON.stringify({ id: id }),
})
    .then(r => r.json())
    .then(res => {
        if (res.status == 200) {
            btn.dataset.status = res.newStatus;
            const isActive = res.newStatus === 'active';
            btn.textContent = isActive ? 'Deactivate' : 'Activate';
            btn.style.background    = isActive ? '#fef2f2' : '#f0fdf4';
            btn.style.color         = isActive ? '#dc2626' : '#16a34a';
            btn.style.borderColor   = isActive ? '#fca5a5' : '#86efac';
            const badge = document.getElementById('badge_' + id);
            if (badge) {
                badge.textContent = isActive ? 'Active' : 'Inactive';
                badge.style.background = isActive ? '#f0fdf4' : '#fef2f2';
                badge.style.color      = isActive ? '#16a34a' : '#dc2626';
            }
        }
    });
}

function deleteSlot(id) {
    if (!confirm('Delete this slot?')) return;
    fetch('{{ route("front.pujariSlotsDelete") }}', {
    method: 'DELETE',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json'
    },
    body: JSON.stringify({ id: id }),
})
    .then(r => r.json())
    .then(res => {
        if (res.status == 200) {
            document.getElementById('slotCard_' + id)?.remove();
        }
    });
}
</script>