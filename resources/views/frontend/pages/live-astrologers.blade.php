@extends('frontend.layout.master')
@section('content')
<style>
/* ═══════════════════════════════════════════════════════
   PREMIUM LIVE ASTROLOGERS PAGE — Sacred Luxury Theme
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
  --danger:        #dc3545;
  --danger-glow:   rgba(220,53,69,0.2);
}

.live-astro-section {
  background: linear-gradient(135deg, var(--white) 0%, var(--cream) 100%);
  position: relative;
  min-height: 100vh;
}

/* Top shimmer line */
.live-astro-section::before {
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
.live-astro-section::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 0;
}

.live-astro-section .container {
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

/* ─── Hero Banner Section ─── */
.sacred-hero-banner {
  background: linear-gradient(135deg, #fdf6e3 0%, var(--gold-pale) 100%);
  border-radius: var(--radius-card);
  margin: 20px 0;
  overflow: hidden;
  position: relative;
  border: 1px solid var(--border);
}

.sacred-hero-banner::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

.hero-title {
  font-family: 'Cinzel', serif;
  font-size: clamp(20px, 4vw, 28px);
  font-weight: 700;
  color: var(--dark);
  letter-spacing: 1px;
  margin: 0;
}

.hero-subtitle {
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  color: var(--text-mid);
  margin-top: 8px;
}

/* ─── Section Title ─── */
.section-title {
  font-family: 'Cinzel', serif;
  font-size: clamp(22px, 4vw, 32px);
  font-weight: 700;
  color: var(--dark);
  margin-bottom: 15px;
  position: relative;
  display: inline-block;
}

.section-title::after {
  content: '';
  position: absolute;
  bottom: -8px;
  left: 0;
  width: 60%;
  height: 2px;
  background: linear-gradient(90deg, var(--gold), transparent);
}

/* ─── Live Astrologer Card ─── */
.live-astro-card {
  width: 220px;
  background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(250,244,234,0.95) 100%);
  border-radius: 16px;
  overflow: hidden;
  position: relative;
  transition: all var(--transition);
  box-shadow: var(--shadow-card);
  border: 1px solid var(--border);
  backdrop-filter: blur(5px);
}

.live-astro-card:hover {
  transform: translateY(-8px);
  box-shadow: var(--shadow-hover);
  border-color: var(--gold);
}

/* Live Badge */
.live-badge {
  position: absolute;
  top: 12px;
  left: 12px;
  background: var(--danger);
  color: var(--white);
  font-family: 'Lato', sans-serif;
  font-size: 11px;
  font-weight: 700;
  padding: 4px 10px;
  border-radius: 30px;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  z-index: 2;
  box-shadow: 0 2px 8px rgba(220,53,69,0.3);
  animation: pulse 1.5s infinite;
}

.live-badge i {
  font-size: 8px;
}

@keyframes pulse {
  0% {
    box-shadow: 0 0 0 0 rgba(220,53,69,0.4);
  }
  70% {
    box-shadow: 0 0 0 6px rgba(220,53,69,0);
  }
  100% {
    box-shadow: 0 0 0 0 rgba(220,53,69,0);
  }
}

/* Card Content */
.astro-card-content {
  padding: 20px 15px 15px;
  text-align: center;
}

.astro-profile-wrapper {
  position: relative;
  display: inline-block;
  margin-bottom: 12px;
}

.astro-profile-img {
  width: 90px;
  height: 90px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid var(--gold);
  transition: all 0.3s ease;
}

.live-astro-card:hover .astro-profile-img {
  transform: scale(1.05);
  border-color: var(--gold-light);
}

/* Gold ring around live profile */
.astro-profile-wrapper::after {
  content: '';
  position: absolute;
  top: -3px;
  left: -3px;
  right: -3px;
  bottom: -3px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--gold), var(--gold-light), var(--gold));
  opacity: 0.6;
  z-index: -1;
  transition: opacity 0.3s ease;
}

.live-astro-card:hover .astro-profile-wrapper::after {
  opacity: 1;
}

.astro-name {
  font-family: 'Cinzel', serif;
  font-size: 16px;
  font-weight: 700;
  color: var(--dark);
  margin: 10px 0 0;
  transition: color 0.2s ease;
}

.live-astro-card:hover .astro-name {
  color: var(--gold);
}

.astro-name a {
  color: inherit;
  text-decoration: none;
}

/* Join Now Button */
.join-now-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border: none;
  border-radius: 40px;
  padding: 8px 20px;
  font-family: 'Cinzel', serif;
  font-size: 12px;
  font-weight: 600;
  color: var(--white);
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: all 0.25s ease;
  width: 100%;
  margin-top: 12px;
}

.join-now-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(201,168,76,0.4);
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
  margin: 30px 0;
}

.empty-state-icon {
  font-size: 64px;
  color: var(--border);
  margin-bottom: 20px;
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
}

