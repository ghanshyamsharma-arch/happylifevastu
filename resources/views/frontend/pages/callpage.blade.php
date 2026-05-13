@extends('frontend.layout.master')
@php
use Symfony\Component\HttpFoundation\Session\Session;
$session = new Session();
$token = $session->get('token');
@endphp
@php
    $call_method = $callrequest->call_method ?? 'agora';
@endphp

@section('content')

<style>
/* ═══════════════════════════════════════════════════════
   PREMIUM CALL PAGE — Sacred Luxury Theme
   ═══════════════════════════════════════════════════════ */

@import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Lato:wght@300;400;700&display=swap');

:root {
  --gold:          #c9a84c;
  --gold-light:    #e0c068;
  --gold-pale:     #fdf6e3;
  --gold-glow:     rgba(201,168,76,0.22);
  --dark:          #1a0e05;
  --dark-mid:      #2d1a08;
  --dark-deep:     #0e0800;
  --white:         #ffffff;
  --cream:         #faf4ea;
  --border:        #e8d5b0;
  --border-dark:   #3a2208;
  --text-dark:     #2c1a08;
  --text-mid:      #6b4c22;
  --text-muted:    #b08a55;
  --red:           #e74c3c;
  --red-dark:      #c0392b;
  --shadow-card:   0 4px 20px rgba(30,15,0,0.07);
  --shadow-hover:  0 16px 40px rgba(201,168,76,0.14), 0 4px 12px rgba(30,15,0,0.08);
  --radius-card:   16px;
  --radius-btn:    50px;
  --transition:    0.28s cubic-bezier(0.22, 0.9, 0.36, 1);
}

*, *::before, *::after { box-sizing: border-box; }

/* ─── Breadcrumb ─── */
.astroway-breadcrumb {
  background: linear-gradient(90deg, var(--dark), var(--dark-mid));
  border-bottom: 1px solid var(--border-dark);
  position: relative;
  overflow: hidden;
}

.astroway-breadcrumb::after {
  content: '';
  position: absolute;
  bottom: 0; left: 0; right: 0;
  height: 1px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

.astroway-breadcrumb .breadcrumbs {
  font-family: 'Cinzel', serif;
  font-size: 11px;
  letter-spacing: 1.5px;
  color: rgba(255,255,255,0.7) !important;
}

.astroway-breadcrumb .breadcrumbs a {
  color: var(--gold) !important;
  text-decoration: none;
}

.astroway-breadcrumb .breadcrumbs a:hover { color: var(--gold-light) !important; }

.astroway-breadcrumb .breadcrumbs i.fa-chevron-right {
  font-size: 9px;
  margin: 0 6px;
  color: var(--text-muted);
}

.astroway-breadcrumb .breadcrumbtext { color: rgba(255,255,255,0.6); }

/* ─── Page wrapper ─── */
.call-page-section {
  background: var(--dark-deep);
  min-height: 100vh;
  padding: 1.5rem 0 3rem;
  position: relative;
}

/* Top shimmer */
.call-page-section::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--gold-light) 40%, var(--gold) 50%, var(--gold-light) 60%, transparent);
}

/* ─── Controls sidebar ─── */
.call-controls-panel {
  background: linear-gradient(160deg, #1e1005, #2a1508);
  border: 1px solid var(--border-dark);
  border-radius: var(--radius-card);
  padding: 20px 14px;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 14px;
  height: 100%;
  position: relative;
  overflow: hidden;
}

.call-controls-panel::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

/* Timer */
#remainingTime {
  font-family: 'Cinzel', serif;
  font-size: 22px;
  font-weight: 700;
  color: var(--gold);
  letter-spacing: 2px;
  background: rgba(201,168,76,0.08);
  border: 1px solid rgba(201,168,76,0.2);
  border-radius: var(--radius-btn);
  padding: 8px 18px;
  text-align: center;
  width: 100%;
}

/* Control icon buttons */
.video-action-button {
  width: 46px;
  height: 46px;
  border: 1px solid var(--border-dark);
  border-radius: 50%;
  background: #2d1a08;
  color: rgba(255,255,255,0.75);
  font-size: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all var(--transition);
  outline: none;
  padding: 0;
}

.video-action-button:hover {
  background: var(--gold);
  border-color: var(--gold);
  color: var(--dark);
  transform: translateY(-2px);
  box-shadow: 0 4px 14px var(--gold-glow);
}

.video-action-button.muted,
.video-action-button.off {
  background: var(--red) !important;
  border-color: var(--red) !important;
  color: #fff !important;
}

.video-action-button.endcall {
  background: transparent;
  border: 1px solid var(--red);
  color: var(--red);
  width: auto;
  height: auto;
  border-radius: var(--radius-btn);
  padding: 9px 18px;
  font-family: 'Cinzel', serif;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
}

.video-action-button.endcall:hover {
  background: var(--red);
  color: #fff;
  border-color: var(--red);
  transform: translateY(-2px);
  box-shadow: 0 4px 14px rgba(231,76,60,0.3);
}

