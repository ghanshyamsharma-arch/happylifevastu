@extends('frontend.layout.master')
@section('content')
<style>
/* ═══════════════════════════════════════════════════════
   PREMIUM MY ACCOUNT PAGE — Sacred Luxury Theme
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
}

.account-section {
  background: linear-gradient(135deg, var(--white) 0%, var(--cream) 100%);
  position: relative;
  min-height: 100vh;
  padding-bottom: 3rem;
}

/* Top shimmer line */
.account-section::before {
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
.account-section::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 0;
}

.account-section .container-fluid {
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
.account-header {
  margin-bottom: 1.5rem;
}

.page-title {
  font-family: 'Cinzel', serif;
  font-size: clamp(28px, 5vw, 42px);
  font-weight: 700;
  color: var(--dark);
  margin: 0 0 0.5rem 0;
}

.page-subtitle {
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  color: var(--text-mid);
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

/* ─── Tab Navigation ─── */
.sacred-tab-nav {
  border-bottom: 2px solid var(--border);
  margin-bottom: 1.5rem;
}

.tab-link {
  font-family: 'Cinzel', serif;
  font-size: 14px;
  font-weight: 600;
  color: var(--text-mid);
  text-decoration: none;
  display: inline-block;
  padding: 12px 20px;
  transition: all 0.25s ease;
  border-bottom: 2px solid transparent;
  margin-bottom: -2px;
}

.tab-link.active {
  color: var(--gold);
  border-bottom-color: var(--gold);
}

.tab-link:hover {
  color: var(--gold);
  text-decoration: none;
}

/* ─── Form Card ─── */
.form-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-card);
  overflow: hidden;
  box-shadow: var(--shadow-card);
  margin-bottom: 2rem;
}

.form-card-header {
  background: linear-gradient(135deg, var(--cream) 0%, var(--gold-pale) 100%);
  padding: 15px 20px;
  border-bottom: 1px solid var(--border);
}

.form-card-header h3 {
  font-family: 'Cinzel', serif;
  font-size: 16px;
  font-weight: 700;
  color: var(--gold);
  margin: 0;
}

.form-card-body {
  padding: 25px;
}

/* Form Fields */
.sacred-form-group {
  margin-bottom: 20px;
}

.sacred-label {
  font-family: 'Cinzel', serif;
  font-size: 12px;
  font-weight: 600;
  color: var(--dark);
  margin-bottom: 6px;
  display: block;
}

.sacred-label .required {
  color: var(--gold);
}

.sacred-input {
  width: 100%;
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 10px 15px;
  transition: all 0.2s ease;
}

.sacred-input:focus {
  border-color: var(--gold);
  box-shadow: 0 0 0 3px var(--gold-glow);
  outline: none;
}

.sacred-select {
  width: 100%;
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 10px 15px;
  background: var(--white);
  cursor: pointer;
}

.sacred-select:focus {
  border-color: var(--gold);
  outline: none;
}

/* Phone Input Group */
.phone-input-group {
  display: flex;
  gap: 10px;
}

.country-code-select {
  width: 100px;
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 10px;
}

/* Profile Image */
.profile-image-wrapper {
  display: flex;
  align-items: center;
  gap: 20px;
  flex-wrap: wrap;
}

.profile-preview {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid var(--gold);
  cursor: pointer;
  transition: transform 0.2s ease;
}

.profile-preview:hover {
  transform: scale(1.05);
}

.file-input-wrapper {
  position: relative;
  flex: 1;
}

.file-input-wrapper input {
  padding: 8px;
}

/* Update Button */
.update-btn {
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border: none;
  border-radius: 40px;
  padding: 12px 30px;
  font-family: 'Cinzel', serif;
  font-size: 14px;
  font-weight: 600;
  color: var(--white);
  transition: all 0.25s ease;
  cursor: pointer;
}

.update-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(201,168,76,0.3);
}

