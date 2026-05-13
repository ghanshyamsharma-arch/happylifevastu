

<?php $__env->startSection('content'); ?>
<style>
/* ═══════════════════════════════════════════════════════
   PREMIUM BLOG LIST — Sacred Luxury Theme
   Matches Puja Category page aesthetic exactly
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
  --border:        #e8d5b0;
  --text-dark:     #2c1a08;
  --text-mid:      #6b4c22;
  --text-muted:    #b08a55;
  --shadow-card:   0 4px 20px rgba(30,15,0,0.07);
  --shadow-hover:  0 16px 40px rgba(201,168,76,0.14), 0 4px 12px rgba(30,15,0,0.08);
  --radius-card:   20px;
  --radius-btn:    50px;
  --transition:    0.32s cubic-bezier(0.22, 0.9, 0.36, 1);
}

.blog-section *,
.blog-section *::before,
.blog-section *::after {
  box-sizing: border-box;
}

/* ─── Page Section ─── */
.blog-section {
  background: var(--white);
  position: relative;
  padding: 3rem 0 4rem;
  min-height: 60vh;
}

/* Top shimmer line */
.blog-section::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, transparent 0%, var(--gold-light) 40%, var(--gold) 50%, var(--gold-light) 60%, transparent 100%);
}

/* Warm noise texture */
.blog-section::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 0;
}

/* ─── Section Header ─── */
.blog-section-header {
  text-align: center;
  margin-bottom: 2.5rem;
  position: relative;
  z-index: 1;
}

.blog-section-header .eyebrow {
  font-family: 'Cinzel', serif;
  font-size: 10px;
  letter-spacing: 4px;
  color: var(--gold);
  text-transform: uppercase;
  margin-bottom: 0.6rem;
  display: block;
}

.blog-section-header .section-title {
  font-family: 'Cinzel', serif;
  font-size: clamp(18px, 3vw, 24px);
  font-weight: 600;
  color: var(--dark);
  margin: 0 0 0.5rem;
  letter-spacing: 0.5px;
  text-align: left !important;
}

.blog-section-header .gold-divider {
  display: flex;
  align-items: center;
  gap: 10px;
  margin: 0.7rem auto 0.9rem;
}

.blog-section-header .gold-divider::before,
.blog-section-header .gold-divider::after {
  content: '';
  display: block;
  width: 40px;
  height: 1px;
  background: linear-gradient(to right, transparent, var(--gold));
}

.blog-section-header .gold-divider::after {
  background: linear-gradient(to left, transparent, var(--gold));
}

.gold-diamond {
  width: 7px;
  height: 7px;
  background: var(--gold);
  transform: rotate(45deg);
  display: inline-block;
  flex-shrink: 0;
}

.blog-section-header .section-subtitle {
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  color: var(--text-muted);
  letter-spacing: 0.5px;
  margin: 0;
  text-align: left !important;
}

/* ─── Blog Grid ─── */
.blog-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
  position: relative;
  z-index: 1;
  padding: 0 4px;
}

@media (max-width: 992px) {
  .blog-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 540px) {
  .blog-grid {
    grid-template-columns: 1fr;
    max-width: 340px;
    margin: 0 auto;
    padding: 0;
  }
}

/* ─── Blog Card ─── */
.blog-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-card);
  overflow: hidden;
  display: flex;
  flex-direction: column;
  transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition);
  position: relative;
  box-shadow: var(--shadow-card);
  text-decoration: none;
  color: inherit;
  animation: fadeSlideUp 0.45s ease backwards;
}

/* Top accent */
.blog-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
  opacity: 0;
  transition: opacity 0.3s ease;
  z-index: 2;
}

/* Corner glow */
.blog-card::after {
  content: '';
  position: absolute;
  bottom: 0; right: 0;
  width: 40px; height: 40px;
  border-bottom-right-radius: var(--radius-card);
  background: radial-gradient(circle at bottom right, var(--gold-pale) 0%, transparent 70%);
  opacity: 0;
  transition: opacity 0.3s ease;
  pointer-events: none;
}

