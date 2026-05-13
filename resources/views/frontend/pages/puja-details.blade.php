@extends('frontend.layout.master')

@section('content')

<style>
/* Premium Astrology Theme - Puja Details Page */
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

/* Breadcrumb Styling */
.astroway-breadcrumb {
  background: linear-gradient(135deg, var(--dark), var(--dark-mid)) !important;
  padding: 0.75rem 0;
}

.breadcrumbs a {
  font-family: 'Cinzel', serif;
  font-size: 11px;
  letter-spacing: 0.5px;
}

.breadcrumbs i {
  font-size: 10px;
  margin: 0 6px;
  color: var(--gold);
}

/* Product Detail Container */
.product-detail {
  background: var(--white);
  position: relative;
}

.product-detail::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

/* Main Image Card */
.product-detail .shadow {
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05) !important;
  border: 1px solid var(--border);
  border-radius: 20px !important;
}

/* Main Image */
.product-detail .border.rounded {
  border: 1px solid var(--border) !important;
  border-radius: 16px !important;
  background: var(--cream);
}

#mainImage {
  object-fit: cover;
  transition: transform 0.3s ease;
}

#mainImage:hover {
  transform: scale(1.02);
}

/* Thumbnails */
.product-detail .rounded.border {
  border: 1px solid var(--border) !important;
  border-radius: 12px !important;
  transition: all 0.2s ease;
}

.product-detail .rounded.border:hover {
  border-color: var(--gold) !important;
  box-shadow: 0 4px 10px rgba(201, 168, 76, 0.2);
}

/* Product Title */
.product-detail .h3.fw-bold {
  font-family: 'Cinzel', serif;
  font-size: 18px;
  font-weight: 600;
  color: var(--gold);
  margin-bottom: 0.5rem;
}

.product-detail .h4.text-muted {
  font-family: 'Cinzel', serif;
  font-size: 16px;
  font-weight: 500;
  color: var(--dark) !important;
}

.product-detail .h5.text-muted {
  font-size: 13px;
  color: var(--text-muted) !important;
}

.product-detail .text-secondary {
  color: var(--text-mid) !important;
  font-size: 13px;
}

/* Badge Styling */
.badge.bg-primary {
  background: var(--gold-pale) !important;
  color: var(--gold) !important;
  font-family: 'Cinzel', serif;
  font-size: 12px;
  font-weight: 500;
  border: 1px solid var(--border-gold);
  border-radius: 50px !important;
}

.badge.bg-warning {
  background: var(--gold-pale) !important;
  color: var(--gold) !important;
  font-family: 'Cinzel', serif;
  font-size: 12px;
}

.badge.bg-success {
  background: #2D9B5A !important;
  color: white !important;
  font-family: 'Cinzel', serif;
  font-size: 12px;
  padding: 6px 14px;
  border-radius: 50px !important;
}

/* Countdown Timer */
.countdown-timer .badge {
  background: var(--gold-pale) !important;
  color: var(--gold) !important;
  padding: 8px 16px;
  border-radius: 50px !important;
}

/* Select Package Button */
.btn-outline-primary {
  background: transparent;
  border: 1.5px solid var(--gold) !important;
  color: var(--gold) !important;
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  padding: 12px 24px;
  border-radius: 50px !important;
  transition: all 0.3s ease;
}

.btn-outline-primary:hover {
  background: var(--gold) !important;
  color: var(--dark) !important;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(201, 168, 76, 0.3);
}

/* Tab Menu Styling */
.product-info {
  border-top: 1px solid var(--border);
  border-bottom: 1px solid var(--border);
  background: var(--white);
}

.product-info .nav-link {
  font-family: 'Cinzel', serif;
  font-weight: 500;
  color: var(--text-mid);
  font-size: 13px;
  border-radius: 50px;
  padding: 8px 22px;
  transition: all 0.3s ease;
  margin: 0 4px;
}

.product-info .nav-link.active {
  color: var(--dark);
  background-color: var(--gold);
  border-radius: 50px;
}

.product-info .nav-link:hover:not(.active) {
  color: var(--gold);
  background: var(--gold-pale);
}

/* Tab Content Sections */
.section {
  display: none;
  animation: fadeIn 0.4s ease-in-out;
}

