@extends('frontend.layout.master')
@section('content')
<style>
/* ═══════════════════════════════════════════════════════
   PREMIUM CHECKOUT PAGE — Sacred Luxury Theme
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

.checkout-section *,
.checkout-section *::before,
.checkout-section *::after {
  box-sizing: border-box;
}

/* ─── Page wrapper ─── */
.checkout-section {
  background: linear-gradient(135deg, var(--white) 0%, var(--cream) 100%);
  position: relative;
  padding: 1rem 0 4rem;
  min-height: 100vh;
}

/* Top shimmer line */
.checkout-section::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, transparent 0%, var(--gold-light) 40%, var(--gold) 50%, var(--gold-light) 60%, transparent 100%);
  z-index: 2;
}

/* Warm noise texture */
.checkout-section::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 0;
}

.checkout-section .container {
  position: relative;
  z-index: 1;
}

/* ─── Breadcrumb Styling ─── */
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
.checkout-title {
  font-family: 'Cinzel', serif;
  font-size: clamp(22px, 4vw, 32px);
  font-weight: 700;
  color: var(--dark);
  margin: 0 0 0.5rem 0;
  position: relative;
  display: inline-block;
}

/* Gold divider under title */
.title-divider {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 1.5rem;
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

/* ─── Checkout Cards ─── */
.checkout-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-card);
  box-shadow: var(--shadow-card);
  overflow: hidden;
  transition: box-shadow var(--transition);
  position: relative;
  margin-bottom: 24px;
}

.checkout-card:hover {
  box-shadow: var(--shadow-hover);
}

.checkout-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
  z-index: 2;
}

.checkout-card-header {
  background: linear-gradient(135deg, var(--cream) 0%, var(--gold-pale) 100%);
  font-family: 'Cinzel', serif;
  font-size: 14px;
  font-weight: 600;
  color: var(--gold);
  padding: 14px 20px;
  border-bottom: 1px solid var(--border);
}

.checkout-card-header i {
  margin-right: 8px;
}

/* ─── Address Table ─── */
.address-table {
  width: 100%;
  font-family: 'Lato', sans-serif;
  border-collapse: collapse;
}

.address-table th {
  font-family: 'Cinzel', serif;
  font-size: 12px;
  font-weight: 600;
  color: var(--dark);
  padding: 12px;
  background: linear-gradient(135deg, var(--cream) 0%, var(--gold-pale) 100%);
  border-bottom: 1px solid var(--gold);
}

.address-table td {
  padding: 14px 12px;
  border-bottom: 1px solid var(--border);
  color: var(--text-mid);
  font-size: 13px;
}

.address-table tr:last-child td {
  border-bottom: none;
}

.address-table input[type="radio"] {
  accent-color: var(--gold);
  width: 16px;
  height: 16px;
  cursor: pointer;
}

/* ─── Add Address Button ─── */
.add-address-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: transparent;
  border: 1px solid var(--gold);
  border-radius: 40px;
  padding: 8px 20px;
  font-family: 'Cinzel', serif;
  font-size: 12px;
  font-weight: 600;
  color: var(--gold);
  transition: all 0.25s ease;
  cursor: pointer;
  text-decoration: none;
}

.add-address-btn:hover {
  background: var(--gold);
  color: var(--white);
  text-decoration: none;
}

/* ─── Order Summary Card ─── */
.summary-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-card);
  box-shadow: var(--shadow-card);
  overflow: hidden;
  position: relative;
}

.summary-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

.summary-card-header {
  background: linear-gradient(135deg, var(--cream) 0%, var(--gold-pale) 100%);
  font-family: 'Cinzel', serif;
  font-size: 14px;
  font-weight: 600;
  color: var(--gold);
  padding: 14px 20px;
  border-bottom: 1px solid var(--border);
}

.summary-content {
  padding: 20px;
}

.order-items {
  max-height: 300px;
  overflow-y: auto;
  margin-bottom: 20px;
}

.order-items-title {
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  color: var(--dark);
  margin-bottom: 15px;
}

.order-item {
  display: flex;
  gap: 12px;
  padding: 12px 0;
  border-bottom: 1px solid var(--border);
}

