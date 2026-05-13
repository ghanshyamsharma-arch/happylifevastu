@extends('frontend.layout.master')

@section('content')
<style>
/* ═══════════════════════════════════════════════════════
   PREMIUM PUJA CATEGORY LIST — Sacred Luxury Theme
   Fonts: Cinzel (display) + Lato (body)
   ═══════════════════════════════════════════════════════ */

@import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Lato:wght@300;400;700&display=swap');

:root {
  --gold:          #c9a84c;
  --gold-light:    #e0c068;
  --gold-pale:     #fdf6e3;
  --gold-glow:     rgba(201,168,76,0.18);
  --dark:          #1a0e05;
  --dark-mid:      #2d1a08;
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
  --radius-btn:    50px;
  --transition:    0.32s cubic-bezier(0.22, 0.9, 0.36, 1);
}

/* ─── Global reset inside section ─── */
.puja-category-section *,
.puja-category-section *::before,
.puja-category-section *::after {
  box-sizing: border-box;
}

/* ─── Page Section ─── */
.puja-category-section {
  background: var(--white);
  position: relative;
  padding: 3rem 0 4rem;
  min-height: 60vh;
}

/* Top shimmer line */
.puja-category-section::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, transparent 0%, var(--gold-light) 40%, var(--gold) 50%, var(--gold-light) 60%, transparent 100%);
}

/* Subtle noise / warmth on background */
.puja-category-section::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 0;
}

/* ─── Section Header ─── */
.puja-section-header {
  text-align: center;
  margin-bottom: 2.5rem;
  position: relative;
  z-index: 1;
}

.puja-section-header .eyebrow {
  font-family: 'Cinzel', serif;
  font-size: 10px;
  letter-spacing: 4px;
  color: var(--gold);
  text-transform: uppercase;
  margin-bottom: 0.6rem;
  display: block;
}

.puja-section-header .section-title {
  font-family: 'Cinzel', serif;
  font-size: clamp(18px, 3vw, 24px);
  font-weight: 600;
  color: var(--dark);
  margin: 0 0 0.5rem;
  letter-spacing: 0.5px;
  text-align: left !important;
}

.puja-section-header .gold-divider {
  display: flex;
  align-items: center;
  gap: 10px;
  margin: 0.7rem auto 0.9rem;
}

.puja-section-header .gold-divider::before,
.puja-section-header .gold-divider::after {
  content: '';
  display: block;
  width: 40px;
  height: 1px;
  background: linear-gradient(to right, transparent, var(--gold));
}

.puja-section-header .gold-divider::after {
  background: linear-gradient(to left, transparent, var(--gold));
}

.gold-diamond {
  width: 7px;
  height: 7px;
  background: var(--gold);
  transform: rotate(45deg);
  display: inline-block;
  flex-shrink: 0;
}

.puja-section-header .section-subtitle {
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  color: var(--text-muted);
  letter-spacing: 0.5px;
  margin: 0;
  text-align: left !important;
}

/* ─── Cards Grid ─── */
.puja-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 24px;
  position: relative;
  z-index: 1;
  padding: 0 8px;
}

@media (max-width: 1100px) {
  .puja-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 768px) {
  .puja-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
}
@media (max-width: 480px) {
  .puja-grid {
    grid-template-columns: 1fr;
    max-width: 320px;
    margin: 0 auto;
    padding: 0;
  }
}

/* ─── Individual Card ─── */
.scard {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-card);
  overflow: hidden;
  display: flex;
  flex-direction: column;
  transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition);
  position: relative;
  cursor: pointer;
  box-shadow: var(--shadow-card);
  /* Staggered entrance animation */
  animation: fadeSlideUp 0.45s ease backwards;
}

/* Top accent line */
.scard::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
  opacity: 0;
  transition: opacity 0.3s ease;
  z-index: 2;
}

