@extends('frontend.layout.master')
@section('content')
<style>
/* ═══════════════════════════════════════════════════════
   PREMIUM CHAT PAGE — Sacred Luxury Theme
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

.chat-section *,
.chat-section *::before,
.chat-section *::after {
  box-sizing: border-box;
}

/* ─── Page wrapper ─── */
.chat-section {
  background: linear-gradient(135deg, var(--white) 0%, var(--cream) 100%);
  position: relative;
  padding: 1rem 0 4rem;
  min-height: 100vh;
}

/* Top shimmer line */
.chat-section::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, transparent 0%, var(--gold-light) 40%, var(--gold) 50%, var(--gold-light) 60%, transparent 100%);
  z-index: 2;
}

/* Warm noise texture */
.chat-section::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 0;
}

.chat-section .container {
  position: relative;
  z-index: 1;
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
.chat-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-card);
  box-shadow: var(--shadow-card);
  overflow: hidden;
  transition: box-shadow var(--transition);
  position: relative;
}

.chat-card:hover {
  box-shadow: var(--shadow-hover);
}

/* Gold top accent */
.chat-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
  z-index: 2;
}

/* ─── Chat Header ─── */
.chat-header {
  background: linear-gradient(135deg, var(--cream) 0%, var(--gold-pale) 100%);
  padding: 16px 24px;
  border-bottom: 1px solid var(--border);
}

.astrologer-avatar {
  width: 56px;
  height: 56px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid var(--gold);
  cursor: pointer;
  transition: transform 0.2s ease, border-color 0.2s ease;
}

.astrologer-avatar:hover {
  transform: scale(1.02);
  border-color: var(--gold-light);
}

.astrologer-name {
  font-family: 'Cinzel', serif;
  font-size: 18px;
  font-weight: 700;
  color: var(--dark);
  margin: 0;
}

.review-btn {
  background: transparent;
  border: 1px solid var(--gold);
  border-radius: 40px;
  padding: 8px 24px;
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  color: var(--gold);
  transition: all 0.25s ease;
  cursor: pointer;
}

.review-btn:hover {
  background: var(--gold);
  color: var(--white);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(201,168,76,0.2);
}