.call-note {
  font-family: 'Lato', sans-serif;
  font-size: 10px;
  color: var(--text-muted);
  text-align: center;
  margin-top: -8px;
}

/* Add Topup button */
.add-topup-btnn {
  background: transparent;
  border: 1px solid var(--gold);
  color: var(--gold);
  font-family: 'Cinzel', serif;
  font-size: 10px;
  font-weight: 600;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 9px 16px;
  border-radius: var(--radius-btn);
  cursor: pointer;
  text-decoration: none;
  transition: all var(--transition);
  text-align: center;
  display: inline-block;
  width: 100%;
}

.add-topup-btnn:hover {
  background: var(--gold);
  color: var(--dark);
  transform: translateY(-2px);
  box-shadow: 0 4px 14px var(--gold-glow);
  text-decoration: none;
  color: var(--dark);
}

/* ─── Video panels ─── */
.video-call-wrapper {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
  height: 500px;
  border-radius: var(--radius-card);
  overflow: hidden;
  border: 1px solid var(--border-dark);
}

.video-participant {
  position: relative;
  background: #1a0e05;
  border-radius: 10px;
  overflow: hidden;
}

.player,
video {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* Name tag */
.name-tag {
  position: absolute;
  bottom: 10px;
  left: 10px;
  background: rgba(10,5,0,0.75);
  color: var(--gold-light);
  padding: 4px 12px;
  border-radius: var(--radius-btn);
  font-family: 'Cinzel', serif;
  font-size: 11px;
  font-weight: 600;
  letter-spacing: 0.5px;
  z-index: 10;
  text-decoration: none;
  border: 1px solid rgba(201,168,76,0.2);
  backdrop-filter: blur(4px);
}

/* Avatar fallback */
.avatar-fallback {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 80px;
  height: 80px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--dark-mid), var(--gold));
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--white);
  font-family: 'Cinzel', serif;
  font-size: 26px;
  font-weight: 700;
  border: 2px solid rgba(201,168,76,0.3);
  box-shadow: 0 4px 20px rgba(201,168,76,0.15);
}

/* Zegocloud container */
#zegocloudUIKitContainer {
  width: 100%;
  height: 500px;
  border-radius: var(--radius-card);
  overflow: hidden;
  border: 1px solid var(--border-dark);
}

/* Provider containers */
.agora-container,
.hms-container,
.zegocloud-container {
  display: none;
}

/* Loading overlay */
.loading-overlay {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(10,5,0,0.85);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  color: var(--gold-light);
  z-index: 9999;
  font-family: 'Cinzel', serif;
  font-size: 14px;
  letter-spacing: 1px;
}

.spinner {
  border: 3px solid rgba(201,168,76,0.15);
  border-top: 3px solid var(--gold);
  border-radius: 50%;
  width: 48px;
  height: 48px;
  animation: spin 0.9s linear infinite;
  margin-bottom: 20px;
}

@keyframes spin {
  0%   { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* ─── Modals ─── */

/* Intake Form Modal */
#intake .modal-content,
#insufficientTopUpModal .modal-content {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-card);
  overflow: hidden;
  box-shadow: 0 20px 60px rgba(30,15,0,0.18);
}

#intake .modal-header,
#insufficientTopUpModal .modal-header {
  background: linear-gradient(90deg, var(--dark), var(--dark-mid));
  border-bottom: 1px solid var(--border-dark);
  padding: 16px 20px;
  position: relative;
}

#intake .modal-header::after,
#insufficientTopUpModal .modal-header::after {
  content: '';
  position: absolute;
  bottom: 0; left: 0; right: 0;
  height: 1px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

#intake .modal-title,
#insufficientTopUpModal .modal-title {
  font-family: 'Cinzel', serif;
  font-size: 15px;
  font-weight: 600;
  color: var(--gold-light);
  letter-spacing: 0.5px;
}

#intake .modal-header .close,
#insufficientTopUpModal .modal-header .close {
  color: var(--text-muted);
  opacity: 1;
  font-size: 20px;
}

#intake .modal-header .close:hover,
#insufficientTopUpModal .modal-header .close:hover { color: var(--gold); }

#intake .modal-body,
#insufficientTopUpModal .modal-body {
  background: var(--white);
  padding: 20px 24px;
}

#intake .modal-footer,
#insufficientTopUpModal .modal-footer {
  background: var(--cream);
  border-top: 1px solid var(--border);
  padding: 14px 20px;
}

/* Duration label */
#intake label {
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  color: var(--text-mid);
  margin-bottom: 10px;
}

/* Duration radio buttons */
#intake .btn-info {
  background: transparent !important;
  border: 1px solid var(--border) !important;
  color: var(--text-mid) !important;
  font-family: 'Cinzel', serif !important;
  font-size: 11px !important;
  border-radius: var(--radius-btn) !important;
  padding: 6px 14px !important;
  margin: 3px !important;
  transition: all var(--transition) !important;
}

