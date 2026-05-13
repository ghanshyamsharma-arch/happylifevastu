@extends('frontend.layout.master')

@section('content')
<style>
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
  --success:       #28a745;
  --warning:       #ffc107;
  --info:          #17a2b8;
}

.report-section {
  background: linear-gradient(135deg, var(--white) 0%, var(--cream) 100%);
  position: relative;
  min-height: 100vh;
  padding: 1rem 0 4rem;
}

.report-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: linear-gradient(90deg, transparent 0%, var(--gold-light) 40%, var(--gold) 50%, var(--gold-light) 60%, transparent 100%);
  z-index: 2;
}

.report-section::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 0;
}

.report-section .container {
  position: relative;
  z-index: 1;
}

/* ─── Breadcrumb ─── */
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

/* ─── Search Header ─── */
.search-header {
  background: linear-gradient(135deg, var(--white) 0%, var(--gold-pale) 100%);
  border-radius: var(--radius-card);
  border: 1px solid var(--border);
  padding: 20px;
  margin: 20px 0;
  box-shadow: var(--shadow-card);
}

.page-sacred-title {
  font-family: 'Cinzel', serif;
  font-size: clamp(20px, 4vw, 28px);
  font-weight: 700;
  color: var(--dark);
  margin: 0;
  display: inline-flex;
  align-items: center;
  gap: 10px;
  white-space: nowrap;
}

.page-sacred-title i {
  color: var(--gold);
}

.title-divider {
  display: flex;
  align-items: center;
  gap: 10px;
  margin: 8px 0 0 0;
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

/* Search Box */
.search-box {
  position: relative;
  display: flex;
  align-items: center;
  margin: 2px;
}

.search-box input {
  flex: 1;
  min-width: 0;
  padding: 10px 45px 10px 15px;
  border: 1px solid var(--border);
  border-radius: 40px;
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  transition: all 0.2s ease;
  width: 100%;
}

.search-box input:focus {
  border-color: var(--gold);
  box-shadow: 0 0 0 3px var(--gold-glow);
  outline: none;
}

.search-box .search-btn {
  position: static;
  right: 5px;
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border: none;
  border-radius: 50%;
  width: 34px;
  height: 34px;
  color: var(--white);
  transition: all 0.2s ease;
  flex-shrink: 0;
}

.search-box .search-btn:hover {
  transform: scale(1.05);
}

/* Sacred Select */
.sacred-select {
  width: 100%;
  min-width: 0;
  padding: 10px 15px;
  border: 1px solid var(--border);
  border-radius: 40px;
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  background: var(--white);
  cursor: pointer;
  transition: all 0.2s ease;
  
}

.sacred-select:focus {
  border-color: var(--gold);
  box-shadow: 0 0 0 3px var(--gold-glow);
  outline: none;
}

/* Clear Button */
.clear-btn {
  background: transparent;
  border: 1px solid var(--gold);
  border-radius: 40px;
  padding: 8px 24px;
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  color: var(--gold);
  transition: all 0.25s ease;
  cursor: pointer;
  width: 100%;
  margin: 2px;
}

.clear-btn:hover {
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  color: var(--white);
}

/* ─── Astrologer Card ─── */
.psychic-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-card);
  padding: 20px;
  margin-bottom: 20px;
  transition: all var(--transition);
  position: relative;
  overflow: hidden;
}

.psychic-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

.psychic-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-hover);
  border-color: var(--gold);
}

/* Card top row */
.psychic-card > ul {
  display: flex;
  flex-wrap: nowrap;
  gap: 16px;
  align-items: flex-start;
}

.psychic-card > ul > li:first-child {
  flex-shrink: 0;
  width: 85px;
}

.psychic-card > ul > li.w-100 {
  flex: 1;
  min-width: 0;
}

/* Profile Image */
.psyich-img {
  position: relative;
  width: 85px;
}

.psyich-img img {
  width: 85px;
  height: 85px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid var(--gold);
  transition: all 0.3s ease;
  display: block;
}

.psychic-card:hover .psyich-img img {
  transform: scale(1.02);
  border-color: var(--gold-light);
}

/* Status Badges */
.status-badge {
  position: absolute;
  bottom: 5px;
  right: 5px;
  width: 14px;
  height: 14px;
  border-radius: 50%;
  border: 2px solid var(--white);
}

.specific-Clr-Online {
  background-color: #4caf50;
  box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.3);
}

.specific-Clr-Busy {
  background-color: #ff9800;
  box-shadow: 0 0 0 2px rgba(255, 152, 0, 0.3);
}

.specific-Clr-Offline {
  background-color: #9e9e9e;
  box-shadow: 0 0 0 2px rgba(158, 158, 158, 0.3);
}

