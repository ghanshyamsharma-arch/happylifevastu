@extends('frontend.layout.master')

@section('content')
<style>
/* ═══════════════════════════════════════════════════════
   PREMIUM CHAT PAGE — Sacred Luxury Theme (Enhanced)
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

/* ─── Page wrapper ─── */
.chat-sacred-section {
  background: linear-gradient(135deg, var(--white) 0%, var(--cream) 100%);
  position: relative;
  padding: 1rem 0 4rem;
  min-height: 100vh;
}

/* Top shimmer line */
.chat-sacred-section::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, transparent 0%, var(--gold-light) 40%, var(--gold) 50%, var(--gold-light) 60%, transparent 100%);
  z-index: 2;
}

/* Warm noise texture */
.chat-sacred-section::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 0;
}

.chat-sacred-section .container {
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
.chat-page-title {
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

/* ─── Chat Card ─── */
.chat-sacred-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-card);
  box-shadow: var(--shadow-card);
  overflow: hidden;
  transition: box-shadow var(--transition);
  position: relative;
}

.chat-sacred-card:hover {
  box-shadow: var(--shadow-hover);
}

/* Gold top accent */
.chat-sacred-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
  z-index: 2;
}

/* ─── Chat Header ─── */
.chat-sacred-header {
  background: linear-gradient(135deg, var(--cream) 0%, var(--gold-pale) 100%);
  padding: 16px 24px;
  border-bottom: 1px solid var(--border);
}

.astrologer-sacred-avatar {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid var(--gold);
  cursor: pointer;
  transition: transform 0.2s ease, border-color 0.2s ease;
}

.astrologer-sacred-avatar:hover {
  transform: scale(1.02);
  border-color: var(--gold-light);
}

.astrologer-sacred-name {
  font-family: 'Cinzel', serif;
  font-size: 18px;
  font-weight: 700;
  color: var(--dark);
  margin: 0;
}

.timer-sacred {
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  color: var(--text-mid);
}

.timer-sacred span {
  font-weight: 700;
  color: var(--gold);
  font-size: 16px;
}

/* ─── Chat Messages Container ─── */
.chat-messages-sacred {
  overflow-y: auto;
  height: 57vh !important;
  max-height: 57vh !important;
  padding: 24px;
  background: linear-gradient(135deg, #fefcf8 0%, #faf8f2 100%);
  scroll-behavior: smooth;
}

/* Custom scrollbar */
.chat-messages-sacred::-webkit-scrollbar {
  width: 6px;
}

.chat-messages-sacred::-webkit-scrollbar-track {
  background: var(--cream-mid);
  border-radius: 10px;
}

.chat-messages-sacred::-webkit-scrollbar-thumb {
  background: var(--gold);
  border-radius: 10px;
}

/* ─── Message Bubbles ─── */
.chat-message-sacred {
  display: flex;
  flex-direction: column;
  margin-bottom: 20px;
  animation: fadeSlideUp 0.3s ease backwards;
}

/* Left message (Astrologer) */
.chat-message-left-sacred {
  align-items: flex-start;
}

.message-user-left-img-sacred {
  display: flex;
  gap: 12px;
  align-items: center;
  margin-bottom: 8px;
}

.message-user-left-img-sacred img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  object-fit: cover;
  border: 1px solid var(--gold);
}

.message-user-left-img-sacred strong {
  font-family: 'Cinzel', serif;
  font-size: 14px;
  font-weight: 600;
  color: var(--dark);
}

.message-user-left-img-sacred small {
  font-family: 'Lato', sans-serif;
  font-size: 10px;
  color: var(--text-muted);
}

.message-user-left-text-sacred {
  position: relative;
  padding: 14px 20px;
  background: linear-gradient(135deg, var(--white) 0%, var(--cream) 100%);
  border-radius: 18px;
  border-top-left-radius: 4px;
  color: var(--text-mid);
  max-width: 70%;
  box-shadow: var(--shadow-card);
  border: 1px solid var(--border);
}

.message-user-left-text-sacred::before {
  content: '';
  position: absolute;
  top: -10px;
  left: 15px;
  border-right: 10px solid transparent;
  border-top: 10px solid var(--border);
  border-left: 0px solid transparent;
  border-bottom: 0px solid transparent;
}

.message-user-left-text-sacred strong {
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  font-weight: 400;
  line-height: 1.5;
  display: block;
}

/* Right message (User) */
.chat-message-right-sacred {
  align-items: flex-end;
}

.message-user-right-img-sacred {
  display: flex;
  gap: 12px;
  align-items: center;
  margin-bottom: 8px;
  flex-direction: row-reverse;
}

.message-user-right-img-sacred img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  object-fit: cover;
  border: 1px solid var(--gold);
}