#intake .btn-info.active,
#intake .btn-info:hover {
  background: var(--gold) !important;
  border-color: var(--gold) !important;
  color: var(--dark) !important;
  box-shadow: 0 4px 12px var(--gold-glow) !important;
}

/* Continue Call / modal action buttons */
.btn-chat,
#intake .btn-chat {
  background: var(--gold) !important;
  border: none !important;
  color: var(--dark) !important;
  font-family: 'Cinzel', serif !important;
  font-size: 11px !important;
  font-weight: 700 !important;
  letter-spacing: 1px !important;
  text-transform: uppercase !important;
  padding: 11px 20px !important;
  border-radius: var(--radius-btn) !important;
  transition: all var(--transition) !important;
  cursor: pointer;
}

.btn-chat:hover,
#intake .btn-chat:hover {
  background: var(--gold-light) !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 6px 18px var(--gold-glow) !important;
  color: var(--dark) !important;
}

/* Insufficient modal body text */
#insufficientTopUpModal .modal-body p {
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  color: var(--text-mid);
}

/* Top Up Now button */
#insufficientTopUpModal .btn-warning {
  background: var(--gold) !important;
  border-color: var(--gold) !important;
  color: var(--dark) !important;
  font-family: 'Cinzel', serif;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 1px;
  border-radius: var(--radius-btn);
  transition: all var(--transition);
}

#insufficientTopUpModal .btn-warning:hover {
  background: var(--gold-light) !important;
  transform: translateY(-2px);
  box-shadow: 0 4px 14px var(--gold-glow);
}

#insufficientTopUpModal .btn-secondary {
  background: transparent;
  border: 1px solid var(--border);
  color: var(--text-mid);
  font-family: 'Cinzel', serif;
  font-size: 11px;
  border-radius: var(--radius-btn);
}

#insufficientTopUpModal .btn-secondary:hover {
  background: var(--cream);
  border-color: var(--gold);
  color: var(--gold);
}

/* ─── Responsive ─── */
@media (max-width: 767px) {
  .video-call-wrapper { grid-template-columns: 1fr; height: auto; }
  .video-participant  { height: 240px; }

  .call-controls-panel {
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    height: auto;
    padding: 14px 12px;
    gap: 10px;
    margin-top: 1rem;
  }

  #remainingTime { width: 100%; font-size: 18px; }

  #local-player div:first-child,
  #remote-playerlist div:first-child {
    min-height: 0 !important;
    position: unset !important;
  }
}

@media (max-width: 480px) {
  .video-participant { height: 200px; }
}

/* Agora internal elements to hide */
.dIzgYQV4CBbzZxzJbwbS { display: none !important; }
.eLS4omBUBKIdRuH3vIbv  { display: none !important; }
.QeMJj1LEulq1ApqLHxuM  { display: none !important; }

/* ─── Entrance animation ─── */
@keyframes fadeSlideUp {
  from { opacity: 0; transform: translateY(16px); }
  to   { opacity: 1; transform: translateY(0); }
}

.call-page-section .row { animation: fadeSlideUp 0.4s ease 0.05s backwards; }
</style>

@if (authcheck())
@php
$userId = authcheck()['id'];
$astrologerId = request()->query('astrologerId');
$callId = request()->query('callId');
$call_type = request()->query('call_type');
@endphp
@endif

<!-- Breadcrumb -->
<div class="pt-1 pb-1 d-none d-md-block astroway-breadcrumb">
    <div class="container">
        <div class="row afterLoginDisplay">
            <div class="col-md-12 d-flex align-items-center">
                <span style="text-transform: capitalize;">
                    <span class="text-white breadcrumbs">
                        <a href="{{ route('front.home') }}">
                            <i class="fa fa-home font-18"></i>
                        </a>
                        <i class="fa fa-chevron-right"></i>
                        <span class="breadcrumbtext">Call</span>
                    </span>
                </span>
            </div>
        </div>
    </div>
</div>

<!-- ── Intake Form Modal ── -->
<div class="modal fade mt-2 mt-md-5" id="intake" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">✦ Intake Form</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body pt-0 pb-0">
                <form class="px-3 font-14" method="get" id="intakeForm">
                    <input type="hidden" name="astrologerId" value="{{ $astrologerId }}">
                    @if (authcheck())
                    <input type="hidden" name="userId" value="{{ authcheck()['id'] }}">
                    @endif
                    <div class="col-12 py-3">
                        <div class="form-group mb-0">
                            <label>Select Time You want to call<span class="color-red">*</span></label><br>
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-info btn-sm">
                                    <input type="radio" name="call_duration" value="180"> 3 mins
                                </label>
                                <label class="btn btn-info btn-sm">
                                    <input type="radio" name="call_duration" value="300"> 5 mins
                                </label>
                                <label class="btn btn-info btn-sm">
                                    <input type="radio" name="call_duration" value="600"> 10 mins
                                </label>
                                <label class="btn btn-info btn-sm">
                                    <input type="radio" name="call_duration" value="900"> 15 mins
                                </label>
                                <label class="btn btn-info btn-sm">
                                    <input type="radio" name="call_duration" value="1200"> 20 mins
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 py-3">
                        <div class="row">
                            <div class="col-12 pt-md-3 text-center mt-2">
                                <button class="font-weight-bold ml-0 w-100 btn btn-chat" id="loaderintakeBtn" type="button" style="display:none;" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...
                                </button>
                                <button type="submit" class="btn btn-block btn-chat px-4 px-md-5 mb-2" id="intakeBtn">Continue Call</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Hidden inputs -->
