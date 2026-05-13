@extends('frontend.layout.master')

@section('content')
<style>
/* ═══════════════════════════════════════════════════════
   PREMIUM MY APPOINTMENTS PAGE — Sacred Luxury Theme
   Matches overall website aesthetic
   ═══════════════════════════════════════════════════════ */

@import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Lato:wght@300;400;700&display=swap');

:root {
  --gold:          #c9a84c;
  --gold-light:    #e0c068;
  --gold-pale:     #fdf6e3;
  --gold-glow:     rgba(201,168,76,0.18);
  --dark:          #1a0e05;
  --white:         #ffffff;
  --cream:         #faf4ea;
  --cream-mid:     #f2e8d0;
  --border:        #e8d5b0;
  --text-dark:     #2c1a08;
  --text-mid:      #6b4c22;
  --text-muted:    #b08a55;
  --shadow-card:   0 4px 20px rgba(30,15,0,0.07);
  --shadow-hover:  0 16px 40px rgba(201,168,76,0.14), 0 4px 12px rgba(30,15,0,0.08);
  --radius-card:   20px;
  --transition:    0.32s cubic-bezier(0.22, 0.9, 0.36, 1);
  
  /* Status Colors */
  --status-pending:    #f0ad4e;
  --status-completed:  #5cb85c;
  --status-rejected:   #d9534f;
  --status-scheduled:  #5bc0de;
  --status-missed:     #f0ad4e;
}

.appointments-section {
  background: linear-gradient(135deg, var(--white) 0%, var(--cream) 100%);
  position: relative;
  min-height: 100vh;
  padding: 2rem 0 4rem;
}

/* Top shimmer line */
.appointments-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: linear-gradient(90deg, transparent 0%, var(--gold-light) 40%, var(--gold) 50%, var(--gold-light) 60%, transparent 100%);
  z-index: 2;
}

/* Warm noise texture */
.appointments-section::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 0;
}

.appointments-section .container {
  position: relative;
  z-index: 1;
}

/* ─── Page Header ─── */
.page-header {
  text-align: center;
  margin-bottom: 2rem;
}

.page-title {
  font-family: 'Cinzel', serif;
  font-size: clamp(28px, 5vw, 42px);
  font-weight: 700;
  color: var(--dark);
  margin: 0 0 0.5rem 0;
  display: inline-flex;
  align-items: center;
  gap: 12px;
}

.page-title i {
  color: var(--gold);
  font-size: 32px;
}

/* Gold divider */
.title-divider {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  margin: 10px 0 20px 0;
}

.title-divider::before,
.title-divider::after {
  content: '';
  display: block;
  width: 60px;
  height: 1px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

.gold-diamond {
  width: 8px;
  height: 8px;
  background: var(--gold);
  transform: rotate(45deg);
  display: inline-block;
  flex-shrink: 0;
}

/* ─── Filter Buttons ─── */
.filter-container {
  display: flex;
  justify-content: center;
  gap: 12px;
  flex-wrap: wrap;
  margin-bottom: 30px;
}

.filter-btn {
  background: transparent;
  border: 1px solid var(--border);
  border-radius: 40px;
  padding: 8px 24px;
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  color: var(--text-mid);
  transition: all 0.25s ease;
  cursor: pointer;
  text-decoration: none;
  display: inline-block;
}

.filter-btn:hover {
  border-color: var(--gold);
  color: var(--gold);
  transform: translateY(-2px);
}

.filter-btn.active {
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border-color: var(--gold);
  color: var(--white);
}

/* ─── Alert Messages ─── */
.sacred-alert {
  border-radius: 12px;
  border: none;
  padding: 12px 20px;
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  margin-bottom: 20px;
  text-align: center;
}

.sacred-alert-success {
  background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
  color: #155724;
  border-left: 4px solid #28a745;
}

.sacred-alert-error {
  background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
  color: #721c24;
  border-left: 4px solid #dc3545;
}

.sacred-alert-warning {
  background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
  color: #856404;
  border-left: 4px solid #ffc107;
}

.sacred-alert-info {
  background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
  color: #0c5460;
  border-left: 4px solid #17a2b8;
}

/* ─── Appointments Table ─── */
.appointments-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-card);
  overflow: hidden;
  box-shadow: var(--shadow-card);
}

.table-responsive {
  overflow-x: auto;
}

.sacred-table {
  width: 100%;
  border-collapse: collapse;
  font-family: 'Lato', sans-serif;
}

.sacred-table thead {
  background: linear-gradient(135deg, var(--cream) 0%, var(--gold-pale) 100%);
}

.sacred-table th {
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 700;
  color: var(--dark);
  padding: 15px 12px;
  text-align: center;
  border-bottom: 2px solid var(--gold);
}

.sacred-table td {
  padding: 15px 12px;
  text-align: center;
  border-bottom: 1px solid var(--border);
  color: var(--text-mid);
  font-size: 13px;
  vertical-align: middle;
}

.sacred-table tbody tr {
  transition: all var(--transition);
}

.sacred-table tbody tr:hover {
  background: var(--gold-pale);
}