.message-user-right-img-sacred strong {
  font-family: 'Cinzel', serif;
  font-size: 14px;
  font-weight: 600;
  color: var(--dark);
}

.message-user-right-img-sacred small {
  font-family: 'Lato', sans-serif;
  font-size: 10px;
  color: var(--text-muted);
}

.message-user-right-text-sacred {
  position: relative;
  padding: 14px 20px;
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border-radius: 18px;
  border-top-right-radius: 4px;
  color: var(--white);
  max-width: 70%;
  box-shadow: var(--shadow-card);
}

.message-user-right-text-sacred::before {
  content: '';
  position: absolute;
  top: -10px;
  right: 15px;
  border-right: 0px solid transparent;
  border-top: 10px solid var(--gold);
  border-left: 10px solid transparent;
  border-bottom: 0px solid transparent;
}

.message-user-right-text-sacred strong {
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  font-weight: 400;
  line-height: 1.5;
  display: block;
  color: var(--white);
}

/* Center message (End chat) */
.chat-message-center-sacred {
  justify-content: center;
  align-items: center;
}

.message-center-bubble-sacred {
  background: linear-gradient(135deg, var(--gold-pale) 0%, var(--cream) 100%);
  border: 1px solid var(--gold);
  border-radius: 40px;
  padding: 10px 28px;
  text-align: center;
  max-width: 80%;
}

.message-center-bubble-sacred div {
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  color: var(--gold);
}

/* Attachment styling */
.attachment-sacred-img {
  max-height: 200px;
  border-radius: 12px;
  max-width: 100%;
  cursor: pointer;
  transition: transform 0.2s ease;
}

.attachment-sacred-img:hover {
  transform: scale(1.02);
}

.file-attachment-sacred {
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 8px 14px;
  background: rgba(255,255,255,0.15);
  border-radius: 12px;
  transition: background 0.2s ease;
}

.file-attachment-sacred:hover {
  background: rgba(255,255,255,0.25);
}

.file-attachment-sacred i {
  font-size: 24px;
}

.file-attachment-sacred p {
  margin: 0;
  font-size: 12px;
}

/* ─── Chat Input Area ─── */
.chat-input-area {
  background: var(--white);
  border-top: 1px solid var(--border);
  padding: 16px 24px;
}

.chat-input-group-sacred {
  display: flex;
  gap: 12px;
  align-items: center;
}

.attachment-icon-sacred {
  cursor: pointer;
  transition: all 0.2s ease;
}

.attachment-icon-sacred i {
  font-size: 22px;
  color: var(--text-muted);
  transition: color 0.2s ease;
}

.attachment-icon-sacred:hover i {
  color: var(--gold);
}

.chat-input-sacred {
  flex: 1;
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  border: 1px solid var(--border);
  border-radius: 40px;
  padding: 12px 20px;
  transition: all 0.2s ease;
  background: var(--white);
}

.chat-input-sacred:focus {
  border-color: var(--gold);
  box-shadow: 0 0 0 3px var(--gold-glow);
  outline: none;
}

.send-btn-sacred {
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border: none;
  border-radius: 40px;
  padding: 10px 28px;
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  color: var(--white);
  transition: all 0.25s ease;
  cursor: pointer;
}

.send-btn-sacred:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(201,168,76,0.3);
}

/* ─── Modal Styling (Intake Form) ─── */
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

/* Duration buttons */
.duration-btn-group {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-top: 10px;
}

.duration-option {
  background: transparent;
  border: 1px solid var(--border);
  border-radius: 30px;
  padding: 8px 18px;
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  font-weight: 500;
  color: var(--text-mid);
  cursor: pointer;
  transition: all 0.2s ease;
}

.duration-option:hover {
  border-color: var(--gold);
  color: var(--gold);
}

.duration-option.active {
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border-color: var(--gold);
  color: var(--white);
}

.duration-option input {
  display: none;
}

/* Modal buttons */
.modal-continue-btn {
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border: none;
  border-radius: 40px;
  padding: 10px 28px;
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  color: var(--white);
  transition: all 0.25s ease;
  width: 100%;
}

.modal-continue-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(201,168,76,0.3);
}

/* Confirmation Modal */
.confirmation-modal .modal-content {
  border-radius: var(--radius-card);
  border: 1px solid var(--border);
}

.confirmation-modal .modal-header {
  background: linear-gradient(135deg, var(--cream) 0%, var(--gold-pale) 100%);
  border-bottom: 1px solid var(--border);
}

.confirmation-modal .modal-title {
  font-family: 'Cinzel', serif;
  color: var(--dark);
}

