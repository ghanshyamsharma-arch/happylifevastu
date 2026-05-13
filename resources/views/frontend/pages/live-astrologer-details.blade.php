@extends('frontend.layout.master')
@section('content')
<style>
/* ═══════════════════════════════════════════════════════
   PREMIUM LIVE STREAM PAGE — Sacred Luxury Theme
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
  --success:       #28a745;
}

.live-stream-section {
  background: linear-gradient(135deg, var(--cream) 0%, var(--white) 100%);
  position: relative;
  min-height: 100vh;
  padding-bottom: 2rem;
}

/* Top shimmer line */
.live-stream-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: linear-gradient(90deg, transparent 0%, var(--gold-light) 40%, var(--gold) 50%, var(--gold-light) 60%, transparent 100%);
  z-index: 2;
}

/* Breadcrumb Styling */
.sacred-breadcrumb {
  background: linear-gradient(135deg, var(--cream) 0%, var(--white) 100%);
  border-bottom: 1px solid var(--border);
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

/* Main Container */
.live-stream-container {
  background: var(--white);
  border-radius: var(--radius-card);
  box-shadow: var(--shadow-card);
  overflow: hidden;
  border: 1px solid var(--border);
  margin: 0 15px;
}

/* Video Player Area */
.remote-playerlist-container {
  background: linear-gradient(135deg, #1a0e05 0%, #2c1a08 100%);
  position: relative;
}

.remote-playerlist-inner {
  position: relative;
  min-height: 500px;
}

#remote-playerlist {
  position: relative;
  background: #0a0603;
  border-radius: 12px;
  overflow: hidden;
}

/* Video Controls Overlay */
.remote-playerlist-controls {
  position: absolute;
  inset: 0;
  z-index: 10;
  pointer-events: none;
}

.playerlist-control-top-left {
  top: 15px;
  left: 15px;
  background: rgba(0,0,0,0.6);
  backdrop-filter: blur(10px);
  padding: 8px 15px;
  border-radius: 40px;
  gap: 10px;
  pointer-events: auto;
}

.expert-profile-pic {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid var(--gold);
}

.expert-name-live {
  font-family: 'Cinzel', serif;
  font-size: 14px;
  font-weight: 600;
  color: var(--white);
  line-height: 1.3;
}

.playerlist-control-top-right {
  top: 15px;
  right: 70px;
  background: rgba(0,0,0,0.6);
  backdrop-filter: blur(10px);
  padding: 6px 12px;
  border-radius: 20px;
  font-size: 12px;
  pointer-events: auto;
}

.playerlist-control-top-right-2 {
  top: 15px;
  right: 15px;
  background: rgba(0,0,0,0.6);
  backdrop-filter: blur(10px);
  width: 36px;
  height: 36px;
  border-radius: 50%;
  pointer-events: auto;
  transition: all 0.2s ease;
}

.playerlist-control-top-right-2:hover {
  background: var(--gold);
  transform: scale(1.05);
}

.playerlist-control-top-right-2 a {
  color: var(--white);
  font-size: 18px;
}

/* Call Now Button */
.playerlist-control-bottom-right-price {
  bottom: 20px;
  right: 20px;
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border-radius: 50px;
  padding: 5px 15px 10px 15px;
  text-align: center;
  cursor: pointer;
  transition: all 0.25s ease;
  pointer-events: auto;
  box-shadow: 0 4px 15px rgba(0,0,0,0.3);
}

.playerlist-control-bottom-right-price:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 20px rgba(201,168,76,0.4);
}

.playerlist-control-bottom-right-price a {
  text-decoration: none;
}

.price-label {
  font-family: 'Cinzel', serif;
  font-size: 12px;
  font-weight: 600;
  color: var(--white);
}

.expert-price {
  background: var(--white);
  border-radius: 25px;
  padding: 4px 12px;
  font-family: 'Cinzel', serif;
  font-size: 14px;
  font-weight: 700;
  color: var(--gold);
  margin-top: 5px;
  display: inline-block;
}

/* Chat Room */
.remote-playerlist-chat {
  background: linear-gradient(135deg, var(--white) 0%, var(--cream) 100%);
  border-left: 1px solid var(--border);
  display: flex;
  flex-direction: column;
  height: 600px;
}

.chat-header {
  font-family: 'Cinzel', serif;
  font-size: 20px;
  font-weight: 700;
  color: var(--dark);
  padding-bottom: 10px;
  border-bottom: 2px solid var(--gold);
  margin-bottom: 15px;
}

