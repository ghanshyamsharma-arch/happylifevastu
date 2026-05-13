

<?php $__env->startSection('content'); ?>
<div class="container mt-5 mb-5">
    <div class="row">
        <!-- Left Column: Pujari Profile -->
        <div class="col-lg-4 col-md-5 mb-4">
            <div class="card shadow-sm border-0">
                <!-- Profile Header -->
                <div class="card-body text-center pb-0">
                    <div class="mb-3">
                        <img src="<?php echo e($pujari->profileImage ? (Str::startsWith($pujari->profileImage,'http') ? $pujari->profileImage : str_replace('storage/','public/storage/',asset($pujari->profileImage))) : '/build/assets/images/person.png'); ?>"
                             onerror="this.onerror=null;this.src='<?php echo e(asset('public/frontend/images/user-avatar.png')); ?>';"
                             alt="<?php echo e($pujari->name); ?>"
                             class="rounded-circle"
                             style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #FF6B35;">
                    </div>
                    <h3 class="mb-1"><?php echo e($pujari->name); ?></h3>
                    <p class="text-muted mb-2"><?php echo e($pujari->primarySkill ?? 'Pujari'); ?></p>
                    <p class="text-muted small mb-3">
                        <i class="fas fa-map-marker-alt"></i> <?php echo e($pujari->currentCity ?? 'N/A'); ?>

                    </p>
                </div>

                <!-- Stats -->
                <div class="card-body py-3 border-top border-bottom">
                    <div class="row text-center">
                        <div class="col-4 border-right">
                            <h5 class="mb-0"><?php echo e($pujari->experienceInYears ?? 0); ?></h5>
                            <small class="text-muted">Yrs Exp</small>
                        </div>
                        <div class="col-4 border-right">
                            <h5 class="mb-0"><?php echo e($totalBookings ?? 0); ?></h5>
                            <small class="text-muted">Pujas Done</small>
                        </div>
                        <div class="col-4">
                            <h5 class="mb-0">
                                <span class="text-warning">★</span><?php echo e($avgRating ?? 0); ?>

                            </h5>
                            <small class="text-muted">(<?php echo e($totalReviews ?? 0); ?>)</small>
                        </div>
                    </div>
                </div>

                <!-- Rate Section -->
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <!--<span class="text-muted">Rate per Session:</span>-->
                        <!--<h5 class="mb-0 text-primary">-->
                        <!--    <?php echo e($currency->value ?? '₹'); ?><?php echo e(number_format($pujari->reportRate ?? 0, 0)); ?>-->
                        <!--</h5>-->
                    </div>
                </div>

                <!-- Actions -->
                <div class="card-body pt-0">
                    <button class="btn btn-primary w-100 mb-2" id="bookBtn" onclick="bookPujari()">
                        <i class="fas fa-calendar-alt"></i> Book Pujari
                    </button>
                    <?php if(!$isSelf): ?>
                        <button class="btn btn-outline-secondary w-100" 
                                id="blockBtn" 
                                onclick="blockPujari()">
                    
                            <i class="fas <?php echo e($exists ? 'fa-check' : 'fa-ban'); ?>"></i>
                    
                            <?php echo e($exists ? 'Unblock' : 'Block'); ?>

                    
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Right Column: Details -->
        <div class="col-lg-8 col-md-7">
            <!-- About Section -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0"><i class="fas fa-user-circle text-primary"></i> About</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted"><?php echo e($pujari->description ?? 'No description available'); ?></p>
                </div>
            </div>

            <!-- Services Section -->
            <?php if($pujas && count($pujas) > 0): ?>
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0"><i class="fas fa-list text-primary"></i> Services & Pujas</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php $__currentLoopData = $pujas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $puja): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6 mb-3">
                            <div class="service-card p-3 rounded border">
                                <h6 class="mb-2"><?php echo e($puja->name ?? 'Puja'); ?></h6>
                                <p class="text-muted small mb-2"><?php echo e($puja->categoryName ?? 'General'); ?></p>
                                <small class="badge badge-success">Available</small>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Reviews Section -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-star text-warning"></i> Reviews</h5>
                    <?php if(!$hasReviewed && !$isSelf): ?>
                    <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#reviewModal">
                        Write Review
                    </button>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <?php if($review && count($review) > 0): ?>
                        <?php $__currentLoopData = $review; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="review-item mb-4 pb-3 border-bottom">
                            <div class="d-flex mb-2">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0" style="color:#000"><?php echo e($rev->userName ?? 'Anonymous'); ?></h6>
                                    <small class="text-warning">
                                        <?php for($i = 0; $i < $rev->rating; $i++): ?>
                                            ★
                                        <?php endfor; ?>
                                        <span class="text-muted">(<?php echo e($rev->rating); ?>/5)</span>
                                    </small>
                                </div>
                                <small class="text-muted"><?php echo e(\Carbon\Carbon::parse($rev->created_at)->diffForHumans()); ?></small>
                            </div>
                            <p class="text-muted mb-0"><?php echo e($rev->comment ?? 'No comment'); ?></p>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <p class="text-muted text-center py-3">No reviews yet</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Review Modal -->
