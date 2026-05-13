<?php $__env->startSection('content'); ?>
<div class="container  pt-5 pb-5">

        <div class="row align-items-center">
            <!-- Product Image Section -->
            <div class="col-md-6">
                <div class="rounded  product-details-img">
                    <img class="rounded-m" src="<?php echo e(Str::startsWith($getproductdetails->productImage, ['http://','https://']) ? $getproductdetails->productImage : '/' . $getproductdetails->productImage); ?>" onerror="this.onerror=null;this.src='/build/assets/images/person.png';" alt="Customer image" onclick="openImage('<?php echo e($getproductdetails->productImage); ?>')" />
                </div>
            </div>

            <!-- Product Details Section -->
            <div class="col-md-5 d-flex align-items-center p-3">
                <div class="w-100" >
                    <div class="mb-4">
                        <p class="mb-2"><b>Category: <?php echo e($getproductdetails->productCategory); ?></b></p>
                        <h2 class="font-weight-semi-bold"><?php echo e($getproductdetails->name); ?></h2>
                    </div>
                    <div class="mb-4">
                        <h2 class="text-dark">
                            <?php if($walletType == 'coin'): ?>
                                                        <img src="<?php echo e(asset($coinIcon)); ?>" alt="Wallet Icon" width="15">
                                                    <?php else: ?>
                                                        <?php echo e($currency['value']); ?>

                                                    <?php endif; ?>
                            <?php echo e($getproductdetails->amount); ?></h2>
                    </div>
                    <a <?php if(authcheck()): ?> href="<?php echo e(route('front.checkout', ['id' => $getproductdetails->id])); ?>" <?php else: ?> data-toggle="modal"  data-target="#loginSignUp" <?php endif; ?> class="btn btn-dark w-100 py-3 rounded-pill">
                        Buy Now
                    </a>
                </div>
            </div>
        </div>

        <div class="row pt-3">
            <div class="col">
                <h2 class=" text-black py-3 font-28">Product Details</h2>
                <p class="text-secondary"><?php echo e($getproductdetails->features); ?> </p>
            </div>
        </div>

        <?php if(count($productfaq)>0): ?>
        <div id="faqs" class="section mt-4">
            <h2>Faqs</h2>
            <div class="astroway-about  d-md-block">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="accordion" id="faq">
                            <?php foreach ($productfaq as $index => $faqItem): ?>
                                <div class="card">
                                    <div class="card-header" id="faqhead<?php echo $index + 1; ?>">
                                        <h3 class="panel-title mb-0">
                                            <a href="#" class="btn btn-header-link collapsed font-18" data-toggle="collapse"
                                            data-target="#faq<?php echo $index + 1; ?>" aria-expanded="false"
                                            aria-controls="faq<?php echo $index + 1; ?>">
                                            <?php echo e($faqItem->question); ?>

                                            </a>
                                        </h3>
                                    </div>

                                    <div id="faq<?php echo $index + 1; ?>" class="collapse" aria-labelledby="faqhead<?php echo $index + 1; ?>"
                                        data-parent="#faq">
                                        <div class="card-body">
                                        <?php echo e($faqItem->answer); ?>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>


    <!-- Recent Products Section -->
    <div class="container my-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-decoration-underline">Recent Products</h2>
        <p class="mt-3 text-muted">
            See new products and how <?php echo e(ucfirst($appname)); ?> helped them find their path to happiness!
        </p>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <?php if(count($productlist) > 0): ?>
            <?php
                $colors = ['fuchsia', 'slate', 'purple', 'lime', 'rose', 'green', 'sky'];
            ?>
            <?php $__currentLoopData = $productlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $color = $colors[$key % count($colors)]; ?>
                <div class="col">
                    <div class="h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                        <a href="<?php echo e(route('front.getproductDetails', ['slug' => $products->slug])); ?>" class="text-decoration-none text-dark">
                            <div class="d-flex justify-content-center align-items-center bg-light" style="height: 250px;">
                                <img class="img-fluid h-100 object-fit-contain"
                                    src="<?php echo e(Str::startsWith($products->productImage, ['http://','https://']) ? $products->productImage : '/' . $products->productImage); ?>"
                                    onerror="this.onerror=null;this.src='/build/assets/images/person.png';"
                                    alt="Product Image" />
                            </div>
                        </a>

                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title fw-bold text-dark mb-1"><?php echo e($products->name); ?></h5>
                                <p class="fw-semibold text-primary mb-3">
                                   <?php if($walletType == 'coin'): ?>
                                                        <img src="<?php echo e(asset($coinIcon)); ?>" alt="Wallet Icon" width="15">
                                                    <?php else: ?>
                                                        <?php echo e($currency['value']); ?>

                                                    <?php endif; ?>
                                    <?php echo e($products->amount); ?></p>
                            </div>

                            <div class="mt-auto">
                                <a href="<?php echo e(route('front.getproductDetails', ['slug' => $products->slug])); ?>"
                                    class="btn btn-sm btn-primary w-100">
                                    <i class="fa fa-shopping-cart me-1"></i> Buy Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="text-center py-5">
                <h5 class="text-muted">No products found.</h5>
            </div>
        <?php endif; ?>
    </div>
</div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/happylifevastu/public_html/resources/views/frontend/pages/product-details.blade.php ENDPATH**/ ?>