/* Responsive */
@media (max-width: 991px) {
  .chat-messages-sacred {
    height: 50vh !important;
    max-height: 50vh !important;
    padding: 16px;
  }
  
  .message-user-left-text-sacred,
  .message-user-right-text-sacred {
    max-width: 85%;
  }
}

@media (max-width: 768px) {
  .chat-sacred-header {
    padding: 12px 16px;
  }
  
  .astrologer-sacred-avatar {
    width: 40px;
    height: 40px;
  }
  
  .astrologer-sacred-name {
    font-size: 16px;
  }
  
  .timer-sacred {
    font-size: 11px;
  }
  
  .timer-sacred span {
    font-size: 14px;
  }
  
  .chat-input-area {
    padding: 12px 16px;
  }
  
  .chat-input-sacred {
    padding: 10px 16px;
    font-size: 13px;
  }
  
  .send-btn-sacred {
    padding: 8px 20px;
    font-size: 12px;
  }
  
  .message-user-left-text-sacred,
  .message-user-right-text-sacred {
    max-width: 90%;
    padding: 10px 16px;
  }
  
  .message-user-left-text-sacred strong,
  .message-user-right-text-sacred strong {
    font-size: 13px;
  }
  
  .duration-option {
    padding: 6px 14px;
    font-size: 12px;
  }
}

