@extends('frontend.layout.master')
@section('content')
<style>
/* ═══════════════════════════════════════════════════════
   PREMIUM CONTACT PAGE — Sacred Luxury Theme
   Matches Blog Detail & Shopping Cart aesthetic
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
}

.contact-section *,
.contact-section *::before,
.contact-section *::after {
  box-sizing: border-box;
}

/* ─── Page wrapper ─── */
.contact-section {
  background: linear-gradient(135deg, var(--white) 0%, var(--cream) 100%);
  position: relative;
  padding: 2rem 0 5rem;
  min-height: 100vh;
}

/* Top shimmer line */
.contact-section::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, transparent 0%, var(--gold-light) 40%, var(--gold) 50%, var(--gold-light) 60%, transparent 100%);
  z-index: 2;
}

/* Warm noise texture */
.contact-section::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 0;
}

.contact-section .container {
  position: relative;
  z-index: 1;
}

/* ─── Breadcrumb Styling (if needed) ─── */
.sacred-breadcrumb {
  background: linear-gradient(135deg, var(--cream) 0%, var(--white) 100%);
  border-bottom: 1px solid var(--border);
  margin-bottom: 0;
  position: relative;
  overflow: hidden;
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

/* ─── Page Title ─── */
.contact-title {
  font-family: 'Cinzel', serif;
  font-size: clamp(28px, 5vw, 30px);
  font-weight: 600;
  color: var(--dark);
  margin: 1rem 0 0.5rem 0;
  position: relative;
  display: inline-block;
}

/* Gold divider under title */
.title-divider {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  margin-bottom: 1.5rem;
}

.title-divider::before,
.title-divider::after {
  content: '';
  display: block;
  width: 60px;
  height: 1px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

.title-divider::before {
  background: linear-gradient(90deg, transparent, var(--gold));
}

.title-divider::after {
  background: linear-gradient(90deg, var(--gold), transparent);
}

.gold-diamond {
  width: 8px;
  height: 8px;
  background: var(--gold);
  transform: rotate(45deg);
  display: inline-block;
  flex-shrink: 0;
}

/* ─── Contact Cards ─── */
.contact-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-card);
  box-shadow: var(--shadow-card);
  overflow: hidden;
  transition: box-shadow var(--transition);
  position: relative;
  padding: 30px;
}

.contact-card:hover {
  box-shadow: var(--shadow-hover);
}

.contact-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
  z-index: 2;
}

/* Company Info Section */
.company-name {
  font-family: 'Cinzel', serif;
  font-size: 26px;
  font-weight: 700;
  color: var(--dark);
  margin-bottom: 8px;
}

.company-subtext {
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  color: var(--gold);
  letter-spacing: 2px;
  margin-bottom: 20px;
  display: inline-block;
  border-bottom: 1px solid var(--gold);
  padding-bottom: 5px;
}

.company-address {
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  color: var(--text-mid);
  line-height: 1.8;
  margin-bottom: 24px;
}

.contact-info-item {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 16px;
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  color: var(--text-mid);
}

.contact-info-item i {
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--gold-pale);
  border-radius: 50%;
  color: var(--gold);
  font-size: 14px;
  flex-shrink: 0;
}

.contact-info-item a {
  color: var(--text-mid);
  text-decoration: none;
  transition: color 0.2s ease;
}

.contact-info-item a:hover {
  color: var(--gold);
}

/* Form Section */
.form-title {
  font-family: 'Cinzel', serif;
  font-size: 22px;
  font-weight: 600;
  color: var(--dark);
  margin-bottom: 12px;
}

.form-description {
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  color: var(--text-mid);
  margin-bottom: 24px;
  line-height: 1.6;
}

/* Alert Styling */
.sacred-alert {
  border-radius: 12px;
  border: none;
  padding: 12px 20px;
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  margin-bottom: 20px;
}

.sacred-alert-success {
  background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
  color: #155724;
  border-left: 4px solid #28a745;
}

.sacred-alert-danger {
  background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
  color: #721c24;
  border-left: 4px solid #dc3545;
}

/* Form Fields */
.contact-form-group {
  margin-bottom: 20px;
}