.status-badge-txt {
  font-family: 'Lato', sans-serif;
  font-size: 10px;
  font-weight: 600;
  margin-top: 4px;
}

/* Astrologer Name */
.astrologer-name {
  font-family: 'Cinzel', serif;
  font-size: 16px;
  font-weight: 700;
  color: var(--dark);
  margin-bottom: 8px;
  display: flex;
  align-items: center;
  gap: 6px;
  flex-wrap: wrap;
}

.astrologer-name svg {
  transition: fill 0.2s ease;
  flex-shrink: 0;
}

.psychic-card:hover .astrologer-name svg {
  fill: var(--gold);
}

/* Info */
.info-icon {
  width: 16px;
  height: 16px;
  margin-right: 6px;
  vertical-align: middle;
  flex-shrink: 0;
}

.info-text {
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  color: var(--text-mid);
  margin-bottom: 6px;
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 4px;
}

.primary-skill {
  color: var(--gold);
  font-weight: 500;
}

/* Price */
.exprt-price {
  font-family: 'Cinzel', serif;
  font-size: 16px;
  font-weight: 800;
  color: var(--gold);
  display: inline-flex;
  align-items: center;
  gap: 4px;
}

/* Rating Stars */
.filled-star { color: var(--gold); }
.empty-star  { color: #ddd; }

/* Card bottom row */
.psychic-card .card-bottom-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 12px;
  margin-top: 16px;
  padding-top: 16px;
  border-top: 1px solid var(--border);
}

/* Get Report Button */
.btn-report {
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border: none;
  border-radius: 40px;
  padding: 8px 20px;
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  color: var(--white);
  transition: all 0.25s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  cursor: pointer;
  white-space: nowrap;
}

.btn-report:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(201,168,76,0.3);
  color: var(--white);
  text-decoration: none;
}

/* Load More Button */
.btn-load-more {
  background: transparent;
  border: 2px solid var(--gold);
  border-radius: 40px;
  padding: 10px 40px;
  font-family: 'Cinzel', serif;
  font-size: 14px;
  font-weight: 600;
  color: var(--gold);
  transition: all 0.25s ease;
  cursor: pointer;
}

.btn-load-more:hover {
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  color: var(--white);
}

/* ─── Modal ─── */
.sacred-modal .modal-content {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-card);
  box-shadow: var(--shadow-hover);
  overflow: hidden;
}

.sacred-modal .modal-header {
  background: linear-gradient(135deg, var(--cream) 0%, var(--gold-pale) 100%);
  border-bottom: 1px solid var(--border);
  padding: 16px 20px;
}

.sacred-modal .modal-title {
  font-family: 'Cinzel', serif;
  font-size: 18px;
  font-weight: 700;
  color: var(--gold);
}

.sacred-modal .close {
  color: var(--text-mid);
  opacity: 0.7;
  transition: opacity 0.2s ease;
}

.sacred-modal .close:hover {
  color: var(--gold);
  opacity: 1;
}

.sacred-modal .form-group {
  margin-bottom: 16px;
}

.sacred-modal label {
  font-family: 'Cinzel', serif;
  font-size: 12px;
  font-weight: 600;
  color: var(--dark);
  margin-bottom: 6px;
  display: block;
}

.sacred-modal input,
.sacred-modal select,
.sacred-modal textarea {
  width: 100%;
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 10px 14px;
  transition: all 0.2s ease;
}

.sacred-modal input:focus,
.sacred-modal select:focus,
.sacred-modal textarea:focus {
  border-color: var(--gold);
  box-shadow: 0 0 0 3px var(--gold-glow);
  outline: none;
}

.phone-input-group {
  display: flex;
  gap: 8px;
  border: 1px solid var(--border);
  border-radius: 12px;
  overflow: hidden;
}

.phone-input-group select {
  width: 30%;
  border: none;
  border-radius: 0;
}

.phone-input-group input {
  flex: 1;
  border: none;
  border-radius: 0;
}

.error-message {
  color: #dc3545;
  font-size: 11px;
  font-family: 'Lato', sans-serif;
  margin-top: 5px;
  display: none;
}

.modal-submit-btn {
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border: none;
  border-radius: 40px;
  padding: 12px 28px;
  font-family: 'Cinzel', serif;
  font-size: 14px;
  font-weight: 600;
  color: var(--white);
  transition: all 0.25s ease;
  width: 100%;
}

.modal-submit-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(201,168,76,0.3);
}

.dont-know-checkbox {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-top: 8px;
}

.dont-know-checkbox input {
  width: auto;
}

.dont-know-checkbox label {
  margin: 0;
  font-family: 'Lato', sans-serif;
  font-size: 12px;
  font-weight: normal;
}

