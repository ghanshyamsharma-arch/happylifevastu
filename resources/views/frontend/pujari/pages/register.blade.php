<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pujari Registration</title>
    <link rel="icon" href="/{{ $logo->value ?? '' }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="Register as a Pujari - List Your Services and Grow Your Business" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('public/frontend/css/newcss.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.min.css"
        integrity="sha512-OWGg8FcHstyYFwtjfkiCoYHW2hG3PDWwdtczPAPUcETobBJOVCouKig8rqED0NMLcT9GtE4jw6IT1CSrwY87uw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="{{ asset('public/build/assets/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @php
        $logo = DB::table('systemflag')->where('name', 'AdminLogo')->select('value')->first();
        $appName = DB::table('systemflag')->where('name', 'AppName')->select('value')->first();
    @endphp

    <style>
        :root {
            --primary-color: #FF6B35;
            --secondary-color: #004E89;
            --danger-color: #EE4E5E;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 20px 0;
        }

        .register-container {
            width: 100%;
            max-width: 450px;
            margin: 20px auto;
            padding: 0 20px;
        }

        .register-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .register-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 30px 20px;
            text-align: center;
            color: white;
        }

        .register-header h1 {
            font-size: 28px;
            margin: 0;
            font-weight: 700;
        }

        .register-header p {
            margin: 5px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
        }

        .register-logo {
            width: 60px;
            height: 60px;
            margin: 0 auto 15px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
        }

        .register-body {
            padding: 30px 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-row .form-group {
            margin-bottom: 0;
        }

        .btn-register {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            margin-top: 10px;
        }

        .btn-register:active {
            transform: scale(0.98);
        }

        .btn-register:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .form-footer {
            text-align: center;
            padding: 20px 0 0 0;
            border-top: 1px solid #f0f0f0;
            margin-top: 20px;
        }

        .form-footer p {
            margin: 0;
            color: #666;
            font-size: 14px;
        }

        .form-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .helper-text {
            color: #999;
            font-size: 13px;
            margin-top: 5px;
        }

        .terms-checkbox {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 20px 0;
            color: #666;
            font-size: 13px;
        }

        .terms-checkbox input {
            width: auto;
            margin: 0;
            cursor: pointer;
            width: 18px;
            height: 18px;
        }

        .terms-checkbox a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @media (max-width: 480px) {
            .register-container {
                padding: 10px;
            }

            .register-body {
                padding: 20px 15px;
            }

            .register-header h1 {
                font-size: 24px;
            }

            .register-header {
                padding: 20px 15px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }

        .step {
            text-align: center;
            flex: 1;
        }

        .step-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #f0f0f0;
            color: #999;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .step.active .step-number {
            background: var(--primary-color);
            color: white;
        }

        .step-label {
            font-size: 12px;
            color: #999;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="register-card">
            <!-- Header -->
            <div class="register-header">
                <div class="register-logo">🙏</div>
                <h1>Join Pujari Portal</h1>
                <p>Grow Your Business Online</p>
            </div>

            <!-- Body -->
            <div class="register-body">

                <form id="registerForm" method="POST" action="{{ route('front.pujariVerifyLogin') }}">
                    @csrf

                    <!-- Step Indicator -->
                    <div class="step-indicator">
                        <div class="step active" id="step1">
                            <div class="step-number">1</div>
                            <div class="step-label">Basic Info</div>
                        </div>
                        <div class="step" id="step2">
                            <div class="step-number">2</div>
                            <div class="step-label">Details</div>
                        </div>
                        <div class="step" id="step3">
                            <div class="step-number">3</div>
                            <div class="step-label">Verify</div>
                        </div>
                    </div>

                    <!-- Step 1: Basic Information -->
                    <div id="basicInfo">
                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" placeholder="Enter 10-digit number"
                                maxlength="10" pattern="[0-9]{10}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email (optional)">
                        </div>

                        <button type="button" class="btn-register" onclick="nextStep()">
                            Continue
                        </button>
                    </div>

                    <!-- Step 2: Additional Details -->
                    <div id="additionalInfo" style="display: none;">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="experience">Experience (Years) *</label>
                                <input type="number" id="experience" name="experience" min="0" max="70"
                                    placeholder="Years" required>
                            </div>
                            <div class="form-group">
                                <label for="city">City/Area *</label>
                                <input type="text" id="city" name="city" placeholder="Your city" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="specialization">Specialization *</label>
                            <input type="text" id="specialization" name="specialization"
                                placeholder="e.g. Pooja Rituals, Havan, etc." required>
                        </div>

                        <div class="form-group">
                            <label for="bio">About You</label>
                            <textarea style="width: 100%; padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; font-family: inherit; resize: none; height: 80px;"
                                id="bio" name="bio" placeholder="Tell about your services..." maxlength="500"></textarea>
                        </div>

                        <div style="display: flex; gap: 10px;">
                            <button type="button" class="btn-register" style="background: #ccc; color: #333;" onclick="prevStep()">
                                Back
                            </button>
                            <button type="button" class="btn-register" onclick="nextStep()">
                                Continue
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Verification -->
                    <div id="verification" style="display: none;">
                        <div class="form-group">
                            <label>Verify Your Phone Number *</label>
                            <p style="color: #666; font-size: 14px; margin-bottom: 15px;">
                                We've sent an OTP to <strong id="displayPhone"></strong>
                            </p>
                            <input type="text" id="otp" name="otp" placeholder="Enter 6-digit OTP" maxlength="6"
                                pattern="[0-9]{6}" required>
                        </div>

                        <div class="terms-checkbox">
                            <input type="checkbox" id="agree" name="agree" required>
                            <label for="agree" style="margin: 0;">I agree to the <a href="#" target="_blank">Terms & Conditions</a></label>
                        </div>

                        <div style="display: flex; gap: 10px;">
                            <button type="button" class="btn-register" style="background: #ccc; color: #333;" onclick="prevStep()">
                                Back
                            </button>
                            <button type="submit" class="btn-register" id="submitBtn">
                                Complete Registration
                            </button>
                        </div>

                        <div style="text-align: center; margin-top: 15px;">
                            <button type="button" style="background: none; border: none; color: var(--primary-color); cursor: pointer; font-weight: 600; font-size: 13px;"
                                onclick="resendOtp()">
                                Didn't receive OTP? <u>Resend</u>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Footer -->
                <div class="form-footer">
                    <p>Already have an account? <a href="{{ route('front.pujariLogin') }}">Login here</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.all.min.js"></script>
    <script>
        let currentStep = 1;
        let otpSent = false;

        function nextStep() {
            if (currentStep === 1) {
                if (!validateStep1()) return;
                currentStep = 2;
            } else if (currentStep === 2) {
                if (!validateStep2()) return;
                currentStep = 3;
                sendOtp();
                return;
            }
            updateSteps();
        }

        function prevStep() {
            currentStep--;
            updateSteps();
        }

        function updateSteps() {
            document.getElementById('basicInfo').style.display = currentStep === 1 ? 'block' : 'none';
            document.getElementById('additionalInfo').style.display = currentStep === 2 ? 'block' : 'none';
            document.getElementById('verification').style.display = currentStep === 3 ? 'block' : 'none';

            document.getElementById('step1').classList.toggle('active', currentStep >= 1);
            document.getElementById('step2').classList.toggle('active', currentStep >= 2);
            document.getElementById('step3').classList.toggle('active', currentStep >= 3);
        }

        function validateStep1() {
            const name = document.getElementById('name').value.trim();
            const phone = document.getElementById('phone').value.trim();

            if (!name || name.length < 3) {
                toastr.error('Please enter a valid name');
                return false;
            }

            if (!phone || phone.length !== 10) {
                toastr.error('Please enter a valid 10-digit phone number');
                return false;
            }

            document.getElementById('displayPhone').textContent = phone;
            return true;
        }

        function validateStep2() {
            const experience = document.getElementById('experience').value;
            const city = document.getElementById('city').value.trim();
            const specialization = document.getElementById('specialization').value.trim();

            if (!experience) {
                toastr.error('Please enter your experience');
                return false;
            }

            if (!city || city.length < 2) {
                toastr.error('Please enter your city');
                return false;
            }

            if (!specialization || specialization.length < 3) {
                toastr.error('Please enter your specialization');
                return false;
            }

            return true;
        }

        function sendOtp() {
            const phone = document.getElementById('phone').value;

            $.ajax({
                url: '{{ route("front.pujariSendOtp") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    phone: phone
                },
                success: function(response) {
                    if (response.status === 200) {
                       
                        toastr.success('OTP sent to your phone');
                        otpSent = true;
                        currentStep = 3;
                        updateSteps();
                    } else {
                        toastr.error(response.message || 'Failed to send OTP');
                        currentStep = 2;
                        updateSteps();
                    }
                },
                error: function() {
                    toastr.error('Error sending OTP');
                    currentStep = 2;
                    updateSteps();
                }
            });
        }

        function resendOtp() {
            const phone = document.getElementById('phone').value;

            $.ajax({
                url: '{{ route("front.pujariSendOtp") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    phone: phone
                },
                success: function(response) {
                    toastr.success('OTP resent successfully');
                },
                error: function() {
                    toastr.error('Error resending OTP');
                }
            });
        }

        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const otp = document.getElementById('otp').value;
            const agree = document.getElementById('agree').checked;

            if (!otp || otp.length !== 6) {
                toastr.error('Please enter a valid 6-digit OTP');
                return;
            }

            if (!agree) {
                toastr.error('Please agree to terms and conditions');
                return;
            }

            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner"></span> Registering...';

            const formData = new FormData(this);

            $.ajax({
                url: '{{ route("front.pujariVerifyLogin") }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === 200) {
                        toastr.success('Registration successful! Redirecting...');
                        setTimeout(() => {
                            window.location.href = '{{ route("front.pujariDashboard") }}';
                        }, 1500);
                    } else {
                        toastr.error(response.message || 'Registration failed');
                        btn.disabled = false;
                        btn.innerHTML = 'Complete Registration';
                        setTimeout(() => {
                            window.location.href = '{{ route("front.pujariList") }}';
                        }, 1500);
                    }
                },
                error: function(xhr) {
                    const error = xhr.responseJSON?.message || 'Error during registration';
                    toastr.error(error);
                    btn.disabled = false;
                    btn.innerHTML = 'Complete Registration';
                }
            });
        });
    </script>
</body>

</html>
