

<?php $__env->startSection('content'); ?>
<style>
/* Premium Astrology Theme - Puja List Page */
:root {
  --gold: #c9a84c;
  --gold-light: #e0c068;
  --gold-pale: #fdf6e3;
  --dark: #1a0e05;
  --dark-mid: #2d1a08;
  --white: #ffffff;
  --cream: #faf4ea;
  --cream-mid: #f2e8d0;
  --border: #e8d5b0;
  --border-gold: #c9a84c44;
  --text-dark: #2c1a08;
  --text-mid: #6b4c22;
  --text-muted: #b08a55;
}

/* Main Container */
.puja-list-section {
  background: var(--white);
  position: relative;
  padding: 2rem 0;
}

.puja-list-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

/* Section Header */
.puja-list-section .section-header {
  text-align: center;
  margin-bottom: 2rem;
}

.puja-list-section .eyebrow {
  font-family: 'Cinzel', serif;
  font-size: 10px;
  letter-spacing: 3px;
  color: var(--gold);
  text-transform: uppercase;
  margin-bottom: 0.55rem;
}

.puja-list-section .section-title {
  font-family: 'Cinzel', serif;
  font-size: 19px;
  font-weight: 600;
  color: var(--dark);
  margin-bottom: 0.2rem;
}

.puja-list-section .gold-line {
  width: 38px;
  height: 2px;
  background: var(--gold);
  margin: 0.55rem auto 0;
}

/* Puja Cards Container */
.container.mt-5.mb-5.pujalist-show {
  display: flex;
  flex-wrap: wrap;
  gap: 24px;
  justify-content: center;
}

/* Puja Card - Premium Styling */
.scard {
  width: 320px;
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: 16px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
  position: relative;
}

.scard::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.scard:hover {
  transform: translateY(-6px);
  border-color: var(--gold);
  box-shadow: 0 12px 28px rgba(201, 168, 76, 0.12);
}

.scard:hover::before {
  opacity: 1;
}

/* Card Image */
.imgb {
  width: 100%;
  height: 200px;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.scard:hover .imgb {
  transform: scale(1.03);
}

/* Category Badge */
.scard .category-badge {
  background: var(--gold-pale);
  border: 1px solid var(--border-gold);
  border-radius: 50px;
  padding: 4px 12px;
  display: inline-block;
  margin: 12px auto 0;
  text-align: center;
  width: fit-content;
}

.scard .category-badge small {
  font-family: 'Cinzel', serif;
  font-size: 9px;
  letter-spacing: 1px;
  color: var(--gold);
  text-transform: uppercase;
}

/* Divider */
.scard .divider-light {
  border-bottom: 1px solid var(--border);
  margin: 10px 0;
}

/* Content Area */
.descrb {
  padding: 0 12px;
  flex: 1;
}

.descrb h3 {
  font-family: 'Cinzel', serif;
  font-size: 15px;
  font-weight: 600;
  color: var(--dark);
  margin: 12px 0 6px;
  line-height: 1.35;
}

.descrb span {
  font-size: 12px;
  color: var(--text-muted);
  line-height: 1.5;
}

/* Location Icon */
.location-info {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  padding: 0 12px;
  margin-top: 10px;
}

.location-info i {
  color: var(--gold);
  font-size: 14px;
  margin-top: 2px;
}

.location-info span {
  font-size: 12px;
  color: var(--text-mid);
  line-height: 1.4;
}

/* Date Info */
.date-info {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  padding: 0 12px;
  margin-top: 8px;
}

.date-info .icon-circle {
  width: 28px;
  height: 28px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--gold-pale);
  border-radius: 50%;
}

.date-info .icon-circle i {
  color: var(--gold);
  font-size: 12px;
}

.date-info .date-text {
  font-size: 12px;
  color: var(--text-mid);
  line-height: 1.4;
}

/* Divider */
.scard hr {
  border: none;
  border-top: 1px solid var(--border);
  margin: 12px 12px;
}

/* Participate Button */
.puja-footer {
  padding: 0 12px 16px;
}

.read {
  background: var(--gold);
  border: none;
  color: var(--dark);
  font-family: 'Cinzel', serif;
  font-size: 11px;
  font-weight: 600;
  letter-spacing: 1px;
  padding: 10px 16px;
  border-radius: 50px;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  text-decoration: none;
  width: 100%;
}

.read:hover {
  background: var(--gold-light);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(201, 168, 76, 0.3);
  text-decoration: none;
  color: var(--dark);
}

.read i {
  transition: transform 0.2s ease;
}

.read:hover i {
  transform: translateX(3px);
}

/* Empty State */
.empty-state {
  text-align: center;
  padding: 3rem;
  background: var(--cream);
  border-radius: 24px;
  margin: 2rem auto;
}

.empty-state img {
  max-width: 200px;
  opacity: 0.6;
  margin-bottom: 1rem;
}

.empty-state h3 {
  font-family: 'Cinzel', serif;
  font-size: 18px;
  color: var(--text-mid);
}

/* Pagination - Premium Styling */
.pagination-wrapper {
  margin-top: 2rem;
  text-align: center;
  padding-bottom: 2rem;
}

.pagination-wrapper .pagination {
  display: flex;
  justify-content: center;
  gap: 6px;
  flex-wrap: wrap;
}

