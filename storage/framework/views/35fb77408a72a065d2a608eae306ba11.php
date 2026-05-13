

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4" style="background-color: #f8f9fa;">
    <div class="container">
        <!-- Page Header -->
        <div class="mb-4">
            <h1 class="h3 font-weight-bold text-dark">My Pujari Slot Bookings</h1>
        </div>

        <?php if($bookings->count() > 0): ?>
            <div class="row g-3">
                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-6 col-xl-6 mb-3">
                        <div class="card border-0 shadow-sm booking-card">
                            <!-- Card Header -->
                            <div class="card-header bg-gradient p-3" style="background: linear-gradient(135deg, #f97316 0%, #dc2626 100%);">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="card-title text-white mb-1"><?php echo e($booking->pujaName ?? 'Puja Service'); ?></h6>
                                        <small class="text-white-50"><?php echo e($booking->personName ?? 'N/A'); ?></small>
                                    </div>
                                    <span class="badge 
                                        <?php if($booking->status == 'completed'): ?>
                                            bg-success
                                        <?php elseif($booking->status == 'confirmed'): ?>
                                            bg-info
                                        <?php elseif($booking->status == 'pending'): ?>
                                            bg-warning text-dark
                                        <?php elseif($booking->status == 'cancelled'): ?>
                                            bg-danger
                                        <?php else: ?>
                                            bg-secondary
                                        <?php endif; ?>
                                    ">
                                        <?php echo e(ucfirst($booking->status)); ?>

                                    </span>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body p-3">
                                <!-- Pujari Name -->
                                <div class="mb-2 pb-2 border-bottom">
                                    <small class="text-muted d-block mb-1"><strong>Pujari</strong></small>
                                    <p class="mb-0 small font-weight-bold">
                                        <?php echo e($booking->pujariName ?? $booking->personName ?? 'N/A'); ?>

                                    </p>
                                </div>

                                <!-- Booking & Time Details -->
                                <div class="row mb-2 pb-2 border-bottom">
                                    <div class="col-6">
                                        <small class="text-muted d-block mb-1">Booking Date</small>
                                        <p class="mb-0 small font-weight-bold">
                                            <?php echo e(date('d M Y', strtotime($booking->bookingDate))); ?>

                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block mb-1">Time Slot</small>
                                        <p class="mb-0 small font-weight-bold">
                                            <?php echo e($booking->timeSlot ?? 'N/A'); ?>

                                        </p>
                                    </div>
                                </div>

                                <!-- Contact Information -->
                                <div class="row mb-2 pb-2 border-bottom">
                                    <div class="col-6">
                                        <?php if($booking->personContact): ?>
                                            <small class="text-muted d-block mb-1">Phone</small>
                                            <p class="small mb-0 font-weight-bold"><?php echo e($booking->personContact); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-6">
                                        <?php if($booking->personEmail): ?>
                                            <small class="text-muted d-block mb-1">Email</small>
                                            <p class="small mb-0" style="font-size: 0.8rem; word-break: break-word;"><?php echo e($booking->personEmail); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Location & Gotra -->
                                <div class="row mb-2 pb-2 border-bottom">
                                    <div class="col-6">
                                        <?php if($booking->location): ?>
                                            <small class="text-muted d-block mb-1">Location</small>
                                            <p class="small mb-0 font-weight-bold"><?php echo e(ucfirst($booking->location)); ?></p>
                                        <?php endif; ?>
                                        <?php if($booking->address): ?>
                                            <small class="text-muted d-block mt-1 mb-1">Address</small>
                                            <p class="small mb-0"><?php echo e($booking->address); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-6">
                                        <?php if($booking->gotra): ?>
                                            <small class="text-muted d-block mb-1">Gotra</small>
                                            <p class="small mb-0 font-weight-bold"><?php echo e($booking->gotra); ?></p>
                                        <?php endif; ?>
                                        <?php if($booking->familyMemberNames): ?>
                                            <small class="text-muted d-block mt-1 mb-1">Family</small>
                                            <p class="small mb-0"><?php echo e($booking->familyMemberNames); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Special Requirements (Compact) -->
                                <?php if($booking->specialRequirement): ?>
                                    <div class="alert alert-light border-left border-warning mb-2 p-2">
                                        <small class="text-muted d-block mb-1"><strong>Special Req.</strong></small>
                                        <p class="small mb-0"><?php echo e($booking->specialRequirement); ?></p>
                                    </div>
                                <?php endif; ?>

                                <!-- Amount Details (Compact) -->
                                <div class="bg-light p-2 rounded mb-2">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <small class="text-muted d-block">Amount</small>
                                            <p class="mb-0 small font-weight-bold">₹ <?php echo e(number_format($booking->amount ?? 0, 2)); ?></p>
                                        </div>
                                        <div class="col-6 text-right">
                                            <small class="text-muted d-block">Total</small>
                                            <p class="mb-0 small font-weight-bold text-warning">₹ <?php echo e(number_format($booking->totalAmount ?? 0, 2)); ?></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment (Compact) -->
                                <div class="row">
                                    <div class="col-6">
                                        <?php if($booking->paymentMode): ?>
                                            <small class="text-muted d-block mb-1">Payment Mode</small>
                                            <p class="small mb-0 font-weight-bold"><?php echo e(ucfirst($booking->paymentMode)); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-6">
                                        <?php if($booking->paymentStatus): ?>
                                            <small class="text-muted d-block mb-1">Payment Status</small>
                                            <span class="badge 
                                                <?php if($booking->paymentStatus == 'paid'): ?>
                                                    bg-success
                                                <?php elseif($booking->paymentStatus == 'pending'): ?>
                                                    bg-warning text-dark
                                                <?php elseif($booking->paymentStatus == 'failed'): ?>
                                                    bg-danger
                                                <?php else: ?>
                                                    bg-secondary
                                                <?php endif; ?>
                                            ">
                                                <?php echo e(ucfirst($booking->paymentStatus)); ?>

                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Footer -->
                            <div class="card-footer bg-light border-top p-2">
                                <small class="text-muted d-block">
                                    Booked: <?php echo e(date('d M Y, h:i A', strtotime($booking->created_at))); ?>

                                </small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Pagination -->
            <div class="row mt-3">
                <div class="col-12 d-flex justify-content-center">
                    <?php echo e($bookings->links('pagination::bootstrap-4')); ?>

                </div>
            </div>
        <?php else: ?>
            <!-- Empty State -->
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card border-0 shadow-sm text-center py-4">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold mb-2">No Bookings Found</h5>
                            <p class="text-muted mb-3">You haven't booked any pujari slots yet.</p>
                            <a href="<?php echo e(route('pujari-list')); ?>" class="btn btn-warning btn-sm">
                                Book a Pujari Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/happylifevastu/public_html/resources/views/frontend/pages/my-pujari-slot-bookings.blade.php ENDPATH**/ ?>