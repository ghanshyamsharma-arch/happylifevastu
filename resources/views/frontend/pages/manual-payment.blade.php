@extends('frontend.layout.master')
@section('content')
<style>
/* ═══════════════════════════════════════════════════════
   PREMIUM PUJARI LISTING PAGE — Sacred Luxury Theme
   Matches overall website aesthetic
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
  --sacred-red:    #c0392b;
  --sacred-red-light: #ee4e5e;
}

.pujari-section {
  background: linear-gradient(135deg, var(--white) 0%, var(--cream) 100%);
  position: relative;
  min-height: 100vh;
  padding-bottom: 2rem;
}

/* Top shimmer line */
.pujari-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: linear-gradient(90deg, transparent 0%, var(--gold-light) 40%, var(--gold) 50%, var(--gold-light) 60%, transparent 100%);
  z-index: 2;
}

/* Warm noise texture */
.pujari-section::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 0;
}

.pujari-section .container {
  position: relative;
  z-index: 1;
}

/* ─── Breadcrumb Styling ─── */
.sacred-breadcrumb {
  background: linear-gradient(135deg, var(--cream) 0%, var(--white) 100%);
  border-bottom: 1px solid var(--border);
  margin-bottom: 0;
}

.sacred-breadcrumb .breadcrumbs {
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  letter-spacing: 0.5px;
}

.sacred-breadcrumb .breadcrumbs a {
  color: var(--text-mid);
  transition: color 0.2s ease;
}

.sacred-breadcrumb .breadcrumbs a:hover {
  color: var(--gold);
  text-decoration: none;
}

.sacred-breadcrumb .breadcrumbs i {
  font-size: 11px;
  color: var(--gold);
  margin: 0 6px;
}

/* ─── Page Header ─── */
.pujari-header {
  margin-bottom: 2rem;
}

.page-title {
  font-family: 'Cinzel', serif;
  font-size: clamp(28px, 5vw, 42px);
  font-weight: 700;
  color: var(--dark);
  margin: 0 0 0.5rem 0;
}

.page-title span {
  color: var(--gold);
  position: relative;
  display: inline-block;
}

.page-title span::after {
  content: '';
  position: absolute;
  bottom: -5px;
  left: 0;
  right: 0;
  height: 2px;
  background: linear-gradient(90deg, var(--gold), transparent);
}

.page-subtitle {
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  color: var(--text-mid);
  margin-top: 8px;
}

/* Gold divider */
.title-divider {
  display: flex;
  align-items: center;
  gap: 10px;
  margin: 10px 0 15px 0;
}

.title-divider::before {
  content: '';
  display: block;
  width: 48px;
  height: 1px;
  background: linear-gradient(to right, transparent, var(--gold));
}

.title-divider::after {
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

/* ─── Search Bar ─── */
.search-wrapper {
  margin-bottom: 2rem;
}

.search-container {
  max-width: 450px;
}

.sacred-search {
  background: var(--white);
  border: 1px solid var(--gold);
  border-radius: 50px;
  overflow: hidden;
  transition: all 0.25s ease;
  box-shadow: var(--shadow-card);
}

.sacred-search:hover,
.sacred-search:focus-within {
  box-shadow: var(--shadow-hover);
  border-color: var(--gold-light);
}

.search-input {
  border: none;
  padding: 12px 20px;
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  color: var(--text-dark);
  background: transparent;
}

.search-input:focus {
  outline: none;
  box-shadow: none;
}

.search-btn {
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border: none;
  border-radius: 0 50px 50px 0;
  padding: 10px 24px;
  color: var(--white);
  transition: all 0.25s ease;
}

.search-btn:hover {
  background: linear-gradient(135deg, var(--gold-light) 0%, var(--gold) 100%);
  transform: scale(1.02);
}

/* ─── Pujari Card ─── */
.pujari-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-card);
  overflow: hidden;
  transition: all var(--transition);
  height: 100%;
  position: relative;
}

.pujari-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, var(--gold), var(--gold-light), var(--gold));
  z-index: 2;
}

.pujari-card:hover {
  transform: translateY(-8px);
  box-shadow: var(--shadow-hover);
  border-color: var(--gold);
}

/* Card Inner */
.card-inner {
  padding: 20px 16px 20px 16px;
  text-align: center;
}

/* Profile Image */
.profile-wrapper {
  position: relative;
  display: inline-block;
  margin-bottom: 12px;
}

.profile-img {
  width: 90px;
  height: 90px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid var(--gold);
  transition: all 0.3s ease;
}

.pujari-card:hover .profile-img {
  transform: scale(1.05);
  border-color: var(--gold-light);
}