/* Subtle corner ornament */
.scard::after {
  content: '';
  position: absolute;
  bottom: 0; right: 0;
  width: 40px;
  height: 40px;
  border-bottom-right-radius: var(--radius-card);
  background: radial-gradient(circle at bottom right, var(--gold-pale) 0%, transparent 70%);
  opacity: 0;
  transition: opacity 0.3s ease;
  pointer-events: none;
}

.scard:hover {
  transform: translateY(-8px);
  border-color: var(--gold);
  box-shadow: var(--shadow-hover);
}
.scard:hover::before { opacity: 1; }
.scard:hover::after  { opacity: 1; }

/* Animation delays for stagger */
.scard:nth-child(1)  { animation-delay: 0.04s; }
.scard:nth-child(2)  { animation-delay: 0.09s; }
.scard:nth-child(3)  { animation-delay: 0.14s; }
.scard:nth-child(4)  { animation-delay: 0.19s; }
.scard:nth-child(5)  { animation-delay: 0.24s; }
.scard:nth-child(6)  { animation-delay: 0.29s; }
.scard:nth-child(7)  { animation-delay: 0.34s; }
.scard:nth-child(8)  { animation-delay: 0.39s; }

/* ─── Card Image Wrapper ─── */
.scard-img-wrap {
  position: relative;
  width: 100%;
  height: 200px;
  overflow: hidden;
  background: var(--cream);
}

.scard-img-wrap::after {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(26,14,5,0.15) 0%, transparent 50%);
  opacity: 0;
  transition: opacity var(--transition);
  pointer-events: none;
}

.scard:hover .scard-img-wrap::after { opacity: 1; }

.scard .rounded-m {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.6s cubic-bezier(0.22, 0.9, 0.36, 1);
}

.scard:hover .rounded-m { transform: scale(1.06); }

@media (max-width: 768px) {
  .scard-img-wrap { height: 175px; }
}
@media (max-width: 480px) {
  .scard-img-wrap { height: 195px; }
}

/* ─── Card Body ─── */
.descrb {
  padding: 18px 18px 10px;
  text-align: center;
  flex: 1;
}

.descrb h3 {
  font-family: 'Cinzel', serif;
  font-size: clamp(13px, 1.4vw, 16px);
  font-weight: 600;
  color: var(--dark);
  margin: 0;
  line-height: 1.4;
  transition: color 0.22s ease;
}

.scard:hover .descrb h3 { color: var(--gold); }

/* ─── Divider ─── */
.scard hr {
  border: none;
  border-top: 1px solid var(--border);
  margin: 0 16px;
  transition: border-color 0.22s ease;
}
.scard:hover hr { border-color: rgba(201,168,76,0.3); }

/* ─── Card Footer ─── */
.puja-footer {
  padding: 14px 16px 18px;
}

.read {
  background: var(--gold);
  border: none;
  color: var(--dark);
  font-family: 'Cinzel', serif;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 1px;
  padding: 10px 18px;
  border-radius: var(--radius-btn);
  transition: background 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  text-decoration: none;
  width: 100%;
  text-transform: uppercase;
}

.read:hover {
  background: var(--gold-light);
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(201,168,76,0.35);
  text-decoration: none;
  color: var(--dark);
}

.read i {
  font-size: 12px;
  transition: transform 0.22s ease;
}
.read:hover i { transform: translateX(4px); }

/* ─── Empty State ─── */
.empty-state {
  text-align: center;
  padding: 4rem 2rem;
  background: var(--cream);
  border-radius: 24px;
  margin: 2rem auto;
  max-width: 480px;
  border: 1px solid var(--border);
}

.empty-state img {
  max-width: 160px;
  opacity: 0.55;
  margin-bottom: 1.2rem;
}

.empty-state h3 {
  font-family: 'Cinzel', serif;
  font-size: 17px;
  color: var(--text-mid);
  margin-bottom: 0.5rem;
}

.empty-state p {
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  color: var(--text-muted);
  margin: 0;
}

