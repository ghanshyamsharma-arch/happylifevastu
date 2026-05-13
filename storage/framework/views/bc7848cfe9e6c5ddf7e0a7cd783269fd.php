<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pujari Login</title>
    <link rel="icon" href="/<?php echo e($logo->value ?? ''); ?>" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="Login to Pujari Portal - Book Pujas and Manage Your Schedule" />

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('public/frontend/css/newcss.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/frontend/css/app.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/frontend/css/app.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.min.css"
        integrity="sha512-OWGg8FcHstyYFwtjfkiCoYHW2hG3PDWwdtczPAPUcETobBJOVCouKig8rqED0NMLcT9GtE4jw6IT1CSrwY87uw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="<?php echo e(asset('public/build/assets/jquery.min.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <?php
        $logo = DB::table('systemflag')->where('name', 'AdminLogo')->select('value')->first();
        $appName = DB::table('systemflag')->where('name', 'AppName')->select('value')->first();
    ?>

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
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 30px 20px;
            text-align: center;
            color: white;
        }

        .login-header h1 {
            font-size: 28px;
            margin: 0;
            font-weight: 700;
        }

        .login-header p {
            margin: 5px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
        }

        .login-logo {
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

        .login-body {
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

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
        }

        .btn-login {
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

        .btn-login:active {
            transform: scale(0.98);
        }

        .btn-login:disabled {
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

        .otp-section {
            display: none;
        }

        .otp-inputs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            justify-content: space-between;
        }

        .otp-input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
        }

        .otp-input:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 10px;
            }

            .login-body {
                padding: 20px 15px;
            }

            .login-header h1 {
                font-size: 24px;
            }

            .login-header {
                padding: 20px 15px;
            }

            .otp-input {
                width: 40px;
                height: 40px;
                font-size: 18px;
            }
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
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <div class="login-logo">🙏</div>
                <h1>Pujari Portal</h1>
                <p>Manage Your Bookings & Services</p>
            </div>

            <!-- Body -->
            <div class="login-body">
                <!-- Phone Section -->
                <div class="phone-section">
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter 10-digit number"
                            maxlength="10" pattern="[0-9]{10}" required>
                        <div class="helper-text">We'll send OTP to this number</div>
                    </div>

                    <button type="button" class="btn-login" id="sendOtpBtn" onclick="sendOtp()">
                        Send OTP
                    </button>
                </div>

                <!-- OTP Verification Section -->
                <div class="otp-section" id="otpSection">
                    <div class="form-group">
                        <label>Enter OTP</label>
                        <div class="otp-inputs">
                            <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" autofocus>
                            <input type="text" class="otp-input" maxlength="1" pattern="[0-9]">
                            <input type="text" class="otp-input" maxlength="1" pattern="[0-9]">
                            <input type="text" class="otp-input" maxlength="1" pattern="[0-9]">
                            <input type="text" class="otp-input" maxlength="1" pattern="[0-9]">
                            <input type="text" class="otp-input" maxlength="1" pattern="[0-9]">
                        </div>
                        <div class="helper-text" id="otpTimer"></div>
                    </div>

                    <button type="button" class="btn-login" id="verifyOtpBtn" onclick="verifyOtp()">
                        Verify & Login
                    </button>

                    <div style="text-align: center; margin-top: 15px;">
                        <button type="button" style="background: none; border: none; color: var(--primary-color); cursor: pointer; font-weight: 600;"
                            onclick="changePhone()">
                            Change Phone Number
                        </button>
                    </div>
                </div>

                <!-- Footer -->
                <div class="form-footer">
                    <p>Don't have account? <a href="<?php echo e(route('front.pujariRegister')); ?>">Register here</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.all.min.js"></script>
    <script>
        let otpTimer = null;
        let otpTimeRemaining = 0;

        function sendOtp() {
            const phone = document.getElementById('phone').value;

            if (!phone || phone.length !== 10) {
                toastr.error('Please enter a valid 10-digit phone number');
                return;
            }

            const btn = document.getElementById('sendOtpBtn');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner"></span> Sending...';

            $.ajax({
                url: '<?php echo e(route("front.pujariSendOtp")); ?>',
                method: 'POST',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    phone: phone
                },
                success: function(response) {
                    if (response.status === 200) {
                        toastr.success('OTP sent successfully');
                        document.querySelector('.phone-section').style.display = 'none';
                        document.getElementById('otpSection').style.display = 'block';
                        startOtpTimer();
                    } else {
                        toastr.error(response.message || 'Failed to send OTP');
                        btn.disabled = false;
                        btn.innerHTML = 'Send OTP';
                    }
                },
                error: function(xhr) {
                    toastr.error('Error sending OTP');
                    btn.disabled = false;
                    btn.innerHTML = 'Send OTP';
                }
            });
        }

        function verifyOtp() {
            const phone = document.getElementById('phone').value;
            const otpInputs = document.querySelectorAll('.otp-input');
            let otp = '';

            otpInputs.forEach(input => {
                otp += input.value;
            });

            if (otp.length !== 6) {
                toastr.error('Please enter complete OTP');
                return;
            }

            const btn = document.getElementById('verifyOtpBtn');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner"></span> Verifying...';

            $.ajax({
                url: '<?php echo e(route("front.pujariVerifyLogin")); ?>',
                method: 'POST',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    phone: phone,
                    otp: otp
                },
                success: function(response) {
                    if (response.status === 200) {
                        toastr.success('Login successful');
                        setTimeout(() => {
                            window.location.href = '<?php echo e(route("front.pujariDashboard")); ?>';
                        }, 1000);
                    } else {
                        toastr.error(response.message || 'Invalid OTP');
                        btn.disabled = false;
                        btn.innerHTML = 'Verify & Login';
                    }
                },
                error: function(xhr) {
                    const error = xhr.responseJSON?.message || 'Error verifying OTP';
                    toastr.error(error);
                    btn.disabled = false;
                    btn.innerHTML = 'Verify & Login';
                }
            });
        }

        function changePhone() {
            document.querySelector('.phone-section').style.display = 'block';
            document.getElementById('otpSection').style.display = 'none';
            document.getElementById('phone').value = '';
            clearInterval(otpTimer);
            document.querySelectorAll('.otp-input').forEach(input => input.value = '');
        }

        function startOtpTimer() {
            otpTimeRemaining = 300; // 5 minutes
            updateOtpTimer();
            otpTimer = setInterval(updateOtpTimer, 1000);
        }

        function updateOtpTimer() {
            const minutes = Math.floor(otpTimeRemaining / 60);
            const seconds = otpTimeRemaining % 60;
            document.getElementById('otpTimer').textContent = 
                `OTP expires in ${minutes}:${seconds.toString().padStart(2, '0')}`;

            if (otpTimeRemaining <= 0) {
                clearInterval(otpTimer);
                document.getElementById('otpTimer').textContent = 'OTP expired';
                changePhone();
                toastr.warning('OTP expired. Please request a new one.');
            }

            otpTimeRemaining--;
        }

        // Auto-move to next OTP input
        document.querySelectorAll('.otp-input').forEach((input, index) => {
            input.addEventListener('input', (e) => {
                if (e.target.value.length === 1 && index < 5) {
                    document.querySelectorAll('.otp-input')[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    document.querySelectorAll('.otp-input')[index - 1].focus();
                }
            });
        });
    </script>
</body>

</html>
<?php /**PATH /home/happylifevastu/public_html/resources/views/frontend/pujari/pages/login.blade.php ENDPATH**/ ?>