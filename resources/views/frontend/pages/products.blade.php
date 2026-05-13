@extends('frontend.layout.master')
@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Lato:wght@300;400;700&display=swap');
/* Premium Astrology Theme - Products Page */
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

/* Section Title Styling */
.products-section .section-title {
  font-family: 'Cinzel', serif;
  font-size: clamp(18px, 3vw, 24px);
  font-weight: 600;
  color: var(--dark);
  margin: 0 0 0.5rem;
  letter-spacing: 0.5px;
  text-align: left !important;
}


.products-section .gold-line {
  width: 38px;
  height: 2px;
  background: var(--gold);

}

.products-section .section-subtitle {
  font-size: 12px;
  color: var(--text-muted);
  max-width: 600px;
  margin-top: 1rem ;
  text-align: left !important;
}

/* Category Filter - Premium Style */
.products-section .filter-select {
  border: 1px solid var(--border) !important;
  border-radius: 50px !important;
  padding: 10px 18px !important;
  font-size: 12px !important;
  font-family: 'Cinzel', serif !important;
  color: var(--text-mid) !important;
  background: var(--white) !important;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02) !important;
  transition: all 0.3s ease;
  cursor: pointer;
}

.products-section .filter-select:hover,
.products-section .filter-select:focus {
  border-color: var(--gold);
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(201, 168, 76, 0.12);
}

/* Product Card - Premium Styling */
.products-section .product-card {
  background: var(--white) !important;
  border: 1px solid var(--border) !important;
  border-radius: 16px;
  overflow: hidden;
  transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
  height: 100%;
  display: flex;
  flex-direction: column;
  position: relative;
  margin: 0;
  padding: 0 !important;
}

