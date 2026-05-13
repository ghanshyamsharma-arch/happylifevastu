<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pujari Booking</title>
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
        <a href="{{ route('front.pujariBookings') }}" class="active">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            My Bookings
        </a>
        <a href="{{ route('front.pujariReviews') }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
            Reviews
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