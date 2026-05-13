@extends('frontend.layout.master')
@section('content')

<style>
/* ═══════════════════════════════════════════════════════
   PREMIUM PUJA BROADCAST — Sacred Luxury Theme
   Matches Puja / Blog / Products aesthetic
   ═══════════════════════════════════════════════════════ */

@import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Lato:wght@300;400;700&display=swap');

:root {
  --gold:          #c9a84c;
  --gold-light:    #e0c068;
  --gold-pale:     #fdf6e3;
  --gold-glow:     rgba(201,168,76,0.22);
  --dark:          #1a0e05;
  --dark-mid:      #2d1a08;
  --white:         #ffffff;
  --cream:         #faf4ea;
  --border:        #e8d5b0;
  --text-dark:     #2c1a08;
  --text-mid:      #6b4c22;
  --text-muted:    #b08a55;
  --shadow-card:   0 4px 20px rgba(30,15,0,0.07);
  --shadow-hover:  0 16px 40px rgba(201,168,76,0.14), 0 4px 12px rgba(30,15,0,0.08);
  --radius-card:   20px;
  --radius-btn:    50px;
  --transition:    0.32s cubic-bezier(0.22, 0.9, 0.36, 1);

  /* Broadcast dark palette */
  --bcast-bg:      #12090200;
  --bcast-panel:   #1e1005;
  --bcast-border:  #3a2208;
  --bcast-muted:   #6b4c22;
}

*, *::before, *::after { box-sizing: border-box; }

/* ═══════════════════════════════════════════════
   ① DETAIL PAGE (pre-join)
   ═══════════════════════════════════════════════ */

.puja-detail-section {
  background: var(--white);
  position: relative;
  padding: 3rem 0 5rem;
  min-height: 70vh;
}

/* Top shimmer */
.puja-detail-section::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, transparent, var(--gold-light) 40%, var(--gold) 50%, var(--gold-light) 60%, transparent);
}

/* Noise texture */
.puja-detail-section::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 0;
}

.puja-detail-section .container { position: relative; z-index: 1; }

/* ── Carousel / image panel ── */
.puja-carousel-wrap {
  border-radius: var(--radius-card);
  overflow: hidden;
  border: 1px solid var(--border);
  box-shadow: var(--shadow-card);
  background: var(--cream);
  position: relative;
}

.puja-carousel-wrap::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
  z-index: 5;
}

.puja-carousel-wrap .carousel-inner img {
  width: 100%;
  height: 420px;
  object-fit: cover;
  cursor: pointer;
  border-radius: 0;
}

.puja-carousel-wrap .carousel-control-prev,
.puja-carousel-wrap .carousel-control-next {
  width: 40px;
  height: 40px;
  background: rgba(201,168,76,0.75);
  border-radius: 50%;
  top: 50%;
  transform: translateY(-50%);
  opacity: 1;
  margin: 0 10px;
}

.puja-carousel-wrap .carousel-control-prev-icon,
.puja-carousel-wrap .carousel-control-next-icon {
  width: 18px;
  height: 18px;
  filter: brightness(0) invert(0);
}

/* ── Info panel ── */
.puja-info-panel {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-card);
  padding: 28px 24px;
  box-shadow: var(--shadow-card);
  position: relative;
  overflow: hidden;
  height: 100%;
}

.puja-info-panel::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

.puja-info-panel::after {
  content: '';
  position: absolute;
  bottom: 0; right: 0;
  width: 60px; height: 60px;
  background: radial-gradient(circle at bottom right, var(--gold-pale) 0%, transparent 70%);
  pointer-events: none;
}

/* Category badge */
.puja-category-badge {
  font-family: 'Cinzel', serif;
  font-size: 10px;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: var(--gold);
  background: var(--gold-pale);
  border: 1px solid rgba(201,168,76,0.3);
  padding: 4px 14px;
  border-radius: var(--radius-btn);
  display: inline-block;
  margin-bottom: 14px;
}

.puja-title {
  font-family: 'Cinzel', serif;
  font-size: clamp(18px, 2.5vw, 24px);
  font-weight: 700;
  color: var(--dark);
  line-height: 1.35;
  margin: 0 0 8px;
}

.puja-subtitle {
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  color: var(--text-muted);
  margin: 0 0 18px;
}