/* ─── Responsive ─── */
@media (max-width: 991px) {
  .psychic-card {
    padding: 15px;
  }
  .astrologer-name {
    font-size: 14px;
  }
  .btn-report {
    padding: 6px 16px;
    font-size: 12px;
  }
}

@media (max-width: 767px) {
  .search-header {
    padding: 15px;
  }
  .psychic-card > ul {
    gap: 12px;
  }
  .psychic-card .card-bottom-row {
    flex-direction: column;
    align-items: flex-start;
  }
  .btn-report {
    width: 100%;
    justify-content: center;
  }
  .psy-review-section {
    width: 100%;
  }
}

@media (max-width: 576px) {
  .page-sacred-title {
    font-size: 20px;
  }
  .sacred-select,
  .search-box input {
    font-size: 12px;
    margin: 2px;
  }
  .btn-load-more {
    padding: 8px 30px;
    font-size: 12px;
  }
}

/* ─── Animation ─── */
@keyframes fadeSlideUp {
  from { opacity: 0; transform: translateY(20px); }
  to   { opacity: 1; transform: translateY(0); }
}

.psychic-card { animation: fadeSlideUp 0.4s ease backwards; }
.psychic-card:nth-child(1) { animation-delay: 0.05s; }
.psychic-card:nth-child(2) { animation-delay: 0.1s; }
.psychic-card:nth-child(3) { animation-delay: 0.15s; }
.psychic-card:nth-child(4) { animation-delay: 0.2s; }
.psychic-card:nth-child(5) { animation-delay: 0.25s; }
</style>

@php
    use Symfony\Component\HttpFoundation\Session\Session;
    $session = new Session();
    $token = $session->get('token');
    $countries = DB::table('countries')
    ->orderByRaw("CASE WHEN phonecode = 91 THEN 0 ELSE 1 END")
    ->get();
@endphp

