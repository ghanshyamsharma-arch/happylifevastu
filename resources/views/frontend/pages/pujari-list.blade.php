@extends('frontend.layout.master')
@section('content')

{{-- Breadcrumb --}}
<div class="pt-1 pb-1 bg-red d-none d-md-block astroway-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex align-items-center">
                <span class="text-white breadcrumbs">
                    <a href="{{ route('front.home') }}" style="color:white;text-decoration:none">
                        <i class="fa fa-home font-18"></i>
                    </a>
                    <i class="fa fa-chevron-right"></i>
                    <span style="color:white;">Our Pujaris</span>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="ds-head-populararticle bg-white">
    <div class="container py-4">

        {{-- Heading --}}
        <div class="col-12 mb-3">
            <h1 class="h2 font-weight-bold colorblack">
                Our <span class="color-red">Pujaris</span>
            </h1>
            <p class="text-muted">Book expert pujaris for all your spiritual and religious needs</p>
        </div>

        {{-- Search Bar --}}
        <form method="GET" action="{{ route('front.pujariList') }}" class="mb-4">
            <div class="row">
                <div class="col-md-5 col-10">
                    <div class="input-group shadow-sm rounded-pill overflow-hidden border" style="border-color:#ee4e5e !important;">
                        <input type="text" name="search"
                            class="form-control border-0 shadow-none px-3"
                            placeholder="Search by name or skill..."
                            value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-chat px-4 rounded-0" type="submit" style="border-radius:0 50px 50px 0 !important;">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- Pujari Cards Grid --}}
        <div class="row">
            @forelse($pujaris as $pujari)
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-4">
                <div class="card border-0 h-100 shadow-sm"
                     style="border-radius:12px; transition:transform 0.25s, box-shadow 0.25s;"
                     onmouseenter="this.style.transform='translateY(-6px)';this.style.boxShadow='0 8px 24px rgba(238,78,94,0.18)';"
                     onmouseleave="this.style.transform='translateY(0)';this.style.boxShadow='';">

                    {{-- Top strip --}}
                    <div style="background: linear-gradient(135deg,#ee4e5e,#c0392b); height:6px; border-radius:12px 12px 0 0;"></div>

                    <div class="card-body text-center p-3">

                        {{-- Profile Image --}}
                        <div class="mb-2" style="position:relative;display:inline-block;">
                            <img src="{{ $pujari->profileImage ? (Str::startsWith($pujari->profileImage,'http') ? $pujari->profileImage : str_replace('storage/','public/storage/',asset($pujari->profileImage))) : '/build/assets/images/person.png' }}"
                                 onerror="this.src='{{ asset('build/assets/images/person.png') }}'"
                                 class="rounded-circle"
                                 style="width:85px;height:85px;object-fit:cover;border:3px solid #ee4e5e;">
                        </div>

                        {{-- Name --}}
                        <h5 class="font-weight-bold mb-1 colorblack" style="font-size:15px;">
                            {{ $pujari->name }}
                        </h5>

                        {{-- Primary Skill --}}
                        <p class="text-muted mb-1" style="font-size:12px;">
                            <i class="fa fa-pray color-red me-1"></i>
                            {{ Str::limit($pujari->primarySkill, 45) }}
                        </p>

                        {{-- Experience & Language --}}
                        <div class="d-flex justify-content-center gap-2 mb-2" style="font-size:11px;color:#888;gap:8px;">
                            @if($pujari->experienceInYears)
                            <span><i class="fa fa-briefcase color-red me-1"></i> {{ $pujari->experienceInYears }} Yrs</span>
                            @endif
                            
                        </div>

                        {{-- Rate --}}
                        <div class="mb-3">
                            <!--<span class="font-weight-bold color-red" style="font-size:14px;">-->
                            <!--    @if(isset($walletType) && $walletType == 'coin')-->
                            <!--        <img src="{{ asset($coinIcon) }}" alt="coin" width="14">-->
                            <!--    @else-->
                            <!--        {{ $currency->value ?? '₹' }}-->
                            <!--    @endif-->
                            <!--    {{ number_format($pujari->reportRate, 0) }}-->
                            <!--    <small class="text-muted font-weight-normal" style="font-size:11px;">/session</small>-->
                            <!--</span>-->
                            <span><i class="fa fa-language color-red me-1"></i> {{ Str::limit($pujari->languageKnown, 20) }}</span>
                        </div>

                        @if(!empty($pujari->slug))
                            <a href="{{ route('front.pujariDetails', $pujari->slug) }}"
                               class="btn btn-chat btn-block"
                               style="font-size:13px;border-radius:30px;">
                                View Profile
                            </a>
                        @else
                            <a href="javascript:void(0)"
                               class="btn btn-secondary btn-block"
                               style="font-size:13px;border-radius:30px;opacity:.6;cursor:not-allowed;">
                                Profile Unavailable
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fa fa-user-circle fa-5x text-muted mb-3 d-block"></i>
                <h5 class="text-muted">No Pujaris Found</h5>
                @if(request('search'))
                    <p class="text-muted">Try searching with a different keyword</p>
                    <a href="{{ route('front.pujariList') }}" class="btn btn-chat mt-2">Clear Search</a>
                @endif
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($pujaris->lastPage() > 1)
        <div class="d-flex justify-content-center mt-4">
            {{ $pujaris->appends(request()->query())->links() }}
        </div>
        @endif

    </div>
</div>

@endsection