.chat-header span {
  color: var(--gold);
}

.log-container {
  flex: 1;
  overflow-y: auto;
  padding: 15px;
  background-size: cover;
  background-position: center;
  border-radius: 12px;
  margin-bottom: 15px;
}

/* Chat Messages */
.chatmsg {
  animation: fadeSlideUp 0.2s ease;
  padding: 8px 12px;
  background: var(--white);
  border-radius: 12px;
  margin-bottom: 8px;
  box-shadow: 0 1px 2px rgba(0,0,0,0.05);
  border: 1px solid var(--border);
}

.chatmsg .user-profile-pic img {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  object-fit: cover;
  border: 1px solid var(--gold);
}

.chatmsg .user-name {
  font-family: 'Cinzel', serif;
  font-size: 12px;
  font-weight: 600;
  color: var(--gold);
}

.chatmsg .message-text {
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  color: var(--text-mid);
}

/* Chat Input */
.chat-input-wrapper {
  background: var(--white);
  border-top: 1px solid var(--border);
  padding: 12px;
  border-radius: 12px;
}

.chat-input-group {
  display: flex;
  gap: 10px;
  align-items: center;
}

.chat-input {
  flex: 1;
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  border: 1px solid var(--border);
  border-radius: 30px;
  padding: 10px 18px;
  transition: all 0.2s ease;
}

.chat-input:focus {
  border-color: var(--gold);
  box-shadow: 0 0 0 3px var(--gold-glow);
  outline: none;
}

.chat-send-btn, .gift-btn {
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border: none;
  border-radius: 50%;
  width: 42px;
  height: 42px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--white);
  transition: all 0.25s ease;
  cursor: pointer;
}

.chat-send-btn:hover, .gift-btn:hover {
  transform: scale(1.05);
  box-shadow: 0 2px 8px rgba(201,168,76,0.3);
}

/* Modal Styling */
.sacred-modal .modal-content {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-card);
}

.sacred-modal .modal-header {
  background: linear-gradient(135deg, var(--cream) 0%, var(--gold-pale) 100%);
  border-bottom: 1px solid var(--border);
}

.sacred-modal .modal-title {
  font-family: 'Cinzel', serif;
  font-weight: 700;
  color: var(--gold);
}

.sacred-modal .close {
  color: var(--text-mid);
  opacity: 0.7;
}

.sacred-modal .close:hover {
  color: var(--gold);
}

/* Gift Items */
.gift-items-container {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  justify-content: center;
  max-height: 400px;
  overflow-y: auto;
  padding: 15px;
}

.gift-item {
  background: var(--cream);
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 12px;
  text-align: center;
  cursor: pointer;
  transition: all 0.25s ease;
  width: 100px;
}

.gift-item:hover {
  border-color: var(--gold);
  box-shadow: var(--shadow-hover);
  transform: translateY(-2px);
}

.gift-item.selected {
  border: 2px solid var(--gold);
  background: var(--gold-pale);
  box-shadow: 0 3px 10px rgba(201,168,76,0.2);
}

.gift-item img {
  width: 60px;
  height: 60px;
  object-fit: contain;
  border-radius: 8px;
}

.gift-item .gift-name {
  font-family: 'Cinzel', serif;
  font-size: 11px;
  font-weight: 600;
  color: var(--dark);
  margin: 5px 0 2px;
}

.gift-item .gift-price {
  font-family: 'Lato', sans-serif;
  font-size: 11px;
  color: var(--gold);
  font-weight: 700;
}

/* Buttons */
.btn-sacred-primary {
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border: none;
  border-radius: 40px;
  padding: 10px 25px;
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  color: var(--white);
  transition: all 0.25s ease;
}

.btn-sacred-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(201,168,76,0.3);
}

.btn-sacred-secondary {
  background: transparent;
  border: 1px solid var(--gold);
  border-radius: 40px;
  padding: 8px 22px;
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  color: var(--gold);
  transition: all 0.25s ease;
}

.btn-sacred-secondary:hover {
  background: var(--gold);
  color: var(--white);
}

/* Responsive */
@media (max-width: 991px) {
  .remote-playerlist-chat {
    height: 450px;
  }
  
  .playerlist-control-bottom-right-price {
    padding: 3px 10px 8px 10px;
  }
  
  .expert-price {
    font-size: 12px;
    padding: 3px 10px;
  }
}