.products-section .product-card::before {
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

.products-section .product-card:hover {
  transform: translateY(-6px);
  border-color: var(--gold);
  box-shadow: 0 12px 28px rgba(201, 168, 76, 0.12);
}

.products-section .product-card:hover::before {
  opacity: 1;
}

/* Product Image Wrapper */
.products-section .product-image-wrapper {
  width: 100%;
  height: 240px;
  overflow: hidden;
  background: linear-gradient(145deg, var(--cream), var(--cream-mid));
  position: relative;
}

.products-section .product-image {
  object-fit: cover;
  width: 100%;
  height: 100%;
  transition: transform 0.5s ease;
}

.products-section .product-card:hover .product-image {
  transform: scale(1.05);
}

/* Product Badge (optional decorative) */
.products-section .product-card .product-badge {
  position: absolute;
  top: 12px;
  left: 12px;
  font-size: 9px;
  letter-spacing: 1px;
  color: var(--gold);
  background: var(--gold-pale);
  border: 1px solid var(--border-gold);
  padding: 3px 10px;
  border-radius: 50px;
  text-transform: uppercase;
  font-family: 'Cinzel', serif;
  z-index: 2;
  backdrop-filter: blur(2px);
}

/* Product Name */
.products-section .product-card h5 {
  font-family: 'Cinzel', serif;
  font-size: 14px;
  font-weight: 600;
  color: var(--dark);
  margin: 0 0 8px 0;
  line-height: 1.35;
  transition: color 0.2s ease;
  padding: 0;
}

.products-section .product-card:hover h5 {
  color: var(--gold);
}

/* Product Price */
.products-section .product-price {
  font-family: 'Cinzel', serif;
  font-size: 15px;
  font-weight: 600;
  color: var(--gold);
  display: flex;
  align-items: center;
  gap: 4px;
}

.products-section .product-price img {
  width: 14px;
  height: 14px;
}

/* Add to Cart Button - Premium Style */
.products-section .btn-add-cart {
  background: transparent;
  border: 1.5px solid var(--gold);
  color: var(--gold);
  font-family: 'Cinzel', serif;
  font-size: 11px;
  font-weight: 500;
  padding: 6px 14px;
  border-radius: 50px;
  transition: all 0.3s ease;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

.products-section .btn-add-cart:hover {
  background: var(--gold);
  color: var(--dark);
  transform: translateY(-2px);
  box-shadow: 0 4px 10px rgba(201, 168, 76, 0.2);
}

.products-section .btn-add-cart i {
  font-size: 12px;
}

/* Pagination - Premium Styling */
.products-section .pagination {
  display: flex;
  justify-content: center;
  gap: 6px;
  flex-wrap: wrap;
}

.products-section .pagination .page-item {
  list-style: none;
}

.products-section .pagination .page-link {
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

.products-section .pagination .page-link:hover {
  background: var(--gold-pale);
  border-color: var(--gold);
  color: var(--gold);
}

.products-section .pagination .active .page-link {
  background: var(--gold);
  border-color: var(--gold);
  color: var(--dark);
}
.gold-diamond {
  width: 7px;
  height: 7px;
  background: var(--gold);
  transform: rotate(45deg);
  display: inline-block;
  flex-shrink: 0;
}


.products-section .pagination .disabled .page-link {
  opacity: 0.5;
  cursor: not-allowed;
}
/* Add this instead: */
.products-section .gold-divider {
  display: flex;
  align-items: center;
  gap: 10px;
  margin: 0.7rem 0 0.9rem;   /* left-aligned, so no auto */
}

.products-section .gold-divider::before,
.products-section .gold-divider::after {
  content: '';
  display: block;
  width: 40px;
  height: 1px;
}

.products-section .gold-divider::before {
  background: linear-gradient(to right, transparent, var(--gold));
}

.products-section .gold-divider::after {
  background: linear-gradient(to left, transparent, var(--gold));
}
/* Responsive Adjustments */
@media (max-width: 992px) {
  .products-section .product-image-wrapper {
    height: 210px;
  }
  .products-section .product-card h5 {
    font-size: 13px;
  }
  .products-section .product-price {
    font-size: 14px;
  }
  .products-section .btn-add-cart {
    font-size: 10px;
    padding: 5px 12px;
  }
}

@media (max-width: 768px) {
  .products-section .product-image-wrapper {
    height: 180px;
  }
  .products-section .product-card h5 {
    font-size: 12px;
  }
  .products-section .filter-select {
    width: 100%;
    margin-bottom: 1rem;
  }
}

@media (max-width: 576px) {
  .products-section .product-image-wrapper {
    height: 160px;
  }
  .products-section .product-card h5 {
    font-size: 11px;
  }
  .products-section .product-price {
    font-size: 13px;
  }
  .products-section .btn-add-cart {
    font-size: 9px;
    padding: 4px 10px;
  }
}

/* Animation for cards */
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

.products-section .col {
  animation: fadeSlideUp 0.5s ease backwards;
}

.products-section .col:nth-child(1) { animation-delay: 0.05s; }
.products-section .col:nth-child(2) { animation-delay: 0.1s; }
.products-section .col:nth-child(3) { animation-delay: 0.15s; }
.products-section .col:nth-child(4) { animation-delay: 0.2s; }
</style>

<div class="products-section max-w-7xl mx-auto pb-5">
  <div class="container my-5">

    <!-- Section Title with Gold Accent -->
    <div class="text-center mb-4">
      <h2 class="section-title">Products</h2>
      <div class="gold-divider">
                <span class="gold-diamond"></span>
            </div>
      <p class="section-subtitle">
        See new products and how {{ ucfirst($appname) }} helped them find their path to happiness!
      </p>
    </div>

    <!-- Category Filter -->
    <div class="col-ms-12 col-md-3 d-md-flex nowrap align-items-center pl-md-0 pt-2 pb-2 ml-auto" id="filterproductCategory">
      <select name="productCategoryId" onchange="onFilterProductCategoryList()" class="form-control filter-select rounded shadow-sm border-0" id="psychicCategories">
        <option value="0" {{ ($productCategoryId ?? '') == '0' ? 'selected' : '' }}>Select Category</option>
        @foreach (($getproductCategory['recordList'] ?? []) as $category)
          <option value="{{ $category['id'] ?? '' }}" {{ ($productCategoryId ?? '') == ($category['id'] ?? '') ? 'selected' : '' }}>
            {{ $category['name'] ?? 'Unnamed Category' }}
          </option>
        @endforeach
      </select>
    </div>

    <!-- Products Grid -->
    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mt-4">
      @if (count($productlist) > 0)
        @php
          $colors = ['fuchsia', 'slate', 'purple', 'lime', 'rose', 'green', 'sky'];
        @endphp
        @foreach ($productlist as $key => $products)
          @php $color = $colors[$key % count($colors)]; @endphp
          <div class="col" data-aos="fade-up">
            <div class="product-card d-flex flex-column shadow-sm border-0 rounded-4 overflow-hidden bg-white transition-all">
              <a href="{{ route('front.getproductDetails', ['slug' => $products->slug]) }}" class="text-decoration-none">
                <div class="product-image-wrapper position-relative overflow-hidden">
                  <span class="product-badge">✦ Sacred Item</span>
                  <img
                    class="product-image w-100 h-100"
                    src="{{ Str::startsWith($products->productImage, ['http://','https://']) ? $products->productImage : '/' . $products->productImage }}"
                    onerror="this.onerror=null;this.src='/build/assets/images/person.png';"
                    alt="{{ $products->name }}"
                  />
                </div>
              </a>
              <div class="d-flex flex-column justify-content-between flex-grow-1 p-3">
                <!-- Product Name -->
                <h5 class="text-dark fw-semibold mb-3">{{ $products->name }}</h5>
                
                <!-- Price and Buy Button Row -->
                <div class="d-flex justify-content-between align-items-center mt-auto">
                  <span class="product-price mb-0">
                    @if($walletType == 'coin')
                      <img src="{{ asset($coinIcon) }}" alt="Wallet Icon" width="14">
                    @else
                      {{ $currency['value'] }}
                    @endif
                    {{ $products->amount }}
                  </span>
                  <button class="btn btn-add-cart" 
                    data-product-id="{{ $products->id }}"
                    data-product-name="{{ $products->name }}">
                    <i class="fas fa-shopping-cart me-1"></i> Add to Cart
                  </button>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      @endif
    </div>
  </div>
</div>

<!-- Pagination Controls -->
<div class="mt-8 d-flex justify-content-center pt-5 pb-5 products-section">
  {{ $productlist->appends(request()->query())->links() }}
</div>

@endsection

@section('scripts')
<script>
function onFilterProductCategoryList() {
  var productCategoryId = $('#psychicCategories').val();
  var url = new URL(window.location.href);
  url.searchParams.set('productCategoryId', productCategoryId);
  window.location.href = url.toString();
}
</script>
@endsection