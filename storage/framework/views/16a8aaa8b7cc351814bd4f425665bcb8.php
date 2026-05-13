

<?php $__env->startSection('content'); ?>
<style>
/* ═══════════════════════════════════════════════════════
   PREMIUM BLOG DETAIL — Sacred Luxury Theme
   Matches Puja / Blog List / Products aesthetic
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
}

.blog-detail-section *,
.blog-detail-section *::before,
.blog-detail-section *::after {
  box-sizing: border-box;
}

/* ─── Page wrapper ─── */
.blog-detail-section {
  background: var(--white);
  position: relative;
  padding: 3rem 0 5rem;
  min-height: 80vh;
}

/* Top shimmer line */
.blog-detail-section::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, transparent 0%, var(--gold-light) 40%, var(--gold) 50%, var(--gold-light) 60%, transparent 100%);
}

/* Warm noise texture */
.blog-detail-section::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 0;
}

.blog-detail-section .container {
  position: relative;
  z-index: 1;
}

/* ─── Blog Title ─── */
.blog-detail-title {
  font-family: 'Cinzel', serif;
  font-size: clamp(20px, 3.5vw, 32px);
  font-weight: 700;
  color: var(--dark);
  line-height: 1.4;
  margin: 0 0 0.6rem;
}

/* Gold divider under title */
.blog-title-divider {
  display: flex;
  align-items: center;
  gap: 10px;
  margin: 0.8rem 0 1.8rem;
}

.blog-title-divider::before {
  content: '';
  display: block;
  width: 48px;
  height: 1px;
  background: linear-gradient(to right, transparent, var(--gold));
}

.blog-title-divider::after {
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

/* ─── Blog Media (image / video) ─── */
.blog-media-wrap {
  border-radius: var(--radius-card);
  overflow: hidden;
  border: 1px solid var(--border);
  box-shadow: var(--shadow-card);
  margin-bottom: 2rem;
  background: var(--cream);
  position: relative;
}

/* Gold top accent on media */
.blog-media-wrap::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
  z-index: 2;
}

.blog-media-wrap img,
.blog-media-wrap video {
  display: block;
  width: 100%;
  max-height: 460px;
  object-fit: cover;
  cursor: pointer;
  transition: transform 0.6s cubic-bezier(0.22, 0.9, 0.36, 1);
}

.blog-media-wrap:hover img {
  transform: scale(1.02);
}

/* ─── Blog Description ─── */
.blog-description {
  font-family: 'Lato', sans-serif;
  font-size: 15px;
  line-height: 1.9;
  color: var(--text-mid);
}

.blog-description h1,
.blog-description h2,
.blog-description h3,
.blog-description h4 {
  font-family: 'Cinzel', serif;
  color: var(--dark);
  margin-top: 1.8rem;
  margin-bottom: 0.6rem;
}

.blog-description p {
  margin-bottom: 1.2rem;
}

.blog-description a {
  color: var(--gold);
  text-decoration: underline;
}

.blog-description img {
  border-radius: 12px;
  max-width: 100%;
  margin: 1rem 0;
  border: 1px solid var(--border);
}

/* ─── Sidebar Card ─── */
.sidebar-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-card);
  padding: 24px 20px;
  box-shadow: var(--shadow-card);
  position: relative;
  overflow: hidden;
}

/* Gold top accent */
.sidebar-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

/* Warm corner glow */
.sidebar-card::after {
  content: '';
  position: absolute;
  bottom: 0; right: 0;
  width: 60px; height: 60px;
  background: radial-gradient(circle at bottom right, var(--gold-pale) 0%, transparent 70%);
  pointer-events: none;
}

/* ─── Sidebar Title ─── */
.sidebar-title {
  font-family: 'Cinzel', serif;
  font-size: 16px;
  font-weight: 600;
  color: var(--dark);
  margin: 0 0 0.4rem;
}

.sidebar-divider {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 1.4rem;
}

.sidebar-divider::before,
.sidebar-divider::after {
  content: '';
  display: block;
  height: 1px;
}

.sidebar-divider::before {
  width: 28px;
  background: linear-gradient(to right, transparent, var(--gold));
}

.sidebar-divider::after {
  flex: 1;
  background: linear-gradient(to right, var(--gold), transparent);
}

/* ─── Sidebar Blog Item ─── */
.sidebar-blog-item {
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 12px 10px;
  border-radius: 12px;
  border-bottom: 1px solid var(--border);
  transition: background var(--transition), border-color var(--transition);
  text-decoration: none;
  color: inherit;
  margin-bottom: 4px;
}

.sidebar-blog-item:last-child {
  border-bottom: none;
  margin-bottom: 0;
}

.sidebar-blog-item:hover {
  background: var(--gold-pale);
  border-color: rgba(201,168,76,0.3);
  text-decoration: none;
  color: inherit;
}

/* Thumbnail */
.sidebar-thumb {
  width: 64px;
  height: 64px;
  border-radius: 10px;
  object-fit: cover;
  flex-shrink: 0;
  border: 1px solid var(--border);
  transition: border-color var(--transition);
  cursor: pointer;
}

.sidebar-blog-item:hover .sidebar-thumb {
  border-color: var(--gold);
}

.sidebar-thumb-video {
  width: 64px;
  height: 64px;
  border-radius: 10px;
  object-fit: cover;
  flex-shrink: 0;
  border: 1px solid var(--border);
}