/* Sacred ring effect */
.profile-wrapper::after {
  content: '';
  position: absolute;
  top: -4px;
  left: -4px;
  right: -4px;
  bottom: -4px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--gold), var(--gold-light), var(--gold));
  opacity: 0.3;
  z-index: -1;
  transition: opacity 0.3s ease;
}

.pujari-card:hover .profile-wrapper::after {
  opacity: 0.6;
}

/* Pujari Name */
.pujari-name {
  font-family: 'Cinzel', serif;
  font-size: 16px;
  font-weight: 700;
  color: var(--dark);
  margin: 10px 0 5px;
  transition: color 0.2s ease;
}

.pujari-card:hover .pujari-name {
  color: var(--gold);
}

/* Skill */
.pujari-skill {
  font-family: 'Lato', sans-serif;
  font-size: 12px;
  color: var(--text-mid);
  margin-bottom: 8px;
}

.pujari-skill i {
  color: var(--gold);
  margin-right: 4px;
}

/* Meta Info */
.pujari-meta {
  display: flex;
  justify-content: center;
  gap: 12px;
  font-size: 11px;
  color: var(--text-muted);
  margin-bottom: 12px;
}

.pujari-meta span {
  display: inline-flex;
  align-items: center;
  gap: 4px;
}

.pujari-meta i {
  color: var(--gold);
}

/* Rate Section */
.pujari-rate {
  margin-bottom: 15px;
  padding: 8px 0;
  border-top: 1px solid var(--cream-mid);
  border-bottom: 1px solid var(--cream-mid);
}

.rate-amount {
  font-family: 'Cinzel', serif;
  font-size: 18px;
  font-weight: 800;
  color: var(--gold);
}

.rate-currency {
  font-family: 'Lato', sans-serif;
  font-size: 12px;
  font-weight: 400;
  color: var(--text-muted);
}

.rate-period {
  font-family: 'Lato', sans-serif;
  font-size: 11px;
  color: var(--text-muted);
}

/* View Profile Button */
.view-profile-btn {
  display: block;
  width: 100%;
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border: none;
  border-radius: 40px;
  padding: 10px 0;
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  color: var(--white);
  text-align: center;
  transition: all 0.25s ease;
  text-decoration: none;
}

.view-profile-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(201,168,76,0.3);
  color: var(--white);
  text-decoration: none;
}

/* Empty State */
.empty-state {
  text-align: center;
  padding: 60px 20px;
  background: var(--white);
  border-radius: var(--radius-card);
  border: 1px solid var(--border);
}

.empty-state-icon {
  font-size: 64px;
  color: var(--border);
  margin-bottom: 20px;
}

.empty-state-icon i {
  background: linear-gradient(135deg, var(--border), var(--text-muted));
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}

.empty-state-title {
  font-family: 'Cinzel', serif;
  font-size: 22px;
  font-weight: 600;
  color: var(--text-mid);
  margin-bottom: 10px;
}

.empty-state-text {
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  color: var(--text-muted);
  margin-bottom: 20px;
}

.clear-search-btn {
  display: inline-block;
  background: transparent;
  border: 1px solid var(--gold);
  border-radius: 40px;
  padding: 8px 24px;
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  color: var(--gold);
  transition: all 0.25s ease;
  text-decoration: none;
}

.clear-search-btn:hover {
  background: var(--gold);
  color: var(--white);
  text-decoration: none;
}

/* Pagination */
.sacred-pagination {
  margin-top: 30px;
}

.sacred-pagination .pagination {
  justify-content: center;
  gap: 8px;
}

.sacred-pagination .page-item .page-link {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: 30px;
  padding: 8px 16px;
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  color: var(--text-mid);
  transition: all 0.25s ease;
}

.sacred-pagination .page-item.active .page-link {
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border-color: var(--gold);
  color: var(--white);
}

.sacred-pagination .page-item .page-link:hover {
  background: var(--gold-pale);
  border-color: var(--gold);
  color: var(--gold);
}

/* Responsive */
@media (max-width: 991px) {
  .profile-img {
    width: 80px;
    height: 80px;
  }
  
  .pujari-name {
    font-size: 15px;
  }
}

@media (max-width: 768px) {
  .search-container {
    max-width: 100%;
  }
  
  .profile-img {
    width: 75px;
    height: 75px;
  }
  
  .pujari-name {
    font-size: 14px;
  }
  
  .pujari-skill {
    font-size: 11px;
  }
  
  .pujari-meta {
    font-size: 10px;
    gap: 8px;
  }
  
  .rate-amount {
    font-size: 16px;
  }
}

