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

/* Breadcrumb */
.astroway-breadcrumb {
  background: linear-gradient(135deg, var(--dark), var(--dark-mid)) !important;
  padding: 0.75rem 0;
}

.breadcrumbs a, .breadcrumbs span {
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
  border-radius: 0;
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

/* Carousel Styling */
.product-large-image {
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
}

.carousel-inner {
  border-radius: 20px;
}

.carousel-inner img {
  width: 100%;
  height: 400px;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.carousel-inner img:hover {
  transform: scale(1.02);
}

.carousel-control-prev,
.carousel-control-next {
  width: 40px;
  height: 40px;
  background: rgba(0, 0, 0, 0.5);
  border-radius: 50%;
  top: 50%;
  transform: translateY(-50%);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.product-large-image:hover .carousel-control-prev,
.product-large-image:hover .carousel-control-next {
  opacity: 1;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
  background-size: 60%;
}

/* Category Badge */
.border-bottom.border-gray {
  font-family: 'Cinzel', serif;
  font-size: 11px;
  letter-spacing: 1.5px;
  color: var(--gold);
  text-transform: uppercase;
  border-bottom: 2px solid var(--gold) !important;
  padding-bottom: 6px;
  display: inline-block;
}

/* Puja Title */
.puja-title {
  font-family: 'Cinzel', serif;
  font-size: 22px;
  font-weight: 600;
  color: var(--dark);
  line-height: 1.3;
}

/* Puja Subtitle */
.puja-subTitle {
  font-size: 14px;
  color: var(--text-mid);
  font-weight: 500;
}

/* Location & Date Icons */
.fa-place-of-worship, .fa-calendar {
  color: var(--gold);
  font-size: 16px;
  width: 24px;
  margin-top: 2px;
}

.product-detail .d-flex.align-items-start {
  gap: 10px;
  margin-bottom: 12px;
}

.product-detail .d-flex.align-items-start div span {
  font-size: 13px;
  color: var(--text-mid);
  line-height: 1.5;
}

/* Footer Message */
.footer {
  background: linear-gradient(145deg, var(--cream), var(--cream-mid));
  border-radius: 16px;
  padding: 20px;
  margin-top: 20px;
  border: 1px solid var(--border);
}

.footer img {
  max-width: 100px;
  opacity: 0.7;
}

.message {
  font-family: 'Cinzel', serif;
  font-size: 16px;
  font-weight: 600;
  color: var(--gold) !important;
}

/* Responsive */
@media (max-width: 768px) {
  .product-detail .row {
    display: flex;
    flex-direction: column-reverse;
  }
  
  .product-large-image {
    margin-top: 24px;
  }
  
  .carousel-inner img {
    height: 280px !important;
  }
  
  .carousel-control-prev,
  .carousel-control-next {
    top: 45% !important;
    opacity: 1;
    width: 32px;
    height: 32px;
  }
  
  .puja-title {
    font-size: 18px;
  }
  
  .puja-subTitle {
    font-size: 13px;
  }
  
  .footer {
    margin-top: 16px;
    padding: 16px;
  }
  
  .message {
    font-size: 14px;
  }
}

@media (max-width: 576px) {
  .carousel-inner img {
    height: 220px !important;
  }
  
  .puja-title {
    font-size: 16px;
  }
  
  .product-detail .py-4 {
    padding-top: 1rem !important;
    padding-bottom: 1rem !important;
  }
}

/* Animation */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.product-detail .row > div {
  animation: fadeIn 0.4s ease backwards;
}

.product-detail .row > div:first-child { animation-delay: 0.05s; }
.product-detail .row > div:last-child { animation-delay: 0.1s; }
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
                            <a href="{{ route('front.pujaList') }}" class="text-white text-decoration-none">Puja</a>
                            <i class="fa fa-chevron-right"></i>
                            Puja Details - {{$puja->puja_title}}
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="product-detail bg-white py-4 mb-5">
            <div class="row py-4">
                <div class="col-12 col-md-7 d-flex align-items-center">
                    <div id="productCarousel" class="carousel slide product-large-image position-relative" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($puja->puja_images as $index => $image)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img id="PujaImg{{ $index + 1 }}" class="rounded-m" src="{{ Str::startsWith($image, ['http://','https://']) ? $image : '/' . $image }}" onerror="this.onerror=null;this.src='/build/assets/images/person.png';" alt="{{ $puja->puja_title }}" onclick="openImage('{{ $image }}')" />
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                
                <div class="col-12 col-md-5 px-4 mt-3 mt-md-0">
                    <div>
                        <span class="font-weight-semi-bold border-bottom border-gray">{{ $puja->category->name }}</span>
                    </div>
                    <div class="mt-3">
                        <span class="puja-title font-weight-bold font-26">{{ $puja->puja_title }}</span>
                    </div>
                    <div class="mt-2">
                        <span class="puja-subTitle text-secondary font-20 font-weight-semi-bold">{{ $puja->puja_subtitle }}</span>
                    </div>
                    <div class="mt-3 d-flex align-items-start">
                        <i class="fa-solid fa-place-of-worship me-2 mr-2"></i>
                        <div>
                            <span class="d-block" style="font-size: 15px;">{{ $puja->puja_place }}</span>
                        </div>
                    </div>
                    
                    <?php
                    $startDatetime = \Carbon\Carbon::parse($puja->puja_start_datetime);
                    $endDatetime = \Carbon\Carbon::parse($puja->puja_end_datetime);
                    $startDateDisplay = $startDatetime->format('j M, D');
                    $endDateDisplay = $endDatetime->format('j M, D');
                    $startTimeDisplay = $startDatetime->format('H:i');
                    $endTimeDisplay = $endDatetime->format('H:i');
                    $sameDate = $startDatetime->isSameDay($endDatetime);
                    ?>
                    
                    <div class="mt-3 d-flex align-items-start">
                        <i class="fa fa-calendar me-2 mr-2" aria-hidden="true"></i>
                        <div>
                            <span class="d-block" style="font-size: 15px;">
                                {{ $sameDate ? $startDateDisplay . ' ' . $startTimeDisplay . ' to ' . $endTimeDisplay : $startDateDisplay . ' ' . $startTimeDisplay . ' to ' . $endDateDisplay . ' ' . $endTimeDisplay }}
                            </span>
                        </div>
                    </div>

                    <div class="footer mt-5 text-center">
                        <img src="{{ asset('public/frontend/homeimage/360.png') }}" alt="Completion Image" class="mb-3" style="max-width: 150px;">
                        <div class="message font-30 text-success font-weight-bold">Puja has been finished !</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const readMoreElements = document.querySelectorAll('.read-more');

        readMoreElements.forEach(element => {
            element.addEventListener('click', function () {
                const fullDescription = this.nextElementSibling;
                const readLess = this.nextElementSibling.nextElementSibling;
                fullDescription.style.display = 'inline';
                this.style.display = 'none';
                readLess.style.display = 'inline';
            });
        });

        const readLessElements = document.querySelectorAll('.read-less');

        readLessElements.forEach(element => {
            element.addEventListener('click', function () {
                const fullDescription = this.previousElementSibling;
                const readMore = this.previousElementSibling.previousElementSibling;
                fullDescription.style.display = 'none';
                this.style.display = 'none';
                readMore.style.display = 'inline';
            });
        });
    });

    $(document).ready(function () {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 20,
            nav: false,
            dots: true,
            center: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
    });

    document.querySelectorAll('.scrollable-container').forEach(container => {
        container.addEventListener('wheel', (event) => {
            event.preventDefault();
            container.scrollBy({
                top: event.deltaY,
                behavior: 'smooth'
            });
        });
    });
</script>

@endsection