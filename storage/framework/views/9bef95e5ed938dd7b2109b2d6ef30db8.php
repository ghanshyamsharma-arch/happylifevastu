
<?php $__env->startSection('content'); ?>

<style>
/* Premium Astrology Theme - Product Details Page */
:root {
  --gold: #c9a84c;
  --gold-light: #e0c068;
  --gold-pale: #fdf6e3;
  --dark: #1a0e05;
  --dark-mid: #2d1a08;
  --dark-card: #261507;
  --white: #ffffff;
  --cream: #faf4ea;
  --cream-mid: #f2e8d0;
  --border: #e8d5b0;
  --border-gold: #c9a84c44;
  --text-dark: #2c1a08;
  --text-mid: #6b4c22;
  --text-muted: #b08a55;
}

/* Product Details Container */
.product-details-section {
  background: var(--white);
  position: relative;
}

.product-details-section .gold-line {
  width: 38px;
  height: 2px;
  background: var(--gold);
  margin: 0.55rem 0 1.1rem;
}

/* Product Image */
.product-details-img {
  background: linear-gradient(145deg, var(--cream), var(--cream-mid));
  border-radius: 20px;
  padding: 20px;
  border: 1px solid var(--border);
  transition: all 0.3s ease;
}

.product-details-img img {
  width: 100%;
  border-radius: 12px;
  transition: transform 0.3s ease;
}

.product-details-img:hover img {
  transform: scale(1.02);
}

/* Category Badge */
.product-category {
  font-family: 'Cinzel', serif;
  font-size: 10px;
  letter-spacing: 1.5px;
  color: var(--gold);
  text-transform: uppercase;
  margin-bottom: 0.5rem;
}

/* Product Title */
.product-title {
  font-family: 'Cinzel', serif;
  font-size: 22px;
  font-weight: 600;
  color: var(--dark);
  margin-bottom: 0.5rem;
}

/* Product Price */
.product-price {
  font-family: 'Cinzel', serif;
  font-size: 24px;
  font-weight: 600;
  color: var(--gold);
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

.product-price img {
  width: 18px;
  height: 18px;
}

/* Quantity Control */
.qty-control {
  border: 1px solid var(--border) !important;
  border-radius: 50px !important;
  overflow: hidden;
  background: var(--white);
  margin-right:2px;
}

.qty-control button {
  background: transparent;
  border: none;
  font-size: 18px;
  font-weight: 500;
  color: var(--text-mid);
  transition: all 0.2s ease;
  cursor: pointer;
}

.qty-control button:hover {
  color: var(--gold);
}

.qty-control input {
  width: 55px;
  text-align: center;
  font-size: 14px;
  font-weight: 500;
  color: var(--text-dark);
}

/* Buttons */
.btn-add-cart {
  background: var(--gold);
  border: none;
  color: var(--dark);
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  padding: 10px 20px;
  border-radius: 50px;
  transition: all 0.3s ease;
}

.btn-add-cart:hover {
  background: var(--gold-light);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(201, 168, 76, 0.3);
}

.btn-outline-secondary {
  background: transparent;
  border: 1.5px solid var(--border) !important;
  color: var(--text-mid) !important;
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 500;
  padding: 10px 20px;
  border-radius: 50px;
  transition: all 0.3s ease;
}

.btn-outline-secondary:hover {
  background:var(--gold-light);    
  border-color: var(--gold) !important;
  color: #1a0e05 !important;
  transform: translateY(-2px);
}

/* Product Details Section */
.product-details-content h2 {
  font-family: 'Cinzel', serif;
  font-size: 19px;
  font-weight: 600;
  color: var(--dark) !important;
  margin-bottom: 0.5rem;
}

.product-details-content .gold-line {
  margin: 0.55rem 0 1.1rem;
}

.product-details-content p {
  font-size: 13px;
  line-height: 1.7;
  color: var(--text-mid);
}

/* FAQ Section - Premium Styling */
.faq-section {
  margin-top: 2rem;
}

.faq-section h2 {
  font-family: 'Cinzel', serif;
  font-size: 19px;
  font-weight: 600;
  color: var(--dark);
  margin-bottom: 0.5rem;
}

.faq-section .gold-line {
  margin: 0.55rem 0 1.5rem;
}

.faq-section .card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: 10px;
  margin-bottom: 9px;
  overflow: hidden;
  transition: all 0.25s ease;
}

