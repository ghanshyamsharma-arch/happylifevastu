<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pujari Dashboard</title>
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


<div class="sidebar">
    <div class="sidebar-logo">
        <?php $logo = \Illuminate\Support\Facades\DB::table('systemflag')->where('name','logo')->value('value'); ?>
        <?php if($logo): ?>
            <img src="<?php echo e(Str::startsWith($logo,'http') ? $logo : asset($logo)); ?>" alt="Logo"
                 onerror="this.style.display='none'">
        <?php endif; ?>
        <p>Pujari Portal</p>
    </div>
    <nav class="sidebar-nav">
        <a href="<?php echo e(route('front.pujariDashboard')); ?>" class="active">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Dashboard
        </a>
        <a href="<?php echo e(route('front.pujariBookings')); ?>">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            My Bookings
        </a>
        <a href="<?php echo e(route('front.pujariReviews')); ?>">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
            Reviews
        </a>
        <a href="<?php echo e(route('front.pujariSlots')); ?>" >
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
            Slots
        </a>
        <a href="<?php echo e(route('front.pujariEditProfile')); ?>">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Edit Profile
        </a>
        <a href="<?php echo e(route('front.pujariLogout')); ?>" style="margin-top:auto; color: rgba(255,255,255,0.6);">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
            Logout
        </a>
    </nav>
</div>


<div class="main">
    <div class="topbar">
        <div>
            <h1>Dashboard</h1>
            <p style="font-size:13px;color:#64748b;">Welcome back, <?php echo e($pujari->name); ?></p>
        </div>
        <div class="topbar-right">
            <img class="avatar"
                 src="<?php echo e($pujari->profileImage ? (Str::startsWith($pujari->profileImage,'http') ? $pujari->profileImage : str_replace('storage/','public/storage/',asset($pujari->profileImage))) : '/build/assets/images/person.png'); ?>"
                 onerror="this.src='/build/assets/images/person.png'">
            <span class="pujari-name"><?php echo e($pujari->name); ?></span>
        </div>
    </div>

    
    <div class="profile-card" style="display:flex;align-items:center;gap:20px;">
    <img class="profile-avatar"
         src="<?php echo e($pujari->profileImage ? (Str::startsWith($pujari->profileImage,'http') ? $pujari->profileImage : str_replace('storage/','public/storage/',asset($pujari->profileImage))) : '/build/assets/images/person.png'); ?>"
         onerror="this.src='/build/assets/images/person.png'">

    <div>
        <h2 style="font-size:20px;font-weight:700;">
            <?php echo e($pujari->name); ?>

        </h2>

        <p style="font-size:13px;opacity:0.85;">
            <?php echo e($pujari->primarySkill); ?>

        </p>

        <p style="font-size:13px;opacity:0.8;margin-top:4px;">
            📍 <?php echo e($pujari->currentCity ?? 'N/A'); ?>

            &nbsp;·&nbsp;

            ⭐ <?php echo e(number_format($avgRating, 1)); ?>

            (<?php echo e($totalReviews); ?> reviews)

            &nbsp;·&nbsp;

            <?php echo e($pujari->experienceInYears ?? 0); ?> Yrs Exp
        </p>
    </div>

    <?php if(!$pujari->isVerified): ?>
    <span style="margin-left:auto;background:rgba(255,255,255,0.25);padding:6px 14px;border-radius:20px;font-size:12px;">
        Pending Verification
    </span>
    <?php endif; ?>
</div>

    
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon icon-orange">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <div class="stat-val"><?php echo e($totalBookings); ?></div>
            <div class="stat-lbl">Total Bookings</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-yellow">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="stat-val"><?php echo e($pendingBookings); ?></div>
            <div class="stat-lbl">Pending</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-green">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="stat-val"><?php echo e($completedBookings); ?></div>
            <div class="stat-lbl">Completed</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-blue">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="stat-val"><?php echo e($currency); ?><?php echo e(number_format($totalEarnings, 0)); ?></div>
            <div class="stat-lbl">Total Earnings</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-purple">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
            </div>
            <div class="stat-val"><?php echo e(number_format($avgRating, 1)); ?>/5</div>
            <div class="stat-lbl">Avg Rating</div>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

        
        <div class="section-card">
            <div class="section-header">
                <span class="section-title">Recent Bookings</span>
                <a href="<?php echo e(route('front.pujariBookings')); ?>" class="view-all">View All →</a>
            </div>
            <?php if($recentBookings->isEmpty()): ?>
                <p style="text-align:center;color:#94a3b8;padding:20px 0;">No bookings yet</p>
            <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Person</th>
                        <th>Puja / Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $recentBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <span style="font-weight:600;"><?php echo e($b->personName); ?></span><br>
                            <span style="font-size:12px;color:#94a3b8;"><?php echo e($b->personContact); ?></span>
                        </td>
                        <td>
                            <?php echo e($b->pujaName ?? 'Session'); ?><br>
                            <span style="font-size:12px;color:#94a3b8;"><?php echo e(\Carbon\Carbon::parse($b->bookingDate)->format('d M Y')); ?></span>
                        </td>
                        <td>
                            <span class="badge badge-<?php echo e($b->status); ?>"><?php echo e(str_replace('_',' ',$b->status)); ?></span>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>

        
        <div class="section-card">
            <div class="section-header">
                <span class="section-title">Recent Reviews</span>
                <a href="<?php echo e(route('front.pujariReviews')); ?>" class="view-all">View All →</a>
            </div>
            <?php if($recentReviews->isEmpty()): ?>
                <p style="text-align:center;color:#94a3b8;padding:20px 0;">No reviews yet</p>
            <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Reviewer</th>
                        <th>Rating</th>
                        <th>Review</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $recentReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="font-weight:600;"><?php echo e($r->reviewerName); ?></td>
                        <td>
                            <span class="star-filled">\u2605</span> <?php echo e(number_format($r->rating, 1)); ?>

                        </td>
                        <td style="max-width:160px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;color:#64748b;">
                            <?php echo e($r->review ?? '-'); ?>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html><?php /**PATH /home/happylifevastu/public_html/resources/views/frontend/pujari/dashboard.blade.php ENDPATH**/ ?>