/* Grid Layout */
.live-astro-grid {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: flex-start;
  padding-bottom: 40px;
}

/* Responsive */
@media (max-width: 991px) {
  .live-astro-card {
    width: calc(33.33% - 14px);
  }
}

@media (max-width: 768px) {
  .live-astro-card {
    width: calc(50% - 10px);
  }
  
  .hero-title {
    font-size: 18px;
  }
  
  .hero-subtitle {
    font-size: 12px;
  }
  
  .astro-profile-img {
    width: 70px;
    height: 70px;
  }
  
  .astro-name {
    font-size: 14px;
  }
  
  .join-now-btn {
    padding: 6px 15px;
    font-size: 11px;
  }
}

@media (max-width: 576px) {
  .live-astro-card {
    width: 100%;
    max-width: 280px;
    margin: 0 auto;
  }
  
  .live-astro-grid {
    justify-content: center;
  }
  
  .sacred-hero-banner {
    padding: 20px !important;
  }
  
  .hero-title {
    font-size: 16px;
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

.live-astro-card {
  animation: fadeSlideUp 0.4s ease backwards;
}

.live-astro-card:nth-child(1) { animation-delay: 0.05s; }
.live-astro-card:nth-child(2) { animation-delay: 0.1s; }
.live-astro-card:nth-child(3) { animation-delay: 0.15s; }
.live-astro-card:nth-child(4) { animation-delay: 0.2s; }
.live-astro-card:nth-child(5) { animation-delay: 0.25s; }
.live-astro-card:nth-child(6) { animation-delay: 0.3s; }
</style>

<div class="live-astro-section">
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
                        <span style="color: var(--gold);">Live {{ucfirst($professionTitle)}}s</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Sacred Hero Banner -->
    <div class="container">
        <div class="sacred-hero-banner p-4">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <div class="text-center text-md-left mb-3 mb-md-0">
                    <h1 class="hero-title">
                        <i class="fa fa-video-camera mr-2" style="color: var(--gold);"></i>
                        INTERACTIVE LIVE SESSIONS
                    </h1>
                    <p class="hero-subtitle">
                        Connect with premium {{ucfirst($professionTitle)}}s through sacred live sessions
                    </p>
                </div>
                <div class="live-event-icon">
                    <img src="{{ asset('public/frontend/astrowaycdn/dashaspeaks/web/content/astroway/images/livestream/live-event.png') }}"
                        class="img-fluid" width="74" height="70" alt="live-event" style="opacity: 0.9;">
                </div>
            </div>
        </div>
    </div>

    <!-- Live Sessions Section -->
    <div class="container">
        <div class="row py-3 py-md-4">
            <div class="col-sm-12">
                <h2 class="section-title">
                    <i class="fa fa-circle mr-2" style="color: var(--danger); font-size: 14px;"></i>
                    LIVE SESSIONS
                </h2>
                <div class="gold-divider-small" style="width: 80px; height: 2px; background: linear-gradient(90deg, var(--gold), transparent); margin-top: 5px;"></div>
            </div>
        </div>

        @if($liveastro['recordList'])
            <div class="live-astro-grid">
                @foreach ($liveastro['recordList'] as $live)
                    <div class="live-astro-card">
                        <div class="live-badge">
                            <i class="fa fa-circle"></i> LIVE NOW
                        </div>
                        <div class="astro-card-content">
                            <div class="astro-profile-wrapper">
                                @if($live['profileImage'])
                                    <img class="astro-profile-img" 
                                         src="{{ Str::startsWith($live['profileImage'], ['http://','https://']) ? $live['profileImage'] : '/' . $live['profileImage'] }}" 
                                         onerror="this.onerror=null;this.src='/build/assets/images/person.png';" 
                                         alt="{{ $live['name'] }}" />
                                @else
                                    <img class="astro-profile-img" 
                                         src="{{ asset('public/frontend/astrowaycdn/dashaspeaks/web/content/images/user-img-new.png') }}"
                                         alt="{{ $live['name'] }}" />
                                @endif
                            </div>
                            <h3 class="astro-name">
                                <a href="{{ route('front.LiveAstroDetails', ['astrologerId' => $live['astrologerId']]) }}" class="text-decoration-none">
                                    {{ $live['name'] }}
                                </a>
                            </h3>
                            <a href="{{ route('front.LiveAstroDetails', ['astrologerId' => $live['astrologerId']]) }}"
                               class="join-now-btn">
                                <i class="fa fa-arrow-right"></i> Join Sacred Session
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fa fa-eye-slash"></i>
                </div>
                <h3 class="empty-state-title">No Live {{ ucfirst($professionTitle) }} Found</h3>
                <p class="empty-state-text">Please check back later for sacred live sessions.</p>
            </div>
        @endif
    </div>
</div>
@endsection