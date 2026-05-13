

<?php $__env->startSection('content'); ?>
<div class="container-fluid mt-5">
    <div class="row">
        <!-- Left Main Blog Content -->
        <div class="col-lg-8 mb-4">
            <!-- Blog Image -->
            <img class="rounded-m" src="<?php echo e(Str::startsWith($news->bannerImage, ['http://','https://']) ? $news->bannerImage : '/' . $news->bannerImage); ?>" onerror="this.onerror=null;this.src='/build/assets/images/person.png';" alt="Customer image" onclick="openImage('<?php echo e($news->bannerImage); ?>')" style="width: inherit; height: 25rem;" />
            <!-- Blog Title & Date -->
            <h4 style="background: aliceblue;padding: 10px;"><?php echo e($news->channel); ?></h4>
            <div style="background: aliceblue; padding: 10px;">
    <?php echo $news->description; ?> 
    <div style="display: flex; justify-content: flex-end; margin-top: 10px;">
        <a class="btn btn-primary btn-sm" href="<?php echo e(asset($news->link)); ?>">View More</a>
    </div>
</div>

            <p class="text-muted" style="background: aliceblue;padding: 10px;">Published on <?php echo e(\Carbon\Carbon::parse($news->created_at)->format('d M Y')); ?></p>
        </div>

        <!-- Right Sidebar -->
        <div class="col-lg-4">
            <h3>Our Astrologers</h3>
            <!-- Astrologer List -->
            <div class="mb-4" style="max-height: 450px; overflow-y:auto;">
                <ul class="list-group">
                    <?php $__currentLoopData = $astrologers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $astrologer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item p-0 mb-1" style="border: 1px solid deepskyblue;">
                            <a href="<?php echo e($astrologer->slug ? url('/astrologer-details/' . $astrologer->slug) : '#'); ?>" class="d-flex align-items-center text-decoration-none text-dark">
                                <img class="rrounded-circle me-3" style="width:40px; height:40px; object-fit:cover;" src="<?php echo e(Str::startsWith($astrologer->profileImage, ['http://','https://']) ? $astrologer->profileImage : '/' . $astrologer->profileImage); ?>" onerror="this.onerror=null;this.src='/build/assets/images/person.png';" alt="Customer image" onclick="openImage('<?php echo e($astrologer->profileImage); ?>')" />

                                <!-- <img src="<?php echo e(asset($astrologer->profileImage)); ?>" class="rrounded-circle me-3" style="width:40px; height:40px; object-fit:cover;" alt="<?php echo e($astrologer->name); ?>"> -->
                                <span style="font-size: 20px;padding: 0px 10px;"><?php echo e($astrologer->name); ?></span>
                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>

                <h3>Recent Blogs</h3>
            <!-- Astrologer List -->
            <div class="mb-1" style="max-height: 51rem; overflow-y:auto;">
                <ul class="list-group">
                     <?php $__currentLoopData = $recentBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="mb-2" style="border: 1px solid deepskyblue;">
                            <div class="">
                                <img class="card-img-top" style="height:120px; object-fit:cover;" src="<?php echo e(Str::startsWith($recent->blogImage, ['http://','https://']) ? $recent->blogImage : '/' . $recent->blogImage); ?>" onerror="this.onerror=null;this.src='/build/assets/images/person.png';" alt="Customer image" onclick="openImage('<?php echo e($recent->blogImage); ?>')" />
                        <div class="p-3">
                            <h6 class="card-title mb-1"><?php echo e($recent->videoTitle); ?></h6>
                            <p class="card-text text-muted mb-1" style="font-size:12px;">Posted on: <?php echo e(\Carbon\Carbon::parse($recent->created_at)->format('Y-m-d')); ?></p>
                            <p class="card-text mb-1" style="font-size:13px;"><?php echo \Illuminate\Support\Str::words($recent->description, 15); ?></p>
                            <a href="<?php echo e(route('front.getBlogDetails', $recent->slug)); ?>" class="btn btn-primary btn-sm">Read More</a>
                        </div>
                    </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            </div>
        </div>
    </div>