@media (max-width: 576px) {
  .chat-messages-sacred {
    height: 45vh !important;
    max-height: 45vh !important;
  }
  
  .message-user-left-img-sacred img,
  .message-user-right-img-sacred img {
    width: 32px;
    height: 32px;
  }
  
  .message-user-left-img-sacred strong,
  .message-user-right-img-sacred strong {
    font-size: 12px;
  }
  
  .attachment-icon-sacred i {
    font-size: 18px;
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

/* End Chat Button */
.end-chat-btn {
  background: transparent;
  border: 1px solid var(--gold);
  border-radius: 40px;
  padding: 6px 20px;
  font-family: 'Cinzel', serif;
  font-size: 12px;
  font-weight: 600;
  color: var(--gold);
  transition: all 0.25s ease;
  cursor: pointer;
}

.end-chat-btn:hover {
  background: var(--gold);
  color: var(--white);
}

/* Add Topup Button */
.add-topup-btn-sacred {
  background: transparent;
  border: 1px solid var(--gold);
  border-radius: 40px;
  padding: 6px 18px;
  font-family: 'Cinzel', serif;
  font-size: 12px;
  font-weight: 600;
  color: var(--gold);
  transition: all 0.25s ease;
  cursor: pointer;
  margin-right: 12px;
  display: inline-block;
}

.add-topup-btn-sacred:hover {
  background: var(--gold);
  color: var(--white);
  text-decoration: none;
}

/* Link styling in messages */
.message-link {
  color: var(--gold);
  text-decoration: underline;
  word-break: break-all;
}

.message-link:hover {
  color: var(--gold-light);
}
</style>

@section('content')
    @if (authcheck())
        @php
            $userId = authcheck()['id'];
            $astrologerId = request()->query('astrologerId');
            $chatId = request()->query('chatId');

            $astrologerUserId = DB::table('astrologers')
            ->where('id', $astrologerId)
            ->value('userId');

            $keywords = DB::table('block-keywords')->get(['type','pattern']);


        @endphp
    @endif


    {{-- Intake Form Modal --}}
    <div class="modal fade sacred-modal mt-2 mt-md-5" id="intake" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <i class="fa fa-clock-o mr-2"></i>Choose Duration
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body pt-0 pb-0">
                    <div class="bg-white body">
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <div class="mb-3">
                                    <form class="px-3 font-14" method="post" id="intakeForm">
                                        <input type="hidden" name="astrologerId" value="{{ $astrologerId }}">
                                        @if (authcheck())
                                            <input type="hidden" name="userId" value="{{ authcheck()['id'] }}">
                                        @endif
                                        <div class="col-12 py-3">
                                            <div class="form-group mb-0">
                                                <label class="font-weight-bold" style="font-family: 'Cinzel', serif;">Select Time You Want to Chat <span class="color-red">*</span></label>
                                                <div class="duration-btn-group" data-toggle="buttons">
                                                    <label class="duration-option">
                                                        <input type="radio" name="chat_duration" value="180"> 3 mins
                                                    </label>
                                                    <label class="duration-option">
                                                        <input type="radio" name="chat_duration" value="300"> 5 mins
                                                    </label>
                                                    <label class="duration-option">
                                                        <input type="radio" name="chat_duration" value="600"> 10 mins
                                                    </label>
                                                    <label class="duration-option">
                                                        <input type="radio" name="chat_duration" value="900"> 15 mins
                                                    </label>
                                                    <label class="duration-option">
                                                        <input type="radio" name="chat_duration" value="1200"> 20 mins
                                                    </label>
                                                    <label class="duration-option">
                                                        <input type="radio" name="chat_duration" value="1500"> 25 mins
                                                    </label>
                                                    <label class="duration-option">
                                                        <input type="radio" name="chat_duration" value="1800"> 30 mins
                                                    </label>
                                                    <label class="duration-option">
                                                        <input type="radio" name="chat_duration" value="3600"> 1 hour
                                                    </label>
                                                    <label class="duration-option">
                                                        <input type="radio" name="chat_duration" value="7200"> 2 hours
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12 py-3">
                                            <div class="row">
                                                <div class="col-12 pt-md-3 text-center mt-2">
                                                    <button class="modal-continue-btn" id="loaderintakeBtn" type="button" style="display:none;" disabled>
                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...
                                                    </button>
                                                    <button type="submit" class="modal-continue-btn" id="intakeBtn">
                                                        <i class="fa fa-commenting-o mr-2"></i>Continue Chat
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
                        <span style="color: var(--gold);">Sacred Chat</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="chat-sacred-section">
        <div class="container">
            
            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <h1 class="chat-page-title">Sacred Conversation</h1>
                    <div class="title-divider">
                        <span class="gold-diamond"></span>
                    </div>
                </div>
            </div>

            <main class="content">
                <div class="chat-sacred-card">
                    <div class="row g-0">
                        <div class="col-12 col-lg-12 col-xl-12">

                            <!-- Chat Header -->
                            <div class="chat-sacred-header">
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3" style="gap: 15px;">
                                    <div class="d-flex align-items-center gap-3" style="gap: 15px;">
                                        <div class="position-relative">
                                            @if($getAstrologer['recordList'][0]['profileImage'])
                                                <img class="astrologer-sacred-avatar" 
                                                     src="{{ Str::startsWith($getAstrologer['recordList'][0]['profileImage'], ['http://','https://']) ? $getAstrologer['recordList'][0]['profileImage'] : $getAstrologer['recordList'][0]['profileImage'] }}" 
                                                     onerror="this.onerror=null;this.src='/build/assets/images/person.png';" 
                                                     alt="{{ $getAstrologer['recordList'][0]['name'] }}" />
                                            @else
                                                <img src="{{ asset('public/frontend/astrowaycdn/dashaspeaks/web/content/images/user-img-new.png') }}"
                                                     class="astrologer-sacred-avatar" alt="Astrologer">
                                            @endif
                                        </div>
                                        <div>
                                            <h2 class="astrologer-sacred-name">{{ $getAstrologer['recordList'][0]['name'] }}</h2>
                                            <div class="text-muted small" style="font-family: 'Lato', sans-serif; font-size: 12px;">
                                                <i class="fa fa-star" style="color: var(--gold);"></i> Sacred Guide
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex align-items-center gap-2" style="gap: 10px;">
                                        <a data-toggle="modal" data-target="#intake" class="add-topup-btn-sacred" id="addTopupLink">
                                            <i class="fa fa-plus mr-1"></i>Add Time
                                        </a>
                                        <div id="timerContainer">
                                            <div class="timer-sacred">
                                                <i class="fa fa-hourglass-half"></i> Remaining: 
                                                <span id="remainingTime">{{ $chatrequest->chat_duration }} seconds</span>
                                                <form id="endChatForm" class="d-inline-block ml-2">
                                                    <input type="hidden" name="chatId" value="{{ $chatId }}">
                                                    <input type="hidden" name="totalMin" id="totalMin" value="">
                                                    <button class="end-chat-btn" id="endChat">
                                                        <i class="fa fa-times mr-1"></i>End
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Chat Messages Area -->
                            <div class="position-relative">
                                <div class="chat-messages-sacred">
                                    <!-- Messages will be dynamically loaded here -->
                                </div>

                                <!-- Chat Input Area -->
                                <div class="chat-input-area">
                                    <div class="chat-input-group-sacred">
                                        <label for="fileInput" class="attachment-icon-sacred">
                                            <input type="file" id="fileInput" class="d-none">
                                            <i class="fas fa-paperclip"></i>
                                        </label>
                                        <input type="text" id="fileDisplay" class="chat-input-sacred" placeholder="Type your sacred message...">
                                        <button class="send-btn-sacred" id="sendButton">
                                            <i class="fa fa-send mr-1"></i>Send
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade confirmation-modal" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-question-circle mr-2"></i>Confirm End Chat
                    </h5>
                    <button type="button" class="close" id="closeModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center" style="font-family: 'Lato', sans-serif;">Are you sure you want to end this sacred conversation?</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" id="cancelLeave" style="border-radius: 30px; padding: 8px 24px;">No</button>
                    <button type="button" class="end-chat-btn" id="confirmLeave" style="background: var(--gold); color: white;">Yes, End Chat</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Insufficient TopUp Modal -->
    <div class="modal fade confirmation-modal" id="insufficientTopUpModal" tabindex="-1" aria-labelledby="insufficientTopUpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">
                        <i class="fa fa-exclamation-triangle mr-2"></i>Time Running Low
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <p style="font-family: 'Lato', sans-serif;">Your current session will expire soon. Please add more time to continue.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 30px;">Close</button>
                    <button type="button" class="add-topup-btn-sacred" data-dismiss="modal" data-toggle="modal" data-target="#intake" style="background: var(--gold); color: white;">
                        <i class="fa fa-plus mr-1"></i>Add Time Now
                    </button>
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

document.getElementById('fileInput').addEventListener('change', function() {
    const fileInput = this;
    const fileName = fileInput.files[0] ? fileInput.files[0].name : 'No file chosen';
    document.getElementById('fileDisplay').value = fileName;
});

var userId = "{{ $userId }}";
var astrologerId = "{{ $astrologerId }}";
var astrologerUserId = "{{$astrologerUserId}}";

var patterns = {!! json_encode($keywords) !!};
console.log("Raw Keywords:", patterns);

function decodeAndParsePatterns(patterns) {
    try {
        patterns.forEach(item => {
            if (item.type === 'offensive-word' && item.pattern) {
                try {
                    item.pattern = JSON.parse(item.pattern);
                    console.error('item.pattern:', item.pattern);
                } catch (e) {
                    console.error('Error parsing offensive word pattern:', e);
                    item.pattern = [];
                }
            }
        });
        return patterns;
    } catch (error) {
        console.error("Error in decodeAndParsePatterns:", error);
        return [];
    }
}

const parsedPatterns = decodeAndParsePatterns(patterns);
console.log("Parsed Patterns:", parsedPatterns);

let sensitiveWordsCount = 0;
var defaulter = 0;

function maskSensitiveWord(word, type) {
    if (type === 'email') {
        const parts = word.split('@');
        const localPart = parts[0];
        const domainPart = parts[1];
        const maskedLocalPart = localPart.length > 2
            ? localPart.charAt(0) + '*'.repeat(localPart.length - 2) + localPart.slice(-1)
            : localPart;
        return maskedLocalPart + '@' + domainPart;
    }
    if (type === 'phone') {
        return word.length > 2
            ? word.charAt(0) + '*'.repeat(word.length - 2) + word.charAt(word.length - 1)
            : word;
    }
    if (type === 'url') {
        const urlParts = word.split('://');
        return urlParts[0] + '://*****.com';
    }
    if (type === 'offensive-word') {
        const firstChar = word.charAt(0);
        const lastChar = word.charAt(word.length - 1);
        const masked = firstChar + '*'.repeat(word.length - 2) + lastChar;
        return masked;
    }
    return word;
}

function processMessage(message) {
    let maskedMessage = message;
    sensitiveWordsCount = 0;
    parsedPatterns.forEach((pattern) => {
        if (pattern.pattern === 'true') {
            if (pattern.type === 'phone') {
                const phoneRegex = /\b(\+91|91)?\d{10}\b/g;
                const matches = message.match(phoneRegex);
                if (matches) {
                    defaulter = 1;
                    sensitiveWordsCount += matches.length;
                    matches.forEach((match) => {
                        const maskedWord = maskSensitiveWord(match, 'phone');
                        maskedMessage = maskedMessage.replace(match, maskedWord);
                    });
                }
            }
            if (pattern.type === 'email') {
                const emailRegex = /\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}\b/g;
                const matches = message.match(emailRegex);
                if (matches) {
                    defaulter = 1;
                    sensitiveWordsCount += matches.length;
                    matches.forEach((match) => {
                        const maskedWord = maskSensitiveWord(match, 'email');
                        maskedMessage = maskedMessage.replace(match, maskedWord);
                    });
                }
            }
        }
        if (pattern.type === 'offensive-word' && Array.isArray(pattern.pattern)) {
            const offensiveWordsRegex = new RegExp(`\\b(${pattern.pattern.join('|')})\\b`, 'gi');
            const matches = message.match(offensiveWordsRegex);
            if (matches) {
                defaulter = 1;
                sensitiveWordsCount += matches.length;
                matches.forEach((match) => {
                    const maskedWord = maskSensitiveWord(match, 'offensive-word');
                    maskedMessage = maskedMessage.replace(match, maskedWord);
                });
            }
        }
    });
    return maskedMessage;
}

const firestore = firebase.firestore();

function sendMessage(senderId, receiverId, message, isEndMessage, attachementPath) {
    const chatRef = firestore.collection('chats').doc(`${receiverId}_${senderId}`).collection('userschat').doc(
        receiverId).collection('messages');
    const timestamp = new Date();
    const messageId = chatRef.doc().id;

    chatRef.doc(messageId).set({
        id: null,
        createdAt: timestamp,
        invitationAcceptDecline: null,
        isDelete: false,
        isEndMessage: isEndMessage,
        isRead: false,
        messageId: messageId,
        reqAcceptDecline: null,
        status: null,
        updatedAt: timestamp,
        url: null,
        userId1: senderId,
        userId2: receiverId,
        message: message,
        attachementPath: attachementPath,
    })
    .then(() => {})
    .catch((error) => {
        console.error("Error sending message: ", error);
    });
}

$(document).on('keydown', '#fileDisplay', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        $('#sendButton').click();
    }
});