.contact-form-control {
  width: 100%;
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 12px 18px;
  transition: all 0.2s ease;
  background: var(--white);
}

.contact-form-control:focus {
  border-color: var(--gold);
  box-shadow: 0 0 0 3px var(--gold-glow);
  outline: none;
}

textarea.contact-form-control {
  resize: vertical;
  min-height: 150px;
}

.error-message {
  font-size: 11px;
  font-family: 'Lato', sans-serif;
  display: block;
  margin-top: 5px;
}

/* Submit Button */
.submit-btn {
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border: none;
  border-radius: 40px;
  padding: 14px 28px;
  font-family: 'Cinzel', serif;
  font-size: 14px;
  font-weight: 600;
  color: var(--white);
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: all 0.25s ease;
  width: 100%;
  cursor: pointer;
}

.submit-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(201,168,76,0.3);
}

.submit-btn:disabled {
  opacity: 0.7;
  cursor: not-allowed;
  transform: none;
}

/* Row spacing */
.contact-row {
  margin-top: 40px;
}

/* Responsive */
@media (max-width: 991px) {
  .contact-section {
    padding: 1.5rem 0 3rem;
  }
  
  .contact-card {
    padding: 25px;
  }
  
  .company-name {
    font-size: 22px;
  }
  
  .form-title {
    font-size: 20px;
  }
}

@media (max-width: 768px) {
  .contact-row {
    margin-top: 20px;
  }
  
  .contact-card {
    padding: 20px;
  }
  
  .contact-info-item {
    font-size: 13px;
  }
  
  .contact-info-item i {
    width: 28px;
    height: 28px;
    font-size: 12px;
  }
  
  .company-name {
    font-size: 20px;
  }
  
  .form-title {
    font-size: 18px;
  }
  
  .title-divider::before,
  .title-divider::after {
    width: 40px;
  }
}