/* Gold divider */
.gold-divider {
  display: flex;
  align-items: center;
  gap: 10px;
  margin: 14px 0;
}

.gold-divider::before {
  content: '';
  display: block;
  width: 36px;
  height: 1px;
  background: linear-gradient(to right, transparent, var(--gold));
}

.gold-divider::after {
  content: '';
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

/* Meta rows */
.puja-meta-row {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  margin-bottom: 12px;
}

.puja-meta-row i {
  color: var(--gold);
  margin-top: 2px;
  font-size: 14px;
  width: 16px;
  flex-shrink: 0;
}

.puja-meta-row span {
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  color: var(--text-mid);
  line-height: 1.5;
}

/* Join button */
.btn-join-puja {
  background: var(--gold);
  border: none;
  color: var(--dark);
  font-family: 'Cinzel', serif;
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 13px 24px;
  border-radius: var(--radius-btn);
  transition: background 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  width: 100%;
  text-decoration: none;
  cursor: pointer;
  margin-top: 2rem;
}

.btn-join-puja:hover {
  background: var(--gold-light);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(201,168,76,0.35);
  color: var(--dark);
  text-decoration: none;
}

.btn-join-puja i { transition: transform 0.22s ease; }
.btn-join-puja:hover i { transform: translateX(4px); }

/* ═══════════════════════════════════════════════
   ② LIVE BROADCAST PAGE
   ═══════════════════════════════════════════════ */

.puja-broadcast-live {
  background: #0e0800;
  min-height: 100vh;
  padding: 0;
}

/* ── Broadcast header bar ── */
.bcast-header {
  background: linear-gradient(90deg, #1a0e05, #2d1a08);
  border-bottom: 1px solid #3a2208;
  padding: 12px 20px;
  display: flex;
  align-items: center;
  gap: 12px;
  position: relative;
  overflow: hidden;
}

.bcast-header::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

/* Live pulse dot */
.bcast-live-dot {
  width: 9px;
  height: 9px;
  background: #e74c3c;
  border-radius: 50%;
  flex-shrink: 0;
  animation: pulseDot 1.5s ease-in-out infinite;
}

@keyframes pulseDot {
  0%, 100% { opacity: 1; transform: scale(1); box-shadow: 0 0 0 0 rgba(231,76,60,0.5); }
  50%       { opacity: 0.7; transform: scale(1.15); box-shadow: 0 0 0 6px rgba(231,76,60,0); }
}

.bcast-puja-name {
  font-family: 'Cinzel', serif;
  font-size: clamp(13px, 2vw, 17px);
  font-weight: 600;
  color: var(--gold-light);
  margin: 0;
  flex: 1;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.bcast-timer {
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  color: #c3c4c5;
  letter-spacing: 1px;
  white-space: nowrap;
}

.btn-end-puja {
  background: transparent;
  border: 1px solid #e74c3c;
  color: #e74c3c;
  font-family: 'Cinzel', serif;
  font-size: 10px;
  letter-spacing: 1px;
  padding: 6px 14px;
  border-radius: var(--radius-btn);
  cursor: pointer;
  transition: all 0.25s ease;
  white-space: nowrap;
}

.btn-end-puja:hover {
  background: #e74c3c;
  color: #fff;
}

/* ── Video area ── */
.bcast-video-section {
  padding: 16px;
}

/* Astrologer (main) stream */
#astro-stream {
  border-radius: 16px;
  overflow: hidden;
  border: 2px solid var(--gold);
  background: #000;
  height: 420px;
  position: relative;
}

#astro-stream .side-content,
#astro-stream .stream {
  width: 100%;
  height: 100%;
}

/* Participants grid */
#streams {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  align-content: flex-start;
}

#local-stream {
  width: 160px;
  height: 120px;
  border: 2px solid var(--gold);
  border-radius: 10px;
  overflow: hidden;
  background: #000;
  flex-shrink: 0;
}

.stream {
  height: 120px;
  border: 2px solid #3a2208;
  border-radius: 10px;
  overflow: hidden;
  background: #000;
}

/* ── Controls bar ── */
.bcast-controls {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 16px;
  padding: 20px 0 28px;
}

.ctrl-btn {
  width: 48px;
  height: 48px;
  background: #2d1a08;
  border: 1px solid #3a2208;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.25s ease;
  color: #c3c4c5;
  font-size: 16px;
}