<?php if(isset($astrologyVideo) && count($astrologyVideo) > 0): ?>
        <section class="py-5 bg-white" id="calculator"
            style="background: url('<?php echo e(asset('public/frontend/homeimage/videobackground.jpeg')); ?>');">
            <div class="container-fluid">
                <h2 class="text-center text-black py-3 font-28">Astrology Videos</h2>
        
                <!-- Marquee Container -->
                <div class="marquee-wrapper overflow-hidden position-relative">
                    <div class="marquee d-flex">
                        <?php $__currentLoopData = $astrologyVideo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="javascript:;" 
                               class="video-link mx-2" 
                               data-video="<?php echo e($video->youtubeLink); ?>" 
                               data-description="<?php echo e(\Illuminate\Support\Str::words($video->description, 30, '...')); ?>"
                               data-toggle="modal" 
                               data-target="#videoModal">
                                <div class="video-card position-relative">
                                    <img class="video-thumbnail img-fluid" style="height:160px" src="<?php echo e(Str::startsWith($video->coverImage, ['http://','https://']) ? $video->coverImage : '/' . $video->coverImage); ?>" onerror="this.onerror=null;this.src='/build/assets/images/person.png';" alt="Customer image" onclick="openImage('<?php echo e($video->coverImage); ?>')" />

                                    <img style="cursor: pointer;" class="position-absolute youtube-icon"
                                        src="<?php echo e(asset('public/frontend/homeimage/youtube.svg')); ?>" alt="">
                                    <div class="video-title text-center mt-2"><?php echo e($video->videoTitle); ?></div>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
                        <!-- Duplicate for infinite loop -->
                        <?php $__currentLoopData = $astrologyVideo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="javascript:;" 
                               class="video-link mx-2" 
                               data-video="<?php echo e($video->youtubeLink); ?>" 
                               data-description="<?php echo e(\Illuminate\Support\Str::words($video->description, 30, '...')); ?>"
                               data-toggle="modal" 
                               data-target="#videoModal">
                                <div class="video-card position-relative">
                                    <img class="video-thumbnail img-fluid" style="height:160px"  src="<?php echo e(Str::startsWith($video->coverImage, ['http://','https://']) ? $video->coverImage : '/' . $video->coverImage); ?>" onerror="this.onerror=null;this.src='/build/assets/images/person.png';" alt="Customer image" onclick="openImage('<?php echo e($video->coverImage); ?>')" />

                                    <img style="cursor: pointer;" class="position-absolute youtube-icon"
                                        src="<?php echo e(asset('public/frontend/homeimage/youtube.svg')); ?>" alt="">
                                    <div class="video-title text-center mt-2"><?php echo e($video->videoTitle); ?></div>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- Modal -->
        <div class="modal fade mt-5" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" id="videoIframe" src="" allowfullscreen></iframe>
                        </div>
                        <h3 class="p-3 bg-success text-white">Video Description</h3>
                        <div class="video-description mt-2 p-3" id="videoDescription"></div>
                    </div>
                </div>
            </div>
        </div>

<style>
.marquee-wrapper {
    width: 100%;
    overflow: hidden;
    position: relative;
}

.marquee {
    display: flex;
    width: max-content;
    animation: marquee 40s linear infinite;
}

.marquee:hover {
    animation-play-state: paused; /* hover par slide ruk jayega */
}

.video-card {
    flex: 0 0 auto;
    width: 250px;
    border-radius: 8px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}
@keyframes marquee {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
.container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl {
    width: 100%;
    padding-right: 50px !important;
    padding-left: 50px !important;
    margin-right: auto;
    margin-left: auto;
}
.list-group-item:first-child {
    border-top-left-radius: inherit;
    border-top-right-radius: inherit;
    background: #eeeef7;
}
.list-group-item + .list-group-item {
    border-top-left-radius: inherit;
    border-top-right-radius: inherit;
    background: #eeeef7;
}
</style>

<script>
$(document).ready(function () {
    // Modal open -> play video
    $('.video-link').click(function () {
        let videoUrl = $(this).data('video');  
        let description = $(this).data('description');

        // Convert normal YouTube link into embed format
        if(videoUrl.includes("watch?v=")) {
            videoUrl = videoUrl.replace("watch?v=", "embed/"); 
        }

        $("#videoIframe").attr("src", videoUrl + "?autoplay=1");
        $("#videoDescription").text(description);
    });

    // Modal close -> stop video
    $('#videoModal').on('hidden.bs.modal', function () {
        $("#videoIframe").attr("src", "");
    });
});
</script>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>

<style>
.card h6 {
    font-weight: 600;
}
.list-group-item {
    font-size: 14px;
}
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/happylifevastu/public_html/resources/views/frontend/pages/newsdetails.blade.php ENDPATH**/ ?>