@extends('frontend.layout.master')
@section('content')

<style>
/* Premium Astrology Theme - Puja Checkout Page */
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

/* Section Headers */
.cat-heading {
  font-family: 'Cinzel', serif;
  font-size: 19px;
  font-weight: 600;
  color: var(--dark);
  position: relative;
  display: inline-block;
}

.cat-heading span {
  color: var(--gold);
}

.cat-heading::before {
  content: '✦';
  color: var(--gold);
  margin-right: 6px;
  font-size: 14px;
}

/* Shadow Card */
.shadow-pink {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
  transition: all 0.3s ease;
}

.shadow-pink:hover {
  box-shadow: 0 8px 28px rgba(201, 168, 76, 0.08);
}

/* Section Headers inside cards */
.bg-pink {
  background: var(--gold-pale) !important;
  color: var(--gold) !important;
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  letter-spacing: 0.5px;
  padding: 10px 16px !important;
  border-bottom: 1px solid var(--border);
}

/* Table Styling */
.table {
  border-collapse: separate;
  border-spacing: 0;
}

.table.border-pink {
  border: 1px solid var(--border);
  border-radius: 12px;
  overflow: hidden;
}

.table thead tr {
  background: var(--gold-pale);
}

.table thead th {
  font-family: 'Cinzel', serif;
  font-size: 12px;
  font-weight: 600;
  color: var(--gold);
  padding: 12px 8px;
  border-bottom: 1px solid var(--border);
}

.table tbody td {
  font-size: 12px;
  color: var(--text-mid);
  padding: 10px 8px;
  vertical-align: middle;
  border-bottom: 1px solid var(--border);
}

.table tbody tr:hover {
  background: var(--cream);
}

/* Radio Button Styling */
input[type="radio"] {
  accent-color: var(--gold);
  width: 16px;
  height: 16px;
  cursor: pointer;
}

/* Form Inputs */
.form-control {
  border: 1px solid var(--border);
  border-radius: 10px;
  padding: 10px 14px;
  font-size: 13px;
  color: var(--text-dark);
  transition: all 0.3s ease;
}

.form-control:focus {
  border-color: var(--gold);
  box-shadow: 0 0 0 3px rgba(201, 168, 76, 0.1);
  outline: none;
}

.form-control.border-pink {
  border-color: var(--border);
}

/* Labels */
label {
  font-family: 'Cinzel', serif;
  font-size: 11px;
  font-weight: 500;
  color: var(--text-mid);
  margin-bottom: 6px;
}

.color-red {
  color: var(--gold) !important;
}

/* Country Code Dropdown Container */
.country-dropdown-container {
  border: 1px solid var(--border);
  border-radius: 10px;
  overflow: hidden;
}

.country-dropdown-container select {
  border: none;
  border-right: 1px solid var(--border);
  width: auto;
  min-width: 85px;
}

.country-dropdown-container input {
  border: none;
  width: 100%;
}

/* Select2 Custom Styling */
.select2-container--default .select2-selection--single {
  border: 1px solid var(--border);
  border-radius: 10px;
  height: 42px;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
  line-height: 40px;
  color: var(--text-dark);
  font-size: 13px;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
  height: 40px;
}

.select2-dropdown {
  border: 1px solid var(--border);
  border-radius: 10px;
}

.select2-container--default .select2-results__option--highlighted[aria-selected] {
  background-color: var(--gold);
}

/* Buttons */
.btn-chat {
  background: var(--gold);
  border: none;
  color: var(--dark);
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  padding: 12px 24px;
  border-radius: 50px;
  transition: all 0.3s ease;
}

.btn-chat:hover {
  background: var(--gold-light);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(201, 168, 76, 0.3);
}

.view-more {
  background: transparent;
  border: 1.5px solid var(--gold);
  color: var(--gold);
  font-family: 'Cinzel', serif;
  font-size: 12px;
  font-weight: 500;
  padding: 8px 20px;
  border-radius: 50px;
  transition: all 0.3s ease;
  display: inline-block;
  text-decoration: none;
}

.view-more:hover {
  background: var(--gold);
  color: var(--dark);
  transform: translateY(-2px);
}