<input id="appid"      type="hidden" value="{{ $agoraAppIdValue }}">
<input id="token"      type="hidden" value="{{ $callrequest->token }}">
<input id="channel"    type="hidden" value="{{ $callrequest->channelName }}">
<input id="callMethod" type="hidden" value="{{ $callrequest->call_method }}">
<input id="userId"     type="hidden" value="{{ $userId }}">
<input id="callType"   type="hidden" value="{{ $call_type }}">

<!-- ── Main layout ── -->
<div class="call-page-section">
    <section class="container">
        <div class="row g-3 align-items-start">

            <!-- Controls sidebar -->
            <div class="col-md-2 col-sm-12 order-md-0 order-2">
                <div class="call-controls-panel navigation">

                    <!-- Timer -->
                    <span id="remainingTime">{{ $callrequest->call_duration }}</span>

                    @if($call_method == 'agora')
                        <button class="video-action-button mic" onclick="toggleMic()" id="mic-icon" title="Toggle Mic">
                            <i class="fas fa-microphone"></i>
                        </button>
                        @if($call_type == 11)
                            <button class="video-action-button camera" onclick="toggleVideo()" id="video-icon" title="Toggle Camera">
                                <i class="fas fa-video"></i>
                            </button>
                        @endif
                    @else
                        <span></span>
                    @endif

                    <a data-toggle="modal"
                       data-target="#intake"
                       class="add-topup-btnn"
                       id="addTopupLink">
                        ✦ Add Topup
                    </a>

                    <form id="endCallForm" class="d-inline-block w-100 text-center">
                        <input type="hidden" name="callId"   value="{{ $callId }}">
                        <input type="hidden" name="totalMin" id="totalMin" value="">
                        <button type="button" class="video-action-button endcall" id="leave" onclick="endCall()">
                            <i class="fas fa-phone-slash mr-1"></i> Leave
                        </button>
                        <p class="call-note mt-1">Note: call can end after 1 min</p>
                    </form>

                    <div class="video-call-actions"></div>
                </div>
            </div>

            <!-- Video area -->
            <div class="app-main col-md-9 col-sm-12 order-sm-0">

                <!-- Agora -->
                <div class="video-call-wrapper shadow agora-container" id="agoraContainer">
                    <div class="video-participant">
                        <a href="javascript:void(0);" class="name-tag" id="local-player-name">{{ authcheck()['name'] }}</a>
                        <div id="local-player" class="player"></div>
                        <div class="avatar-fallback" id="local-avatar">
                            {{ substr(authcheck()['name'], 0, 1) }}
                        </div>
                    </div>
                    <div class="video-participant">
                        <a href="javascript:void(0);" class="name-tag" id="remote-player-name">Astrologer</a>
                        <div id="remote-playerlist"></div>
                        <div class="avatar-fallback" id="remote-avatar">A</div>
                    </div>
                </div>

                <!-- Zegocloud -->
                <div class="shadow zegocloud-container" id="zegocloudContainer" style="display:none;">
                    <div id="zegocloudUIKitContainer"></div>
                </div>

            </div>
        </div>
    </section>
</div>

<!-- ── Insufficient TopUp Modal ── -->
<div class="modal fade" id="insufficientTopUpModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">✦ Update Top Up</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">
                <p>Your current session will expire soon. Please Top Up Now.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning text-white"
                        data-dismiss="modal" data-toggle="modal" data-target="#intake">
                    Top Up Now
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://unpkg.com/@zegocloud/zego-uikit-prebuilt/zego-uikit-prebuilt.js"></script>
<script src="{{ asset('public/frontend/agora/AgoraRTC_N-4.20.2.js') }}"></script>