.section.active {
  display: block;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.section h2 {
  font-family: 'Cinzel', serif;
  font-size: 18px;
  font-weight: 600;
  color: var(--dark);
  margin-bottom: 1rem;
  position: relative;
  display: inline-block;
}

.section h2::before {
  content: '✦';
  color: var(--gold);
  margin-right: 6px;
  font-size: 12px;
}

.section .text-justify {
  font-size: 13px;
  line-height: 1.7;
  color: var(--text-mid);
}

/* Benefits Cards */
.section .d-flex {
  background: var(--cream);
  padding: 12px;
  border-radius: 12px;
  border: 1px solid var(--border);
  transition: all 0.3s ease;
}

.section .d-flex:hover {
  border-color: var(--gold);
  transform: translateY(-2px);
}

.section .flex-shrink-0 {
  background: var(--gold-pale) !important;
}

.section .flex-shrink-0 i {
  color: var(--gold) !important;
}

.section h6.fw-bold {
  font-family: 'Cinzel', serif;
  font-size: 13px;
  color: var(--dark);
}

.section .text-muted {
  font-size: 11px;
  color: var(--text-muted) !important;
}

/* Process Steps */
#process .row .col-md-4 {
  background: var(--cream);
  padding: 16px;
  border-radius: 12px;
  border: 1px solid var(--border);
  transition: all 0.3s ease;
}

#process .row .col-md-4:hover {
  border-color: var(--gold);
  transform: translateY(-3px);
}

#process h6.fw-bold {
  font-family: 'Cinzel', serif;
  font-size: 14px;
  color: var(--dark);
}

/* Packages Cards */
.card.shadow-sm {
  border: 1px solid var(--border) !important;
  border-radius: 16px !important;
  background: var(--white);
  transition: all 0.3s ease;
}

.card.shadow-sm:hover {
  transform: translateY(-5px);
  border-color: var(--gold) !important;
  box-shadow: 0 12px 24px rgba(201, 168, 76, 0.1) !important;
}

.card .text-warning {
  color: var(--gold) !important;
  font-family: 'Cinzel', serif;
}

.card h4.text-warning {
  font-size: 16px;
  font-weight: 600;
}

.card .text-danger {
  color: var(--gold) !important;
  font-family: 'Cinzel', serif;
  font-size: 18px;
}

.card ul li {
  font-size: 11px;
  color: var(--text-mid);
  margin-bottom: 6px;
}

.card ul li i {
  color: var(--gold);
  margin-right: 6px;
}

.btn-success {
  background: var(--gold) !important;
  border: none !important;
  color: var(--dark) !important;
  font-family: 'Cinzel', serif;
  font-size: 12px;
  font-weight: 600;
  padding: 10px 20px;
  border-radius: 50px !important;
  transition: all 0.3s ease;
}

.btn-success:hover {
  background: var(--gold-light) !important;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(201, 168, 76, 0.3);
}

/* Accordion/FAQs */
.accordion-item {
  border: 1px solid var(--border) !important;
  border-radius: 12px !important;
  margin-bottom: 10px;
  overflow: hidden;
}

.accordion-button {
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 500;
  color: var(--dark);
  background: var(--white);
  padding: 14px 20px;
}

.accordion-button:not(.collapsed) {
  color: var(--gold);
  background: var(--gold-pale);
}

.accordion-button:focus {
  box-shadow: none;
  border-color: var(--gold);
}

.accordion-body {
  font-size: 12px;
  color: var(--text-mid);
  line-height: 1.7;
  padding: 16px 20px;
}

/* Responsive */
@media (max-width: 768px) {
  .product-detail .shadow {
    padding: 16px !important;
  }
  
  .product-info .nav-link {
    font-size: 11px;
    padding: 6px 14px;
  }
  
  .section h2 {
    font-size: 16px;
  }
  
  .card h4.text-warning {
    font-size: 14px;
  }
}

@media (max-width: 576px) {
  .product-info .nav-link {
    font-size: 10px;
    padding: 5px 12px;
    margin: 2px;
  }
  
  .btn-outline-primary {
    font-size: 11px;
    padding: 10px 16px;
  }
}
</style>