/* ─── Referral Cards ─── */
.referral-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-card);
  overflow: hidden;
  box-shadow: var(--shadow-card);
  height: 100%;
  transition: all var(--transition);
}

.referral-card:hover {
  transform: translateY(-5px);
  box-shadow: var(--shadow-hover);
}

.referral-card-header {
  background: linear-gradient(135deg, var(--cream) 0%, var(--gold-pale) 100%);
  padding: 15px 20px;
  border-bottom: 1px solid var(--border);
}

.referral-card-header h4 {
  font-family: 'Cinzel', serif;
  font-size: 16px;
  font-weight: 700;
  color: var(--gold);
  margin: 0;
}

.referral-card-body {
  padding: 20px;
}

.referral-link-group {
  display: flex;
  gap: 10px;
  margin-top: 15px;
}

.referral-input {
  flex: 1;
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 10px 15px;
  background: var(--cream);
}

.copy-btn {
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border: none;
  border-radius: 12px;
  padding: 10px 18px;
  color: var(--white);
  cursor: pointer;
  transition: all 0.2s ease;
}

.copy-btn:hover {
  transform: scale(1.02);
}

.how-it-works-text {
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  color: var(--text-mid);
  line-height: 1.6;
}

.how-it-works-text p {
  margin-bottom: 12px;
}

.how-it-works-text i {
  color: var(--gold);
  margin-right: 8px;
}

/* Responsive */
@media (max-width: 991px) {
  .form-card-body {
    padding: 20px;
  }
  
  .referral-card {
    margin-bottom: 20px;
  }
}

@media (max-width: 768px) {
  .form-card-body {
    padding: 16px;
  }
  
  .sacred-input,
  .sacred-select {
    font-size: 13px;
    padding: 8px 12px;
  }
  
  .update-btn {
    width: 100%;
  }
  
  .phone-input-group {
    flex-direction: column;
    gap: 10px;
  }
  
  .country-code-select {
    width: 100%;
  }
  
  .referral-link-group {
    flex-direction: column;
  }
  
  .copy-btn {
    width: 100%;
  }
}

@media (max-width: 576px) {
  .sacred-label {
    font-size: 11px;
  }
  
  .profile-preview {
    width: 60px;
    height: 60px;
  }
}

