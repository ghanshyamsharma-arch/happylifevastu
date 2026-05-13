@extends('frontend.pujari.layouts.portal')
@section('title', isset($puja) ? 'Edit Puja' : 'Create Puja')

@section('content')

<style>
    /* \u2500\u2500 Page Header \u2500\u2500 */
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 22px;
    }
    .page-title    { font-size: 22px; font-weight: 700; color: #1e293b; }
    .page-subtitle { font-size: 13px; color: #64748b; margin-top: 2px; }

    /* \u2500\u2500 Back Link \u2500\u2500 */
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #64748b;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        padding: 8px 14px;
        border: 1.5px solid #e2e8f0;
        border-radius: 9px;
        transition: all .2s;
    }
    .btn-back:hover { border-color: #f97316; color: #f97316; }

    /* \u2500\u2500 Form Card \u2500\u2500 */
    .form-card {
        background: white;
        border-radius: 14px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.07);
        overflow: hidden;
    }
    .form-card-header {
        background: linear-gradient(90deg, #f97316, #c2410c);
        padding: 18px 28px;
    }
    .form-card-header h2 {
        color: white;
        font-size: 18px;
        font-weight: 700;
        margin: 0;
    }
    .form-card-header p {
        color: rgba(255,255,255,.75);
        font-size: 13px;
        margin: 4px 0 0;
    }
    .form-card-body { padding: 28px; }

    /* \u2500\u2500 Section Divider \u2500\u2500 */
    .form-section {
        margin-bottom: 28px;
        padding-bottom: 24px;
        border-bottom: 1px solid #f1f5f9;
    }
    .form-section:last-child { border-bottom: none; margin-bottom: 0; }
    .form-section-title {
        font-size: 13px;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: .6px;
        margin-bottom: 16px;
    }

    /* \u2500\u2500 Grid \u2500\u2500 */
    .form-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }
    .form-grid-3 {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 18px;
    }
    .col-span-2 { grid-column: span 2; }

    /* \u2500\u2500 Form Controls \u2500\u2500 */
    .form-group  { display: flex; flex-direction: column; }
    .form-label  {
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
    }
    .form-label .req { color: #ef4444; }
    .form-control {
        border: 1.5px solid #e2e8f0;
        border-radius: 9px;
        padding: 10px 13px;
        font-size: 13px;
        font-family: inherit;
        color: #1e293b;
        transition: border-color .2s, box-shadow .2s;
        background: white;
        width: 100%;
    }
    .form-control:focus {
        outline: none;
        border-color: #f97316;
        box-shadow: 0 0 0 3px rgba(249,115,22,.1);
    }
    textarea.form-control { resize: vertical; min-height: 110px; }
    .error-msg { font-size: 12px; color: #ef4444; margin-top: 4px; min-height: 16px; }

    /* \u2500\u2500 Image Upload \u2500\u2500 */
    .upload-zone {
        border: 2px dashed #e2e8f0;
        border-radius: 10px;
        padding: 22px;
        text-align: center;
        cursor: pointer;
        transition: border-color .2s, background .2s;
        position: relative;
    }
    .upload-zone:hover, .upload-zone.drag-over {
        border-color: #f97316;
        background: #fff7ed;
    }
    .upload-zone input[type="file"] {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
    .upload-zone-icon { font-size: 32px; margin-bottom: 8px; }
    .upload-zone p    { font-size: 13px; color: #64748b; margin: 0; }
    .upload-zone span { font-size: 12px; color: #94a3b8; }

    /* \u2500\u2500 Image Preview Grid \u2500\u2500 */
    .img-preview-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 14px;
    }
    .img-preview-item {
        position: relative;
        width: 90px;
        height: 90px;
    }
    .img-preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 9px;
        border: 1.5px solid #e2e8f0;
    }
    .img-remove-btn {
        position: absolute;
        top: -7px;
        right: -7px;
        width: 22px;
        height: 22px;
        background: #ef4444;
        color: white;
        border: none;
        border-radius: 50%;
        font-size: 14px;
        line-height: 1;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
    }

    /* \u2500\u2500 Package Checkboxes \u2500\u2500 */
    .package-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 10px;
    }
    .package-card {
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px 14px;
        cursor: pointer;
        transition: all .2s;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }
    .package-card:hover { border-color: #f97316; background: #fff7ed; }
    .package-card.selected { border-color: #f97316; background: #fff7ed; }
    .package-card input[type="checkbox"] {
        accent-color: #f97316;
        width: 15px;
        height: 15px;
        margin-top: 2px;
        flex-shrink: 0;
    }
    .package-info .pkg-title  { font-size: 13px; font-weight: 600; color: #1e293b; }
    .package-info .pkg-price  { font-size: 12px; color: #f97316; font-weight: 700; margin-top: 2px; }
    .package-info .pkg-person { font-size: 11px; color: #94a3b8; }

    /* \u2500\u2500 Submit Button \u2500\u2500 */
    .btn-submit {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #f97316, #c2410c);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px 32px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: opacity .2s;
    }
    .btn-submit:hover    { opacity: .88; }
    .btn-submit:disabled { opacity: .6; cursor: not-allowed; }
    .btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #64748b;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        padding: 12px 20px;
        transition: color .2s;
    }
    .btn-cancel:hover { color: #1e293b; }

    /* \u2500\u2500 Alert \u2500\u2500 */
    .alert-box {
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 13px;
        margin-bottom: 18px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }
    .alert-info    { background: #eff6ff; border: 1px solid #bfdbfe; color: #1d4ed8; }
    .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; }
    .alert-error   { background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; }

    /* \u2500\u2500 Responsive \u2500\u2500 */
    @media (max-width: 640px) {
        .form-grid-2, .form-grid-3 { grid-template-columns: 1fr; }
        .col-span-2 { grid-column: span 1; }
        .form-card-body { padding: 18px; }
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; }
    input[type=number] { -moz-appearance: textfield; }
</style>

{{-- \u2500\u2500 Page Header \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500 --}}
<div class="page-header">
    <div>
        <div class="page-title">{{ isset($puja) ? 'Edit Puja' : 'Create New Puja' }}</div>
        <div class="page-subtitle">
            {{ isset($puja) ? 'Update your puja details. It will be sent for re-approval.' : 'Fill in the details below. Your puja will need admin approval before going live.' }}
        </div>
    </div>
    <a href="{{ route('front.puja-list') }}" class="btn-back">
        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to List
    </a>
</div>

{{-- \u2500\u2500 Info Notice \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500 --}}
<div class="alert-box alert-info">
    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="flex-shrink:0;margin-top:1px;">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <span>
        After submission, your puja will have <strong>Pending</strong> status and must be approved by admin before users can see and book it.
        @if(isset($puja) && $puja->isAdminApproved === 'Approved')
        <strong>Note:</strong> Editing an approved puja will reset it to Pending status.
        @endif
    </span>
</div>

{{-- \u2500\u2500 Toast Feedback \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500 --}}
<div id="toastSuccess" class="alert-box alert-success" style="display:none;"></div>
<div id="toastError"   class="alert-box alert-error"   style="display:none;"></div>

{{-- \u2500\u2500 Form Card \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500 --}}
<div class="form-card">

    {{-- Header --}}
    <div class="form-card-header">
        <h2>{{ isset($puja) ? '\u270f\ufe0f Update Puja Details' : '\ud83d\ude4f New Puja Details' }}</h2>
        <p>Fields marked with <span style="color:#fca5a5;">*</span> are required.</p>
    </div>

    <div class="form-card-body">
        <form id="pujaForm" enctype="multipart/form-data">
            @csrf
            @if(isset($puja))
                <input type="hidden" name="puja_id" value="{{ $puja->id }}">
            @endif

            {{-- \u2500\u2500 Section 1: Basic Info \u2500\u2500 --}}
            <div class="form-section">
                <div class="form-section-title">Basic Information</div>
                <div class="form-grid-2">

                    {{-- Title --}}
                    <div class="form-group col-span-2">
                        <label class="form-label">Puja Title <span class="req">*</span></label>
                        <input type="text" name="puja_title" class="form-control"
                               placeholder="e.g. Satyanarayan Katha, Ganesh Puja"
                               value="{{ isset($puja) ? $puja->puja_title : old('puja_title') }}">
                        <div class="error-msg" id="err_puja_title"></div>
                    </div>

                    {{-- Description --}}
                    <div class="form-group col-span-2">
                        <label class="form-label">Description <span class="req">*</span></label>
                        <textarea name="long_description" class="form-control"
                                  placeholder="Describe the puja, what's included, benefits, rituals...">{{ isset($puja) ? $puja->long_description : old('long_description') }}</textarea>
                        <div class="error-msg" id="err_long_description"></div>
                    </div>

                </div>
            </div>

            {{-- \u2500\u2500 Section 2: Schedule & Location \u2500\u2500 --}}
            <div class="form-section">
                <div class="form-section-title">Schedule & Location</div>
                <div class="form-grid-3">

                    {{-- Start Date & Time --}}
                    <div class="form-group">
                        <label class="form-label">Date & Time <span class="req">*</span></label>
                        <input type="datetime-local" name="puja_start_datetime" class="form-control"
                               min="{{ date('Y-m-d\TH:i') }}"
                               value="{{ isset($puja) ? date('Y-m-d\TH:i', strtotime($puja->puja_start_datetime)) : old('puja_start_datetime') }}">
                        <div class="error-msg" id="err_puja_start_datetime"></div>
                    </div>

                    {{-- Duration --}}
                    <div class="form-group">
                        <label class="form-label">Duration (minutes) <span class="req">*</span></label>
                        <input type="number" name="puja_duration" class="form-control"
                               placeholder="e.g. 120"
                               value="{{ isset($puja) ? $puja->puja_duration : old('puja_duration') }}">
                        <div class="error-msg" id="err_puja_duration"></div>
                    </div>

                    {{-- Place --}}
                    <div class="form-group">
                        <label class="form-label">Place</label>
                        <input type="text" name="puja_place" id="puja_place" class="form-control"
                               placeholder="e.g. Online, Jaipur"
                               value="{{ isset($puja) ? $puja->puja_place : old('puja_place') }}">
                        <div class="error-msg" id="err_puja_place"></div>
                    </div>

                </div>
            </div>

            {{-- \u2500\u2500 Section 3: Pricing \u2500\u2500 --}}
            <div class="form-section">
                <div class="form-section-title">Pricing</div>
                <div class="form-grid-2">

                    <div class="form-group">
                        <label class="form-label">Puja Price ({{ $currency->value ?? '\u20b9' }}) <span class="req">*</span></label>
                        <input type="number" name="puja_price" class="form-control"
                               placeholder="e.g. 5100"
                               value="{{ isset($puja) ? $puja->puja_price : old('puja_price') }}">
                        <div class="error-msg" id="err_puja_price"></div>
                        <span style="font-size:12px;color:#94a3b8;margin-top:4px;">
                            This is the base price if no package is selected by the user.
                        </span>
                    </div>

                </div>
            </div>

            {{-- \u2500\u2500 Section 4: Packages \u2500\u2500 --}}
            @if(isset($packages) && $packages->count() > 0)
            <div class="form-section">
                <div class="form-section-title">Attach Packages (optional)</div>
                <p style="font-size:13px;color:#64748b;margin-bottom:14px;">
                    Select packages from admin's list that apply to this puja. Users will see and choose from these packages when booking.
                </p>

                @php
                    $selectedPkgIds = [];
                    if (isset($puja) && $puja->package_id) {
                        $selectedPkgIds = is_array($puja->package_id)
                            ? $puja->package_id
                            : json_decode($puja->package_id, true) ?? [];
                    }
                @endphp

                <div class="package-grid">
                    @foreach($packages as $pkg)
                    @php $isSelected = in_array($pkg->id, $selectedPkgIds); @endphp
                    <label class="package-card {{ $isSelected ? 'selected' : '' }}" id="pkgCard_{{ $pkg->id }}">
                        <input type="checkbox"
                               name="package_ids[]"
                               value="{{ $pkg->id }}"
                               {{ $isSelected ? 'checked' : '' }}
                               onchange="togglePackageCard(this)">
                        <div class="package-info">
                            <div class="pkg-title">{{ $pkg->title }}</div>
                            <div class="pkg-price">{{ $currency->value ?? '\u20b9' }}{{ number_format($pkg->package_price, 0) }}</div>
                            @if($pkg->person)
                            <div class="pkg-person">For {{ $pkg->person }} person(s)</div>
                            @endif
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- \u2500\u2500 Section 5: Images \u2500\u2500 --}}
            <div class="form-section">
                <div class="form-section-title">Puja Images</div>

                {{-- Existing Images (Edit mode) --}}
                @if(isset($puja) && $puja->puja_images)
                @php
                    $rawImgs  = $puja->getRawOriginal('puja_images');
                    $existingImgs = $rawImgs ? json_decode($rawImgs, true) : [];
                @endphp
                @if(count($existingImgs) > 0)
                <p style="font-size:12px;color:#64748b;margin-bottom:10px;">Current images (click \u2715 to remove):</p>
                <div class="img-preview-grid" id="existingImagesGrid">
                    @foreach($existingImgs as $img)
                    @php
                        $imgUrl = Str::startsWith($img, ['http://','https://']) ? $img : asset($img);
                    @endphp
                    <div class="img-preview-item" id="existing_{{ md5($img) }}">
                        <img src="{{ $imgUrl }}" onerror="this.src='{{ asset('build/assets/images/person.png') }}'">
                        <button type="button" class="img-remove-btn"
                                onclick="removeExistingImg('{{ $img }}', '{{ md5($img) }}')">\u2715</button>
                    </div>
                    @endforeach
                </div>
                @endif
                @endif

                {{-- Upload Zone --}}
                <div class="upload-zone" id="uploadZone" style="margin-top:{{ isset($puja) && count($existingImgs ?? []) > 0 ? '14px' : '0' }}">
                    <input type="file" id="puja_images" name="puja_images[]" multiple accept="image/*">
                    <div class="upload-zone-icon">\ud83d\udcf7</div>
                    <p><strong>Click to upload</strong> or drag & drop images here</p>
                    <span>JPG, PNG, GIF, WEBP \u2014 Max 2MB each</span>
                </div>
                <div class="error-msg" id="err_puja_images"></div>

                {{-- New Image Previews --}}
                <div class="img-preview-grid" id="newImagesGrid"></div>
            </div>

            {{-- \u2500\u2500 Submit \u2500\u2500 --}}
            <div style="display:flex;align-items:center;gap:4px;padding-top:8px;">
                <button type="submit" class="btn-submit" id="submitBtn">
                    <svg width="17" height="17" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                              d="{{ isset($puja) ? 'M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12' : 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z' }}"/>
                    </svg>
                    {{ isset($puja) ? 'Update Puja' : 'Submit Puja' }}
                </button>
                <a href="{{ route('front.puja-list') }}" class="btn-cancel">Cancel</a>
            </div>

        </form>
    </div>{{-- /form-card-body --}}
</div>{{-- /form-card --}}

{{-- \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500 --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

// \u2500\u2500 Package Card Toggle \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
function togglePackageCard(checkbox) {
    const card = checkbox.closest('.package-card');
    card.classList.toggle('selected', checkbox.checked);
}

// \u2500\u2500 Image Upload Preview \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
const newGrid    = document.getElementById('newImagesGrid');
const uploadZone = document.getElementById('uploadZone');

document.getElementById('puja_images').addEventListener('change', function() {
    newGrid.innerHTML = '';
    Array.from(this.files).forEach((file, i) => {
        if (!file.type.match('image.*')) return;
        const reader = new FileReader();
        reader.onload = (e) => {
            const item = document.createElement('div');
            item.className = 'img-preview-item';
            item.innerHTML = `
                <img src="${e.target.result}">
                <button type="button" class="img-remove-btn" onclick="this.parentElement.remove()">\u2715</button>
            `;
            newGrid.appendChild(item);
        };
        reader.readAsDataURL(file);
    });
});

// Drag & drop visual feedback
uploadZone.addEventListener('dragover',  (e) => { e.preventDefault(); uploadZone.classList.add('drag-over'); });
uploadZone.addEventListener('dragleave', ()  => { uploadZone.classList.remove('drag-over'); });
uploadZone.addEventListener('drop',      (e) => { e.preventDefault(); uploadZone.classList.remove('drag-over'); });

// \u2500\u2500 Remove Existing Image \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
function removeExistingImg(path, hash) {
    // Add hidden input so controller knows to delete this
    const inp  = document.createElement('input');
    inp.type   = 'hidden';
    inp.name   = 'images_to_delete[]';
    inp.value  = path;
    document.getElementById('pujaForm').appendChild(inp);

    // Remove preview
    const el = document.getElementById('existing_' + hash);
    if (el) el.remove();
}

// \u2500\u2500 Form Submit \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
$('#pujaForm').on('submit', function(e) {
    e.preventDefault();

    // Clear errors
    document.querySelectorAll('.error-msg').forEach(el => el.textContent = '');
    document.getElementById('toastSuccess').style.display = 'none';
    document.getElementById('toastError').style.display   = 'none';

    const btn = document.getElementById('submitBtn');
    btn.disabled    = true;
    btn.innerHTML   = `
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="spin">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
        </svg>
        Saving...
    `;

    const formData = new FormData(this);

    $.ajax({
        url:         '{{ route("front.store-puja") }}',
        type:        'POST',
        data:        formData,
        contentType: false,
        processData: false,
        success: function(res) {
            if (res.status == 200) {
                const toast    = document.getElementById('toastSuccess');
                toast.style.display = 'flex';
                toast.innerHTML     = `
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    ${res.message} Redirecting...
                `;
                setTimeout(() => window.location.href = '{{ route("front.puja-list") }}', 1800);
            } else {
                showError(res.message || 'Something went wrong.');
                resetBtn();
            }
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.error;
                Object.keys(errors).forEach(key => {
                    const el = document.getElementById('err_' + key);
                    if (el) el.textContent = errors[key][0];
                });
                showError('Please fix the errors above and try again.');
            } else if (xhr.status === 401) {
                showError('Session expired. Please login again.');
                setTimeout(() => window.location.href = '{{ route("front.pujariLogin") }}', 2000);
            } else {
                showError('Server error. Please try again.');
            }
            resetBtn();
        }
    });
});

function showError(msg) {
    const el = document.getElementById('toastError');
    el.style.display = 'flex';
    el.innerHTML = `
        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        ${msg}
    `;
    el.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function resetBtn() {
    const btn = document.getElementById('submitBtn');
    btn.disabled  = false;
    btn.innerHTML = `{{ isset($puja) ? 'Update Puja' : 'Submit Puja' }}`;
}
</script>

{{-- Spinner CSS --}}
<style>
@keyframes spin { to { transform: rotate(360deg); } }
.spin { animation: spin 1s linear infinite; display:inline-block; }
</style>

{{-- Google Maps Autocomplete for Place --}}
@php $googleMapKey = DB::table('systemflag')->where('name', 'googleMapApiKey')->value('value'); @endphp
@if($googleMapKey)
<script src="https://maps.googleapis.com/maps/api/js?key={{ $googleMapKey }}&libraries=places"></script>
<script>
const pujaPlaceEl = document.getElementById('puja_place');
if (pujaPlaceEl) {
    new google.maps.places.Autocomplete(pujaPlaceEl);
}
</script>
@endif

@endsection