/* Astrologer Info */
.astrologer-info {
  display: flex;
  align-items: center;
  gap: 10px;
  justify-content: center;
}

.astrologer-avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid var(--gold);
  cursor: pointer;
  transition: transform 0.2s ease;
}

.astrologer-avatar:hover {
  transform: scale(1.05);
}

.astrologer-name {
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  color: var(--dark);
}

/* Status Badges */
.status-badge {
  display: inline-block;
  padding: 5px 12px;
  border-radius: 30px;
  font-family: 'Cinzel', serif;
  font-size: 11px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.status-pending {
  background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
  color: #856404;
}

.status-completed {
  background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
  color: #155724;
}

.status-rejected {
  background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
  color: #721c24;
}

.status-scheduled {
  background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
  color: #0c5460;
}

.status-missed {
  background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
  color: #856404;
}

/* Cancel Button */
.cancel-btn {
  background: transparent;
  border: 1px solid #dc3545;
  border-radius: 30px;
  padding: 6px 16px;
  font-family: 'Cinzel', serif;
  font-size: 11px;
  font-weight: 600;
  color: #dc3545;
  transition: all 0.25s ease;
  cursor: pointer;
}

.cancel-btn:hover {
  background: #dc3545;
  color: var(--white);
  transform: translateY(-2px);
}

/* Empty State */
.empty-state {
  text-align: center;
  padding: 60px 20px;
  background: var(--white);
  border-radius: var(--radius-card);
  border: 1px solid var(--border);
}

.empty-state-icon {
  font-size: 64px;
  color: var(--border);
  margin-bottom: 20px;
}

.empty-state-icon i {
  background: linear-gradient(135deg, var(--border), var(--text-muted));
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}

.empty-state-title {
  font-family: 'Cinzel', serif;
  font-size: 22px;
  font-weight: 600;
  color: var(--text-mid);
  margin-bottom: 10px;
}

.empty-state-text {
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  color: var(--text-muted);
}

/* Responsive */
@media (max-width: 991px) {
  .sacred-table th,
  .sacred-table td {
    padding: 10px 8px;
    font-size: 12px;
  }
  
  .astrologer-avatar {
    width: 32px;
    height: 32px;
  }
  
  .astrologer-name {
    font-size: 12px;
  }
}

@media (max-width: 768px) {
  .sacred-table,
  .sacred-table tbody,
  .sacred-table tr,
  .sacred-table td {
    display: block;
  }
  
  .sacred-table thead {
    display: none;
  }
  
  .sacred-table tr {
    margin-bottom: 20px;
    border: 1px solid var(--border);
    border-radius: var(--radius-card);
    background: var(--white);
  }
  
  .sacred-table td {
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-align: right;
    padding: 12px 15px;
    border-bottom: 1px solid var(--border);
  }
  
  .sacred-table td:last-child {
    border-bottom: none;
  }
  
  .sacred-table td::before {
    content: attr(data-label);
    font-family: 'Cinzel', serif;
    font-weight: 600;
    color: var(--dark);
    font-size: 12px;
  }
  
  .astrologer-info {
    justify-content: flex-end;
  }
  
  .filter-btn {
    padding: 6px 16px;
    font-size: 11px;
  }
}

@media (max-width: 576px) {
  .appointments-section {
    padding: 1rem 0 2rem;
  }
  
  .page-title {
    font-size: 24px;
  }
  
  .page-title i {
    font-size: 24px;
  }
  
  .filter-container {
    gap: 8px;
  }
  
  .filter-btn {
    padding: 5px 12px;
    font-size: 10px;
  }
  
  .cancel-btn {
    padding: 5px 12px;
    font-size: 10px;
  }
}

/* Animation */
@keyframes fadeSlideUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.appointments-card {
  animation: fadeSlideUp 0.45s ease 0.05s backwards;
}

.filter-container {
  animation: fadeSlideUp 0.45s ease 0s backwards;
}
</style>

<div class="appointments-section">
    <div class="container">
        
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fa fa-calendar-check-o"></i>
                Sacred Appointments
            </h1>
            <div class="title-divider">
                <span class="gold-diamond"></span>
            </div>
            <p class="page-subtitle" style="font-family: 'Lato', sans-serif; color: var(--text-mid);">
                View and manage your divine consultation appointments
            </p>
        </div>

        <!-- Filter Links -->
        <div class="filter-container">
            <a href="javascript:void(0)" class="filter-btn active" data-status="All">All Appointments</a>
            <a href="javascript:void(0)" class="filter-btn" data-status="Rejected">Rejected</a>
            <a href="javascript:void(0)" class="filter-btn" data-status="Completed">Completed</a>
            <a href="javascript:void(0)" class="filter-btn" data-status="Missed">Missed</a>
            <a href="javascript:void(0)" class="filter-btn" data-status="Pending">Pending</a>
        </div>

        <!-- Flash Messages -->
        @foreach (['success' => 'success', 'error' => 'error', 'warning' => 'warning', 'info' => 'info'] as $msgType => $alertClass)
            @if(session($msgType))
                <div class="sacred-alert sacred-alert-{{ $alertClass }} alert-dismissible fade show" role="alert">
                    <i class="fa fa-{{ $msgType == 'success' ? 'check-circle' : ($msgType == 'error' ? 'exclamation-circle' : ($msgType == 'warning' ? 'warning' : 'info-circle')) }} mr-2"></i>
                    {{ session($msgType) }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="float: right; background: none; border: none; font-size: 20px; cursor: pointer;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        @endforeach

        @if($appointments->count() > 0)
            <div class="appointments-card">
                <div class="table-responsive">
                    <table class="sacred-table" id="appointmentsTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sacred Guide</th>
                                <th>Status</th>
                                <th>Call Type</th>
                                <th>Schedule Date</th>
                                <th>Schedule Time</th>
                                <th>Call Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $index => $appointment)
                                <tr data-status="{{ $appointment->callStatus }}">
                                    <td data-label="#">{{ $index + 1 }}</td>
                                    <td data-label="Sacred Guide">
                                        <div class="astrologer-info">
                                            <img class="astrologer-avatar" 
                                                 src="{{ Str::startsWith($appointment->profileImage, ['http://','https://']) ? $appointment->profileImage : '/' . $appointment->profileImage }}" 
                                                 onerror="this.onerror=null;this.src='/build/assets/images/person.png';" 
                                                 alt="{{ $appointment->astrologerName }}" 
                                                 onclick="openImage('{{ $appointment->profileImage }}')" />
                                            <span class="astrologer-name">{{ $appointment->astrologerName }}</span>
                                        </div>
                                    </td>
                                    <td data-label="Status">
                                        <span class="status-badge 
                                            @if($appointment->callStatus == 'Pending') status-pending 
                                            @elseif($appointment->callStatus == 'Completed') status-completed 
                                            @elseif($appointment->callStatus == 'Rejected') status-rejected 
                                            @elseif($appointment->callStatus == 'Missed') status-missed
                                            @elseif($appointment->IsSchedule == 1) status-scheduled 
                                            @endif">
                                            <i class="fa fa-{{ $appointment->callStatus == 'Completed' ? 'check-circle' : ($appointment->callStatus == 'Pending' ? 'hourglass-half' : ($appointment->callStatus == 'Rejected' ? 'times-circle' : 'calendar')) }} mr-1"></i>
                                            {{ $appointment->IsSchedule == 1 ? 'Scheduled' : $appointment->callStatus }}
                                        </span>
                                    </td>
                                    <td data-label="Call Type">
                                        <i class="fa fa-{{ $appointment->call_type == 10 ? 'phone' : 'video-camera' }} mr-1" style="color: var(--gold);"></i>
                                        {{ $appointment->call_type == 10 ? 'Audio Call' : 'Video Call' }}
                                    </td>
                                    <td data-label="Schedule Date">{{ $appointment->schedule_date ?? '-' }}</td>
                                    <td data-label="Schedule Time">{{ $appointment->schedule_time ?? '-' }}</td>
                                    <td data-label="Call Status">
                                        <span class="status-badge status-{{ strtolower($appointment->callStatus ?? 'pending') }}">
                                            {{ $appointment->callStatus ?? 'Pending' }}
                                        </span>
                                    </td>
                                    <td data-label="Action">
                                        <form action="{{ route('appointment.delete', $appointment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this sacred appointment?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="cancel-btn">
                                                <i class="fa fa-trash-o mr-1"></i> Cancel
                                            </button>
                                        </form>
                                    </td>
                                <tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fa fa-calendar-times-o"></i>
                </div>
                <h3 class="empty-state-title">No Sacred Appointments Found</h3>
                <p class="empty-state-text">You don't have any appointments scheduled at this moment.</p>
            </div>
        @endif
    </div>
</div>

<!-- Filter Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.filter-btn');
    const rows = document.querySelectorAll('#appointmentsTable tbody tr');

    // Set initial active state
    function setActiveButton(activeBtn) {
        buttons.forEach(btn => {
            btn.classList.remove('active');
        });
        activeBtn.classList.add('active');
    }

    // Filter function
    function filterTable(status) {
        let visibleCount = 0;
        
        rows.forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            
            if (status === 'All' || rowStatus === status) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
        
        // Optional: Show message if no rows visible
        const tableBody = document.querySelector('#appointmentsTable tbody');
        const existingMsg = document.querySelector('.no-results-msg');
        
        if (visibleCount === 0 && rows.length > 0) {
            if (!existingMsg) {
                const msgRow = document.createElement('tr');
                msgRow.className = 'no-results-msg';
                msgRow.innerHTML = `
                    <td colspan="8" class="text-center py-4" style="color: var(--text-muted);">
                        <i class="fa fa-search fa-2x mb-2 d-block"></i>
                        No appointments found for this status.
                    </td>
                `;
                tableBody.appendChild(msgRow);
            }
        } else if (existingMsg) {
            existingMsg.remove();
        }
    }

    // Add click handlers
    buttons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const status = this.getAttribute('data-status');
            setActiveButton(this);
            filterTable(status);
        });
    });
});
</script>
@endsection