@media (max-width: 576px) {
  .card-inner {
    padding: 16px 12px;
  }
  
  .profile-img {
    width: 70px;
    height: 70px;
  }
  
  .view-profile-btn {
    font-size: 12px;
    padding: 8px 0;
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

.pujari-card {
  animation: fadeSlideUp 0.4s ease backwards;
}

.pujari-card:nth-child(1) { animation-delay: 0.05s; }
.pujari-card:nth-child(2) { animation-delay: 0.1s; }
.pujari-card:nth-child(3) { animation-delay: 0.15s; }
.pujari-card:nth-child(4) { animation-delay: 0.2s; }
.pujari-card:nth-child(5) { animation-delay: 0.25s; }
.pujari-card:nth-child(6) { animation-delay: 0.3s; }
.pujari-card:nth-child(7) { animation-delay: 0.35s; }
.pujari-card:nth-child(8) { animation-delay: 0.4s; }
</style>

<div class="pujari-section">
    <!-- Sacred Breadcrumb -->
    <div class="sacred-breadcrumb pt-3 pb-3 d-none d-md-block">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex align-items-center">
                    <span class="breadcrumbs">
                        <a href="{{ route('front.home') }}">
                            <i class="fa fa-home"></i> Home
                        </a>
                        <i class="fa fa-chevron-right"></i>
                        <span style="color: var(--gold);">Sacred Pujaris</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-4">

        {{-- Page Header --}}
        <div class="pujari-header">
            <h1 class="page-title">
                Our <span>Pujaris</span>
            </h1>
            <div class="title-divider">
                <span class="gold-diamond"></span>
            </div>
            <p class="page-subtitle">
                <i class="fa fa-om mr-2" style="color: var(--gold);"></i>
                Book sacred pujaris for all your spiritual and religious needs
            </p>
        </div>

        {{-- Search Bar --}}
        <form method="GET" action="{{ route('front.pujariList') }}" class="search-wrapper">
            <div class="search-container">
                <div class="sacred-search d-flex">
                    <input type="text" name="search"
                        class="search-input flex-grow-1"
                        placeholder="Search by sacred name or divine skill..."
                        value="{{ request('search') }}">
                    <button class="search-btn" type="submit">
                        <i class="fa fa-search mr-1"></i> Search
                    </button>
                </div>
            </div>
        </form>

        {{-- Pujari Cards Grid --}}
        <div class="row g-4">
            @forelse($pujaris as $pujari)
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="pujari-card">
                    <div class="card-inner">
                        {{-- Profile Image --}}
                        <div class="profile-wrapper">
                            <img src="{{ Str::startsWith($pujari->profileImage ?? '', ['http://','https://'])
                                    ? $pujari->profileImage
                                    : asset($pujari->profileImage ?? '') }}"
                                 onerror="this.src='{{ asset('build/assets/images/person.png') }}'"
                                 class="profile-img"
                                 alt="{{ $pujari->name }}">
                        </div>

                        {{-- Name --}}
                        <h3 class="pujari-name">{{ $pujari->name }}</h3>

                        {{-- Primary Skill --}}
                        <p class="pujari-skill">
                            <i class="fa fa-praying-hands"></i>
                            {{ Str::limit($pujari->primarySkill, 45) }}
                        </p>

                        {{-- Experience & Language --}}
                        <div class="pujari-meta">
                            @if($pujari->experienceInYears)
                                <span><i class="fa fa-briefcase"></i> {{ $pujari->experienceInYears }} Yrs</span>
                            @endif
                            <span><i class="fa fa-language"></i> {{ Str::limit($pujari->languageKnown, 20) }}</span>
                        </div>

                        {{-- Rate --}}
                        <div class="pujari-rate">
                            <span class="rate-amount">
                                @if(isset($walletType) && $walletType == 'coin')
                                    <img src="{{ asset($coinIcon) }}" alt="coin" width="14" style="display:inline; margin-right:2px;">
                                @else
                                    <span class="rate-currency">{{ $currency->value ?? '₹' }}</span>
                                @endif
                                {{ number_format($pujari->reportRate, 0) }}
                            </span>
                            <span class="rate-period">/ sacred session</span>
                        </div>

                        <a href="{{ route('front.pujariDetails', $pujari->slug) }}"
                           class="view-profile-btn">
                            <i class="fa fa-eye mr-2"></i> View Sacred Profile
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fa fa-user-circle-o"></i>
                    </div>
                    <h3 class="empty-state-title">No Sacred Pujaris Found</h3>
                    <p class="empty-state-text">
                        @if(request('search'))
                            No pujaris match your search criteria.
                        @else
                            Our sacred pujaris will be available soon.
                        @endif
                    </p>
                    @if(request('search'))
                        <a href="{{ route('front.pujariList') }}" class="clear-search-btn">
                            <i class="fa fa-arrow-left mr-2"></i> Clear Search
                        </a>
                    @endif
                </div>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($pujaris->lastPage() > 1)
        <div class="sacred-pagination">
            {{ $pujaris->appends(request()->query())->links() }}
        </div>
        @endif

    </div>
</div>
@endsection