/* Item text */
.sidebar-item-text {
  flex: 1;
  min-width: 0;
}

.sidebar-item-title {
  font-family: 'Cinzel', serif;
  font-size: 12px;
  font-weight: 600;
  color: var(--dark);
  line-height: 1.4;
  margin: 0 0 5px;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  transition: color 0.2s ease;
}

.sidebar-blog-item:hover .sidebar-item-title {
  color: var(--gold);
}

.sidebar-read-more {
  font-family: 'Lato', sans-serif;
  font-size: 11px;
  color: var(--text-muted);
  display: flex;
  align-items: center;
  gap: 4px;
}

.sidebar-read-more i {
  font-size: 10px;
  transition: transform 0.2s ease;
}

.sidebar-blog-item:hover .sidebar-read-more i {
  transform: translateX(3px);
}

/* ─── Responsive ─── */
@media (max-width: 991px) {
  .blog-detail-section {
    padding: 2rem 0 4rem;
  }

  .sidebar-card {
    margin-top: 2rem;
  }
}

@media (max-width: 576px) {
  .blog-detail-title {
    font-size: clamp(18px, 5vw, 24px);
  }

  .blog-description {
    font-size: 14px;
  }

  .sidebar-thumb,
  .sidebar-thumb-video {
    width: 54px;
    height: 54px;
  }

  .sidebar-item-title {
    font-size: 11px;
  }

  .blog-media-wrap img,
  .blog-media-wrap video {
    max-height: 280px;
  }
}

/* ─── Entrance animation ─── */
@keyframes fadeSlideUp {
  from { opacity: 0; transform: translateY(20px); }
  to   { opacity: 1; transform: translateY(0); }
}

.blog-detail-main  { animation: fadeSlideUp 0.45s ease 0.05s backwards; }
.blog-detail-aside { animation: fadeSlideUp 0.45s ease 0.15s backwards; }
</style>

<div class="blog-detail-section">
    <div class="container">
        <div class="row g-4">

            <!-- ── Main Blog Content ── -->
            <div class="col-lg-8 col-12 blog-detail-main">

                <!-- Title -->
                <h1 class="blog-detail-title"><?php echo e($blog->title); ?></h1>

                <!-- Gold divider under title -->
                <div class="blog-title-divider">
                    <span class="gold-diamond"></span>
                </div>

                <!-- Media -->
                <div class="blog-media-wrap">
                    <?php
                        $extension      = pathinfo($blog->blogImage, PATHINFO_EXTENSION);
                        $videoExtensions = ['mp4', 'webm', 'ogg'];
                    ?>

                    <?php if(in_array($extension, $videoExtensions)): ?>
                        <video controls>
                            <source src="<?php echo e(asset($blog->blogImage)); ?>" type="video/<?php echo e($extension); ?>">
                            Your browser does not support the video tag.
                        </video>
                    <?php else: ?>
                        <img src="<?php echo e(Str::startsWith($blog->blogImage, ['http://','https://']) ? $blog->blogImage : '/' . $blog->blogImage); ?>"
                             onerror="this.onerror=null;this.src='/build/assets/images/person.png';"
                             onclick="openImage('<?php echo e($blog->blogImage); ?>')"
                             alt="<?php echo e($blog->title); ?>">
                    <?php endif; ?>
                </div>

                <!-- Description -->
                <div class="blog-description">
                    <?php echo $blog->description; ?>

                </div>

            </div>

            <!-- ── Sidebar ── -->
            <div class="col-lg-4 col-12 blog-detail-aside">
                <div class="sticky-top" style="top: 100px;">
                    <div class="sidebar-card">

                        <!-- Sidebar header -->
                        <h2 class="sidebar-title">Explore More</h2>
                        <div class="sidebar-divider">
                            <span class="gold-diamond"></span>
                        </div>

                        <!-- Related blogs -->
                        <?php $__currentLoopData = $latestBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $ext  = pathinfo($latest->blogImage, PATHINFO_EXTENSION);
                                $isVid = in_array($ext, ['mp4', 'webm', 'ogg']);
                            ?>

                            <a href="<?php echo e(route('front.getBlogDetails', $latest->slug)); ?>" class="sidebar-blog-item">

                                <?php if($isVid): ?>
                                    <video class="sidebar-thumb-video" muted>
                                        <source src="<?php echo e(asset($latest->blogImage)); ?>" type="video/<?php echo e($ext); ?>">
                                    </video>
                                <?php else: ?>
                                    <img src="<?php echo e(Str::startsWith($latest->blogImage, ['http://','https://']) ? $latest->blogImage : '/' . $latest->blogImage); ?>"
                                         onerror="this.onerror=null;this.src='/build/assets/images/person.png';"
                                         class="sidebar-thumb"
                                         onclick="openImage('<?php echo e($latest->blogImage); ?>')"
                                         alt="<?php echo e($latest->title); ?>">
                                <?php endif; ?>

                                <div class="sidebar-item-text">
                                    <p class="sidebar-item-title"><?php echo e($latest->title); ?></p>
                                    <span class="sidebar-read-more">
                                        Read more <i class="fa-solid fa-arrow-right"></i>
                                    </span>
                                </div>

                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/happylifevastu/public_html/resources/views/frontend/pages/blog-details.blade.php ENDPATH**/ ?>