/* Animation */
@keyframes fadeSlideUp {
  from {
    opacity: 0;
    transform: translateY(15px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.form-card,
.referral-card {
  animation: fadeSlideUp 0.4s ease backwards;
}

.form-card { animation-delay: 0.05s; }
.referral-card:first-child { animation-delay: 0.1s; }
.referral-card:last-child { animation-delay: 0.15s; }
</style>

@php
     $countries = DB::table('countries')
    ->orderByRaw("CASE WHEN phonecode = 91 THEN 0 ELSE 1 END")
    ->get();
@endphp

<div class="account-section">
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
                        <span style="color: var(--gold);">Sacred Account</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid container-xl mt-3 email-prefrences" data-select2-id="select2-data-9-7lve">
        <div class="inpage" data-select2-id="select2-data-8-zrys">
            <div class="tab-content py-3" data-select2-id="select2-data-7-dgci">
                <div data-select2-id="select2-data-6-lle8">
                    
                    <!-- Page Header -->
                    <div class="account-header">
                        <h1 class="page-title">Sacred Account</h1>
                        <div class="title-divider">
                            <span class="gold-diamond"></span>
                        </div>
                        <p class="page-subtitle">
                            <i class="fa fa-user-circle-o mr-2" style="color: var(--gold);"></i>
                            View and update your sacred profile, manage your spiritual journey
                        </p>
                    </div>

                    <!-- Tab Navigation -->
                    <div class="sacred-tab-nav">
                        <a class="tab-link active">Update Sacred Profile</a>
                    </div>

                    <!-- Update Profile Form -->
                    <form id="frmUpdateProfile" enctype="multipart/form-data">
                        @csrf
                        <div class="form-card">
                            <div class="form-card-header">
                                <h3><i class="fa fa-user mr-2"></i> Personal Information</h3>
                            </div>
                            <div class="form-card-body">
                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <div class="sacred-form-group">
                                            <label class="sacred-label">Sacred Name <span class="required">*</span></label>
                                            <input autocomplete="off" class="sacred-input" data-val="true"
                                                id="FirstName" maxlength="30" name="name" placeholder="Enter your sacred name"
                                                type="text" value="{{ $getuserdetails['userDetails']['name'] }}"
                                                pattern="^[a-zA-Z\s]{2,50}$"
                                                title="Name should contain only letters and be between 2 and 30 characters long."
                                                required oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                                            <span class="field-validation-valid text-danger" data-valmsg-for="FirstName"
                                                data-valmsg-replace="true"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="sacred-form-group">
                                            <label class="sacred-label">Email Address <span class="required">*</span></label>
                                            <input autocomplete="off" class="sacred-input" id="EmailAddress"
                                                maxlength="50" name="email" placeholder="Enter email address" type="email"
                                                value="{{ $getuserdetails['userDetails']['email'] }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <div class="sacred-form-group">
                                            <label class="sacred-label">Mobile Number <span class="required">*</span></label>
                                            <div class="phone-input-group">
                                                <select class="country-code-select" id="countryCode1" name="countryCode">
                                                    @foreach ($countries as $country)
                                                        <option data-country="in" value="{{ $getuserdetails['userDetails']['countryCode'] ?? $country->phonecode}}" data-ucname="India">
                                                            +{{ $country->phonecode }} ({{ $country->iso }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <input autocomplete="off" class="sacred-input flex-grow-1" id="ContactMobile" name="contactNo" type="tel" 
                                                       value="{{ $getuserdetails['userDetails']['contactNo'] }}" pattern="\d{10}" inputmode="numeric" 
                                                       title="Phone number should contain only numbers." required maxlength="10" 
                                                       oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                            </div>
                                            <span class="field-validation-valid text-danger" data-valmsg-for="ContactMobile" data-valmsg-replace="true"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-12">
                                        <div class="sacred-form-group">
                                            <label class="sacred-label">Gender <span class="required">*</span></label>
                                            <select class="sacred-select" data-val="true" id="Gender" name="gender" required>
                                                <option value=""
                                                    {{ $getuserdetails['userDetails']['gender'] == 0 ? 'selected' : '' }}>
                                                    -- Select --</option>
                                                <option value="Male"
                                                    {{ $getuserdetails['userDetails']['gender'] == 'Male' ? 'selected' : '' }}>
                                                    Male</option>
                                                <option value="Female"
                                                    {{ $getuserdetails['userDetails']['gender'] == 'Female' ? 'selected' : '' }}>
                                                    Female</option>
                                                <option value="Other"
                                                    {{ $getuserdetails['userDetails']['gender'] == 'Other' ? 'selected' : '' }}>
                                                    Other</option>
                                            </select>
                                            <span class="field-validation-valid text-danger" data-valmsg-for="Gender"
                                                data-valmsg-replace="true"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <div class="sacred-form-group">
                                            <label class="sacred-label">Birth Date <span class="required">*</span></label>
                                            <input type="date" name="birthDate" class="sacred-input"
                                                value="{{ date('Y-m-d', strtotime($getuserdetails['userDetails']['birthDate'])) }}" required>
                                            <span class="field-validation-valid text-danger" data-valmsg-for="POB"
                                                data-valmsg-replace="true"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="sacred-form-group">
                                            <label class="sacred-label">Birth Time</label>
                                            <input type="time" name="birthTime" class="sacred-input"
                                                value="{{ $getuserdetails['userDetails']['birthTime'] }}">
                                            <span class="field-validation-valid text-danger" data-valmsg-for="POB"
                                                data-valmsg-replace="true"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <div class="sacred-form-group">
                                            <label class="sacred-label">Place of Birth <span class="required">*</span></label>
                                            <input autocomplete="off" name="birthPlace"
                                                class="sacred-input ui-autocomplete-input" id="address"
                                                placeholder="Enter place of birth" type="text"
                                                value="{{ $getuserdetails['userDetails']['birthPlace'] }}" required>
                                            <span class="field-validation-valid text-danger" data-valmsg-for="POB"
                                                data-valmsg-replace="true"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="sacred-form-group">
                                            <label class="sacred-label">Current Address</label>
                                            <input class="sacred-input" id="CurrentAddress"
                                                value="{{ $getuserdetails['userDetails']['addressLine1'] }}"
                                                maxlength="300" name="addressLine1" placeholder="Enter current address"
                                                type="text">
                                            <span class="field-validation-valid text-danger"
                                                data-valmsg-for="CurrentAddress" data-valmsg-replace="true"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <div class="sacred-form-group">
                                            <label class="sacred-label">Location (City/State/Country)</label>
                                            <input autocomplete="off" class="sacred-input ui-autocomplete-input"
                                                id="CurrentPlace" name="location" placeholder="Enter current city"
                                                type="text" value="{{ $getuserdetails['userDetails']['location'] }}">
                                            <span class="field-validation-valid text-danger"
                                                data-valmsg-for="CurrentPlace" data-valmsg-replace="true"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="sacred-form-group">
                                            <label class="sacred-label">Pin Code</label>
                                            <input autocomplete="off" class="sacred-input" id="PinCode"
                                                name="pincode" pattern="\d{6}" inputmode="numeric"
                                                title="Pincode should be a 6 digit number." required
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="6"
                                                placeholder="Enter pin code" type="tel"
                                                value="{{ $getuserdetails['userDetails']['pincode'] }}">
                                            <span class="field-validation-valid text-danger" data-valmsg-for="PinCode"
                                                data-valmsg-replace="true"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <div class="sacred-form-group">
                                            <label class="sacred-label">Sacred Profile Image</label>
                                            <div class="profile-image-wrapper">
                                                @if($getuserdetails['userDetails']['profile'])
                                                    <img class="profile-preview" 
                                                         src="{{ Str::startsWith($getuserdetails['userDetails']['profile'], ['http://','https://']) ? $getuserdetails['userDetails']['profile'] : '/' . $getuserdetails['userDetails']['profile'] }}" 
                                                         onerror="this.onerror=null;this.src='/build/assets/images/person.png';" 
                                                         alt="Profile" 
                                                         onclick="openImage('{{ $getuserdetails['userDetails']['profile'] }}')">
                                                @endif
                                                <div class="file-input-wrapper">
                                                    <input class="form-control" id="profilepic" name="profilepic"
                                                        style="height:44px;" type="file" accept="image/*">
                                                </div>
                                            </div>
                                            <span class="field-validation-valid text-danger" data-valmsg-for="FirstName"
                                                data-valmsg-replace="true"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-12 text-center pt-3">
                                        <button type="button" id="btnSave" class="update-btn">
                                            <i class="fa fa-save mr-2"></i> Update Sacred Profile
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Referral Section -->
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="referral-card">
                                <div class="referral-card-header">
                                    <h4><i class="fa fa-share-alt mr-2"></i> Share Sacred Link</h4>
                                </div>
                                <div class="referral-card-body">
                                    <p class="how-it-works-text">
                                        Invite your friends by simply copying & sharing the referral link and earn
                                        referral bonus for you as well as your friends.
                                    </p>
                                    <div class="referral-link-group">
                                        <input class="referral-input" type="url" readonly id="referralLink"
                                            value="{{ env('APP_URL') . '?ref=' . $getuserdetails['userDetails']['referral_token'] }}">
                                        <button class="copy-btn" onclick="copyToClipboard('referralLink')">
                                            <i class="fa fa-copy mr-1"></i> Copy
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="referral-card">
                                <div class="referral-card-header">
                                    <h4><i class="fa fa-info-circle mr-2"></i> How It Works</h4>
                                </div>
                                <div class="referral-card-body">
                                    <div class="how-it-works-text">
                                        <p><i class="fa fa-user-plus"></i> Your friend must sign up on {{ $appname }} using your referral code.</p>
                                        <p><i class="fa fa-star"></i> Your friend must be a first time user of {{ $appname }}</p>
                                        <p><i class="fa fa-gift"></i> You will get <strong class="color-red">{{ $currency->value }}{{ $referral_settings->amount }}</strong> when your friend signs up on {{ $appname }} using your referral code.</p>
                                    </div>
                                </div>
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
    $apikey = DB::table('systemflag')->where('name', 'googleMapApiKey')->first();
@endphp
<script src="https://maps.googleapis.com/maps/api/js?key={{ $apikey->value }}&libraries=places"></script>

<script>
// Google Places Autocomplete
function initializeAutocomplete(inputId) {
    var input = document.getElementById(inputId);
    if (input) {
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function(event) {
            var place = autocomplete.getPlace();
            if (place.hasOwnProperty('place_id')) {
                if (!place.geometry) {
                    return;
                }
                latitude.value = place.geometry.location.lat();
                longitude.value = place.geometry.location.lng();
            } else {
                var service = new google.maps.places.PlacesService(document.createElement('div'));
                service.textSearch({
                    query: place.name
                }, function(results, status) {
                    if (status == google.maps.places.PlacesServiceStatus.OK) {
                        latitude.value = results[0].geometry.location.lat();
                        longitude.value = results[0].geometry.location.lng();
                    }
                });
            }
        });
    }
}
initializeAutocomplete('address');
initializeAutocomplete('CurrentAddress');

// Number validation
function isNumberKey(evt) {
    var e = event || evt;
    var CharCode = e.which || e.keyCode;
    if (CharCode == 13) {
        $("#btnVerify").click();
        return false;
    }
    if (CharCode > 31 && (CharCode < 48 || CharCode > 57))
        return false;
}

// Update Profile
$(document).ready(function() {
    $('#btnSave').click(function(e) {
        var form = document.getElementById('frmUpdateProfile');
        if (form.checkValidity() === false) {
            form.reportValidity();
            return;
        }
        e.preventDefault();

        @php
            $id = authcheck()['id'];
        @endphp
        var formData = new FormData($('#frmUpdateProfile')[0]);
        formData.append('profilepic', $('#profilepic')[0].files[0]);

        $('#btnSave').prop('disabled', true).html('<i class="fa fa-spinner fa-spin mr-2"></i> Updating...');

        $.ajax({
            url: '{{ route('user.update', ['id' => $id]) }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                toastr.success('Sacred Profile Updated Successfully');
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
            },
            error: function(xhr, status, error) {
                const response = typeof xhr.responseJSON === 'object' ? xhr.responseJSON : JSON.parse(xhr.responseText);
                $.each(response.error, function(key, value) {
                    if (Array.isArray(value)) {
                        $.each(value, function(i, errorMsg) {
                            toastr.error(errorMsg);
                        });
                    } else {
                        toastr.error(value);
                    }
                });
                $('#btnSave').prop('disabled', false).html('<i class="fa fa-save mr-2"></i> Update Sacred Profile');
            }
        });
    });
});

// Delete Account Confirmation
function confirmDelete(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#c9a84c',
        cancelButtonColor: '#6b4c22',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('front.deleteAccount') }}";
        }
    });
}

// Copy to Clipboard
function copyToClipboard(elementId) {
    const input = document.getElementById(elementId);
    navigator.clipboard.writeText(input.value).then(() => {
        toastr.success('Link Copied Successfully');
    }).catch(err => {
        console.error('Could not copy text: ', err);
    });
}
</script>
@endsection