.ctrl-btn:hover {
  background: var(--gold);
  border-color: var(--gold);
  color: var(--dark);
  transform: translateY(-2px);
  box-shadow: 0 4px 14px var(--gold-glow);
}

.ctrl-btn i { pointer-events: none; }

/* ═══════════════════════════════════════════════
   Responsive
   ═══════════════════════════════════════════════ */

@media (max-width: 768px) {
  .puja-carousel-wrap .carousel-inner img { height: 280px; }

  #astro-stream { height: 260px; }

  .puja-info-panel { margin-top: 1.5rem; }

  .bcast-header { flex-wrap: wrap; gap: 8px; }

  #local-stream { width: 120px; height: 90px; }

  .ctrl-btn { width: 42px; height: 42px; font-size: 14px; }
}

@media (max-width: 480px) {
  .puja-carousel-wrap .carousel-inner img { height: 220px; }

  #astro-stream { height: 220px; }

  .bcast-puja-name { font-size: 13px; }
}

/* ─── Entrance animation ─── */
@keyframes fadeSlideUp {
  from { opacity: 0; transform: translateY(20px); }
  to   { opacity: 1; transform: translateY(0); }
}

.puja-detail-section .row { animation: fadeSlideUp 0.45s ease 0.05s backwards; }
</style>

<!-- ╔══════════════════════════════════════════════╗ -->
<!-- ║  PRE-JOIN DETAIL PAGE                        ║ -->
<!-- ╚══════════════════════════════════════════════╝ -->
<div class="puja-detail-section puja-details">
    <div class="container">
        <div class="row g-4 align-items-stretch">

            <!-- Carousel -->
            <div class="col-12 col-md-7">
                @if(!empty($puja->puja_images))
                <div class="puja-carousel-wrap">
                    <div id="productCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($puja->puja_images as $index => $image)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ Str::startsWith($image, ['http://','https://']) ? $image : '/' . $image }}"
                                         onerror="this.onerror=null;this.src='/build/assets/images/person.png';"
                                         alt="Puja image"
                                         onclick="openImage('{{ $image }}')" />
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                @else
                <div class="puja-carousel-wrap">
                    <img src="{{ asset('public/frontend/homeimage/360.png') }}"
                         class="w-100"
                         style="height:420px; object-fit:cover;"
                         alt="Puja Image">
                </div>
                @endif
            </div>

            <!-- Info panel -->
            <div class="col-12 col-md-5">
                <div class="puja-info-panel">

                    <!-- Category -->
                    <span class="puja-category-badge">
                        ✦ {{ $puja->category->name ?? '--' }}
                    </span>

                    <!-- Title -->
                    <h1 class="puja-title">{{ $puja->puja_title }}</h1>

                    <!-- Subtitle -->
                    @if($puja->puja_subtitle)
                    <p class="puja-subtitle">{{ $puja->puja_subtitle }}</p>
                    @endif

                    <!-- Divider -->
                    <div class="gold-divider">
                        <span class="gold-diamond"></span>
                    </div>

                    <!-- Place -->
                    <div class="puja-meta-row">
                        <i class="fa-solid fa-place-of-worship"></i>
                        <span>{{ $puja->puja_place }}</span>
                    </div>

                    <!-- Date / Time -->
                    @php
                        $now            = \Carbon\Carbon::now();
                        $startDatetime  = \Carbon\Carbon::parse($puja->puja_start_datetime);
                        $endDatetime    = \Carbon\Carbon::parse($puja->puja_end_datetime);
                        $startDateDisplay = $startDatetime->format('j M, D');
                        $endDateDisplay   = $endDatetime->format('j M, D');
                        $startTimeDisplay = $startDatetime->format('H:i');
                        $endTimeDisplay   = $endDatetime->format('H:i');
                        $sameDate = $startDatetime->isSameDay($endDatetime);
                        $duration = $now->diffInSeconds($endDatetime);

                        $now2           = \Carbon\Carbon::now();
                        $startDatetime2 = \Carbon\Carbon::parse($puja->puja_start_datetime);
                        $duration2      = $startDatetime2->diffInSeconds($now2, false);
                        if ($duration2 < 0) { $duration2 = 0; }
                    @endphp

                    <div class="puja-meta-row">
                        <i class="fa fa-calendar"></i>
                        <span>{{ $startDateDisplay }} &nbsp;·&nbsp; {{ $startTimeDisplay }}</span>
                    </div>

                    <!-- Join button -->
                    <a href="javascript:void(0);" id="startBroadcast" class="btn-join-puja">
                        Join Puja <i class="fa-solid fa-arrow-right"></i>
                    </a>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- ╔══════════════════════════════════════════════╗ -->
