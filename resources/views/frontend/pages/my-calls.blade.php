@extends('frontend.layout.master')
@section('content')
<style>
/* ═══════════════════════════════════════════════════════
   PREMIUM MY CALLS PAGE — Sacred Luxury Theme
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
  --success:       #28a745;
  --danger:        #dc3545;
}

.calls-section {
  background: linear-gradient(135deg, var(--white) 0%, var(--cream) 100%);
  position: relative;
  min-height: 100vh;
  padding: 1rem 0 4rem;
}

/* Top shimmer line */
.calls-section::before {
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
.calls-section::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 0;
}

.calls-section .container {
  position: relative;
  z-index: 1;
}

/* ─── Breadcrumb Styling ─── */
.sacred-breadcrumb {
  background: linear-gradient(135deg, var(--cream) 0%, var(--white) 100%);
  border-bottom: 1px solid var(--border);
  margin-bottom: 0;
}

.sacred-breadcrumb .breadcrumbs {
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  letter-spacing: 0.5px;
}

.sacred-breadcrumb .breadcrumbs a {
  color: var(--text-mid);
  transition: color 0.2s ease;
}

.sacred-breadcrumb .breadcrumbs a:hover {
  color: var(--gold);
  text-decoration: none;
}

.sacred-breadcrumb .breadcrumbs i {
  font-size: 11px;
  color: var(--gold);
  margin: 0 6px;
}

/* ─── Page Header ─── */
.page-header {
  margin-bottom: 1.5rem;
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
  gap: 10px;
  margin: 10px 0 15px 0;
}

.title-divider::before {
  content: '';
  display: block;
  width: 48px;
  height: 1px;
  background: linear-gradient(to right, transparent, var(--gold));
}

.title-divider::after {
  content: '';
  display: block;
  flex: 1;
  height: 1px;
  background: linear-gradient(to right, var(--gold), transparent);
}

.gold-diamond {
  width: 7px;
  height: 7px;
  background: var(--gold);
  transform: rotate(45deg);
  display: inline-block;
  flex-shrink: 0;
}

.page-subtitle {
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  color: var(--text-mid);
}

/* ─── Section Header ─── */
.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  margin-bottom: 20px;
  padding-bottom: 10px;
  border-bottom: 2px solid var(--gold);
}

.section-title {
  font-family: 'Cinzel', serif;
  font-size: 20px;
  font-weight: 700;
  color: var(--dark);
  margin: 0;
}

.section-title i {
  color: var(--gold);
  margin-right: 8px;
}

/* ─── Calls Card ─── */
.calls-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-card);
  overflow: hidden;
  box-shadow: var(--shadow-card);
}

.table-container {
  max-height: 500px;
  overflow-y: auto;
}

/* Custom scrollbar */
.table-container::-webkit-scrollbar {
  width: 6px;
}

.table-container::-webkit-scrollbar-track {
  background: var(--cream-mid);
  border-radius: 10px;
}

.table-container::-webkit-scrollbar-thumb {
  background: var(--gold);
  border-radius: 10px;
}

/* ─── Sacred Table ─── */
.sacred-table {
  width: 100%;
  border-collapse: collapse;
  font-family: 'Lato', sans-serif;
}

.sacred-table thead {
  background: linear-gradient(135deg, var(--cream) 0%, var(--gold-pale) 100%);
  position: sticky;
  top: 0;
  z-index: 10;
}

.sacred-table th {
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 700;
  color: var(--dark);
  padding: 15px 20px;
  text-align: left;
  border-bottom: 2px solid var(--gold);
}

.sacred-table td {
  padding: 20px;
  border-bottom: 1px solid var(--border);
  vertical-align: middle;
}

.sacred-table tbody tr {
  transition: all var(--transition);
}

.sacred-table tbody tr:hover {
  background: var(--gold-pale);
}