$(document).ready(function() {
    $(document).on('click', '.send-btn-sacred, #sendButton', function() {
        const originalMessage = $('#fileDisplay').val();
        const processedMessage = processMessage(originalMessage);
        $('#fileDisplay').val(processedMessage);

        if(defaulter == 1){
            $.ajax({
                url: '/store-defaulter-message',
                type: 'POST',
                data: {
                    message: originalMessage,
                    userId: userId,
                    type: 'user',
                    sender_type: 'user',
                    sender_id: userId,
                    receiver_type: 'astrologer',
                    receiver_id: astrologerUserId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    defaulter = 0;
                    toastr.warning(response.message);
                },
                error: function(xhr, status, error) {
                    alert('Error sending message: ' + error);
                }
            });
        } else {
            defaulter = 0;
        }

        const messageInput = $(this).closest('.chat-input-area').find('.chat-input-sacred');
        const message = messageInput.val().trim();
        const fileInput = $(this).closest('.chat-input-area').find('#fileInput')[0];
        const file = fileInput.files[0];

        if (message !== '' || file) {
            if (file) {
                const storageRef = firebase.storage().ref();
                const fileName = `${astrologerId}_${userId}/${file.name}`;
                const fileRef = storageRef.child(fileName);

                fileRef.put(file).then((snapshot) => {
                    snapshot.ref.getDownloadURL().then((downloadURL) => {
                        sendMessage(userId, astrologerId, null, false, downloadURL);
                        messageInput.val('');
                        fileInput.value = '';
                        document.getElementById('fileDisplay').value = '';
                    });
                }).catch((error) => {
                    console.error('Error uploading file:', error);
                });
            } else {
                sendMessage(userId, astrologerId, message, false, '');
                messageInput.val('');
            }
        } else {
            toastr.error('Message and file are empty');
        }
    });
});