.blog-card:hover {
  transform: translateY(-8px);
  border-color: var(--gold);
  box-shadow: var(--shadow-hover);
  text-decoration: none;
  color: inherit;
}

.blog-card:hover::before { opacity: 1; }
.blog-card:hover::after  { opacity: 1; }

/* Stagger */
.blog-card:nth-child(1) { animation-delay: 0.04s; }
.blog-card:nth-child(2) { animation-delay: 0.09s; }
.blog-card:nth-child(3) { animation-delay: 0.14s; }
.blog-card:nth-child(4) { animation-delay: 0.19s; }
.blog-card:nth-child(5) { animation-delay: 0.24s; }
.blog-card:nth-child(6) { animation-delay: 0.29s; }

/* ─── Card Image Wrapper ─── */
.blog-card-img-wrap {
  position: relative;
  width: 100%;
  height: 220px;
  overflow: hidden;
  background: var(--cream);
  flex-shrink: 0;
}

.blog-card-img-wrap::after {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(26,14,5,0.22) 0%, transparent 55%);
  opacity: 0;
  transition: opacity var(--transition);
  pointer-events: none;
}

.blog-card:hover .blog-card-img-wrap::after { opacity: 1; }

.blog-card-img-wrap .product-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.6s cubic-bezier(0.22, 0.9, 0.36, 1);
}

.blog-card:hover .blog-card-img-wrap .product-image {
  transform: scale(1.06);
}

/* Video same sizing */
.blog-card-img-wrap video {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

@media (max-width: 768px) {
  .blog-card-img-wrap { height: 190px; }
}
@media (max-width: 480px) {
  .blog-card-img-wrap { height: 210px; }
}

/* ─── Card Body ─── */
.blog-card-body {
  padding: 20px 18px 8px;
  flex: 1;
  display: flex;
  flex-direction: column;
}

.blog-card-body h3 {
  font-family: 'Cinzel', serif;
  font-size: clamp(13px, 1.3vw, 15px);
  font-weight: 600;
  color: var(--dark);
  margin: 0 0 10px;
  line-height: 1.45;
  transition: color 0.22s ease;
}

.blog-card:hover .blog-card-body h3 { color: var(--gold); }

.blog-card-body p {
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  color: var(--text-mid);
  line-height: 1.65;
  margin: 0 0 auto;
  flex: 1;
}

/* ─── Divider ─── */
.blog-card hr {
  border: none;
  border-top: 1px solid var(--border);
  margin: 14px 18px 0;
  transition: border-color 0.22s ease;
}
.blog-card:hover hr { border-color: rgba(201,168,76,0.3); }

/* ─── Read More footer ─── */
.blog-card-footer {
  padding: 14px 18px 18px;
}

.read-more-btn {
  font-family: 'Cinzel', serif;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  color: var(--dark);
  background: var(--gold);
  border-radius: var(--radius-btn);
  padding: 10px 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  width: 100%;
  text-decoration: none;
  transition: background 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
}

.read-more-btn:hover {
  background: var(--gold-light);
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(201,168,76,0.35);
  text-decoration: none;
  color: var(--dark);
}

.read-more-btn i {
  font-size: 12px;
  transition: transform 0.22s ease;
}
.read-more-btn:hover i { transform: translateX(4px); }

/* ─── Empty State ─── */
.empty-state {
  text-align: center;
  padding: 4rem 2rem;
  background: var(--cream);
  border-radius: 24px;
  margin: 2rem auto;
  max-width: 480px;
  border: 1px solid var(--border);
}

.empty-state h3 {
  font-family: 'Cinzel', serif;
  font-size: 17px;
  color: var(--text-mid);
  margin-bottom: 0.5rem;
}

.empty-state p {
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  color: var(--text-muted);
  margin: 0;
}

/* ─── Pagination ─── */
.pagination-wrapper {
  margin-top: 2.5rem;
  text-align: center;
  padding-bottom: 1rem;
  position: relative;
  z-index: 1;
}

.pagination-wrapper .pagination {
  display: flex;
  justify-content: center;
  gap: 6px;
  flex-wrap: wrap;
  padding: 0;
  margin: 0;
}

.pagination-wrapper .page-item { list-style: none; }

.pagination-wrapper .page-link {
  font-family: 'Cinzel', serif;
  font-size: 12px;
  padding: 9px 15px;
  color: var(--text-mid);
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-btn);
  transition: all 0.25s ease;
  text-decoration: none;
  display: inline-block;
  line-height: 1;
}