/* Modal Styling */
.modal-content {
  border: 1px solid var(--border);
  border-radius: 20px;
  overflow: hidden;
}

.modal-header {
  background: var(--white);
  border-bottom: 1px solid var(--border);
  padding: 15px 20px;
}

.modal-header h4 {
  font-family: 'Cinzel', serif;
  font-size: 16px;
  font-weight: 600;
  color: var(--dark);
}

.modal-header .close {
  color: var(--text-mid);
  opacity: 0.7;
  transition: opacity 0.2s;
}

.modal-header .close:hover {
  opacity: 1;
  color: var(--gold);
}

/* Carousel for Puja Images */
#pujaImageSlider {
  border-radius: 12px;
  overflow: hidden;
}

#pujaImageSlider .carousel-inner {
  border-radius: 12px;
}

#pujaImageSlider img {
  width: 100%;
  height: 160px;
  object-fit: cover;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
  background-color: rgba(0, 0, 0, 0.5);
  border-radius: 50%;
  padding: 8px;
  background-size: 60%;
}

/* Price Section */
.text-secondary {
  color: var(--text-mid) !important;
}

/* Responsive */
@media (max-width: 768px) {
  .cat-heading {
    font-size: 16px;
  }
  
  .table thead th,
  .table tbody td {
    font-size: 10px;
    padding: 8px 4px;
  }
  
  .shadow-pink {
    margin-bottom: 20px;
  }
  
  .btn-chat {
    font-size: 12px;
    padding: 10px 20px;
  }
}

/* Animation */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.shadow-pink {
  animation: fadeIn 0.4s ease backwards;
}

.shadow-pink:nth-child(1) { animation-delay: 0.05s; }
</style>

@php
    $countries = DB::table('countries2')->get();
    $countries2 = DB::table('countries')
    ->orderByRaw("CASE WHEN phonecode = 91 THEN 0 ELSE 1 END")
    ->get();
@endphp

