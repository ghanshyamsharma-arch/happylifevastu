<style>
/* Enhanced Footer Styles - Premium Astrology Theme */
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

/* Footer Main Container */
.footer-premium {
  background: linear-gradient(180deg, var(--dark) 0%, #0d0804 100%) !important;
  position: relative;
  overflow: hidden;
  color: #7a6445;
}

.footer-premium::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

.footer-premium::after {
  content: '✦';
  position: absolute;
  bottom: 30px;
  right: 30px;
  font-size: 70px;
  opacity: 0.03;
  color: var(--gold);
  font-family: 'Cinzel', serif;
  pointer-events: none;
}

/* Section Headers in Footer */
.footer-premium h5 {
  font-family: 'Cinzel', serif;
  font-size: 14px;
  font-weight: 600;
  color: #f5e6c8 !important;
  letter-spacing: 1px;
  padding-bottom: 0.5rem;
  margin-bottom: 1rem;
  border-bottom: 1px solid rgba(201, 168, 76, 0.3) !important;
  position: relative;
  display: inline-block;
}

.footer-premium h5::before {
  content: '✦';
  color: var(--gold);
  margin-right: 6px;
  font-size: 10px;
}

/* Footer Links */
.footer-premium .footer-link {
  font-size: 12px;
  color: #7a6445;
  text-decoration: none;
  transition: all 0.3s ease;
  display: inline-block;
}

.footer-premium .footer-link:hover {
  color: var(--gold);
  transform: translateX(3px);
  text-decoration: none;
}

/* List Items */
.footer-premium ul li {
  padding: 0.25rem 0;
}

.footer-premium ul li a {
  font-size: 12px;
  color: #7a6445;
  transition: all 0.3s ease;
}

.footer-premium ul li a:hover {
  color: var(--gold);
  text-decoration: none;
  transform: translateX(3px);
  display: inline-block;
}

/* Bottom Bar */
.footer-bottom-bar {
  background: rgba(0, 0, 0, 0.4);
  padding: 1rem 0;
  border-top: 1px solid rgba(201, 168, 76, 0.15);
}

.footer-bottom-bar small {
  color: #5a4025;
  font-size: 11px;
}

.footer-bottom-bar a {
  color: #5a4025;
  font-size: 11px;
  transition: color 0.3s ease;
}

.footer-bottom-bar a:hover {
  color: var(--gold);
  text-decoration: none;
}

/* Social Icons */
.social-icon {
  margin: 4px;
  transition: all 0.3s ease;
  display: inline-block;
}

.social-icon:hover {
  transform: scale(1.15);
  opacity: 0.85;
}

.social-icon img {
  filter: brightness(0.7) sepia(1) hue-rotate(50deg) saturate(0.5);
  transition: filter 0.3s ease;
}

.social-icon:hover img {
  filter: brightness(1) sepia(1) hue-rotate(50deg) saturate(1);
}

/* Text Colors */
.text-gray {
  color: #D1D5DB !important;
}
.text-gray-dark {
  color: #7a6445 !important;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
  .footer-premium h5 {
    font-size: 13px;
    margin-bottom: 0.75rem;
  }
  
  .footer-premium .footer-link,
  .footer-premium ul li a {
    font-size: 11px;
  }
  
  .footer-bottom-bar small,
  .footer-bottom-bar a {
    font-size: 10px;
  }
  
  .text-center.text-md-start {
    text-align: center !important;
  }
  
  .col-6 {
    margin-bottom: 1.5rem;
  }
}

@media (max-width: 480px) {
  .footer-premium h5 {
    font-size: 12px;
  }
  
  .footer-premium .footer-link,
  .footer-premium ul li a {
    font-size: 10px;
  }
}

/* Smooth transitions */
.footer-premium * {
  transition: all 0.2s ease;
}

/* Border secondary override */
.border-secondary {
  border-color: rgba(201, 168, 76, 0.3) !important;
}
</style>

@php
use App\Models\AstrologerModel\AstrologerCategory;
$getAstrologerCategory = AstrologerCategory::where('isActive',1)->orderBy('id', 'DESC')->get();
$facebook = DB::table('systemflag')->where('name', 'Facebook')->select('value')->first();
$apple = DB::table('systemflag')->where('name', 'Apple')->select('value')->first();
$website = DB::table('systemflag')->where('name', 'Website')->select('value')->first();
$youtube = DB::table('systemflag')->where('name', 'Youtube')->select('value')->first();
$linkedIn = DB::table('systemflag')->where('name', 'LinkedIn')->select('value')->first();
$pintrest = DB::table('systemflag')->where('name', 'Pintrest')->select('value')->first();
$instagram = DB::table('systemflag')->where('name', 'Instagram')->select('value')->first();
$whatsapp = DB::table('systemflag')->where('name', 'Whatsapp')->select('value')->first();
$telegram = DB::table('systemflag')->where('name', 'Telegram')->select('value')->first();
$twitter = DB::table('systemflag')->where('name', 'Twitter')->select('value')->first();
$playstore = DB::table('systemflag')->where('name', 'PartnerPlayStore')->select('value')->first();
$appstore = DB::table('systemflag')->where('name', 'PartnerAppStore')->select('value')->first();
@endphp

<div id="footer" class="footer-premium" style="background: linear-gradient(180deg, #1a0e05 0%, #0d0804 100%); color: #7a6445;">
    <section class="pt-5 pb-4">
        <div class="container">
            <div class="row text-center text-md-start gy-4">
                <!-- MENU -->
                <div class="col-6 col-md-3">
                    <h5 class="text-white border-bottom border-secondary pb-2 mb-3 font-16">MENU</h5>
                    <!-- Menu items can be added here -->
                </div>

                <!-- LINKS -->
                <div class="col-6 col-md-3">
                    <h5 class="text-white border-bottom border-secondary pb-2 mb-3 font-16">LINKS</h5>
                    <ul class="list-unstyled" style="font-size: 14px;">
                        <li class="p-1"><a class="footer-link" href="{{route('front.astrologers.getBlog')}}">Go to Blog</a></li>
                        <li class="p-1"><a class="footer-link" href="{{route('front.astrologers.privacyPolicy')}}">Privacy Policy</a></li>
                        <li class="p-1"><a class="footer-link" href="{{route('front.astrologers.contact')}}">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- COPYRIGHT -->
    <div class="footer-bottom-bar text-center py-3">
        <small>
            Copyright © 2020-{{date('Y')}} {{ucfirst($appname)}}. All Rights Reserved |
            <a class="footer-link text-decoration-none" href="{{route('front.astrologers.privacyPolicy')}}">Privacy Policy</a> |
            <a class="footer-link text-decoration-none" href="{{route('front.astrologers.refundPolicy')}}">Refund Policy</a> |
            <a class="footer-link text-decoration-none" href="{{route('front.astrologers.termscondition')}}">Terms of Service</a> |
            <a class="footer-link text-decoration-none" href="{{route('front.astrologers.contact')}}">Contact Us</a>
        </small>
    </div>
</div>

<!-- Footer Styles -->
<style>
    .footer-link {
        color: #bfbfbf;
        transition: color 0.3s ease, transform 0.3s ease;
    }
    .footer-link:hover {
        color: #f7b731;
        transform: translateX(3px);
        text-decoration: underline;
    }
    .social-icon {
        margin: 4px;
        transition: transform 0.3s ease, opacity 0.3s ease;
    }
    .social-icon:hover {
        transform: scale(1.15);
        opacity: 0.8;
    }
    @media (max-width: 768px) {
        #footer h5 {
            font-size: 15px;
        }
        .footer-link {
            font-size: 13px;
        }
        .social-icon img {
            width: 26px;
            height: 26px;
        }
    }
</style>