let chatOpenedTime = Date.now();

function fetchAndRenderMessages(receiverId, senderId) {
    const senderChatRef = firestore.collection('chats').doc(`${receiverId}_${senderId}`).collection('userschat')
        .doc(receiverId).collection('messages');

    senderChatRef.orderBy('createdAt', 'asc').onSnapshot(snapshot => {
        snapshot.docChanges().forEach(change => {
            const message = change.doc.data();
            if (change.type === 'added') {
                renderMessage(message, receiverId);
                scrollToBottom();

                if (message.createdAt && message.createdAt.toMillis() > chatOpenedTime) {
                    if (message.isEndMessage) {
                        clearInterval(timerInterval);
                        endChat();
                    }
                }
            }
        });
    });
}

function scrollToBottom() {
    const chatMessagesContainer = document.querySelector('.chat-messages-sacred');
    chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;
}

function renderMessage(message, receiverId) {
    const chatMessagesContainer = document.querySelector('.chat-messages-sacred');
    const isScrolledToBottom = chatMessagesContainer.scrollHeight - chatMessagesContainer.clientHeight <=
        chatMessagesContainer.scrollTop + 1;

    const messageElement = document.createElement('div');
    messageElement.classList.add('chat-message-sacred');

    const timestamp = message.createdAt.toDate();
    const formattedTime = timestamp.toLocaleTimeString('en-US', {
        hour: 'numeric',
        minute: '2-digit'
    });

    var newupdateTime = new Date("{{ $chatrequest->updated_at }}").toLocaleString('en-US', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
    });
    var newtimestamp = timestamp.toLocaleString('en-US', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
    });
    
    @if($getAstrologer['recordList'][0]['profileImage'])
        var astroprofile = "{{ $getAstrologer['recordList'][0]['profileImage'] }}";
    @else
        var astroprofile = "{{ asset('public/frontend/astrowaycdn/dashaspeaks/web/content/images/user-img-new.png') }}";
    @endif

    @if(authcheck()['profile'])
        var userprofile = "/{{ authcheck()['profile'] }}";
    @else
        var userprofile = "{{ asset('public/frontend/astrowaycdn/dashaspeaks/web/content/images/user-img-new.png') }}";
    @endif

    if (message.isEndMessage == true) {
        messageElement.classList.add('chat-message-center-sacred');
        messageElement.innerHTML = `
            <div class="message-center-bubble-sacred">
                <div>${convertToLink(message.message)}</div>
            </div>`;
    } else if (message.userId1 === receiverId) {
        messageElement.classList.add('chat-message-left-sacred');
        messageElement.innerHTML = `
            <div class="message-user-left-img-sacred">
                <img src="${astroprofile}" alt="Astrologer">
                <strong>{{ $getAstrologer['recordList'][0]['name'] }}</strong>
                <small>${formattedTime}</small>
            </div>
            <div class="message-user-left-text-sacred">
                ${message.attachementPath ? renderAttachment(message.attachementPath) : `<strong>${convertToLink(message.message)}</strong>`}
            </div>`;
    } else {
        messageElement.classList.add('chat-message-right-sacred');
        messageElement.innerHTML = `
            <div class="message-user-right-img-sacred">
                <strong>You</strong>
                <small>${formattedTime}</small>
                <img src="${userprofile}" alt="You">
            </div>
            <div class="message-user-right-text-sacred">
                ${message.attachementPath ? renderAttachment(message.attachementPath) : `<strong>${convertToLink(message.message)}</strong>`}
            </div>`;
    }

    if (message.isEndMessage == true && (newtimestamp >= newupdateTime)) {
        clearInterval(timerInterval);
    }

    chatMessagesContainer.appendChild(messageElement);

    if (isScrolledToBottom) {
        chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;
    }
}