.order-item-img {
  width: 55px;
  height: 55px;
  object-fit: cover;
  border-radius: 12px;
  border: 1px solid var(--border);
  flex-shrink: 0;
}

.order-item-details {
  flex: 1;
}

.order-item-name {
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  color: var(--dark);
  margin-bottom: 4px;
}

.order-item-qty {
  font-family: 'Lato', sans-serif;
  font-size: 11px;
  color: var(--text-muted);
}

.order-item-price {
  font-family: 'Cinzel', serif;
  font-weight: 700;
  color: var(--gold);
  font-size: 13px;
  white-space: nowrap;
}

.price-breakdown {
  border-top: 1px solid var(--border);
  padding-top: 15px;
}

.price-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px;
  font-family: 'Lato', sans-serif;
  font-size: 13px;
}

.price-label {
  color: var(--text-mid);
}

.price-value {
  font-weight: 600;
  color: var(--dark);
}

.total-row {
  display: flex;
  justify-content: space-between;
  padding-top: 12px;
  margin-top: 8px;
  border-top: 2px solid var(--gold);
}

.total-label {
  font-family: 'Cinzel', serif;
  font-size: 16px;
  font-weight: 700;
  color: var(--dark);
}

.total-value {
  font-family: 'Cinzel', serif;
  font-size: 18px;
  font-weight: 800;
  color: var(--gold);
}

/* ─── Place Order Button ─── */
.place-order-btn {
  width: 100%;
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border: none;
  border-radius: 40px;
  padding: 14px 20px;
  font-family: 'Cinzel', serif;
  font-size: 14px;
  font-weight: 600;
  color: var(--white);
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: all 0.25s ease;
  margin-top: 20px;
}

.place-order-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(201,168,76,0.3);
}

/* ─── Modal Styling ─── */
.sacred-modal .modal-content {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-card);
  box-shadow: var(--shadow-hover);
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

/* Modal Form Styling */
.modal-form-group {
  margin-bottom: 16px;
}

.modal-form-group label {
  font-family: 'Cinzel', serif;
  font-size: 12px;
  font-weight: 600;
  color: var(--dark);
  margin-bottom: 6px;
  display: block;
}

.modal-form-group input,
.modal-form-group select {
  width: 100%;
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 10px 14px;
  transition: all 0.2s ease;
}

.modal-form-group input:focus,
.modal-form-group select:focus {
  border-color: var(--gold);
  box-shadow: 0 0 0 3px var(--gold-glow);
  outline: none;
}

.modal-submit-btn {
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border: none;
  border-radius: 40px;
  padding: 12px 28px;
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  color: var(--white);
  transition: all 0.25s ease;
  width: 100%;
}

.modal-submit-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(201,168,76,0.3);
}

/* Country code dropdown styling */
.country-code-wrapper {
  display: flex;
  border: 1px solid var(--border);
  border-radius: 12px;
  overflow: hidden;
}

.country-code-select {
  width: 30%;
  border: none;
  border-right: 1px solid var(--border);
  border-radius: 0;
  padding: 10px;
  font-family: 'Lato', sans-serif;
  font-size: 13px;
}

.country-code-input {
  flex: 1;
  border: none;
  padding: 10px;
  font-family: 'Lato', sans-serif;
  font-size: 13px;
}

.country-code-input:focus {
  outline: none;
}

/* Responsive */
@media (max-width: 991px) {
  .address-table th,
  .address-table td {
    padding: 10px 8px;
    font-size: 12px;
  }
}

@media (max-width: 768px) {
  .address-table,
  .address-table tbody,
  .address-table tr,
  .address-table td {
    display: block;
  }
  
  .address-table thead {
    display: none;
  }
  
  .address-table tr {
    margin-bottom: 15px;
    border: 1px solid var(--border);
    border-radius: var(--radius-card);
    padding: 12px;
  }
  
  .address-table td {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid var(--border);
  }
  
  .address-table td:last-child {
    border-bottom: none;
  }
  
  .address-table td::before {
    content: attr(data-label);
    font-family: 'Cinzel', serif;
    font-weight: 600;
    color: var(--dark);
    font-size: 11px;
  }
  
  .order-item {
    flex-wrap: wrap;
  }
}