<script>
    // Global variables
    var agoraClient    = null;
    var localAudioTrack = null;
    var localVideoTrack = null;
    var remoteUsers    = {};
    var callMethod     = "{{ $callrequest->call_method }}";
    var isVideoCall    = "{{ $call_type }}" == "11";
    var astrologerJoined = false;

    $(document).ready(function() {
        if (callMethod === 'agora') { initializeAgora(); }
    });

    async function initializeAgora() {
        try {
            document.getElementById('agoraContainer').style.display = 'grid';
            document.querySelectorAll('.zegocloud-container').forEach(el => el.style.display = 'none');

            const appID   = document.getElementById('appid').value;
            const token   = document.getElementById('token').value;
            const channel = document.getElementById('channel').value;

            if (!appID || !token || !channel) throw new Error('Missing Agora configuration');

            agoraClient = AgoraRTC.createClient({ mode: "rtc", codec: "vp8" });

            agoraClient.on("user-published", async (user, mediaType) => {
                await agoraClient.subscribe(user, mediaType);

                if (!astrologerJoined) {
                    astrologerJoined = true;
                    if (!timerStartedMain) {
                        var updateTime = new Date("{{ $callrequest->updated_at }}").getTime();
                        $.get("{{ route('front.getDateTime') }}", function(response) {
                            var currentTime  = new Date(response).getTime();
                            var elapsedTime  = Math.floor((currentTime - updateTime) / 1000);
                            remainingTimeMain = callDurationMain - elapsedTime;
                            if (remainingTimeMain < 0) remainingTimeMain = 0;
                            startTimer(); timerStartedMain = true;
                        }).fail(function() {
                            var currentTime  = new Date().getTime();
                            var elapsedTime  = Math.floor((currentTime - updateTime) / 1000);
                            remainingTimeMain = callDurationMain - elapsedTime;
                            if (remainingTimeMain < 0) remainingTimeMain = 0;
                            startTimer(); timerStartedMain = true;
                        });
                    }
                }

                if (mediaType === "video") {
                    const playerContainer = document.getElementById("remote-playerlist");
                    playerContainer.innerHTML = '';
                    document.getElementById('remote-avatar').style.display = 'none';
                    user.videoTrack.play(playerContainer);
                }
                if (mediaType === "audio") { user.audioTrack.play(); }
                remoteUsers[user.uid] = user;
            });

            agoraClient.on("user-unpublished", (user, mediaType) => {
                if (mediaType === "video") document.getElementById('remote-avatar').style.display = 'flex';
            });

            agoraClient.on("user-left", (user) => {
                delete remoteUsers[user.uid];
                document.getElementById('remote-avatar').style.display = 'flex';
                setTimeout(function() {
                    if (typeof callEndedAgora === 'undefined' || !callEndedAgora) {
                        if (typeof endCall === 'function') endCall();
                    }
                }, 1000);
            });

            await agoraClient.join(appID, channel, token, null);
            localAudioTrack = await AgoraRTC.createMicrophoneAudioTrack();

            if (isVideoCall) {
                localVideoTrack = await AgoraRTC.createCameraVideoTrack();
                localVideoTrack.play("local-player");
                document.getElementById('local-avatar').style.display = 'none';
                await agoraClient.publish([localAudioTrack, localVideoTrack]);
            } else {
                await agoraClient.publish([localAudioTrack]);
            }
        } catch (error) {
            console.error('Agora initialization failed:', error);
            alert('Failed to initialize call: ' + error.message);
        }
    }

    async function toggleMic() {
        if (localAudioTrack) {
            try {
                const newState = !localAudioTrack.enabled;
                await localAudioTrack.setEnabled(newState);
                const micBtn = document.getElementById('mic-icon');
                if (newState) { micBtn.classList.remove('muted'); micBtn.innerHTML = '<i class="fas fa-microphone"></i>'; }
                else          { micBtn.classList.add('muted');    micBtn.innerHTML = '<i class="fas fa-microphone-slash"></i>'; }
            } catch (err) { console.error("Error toggling mic:", err); }
        }
    }

    async function toggleVideo() {
        if (localVideoTrack) {
            try {
                const newState = !localVideoTrack.enabled;
                await localVideoTrack.setEnabled(newState);
                const videoBtn = document.getElementById('video-icon');
                if (newState) { videoBtn.classList.remove('off'); videoBtn.innerHTML = '<i class="fas fa-video"></i>'; document.getElementById('local-avatar').style.display = 'none'; }
                else          { videoBtn.classList.add('off');    videoBtn.innerHTML = '<i class="fas fa-video-slash"></i>'; document.getElementById('local-avatar').style.display = 'flex'; }
            } catch (err) { console.error("Error toggling video:", err); }
        }
    }

    async function endCallAgora() {
        if (typeof agoraClient !== 'undefined' && agoraClient) {
            try {
                if (localAudioTrack) { localAudioTrack.close(); localAudioTrack = null; }
                if (localVideoTrack) { localVideoTrack.close(); localVideoTrack = null; }
                await agoraClient.leave(); agoraClient = null;
            } catch (error) { console.error('Agora cleanup error:', error); }
        }
    }
</script>

@if($call_method == 'agora')
<script>
    var callEndedAgora = false;

    async function endCall() {
        if (typeof callEndedAgora !== 'undefined' && callEndedAgora) return;
        callEndedAgora = true;
        if (typeof timerInterval !== 'undefined' && timerInterval) clearInterval(timerInterval);
        await endCallAgora();

        @php $session = new Session(); $token = $session->get('token'); @endphp

        var totalSeconds = (typeof callDurationMain !== 'undefined' && typeof remainingTimeMain !== 'undefined')
            ? callDurationMain - remainingTimeMain : 0;
        $("#totalMin").val(totalSeconds);

        $.ajax({
            url: "{{ route('api.endCall', ['token' => $token]) }}",
            type: 'POST',
            data: $('#endCallForm').serialize(),
            success: function() {
                toastr.success('Call Ended Successfully');
                setTimeout(function() { window.location.href = "{{ route('front.home') }}"; }, 1000);
            },
            error: function(xhr) {
                console.error('Error ending call:', xhr);
                toastr.error(xhr.responseText || 'Error ending call');
                setTimeout(function() { window.location.href = "{{ route('front.home') }}"; }, 2000);
            }
        });
    }