function convertToLink(message) {
    const urlPattern = /(https?:\/\/[^\s]+)/g;
    return message.replace(urlPattern, '<a href="$1" target="_blank" class="message-link">$1</a>');
}

function renderAttachment(attachementPath) {
    if (!attachementPath) return '';

    const filePathWithoutParams = attachementPath.split('?')[0];
    const fileExtension = filePathWithoutParams.split('.').pop().toLowerCase();
    const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];

    if (imageExtensions.includes(fileExtension)) {
        return `<img src="${attachementPath}" class="attachment-sacred-img" alt="Attachment" onclick="downloadFile('${attachementPath}')">`;
    }

    const fileIcons = {
        pdf: 'fa-file-pdf',
        xlsx: 'fa-file-excel',
        xls: 'fa-file-excel',
        docx: 'fa-file-word',
        doc: 'fa-file-word',
        txt: 'fa-file-alt',
        csv: 'fa-file-csv',
        zip: 'fa-file-archive',
    };

    const defaultIcon = 'fa-file';
    const fileIcon = fileIcons[fileExtension] || defaultIcon;

    return `
        <div class="file-attachment-sacred" onclick="downloadFile('${attachementPath}')">
            <i class="fas ${fileIcon}"></i>
            <p>Attachment</p>
        </div>`;
}

function isImage(url) {
    return /\.(jpeg|jpg|gif|png)$/i.test(url);
}

document.addEventListener('DOMContentLoaded', function() {
    fetchAndRenderMessages(astrologerId, userId);
});

function downloadFile(url) {
    window.open(url, '_blank');
}

// Timer and End Chat Logic
let timerInterval;
let chatEnded = false;