/* ─── Chat Messages Container ─── */
.chat-messages-container {
  height: 500px;
  overflow-y: auto;
  padding: 24px;
  background: linear-gradient(135deg, var(--white) 0%, #fefcf8 100%);
  scroll-behavior: smooth;
}

/* Custom scrollbar */
.chat-messages-container::-webkit-scrollbar {
  width: 6px;
}

.chat-messages-container::-webkit-scrollbar-track {
  background: var(--cream-mid);
  border-radius: 10px;
}

.chat-messages-container::-webkit-scrollbar-thumb {
  background: var(--gold);
  border-radius: 10px;
}

/* ─── Message Bubbles ─── */
.chat-message {
  display: flex;
  margin-bottom: 20px;
  animation: fadeSlideUp 0.3s ease backwards;
}

.chat-message-left {
  justify-content: flex-start;
}

.chat-message-right {
  justify-content: flex-end;
}

/* Sender info */
.sender, .you {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.sender img, .you img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  object-fit: cover;
  border: 1px solid var(--border);
}

.message-time {
  font-size: 10px;
  color: var(--text-muted);
  margin-top: 6px;
  font-family: 'Lato', sans-serif;
}

/* Message bubble left */
.message-bubble-left {
  background: var(--cream);
  border-radius: 18px;
  border-top-left-radius: 4px;
  padding: 12px 18px;
  margin-left: 12px;
  max-width: 70%;
  box-shadow: 0 1px 2px rgba(0,0,0,0.05);
}

.message-bubble-left .message-sender-name {
  font-family: 'Cinzel', serif;
  font-size: 12px;
  font-weight: 600;
  color: var(--gold);
  margin-bottom: 6px;
}

.message-bubble-left .message-text {
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  color: var(--text-mid);
  line-height: 1.5;
  margin: 0;
}

/* Message bubble right */
.message-bubble-right {
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
  border-radius: 18px;
  border-top-right-radius: 4px;
  padding: 12px 18px;
  margin-right: 12px;
  max-width: 70%;
  box-shadow: 0 1px 2px rgba(0,0,0,0.1);
}

.message-bubble-right .message-sender-name {
  font-family: 'Cinzel', serif;
  font-size: 12px;
  font-weight: 600;
  color: rgba(255,255,255,0.9);
  margin-bottom: 6px;
}

.message-bubble-right .message-text {
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  color: var(--white);
  line-height: 1.5;
  margin: 0;
}

/* Center message (end chat) */
.message-center {
  justify-content: center;
}

.message-center-bubble {
  background: linear-gradient(135deg, var(--gold-pale) 0%, var(--cream) 100%);
  border: 1px solid var(--gold);
  border-radius: 40px;
  padding: 8px 24px;
  text-align: center;
  max-width: 80%;
}

.message-center-bubble .message-text {
  font-family: 'Lato', sans-serif;
  font-size: 13px;
  font-weight: 600;
  color: var(--gold);
  margin: 0;
}

/* Attachment styling */
.chat-attachment {
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 12px;
  background: rgba(255,255,255,0.2);
  border-radius: 12px;
  transition: background 0.2s ease;
}

.chat-attachment:hover {
  background: rgba(255,255,255,0.3);
}

.chat-attachment i {
  font-size: 20px;
}

.chat-attachment span {
  font-size: 12px;
}

.attachment-image {
  max-height: 200px;
  border-radius: 12px;
  max-width: 100%;
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

/* Star rating styling */
.star-rating {
  display: flex;
  flex-direction: row-reverse;
  justify-content: center;
  gap: 8px;
  margin: 10px 0;
}

.star-rating input {
  display: none;
}

.star-rating label {
  font-size: 28px;
  color: #ddd;
  cursor: pointer;
  transition: color 0.2s ease;
}

.star-rating label:before {
  content: "★";
}

.star-rating input:checked ~ label {
  color: var(--gold);
}

.star-rating label:hover,
.star-rating label:hover ~ label {
  color: var(--gold-light);
}

/* Form elements in modal */
.sacred-modal .form-group label {
  font-family: 'Cinzel', serif;
  font-size: 13px;
  font-weight: 600;
  color: var(--dark);
  margin-bottom: 8px;
}

.sacred-modal .form-control {
  font-family: 'Lato', sans-serif;
  font-size: 14px;
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 10px 14px;
  transition: border-color 0.2s ease;
}

.sacred-modal .form-control:focus {
  border-color: var(--gold);
  box-shadow: 0 0 0 3px var(--gold-glow);
  outline: none;
}

.sacred-modal textarea.form-control {
  resize: vertical;
}

/* Submit button in modal */
.modal-submit-btn {
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

.modal-submit-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(201,168,76,0.3);
}

/* Responsive */
@media (max-width: 768px) {
  .chat-messages-container {
    height: 400px;
    padding: 16px;
  }
  
  .message-bubble-left,
  .message-bubble-right {
    max-width: 85%;
  }
  
  .chat-header {
    padding: 12px 16px;
  }
  
  .astrologer-avatar {
    width: 44px;
    height: 44px;
  }
  
  .astrologer-name {
    font-size: 16px;
  }
  
  .review-btn {
    padding: 6px 18px;
    font-size: 11px;
  }
}

@media (max-width: 576px) {
  .chat-messages-container {
    height: 350px;
  }
  
  .message-bubble-left,
  .message-bubble-right {
    max-width: 90%;
  }
  
  .message-bubble-left .message-text,
  .message-bubble-right .message-text {
    font-size: 13px;
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

/* Loading state */
.chat-loading {
  text-align: center;
  padding: 40px;
  color: var(--text-mid);
  font-family: 'Lato', sans-serif;
}

/* Empty state */
.chat-empty {
  text-align: center;
  padding: 60px 20px;
  color: var(--text-mid);
  font-family: 'Lato', sans-serif;
}

.chat-empty i {
  font-size: 48px;
  color: var(--border);
  margin-bottom: 16px;
  display: inline-block;
}
</style>

<div class="chat-section">
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
            <div class="chat-card">
                <div class="row g-0">
                    <div class="col-12 col-lg-12 col-xl-12">

                        <!-- Chat Header -->
                        <div class="chat-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-3" style="gap: 15px;">
                                    <div class="position-relative">
                                        <img class="astrologer-avatar" 
                                             src="{{ Str::startsWith($getAstrologer['recordList'][0]['profileImage'], ['http://','https://']) ? $getAstrologer['recordList'][0]['profileImage'] : '/' . $getAstrologer['recordList'][0]['profileImage'] }}" 
                                             onerror="this.onerror=null;this.src='/build/assets/images/person.png';" 
                                             alt="{{ $getAstrologer['recordList'][0]['name'] }}" 
                                             onclick="openImage('{{ $getAstrologer['recordList'][0]['profileImage'] }}')" />
                                    </div>
                                    <div>
                                        <h2 class="astrologer-name">{{ $getAstrologer['recordList'][0]['name'] }}</h2>
                                        <div class="text-muted small" style="font-family: 'Lato', sans-serif; font-size: 12px;">
                                            <i class="fa fa-star" style="color: var(--gold);"></i> Sacred Guide
                                        </div>
                                    </div>
                                </div>

                                <div id="timerContainer">
                                    <button class="review-btn" data-toggle="modal" data-target="#reviewmodal" id="endChat">
                                        <i class="fa fa-star mr-2"></i>Share Review
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Chat Messages Area -->
                        <div class="position-relative">
                            <div class="chat-messages-container">
                                <!-- Messages will be dynamically loaded here -->
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </main>
        
    </div>
</div>

<!-- Review Modal - Styled -->
<div id="reviewmodal" class="modal fade sacred-modal" role="dialog">
    <div class="modal-dialog modal-sm h-100 d-flex align-items-center">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <i class="fa fa-star mr-2"></i>Share Your Experience
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="Review">
                    <input type="hidden" name="userId" id="userId" value="{{ $userId }}">
                    <input type="hidden" id="astrologerId" name="astrologerId" value="{{ $astrologerId }}">

                    <div class="text-center">
                        <div class="form-group">
                            <label for="rating">Your Rating</label>
                            <div class="star-rating"
                                data-rating="{{ isset($getUserHistoryReview['recordList'][0]['rating']) ? $getUserHistoryReview['recordList'][0]['rating'] : '' }}">
                                <input type="radio" id="star5" name="rating" value="5"><label for="star5"></label>
                                <input type="radio" id="star4" name="rating" value="4"><label for="star4"></label>
                                <input type="radio" id="star3" name="rating" value="3"><label for="star3"></label>
                                <input type="radio" id="star2" name="rating" value="2"><label for="star2"></label>
                                <input type="radio" id="star1" name="rating" value="1"><label for="star1"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="review">Your Review</label>
                            <textarea class="form-control" id="review" name="review" rows="3" placeholder="Share your sacred experience..." required>{{ isset($getUserHistoryReview['recordList'][0]['review']) ? $getUserHistoryReview['recordList'][0]['review'] : '' }}</textarea>
                        </div>
                        <button class="modal-submit-btn" id="reviewbtn">
                            <i class="fa fa-paper-plane mr-2"></i>Submit Review
                        </button>
                    </div>
                </form>
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
    
    $(document).ready(function() {
        var existingRating = "{{ isset($getUserHistoryReview['recordList'][0]['rating']) ? $getUserHistoryReview['recordList'][0]['rating'] : '' }}";
        $('.star-rating input[type="radio"]').filter(function() {
            return $(this).val() == existingRating;
        }).prop('checked', true);
    });

    var userId = "{{ $userId }}";
    var astrologerId = "{{ $astrologerId }}";

    const firestore = firebase.firestore();

    function fetchAndRenderMessages(receiverId, senderId) {
        const senderChatRef = firestore.collection('chats').doc(`${receiverId}_${senderId}`).collection('userschat')
            .doc(receiverId).collection('messages');

        senderChatRef.orderBy('createdAt', 'asc').onSnapshot(snapshot => {
            snapshot.docChanges().forEach(change => {
                if (change.type === 'added') {
                    const message = change.doc.data();
                    renderMessage(message, receiverId);
                }
            });
        });
    }

    function renderMessage(message, receiverId) {
        const chatMessagesContainer = document.querySelector('.chat-messages-container');
        const isScrolledToBottom = chatMessagesContainer.scrollHeight - chatMessagesContainer.clientHeight <=
            chatMessagesContainer.scrollTop + 1;

        const messageElement = document.createElement('div');
        messageElement.classList.add('chat-message');

        const timestamp = message.createdAt.toDate();
        const formattedTime = timestamp.toLocaleTimeString('en-US', {
            hour: 'numeric',
            minute: '2-digit'
        });

        @if($getAstrologer['recordList'][0]['profileImage'])
            var astroprofile = "/{{ $getAstrologer['recordList'][0]['profileImage'] }}";
        @else
            var astroprofile = "{{ asset('public/frontend/astrowaycdn/dashaspeaks/web/content/images/user-img-new.png') }}";
        @endif

        @if(authcheck()['profile'])
            var userprofile = "/{{ authcheck()['profile'] }}";
        @else
            var userprofile = "{{ asset('public/frontend/astrowaycdn/dashaspeaks/web/content/images/user-img-new.png') }}";
        @endif

        if (message.isEndMessage == true) {
            messageElement.classList.add('message-center');
            messageElement.innerHTML = `
                <div class="message-center-bubble">
                    <p class="message-text"><i class="fa fa-hand-peace-o mr-2"></i>${message.message}</p>
                </div>`;
        } else if (message.userId1 === receiverId) {
            messageElement.classList.add('chat-message-left');
            messageElement.innerHTML = `
                <div class="sender">
                    <img src="${astroprofile}" class="rounded-circle" alt="Astrologer">
                    <div class="message-time">${formattedTime}</div>
                </div>
                <div class="message-bubble-left">
                    <div class="message-sender-name">{{ $getAstrologer['recordList'][0]['name'] }}</div>
                    ${message.attachementPath ? renderAttachment(message.attachementPath) : `<p class="message-text">${message.message}</p>`}
                </div>`;
        } else {
            messageElement.classList.add('chat-message-right');
            messageElement.innerHTML = `
                <div class="message-bubble-right">
                    <div class="message-sender-name">You</div>
                    ${message.attachementPath ? renderAttachment(message.attachementPath) : `<p class="message-text">${message.message}</p>`}
                </div>
                <div class="you">
                    <img src="${userprofile}" class="rounded-circle" alt="You">
                    <div class="message-time">${formattedTime}</div>
                </div>`;
        }

        chatMessagesContainer.appendChild(messageElement);

        if (isScrolledToBottom) {
            chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;
        }
    }

    function renderAttachment(attachementPath) {
        if (!attachementPath) return '';

        const filePathWithoutParams = attachementPath.split('?')[0];
        const fileExtension = filePathWithoutParams.split('.').pop().toLowerCase();
        const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];

        if (imageExtensions.includes(fileExtension)) {
            return `<img src="${attachementPath}" class="attachment-image" alt="Attachment">`;
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
            <div class="chat-attachment" onclick="downloadFile('${attachementPath}')">
                <i class="fas ${fileIcon}"></i>
                <span>Attachment</span>
            </div>`;
    }

    document.addEventListener('DOMContentLoaded', function() {
        fetchAndRenderMessages(astrologerId, userId);
    });

    function downloadFile(url) {
        window.open(url, '_blank');
    }

    $('#reviewbtn').click(function(e) {
        e.preventDefault();

        var form = document.getElementById('Review');
        if (form.checkValidity() === false) {
            form.reportValidity();
            return;
        }

        @php
            use Symfony\Component\HttpFoundation\Session\Session;
            $session = new Session();
            $token = $session->get('token');
        @endphp

        var formData = $('#Review').serialize();

        $.ajax({
            url: "{{ route('api.addUserReview', ['token' => $token]) }}",
            type: 'POST',
            data: formData,
            success: function(response) {
                toastr.success('Review Added Successfully');
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
            },
            error: function(xhr, status, error) {
                toastr.error(xhr.responseText);
            }
        });
    });
</script>
@endsection