@media (max-width: 576px) {
  .contact-card {
    padding: 16px;
  }
  
  .company-name {
    font-size: 18px;
  }
  
  .company-subtext {
    font-size: 11px;
  }
  
  .company-address {
    font-size: 13px;
  }
  
  .form-title {
    font-size: 16px;
  }
  
  .form-description {
    font-size: 13px;
  }
  
  .contact-form-control {
    padding: 10px 14px;
    font-size: 13px;
  }
  
  .submit-btn {
    padding: 12px 24px;
    font-size: 13px;
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

.contact-left {
  animation: fadeSlideUp 0.45s ease 0.05s backwards;
}

.contact-right {
  animation: fadeSlideUp 0.45s ease 0.15s backwards;
}

/* Decorative elements */
.sacred-icon {
  width: 40px;
  height: 40px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, var(--gold-pale) 0%, var(--cream) 100%);
  border-radius: 12px;
  margin-right: 12px;
}

.contact-divider {
  width: 40px;
  height: 2px;
  background: linear-gradient(90deg, var(--gold), transparent);
  margin: 15px 0;
}
</style>

<div class="contact-section">
    
    <!-- Optional Breadcrumb -->
    <div class="sacred-breadcrumb pt-3 pb-3 d-none d-md-block">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <span class="breadcrumbs">
                        <a href="{{ route('front.home') }}">
                            <i class="fa fa-home"></i> Home
                        </a>
                        <i class="fa fa-chevron-right"></i>
                        <span style="color: var(--gold);">Sacred Connection</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <!-- Page Title -->
                <h1 class="contact-title">Sacred Connection</h1>
                <div class="title-divider">
                    <span class="gold-diamond"></span>
                </div>
                <p class="text-muted" style="font-family: 'Lato', sans-serif; font-size: 14px; max-width: 600px; margin: 0 auto;">
                    We are here to guide you on your spiritual journey
                </p>
            </div>
        </div>

        <div class="row contact-row justify-content-center">
            <div class="col-12 col-md-10 col-lg-11">
                <div class="row">
                    <!-- Left Column - Company Info -->
                    <div class="col-12 col-md-6 contact-left">
                        <div class="contact-card h-100">
                            <div class="sacred-icon mb-3">
                                <i class="fa fa-star" style="color: var(--gold);"></i>
                            </div>
                            <h2 class="company-name">{!!$appName->value!!}</h2>
                            <span class="company-subtext">Consult Online {{ucfirst($professionTitle)}} Anytime</span>
                            <div class="contact-divider"></div>
                            <p class="company-address">
                                <i class="fa fa-map-marker-alt mr-2" style="color: var(--gold);"></i>
                                {!!$siteaddress!!}
                            </p>
                            
                            <div class="contact-info-item">
                                <i class="fa fa-phone-alt"></i>
                                <span>Customer Support: <strong>{!! $sitenumber!!}</strong></span>
                            </div>
                            
                            <div class="contact-info-item">
                                <i class="fa fa-envelope"></i>
                                <a href="mailto:support@anytimeastro.com">{!! $siteemail!!}</a>
                            </div>
                            
                            <div class="contact-info-item">
                                <i class="fa fa-clock"></i>
                                <span>Available 24/7 for your sacred guidance</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Contact Form -->
                    <div class="col-12 col-md-6 contact-right">
                        <div class="contact-card h-100">
                            <div class="sacred-icon mb-3">
                                <i class="fa fa-pen-fancy" style="color: var(--gold);"></i>
                            </div>
                            <h2 class="form-title">Share Your Sacred Journey</h2>
                            <p class="form-description">
                                We are happy to help. Tell us your thoughts and we will respond with divine timing.
                            </p>

                            <div class="alert sacred-alert" role="alert" style="display: none;"></div>

                            <form id="contactform" method="post" action="{{ route('front.store.contact') }}" novalidate>
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="contact-form-group">
                                            <input autocomplete="off" class="contact-form-control" id="contact_name"
                                                name="contact_name" placeholder="Your Sacred Name" type="text">
                                            <span id="contact_name_error" class="error-message text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="contact-form-group">
                                            <input autocomplete="off" class="contact-form-control" id="contact_email"
                                                name="contact_email" placeholder="Email Address" type="text">
                                            <span id="contact_email_error" class="error-message text-danger"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="contact-form-group">
                                    <textarea autocomplete="off" class="contact-form-control" id="contact_message"
                                        maxlength="500" name="contact_message" 
                                        placeholder="Share your sacred message here..."></textarea>
                                    <span id="contact_message_error" class="error-message text-danger"></span>
                                </div>

                                <button type="submit" class="submit-btn" id="submitBtn">
                                    <i class="fa fa-feather-alt mr-2"></i> Send Sacred Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// ═══════════════════════════════════════════════════════════
// PRESERVED ORIGINAL JAVASCRIPT - FULL FUNCTIONALITY INTACT
// ═══════════════════════════════════════════════════════════

$(document).ready(function() {
    $('#contactform').submit(function(event) {
        event.preventDefault();
        
        var formData = $(this).serialize();
        var $submitBtn = $('#submitBtn');
        
        // Clear previous error messages
        $('.error-message').text('');
        
        // Show loading state
        $submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin mr-2"></i> Sending...');

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                $('#contactform')[0].reset();
                var $alert = $('.alert');
                $alert.removeClass('sacred-alert-danger').addClass('sacred-alert-success')
                    .text(response.success).fadeIn();
                setTimeout(function() {
                    $alert.fadeOut();
                }, 3000);
                $submitBtn.prop('disabled', false).html('<i class="fa fa-feather-alt mr-2"></i> Send Sacred Message');
            },
            error: function(xhr, status, error) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(field, errorMessage) {
                        $('#' + field + '_error').text(errorMessage[0]);
                    });
                    var $alert = $('.alert');
                    $alert.removeClass('sacred-alert-success').addClass('sacred-alert-danger')
                        .text('Please correct the errors in your sacred message.').fadeIn();
                } else {
                    var $alert = $('.alert');
                    $alert.removeClass('sacred-alert-success').addClass('sacred-alert-danger')
                        .text('Server Error: Please try again later.').fadeIn();
                }
                $submitBtn.prop('disabled', false).html('<i class="fa fa-feather-alt mr-2"></i> Send Sacred Message');
            }
        });
    });
});
</script>

@endsection