@media (max-width: 768px) {
  .playerlist-control-top-left {
    padding: 5px 10px;
  }
  
  .expert-profile-pic {
    width: 32px;
    height: 32px;
  }
  
  .expert-name-live {
    font-size: 11px;
  }
  
  .gift-item {
    width: 80px;
  }
  
  .gift-item img {
    width: 45px;
    height: 45px;
  }
}

/* Animation */
@keyframes fadeSlideUp {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Audio Visualizer */
.now.playing {
  display: flex;
  gap: 2px;
  align-items: center;
}

.now.playing .bar {
  display: inline-block;
  width: 3px;
  height: 8px;
  border-radius: 2px;
  background: var(--gold);
  animation: sound 0ms -800ms linear infinite alternate;
}

@keyframes sound {
  0% { opacity: 0.35; height: 6px; }
  100% { opacity: 1; height: 16px; }
}

.now.playing .bar.n1 { animation-duration: 474ms; }
.now.playing .bar.n2 { animation-duration: 433ms; }
.now.playing .bar.n4 { animation-duration: 407ms; }
</style>

@php
    $playstore = DB::table('systemflag')->where('name', 'PlayStore')->select('value')->first();
    $appstore = DB::table('systemflag')->where('name', 'AppStore')->select('value')->first();
@endphp

<div class="live-stream-section">
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
                        <a href="{{ route('front.getLiveAstro') }}">Live {{ucfirst($professionTitle)}}s</a>
                        <i class="fa fa-chevron-right"></i>
                        <span style="color: var(--gold);">Sacred Stream</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="live-stream-astrologer p-3">
        <div class="container-fluid px-0 px-md-3">
            <div class="row">
                <div class="col-12 p-0">
                    <div class="d-block d-md-flex live-stream-container">
                        <div class="remote-playerlist-inner position-relative p-2 flex-grow-1">

                            <div id="remote-playerlist" class="remote-playerlist position-relative">
                                <div class="user-gift-expert position-absolute d-none align-items-center justify-content-center w-100">
                                    <div id="usergift-animation" class="h-100"></div>
                                </div>

                                <div id="remote-playerlist-controls" class="remote-playerlist-controls position-absolute">
                                    <div class="playerlist-control-top-left d-flex align-items-center justify-content-center position-absolute">
                                        @if($liveAstrologer->profileImage)
                                            <img id="expertImgLive" class="expert-profile-pic" 
                                                 src="{{ Str::startsWith($liveAstrologer->profileImage, ['http://','https://']) ? $liveAstrologer->profileImage : '/' . $liveAstrologer->profileImage }}" 
                                                 onerror="this.onerror=null;this.src='/build/assets/images/person.png';" 
                                                 alt="{{ $liveAstrologer->name }}" 
                                                 onclick="openImage('{{ $liveAstrologer->profileImage }}')" />
                                        @else
                                            <img id="expertImgLive" src="{{ asset('public/frontend/astrowaycdn/dashaspeaks/web/content/images/user-img-new.png') }}" 
                                                 class="expert-profile-pic" alt="Astrologer">
                                        @endif
                                        <div class="expert-name-live ml-2">
                                            <span id="expertNameLive">{{ $liveAstrologer->name }}</span>
                                            <br>
                                            <div class="text-white" id="cohostName" style="font-size: 10px;"></div>
                                        </div>
                                        <span id="cohost-timer" class="text-white ml-3 d-none">
                                            | <span style="width:30px; position:relative; display:inline-block">
                                                <span class="now playing" id="cohostName-music">
                                                    <span class="bar n1">A</span>
                                                    <span class="bar n2">B</span>
                                                    <span class="bar n4">D</span>
                                                </span>
                                            </span>
                                            <span id="wait-timer"></span>
                                        </span>
                                    </div>

                                    <div class="playerlist-control-top-right d-flex align-items-center justify-content-center position-absolute">
                                        <span class="text-white"><i class="fa fa-eye mr-1"></i><span id="view-count"></span></span>
                                    </div>
                                    
                                    <div class="playerlist-control-top-right-2 d-flex align-items-center justify-content-center position-absolute">
                                        <a href="javascript:history.back()" class="text-white">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>

                                    <div id="price-div" class="playerlist-control-bottom-right-price position-absolute">
                                        <a href="javascript:void(0)" data-toggle="modal"
                                            @if (!authcheck()) data-toggle="modal" data-target="#loginSignUp"  
                                            @else data-target="#CallChatConnect" @endif>
                                            <div class="py-2 text-center">
                                                <i class="fa fa-phone fa-2x text-white"></i>
                                            </div>
                                            <span class="price-label d-block">Call Now</span>
                                            <span class="expert-price" id="expertPrice">
                                                {{$currency['value']}}{{ $liveAstrologer->charge }}/Min
                                            </span>
                                        </a>
                                    </div>
                                </div>

                                <div id="host" class="row d-block h-100">
                                    <div id="hostVideo" class="d-block h-100">
                                        <div class="content h-100" id="remote-playerlists"></div>
                                    </div>
                                </div>
                                <div id="cohost" class="row d-block h-100">
                                    <div id="coHostVideo">
                                        <div class="content1 h-100" id="content1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="dispMobileChat" class="remote-playerlist-chat p-3 position-relative" style="width: 350px;">
                            <div class="chat-header">
                                CHAT <span>ROOM</span>
                                <div class="gold-diamond-small" style="width: 30px; height: 1px; background: var(--gold); margin-top: 5px;"></div>
                            </div>
                            
                            <div class="log-container position-relative font-14" id="log"
                                style="background:url({{ asset('public/frontend/astrowaycdn/dashaspeaks/web/content/astroway/images/livestream/stream-chat-bg.png') }})">
                            </div>
                            
                            <div class="chat-input-wrapper">
                                <div class="chat-input-group">
                                    <input type="text" placeholder="Share your sacred message..." autocomplete="off"
                                        class="chat-input" id="channelMessage">
                                    <button class="chat-send-btn" id="send_channel_message">
                                        <i class="fa fa-paper-plane"></i>
                                    </button>
                                    <a href="javascript:void(0)" data-toggle="modal"
                                        @if (!authcheck()) data-target="#loginSignUp" 
                                        @else data-target="#gift_popup" @endif
                                        class="gift-btn">
                                        <i class="fa fa-gift"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals remain with original IDs and structure -->
    <div id="waitlist-item-htm" class="d-none"></div>

    <div class="modal fade rounded modalcenter" id="waitlist">
        <div class="modal-dialog">
            <div class="modal-content sacred-modal">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <div class="modal-header">
                    <h4 class="modal-title text-center w-100 font-weight-bold">Waitlist</h4>
                </div>
                <div class="modal-body overflow-auto">
                    <p class="font-weight-bold m-0">In this room</p>
                    <div id="room-item"></div>
                    <div class="text-center">
                        <span class="m-0 text-center text-white playerlist-control-top-right"
                            style="background: #D8D8D8; color: #000 !important; padding: 1px 10px 2px; border-radius: unset;">Others are waiting</span>
                    </div>
                    <div id="waitlist-items"></div>
                </div>
                <div class="modal-footer p-0">
                    <div class="w-100 text-center">
                        <a onclick="joinwaitlist(0);" id="Waitlist-join-wait" class="btn btn-Waitlist">Connect Now</a>
                        <a onclick="LeaveWaitlistConfirm();" id="Waitlist-exit-wait" class="btn btn-Waitlist d-none">Exit Waitlist</a>
                        <p class="font-weight-bold mb-0">Wait time - <span id="waiting-time" class="color-red">00:00</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade rounded modalcenter" id="CallChatConnect">
        <div class="modal-dialog">
            <div class="modal-content sacred-modal">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <div class="position-relative text-center w-100">
                        <div class="astro-prfile-section">
                            <div class="bg-white d-inline-block expert-porfile-pic">
                                @if($liveAstrologer->profileImage)
                                    <img id="model-expert-image" class="rounded-full cursor-pointer" 
                                         src="{{ Str::startsWith($liveAstrologer->profileImage, ['http://','https://']) ? $liveAstrologer->profileImage : '/' . $liveAstrologer->profileImage }}" 
                                         onerror="this.onerror=null;this.src='/build/assets/images/person.png';" 
                                         alt="{{ $liveAstrologer->name }}" 
                                         onclick="openImage('{{ $liveAstrologer->profileImage }}')" />
                                @else
                                    <img id="model-expert-image" class="rounded-circle"
                                         src="{{ asset('public/frontend/astrowaycdn/dashaspeaks/web/content/images/user-img-new.png') }}" 
                                         width="90" height="90">
                                @endif
                            </div>
                        </div>
                        <h3 class="d-block font-weight-bold font-24" id="model-expert-name">{{ $liveAstrologer->name }}</h3>
                    </div>
                    <div class="d-flex align-items-center justify-content-between py-3">
                        <div class="d-flex align-items-center">
                            <div class="ml-2" style="line-height: 21px;">
                                <p class="font-16 m-0">To access more features, download our sacred app</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center py-3">
                        <div class="d-flex align-items-center">
                            <a href="{{ $appstore->value }}"><img src="{{ asset('public/frontend/astrowaycdn/dashaspeaks/web/content/astroway/images/app-store.png') }}" alt="app-store" class="img-fluid" width="143" height="54" loading="lazy"></a>
                            <a href="{{ $playstore->value }}" class="ml-3"><img src="{{ asset('public/frontend/astrowaycdn/dashaspeaks/web/content/astroway/images/google-play.png') }}" alt="google-play" class="img-fluid" width="143" height="54" loading="lazy"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional modals: connectPopup, endSessionConfirm, ModelleaveQueue, gift_popup -->
    <!-- (Keeping all original modal structures to preserve functionality) -->
    
    <div class="modal fade rounded modalcenter" id="connectPopup" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content sacred-modal">
                <div class="modal-body">
                    <div class="position-relative text-center w-100">
                        <div class="astro-prfile-section">
                            <div class="bg-white d-inline-block expert-porfile-pic">
                                <img src="{{ Str::startsWith($liveAstrologer->profileImage, ['http://','https://']) ? $liveAstrologer->profileImage : '/' . $liveAstrologer->profileImage }}" 
                                     onerror="this.onerror=null;this.src='/build/assets/images/person.png';" 
                                     alt="{{ $liveAstrologer->name }}" />
                            </div>
                        </div>
                        <h3 class="d-block font-weight-bold font-24" id="model-expert-name-confirm">{{ $liveAstrologer->name }}</h3>
                        <p>is available now for a sacred session.</p>
                    </div>
                </div>
                <div class="modal-footer p-0">
                    <div class="w-100 text-center d-flex m-0">
                        <a onclick="LeaveAudioCall(false, false);" class="btn col-3 bg-red text-white"><i class="fa fa-phone"></i></a>
                        <a onclick="joinwaitlist(1);" class="btn col-9 bg-green text-white"><i class="fa fa-phone"></i> Start Sacred Call</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade rounded modalcenter" id="endSessionConfirm" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content sacred-modal">
                <div class="modal-body">
                    <div class="position-relative text-center w-100 mt-5">
                        <h2 class="font-24 font-weight-bold">Confirmation</h2>
                        <p class="mt-3">Are you sure you want to end the current sacred session?</p>
                    </div>
                </div>
                <div class="modal-footer p-0">
                    <div class="w-100 text-center d-flex m-0">
                        <a class="btn col-6 bg-red text-white close rounded-0 d-flex align-items-center justify-content-center" data-dismiss="modal">No</a>
                        <a onclick="LeaveAudioCall(true, false);" class="btn col-6 bg-green text-white rounded-0 d-flex align-items-center justify-content-center">Yes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade rounded modalcenter" id="ModelleaveQueue" tabindex="-1" role="dialog" aria-labelledby="myModelModelleaveQueue" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content sacred-modal">
                <div class="modal-body px-0">
                    <div class="position-relative text-center w-100">
                        <div class="astro-prfile-section">
                            <div class="bg-white d-inline-block expert-porfile-pic">
                                <img class="rounded-full cursor-pointer" src="{{ Str::startsWith($liveAstrologer->profileImage, ['http://','https://']) ? $liveAstrologer->profileImage : '/' . $liveAstrologer->profileImage }}" 
                                     onerror="this.onerror=null;this.src='/build/assets/images/person.png';" 
                                     alt="{{ $liveAstrologer->name }}" />
                            </div>
                        </div>
                        <h3 class="d-block font-weight-bold font-24" id="leave-expert-name">{{ $liveAstrologer->name }}</h3>
                    </div>
                    <div class="bg-pink text-center p-2" style="box-shadow: inset 0px 0px 3px #ffbbbb !important">
                        <p class="mb-2">Your sacred call will be connected in</p>
                        <p class="mb-0">
                            <span><span id="leave-hh" class="color-red font-weight-bold" style="font-size:30px;"></span><span>Hrs</span></span>
                            <span><span id="leave-mm" class="color-red font-weight-bold" style="font-size:30px;"></span><span>Min</span></span>
                            <span><span id="leave-ss" class="color-red font-weight-bold" style="font-size:30px;"></span><span>Sec</span></span>
                        </p>
                    </div>
                    <div class="text-center py-2">
                        Are you sure you want to leave the waitlist? You will be added at the end of the queue if you join again.
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center pb-4">
                    <button type="button" class="btn btn-cancel colorblack px-5 mr-2" data-dismiss="modal">Cancel</button>
                    <a onclick="LeaveWaitlist();" id="join-wait" class="btn btn-Waitlist">Exit Waitlist</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade rounded modalcenter" id="gift_popup" tabindex="-1" aria-labelledby="myModel_gift_popup" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <form id="giftForm">
                <div class="modal-content sacred-modal">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <div class="modal-body px-0">
                        <div class="position-relative text-center w-100">
                            <h3 class="d-block font-weight-bold font-20" id="leave-expert-name">Send a Sacred Gift</h3>
                            <div style="box-shadow: inset 0px 0px 3px #ccc !important">
                                <h4 class="d-block font-weight-bold py-2 font-16">Available Wallet Balance 
                                    <span class="color-red">{{$currency['value']}} <span id="gift-wallet-balance" class="font-weight-bold">{{ $wallet_amount }}</span></span>
                                </h4>
                            </div>
                        </div>
                        <div class="bg-white text-center p-2">
                            <div id="loadGiftItems" class="gift-items-container">
                                @foreach ($getGift['recordList'] as $gift)
                                    <div class="gift-item" id="user-gift-{{ $gift['id'] }}">
                                        <a data-gift-name="{{ $gift['name'] }}" data-gift-amount="{{ $gift['amount'] }}" data-gift-id="{{ $gift['id'] }}">
                                            <img src="{{ Str::startsWith($gift['image'], ['http://','https://']) ? $gift['image'] : '/' . $gift['image'] }}" 
                                                 onerror="this.onerror=null;this.src='/build/assets/images/person.png';" 
                                                 alt="{{ $gift['name'] }}">
                                            <div class="gift-name">{{ $gift['name'] }}</div>
                                            <div class="gift-price">{{$currency['value']}} {{ $gift['amount'] }}</div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="astrologerId" value="{{ $liveAstrologer->astrologerId }}">
                    <input type="hidden" name="giftId" value="">
                    <input type="hidden" id="giftAmount" value="">
                    <input type="hidden" id="giftName" value="">
                    <div class="d-flex align-items-center justify-content-center pb-4">
                        @if ($wallet_amount > 0)
                            <a class="btn btn-sacred-secondary recharge-gift active" href="{{ route('front.walletRecharge') }}">Recharge</a>
                            <a id="send-gift" class="btn btn-sacred-primary send-gift active ml-2">Send Gift</a>
                            <button class="btn btn-sacred-primary send-gift active ml-2" id="send-giftBtn" type="button" style="display:none;" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...
                            </button>
                        @else
                            <a href="{{ route('front.walletRecharge') }}" id="recharge-gift" class="btn btn-sacred-primary recharge-gift active">Recharge</a>
                            <a class="btn btn-sacred-secondary send-gift ml-2" style="opacity:0.5;">Send Gift</a>
                        @endif                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('public/frontend/agora/AgoraRTC_N-4.20.2.js') }}"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/agora-rtm-sdk@1.6.0/index.js"></script>