<!-- ║  LIVE BROADCAST VIEW                         ║ -->
<!-- ╚══════════════════════════════════════════════╝ -->
<div class="puja-broadcast-live d-none">

    <!-- Header bar -->
    <div class="bcast-header">
        <span class="bcast-live-dot"></span>
        <h3 class="bcast-puja-name">{{ $puja->puja_title }}</h3>
        <span id="timer" class="bcast-timer">Started &nbsp;00:00:00</span>
        @if ($roomuid === 'astrologer')
            <button id="endPujaBtn" class="btn-end-puja">
                <i class="fa fa-stop-circle me-1 mr-1"></i> End Puja
            </button>
        @endif
    </div>

    <!-- Video streams -->
    <div class="container bcast-video-section">
        <div class="row g-3">
            <div class="col-lg-6 col-12" id="astro-stream"></div>
            <div class="col-lg-6 col-12">
                <div id="streams" class="d-flex flex-wrap gap-2">
                    <div id="local-stream"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <div class="bcast-controls">
        <span class="ctrl-btn" id="toggleMic" title="Toggle Microphone">
            <i class="fa fa-microphone"></i>
        </span>
        <span class="ctrl-btn" id="toggleCamera" title="Toggle Camera">
            <i class="fa fa-video-camera"></i>
        </span>
        <span class="ctrl-btn" id="flipCamera" title="Flip Camera">
            <i class="fa fa-refresh"></i>
        </span>
    </div>

</div>

@endsection