$(document).ready(function() {
    let updateTime = new Date("{{ $chatrequest->updated_at }}").getTime();
    let chatDuration = {{ $chatrequest->chat_duration }};
    let serverTime = remainingTime = '';
    
    $.get("{{ route('front.getDateTime') }}", function(response) {
        serverTime = new Date(response).getTime();
        let elapsedTime = Math.floor((serverTime - updateTime) / 1000);
        remainingTime = chatDuration - elapsedTime;
        if (remainingTime < 0) {
            remainingTime = 0;
        }
        startTimer();
    }).fail(function() {
        console.error("Error fetching server time");
    });

    function updateTimer() {
        if(chatEnded) return false;
        let minutes = Math.floor(remainingTime / 60);
        let seconds = remainingTime % 60;
        let formattedTime = (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
        document.getElementById('remainingTime').innerHTML = formattedTime;
    }

    function startTimer(){
        setupFirebaseListener();
        setInterval(function() {
            if(chatEnded) return false;
            remainingTime--;
            if (remainingTime <= 0) {
                remainingTime = 0;
                clearInterval(timerInterval);
                endChat();
            }
            updateTimer();
            if(remainingTime == 90){
                $('#insufficientTopUpModal').modal('show');
            }
            if(remainingTime == 30){
                $('#insufficientTopUpModal').modal('show');
            }
            let totalSeconds = chatDuration - remainingTime;
            $("#endChat").prop("disabled", totalSeconds < 60);
        }, 1000);
    }

    function setupFirebaseListener() {
        const chatId = '{{ $chatId }}';
        const db = firebase.firestore();
        
        db.collection('updatechat').doc(chatId).onSnapshot((doc) => {
            if (doc.exists) {
                const firebaseData = doc.data();
                const newDuration = firebaseData.duration;
                const previousDuration = chatDuration;
                chatDuration = newDuration;
                if (chatDuration > previousDuration) {
                    const additionalTime = chatDuration - previousDuration;
                    remainingTime += additionalTime;
                    updateTimer();
                }
            }
        }, (error) => {
            console.error("Firebase listener error:", error);
        });
    }
});

function endChat() {
    if (chatEnded) return;
    chatEnded = true;

    @php
        use Symfony\Component\HttpFoundation\Session\Session;
        $session = new Session();
        $token = $session->get('token');
    @endphp

    var formData = $('#endChatForm').serialize();

    $.ajax({
        url: "{{ route('api.endChatRequest', ['token' => $token]) }}",
        type: 'POST',
        data: formData,
        success: function(response) {
            toastr.success('Chat Ended Successfully');
            sendMessage(userId, astrologerId, "{{ authcheck()['name'] }} -> Chat Ended", true, null);
            window.location.href = "{{ route('front.home') }}";
        },
        error: function(xhr, status, error) {
            toastr.error(xhr.responseText);
        }
    });
}

$(document).ready(function() {
    $('#endChat').click(function(e) {
        e.preventDefault();
        endChat();
    });
});

$(window).on('beforeunload', function () {
    if (!chatEnded) {
        sendMessage(userId, astrologerId, "{{ authcheck()['name'] }} -> Chat Ended", true, null);
        endChat();
    }
});

$(document).ready(function () {
    $('#intakeBtn').click(function (e) {
        e.preventDefault();

        $('#intakeBtn').hide();
        $('#loaderintakeBtn').show();

        setTimeout(function () {
            $('#intakeBtn').show();
            $('#loaderintakeBtn').hide();
        }, 3000);

        var astrocharge = {{ $getAstrologer['recordList'][0]['charge'] }};
        var wallet_amount = {{ authcheck() ? $walletAmount : 0 }};
        var chatId = "{{ $chatId }}";
        var token = "{{ session('token') }}";
        var astrologerId = "{{ $getAstrologer['recordList'][0]['id'] }}";
        var userId = {{ authcheck() ? authcheck()['id'] : 'null' }};

        $.ajax({
            url: "{{ route('api.getcurrentDuration', ['chatId' => $chatId]) }}",
            type: 'POST',
            success: function (response) {
                if (response.chatDuration) {
                    let chatDurationMinutes = response.chatDuration / 60;
                    let remainingWalletAmount = wallet_amount - (chatDurationMinutes * astrocharge);
                    remainingWalletAmount = remainingWalletAmount.toFixed(2);

                    var formData = $('#intakeForm').serialize();
                    var urlParams = new URLSearchParams(formData);
                    var chat_duration = parseInt(urlParams.get('chat_duration'));
                    var chat_duration_minutes = Math.ceil(chat_duration / 60);
                    var total_charge = astrocharge * chat_duration_minutes;

                    if (total_charge <= remainingWalletAmount) {
                        $.ajax({
                            url: "{{ route('api.updatechatMinute') }}",
                            type: 'POST',
                            data: {
                                chat_duration: chat_duration,
                                chatId: chatId,
                            },
                            success: function () {
                                toastr.success('Chat Continued');
                                $('#intake').modal('hide');
                                $('.modal-backdrop').remove();
                                $('body').removeClass('modal-open');
                            },
                            error: function (xhr) {
                                toastr.error(xhr.responseText);
                            },
                        });
                    } else {
                        $.ajax({
                            url: "{{ route('user.addpayment', ['token' => $token]) }}",
                            type: 'POST',
                            data: {
                                amount: total_charge,
                                payment_for: "topupchat",
                                durationchat: chat_duration,
                                chatId: chatId,
                            },
                            success: function (response) {
                                $('#intake').modal('hide');
                                $('.modal-backdrop').remove();
                                $('body').removeClass('modal-open');
                                window.open(response.url, '_blank', 'width=800,height=600,resizable=yes,scrollbars=yes');
                            },
                            error: function (xhr) {
                                toastr.error(xhr.responseText);
                            },
                        });
                    }
                } else {
                    toastr.error('Invalid chat duration.');
                }
            },
            error: function (xhr) {
                let errorMessage = xhr.responseJSON ? xhr.responseJSON.message : xhr.responseText;
                toastr.error(errorMessage || 'An error occurred while fetching the chat duration.');
            },
        });
    });
});
</script>
@endsection