</script>

@elseif($call_method == 'zegocloud')
<script>
    var currentProvider   = "{{ $callrequest->call_method }}";
    var callDurationZego  = parseInt("{{$callrequest->call_duration}}");
    var remainingTimeZego = callDurationZego;
    var timerIntervalZego;
    var callEndedZego = false;
    var zegoUIKit = null;
    var zegoJoined = false;

    $(document).ready(function() { initializeCall(); });

    function initializeCall() {
        showLoading('Initializing call...');
        if (currentProvider === 'agora')      { initializeAgora(); }
        else if (currentProvider === 'zegocloud') { initializeZegocloudUIKit(); }
        else { currentProvider = 'agora'; initializeAgora(); }
    }

    async function initializeZegocloudUIKit() {
        try {
            showProviderUI('zegocloud');
            showLoading('Connecting to Zegocloud...');

            const appID        = "{{ systemflag('zegoAppId') }}";
            const serverSecret = "{{ systemflag('zegoServerSecret') }}";
            const userID       = "{{ $userId }}";
            const userName     = "{{authcheck()['name']}}";
            const roomID       = document.getElementById('channel').value;
            const isVideoCall  = "{{ $call_type }}" == "11";

            if (!appID) throw new Error('Zegocloud App ID is missing');
            if (!serverSecret || serverSecret === '') throw new Error('Zegocloud Server Secret is missing or invalid');
            if (!roomID) throw new Error('Room ID is missing');

            const kitToken = ZegoUIKitPrebuilt.generateKitTokenForTest(parseInt(appID), serverSecret, roomID, userID, userName);
            zegoUIKit = ZegoUIKitPrebuilt.create(kitToken);

            zegoUIKit.joinRoom({
                container: document.querySelector("#zegocloudUIKitContainer"),
                scenario: { mode: isVideoCall ? ZegoUIKitPrebuilt.VideoCall : ZegoUIKitPrebuilt.VoiceCall },
                showPreJoinView: false,
                turnOnCameraWhenJoining: isVideoCall,
                turnOnMicrophoneWhenJoining: true,
                useFrontFacingCamera: true,
                showMyCameraToggleButton: isVideoCall,
                showMyMicrophoneToggleButton: true,
                showAudioVideoSettingsButton: true,
                showTextChat: false,
                showUserList: false,
                showRoomTimer: true,
                maxUsers: 2,
                layout: "Auto",
                showLayoutButton: false,
                showScreenSharingButton: false,
                videoResolutionDefault: ZegoUIKitPrebuilt.VideoResolution_360P,
                onJoinRoom: () => { zegoJoined = true; hideLoading(); },
                onLeaveRoom: () => { if (zegoJoined) endCall(); },
                onUserLeave: (users) => {
                    astrologerJoined = false;
                    setTimeout(() => { if (zegoJoined && (typeof callEndedZego === 'undefined' || !callEndedZego)) endCall(); }, 1000);
                },
                onUserJoin: (users) => {
                    if (!astrologerJoined) {
                        astrologerJoined = true;
                        if (!timerStartedMain) {
                            var updateTime = new Date("{{ $callrequest->updated_at }}").getTime();
                            $.get("{{ route('front.getDateTime') }}", function(response) {
                                var currentTime = new Date(response).getTime();
                                var elapsedTime = Math.floor((currentTime - updateTime) / 1000);
                                remainingTimeMain = callDurationMain - elapsedTime;
                                if (remainingTimeMain < 0) remainingTimeMain = 0;
                                startTimer(); timerStartedMain = true;
                            }).fail(function() {
                                var currentTime = new Date().getTime();
                                var elapsedTime = Math.floor((currentTime - updateTime) / 1000);
                                remainingTimeMain = callDurationMain - elapsedTime;
                                if (remainingTimeMain < 0) remainingTimeMain = 0;
                                startTimer(); timerStartedMain = true;
                            });
                        }
                    }
                },
                onError: (error) => { showError('Zegocloud error: ' + error.message); }
            });
        } catch (error) {
            showError('Failed to initialize Zegocloud: ' + (error.message || 'Unknown error'));
            hideLoading();
        }
    }

    function showProviderUI(provider) {
        document.querySelectorAll('.agora-container, .zegocloud-container').forEach(el => el.style.display = 'none');
        if (provider === 'zegocloud') document.getElementById('zegocloudContainer').style.display = 'block';
        else document.getElementById(provider + 'Container').style.display = 'block';
    }

    function showLoading(message) {
        const overlay = document.getElementById('loadingOverlay');
        const text    = document.getElementById('loadingText');
        if (overlay) { overlay.style.display = 'flex'; if (text && message) text.textContent = message; }
    }

    function hideLoading() {
        const overlay = document.getElementById('loadingOverlay');
        if (overlay) overlay.style.display = 'none';
    }

    function showError(message) { console.error('Error:', message); alert('Error: ' + message); }

    function startTimer() {
        function updateTimerZego() {
            const m = Math.floor(remainingTimeZego / 60);
            const s = remainingTimeZego % 60;
            const el = document.getElementById('remainingTime');
            if (el) el.textContent = `${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
        }
        updateTimerZego();
        timerIntervalZego = setInterval(() => {
            remainingTimeZego--;
            updateTimerZego();
            if (remainingTimeZego <= 0) { clearInterval(timerIntervalZego); endCall(); return; }
            if (remainingTimeZego === 90 || remainingTimeZego === 30) $('#insufficientTopUpModal').modal('show');
        }, 1000);
    }

    async function endCall() {
        if (typeof callEndedZego !== 'undefined' && callEndedZego) return;
        callEndedZego = true;
        if (typeof timerIntervalZego !== 'undefined' && timerIntervalZego) clearInterval(timerIntervalZego);
        if (typeof agoraClient !== 'undefined' && agoraClient) {
            try {
                if (localAudioTrack) { localAudioTrack.close(); localAudioTrack = null; }
                if (localVideoTrack) { localVideoTrack.close(); localVideoTrack = null; }
                await agoraClient.leave(); agoraClient = null;
            } catch (e) { console.error('Agora cleanup error:', e); }
        }
        if (typeof zegoUIKit !== 'undefined' && zegoUIKit && zegoJoined) {
            try { zegoUIKit.leaveRoom(); zegoUIKit = null; zegoJoined = false; }
            catch (e) { console.error('Zego cleanup error:', e); }
        }
        var totalSeconds = (typeof callDurationZego !== 'undefined' && typeof remainingTimeZego !== 'undefined')
            ? callDurationZego - remainingTimeZego : 0;
        $("#totalMin").val(totalSeconds);
        try {
            const response = await fetch("{{ route('api.endCall', ['token' => $token]) }}", {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ callId: "{{ $callId }}", totalMin: totalSeconds })
            });
        } catch (err) { console.error('Error ending call on server:', err); }
        toastr.success('Call ended successfully');
        setTimeout(() => { window.location.href = "{{ route('front.home') }}"; }, 2000);
    }

    window.addEventListener('beforeunload', function() { if (!callEndedZego) endCall(); });

    function toggleMic() {
        if (localAudioTrack) {
            localAudioTrack.setEnabled(!localAudioTrack.enabled);
            const micBtn = document.getElementById('mic-icon');
            if (localAudioTrack.enabled) { micBtn.classList.remove('muted'); micBtn.innerHTML = '<i class="fas fa-microphone"></i>'; }
            else { micBtn.classList.add('muted'); micBtn.innerHTML = '<i class="fas fa-microphone-slash"></i>'; }
        }
    }

    function toggleVideo() {
        if (localVideoTrack) {
            localVideoTrack.setEnabled(!localVideoTrack.enabled);
            const videoBtn = document.getElementById('video-icon');
            if (localVideoTrack.enabled) { videoBtn.classList.remove('off'); videoBtn.innerHTML = '<i class="fas fa-video"></i>'; document.getElementById('local-avatar').style.display = 'none'; }
            else { videoBtn.classList.add('off'); videoBtn.innerHTML = '<i class="fas fa-video-slash"></i>'; document.getElementById('local-avatar').style.display = 'flex'; }
        }
    }
</script>
@endif

<script>
    $(document).ready(function() {
        $('#intakeBtn').click(function(e) {
            e.preventDefault();
            $('#intakeBtn').hide(); $('#loaderintakeBtn').show();
            setTimeout(function() { $('#intakeBtn').show(); $('#loaderintakeBtn').hide(); }, 3000);

            var astrocharge   = "{{ $getAstrologer['recordList'][0]['charge'] }}";
            var wallet_amount = "{{ $walletAmount ?? 0 }}";
            var callId        = "{{ $callId }}";
            var token         = "{{ session('token') }}";
            var astrologerId  = "{{ $getAstrologer['recordList'][0]['id'] }}";
            var userId        = "{{ authcheck() ? authcheck()['id'] : 'null' }}";

            $.ajax({
                url: "{{ route('api.getcurrentCallDuration', ['callId' => $callId]) }}",
                type: 'POST',
                success: function(response) {
                    if (response.callDuration) {
                        let callDurationMinutes    = response.callDuration / 60;
                        let remainingWalletAmount  = (wallet_amount - (callDurationMinutes * astrocharge)).toFixed(2);
                        var call_duration          = $('input[name="call_duration"]:checked').val();
                        var call_duration_minutes  = Math.ceil(call_duration / 60);
                        var total_charge           = astrocharge * call_duration_minutes;

                        if (total_charge <= remainingWalletAmount) {
                            $.ajax({
                                url: "{{ route('api.updatecallMinute') }}",
                                type: 'POST',
                                data: { call_duration: call_duration, callId: callId },
                                success: function() {
                                    setTimeout(function() { refreshTimer(); }, 1000);
                                    toastr.success('Call Continued');
                                    $('#intake').modal('hide'); $('.modal-backdrop').remove(); $('body').removeClass('modal-open');
                                },
                                error: function(xhr) { toastr.error(xhr.responseText); }
                            });
                        } else {
                            $.ajax({
                                url: "{{ route('user.addpayment', ['token' => $token]) }}",
                                type: 'POST',
                                data: { amount: total_charge, payment_for: "topupcall", durationcall: call_duration, callId: callId },
                                success: function(response) {
                                    $('#intake').modal('hide'); $('.modal-backdrop').remove(); $('body').removeClass('modal-open');
                                    window.open(response.url, '_blank', 'width=800,height=600,resizable=yes,scrollbars=yes');
                                },
                                error: function(xhr) { toastr.error(xhr.responseText); }
                            });
                        }
                    } else { toastr.error('Invalid call duration.'); }
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON ? xhr.responseJSON.message : xhr.responseText || 'An error occurred.');
                }
            });
        });

        $('button.mode-switch').click(function() { $('body').toggleClass('dark'); });
        $(".btn-close-right").click(function()  { $(".right-side").removeClass("show"); $(".expand-btn").addClass("show"); });
        $(".expand-btn").click(function()       { $(".right-side").addClass("show"); $(this).removeClass("show"); });
    });
</script>

<script>
    var updateTime        = new Date("{{ $callrequest->updated_at }}").getTime();
    var callDurationMain  = parseInt("{{ $callrequest->call_duration }}");
    var remainingTimeMain = callDurationMain;
    var elapsedTimeMain   = 0;
    var timerIntervalMain = null;
    var timerStartedMain  = false;

    setupFirebaseListener();
    updateTimer();

    $("#local-player-name").text("{{ authcheck()['name'] }}");
    $("#remote-player-name").text("{{ $getAstrologer['recordList'][0]['name'] }}");

    function updateTimer() {
        var minutes  = Math.floor(remainingTimeMain / 60);
        var seconds  = remainingTimeMain % 60;
        var el       = document.getElementById('remainingTime');
        if (el) el.innerHTML = (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
    }

    function startTimer() {
        if (timerIntervalMain) clearInterval(timerIntervalMain);
        updateTimer();
        timerIntervalMain = setInterval(function() {
            remainingTimeMain--;
            if (remainingTimeMain < 0) remainingTimeMain = 0;
            updateTimer();
            if (remainingTimeMain <= 0) { clearInterval(timerIntervalMain); if (typeof endCall === 'function') endCall(); return; }
            if (remainingTimeMain == 90 || remainingTimeMain == 30) $('#insufficientTopUpModal').modal('show');
            var totalSeconds = callDurationMain - remainingTimeMain;
            var leaveBtn = document.getElementById('leave');
            if (leaveBtn) leaveBtn.disabled = totalSeconds < 60;
        }, 1000);
    }

    function setupFirebaseListener() {
        const callId = '{{ $callId }}';
        if (typeof firebase === 'undefined' || !firebase.firestore) { console.warn('Firebase not loaded'); return; }
        const db = firebase.firestore();
        db.collection('updatecall').doc(callId).onSnapshot((doc) => {
            if (doc.exists) {
                const newDuration = doc.data().duration;
                if (newDuration && newDuration > callDurationMain) {
                    const addedTime = newDuration - callDurationMain;
                    callDurationMain   = newDuration;
                    remainingTimeMain += addedTime;
                    if (typeof updateTimer === 'function') updateTimer();
                    toastr.success('Call time extended by ' + Math.ceil(addedTime / 60) + ' minutes');
                }
            }
        }, (error) => { console.error("Firebase listener error:", error); });
    }

    function refreshTimer() {
        $.get("{{ route('front.getDateTime') }}", function(response) {
            const currentTime = new Date(response).getTime();
            const updateTime  = new Date("{{ $callrequest->updated_at }}").getTime();
            const elapsedTime = Math.floor((currentTime - updateTime) / 1000);
            $.ajax({
                url: "{{ route('api.getcurrentCallDuration', ['callId' => $callId]) }}",
                type: 'POST',
                success: function(response) {
                    if (response.callDuration) {
                        const newDuration = response.callDuration;
                        if (newDuration > callDurationMain) {
                            const addedTime = newDuration - callDurationMain;
                            callDurationMain   = newDuration;
                            remainingTimeMain += addedTime;
                        } else {
                            callDurationMain  = newDuration;
                            remainingTimeMain = callDurationMain - elapsedTime;
                        }
                        if (remainingTimeMain < 0) remainingTimeMain = 0;
                        if (typeof updateTimer === 'function') updateTimer();
                    }
                },
                error: function(xhr) { console.error("Error refreshing timer:", xhr); }
            });
        }).fail(function() { console.error("Error fetching server time for timer refresh"); });
    }
</script>
@endsection