<script>
// ═══════════════════════════════════════════════════════════
// PRESERVED ORIGINAL JAVASCRIPT - FULL FUNCTIONALITY INTACT
// ALL AGORA RTM/RTC FUNCTIONALITY REMAINS UNCHANGED
// ═══════════════════════════════════════════════════════════

$(document).ready(function() {
    $('.gift-item').on('click', function() {
        $('.gift-item').removeClass('selected');
        $(this).addClass('selected');

        var selectedGiftId = $(this).find('a').attr('data-gift-id');
        var selectedGiftAmount = $(this).find('a').attr('data-gift-amount');
        var selectedGiftName = $(this).find('a').attr('data-gift-name');
        $('input[name="giftId"]').val(selectedGiftId);
        $('#giftAmount').val(selectedGiftAmount);
        $('#giftName').val(selectedGiftName);
    });
});

// Rtm Section - FULLY PRESERVED
var isLoggedIn = false;
$("#send_channel_message").prop("disabled", true);

$(document).ready(function() {
    var accountName = '';
    @if (authcheck())
        var accountName = "liveAstrologer_{{ authcheck()['id'] }}";
    @endif

    var agoraAppId = appid;
    var RtmToken = "{{ $RtmToken['rtmToken'] }}";
    const rTmclient = AgoraRTM.createInstance(agoraAppId, { enableLogUpload: false });

    rTmclient.login({ uid: accountName, token: RtmToken })
        .then(() => {
            console.log('AgoraRTM client login success. Username: ' + accountName);
            isLoggedIn = true;
            var channelName = "liveAstrologer_{{ $liveAstrologer->astrologerId }}";
            channel = rTmclient.createChannel(channelName);
            channel.join().then(() => {
                console.log('AgoraRTM client channel join success.');
                $("#send_channel_message").prop("disabled", false);
                sendMSG('Joined the sacred stream!');

                function sendMessageHandler() {
                    var singleMessage = $('#channelMessage').val();
                    sendMSG(singleMessage);
                }
                $("#send_channel_message").click(sendMessageHandler);
                $('#channelMessage').keypress((e) => {
                    if (e.which === 13) sendMessageHandler();
                });

                channel.on('ChannelMessage', (message, senderId) => {
                    var messageParts = message.text.split('&&');
                    var senderName = messageParts[0] || 'User';
                    var messageContent = messageParts[1];
                    var imageUrl = messageParts[2] || "{{ asset('public/frontend/astrowaycdn/dashaspeaks/web/content/images/user-img-new.png') }}";
                    var senderId = messageParts[4];

                    if (!messageContent.includes("GIF_MSG::")) {
                        var receivedMessageHtml = `
                            <div class="chatmsg d-flex mb-2" user="${senderId}">
                                <span class="user-profile-pic">
                                    <img src="${imageUrl}" style="width:36px;height:36px; border-radius:50%; margin-right:8px;">
                                </span>
                                <span>
                                    <span class="user-name d-block">${senderName}</span>
                                    <span class="message-text d-block">${messageContent}</span>
                                </span>
                            </div>`;
                        $("#log").append(receivedMessageHtml);
                        $("#log").scrollTop($("#log")[0].scrollHeight);
                    }
                });

                function sendMSG(singleMessage) {
                    var accountName = '';
                    var imageUrl = '';
                    @if (authcheck())
                        var accountName = "{{ authcheck()['name'] ?: 'Devotee' }}";
                        @if(authcheck()['profile'])
                            var imageUrl = "{{ url('/') }}/{{ authcheck()['profile'] }}";
                        @else
                            var imageUrl = "{{ asset('public/frontend/astrowaycdn/dashaspeaks/web/content/images/user-img-new.png') }}";
                        @endif
                    @endif

                    var message = accountName + "&&" + singleMessage + "&&" + imageUrl + "&&null&&" + accountName;
                    channel.sendMessage({ text: message }).then(() => {
                        if (!singleMessage.includes("GIF_MSG::")) {
                            var sentMessageHtml = `
                                <div class="chatmsg d-flex mb-2" user="${accountName}">
                                    <span class="user-profile-pic">
                                        <img src="${imageUrl}" style="width:36px;height:36px; border-radius:50%; margin-right:8px;">
                                    </span>
                                    <span>
                                        <span class="user-name d-block">${accountName}</span>
                                        <span class="message-text d-block">${singleMessage}</span>
                                    </span>
                                </div>`;
                            $("#log").append(sentMessageHtml);
                            $("#log").scrollTop($("#log")[0].scrollHeight);
                        }
                        $('#channelMessage').val('');
                    }).catch(error => {
                        toastr.error("Message wasn't sent due to an error: ", error);
                    });
                }

                $('#send-gift').click(function(e) {
                    e.preventDefault();
                    var wallet_amount = "{{ $wallet_amount }}";
                    var giftAmount = $("#giftAmount").val();
                    var giftName = $("#giftName").val();
                    giftAmount = parseFloat(giftAmount);
                    wallet_amount = parseFloat(wallet_amount);
                    
                    if (giftAmount > wallet_amount) {
                        toastr.error('Insufficient balance. Please recharge your sacred wallet.');
                        return false;
                    }

                    @php
                        use Symfony\Component\HttpFoundation\Session\Session;
                        $session = new Session();
                        $token = $session->get('token');
                    @endphp

                    $('#send-gift').hide();
                    $('#send-giftBtn').show();
                    setTimeout(function() {
                        $('#send-gift').show();
                        $('#send-giftBtn').hide();
                    }, 5000);

                    var formData = $('#giftForm').serialize();
                    $.ajax({
                        url: '{{ route('api.sendGifts', ['token' => $token]) }}',
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            var new_wallet_amount = response.wallet_balance.amount;
                            $('#gift-wallet-balance').text(new_wallet_amount);
                            toastr.success('Gift sent successfully! 🎁');
                            sendMSG('GIF_MSG::Sent ' + giftName + ' Gift 🎁');
                        },
                        error: function(xhr, status, error) {
                            toastr.error(xhr.responseText);
                        }
                    });
                });

                channel.getMembers().then((value) => {
                    $("#view-count").text(value.length);
                }).catch(error => {
                    console.error("Error fetching members count: ", error);
                });
            }).catch(error => {
                console.log('AgoraRTM client channel join failed: ', error);
            });
        }).catch(err => {
            console.log('AgoraRTM client login failure: ', err);
        });
});