.faq-section .card:hover {
  border-color: var(--border-gold);
}

.faq-section .card-header {
  background: var(--white);
  padding: 0;
  border-bottom: none;
}

.faq-section .btn-header-link {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
  padding: 0.85rem 1rem;
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 500;
  color: var(--dark);
  background: var(--white);
  border: none;
  text-decoration: none;
  transition: all 0.25s ease;
}

.faq-section .btn-header-link:hover {
  color: var(--gold);
}

.faq-section .btn-header-link::after {
  content: '▼';
  font-size: 10px;
  color: var(--gold);
  transition: transform 0.3s ease;
  margin-left: 12px;
}

.faq-section .btn-header-link.collapsed::after {
  transform: rotate(0deg);
}

.faq-section .btn-header-link:not(.collapsed)::after {
  transform: rotate(180deg);
}

.faq-section .card-body {
  padding: 0.5rem 1rem 1rem;
  font-size: 12px;
  color: var(--text-mid);
  line-height: 1.75;
  border-top: 1px solid var(--border);
  background: var(--white);
}

/* Recent Products Section */
.recent-products-section {
  background: var(--cream);
  border-radius: 24px;
  padding: 2rem;
  margin-top: 2rem;
}

.recent-products-section .section-title {
  font-family: 'Cinzel', serif;
  font-size: 19px;
  font-weight: 600;
  color: var(--dark);
  text-align: center;
}

.recent-products-section .gold-line {
  width: 38px;
  height: 2px;
  background: var(--gold);
  margin: 0.55rem auto 0;
}

.recent-products-section .section-subtitle {
  font-size: 12px;
  color: var(--text-muted);
  text-align: center;
  margin-top: 0.75rem;
}

/* Recent Product Cards */
.recent-product-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: 14px;
  overflow: hidden;
  transition: all 0.3s ease;
  height: 100%;
  display: flex;
  flex-direction: column;
}

.recent-product-card:hover {
  transform: translateY(-4px);
  border-color: var(--gold);
  box-shadow: 0 12px 24px rgba(201, 168, 76, 0.1);
}

.recent-product-card .image-wrapper {
  height: 220px;
  overflow: hidden;
  background: var(--cream-mid);
  display: flex;
  align-items: center;
  justify-content: center;
}

.recent-product-card .image-wrapper img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.recent-product-card:hover .image-wrapper img {
  transform: scale(1.05);
}

.recent-product-card .card-body {
  padding: 1rem;
}

.recent-product-card .card-title {
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  color: var(--dark);
  margin-bottom: 0.5rem;
  line-height: 1.35;
}

.recent-product-card .product-price {
  font-size: 14px;
  margin-bottom: 0.75rem;
}

.recent-product-card .btn-buy {
  background: var(--gold);
  border: none;
  color: var(--dark);
  font-family: 'Cinzel', serif;
  font-size: 11px;
  font-weight: 600;
  padding: 8px 16px;
  border-radius: 50px;
  width: 100%;
  transition: all 0.3s ease;
}

.recent-product-card .btn-buy:hover {
  background: var(--gold-light);
  transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 768px) {
  .product-title {
    font-size: 18px;
  }
  .product-price {
    font-size: 20px;
  }
  .product-details-img {
    margin-bottom: 1.5rem;
  }
  .recent-products-section {
    padding: 1.5rem;
  }
  .recent-product-card .image-wrapper {
    height: 180px;
  }
  .qty-control button {
    padding: 8px 12px;
  }
}

@media (max-width: 576px) {
  .product-title {
    font-size: 16px;
  }
  .btn-add-cart, .btn-outline-secondary {
    font-size: 11px;
    padding: 8px 12px;
  }
  .recent-product-card .image-wrapper {
    height: 160px;
  }
}

/* Animation */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(15px); }
  to { opacity: 1; transform: translateY(0); }
}

.product-details-section .row > div {
  animation: fadeIn 0.5s ease backwards;
}

.product-details-section .row > div:first-child { animation-delay: 0.05s; }
.product-details-section .row > div:last-child { animation-delay: 0.1s; }
</style>