<div class="report-section">
    <!-- Sacred Breadcrumb -->
    <div class="sacred-breadcrumb pt-3 pb-3 d-none d-md-block">
        <div class="container">
            <div class="row afterLoginDisplay">
                <div class="col-md-12 d-flex align-items-center">
                    <span class="breadcrumbs">
                        <a href="{{ route('front.home') }}">
                            <i class="fa fa-home"></i> Home
                        </a>
                        <i class="fa fa-chevron-right"></i>
                        <span style="color: var(--gold);">Detailed Report</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filter Section -->
    <div class="container">
        <div class="search-header">
            <div class="row align-items-center gy-3">
                <div class="col-12 col-md-3">
                    <h1 class="page-sacred-title">
                        <i class="fa fa-file-text-o"></i> Detailed Report
                    </h1>
                    <div class="title-divider">
                        <span class="gold-diamond"></span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <form action="{{ route('front.reportList') }}" method="GET">
                        <div class="search-box">
                            <input value="{{ isset($searchTerm) ? $searchTerm : '' }}"
                                class="form-control rounded" name="s" placeholder="Search {{ucfirst($professionTitle)}}"
                                type="search" autocomplete="off">
                            <button type="submit" class="search-btn">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12 col-md-2">
                    <select class="sacred-select" name="sortBy" onchange="onSortExpertList()" id="psychicOrderBy">
                        <option value="1" {{ $sortBy == '1' ? 'selected' : '' }}>Sort Filter</option>
                        <option value="experienceLowToHigh" {{ $sortBy == 'experienceLowToHigh' ? 'selected' : '' }}>Low Experience</option>
                        <option value="experienceHighToLow" {{ $sortBy == 'experienceHighToLow' ? 'selected' : '' }}>High Experience</option>
                        <option value="priceLowToHigh" {{ $sortBy == 'priceLowToHigh' ? 'selected' : '' }}>Lowest Price</option>
                        <option value="priceHighToLow" {{ $sortBy == 'priceHighToLow' ? 'selected' : '' }}>Highest Price</option>
                    </select>
                </div>
                <div class="col-sm-12 col-md-2">
                    <select name="astrologerCategoryId" onchange="onFilterExpertCategoryList()" class="sacred-select" id="psychicCategories" style="margin: 2px;">
                        <option value="0" {{ $astrologerCategoryId == '0' ? 'selected' : '' }}>All Categories</option>
                        @foreach ($getAstrologerCategory as $category)
                            <option value="{{ $category['id'] }}" {{ $astrologerCategoryId == $category['id'] ? 'selected' : '' }}>
                                {{ $category['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12 col-md-2">
                    <button type="button" id="clearButton" class="clear-btn w-100">
                        <i class="fa fa-refresh"></i> Clear All
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Astrologer List -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="expert-list" class="py-4">
                    @foreach ($getAstrologer as $astrologer)
                        <div id="ATAAIOfferTile" class="psychic-card" data-astrologer-id="{{ $astrologer['id'] }}">
                            <ul class="list-unstyled d-flex mb-0">
                                <li class="mr-3 position-relative mb-0">
                                    <a href="{{ route('front.astrologerDetails', ['slug' => $astrologer['slug']]) }}">
                                        <div class="psyich-img position-relative">
                                            @if ($astrologer['profileImage'])
                                                <img loading="lazy"
                                                     src="{{ Str::startsWith($astrologer['profileImage'], ['http://','https://']) ? $astrologer['profileImage'] : '/' . $astrologer['profileImage'] }}"
                                                     onerror="this.onerror=null;this.src='/build/assets/images/person.png';"
                                                     alt="{{ $astrologer['name'] }}" />
                                            @else
                                                <img src="{{ asset('public/frontend/astrowaycdn/dashaspeaks/web/content/images/user-img-new.png') }}"
                                                     alt="{{ $astrologer['name'] }}">
                                            @endif
                                        </div>
                                    </a>
                                    @if ($astrologer['chatStatus'] == 'Busy')
                                        <div class="status-badge specific-Clr-Busy" title="Busy"></div>
                                    @elseif($astrologer['chatStatus'] == 'Offline' || empty($astrologer['chatStatus']))
                                        <div class="status-badge specific-Clr-Offline" title="Offline"></div>
                                        <div class="status-badge-txt text-center specific-Clr-Offline">
                                            <span class="tooltipex">{{ $astrologer['chatStatus'] ?? 'Offline' }}</span>
                                        </div>
                                    @else
                                        <div class="status-badge specific-Clr-Online" title="Online"></div>
                                        <div class="status-badge-txt text-center specific-Clr-Online">
                                            <span class="tooltipex">{{ $astrologer['chatStatus'] }}</span>
                                        </div>
                                    @endif
                                </li>

                                <li class="w-100">
                                    <div class="astrologer-name">
                                        {{ $astrologer['name'] }}
                                        <svg fill="#495057" height="16" width="16" viewBox="0 0 106.11 122.88">
                                            <path d="M56.36,2.44A104.34,104.34,0,0,0,79.77,13.9a48.25,48.25,0,0,0,19.08,2.57l6.71-.61.33,6.74c1.23,24.79-2.77,46.33-11.16,63.32C86,103.6,72.58,116.37,55.35,122.85l-4.48,0c-16.84-6.15-30.16-18.57-39-36.47C3.62,69.58-.61,47.88.07,22l.18-6.65,6.61.34A64.65,64.65,0,0,0,28.23,13.5,60.59,60.59,0,0,0,48.92,2.79L52.51,0l3.85,2.44ZM52.93,19.3C66.46,27.88,78.68,31.94,89.17,31,91,68,77.32,96.28,53.07,105.41c-23.43-8.55-37.28-35.85-36.25-75,12.31.65,24.4-2,36.11-11.11ZM45.51,61.61a28.89,28.89,0,0,1,2.64,2.56,104.48,104.48,0,0,1,8.27-11.51c8.24-9.95,5.78-9.3,17.21-9.3L72,45.12a135.91,135.91,0,0,0-11.8,15.3,163.85,163.85,0,0,0-10.76,17.9l-1,1.91-.91-1.94a47.17,47.17,0,0,0-6.09-9.87,33.4,33.4,0,0,0-7.75-7.12c1.49-4.89,8.59-2.38,11.77.31Zm7.38-53.7c17.38,11,33.07,16.22,46.55,15,2.35,47.59-15.23,82.17-46.37,93.9C23,105.82,5.21,72.45,6.53,22.18,22.34,23,37.86,19.59,52.89,7.91Z"/>
                                        </svg>
                                    </div>

                                    <div class="info-text">
                                        <img src="{{ asset('public/frontend/homeimage/horoscope2.svg') }}" class="info-icon" alt="">
                                        <span class="primary-skill">{{ implode(' | ', array_slice(explode(',', $astrologer['primarySkill']), 0, 3)) }}</span>
                                    </div>

                                    <div class="info-text">
                                        <img src="{{ asset('public/frontend/homeimage/language-icon.svg') }}" class="info-icon" alt="">
                                        {{ implode(' • ', array_slice(explode(',', $astrologer['languageKnown']), 0, 3)) }}
                                    </div>

                                    <div class="info-text">
                                        <img src="{{ asset('public/frontend/homeimage/experience-expert-icon.svg') }}" class="info-icon" alt="">
                                        Experience: {{ $astrologer['experienceInYears'] }} Years
                                    </div>

                                    <div class="info-text">
                                        <span class="exprt-price">
                                            @if($walletType == 'coin')
                                                <img src="{{ asset($coinIcon) }}" alt="Coin" width="14">
                                            @else
                                                {{ $currency['value'] }}
                                            @endif
                                            {{ $astrologer['reportRate'] }}/Report
                                        </span>
                                    </div>
                                </li>
                            </ul>

                            <div class="card-bottom-row">
                                <div class="psy-review-section">
                                    <div>
                                        <span class="colorblack font-12 m-0 p-0 d-block">
                                            <span style="color: var(--gold); font-size: 14px; font-weight: bold;">{{ $astrologer['rating'] }}</span>
                                            <span>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $astrologer['rating'])
                                                        <i class="fas fa-star filled-star"></i>
                                                    @else
                                                        <i class="far fa-star empty-star"></i>
                                                    @endif
                                                @endfor
                                            </span>
                                        </span>
                                    </div>
                                    <div><span style="color: gray; font-size: 12px">{{ $astrologer['totalOrder'] ?? 0 }} Sacred Sessions</span></div>
                                </div>
                                <div>
                                    <a class="btn-report" role="button"
                                        data-toggle="modal"
                                        @if (!authcheck()) data-target="#loginSignUp" @else data-target="#intake" @endif>
                                        <i class="fa fa-file-text-o"></i> Get Sacred Report
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($getAstrologer->hasMorePages())
                    <div class="text-center mb-5">
                        <button id="load-more" class="btn-load-more" data-next-page="{{ $getAstrologer->currentPage() + 1 }}">
                            <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                            <span class="btn-text">Load More Sacred Guides</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Intake Form Modal --}}