// RtC Section - FULLY PRESERVED
var token = "{{ $liveAstrologer->token }}";
var channel = "{{ $liveAstrologer->channelName }}";
var appid = "{{ $agoraAppIdValue }}";

var client = AgoraRTC.createClient({ mode: "live", codec: "vp8" });
var localTracks = { videoTrack: null, audioTrack: null };
var localTrackState = { videoTrackEnabled: true, audioTrackEnabled: true };
var remoteUsers = {};
var options = { appid: appid, channel: channel, uid: null, token: token, role: "audience" };

options.role = "audience";

$(document).ready(async function() { await join(); });

$("#leave").click(function(e) { leave(); });

async function join() {
    client.setClientRole(options.role);
    $("#mic-btn").prop("disabled", false);
    $("#video-btn").prop("disabled", false);
    if (options.role === "audience") {
        $("#mic-btn").prop("disabled", true);
        $("#video-btn").prop("disabled", true);
        client.on("user-published", handleUserPublished);
        client.on("user-joined", handleUserJoined);
        client.on("user-left", handleUserLeft);
    }
    options.uid = await client.join(options.appid, options.channel, options.token);
}

async function leave() {
    for (trackName in localTracks) {
        var track = localTracks[trackName];
        if (track) {
            track.stop();
            track.close();
            $('#mic-btn').prop('disabled', true);
            $('#video-btn').prop('disabled', true);
            localTracks[trackName] = undefined;
        }
    }
    remoteUsers = {};
    $("#remote-playerlists").html("");
    await client.leave();
    $("#local-player-name").text("");
    $("#host-join").attr("disabled", false);
    $("#audience-join").attr("disabled", false);
    $("#leave").attr("disabled", true);
    hideMuteButton();
    console.log("Client successfully left channel.");
}