<main role="main" class="margin-top-header">
    <div class="pt-1 pb-1 bg-red d-md-block astroway-breadcrumb">
        <div class="container">
            <div class="row afterLoginDisplay">
                <div class="col-12 d-flex align-items-center">
                    <span style="text-transform: capitalize;">
                        <span class="text-white breadcrumbs">
                            <a href="/" class="text-white text-decoration-none">
                                <i class="fa fa-home font-18"></i>
                            </a>
                            <i class="fa fa-chevron-right"></i>
                            <a href="{{ route('front.pujaList',$puja->category_id) }}" class="text-white text-decoration-none">Puja</a>
                            <i class="fa fa-chevron-right"></i>
                            Puja Details - {{$puja->puja_title}}
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="product-detail bg-white py-4">
        <div class="container py-5 px-3">
            <!-- Product Card -->
            <div class="bg-white rounded-3 shadow p-4 d-flex flex-column flex-md-row gap-4">
                
                <!-- Left: Main Image -->
                <div class="col-md-6 d-flex flex-column align-items-center">
                    <div class="w-100 border rounded overflow-hidden" style="height: 400px;">
                        @foreach ($puja->puja_images as $index => $image)
                            <img id="mainImage" class="w-100 h-100 object-fit-cover transition-all" 
                                 src="{{ Str::startsWith($image, ['http://','https://']) ? $image : '/' . $image }}" 
                                 onerror="this.onerror=null;this.src='/build/assets/images/person.png';" 
                                 alt="{{ $puja->puja_title }}" 
                                 onclick="changeImage(this)" />
                        @endforeach
                    </div>

                    <!-- Thumbnails -->
                    <div class="d-flex gap-3 mt-3 overflow-auto w-100 justify-content-center">
                        @foreach ($puja->puja_images as $index => $image)
                            <img class="rounded border" style="width: 80px; height: 80px; object-fit: cover; cursor: pointer; transition: all 0.2s;" 
                                 src="{{ Str::startsWith($image, ['http://','https://']) ? $image : '/' . $image }}" 
                                 onerror="this.onerror=null;this.src='/build/assets/images/person.png';" 
                                 alt="Thumbnail" 
                                 onclick="changeImage(this)" 
                                 onmouseover="this.style.transform='scale(1.05)'" 
                                 onmouseout="this.style.transform='scale(1)'" />
                        @endforeach
                    </div>
                </div>

                <!-- Right: Product Details -->
                <div class="col-md-6 d-flex flex-column">
                    <div>
                        <h2 class="h3 fw-bold mb-2">{{ $puja->category->name }}</h2>
                        <h4 class="text-muted mb-1">{{ $puja->puja_title }}</h4>
                        <h5 class="text-muted mb-2">{{ $puja->puja_subtitle }}</h5>
                        <strong class="text-secondary mb-4 d-block">{{ $puja->puja_place }}</strong>

                        <?php
                            $startDatetime = \Carbon\Carbon::parse($puja->puja_start_datetime);
                            $endDatetime = \Carbon\Carbon::parse($puja->puja_end_datetime);

                            $startDateDisplay = $startDatetime->format('j M, D');
                            $endDateDisplay = $endDatetime->format('j M, D');
                            $startTimeDisplay = $startDatetime->format('H:i');
                            $endTimeDisplay = $endDatetime->format('H:i');
                            $sameDate = $startDatetime->isSameDay($endDatetime);

                            $now = \Carbon\Carbon::now();
                            $isFutureEvent = $now->lt($startDatetime);
                        ?>

                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-primary fs-6 py-2 px-3">
                                @if($sameDate)
                                    {{ $startDateDisplay }} {{ $startTimeDisplay }} - {{ $endTimeDisplay }}
                                @else
                                    {{ $startDateDisplay }} {{ $startTimeDisplay }} to {{ $endDateDisplay }} {{ $endTimeDisplay }}
                                @endif
                            </span>
                        </div>

                        @if($isFutureEvent)
                            <div class="countdown-timer mt-2" 
                                 data-start-datetime="{{ $startDatetime->toIso8601String() }}">
                                <span class="badge bg-warning text-dark">
                                    Puja starts in: 
                                    <span class="days">0</span>d 
                                    <span class="hours">0</span>h 
                                    <span class="minutes">0</span>m 
                                    <span class="seconds">0</span>s
                                </span>
                            </div>
                        @else
                            <div class="mt-2">
                                <span class="badge bg-success p-2 mb-5">✦ Puja is ongoing ✦</span>
                            </div>
                        @endif
                    </div>

                    <a href="#packages" class="btn btn-outline-primary mt-5 w-100 mt-4 fw-semibold d-flex justify-content-center align-items-center">
                        Select Puja Package <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <!-- ===== TAB MENU ===== -->
        <div class="py-2 product-info justify-content-center d-flex w-100 mt-3">
            <ul class="nav flex-wrap justify-content-center" id="pujaTabs">
                <li class="nav-item px-3">
                    <a class="nav-link active" data-target="about">About Puja</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link" data-target="benefits">Benefits</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link" data-target="process">Process</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link" data-target="packages">Packages</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link" data-target="faqs">FAQs</a>
                </li>
            </ul>
        </div>

        <!-- ===== TAB CONTENT ===== -->
        <div class="tab-content mt-4">
            <!-- About -->
            <div id="about" class="section active">
                <h2>About Puja</h2>
                <p class="text-justify">
                    {{ $puja->long_description ?? 'Detailed description about the Puja will appear here.' }}
                </p>
            </div>

            <!-- Benefits -->
            <div id="benefits" class="section">
                <h2>Puja Benefits</h2>
                <div class="row mt-4">
                    @foreach ($puja->puja_benefits as $benefit)
                    <div class="col-md-4 mb-3">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3" style="background-color:#f8f8f8;border-radius:50%;height:50px;width:50px;display:flex;align-items:center;justify-content:center;">
                                <i class="fa fa-star text-warning fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold">{{ $benefit['title'] }}</h6>
                                <p class="text-muted mb-0">{{ $benefit['description'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Process -->
            <div id="process" class="section">
                <h2>Puja Process</h2>
                <div class="row mt-4">
                    <div class="col-md-4 mb-3">
                        <h6 class="fw-bold">1️⃣ Select Puja</h6>
                        <p class="text-muted">Choose from the puja packages listed below.</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <h6 class="fw-bold">2️⃣ Add Offerings</h6>
                        <p class="text-muted">Enhance your experience with optional offerings like Deep Daan or Anna Daan.</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <h6 class="fw-bold">3️⃣ Sankalp Details</h6>
                        <p class="text-muted">Provide Name and Gotra for Sankalp.</p>
                    </div>
                </div>
            </div>

            <!-- Packages -->
            <div id="packages" class="section">
                <h2>Select Puja Package</h2>
                <div class="row mt-4">
                    @foreach ($package as $packageDetail)
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm border-warning h-100">
                            <div class="card-body text-center">
                                <h4 class="text-warning">{{ $packageDetail['title'] }}</h4>
                                <p class="mb-1 text-muted">For {{ $packageDetail['person'] }} Person</p>
                                <h3 class="fw-bold text-danger">
                                    @if(systemflag('walletType') == 'Coin')
                                        <img src="{{ asset($coinIcon) }}" alt="Wallet Icon" width="15">
                                    @else
                                        ₹
                                    @endif
                                    {{ $packageDetail['package_price'] }}
                                </h3>
                                <ul class="text-start mt-3 list-unstyled small">
                                    @foreach ($packageDetail['description'] as $point)
                                    <li><i class="fa-solid fa-hand-point-right text-warning"></i> {{ $point }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-footer bg-transparent border-top-0 text-center pb-3">
                                <a @if(!authcheck()) data-toggle="modal" data-target="#loginSignUp" @else href="{{route('front.pujaAstrologerList',['slug'=>$puja->slug,'package_id'=>$packageDetail['id']])}}" @endif class="btn btn-success w-75">Participate</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- FAQs -->
            <div id="faqs" class="section">
                <h2>Frequently Asked Questions</h2>
                <div class="accordion" id="faqAccordion">
                    @foreach ($FAQ as $index => $faqItem)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="false">
                                {{ $faqItem->title }}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                {{ $faqItem->description }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>

<script>
function changeImage(el) {
    document.getElementById('mainImage').src = el.src;
}

// Handle tab switching
const tabs = document.querySelectorAll('#pujaTabs .nav-link');
const sections = document.querySelectorAll('.section');

tabs.forEach(tab => {
    tab.addEventListener('click', function() {
        tabs.forEach(t => t.classList.remove('active'));
        this.classList.add('active');

        sections.forEach(s => s.classList.remove('active'));

        const targetId = this.getAttribute('data-target');
        document.getElementById(targetId).classList.add('active');

        window.scrollTo({ top: document.querySelector('.product-info').offsetTop - 100, behavior: 'smooth' });
    });
});

// Countdown Timer
document.addEventListener('DOMContentLoaded', function() {
    const countdownElements = document.querySelectorAll('.countdown-timer');
    
    function updateCountdown() {
        countdownElements.forEach(element => {
            const startDatetime = new Date(element.dataset.startDatetime);
            const now = new Date();
            const diff = startDatetime - now;
            
            if (diff <= 0) {
                element.innerHTML = '<span class="badge bg-success">✦ Puja has started ✦</span>';
                return;
            }
            
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);
            
            element.querySelector('.days').textContent = days;
            element.querySelector('.hours').textContent = hours;
            element.querySelector('.minutes').textContent = minutes;
            element.querySelector('.seconds').textContent = seconds;
        });
    }
    
    updateCountdown();
    setInterval(updateCountdown, 1000);
});

// Read more/less functionality
document.addEventListener('DOMContentLoaded', function() {
    const readMoreElements = document.querySelectorAll('.read-more');
    readMoreElements.forEach(element => {
        element.addEventListener('click', function() {
            const fullDescription = this.nextElementSibling;
            const readLess = this.nextElementSibling.nextElementSibling;
            fullDescription.style.display = 'inline';
            this.style.display = 'none';
            readLess.style.display = 'inline';
        });
    });

    const readLessElements = document.querySelectorAll('.read-less');
    readLessElements.forEach(element => {
        element.addEventListener('click', function() {
            const fullDescription = this.previousElementSibling;
            const readMore = this.previousElementSibling.previousElementSibling;
            fullDescription.style.display = 'none';
            this.style.display = 'none';
            readMore.style.display = 'inline';
        });
    });
});
</script>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

@endsection