@media (max-width: 576px) {
  .checkout-card-header {
    font-size: 12px;
    padding: 10px 16px;
  }
  
  .summary-content {
    padding: 15px;
  }
  
  .order-item-img {
    width: 45px;
    height: 45px;
  }
  
  .order-item-name {
    font-size: 12px;
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

.checkout-left {
  animation: fadeSlideUp 0.45s ease 0.05s backwards;
}

.checkout-right {
  animation: fadeSlideUp 0.45s ease 0.15s backwards;
}

/* Select2 customization */
.select2-container--default .select2-selection--single {
  border-color: var(--border);
  border-radius: 12px;
  height: 42px;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
  line-height: 42px;
  color: var(--text-mid);
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
  height: 40px;
}

.select2-dropdown {
  border-color: var(--border);
  border-radius: 12px;
}

/* Empty state styling */
.empty-address {
  text-align: center;
  padding: 40px;
  color: var(--text-mid);
}

.empty-address i {
  font-size: 48px;
  color: var(--border);
  margin-bottom: 15px;
}

.empty-address p {
  margin-bottom: 15px;
}
</style>

<div class="checkout-section">
    
    <!-- Sacred Breadcrumb -->
    <div class="sacred-breadcrumb pt-3 pb-3">
        <div class="container">
            <div class="row afterLoginDisplay">
                <div class="col-md-12 d-flex align-items-center">
                    <span class="breadcrumbs">
                        <a href="{{ route('front.home') }}">
                            <i class="fa fa-home"></i> Home
                        </a>
                        <i class="fa fa-chevron-right"></i>
                        <a href="{{ route('front.cart') }}">Cart</a>
                        <i class="fa fa-chevron-right"></i>
                        <span style="color: var(--gold);">Sacred Checkout</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Address Modal -->
    <div class="modal fade sacred-modal mt-2 mt-md-5" id="checkout" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <i class="fa fa-map-marker mr-2"></i>Shipping Details
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body pt-0 pb-0">
                    <div class="bg-white body">
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <div class="mb-3">
                                    <form class="px-3 font-14" method="post" id="orderAddress" autocomplete="off">

                                        <input type="hidden" name="userId" value="{{ authcheck()['id'] }}">
                                        <div class="row">
                                            <div class="col-12 col-md-6 py-2">
                                                <div class="modal-form-group">
                                                    <label>Full Name <span class="color-red">*</span></label>
                                                    <input class="form-control" id="nameget" name="name" 
                                                        placeholder="Enter your name" type="text" value="" 
                                                        pattern="^[a-zA-Z\s]{2,50}$"
                                                        title="Name should contain only letters and be between 2 and 50 characters long" required
                                                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 py-2">
                                                <div class="modal-form-group">
                                                    <label>Phone Number <span class="color-red">*</span></label>
                                                    <div class="country-code-wrapper">
                                                        <select class="country-code-select" id="countryCode" name="countryCode" style="width:34%">
                                                            @forelse ($countries2 as $country)
                                                                <option data-country="in" value="{{ $country->phonecode }}" data-ucname="India">
                                                                    +{{ $country->phonecode }}
                                                                </option>
                                                            @empty
                                                                <option value="91">+91</option>
                                                            @endforelse
                                                        </select>
                                                        <input class="country-code-input" id="contact" maxlength="12" 
                                                            name="phoneNumber" type="number" placeholder="Phone number" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 py-2">
                                                <div class="modal-form-group">
                                                    <label>Flat/House No. <span class="color-red">*</span></label>
                                                    <input class="form-control" id="flatNo" name="flatNo" 
                                                        placeholder="Enter flat/house number" type="text" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 py-2">
                                                <div class="modal-form-group">
                                                    <label>Locality <span class="color-red">*</span></label>
                                                    <input class="form-control" id="locality" name="locality" 
                                                        placeholder="Enter locality" type="text" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 py-2">
                                                <div class="modal-form-group">
                                                    <label>Landmark <span class="color-red">*</span></label>
                                                    <input class="form-control" id="landmark" name="landmark" 
                                                        placeholder="Enter landmark" type="text" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 py-2">
                                                <div class="modal-form-group">
                                                    <label>Country <span class="color-red">*</span></label>
                                                    <select class="form-control select2" name="country" required>
                                                        <option value="">Select Country</option>
                                                        @forelse($countries as $country)
                                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                        @empty
                                                            <option value="">No countries available</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 py-2">
                                                <div class="modal-form-group">
                                                    <label>State <span class="color-red">*</span></label>
                                                    <select class="form-control select2" name="state" required>
                                                        <option value="">Select State</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 py-2">
                                                <div class="modal-form-group">
                                                    <label>City <span class="color-red">*</span></label>
                                                    <select class="form-control select2" name="city" required>
                                                        <option value="">Select City</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 py-2">
                                                <div class="modal-form-group">
                                                    <label>Pincode <span class="color-red">*</span></label>
                                                    <input class="form-control" id="pincode" name="pincode" 
                                                        placeholder="Enter pincode" type="text" value="" pattern="\d{6}"
                                                        inputmode="numeric"
                                                        title="Pincode should be a 6 digit number" required
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-12 py-3">
                                            <div class="row">
                                                <div class="col-12 pt-md-3 text-center mt-2">
                                                    <button type="submit" class="modal-submit-btn" id="addressBtn">
                                                        <i class="fa fa-plus mr-2"></i>Add Address
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

    <div class="container">
        <div class="row py-3">
            <div class="col-sm-12 mt-4">
                <div class="row">
                    <div class="col-12 mb-4">
                        <h1 class="checkout-title">Sacred Checkout</h1>
                        <div class="title-divider">
                            <span class="gold-diamond"></span>
                        </div>
                    </div>

                    <!-- Left Column - Address Selection -->
                    <div class="col-lg-8 col-12 checkout-left">
                        <div class="checkout-card">
                            <div class="checkout-card-header">
                                <i class="fa fa-location-dot"></i> Select Delivery Address
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12 text-right pr-3 pt-3">
                                    <a role="button" data-toggle="modal" data-target="#checkout" class="add-address-btn">
                                        <i class="fa fa-plus"></i> Add New Address
                                    </a>
                                </div>
                            </div>

                            <form class="px-3 font-14" method="post" id="orderForm" autocomplete="off">

                                <div class="table-responsive mt-3 mb-4">
                                    <table class="address-table">
                                        <thead>
                                            <tr>
                                                <th>Select</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        @php
                                            $addressList = [];
                                            
                                            if (!empty($getOrderAddress) && is_array($getOrderAddress)) {
                                                $addressList = $getOrderAddress['recordList'] ?? [];
                                            }
                                            
                                            if (!is_array($addressList)) {
                                                $addressList = [];
                                            }
                                        @endphp

                                        @if(empty($addressList))
                                            <tr>
                                                <td colspan="4" class="empty-address">
                                                    <i class="fa fa-map-marker-alt"></i>
                                                    <p>No saved addresses found.</p>
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#checkout" class="add-address-btn" style="font-size: 12px;">
                                                        <i class="fa fa-plus"></i> Add Address
                                                    </a>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($addressList as $addr)
                                                @if(!empty($addr) && is_array($addr))
                                                <tr>
                                                    <td data-label="Select">
                                                        <input type="radio" name="orderAddressId" value="{{ $addr['id'] ?? '' }}" required>
                                                    </td>
                                                    <td data-label="Name">{{ $addr['name'] ?? 'N/A' }}</td>
                                                    <td data-label="Phone">{{ $addr['phoneNumber'] ?? 'N/A' }}</td>
                                                    <td data-label="Address">
                                                        {{ $addr['flatNo'] ?? '' }}
                                                        @if(!empty($addr['locality'])), {{ $addr['locality'] }}@endif
                                                        @if(!empty($addr['landmark'])), {{ $addr['landmark'] }}@endif
                                                        @if(!empty($addr['city'])), {{ $addr['city'] }}@endif
                                                        @if(!empty($addr['state'])), {{ $addr['state'] }}@endif
                                                        @if(!empty($addr['country'])), {{ $addr['country'] }}@endif
                                                        @if(!empty($addr['pincode'])) - {{ $addr['pincode'] }}@endif
                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        @endif

                                        </tbody>
                                    </table>
                                </div>

                        </div>
                    </div>

                    <!-- Right Column - Order Summary -->
                    <div class="col-lg-4 col-12 checkout-right">
                        <div class="summary-card">
                            <div class="summary-card-header">
                                <i class="fa fa-receipt"></i> Order Summary
                            </div>
                            <div class="summary-content">

                                <!-- Cart Items List -->
                                <div class="order-items">
                                    <div class="order-items-title">
                                        <i class="fa fa-shopping-bag mr-1"></i> Items ({{ count($cartItems) }})
                                    </div>

                                    @forelse($cartItems as $item)
                                        @if($item->product)
                                        <div class="order-item">
                                            <img src="{{ asset($item->product->productImage) }}"
                                                 class="order-item-img"
                                                 onerror="this.src='/build/assets/images/person.png'"
                                                 alt="{{ $item->product->name }}">
                                            <div class="order-item-details">
                                                <div class="order-item-name">{{ $item->product->name }}</div>
                                                <div class="order-item-qty">Quantity: {{ $item->quantity }}</div>
                                            </div>
                                            <div class="order-item-price">
                                                {{ $currency->value ?? '₹' }}{{ number_format($item->product->getRawOriginal('amount') * $item->quantity, 2) }}
                                            </div>
                                        </div>
                                        @endif
                                    @empty
                                        <p class="text-muted text-center py-3">No items in cart</p>
                                    @endforelse
                                </div>

                                <!-- Price Breakdown -->
                                <div class="price-breakdown">
                                    <div class="price-row">
                                        <span class="price-label">Subtotal</span>
                                        <span class="price-value">{{ $currency->value ?? '₹' }}{{ number_format($subtotal, 2) }}</span>
                                    </div>
                                    @if($gstPercent > 0)
                                    <div class="price-row">
                                        <span class="price-label">GST ({{ $gstPercent }}%)</span>
                                        <span class="price-value">{{ $currency->value ?? '₹' }}{{ number_format($gstAmount, 2) }}</span>
                                    </div>
                                    @endif
                                    <div class="total-row">
                                        <span class="total-label">Total</span>
                                        <span class="total-value">{{ $currency->value ?? '₹' }}{{ number_format($total, 2) }}</span>
                                    </div>
                                </div>

                                <!-- Hidden fields -->
                                <input type="hidden" id="checkout-total" value="{{ $total }}">
                                <input type="hidden" id="checkout-subtotal" value="{{ $subtotal }}">
                                <input type="hidden" id="checkout-gst" value="{{ $gstPercent }}">

                                <button type="submit" class="place-order-btn" id="orderBtn">
                                    <i class="fa fa-lock mr-2"></i> Place Sacred Order
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
@endsection

@section('scripts')
<script>
// ═══════════════════════════════════════════════════════════
// PRESERVED ORIGINAL JAVASCRIPT - FULL FUNCTIONALITY INTACT
// ═══════════════════════════════════════════════════════════

// Select2 init
$(document).ready(function() {
    $('.select2').select2({ width: '100%' });
});

// Country / State / City cascading
$(document).ready(function () {
    const $countryDropdown = $('select[name="country"]');
    const $stateDropdown   = $('select[name="state"]');
    const $cityDropdown    = $('select[name="city"]');

    $countryDropdown.on('change', function () {
        const countryId = $(this).val();
        $stateDropdown.html('<option value="">Select State</option>');
        $cityDropdown.html('<option value="">Select City</option>');

        if (countryId) {
            $.ajax({
                url: '/get-states/' + countryId,
                type: 'GET',
                success: function (data) {
                    $stateDropdown.html('<option value="">Select State</option>');
                    $.each(data, function (key, value) {
                        $stateDropdown.append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching states:', error);
                    toastr.error('Error loading states');
                }
            });
        }
    });

    $stateDropdown.on('change', function () {
        const stateId = $(this).val();
        $cityDropdown.html('<option value="">Select City</option>');

        if (stateId) {
            $.ajax({
                url: '/get-cities/' + stateId,
                type: 'GET',
                success: function (data) {
                    $cityDropdown.html('<option value="">Select City</option>');
                    $.each(data, function (key, value) {
                        $cityDropdown.append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching cities:', error);
                    toastr.error('Error loading cities');
                }
            });
        }
    });
});

// Add Address
$(document).ready(function() {
    $('#addressBtn').click(function(e) {
        e.preventDefault();

        var form = document.getElementById('orderAddress');
        if (form.checkValidity() === false) {
            form.reportValidity();
            return;
        }

        @php
            use Symfony\Component\HttpFoundation\Session\Session;
            $session = new Session();
            $token   = $session->get('token');
        @endphp

        var formData = {
            userId: $('input[name="userId"]').val(),
            name: $("#nameget").val(),
            countryCode: $('select[name="countryCode"]').val(),
            phoneNumber: $('input[name="phoneNumber"]').val(),
            flatNo: $('input[name="flatNo"]').val(),
            locality: $('input[name="locality"]').val(),
            landmark: $('input[name="landmark"]').val(),
            country: $('select[name="country"]').val(),
            state: $('select[name="state"]').val(),
            city: $('select[name="city"]').val(),
            pincode: $('input[name="pincode"]').val()
        };

        if (!formData.name || !formData.phoneNumber || !formData.flatNo || 
            !formData.locality || !formData.landmark || !formData.country || 
            !formData.state || !formData.city || !formData.pincode) {
            toastr.error('Please fill all required fields');
            return;
        }

        $('#addressBtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin mr-2"></i>Adding Address...');

        $.ajax({
            url: '/api/orderAddress/add?token={{ $token }}',
            type: 'POST',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify(formData),
            success: function(response) {
                toastr.success('Address Added Successfully');
                $('#orderAddress')[0].reset();
                $('#checkout').modal('hide');
                setTimeout(function() {
                    window.location.reload();
                }, 1500);
            },
            error: function(xhr, status, error) {
                var errorMsg = 'Failed to add address';
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.message) {
                        errorMsg = response.message;
                    } else if (response.error) {
                        errorMsg = response.error;
                    }
                } catch(e) {
                    if (xhr.responseText) {
                        errorMsg = xhr.responseText.substring(0, 100);
                    }
                }
                toastr.error(errorMsg);
                $('#addressBtn').prop('disabled', false).html('<i class="fa fa-plus mr-2"></i>Add Address');
            }
        });
    });
});

// Place Order (Cart → Order)
function placeCartOrder(addressId, paymentMethod) {
    fetch('{{ route("cart.placeOrder") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            orderAddressId: addressId,
            paymentMethod:  paymentMethod,
        })
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        if (data.status === 200) {
            toastr.success('Order created! Redirecting...');
            setTimeout(function() {
                window.location.href = '/order-success/' + data.order_id;
            }, 1500);
        } else {
            toastr.error(data.error || 'Failed to place order');
            $('#orderBtn').prop('disabled', false).html('<i class="fa fa-lock mr-2"></i> Place Sacred Order');
        }
    })
    .catch(function(err) {
        console.error(err);
        toastr.error('Something went wrong. Please try again.');
        $('#orderBtn').prop('disabled', false).html('<i class="fa fa-lock mr-2"></i> Place Sacred Order');
    });
}

// Order Button Click
$(document).ready(function() {
    $('#orderBtn').click(function(e) {
        e.preventDefault();

        var selectedAddress = $("input[name='orderAddressId']:checked").val();

        if (!selectedAddress) {
            toastr.error('Please select a delivery address.');
            return;
        }

        Swal.fire({
            title: 'Confirm Sacred Order',
            text: 'You will be redirected to complete your sacred purchase.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#c9a84c',
            cancelButtonColor: '#6b4c22',
            confirmButtonText: 'Yes, Proceed'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#orderBtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin mr-2"></i>Processing...');
                placeCartOrder(selectedAddress, 'manual');
            }
        });
    });
});
</script>
@endsection