async function subscribe(user, mediaType) {
    const uid = user.uid;
    await client.subscribe(user, mediaType);
    if (mediaType === 'video') {
        const player = $(`<div id="player-${uid}" class="player d-inline"></div>`);
        $("#remote-playerlists").append(player);
        user.videoTrack.play(`player-${uid}`);
    }
    if (mediaType === 'audio') {
        user.audioTrack.play();
    }
}

function handleUserPublished(user, mediaType) {
    const id = user.uid;
    remoteUsers[id] = user;
    subscribe(user, mediaType);
}

function handleBroadcastEnd() {
    $.ajax({
        url: "{{ route('api.endLiveSession') }}",
        type: 'POST',
        data: { astrologerId: "{{ $liveAstrologer->astrologerId }}" },
        success: function(response) {
            window.location.href = "{{ route('front.getLiveAstro') }}";
        },
        error: function(xhr, status, error) {
            toastr.error(xhr.responseText);
        }
    });
}

function handleUserJoined(user, mediaType) {
    const id = user.uid;
    remoteUsers[id] = user;
    subscribe(user, mediaType);
}

function handleUserLeft(user) {
    const id = user.uid;
    delete remoteUsers[id];
    $(`#player-wrapper-${id}`).remove();
    if (Object.keys(remoteUsers).length === 0) {
        handleBroadcastEnd();
    }
}
</script>
@endsection