.pagination-wrapper .page-item {
  list-style: none;
}

.pagination-wrapper .page-link {
  font-family: 'Cinzel', serif;
  font-size: 12px;
  padding: 8px 14px;
  color: var(--text-mid);
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: 50px;
  transition: all 0.3s ease;
  text-decoration: none;
}

.pagination-wrapper .page-link:hover {
  background: var(--gold-pale);
  border-color: var(--gold);
  color: var(--gold);
}

.pagination-wrapper .active .page-link {
  background: var(--gold);
  border-color: var(--gold);
  color: var(--dark);
}

.pagination-wrapper .disabled .page-link {
  opacity: 0.5;
  cursor: not-allowed;
}

/* Responsive */
@media (max-width: 768px) {
  .scard {
    width: calc(50% - 12px);
    min-width: 240px;
  }
  
  .descrb h3 {
    font-size: 13px;
  }
  
  .puja-list-section {
    padding: 1.5rem 0;
  }
}

@media (max-width: 576px) {
  .scard {
    width: 100%;
    max-width: 320px;
    margin: 0 auto;
  }
  
  .imgb {
    height: 180px;
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

.scard {
  animation: fadeSlideUp 0.4s ease backwards;
}

.scard:nth-child(1) { animation-delay: 0.05s; }
.scard:nth-child(2) { animation-delay: 0.1s; }
.scard:nth-child(3) { animation-delay: 0.15s; }
.scard:nth-child(4) { animation-delay: 0.2s; }
.scard:nth-child(5) { animation-delay: 0.25s; }
.scard:nth-child(6) { animation-delay: 0.3s; }
</style>

<div class="puja-list-section">
    <?php if($pujalists->isEmpty()): ?>
        <div class="container mt-5 mb-5">
            <div class="empty-state">
                <img src="<?php echo e(asset('public/frontend/homeimage/360.png')); ?>" alt="No Puja Found" class="img-fluid" />
                <h3>No Puja Found </h3>
                <p class="text-muted mt-2">Please check back later for upcoming spiritual ceremonies.</p>
            </div>
        </div>
    <?php else: ?>
        <div class="container">
            <!-- Section Header -->
            <div class="section-header">
                <p class="eyebrow">Sacred Ceremonies </p>
                <h2 class="section-title">Puja & Rituals</h2>
                <div class="gold-line"></div>
            </div>
            
            <!-- Puja Cards Grid -->
            <div class="container mt-4 mb-5 pujalist-show">
                <?php $__currentLoopData = $pujalists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $puja): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $startDatetime = $puja->puja_start_datetime ? \Carbon\Carbon::parse($puja->puja_start_datetime) : null;
                    $endDatetime = $puja->puja_end_datetime ? \Carbon\Carbon::parse($puja->puja_end_datetime) : null;

                    if($startDatetime && $endDatetime && $startDatetime->eq($endDatetime)) continue;

                    $images = $puja->puja_images;
                    $firstImage = !empty($images) ? $images[0] : 'path/to/default/image.jpg';

                    $startDateDisplay = $startDatetime ? $startDatetime->format('j M, D') : 'Date not available';
                    $endDateDisplay = $endDatetime ? $endDatetime->format('j M, D') : '';
                    $startTimeDisplay = $startDatetime ? $startDatetime->format('H:i') : '';
                    $endTimeDisplay = $endDatetime ? $endDatetime->format('H:i') : '';
                    $sameDate = $startDatetime && $endDatetime ? $startDatetime->isSameDay($endDatetime) : true;
                    ?>
                    <div class="scard">
                        <img class="imgb" src="<?php echo e(Str::startsWith($firstImage, ['http://','https://']) ? $firstImage : '/' . $firstImage); ?>" onerror="this.onerror=null;this.src='/build/assets/images/person.png';" alt="<?php echo e($puja->puja_title); ?>" onclick="openImage('<?php echo e($firstImage); ?>')" />
                        
                        <div class="category-badge mt-3">
                            <small><?php echo e(\Illuminate\Support\Str::limit($puja->category->name, 39, '...')); ?></small>
                        </div>
                        
                        <div class="descrb">
                            <h3><?php echo e(\Illuminate\Support\Str::limit($puja->puja_title, 58, '...')); ?></h3>
                            <span><?php echo e(\Illuminate\Support\Str::limit($puja->puja_subtitle, 58, '...')); ?></span>
                        </div>
                        
                        <div class="location-info">
                            <i class="fa-solid fa-place-of-worship"></i>
                            <span><?php echo e(\Illuminate\Support\Str::limit($puja->puja_place, 60, '...')); ?></span>
                        </div>
                        
                        <div class="date-info">
                            <div class="icon-circle">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <div class="date-text">
                                <?php echo e($startDatetime && $endDatetime ? ($sameDate ? $startDateDisplay.' '.$startTimeDisplay : $startDateDisplay.' '.$startTimeDisplay.' - '.$endTimeDisplay) : 'Date not available'); ?>

                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="puja-footer">
                            <a href="<?php echo e(route('front.pujaDetails', $puja->slug)); ?>" class="read">
                                PARTICIPATE <i class="fa-solid fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Pagination -->
    <div class="pagination-wrapper">
        <?php echo e($pujalists->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/happylifevastu/public_html/resources/views/frontend/pages/puja-list.blade.php ENDPATH**/ ?>