.pagination-wrapper .page-link:hover {
  background: var(--gold-pale);
  border-color: var(--gold);
  color: var(--gold);
  box-shadow: 0 2px 8px var(--gold-glow);
}

.pagination-wrapper .active .page-link {
  background: var(--gold);
  border-color: var(--gold);
  color: var(--dark);
  font-weight: 700;
  box-shadow: 0 4px 12px var(--gold-glow);
}

.pagination-wrapper .disabled .page-link {
  opacity: 0.4;
  cursor: not-allowed;
  pointer-events: none;
}

/* ─── Keyframes ─── */
@keyframes fadeSlideUp {
  from { opacity: 0; transform: translateY(24px); }
  to   { opacity: 1; transform: translateY(0); }
}

/* ─── Responsive fine-tuning ─── */
@media (max-width: 576px) {
  .blog-section { padding: 2rem 0 3rem; }
  .blog-card-body { padding: 14px 14px 8px; }
  .blog-card-footer { padding: 12px 14px 16px; }
  .blog-card hr { margin: 12px 14px 0; }
  .read-more-btn { font-size: 10px; padding: 9px 14px; }
  .pagination-wrapper .page-link { font-size: 11px; padding: 8px 12px; }
}
</style>

<div class="blog-section">
    <div class="container">

        <!-- Section Header -->
        <div class="blog-section-header">
            <h2 class="section-title">Our Blogs</h2>
            <div class="gold-divider">
                <span class="gold-diamond"></span>
            </div>
            <p class="section-subtitle">Explore spiritual knowledge, rituals & sacred traditions</p>
        </div>

        <?php if(isset($bloglist) && count($bloglist) > 0): ?>

            <!-- Blog Grid -->
            <div class="blog-grid">
                <?php $__currentLoopData = $bloglist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('front.getBlogDetails', ['slug' => $blog->slug])); ?>" class="blog-card">

                    <!-- Media -->
                    <div class="blog-card-img-wrap">
                        <?php
                            $extension = pathinfo($blog->blogImage, PATHINFO_EXTENSION);
                            $videoExtensions = ['mp4', 'webm', 'ogg'];
                        ?>

                        <?php if(in_array($extension, $videoExtensions)): ?>
                            <video controls>
                                <source src="<?php echo e(asset($blog->blogImage)); ?>" type="video/<?php echo e($extension); ?>">
                                Your browser does not support the video tag.
                            </video>
                        <?php else: ?>
                            <img src="<?php echo e(asset($blog->blogImage)); ?>"
                                 class="product-image"
                                 alt="<?php echo e($blog->title); ?>">
                        <?php endif; ?>
                    </div>

                    <!-- Body -->
                    <div class="blog-card-body">
                        <h3><?php echo e($blog->title); ?></h3>
                        <p><?php echo \Illuminate\Support\Str::words($blog->description, 15); ?></p>
                    </div>

                    <hr>

                    <!-- Footer -->
                    <div class="blog-card-footer">
                        <span class="read-more-btn">
                            Read More <i class="fa-solid fa-arrow-right"></i>
                        </span>
                    </div>

                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

        <?php else: ?>
            <div class="empty-state">
                <h3>✦ No Blogs Available ✦</h3>
                <p>Please check back later for spiritual articles and insights.</p>
            </div>
        <?php endif; ?>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            <?php echo e($bloglist->links()); ?>

        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/happylifevastu/public_html/resources/views/frontend/pages/blogs.blade.php ENDPATH**/ ?>