<div class="modal fade sacred-modal mt-2 mt-md-5" id="intake" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <i class="fa fa-file-text-o mr-2"></i> Report Intake Form
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body pt-0 pb-0">
                <div class="bg-white body">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="mb-3">
                                <form class="px-3 font-14" method="post" id="intakeForm">
                                    @if (authcheck())
                                        <input type="hidden" name="userId" value="{{ authcheck()['id'] }}">
                                        <input type="hidden" name="countryCode" value="{{ authcheck()['countryCode'] }}">
                                    @endif
                                    <input type="hidden" name="astrologerId" id="astroId" value="">
                                    <input type="hidden" name="charge" id="astroCharge" value="">
                                    <input type="hidden" name="reportRate" id="reportRate" value="">

                                    <div class="row">
                                        <div class="col-12 col-md-6 py-2">
                                            <div class="form-group">
                                                <label>Report Type <span class="color-red">*</span></label>
                                                <select class="form-control" id="reportType" name="reportType" required>
                                                    @foreach ($getReportType['recordList'] as $getReportType)
                                                        <option value="{{ $getReportType['id'] }}">{{ $getReportType['title'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 py-2">
                                            <label>Contact Number <span class="color-red">*</span></label>
                                            <div class="phone-input-group">
                                                <select class="form-control" id="countryCode1" name="countryCode">
                                                    @foreach ($countries as $country)
                                                        <option value="+{{ $country->phonecode }}">+{{ $country->phonecode }} ({{ $country->iso }})</option>
                                                    @endforeach
                                                </select>
                                                <input class="form-control" id="contact" maxlength="12" name="contactNo" type="number" value="{{ old('contactNo') }}" required>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 py-2">
                                            <div class="form-group mb-0">
                                                <label>First Name <span class="color-red">*</span></label>
                                                <input class="form-control" id="firstName" name="firstName" placeholder="Enter First Name"
                                                    type="text" value="" pattern="^[a-zA-Z\s]{2,50}$"
                                                    title="Name should contain only letters and be between 2 and 50 characters long."
                                                    required oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 py-2">
                                            <div class="form-group mb-0">
                                                <label>Last Name</label>
                                                <input class="form-control" id="lastName" name="lastName" placeholder="Enter Last Name" type="text" value="">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 py-2">
                                            <div class="form-group">
                                                <label>Gender <span class="color-red">*</span></label>
                                                <select class="form-control" id="Gender" name="gender" required>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 py-2">
                                            <div class="form-group mb-0">
                                                <label>Birth Date <span class="color-red">*</span></label>
                                                <input class="form-control" id="BirthDate" name="birthDate" placeholder="Enter Birthdate" type="date" value="" required>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 py-2">
                                            <div class="form-group mb-0">
                                                <label>Birth Time <span class="color-red">*</span></label>
                                                <input class="form-control" id="BirthTime" name="birthTime" placeholder="Enter Birthtime" type="time" value="">
                                            </div>
                                            <div id="birthTimeErrorBoy" class="error-message">Please provide a birth time or select 'Don't know birth time'.</div>
                                            <div class="dont-know-checkbox">
                                                <input type="checkbox" id="dontKnowTimeBoy">
                                                <label>Don't know birth time</label>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 py-2">
                                            <div class="form-group mb-0">
                                                <label>Birth Place <span class="color-red">*</span></label>
                                                <input class="form-control" id="BirthPlace" name="birthPlace" placeholder="Enter Birthplace" type="text" value="" required>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 py-2">
                                            <div class="form-group mb-0">
                                                <label>Marital Status</label>
                                                <select class="form-control" id="MaritalStatus" name="maritalStatus">
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Divorced">Divorced</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 py-2">
                                            <div class="form-group mb-0">
                                                <label>Occupation</label>
                                                <input class="form-control" id="Occupation" name="occupation" placeholder="Enter Occupation" type="text" value="">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 py-2">
                                            <div class="form-group mb-0">
                                                <label>Preferred Language</label>
                                                <select class="form-control" id="answerLanguage" name="answerLanguage">
                                                    <option value="English">English</option>
                                                    <option value="Hindi">Hindi</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-12 py-2">
                                            <div class="form-group mb-0">
                                                <label>Your Sacred Query <span class="color-red">*</span></label>
                                                <textarea class="form-control" id="comments" name="comments" rows="4" placeholder="Please share your question or concern..." required></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-12 py-3">
                                        <div class="row">
                                            <div class="col-12 pt-md-3 text-center mt-2">
                                                <button class="modal-submit-btn" id="loaderintakeBtn" type="button" style="display:none;" disabled>
                                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...
                                                </button>
                                                <button type="submit" class="modal-submit-btn" id="intakeBtn">
                                                    <i class="fa fa-paper-plane mr-2"></i> Get Sacred Report
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@php
    $googleApiKey = '';
    try {
        $apikey = DB::table('systemflag')->where('name', 'googleMapApiKey')->first();
        $googleApiKey = $apikey->value ?? '';
    } catch (\Exception $e) {
        \Log::error('Failed to fetch Google Maps API key: ' . $e->getMessage());
    }
@endphp

@if(!empty($googleApiKey))
    <script src="https://maps.googleapis.com/maps/api/js?key={{ $googleApiKey }}&libraries=places"></script>
@endif

<script>
$(document).ready(function() {
    let nextPageUrl = "{{ $getAstrologer->nextPageUrl() ?? '' }}";

    $('#load-more').click(function() {
        let $btn = $(this);
        if (!nextPageUrl) {
            console.log("No more pages to load!");
            return;
        }

        $btn.prop('disabled', true);
        $btn.find('.fa-spinner').show();
        $btn.find('.btn-text').text('Loading...');

        @php
            $authcheck = authcheck();
        @endphp

        let authcheck = "{{ $authcheck ? true : false }}";
        let sortBy = $('select[name="sortBy"]').val();
        let astrologerCategoryId = $('input[name="astrologerCategoryId"]').val();
        let searchTerm = $('input[name="s"]').val();

        let url = new URL(nextPageUrl, window.location.origin);
        if (sortBy) url.searchParams.set('sortBy', sortBy);
        if (astrologerCategoryId) url.searchParams.set('astrologerCategoryId', astrologerCategoryId);
        if (searchTerm) url.searchParams.set('s', searchTerm);

        $.ajax({
            url: url.toString(),
            type: "GET",
            success: function(response) {
                if (response.getAstrologer && response.getAstrologer.data && response.getAstrologer.data.length > 0) {
                    var html = '';
                    response.getAstrologer.data.forEach(function(astrologer) {
                        html += `
                            <div id="ATAAIOfferTile" class="psychic-card" data-astrologer-id="${astrologer.id}">
                                <ul class="list-unstyled d-flex mb-0">
                                    <li class="mr-3 position-relative mb-0">
                                        <a href="/astrologer-details/${astrologer.slug}">
                                            <div class="psyich-img position-relative">
                                                ${astrologer.profileImage ? `
                                                    <img src="${astrologer.profileImage.startsWith('http') ? astrologer.profileImage : '/' + astrologer.profileImage}"
                                                         width="85" height="85" style="border-radius:50%;object-fit:cover;" loading="lazy"
                                                         onerror="this.onerror=null;this.src='/build/assets/images/person.png';">
                                                ` : `
                                                    <img src="{{ asset('public/frontend/astrowaycdn/dashaspeaks/web/content/images/user-img-new.png') }}"
                                                         width="85" height="85" style="border-radius:50%;">
                                                `}
                                            </div>
                                        </a>
                                        ${astrologer.chatStatus === 'Busy' ? `
                                            <div class="status-badge specific-Clr-Busy" title="Busy"></div>
                                        ` : (astrologer.chatStatus === 'Offline' || !astrologer.chatStatus) ? `
                                            <div class="status-badge specific-Clr-Offline" title="Offline"></div>
                                            <div class="status-badge-txt text-center specific-Clr-Offline">
                                                <span class="tooltipex">${astrologer.callStatus || 'Offline'}</span>
                                            </div>
                                        ` : `
                                            <div class="status-badge specific-Clr-Online" title="Online"></div>
                                            <div class="status-badge-txt text-center specific-Clr-Online">
                                                <span class="tooltipex">${astrologer.chatStatus}</span>
                                            </div>
                                        `}
                                    </li>
                                    <li class="w-100">
                                        <div class="astrologer-name">
                                            ${astrologer.name}
                                            <svg fill="#495057" height="16" width="16" viewBox="0 0 106.11 122.88">
                                                <path d="M56.36,2.44A104.34,104.34,0,0,0,79.77,13.9a48.25,48.25,0,0,0,19.08,2.57l6.71-.61.33,6.74c1.23,24.79-2.77,46.33-11.16,63.32C86,103.6,72.58,116.37,55.35,122.85l-4.48,0c-16.84-6.15-30.16-18.57-39-36.47C3.62,69.58-.61,47.88.07,22l.18-6.65,6.61.34A64.65,64.65,0,0,0,28.23,13.5,60.59,60.59,0,0,0,48.92,2.79L52.51,0l3.85,2.44Z"/>
                                            </svg>
                                        </div>
                                        <div class="info-text">
                                            <img src="{{ asset('public/frontend/homeimage/horoscope2.svg') }}" class="info-icon" alt="">
                                            <span class="primary-skill">${astrologer.primarySkill ? astrologer.primarySkill.split(',').slice(0, 3).join(' | ') : ''}</span>
                                        </div>
                                        <div class="info-text">
                                            <img src="{{ asset('public/frontend/homeimage/language-icon.svg') }}" class="info-icon" alt="">
                                            ${astrologer.languageKnown ? astrologer.languageKnown.split(',').slice(0, 3).join(' • ') : ''}
                                        </div>
                                        <div class="info-text">
                                            <img src="{{ asset('public/frontend/homeimage/experience-expert-icon.svg') }}" class="info-icon" alt="">
                                            Experience: ${astrologer.experienceInYears || 0} Years
                                        </div>
                                        <div class="info-text">
                                            <span class="exprt-price">
                                                @if($walletType == 'coin')
                                                    <img src="{{ asset($coinIcon) }}" alt="Coin" width="14">
                                                @else
                                                    {{ $currency['value'] ?? '' }}
                                                @endif
                                                ${astrologer.reportRate || 0}/Report
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                                <div class="card-bottom-row">
                                    <div class="psy-review-section">
                                        <div>
                                            <span class="colorblack font-12 m-0 p-0 d-block">
                                                <span style="color: var(--gold); font-size: 14px; font-weight: bold;">${astrologer.rating || 0}</span>
                                                <span>
                                                    ${Array.from({ length: 5 }, (_, i) => i < Math.round(astrologer.rating || 0) ?
                                                        '<i class="fas fa-star filled-star"></i>' :
                                                        '<i class="far fa-star empty-star"></i>').join('')}
                                                </span>
                                            </span>
                                        </div>
                                        <div><span style="color: gray; font-size: 12px">${astrologer.totalOrder || 0} Sacred Sessions</span></div>
                                    </div>
                                    <div>
                                        <a class="btn-report" role="button" data-toggle="modal"
                                           ${!authcheck ? 'data-target="#loginSignUp"' : 'data-target="#intake"'}>
                                            <i class="fa fa-file-text-o"></i> Get Sacred Report
                                        </a>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    $('#expert-list').append(html);
                    nextPageUrl = response.getAstrologer.next_page_url;
                    if (!response.getAstrologer.next_page_url) {
                        $btn.remove();
                    } else {
                        $btn.prop('disabled', false);
                        $btn.find('.fa-spinner').hide();
                        $btn.find('.btn-text').text('Load More Sacred Guides');
                    }
                } else {
                    $btn.remove();
                }
            },
            error: function(xhr) {
                console.log("Error:", xhr.responseText);
                $btn.prop('disabled', false);
                $btn.find('.fa-spinner').hide();
                $btn.find('.btn-text').text('Load More');
            }
        });
    });
});

@if(!empty($googleApiKey))
function initializeAutocomplete(inputId) {
    if (typeof google === 'undefined' || typeof google.maps === 'undefined' || typeof google.maps.places === 'undefined') {
        console.warn('Google Maps Places library not loaded.');
        return;
    }
    var input = document.getElementById(inputId);
    if (!input) return;
    try {
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.geometry) return;
        });
    } catch (e) {
        console.error('Error initializing autocomplete:', e);
    }
}
if (typeof google !== 'undefined' && google.maps) {
    initializeAutocomplete('BirthPlace');
}
@endif

function toggleSearchBox() {
    var screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    var searchExpertDiv = document.getElementById('searchExpert');
    var sortExpertDiv = document.getElementById('sortExpert');
    var filterExpertCategoryDiv = document.getElementById('filterExpertCategory');
    var clearDiv = document.getElementById('clear');
    var searchIcon = document.getElementById('searchIcon');
    var closeIcon = document.getElementById('closeIcon');

    if (screenWidth <= 576) {
        if (searchExpertDiv && searchExpertDiv.classList.contains('d-none')) {
            if (searchExpertDiv) searchExpertDiv.classList.remove('d-none');
            if (sortExpertDiv) sortExpertDiv.classList.remove('d-none');
            if (filterExpertCategoryDiv) filterExpertCategoryDiv.classList.remove('d-none');
            if (clearDiv) clearDiv.classList.remove('d-none');
            if (searchIcon) searchIcon.classList.add('d-none');
            if (closeIcon) closeIcon.classList.remove('d-none');
        } else {
            if (searchExpertDiv) searchExpertDiv.classList.add('d-none');
            if (sortExpertDiv) sortExpertDiv.classList.add('d-none');
            if (filterExpertCategoryDiv) filterExpertCategoryDiv.classList.add('d-none');
            if (clearDiv) clearDiv.classList.add('d-none');
            if (searchIcon) searchIcon.classList.remove('d-none');
            if (closeIcon) closeIcon.classList.add('d-none');
        }
    }
}

$(document).ready(function() {
    $('.select2').select2({ width: '100%' });
});

$(document).on('click', '.btn-report', function() {
    var astrologerCard = $(this).closest('.psychic-card');
    var astrologerId = astrologerCard.data('astrologer-id');
    var astroChargeText = astrologerCard.find('.exprt-price').text().trim();
    var astroCharge = parseFloat(astroChargeText.match(/[\d.]+/));
    $('#astroId').val(astrologerId);
    $('#astroCharge').val(astroCharge);
    $('#reportRate').val(astroCharge);
});

function onFilterExpertCategoryList() {
    var astrologerCategoryId = $('#psychicCategories').val();
    var url = new URL(window.location.href);
    url.searchParams.set('astrologerCategoryId', astrologerCategoryId);
    window.location.href = url.toString();
}

function onSortExpertList() {
    var sortBy = $('#psychicOrderBy').val();
    var url = new URL(window.location.href);
    url.searchParams.set('sortBy', sortBy);
    window.location.href = url.toString();
}

$(document).ready(function() {
    $('#intakeBtn').click(function(e) {
        var birthTimeInputBoy = document.getElementById("BirthTime");
        var dontKnowTimeRadioBoy = document.getElementById("dontKnowTimeBoy");
        const birthTimeErrorBoy = document.getElementById('birthTimeErrorBoy');

        if (!birthTimeInputBoy.value && !dontKnowTimeRadioBoy.checked) {
            birthTimeErrorBoy.style.display = 'block';
            birthTimeInputBoy.style.borderColor = 'red';
            e.preventDefault();
            return;
        } else {
            birthTimeErrorBoy.style.display = 'none';
            birthTimeInputBoy.style.borderColor = '';
        }

        e.preventDefault();

        var form = document.getElementById('intakeForm');
        if (form.checkValidity() === false) {
            form.reportValidity();
            return;
        }

        $('#intakeBtn').hide();
        $('#loaderintakeBtn').show();

        var astrocharge = $("#astroCharge").val();
        var formData = $('#intakeForm').serialize();
        var total_charge = parseInt(astrocharge ? astrocharge.trim() : 0);
        var wallet_amount = parseInt("{{ $walletAmount ?? 0 }}");

        if (total_charge <= wallet_amount) {
            $.ajax({
                url: "{{ route('api.addReport', ['token' => $token ?? '']) }}",
                type: 'POST',
                data: formData,
                success: function(response) {
                    toastr.success('Report Request Sent Successfully.');
                    $('#intake').modal('hide');
                    $('#intakeBtn').show();
                    $('#loaderintakeBtn').hide();
                },
                error: function(xhr, status, error) {
                    try {
                        var response = JSON.parse(xhr.responseText);
                        toastr.error(response.message || 'Something went wrong');
                    } catch (e) {
                        toastr.error('An unexpected error occurred');
                    }
                    $('#intakeBtn').show();
                    $('#loaderintakeBtn').hide();
                }
            });
        } else {
            toastr.error('Insufficient balance. Please recharge your sacred wallet.');
            window.location.href = "{{ route('front.walletRecharge') }}";
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var clearButton = document.getElementById('clearButton');
    if (clearButton) {
        clearButton.addEventListener('click', function() {
            window.location.href = "{{ route('front.reportList') }}";
        });
    }
});
</script>
@endsection