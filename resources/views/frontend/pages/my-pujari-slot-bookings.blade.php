@extends('frontend.layout.master')

@section('content')
<div class="container-fluid py-4" style="background-color: #f8f9fa;">
    <div class="container">
        <!-- Page Header -->
        <div class="mb-4">
            <h1 class="h3 font-weight-bold text-dark">My Pujari Slot Bookings</h1>
        </div>

        @if($bookings->count() > 0)
            <div class="row g-3">
                @foreach($bookings as $booking)
                    <div class="col-lg-6 col-xl-6 mb-3">
                        <div class="card border-0 shadow-sm booking-card">
                            <!-- Card Header -->
                            <div class="card-header bg-gradient p-3" style="background: linear-gradient(135deg, #f97316 0%, #dc2626 100%);">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="card-title text-white mb-1">{{ $booking->pujaName ?? 'Puja Service' }}</h6>
                                        <small class="text-white-50">{{ $booking->personName ?? 'N/A' }}</small>
                                    </div>
                                    <span class="badge 
                                        @if($booking->status == 'completed')
                                            bg-success
                                        @elseif($booking->status == 'confirmed')
                                            bg-info
                                        @elseif($booking->status == 'pending')
                                            bg-warning text-dark
                                        @elseif($booking->status == 'cancelled')
                                            bg-danger
                                        @else
                                            bg-secondary
                                        @endif
                                    ">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body p-3">
                                <!-- Pujari Name -->
                                <div class="mb-2 pb-2 border-bottom">
                                    <small class="text-muted d-block mb-1"><strong>Pujari</strong></small>
                                    <p class="mb-0 small font-weight-bold">
                                        {{ $booking->pujariName ?? $booking->personName ?? 'N/A' }}
                                    </p>
                                </div>

                                <!-- Booking & Time Details -->
                                <div class="row mb-2 pb-2 border-bottom">
                                    <div class="col-6">
                                        <small class="text-muted d-block mb-1">Booking Date</small>
                                        <p class="mb-0 small font-weight-bold">
                                            {{ date('d M Y', strtotime($booking->bookingDate)) }}
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block mb-1">Time Slot</small>
                                        <p class="mb-0 small font-weight-bold">
                                            {{ $booking->timeSlot ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Contact Information -->
                                <div class="row mb-2 pb-2 border-bottom">
                                    <div class="col-6">
                                        @if($booking->personContact)
                                            <small class="text-muted d-block mb-1">Phone</small>
                                            <p class="small mb-0 font-weight-bold">{{ $booking->personContact }}</p>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        @if($booking->personEmail)
                                            <small class="text-muted d-block mb-1">Email</small>
                                            <p class="small mb-0" style="font-size: 0.8rem; word-break: break-word;">{{ $booking->personEmail }}</p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Location & Gotra -->
                                <div class="row mb-2 pb-2 border-bottom">
                                    <div class="col-6">
                                        @if($booking->location)
                                            <small class="text-muted d-block mb-1">Location</small>
                                            <p class="small mb-0 font-weight-bold">{{ ucfirst($booking->location) }}</p>
                                        @endif
                                        @if($booking->address)
                                            <small class="text-muted d-block mt-1 mb-1">Address</small>
                                            <p class="small mb-0">{{ $booking->address }}</p>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        @if($booking->gotra)
                                            <small class="text-muted d-block mb-1">Gotra</small>
                                            <p class="small mb-0 font-weight-bold">{{ $booking->gotra }}</p>
                                        @endif
                                        @if($booking->familyMemberNames)
                                            <small class="text-muted d-block mt-1 mb-1">Family</small>
                                            <p class="small mb-0">{{ $booking->familyMemberNames }}</p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Special Requirements (Compact) -->
                                @if($booking->specialRequirement)
                                    <div class="alert alert-light border-left border-warning mb-2 p-2">
                                        <small class="text-muted d-block mb-1"><strong>Special Req.</strong></small>
                                        <p class="small mb-0">{{ $booking->specialRequirement }}</p>
                                    </div>
                                @endif

                                <!-- Amount Details (Compact) -->
                                <div class="bg-light p-2 rounded mb-2">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <small class="text-muted d-block">Amount</small>
                                            <p class="mb-0 small font-weight-bold">₹ {{ number_format($booking->amount ?? 0, 2) }}</p>
                                        </div>
                                        <div class="col-6 text-right">
                                            <small class="text-muted d-block">Total</small>
                                            <p class="mb-0 small font-weight-bold text-warning">₹ {{ number_format($booking->totalAmount ?? 0, 2) }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment (Compact) -->
                                <div class="row">
                                    <div class="col-6">
                                        @if($booking->paymentMode)
                                            <small class="text-muted d-block mb-1">Payment Mode</small>
                                            <p class="small mb-0 font-weight-bold">{{ ucfirst($booking->paymentMode) }}</p>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        @if($booking->paymentStatus)
                                            <small class="text-muted d-block mb-1">Payment Status</small>
                                            <span class="badge 
                                                @if($booking->paymentStatus == 'paid')
                                                    bg-success
                                                @elseif($booking->paymentStatus == 'pending')
                                                    bg-warning text-dark
                                                @elseif($booking->paymentStatus == 'failed')
                                                    bg-danger
                                                @else
                                                    bg-secondary
                                                @endif
                                            ">
                                                {{ ucfirst($booking->paymentStatus) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Card Footer -->
                            <div class="card-footer bg-light border-top p-2">
                                <small class="text-muted d-block">
                                    Booked: {{ date('d M Y, h:i A', strtotime($booking->created_at)) }}
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="row mt-3">
                <div class="col-12 d-flex justify-content-center">
                    {{ $bookings->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card border-0 shadow-sm text-center py-4">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold mb-2">No Bookings Found</h5>
                            <p class="text-muted mb-3">You haven't booked any pujari slots yet.</p>
                            <a href="{{ route('pujari-list') }}" class="btn btn-warning btn-sm">
                                Book a Pujari Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    .booking-card {
        transition: all 0.3s ease;
    }

    .booking-card:hover {
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.12) !important;
        transform: translateY(-1px);
    }

    .card-header {
        border-radius: 0.25rem 0.25rem 0 0;
    }

    .badge {
        padding: 0.35rem 0.6rem;
        font-size: 0.7rem;
        font-weight: 600;
    }

    .text-warning {
        color: #f97316 !important;
    }

    .border-left {
        border-left: 3px solid #fbbf24 !important;
    }

    small.text-muted {
        color: #6b7280 !important;
    }

    @media (max-width: 768px) {
        .col-lg-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .card {
            margin-bottom: 0.5rem;
        }

        h6 {
            font-size: 0.95rem !important;
        }

        .small {
            font-size: 0.8rem !important;
        }
    }
</style>
@endsection