<div class="product-details-section container pt-5 pb-5">
    <div class="row align-items-center">
        <!-- Product Image Section -->
        <div class="col-md-6">
            <div class="product-details-img">
                <img class="img-fluid w-100 rounded" 
                    src="<?php echo e(Str::startsWith($getproductdetails->productImage, ['http://','https://']) ? $getproductdetails->productImage : '/' . $getproductdetails->productImage); ?>" 
                    onerror="this.onerror=null;this.src='/build/assets/images/person.png';" 
                    alt="<?php echo e($getproductdetails->name); ?>" 
                    onclick="openImage('<?php echo e($getproductdetails->productImage); ?>')" />
            </div>
        </div>

        <!-- Product Details Section -->
        <div class="col-md-6 d-flex align-items-center p-3">
            <div class="w-100">
                <div class="mb-4">
                    <p class="product-category mb-2">✦ <?php echo e($getproductdetails->productCategory); ?> ✦</p>
                    <h2 class="product-title"><?php echo e($getproductdetails->name); ?></h2>
                    <div class="gold-line"></div>
                </div>
                <div class="mb-4">
                    <span class="product-price">
                        <?php if($walletType == 'coin'): ?>
                            <img src="<?php echo e(asset($coinIcon)); ?>" alt="Wallet Icon">
                        <?php else: ?>
                            <?php echo e($currency['value']); ?>

                        <?php endif; ?>
                        <?php echo e($getproductdetails->amount); ?>

                    </span>
                </div>
                
                <div class="product-actions d-flex align-items-center gap-3 mt-4 flex-wrap">
                    <div class="qty-control d-flex align-items-center border rounded-pill">
                        <button class="btn btn-sm qty-minus px-3">−</button>
                        <input type="number" id="product-qty" value="1" min="1" max="99" 
                               class="form-control border-0 text-center" style="width:60px">
                        <button class="btn btn-sm qty-plus px-3">+</button>
                    </div>
                    <button class="btn btn-add-cart flex-grow-1" style="margin-right:2px;"
                        data-product-id="<?php echo e($getproductdetails->id); ?>"
                        data-product-name="<?php echo e($getproductdetails->name); ?>">
                        <i class="fas fa-cart-plus me-1"></i> Add to Cart
                    </button>
                    <a href="<?php echo e(route('front.cart')); ?>" class="btn btn-outline-secondary">View Cart</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details Content -->
    <div class="row pt-4 product-details-content">
        <div class="col">
            <h2>Product Details</h2>
            <div class="gold-line"></div>
            <p><?php echo e($getproductdetails->features); ?></p>
        </div>
    </div>

    <!-- FAQ Section -->
    <?php if(count($productfaq)>0): ?>
    <div id="faqs" class="faq-section mt-4">
        <h2>Frequently Asked Questions</h2>
        <div class="gold-line"></div>
        <div class="astroway-about d-md-block">
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
    <div class="recent-products-section my-5">
        <div class="text-center mb-4">
            <h2 class="section-title">Recent Products</h2>
            <div class="gold-line"></div>
            <p class="section-subtitle">
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
                        <div class="recent-product-card">
                            <a href="<?php echo e(route('front.getproductDetails', ['slug' => $products->slug])); ?>" class="text-decoration-none">
                                <div class="image-wrapper">
                                    <img class="img-fluid"
                                        src="<?php echo e(Str::startsWith($products->productImage, ['http://','https://']) ? $products->productImage : '/' . $products->productImage); ?>"
                                        onerror="this.onerror=null;this.src='/build/assets/images/person.png';"
                                        alt="<?php echo e($products->name); ?>" />
                                </div>
                            </a>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title"><?php echo e($products->name); ?></h5>
                                    <p class="product-price mb-3">
                                        <?php if($walletType == 'coin'): ?>
                                            <img src="<?php echo e(asset($coinIcon)); ?>" alt="Wallet Icon" width="14">
                                        <?php else: ?>
                                            <?php echo e($currency['value']); ?>

                                        <?php endif; ?>
                                        <?php echo e($products->amount); ?>

                                    </p>
                                </div>
                                <div class="mt-auto">
                                    <a href="<?php echo e(route('front.getproductDetails', ['slug' => $products->slug])); ?>"
                                        class="btn btn-buy w-100">
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