/* ─── Pagination ─── */
.pagination-wrapper {
  margin-top: 2.5rem;
  text-align: center;
  padding-bottom: 1rem;
  position: relative;
  z-index: 1;
}

.pagination-wrapper .pagination {
  display: flex;
  justify-content: center;
  gap: 6px;
  flex-wrap: wrap;
  padding: 0;
  margin: 0;
}

.pagination-wrapper .page-item {
  list-style: none;
}

.pagination-wrapper .page-link {
  font-family: 'Cinzel', serif;
  font-size: 12px;
  padding: 9px 15px;
  color: var(--text-mid);
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-btn);
  transition: all 0.25s ease;
  text-decoration: none;
  display: inline-block;
  line-height: 1;
}

.pagination-wrapper .page-link:hover {
  background: var(--gold-pale);
  border-color: var(--gold);
  color: var(--gold);
  box-shadow: 0 2px 8px var(--gold-glow);
}

.pagination-wrapper .active .page-link {
  background: var(--gold);
  border-color: var(--gold);
  color: var(--dark);
  font-weight: 700;
  box-shadow: 0 4px 12px var(--gold-glow);
}

.pagination-wrapper .disabled .page-link {
  opacity: 0.4;
  cursor: not-allowed;
  pointer-events: none;
}

/* ─── Keyframes ─── */
@keyframes fadeSlideUp {
  from { opacity: 0; transform: translateY(24px); }
  to   { opacity: 1; transform: translateY(0); }
}

/* ─── Responsive tweaks ─── */
@media (max-width: 576px) {
  .puja-category-section { padding: 2rem 0 3rem; }

  .read { font-size: 10px; padding: 9px 14px; }

  .descrb { padding: 14px 14px 8px; }

  .puja-footer { padding: 12px 14px 16px; }

  .pagination-wrapper .page-link { font-size: 11px; padding: 8px 12px; }
}
</style>

<div class="puja-category-section">

    @if($pujaCategories->isEmpty())
        <div class="container mt-5 mb-5">
            <div class="empty-state">
                <img src="{{ asset('public/frontend/homeimage/360.png') }}" alt="No Puja Found" class="img-fluid" />
                <h3>No Puja Category Found </h3>
                <p>Please check back later for upcoming spiritual ceremonies.</p>
            </div>
        </div>
    @else
        <div class="container">

            <!-- Section Header -->
            <div class="puja-section-header">
                <h2 class="section-title">Puja Categories</h2>
                <div class="gold-divider">
                    <span class="gold-diamond"></span>
                </div>
                <p class="section-subtitle">Choose from a variety of spiritual rituals and ceremonies</p>
            </div>

            <!-- Puja Categories Grid -->
            <div class="puja-grid mt-4 mb-4">
                @foreach ($pujaCategories as $category)
                <div class="scard">
                    <?php
                        $image = $category->image;
                        $firstImage = !empty($image) ? $image : 'path/to/default/image.jpg';
                    ?>

                    <!-- Image -->
                    <div class="scard-img-wrap">
                        <img class="rounded-m"
                             src="{{ Str::startsWith($firstImage, ['http://','https://']) ? $firstImage : '/' . $firstImage }}"
                             onerror="this.onerror=null;this.src='/build/assets/images/person.png';"
                             alt="{{ $category->name }}"
                             onclick="openImage('{{ $firstImage }}')" />
                    </div>

                    <!-- Name -->
                    <div class="descrb">
                        <h3 class="font-weight-bold">{{ $category->name }}</h3>
                    </div>

                    <hr>

                    <!-- CTA -->
                    <div class="puja-footer">
                        <a href="{{ route('front.pujaList', $category->id) }}" class="read">
                            Explore Pujas <i class="fa-solid fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    @endif

    <!-- Pagination -->
    <div class="pagination-wrapper">
        {{ $pujaCategories->links() }}
    </div>

</div>
@endsection