<div class="pt-1 pb-1 bg-red d-none d-md-block astroway-breadcrumb">
    <div class="container">
        <div class="row afterLoginDisplay">
            <div class="col-md-12 d-flex align-items-center">
                <span style="text-transform: capitalize;">
                    <span class="text-white breadcrumbs">
                        <a href="{{ route('front.home') }}" style="color:white;text-decoration:none">
                            <i class="fa fa-home font-18"></i>
                        </a>
                        <i class="fa fa-chevron-right"></i> 
                        <a href="{{route('front.pujacheckout',['slug'=>$astrologer->id,'id'=>$PujaDetails->id,'package_id'=>$PujaDetails->packages->id ?? 0])}}"
                            style="color:white;text-decoration:none">Puja Checkout</a>
                    </span>
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Add Address Modal -->
<div class="modal fade rounded mt-2 mt-md-5 login-offer" id="checkout" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold">✦ SHIPPING DETAILS ✦</h4>
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
                                        <div class="col-12 col-md-6 py-3">
                                            <div class="form-group mb-0">
                                                <span class="field-validation-valid control-label commonerror float-right color-red" data-valmsg-for="Name" data-valmsg-replace="false"></span>
                                                <label for="BoyName">Name <span class="color-red">*</span></label>
                                                <input class="form-control border-pink matchInTxt shadow-none" id="Name" name="name" placeholder="Enter Name" type="text" value="" pattern="^[a-zA-Z\s]{2,50}$" title="Name should contain only letters and be between 2 and 50 characters long." required oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 py-3">
                                            <div class="form-group mb-0">
                                                <span class="field-validation-valid control-label commonerror float-right color-red" data-valmsg-for="Name" data-valmsg-replace="false"></span>
                                                <label for="BoyName">Phone No <span class="color-red font-weight-bold">*</span></label>
                                                <div class="input-group">
                                                    <div class="d-flex inputform country-dropdown-container">
                                                        <select class="form-control select2" id="countryCode" name="countryCode">
                                                            @foreach ($countries2 as $country)
                                                            <option data-country="in" value="{{$country->phonecode}}" data-ucname="India">
                                                                +{{ $country->phonecode }} {{ $country->iso }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        <input class="form-control mobilenumber text-box single-line" id="contact" maxlength="12" name="phoneNumber" type="number" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 py-3">
                                            <div class="form-group mb-0">
                                                <span class="field-validation-valid control-label commonerror float-right color-red" data-valmsg-for="Name" data-valmsg-replace="false"></span>
                                                <label for="BoyName">Flat No <span class="color-red">*</span></label>
                                                <input class="form-control border-pink matchInTxt shadow-none" name="flatNo" placeholder="Enter Flat" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 py-3">
                                            <div class="form-group mb-0">
                                                <span class="field-validation-valid control-label commonerror float-right color-red" data-valmsg-for="Name" data-valmsg-replace="false"></span>
                                                <label for="BoyName">Locality <span class="color-red">*</span></label>
                                                <input class="form-control border-pink matchInTxt shadow-none" name="locality" placeholder="Enter Locality" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 py-3">
                                            <div class="form-group mb-0">
                                                <span class="field-validation-valid control-label commonerror float-right color-red" data-valmsg-for="Name" data-valmsg-replace="false"></span>
                                                <label for="BoyName">Landmark <span class="color-red">*</span></label>
                                                <input class="form-control border-pink matchInTxt shadow-none" name="landmark" placeholder="Enter Landmark" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 py-3">
                                            <div class="form-group mb-0">
                                                <label for="country">Country <span class="color-red">*</span></label>
                                                <select class="form-control select2" name="country" id="country" required>
                                                    <option value="">Select Country</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 py-3">
                                            <div class="form-group mb-0">
                                                <label for="state">State <span class="color-red">*</span></label>
                                                <select class="form-control select2" name="state" id="state" required>
                                                    <option value="">Select State</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 py-3">
                                            <div class="form-group mb-0">
                                                <label for="city">City <span class="color-red">*</span></label>
                                                <select class="form-control select2" name="city" id="city" required>
                                                    <option value="">Select City</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 py-3">
                                            <div class="form-group mb-0">
                                                <span class="field-validation-valid control-label commonerror float-right color-red" data-valmsg-for="Name" data-valmsg-replace="false"></span>
                                                <label for="BoyName">Pincode <span class="color-red">*</span></label>
                                                <input class="form-control border-pink matchInTxt shadow-none" name="pincode" placeholder="Enter Pincode" type="text" pattern="\d{6}" inputmode="numeric" title="Pincode should be a 6 digit number." required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 py-3">
                                        <div class="row">
                                            <div class="col-12 pt-md-3 text-center mt-2">
                                                <button type="submit" class="btn btn-block btn-chat px-4 px-md-5 mb-2" id="addressBtn">Add Address</button>
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

<div class="ds-head-populararticle bg-white cat-pages">
    <div class="container">
        <div class="row py-3">
            <div class="col-sm-12 mt-4">
                <div class="row">
                    <div class="col-12 mb-5">
                        <h2 class="cat-heading font-24 font-weight-bold">Puja Checkout <span class="color-red">Form</span></h2>
                    </div>
                    
                    <div class="col-lg-8 col-12">
                        <div class="mb-3 shadow-pink">
                            <div class="bg-pink color-red text-center font-weight-semi-bold py-1 px-3">✦ SELECT ADDRESS ✦</div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6 ml-auto">
                                    <a role="button" data-toggle="modal" data-target="#checkout" class="mt-3 view-more color-red font-weight-normal mb-2">+ Add Address</a>
                                </div>
                            </div>

                            <form class="px-3 font-14" method="post" id="orderForm" autocomplete="off">
                                <input type="hidden" name="astrologer_id" value="{{ $astrologer->id }}">
                                <div class="table-responsive mt-4 mb-4">
                                    <table class="table border-pink font-14 mb-0 text-center">
                                        <thead>
                                            <tr class="bg-pink color-red">
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($getOrderAddressed as $getOrderAddress)
                                            <tr>
                                                <td><input type="radio" name="orderAddressId" value="{{ $getOrderAddress['id'] }}"></td>
                                                <td>{{ $getOrderAddress['name'] }}</td>
                                                <td>{{ $getOrderAddress['countryCode'] }} {{ $getOrderAddress['phoneNumber'] }}</td>
                                                <td>{{ $getOrderAddress['flatNo'] }}, {{ $getOrderAddress['locality'] }}, {{ $getOrderAddress['landmark'] }}, {{ $getOrderAddress['city'] }}, {{ $getOrderAddress['state'] }}, {{ $getOrderAddress['country'] }}, {{ $getOrderAddress['pincode'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="shadow-pink p-3">
                            <div class="bg-pink color-red text-center font-weight-semi-bold py-1 px-3">✦ Puja Detail ✦</div>
                            <div class="card border-0 mt-2">
                                <div class="card-body pt-0">
                                    <div class="row justify-content-between mb-3">
                                        <div class="col-auto">
                                            <div class="media" style="display:block !important; border-radius: 10px;">
                                                @if (!empty($PujaDetails->puja_images) && is_array($PujaDetails->puja_images))
                                                    <div id="pujaImageSlider" class="carousel slide" data-ride="carousel" style="width: 220px; height: 160px; overflow: hidden; position:relative;">
                                                        <div class="carousel-inner" style="width: 100%; height: 100%;">
                                                            @foreach($PujaDetails->puja_images as $key => $image)
                                                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" style="width: 100%; height: 100%;">
                                                                    <img class="rounded-m" src="{{ Str::startsWith($image, ['http://','https://']) ? $image : '/' . $image }}" onerror="this.onerror=null;this.src='/build/assets/images/person.png';" alt="Customer image" onclick="openImage('{{ $image }}')" />
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        @if(count($PujaDetails->puja_images) > 1)
                                                            <a class="carousel-control-prev" href="#pujaImageSlider" role="button" data-slide="prev" style="width: 20px; height: 20px; top: 50%; left: 0; transform: translateY(-50%);">
                                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                <span class="sr-only">Previous</span>
                                                            </a>
                                                            <a class="carousel-control-next" href="#pujaImageSlider" role="button" data-slide="next" style="width: 20px; height: 20px; top: 50%; right: 0; transform: translateY(-50%);">
                                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                <span class="sr-only">Next</span>
                                                            </a>
                                                        @endif
                                                    </div>
                                                @else
                                                    <img class="img-fluid" src="{{ asset('public/frontend/homeimage/360.png') }}" width="62" height="62">
                                                @endif
                                                <div class="media-body mt-2" style="text-align: center;">
                                                    <p class="mb-0"><b>{{ $PujaDetails->puja_title }}</b></p>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="pujaId" value="{{ $PujaDetails->id }}">
                                        
                                        @if(isset($PujaDetails->packages->id))
                                            <input type="hidden" name="packageId" value="{{ $PujaDetails->packages->id }}">
                                        @endif
                                    </div>
                                    
                                    <div class="row justify-content-between">
                                        @if(isset($PujaDetails->packages->id))
                                        <div class="col-auto">
                                            <p class="mb-0"><span class="font-weight-semi-bold text-secondary">Package : </span></p>
                                            <p><span>{{ $PujaDetails->packages->title }} ({{$PujaDetails->packages->person}} Person)</span></p>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="row justify-content-between">
                                        <div class="col-auto">
                                            <p class="mb-1"><span>Price:</span></p>
                                        </div>
                                        <div class="col-auto my-auto">
                                            @if(isset($PujaDetails->packages->id))
                                                <p><span>{{ $currency->value }}{{ number_format($PujaDetails->packages->package_price, 2) }}</span></p>
                                                <small>(incl of all taxes)</small>
                                                <input type="hidden" value="{{ number_format($PujaDetails->packages->package_price, 2) }}" name="payableAmount">
                                            @else
                                                <p><span>{{ $currency->value }}{{ number_format($PujaDetails->puja_price, 2) }}</span></p>
                                                <small>(incl of all taxes)</small>
                                                <input type="hidden" value="{{ number_format($PujaDetails->puja_price, 2) }}" name="payableAmount">
                                            @endif
                                        </div>
                                    </div>

                                    <hr>
                                    
                                    <div class="row justify-content-between mb-2">
                                        <div class="col-auto">
                                            <p><b>Total Price:</b></p>
                                        </div>
                                        <div class="col-auto my-auto color-red">
                                            @if(isset($PujaDetails->packages->id))
                                                <p><b>{{ $currency->value }}{{ number_format($PujaDetails->packages->package_price, 2) }}</b></p>
                                                <input type="hidden" value="{{ number_format($PujaDetails->packages->package_price, 2) }}" name="totalPayable" id="totalPayable">
                                            @else
                                                <p><b>{{ $currency->value }}{{ number_format($PujaDetails->puja_price, 2) }}</b></p>
                                                <input type="hidden" value="{{ number_format($PujaDetails->puja_price, 2) }}" name="totalPayable" id="totalPayable">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-12 py-3">
                            <div class="row">
                                <div class="col-12 pt-md-3 text-center mt-2">
                                    <button type="submit" class="btn btn-block btn-chat px-4 px-md-5 mb-2" id="orderBtn">Buy Now</button>
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

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            width: '100%'
        });
    });

    $(document).ready(function() {
        const $countryDropdown = $('select[name="country"]');
        const $stateDropdown = $('select[name="state"]');
        const $cityDropdown = $('select[name="city"]');

        $countryDropdown.on('change', function() {
            const countryId = $(this).val();
            $stateDropdown.html('<option value="">Select State</option>');
            $cityDropdown.html('<option value="">Select City</option>');

            if (countryId) {
                $.ajax({
                    url: `/get-states/${countryId}`,
                    type: 'GET',
                    success: function(data) {
                        $stateDropdown.html('<option value="">Select State</option>');
                        $.each(data, function(key, value) {
                            $stateDropdown.append(`<option value="${value.id}">${value.name}</option>`);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching states:', error);
                    }
                });
            }
        });

        $stateDropdown.on('change', function() {
            const stateId = $(this).val();
            $cityDropdown.html('<option value="">Select City</option>');

            if (stateId) {
                $.ajax({
                    url: `/get-cities/${stateId}`,
                    type: 'GET',
                    success: function(data) {
                        $cityDropdown.html('<option value="">Select City</option>');
                        $.each(data, function(key, value) {
                            $cityDropdown.append(`<option value="${value.id}">${value.name}</option>`);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching cities:', error);
                    }
                });
            }
        });
    });
</script>

<script>
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
                $token = $session->get('token');
            @endphp

            var formData = $('#orderAddress').serialize();

            $.ajax({
                url: '{{ route('api.addOrderAddress', ['token' => $token]) }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    toastr.success('Address Added Successfully');
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    toastr.error(xhr.responseText);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#orderBtn').click(function(e) {
            var radioButton = document.querySelector('input[name="orderAddressId"]:checked');

            if (!radioButton) {
                toastr.error('Please select an address.', 'Validation Error', {
                    timeOut: 5000,
                    closeButton: true,
                    progressBar: true
                });
                e.preventDefault();
                return;
            }
            e.preventDefault();

            var token = "{{ session('token') }}";

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to proceed with this Puja order?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#c9a84c',
                cancelButtonColor: '#6b4c22',
                confirmButtonText: 'Yes, order now!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var paymentMethod = 'wallet';
                    var formData = $('#orderForm').serialize();
                    formData += '&paymentMethod=' + encodeURIComponent(paymentMethod);

                    $.ajax({
                        url: '{{ route('front.addUserPujaOrder', ['token' => '']) }}' + token,
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            if(response.redirect) {
                                window.location.href = response.redirect;
                            } else {
                                toastr.success('Puja Ordered Successfully');
                                setTimeout(function() {
                                    window.location.href = '{{ route('front.home') }}';
                                }, 2000);
                            }
                        },
                        error: function(xhr, status, error) {
                            var errorMessage = JSON.parse(xhr.responseText).error.paymentMethod[0];
                            toastr.error(errorMessage);
                        }
                    });
                }
            });
        });
    });
</script>
@endsection