/* Call Details */
.call-type-badge {
  display: inline-block;
  padding: 3px 10px;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 600;
  margin-right: 8px;
}

.call-type-audio {
  background: linear-gradient(135deg, #e3f2fd 0%, #bbdef5 100%);
  color: #1565c0;
}

.call-type-video {
  background: linear-gradient(135deg, #f3e5f5 0%, #e1bee7 100%);
  color: #6a1b9a;
}

.astrologer-name {
  font-family: 'Cinzel', serif;
  font-size: 15px;
  font-weight: 700;
  color: var(--dark);
  margin: 0 0 4px 0;
}

.call-duration {
  font-family: 'Lato', sans-serif;
  font-size: 12px;
  color: var(--text-muted);
  margin: 0;
}

.call-date {
  font-family: 'Lato', sans-serif;
  font-size: 12px;
  color: var(--text-muted);
  margin-top: 6px;
}

.call-date i {
  color: var(--gold);
  margin-right: 4px;
}

.status-completed {
  display: inline-block;
  padding: 4px 12px;
  border-radius: 30px;
  background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
  color: #155724;
  font-family: 'Cinzel', serif;
  font-size: 11px;
  font-weight: 600;
  margin-top: 6px;
}

/* Deduction Amount */
.deduction-amount {
  font-family: 'Cinzel', serif;
  font-size: 18px;
  font-weight: 800;
  color: var(--gold);
}

.deduction-symbol {
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  color: var(--text-muted);
}

/* Review Button */
.review-btn {
  background: transparent;
  border: 1px solid var(--gold);
  border-radius: 30px;
  padding: 8px 20px;
  font-family: 'Cinzel', serif;
  font-size: 12px;
  font-weight: 600;
  color: var(--gold);
  transition: all 0.25s ease;
  cursor: pointer;
}

.review-btn:hover {
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  color: var(--white);
  transform: translateY(-2px);
}

/* Empty State */
.empty-state {
  text-align: center;
  padding: 60px 20px;
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

/* ─── Modal Styling ─── */
.sacred-modal .modal-content {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-card);
  box-shadow: var(--shadow-hover);
}

.sacred-modal .modal-header {
  background: linear-gradient(135deg, var(--cream) 0%, var(--gold-pale) 100%);
  border-bottom: 1px solid var(--border);
  padding: 16px 20px;
}

.sacred-modal .modal-title {
  font-family: 'Cinzel', serif;
  font-size: 18px;
  font-weight: 700;
  color: var(--gold);
}

.sacred-modal .close {
  color: var(--text-mid);
  opacity: 0.7;
  transition: opacity 0.2s ease;
}

.sacred-modal .close:hover {
  color: var(--gold);
  opacity: 1;
}

/* Star Rating */
.star-rating {
  display: flex;
  flex-direction: row-reverse;
  justify-content: center;
  gap: 8px;
  margin: 15px 0;
}

.star-rating input {
  display: none;
}

.star-rating label {
  font-size: 30px;
  color: #ddd;
  cursor: pointer;
  transition: color 0.2s ease;
}

.star-rating label:before {
  content: "★";
}

.star-rating input:checked ~ label {
  color: var(--gold);
}

.star-rating label:hover,
.star-rating label:hover ~ label {
  color: var(--gold-light);
}

/* Modal Form */
.modal-form-group {
  margin-bottom: 20px;
}

.modal-form-group label {
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  color: var(--dark);
  margin-bottom: 8px;
  display: block;
}

.modal-form-group textarea {
  width: 100%;
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 10px 14px;
  resize: vertical;
  transition: all 0.2s ease;
}

.modal-form-group textarea:focus {
  border-color: var(--gold);
  box-shadow: 0 0 0 3px var(--gold-glow);
  outline: none;
}

.modal-submit-btn {
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border: none;
  border-radius: 40px;
  padding: 10px 28px;
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  color: var(--white);
  transition: all 0.25s ease;
  cursor: pointer;
}

.modal-submit-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(201,168,76,0.3);
}

/* Responsive */
@media (max-width: 991px) {
  .sacred-table th,
  .sacred-table td {
    padding: 15px;
  }
  
  .astrologer-name {
    font-size: 14px;
  }
  
  .deduction-amount {
    font-size: 16px;
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
    padding: 15px;
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
  
  .section-header {
    flex-direction: column;
    gap: 10px;
  }
  
  .review-btn {
    padding: 6px 16px;
    font-size: 11px;
  }
}

@media (max-width: 576px) {
  .calls-section {
    padding: 0.5rem 0 2rem;
  }
  
  .page-title {
    font-size: 24px;
  }
  
  .page-title i {
    font-size: 24px;
  }
  
  .section-title {
    font-size: 18px;
  }
  
  .astrologer-name {
    font-size: 13px;
  }
  
  .deduction-amount {
    font-size: 14px;
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

.calls-card {
  animation: fadeSlideUp 0.45s ease 0.05s backwards;
}

.page-header {
  animation: fadeSlideUp 0.45s ease 0s backwards;
}
</style>

@php
$userId = authcheck()['id'];
@endphp

<div class="calls-section">
    <!-- Sacred Breadcrumb -->
    <div class="sacred-breadcrumb pt-3 pb-3 d-none d-md-block">
        <div class="container">
            <div class="row afterLoginDisplay">
                <div class="col-md-12 d-flex align-items-center">
                    <span class="breadcrumbs">
                        <a href="{{ route('front.home') }}">
                            <i class="fa fa-home"></i> Home
                        </a>
                        <i class="fa fa-chevron-right"></i>
                        <span style="color: var(--gold);">Sacred Calls</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="inpage">
                    
                    <!-- Page Header -->
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="fa fa-phone"></i>
                            Sacred Calls
                        </h1>
                        <div class="title-divider">
                            <span class="gold-diamond"></span>
                        </div>
                        <p class="page-subtitle">
                            <i class="fa fa-history mr-2" style="color: var(--gold);"></i>
                            View your complete divine call history
                        </p>
                    </div>

                    <!-- Calls Section -->
                    <div class="calls-card">
                        <div class="section-header p-3">
                            <h3 class="section-title">
                                <i class="fa fa-list-ul"></i>
                                Call History
                            </h3>
                        </div>

                        <div class="table-container">
                            <table class="sacred-table">
                                <thead>
                                    <tr>
                                        <th>Call Details</th>
                                        <th>Deduction</th>
                                        <th class="text-center">Review</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($getUserById['recordList'][0]['callRequest']['callHistory']))
                                        @foreach ($getUserById['recordList'][0]['callRequest']['callHistory'] as $calldata)
                                            @if (!empty($calldata))
                                                <tr>
                                                    <td data-label="Call Details">
                                                        <div>
                                                            <span class="call-type-badge call-type-{{ $calldata['call_type'] == 10 ? 'audio' : 'video' }}">
                                                                <i class="fa fa-{{ $calldata['call_type'] == 10 ? 'phone' : 'video-camera' }} mr-1"></i>
                                                                {{ $calldata['call_type'] == 10 ? 'Audio Call' : 'Video Call' }}
                                                            </span>
                                                            <h5 class="astrologer-name">
                                                                with {{ $calldata['astrologerName'] }}
                                                            </h5>
                                                            <p class="call-duration">
                                                                <i class="fa fa-clock-o"></i> Duration: {{ $calldata['totalMin'] }} minutes
                                                            </p>
                                                        </div>
                                                        <div class="call-date">
                                                            <i class="fa fa-calendar"></i>
                                                            {{ date('d-m-Y h:i a', strtotime($calldata['created_at'])) }}
                                                        </div>
                                                        <div class="status-completed">
                                                            <i class="fa fa-check-circle mr-1"></i> Completed
                                                        </div>
                                                    </td>
                                                    <td data-label="Deduction" class="text-danger">
                                                        <div class="deduction-amount">
                                                            <span class="deduction-symbol">(-)</span>
                                                            @if($walletType == 'coin')
                                                                <img src="{{ asset($coinIcon) }}" alt="Wallet Icon" width="14" style="display:inline; margin-right:2px;">
                                                            @else
                                                                <span class="deduction-symbol">{{ $currency['value'] }}</span>
                                                            @endif
                                                            {{ number_format($calldata['deduction'], 2) }}
                                                        </div>
                                                    </td>
                                                    <td data-label="Review" class="text-center">
                                                        <a href="javascript:void(0)" 
                                                           data-toggle="modal" 
                                                           data-target="#reviewmodal" 
                                                           class="reviewBtn review-btn" 
                                                           data-astrologer-id="{{ $calldata['astrologerId'] }}">
                                                            <i class="fa fa-star mr-1"></i> Write Review
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3">
                                                <div class="empty-state">
                                                    <div class="empty-state-icon">
                                                        <i class="fa fa-phone"></i>
                                                    </div>
                                                    <h3 class="empty-state-title">No Call History Found</h3>
                                                    <p class="empty-state-text">You haven't made any sacred calls yet.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Review Modal -->
<div id="reviewmodal" class="modal fade sacred-modal" role="dialog">
    <div class="modal-dialog modal-sm h-100 d-flex align-items-center">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <i class="fa fa-star mr-2"></i> Share Your Experience
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="Review">
                    <input type="hidden" name="userId" id="userId" value="{{ $userId }}">
                    <input type="hidden" id="astrologerId" name="astrologerId" value="">

                    <div class="text-center">
                        <div class="modal-form-group">
                            <label>Your Sacred Rating</label>
                            <div class="star-rating">
                                <input type="radio" id="star5" name="rating" value="5"><label for="star5"></label>
                                <input type="radio" id="star4" name="rating" value="4"><label for="star4"></label>
                                <input type="radio" id="star3" name="rating" value="3"><label for="star3"></label>
                                <input type="radio" id="star2" name="rating" value="2"><label for="star2"></label>
                                <input type="radio" id="star1" name="rating" value="1"><label for="star1"></label>
                            </div>
                        </div>
                        <div class="modal-form-group">
                            <label>Your Review</label>
                            <textarea id="review" name="review" rows="4" placeholder="Share your sacred experience with the astrologer...">{{ isset($getUserHistoryReview['recordList'][0]['review']) ? $getUserHistoryReview['recordList'][0]['review'] : '' }}</textarea>
                        </div>
                        <button class="modal-submit-btn" id="reviewbtn">
                            <i class="fa fa-paper-plane mr-2"></i> Submit Review
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    $('.reviewBtn').click(function () {
        var astrologerId = $(this).data('astrologer-id');
        $('#astrologerId').val(astrologerId);
    });
});

$('#reviewbtn').click(function(e) {
    e.preventDefault();

    var form = document.getElementById('Review');
    if (form.checkValidity() === false) {
        form.reportValidity();
        return;
    }

    @php
        use Symfony\Component\HttpFoundation\Session\Session;
        $session = new Session();
        $token = $session->get('token');
    @endphp

    var formData = $('#Review').serialize();

    $('#reviewbtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin mr-2"></i> Submitting...');

    $.ajax({
        url: "{{ route('api.addUserReview', ['token' => $token]) }}",
        type: 'POST',
        data: formData,
        success: function(response) {
            toastr.success('Review Added Successfully');
            setTimeout(function() {
                window.location.reload();
            }, 2000);
        },
        error: function(xhr, status, error) {
            toastr.error(xhr.responseText);
            $('#reviewbtn').prop('disabled', false).html('<i class="fa fa-paper-plane mr-2"></i> Submit Review');
        }
    });
});
</script>
@endsection