@section('scripts')
<script src="{{ asset('public/frontend/agora/AgoraRTC_N-4.20.2.js') }}"></script>
<script>
    const roomId = "{{ $roomId }}";
    const APP_ID = "{{$agoraAppIdValue->value}}";
    const token  = null;

    const client = AgoraRTC.createClient({ mode: "rtc", codec: "vp8" });

    let microphoneTrack;
    let cameraTrack;
    let timer;
    let isMicMuted    = false;
    let isCameraMuted = false;

    client.on("user-published", async (user, mediaType) => {
        console.log(user, 'user-published');
        await client.subscribe(user, mediaType);

        let remoteContainer = document.querySelector(`div[data-uid="${user.uid}"]`);
        if (!remoteContainer) {
            if (user.uid == 'astrologer') {
                remoteContainer = $('#astro-stream');
                remoteContainer.html(`
                    <div class="side-content" data-uid="${user.uid}">
                        <div class="stream"></div>
                        <div class="blank-screen d-none" style="height:420px; border:2px solid var(--gold); border-radius:10px; overflow:hidden; background:#000;"></div>
                    </div>`);
            } else {
                remoteContainer = document.createElement("div");
                remoteContainer.className = "col-4 px-1 mb-1";
                remoteContainer.setAttribute("data-uid", user.uid);
                remoteContainer.innerHTML = `
                    <div class="side-content">
                        <div class="stream"></div>
                        <div class="blank-screen d-none" style="height:120px; border:2px solid #3a2208; border-radius:8px; overflow:hidden; background:#000;"></div>
                    </div>`;
                document.getElementById("streams").appendChild(remoteContainer);
            }
        }

        if (mediaType === "video") {
            const remoteVideoTrack = user.videoTrack;
            if (remoteVideoTrack) {
                remoteVideoTrack.play(remoteContainer.querySelector('.side-content .stream'));
                remoteContainer.querySelector('.stream').classList.remove('d-none');
                remoteContainer.querySelector('.blank-screen').classList.add('d-none');
            }
        }

        if (mediaType === "audio") {
            const remoteAudioTrack = user.audioTrack;
            if (remoteAudioTrack) { remoteAudioTrack.play(); }
        }
    });

    client.on("user-unpublished", (user, mediaType) => {
        const remoteContainer = document.querySelector(`div[data-uid="${user.uid}"]`);
        if (mediaType === "video" && remoteContainer) {
            remoteContainer.querySelector('.stream').classList.add('d-none');
            const blank = remoteContainer.querySelector('.blank-screen');
            blank.classList.remove('d-none');
            blank.style.backgroundColor = 'black';
        }
    });

    client.on("user-left", (user) => {
        const remoteStreamDiv = document.querySelector(`div[data-uid="${user.uid}"]`);
        if (remoteStreamDiv) {
            remoteStreamDiv.remove();
            if (user.uid == 'astrologer') {
                toastr.warning('Puja ended by astrologer.');
                setTimeout(() => { window.location.href = "{{ route('front.home') }}"; }, 5000);
            }
        }
    });

    document.getElementById('startBroadcast').onclick = async () => {
        const isPujaEnded = {{ $puja->isPujaEnded ? 'true' : 'false' }};
        if (isPujaEnded) { toastr.error("Puja has already ended."); return; }

        try {
            await client.join(APP_ID, roomId, null, '{{$roomuid}}');
            [microphoneTrack, cameraTrack] = await AgoraRTC.createMicrophoneAndCameraTracks();

            if ('{{$roomuid}}' == 'astrologer') {
                cameraTrack.play("astro-stream");
                $('#local-stream').hide();
                $("#astro-stream").addClass('astro-large-img');
            } else {
                cameraTrack.play("local-stream");
            }

            $('[id^="agora-video-player-track-cam"]').addClass('large-img');
            await client.publish([microphoneTrack, cameraTrack]);

            $('.puja-details').addClass('d-none');
            $('.puja-broadcast-live').removeClass('d-none');

            startTimer({{ $duration2 }});
        } catch (error) {
            console.error("Error starting broadcast:", error);
        }
    };

    document.getElementById('toggleMic').onclick = () => {
        if (microphoneTrack) {
            isMicMuted = !isMicMuted;
            microphoneTrack.setEnabled(!isMicMuted);
            document.querySelector('#toggleMic i').className = isMicMuted
                ? "fa fa-microphone-slash"
                : "fa fa-microphone";
        }
    };

    document.getElementById('toggleCamera').onclick = () => {
        if (cameraTrack) {
            isCameraMuted = !isCameraMuted;
            cameraTrack.setEnabled(!isCameraMuted);
            document.querySelector('#toggleCamera i').className = isCameraMuted
                ? "fa fa-video-slash"
                : "fa fa-video-camera";
        }
    };

    function startTimer(duration) {
        let elapsedTime = duration;
        timer = setInterval(() => {
            elapsedTime++;
            const h = Math.floor(elapsedTime / 3600);
            const m = Math.floor((elapsedTime % 3600) / 60);
            const s = elapsedTime % 60;
            document.getElementById('timer').textContent =
                `Started: ${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
        }, 1000);
    }

    // Camera flip
    let currentCamera  = 0;
    let cameraDevices  = [];

    async function getCameraDevices() {
        cameraDevices = await AgoraRTC.getCameras();
    }
    getCameraDevices();

    document.getElementById('flipCamera').onclick = async () => {
        try {
            if (cameraDevices.length > 1) {
                currentCamera = (currentCamera + 1) % cameraDevices.length;
                await cameraTrack.setDevice(cameraDevices[currentCamera].deviceId);
            } else {
                alert("No additional cameras found.");
            }
        } catch (error) {
            console.error("Error flipping camera:", error);
        }
    };
</script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const endBtn = document.getElementById('endPujaBtn');
        if (endBtn) {
            endBtn.addEventListener('click', function () {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to end the Puja broadcast.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, end it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post('{{ route("broadcast.endpuja") }}', { puja_id: {{ $puja->id }} })
                            .then(res => {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Puja Ended',
                                    text: res.data.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                                endBroadcast();
                            })
                            .catch(() => {
                                Swal.fire({ icon: 'error', title: 'Error', text: 'Something went wrong while ending the puja.' });
                            });
                    }
                });
            });
        }
    });

    function endBroadcast() {
        if (microphoneTrack) { microphoneTrack.stop(); microphoneTrack.close(); }
        if (cameraTrack)     { cameraTrack.stop();     cameraTrack.close();     }
        client.leave();
        document.getElementById('timer').textContent = "Broadcast ended.";
        window.location.href = "{{ route('front.astrologerindex') }}";
    }
</script>
@endsection