<?php if(!$isSelf): ?>
<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Write Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="reviewForm">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Rating</label>
                        <div class="rating-input">
                            <input type="hidden" id="rating" name="rating" value="5">
                            <div class="stars">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                <span class="star" data-value="<?php echo e($i); ?>" style="cursor: pointer; font-size: 24px; color: #ddd; margin-right: 5px;">★</span>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Comment</label>
                        <textarea class="form-control" id="comment" name="comment" rows="4" placeholder="Share your experience..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<style>
    .service-card {
        transition: all 0.3s ease;
        background: #f8f9fa;
    }
    
    .service-card:hover {
        box-shadow: 0 2px 8px rgba(255, 107, 53, 0.1);
        border-color: #FF6B35 !important;
    }

    .review-item:last-child {
        border-bottom: none;
    }

    .stars span {
        transition: color 0.2s ease;
    }

   form#reviewForm {
    padding: 20px;
}
    .stars span.active {
    color: #ffc107  !important;
}
</style>

<script>
    // Rating stars interaction
    document.querySelectorAll('.stars span').forEach(star => {
        star.addEventListener('click', function() {
            const rating = this.getAttribute('data-value');
            document.getElementById('rating').value = rating;
            
            document.querySelectorAll('.stars span').forEach((s, index) => {
                if (index < rating) {
                    s.classList.add('active');
                } else {
                    s.classList.remove('active');
                }
            });
        });
    });

    // Set initial rating
    document.querySelectorAll('.stars span').forEach((s, index) => {
        if (index < 5) {
            s.classList.add('active');
        }
    });

    function bookPujari() {
        <?php if(Auth::check()): ?>
            window.location.href = '<?php echo e(route("front.pujariBookingPage", $pujari->slug)); ?>';
        <?php else: ?>
            Swal.fire({
                title: 'Login Required',
                text: 'Please login to book this Pujari',
                icon: 'info',
                confirmButtonText: 'Login Now'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?php echo e(route("login")); ?>';
                }
            });
        <?php endif; ?>
    }

    function blockPujari() {
        <?php if(Auth::check()): ?>
            const isBlocked = <?php echo e($exists ? 'true' : 'false'); ?>;

Swal.fire({
    title: isBlocked ? 'Unblock Pujari?' : 'Block Pujari?',
    text: isBlocked
        ? 'This Pujari will appear again in your search results'
        : 'You will not see this Pujari in your search results',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: isBlocked ? 'Unblock' : 'Block'
}).then((result) => {

    if (result.isConfirmed) {

        $.ajax({
            url: '<?php echo e(route("front.blockPujari")); ?>',
            method: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                pujariId: <?php echo e($pujari->id); ?>

            },

            success: function(response) {

                Swal.fire(
                    response.action,
                    response.message,
                    'success'
                );

                // Button Update
                let blockBtn = document.getElementById('blockBtn');

                if (response.status == 'blocked') {

                    blockBtn.innerHTML =
                        '<i class="fas fa-check"></i> Unblock';

                } else {

                    blockBtn.innerHTML =
                        '<i class="fas fa-ban"></i> Block';
                }
            }
        });

    }

});
        <?php else: ?>
            Swal.fire({
                title: 'Login Required',
                text: 'Please login to block Pujaris',
                icon: 'info',
                confirmButtonText: 'Login Now'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?php echo e(route("login")); ?>';
                }
            });
        <?php endif; ?>
    }

    // Review form submission
    <?php if(!$isSelf): ?>
    document.getElementById('reviewForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        <?php if(Auth::check()): ?>
            $.ajax({
                url: '<?php echo e(route("front.pujariSubmitReview")); ?>',
                method: 'POST',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    pujariId: <?php echo e($pujari->id); ?>,
                    rating: document.getElementById('rating').value,
                    comment: document.getElementById('comment').value
                },
                success: function(response) {
                    if(response.status==200){
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload();
                        });
                    }else{
                        Swal.fire({
                            title: 'Error !',
                            text: response.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload();
                        });
                    }
                     $('#reviewModal').on('hidden.bs.modal', function () {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire('Error!', xhr.responseJSON?.message || 'Failed to submit review', 'error');
                }
            });
        <?php else: ?>
            Swal.fire('Login Required', 'Please login to submit review', 'info');
        <?php endif; ?>
    });
    <?php endif; ?>
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/happylifevastu/public_html/resources/views/frontend/pages/pujari-details.blade.php ENDPATH**/ ?>