<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xác thực mã OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg,rgb(247, 215, 223),rgb(19, 18, 18));
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .auth-container {
            position: relative;
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .auth-container h2 {
            margin-bottom: 20px;
            font-weight: 700;
            color: #333;
        }
        .form-control {
            border-radius: 50px;
            padding: 12px;
            font-size: 16px;
            margin-bottom: 15px;
        }
        .btn-primary {
            width: 100%;
            border-radius: 50px;
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            padding: 12px;
            font-size: 16px;
            font-weight: 500;
            color: white;
            border: none;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .alert {
            margin-top: 10px;
        }
        .back-link {
            position: absolute;
            bottom: 10px;
            left: 20px;
            text-decoration: none;
            color: #ff416c;
            font-weight: 500;
            font-size: 14px;
        }
        .back-link:hover {
            color: #ff4b2b;
        }
        #otpInputs {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .otp-input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 20px;
            border-radius: 50px;
            border: 1px solid #ccc;
        }
        .resend-wrapper {
            margin-top: 15px;
        }
        .btn-link {
            text-decoration: none;
            font-size: 14px;
            color: #ff416c;
            font-weight: 500;
            background: none;
            border: none;
            padding: 0;
        }
        .btn-link:hover {
            color: #ff4b2b;
            text-decoration: underline;
        }
        .text-muted {
            color: #6c757d;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <h2>Xác thực mã OTP</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                   @foreach($errors->all() as $error)
                       <li>{{ $error }}</li>
                   @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('password.verify') }}" method="POST" id="otpForm">
            @csrf
            <input type="hidden" name="email" value="{{ session('email') }}">
            <div id="otpInputs">
                <input type="text" name="otp[]" maxlength="1" class="otp-input form-control">
                <input type="text" name="otp[]" maxlength="1" class="otp-input form-control">
                <input type="text" name="otp[]" maxlength="1" class="otp-input form-control">
                <input type="text" name="otp[]" maxlength="1" class="otp-input form-control">
                <input type="text" name="otp[]" maxlength="1" class="otp-input form-control">
                <input type="text" name="otp[]" maxlength="1" class="otp-input form-control">
            </div>
            <button type="submit" class="btn btn-primary">Xác nhận</button>
        </form>

        <div class="resend-wrapper">
            <form action="{{ route('password.resend') }}" method="POST">
                @csrf
                <input type="hidden" name="email" value="{{ session('email') }}">
                <button type="submit" class="btn-link" id="resendBtn" disabled>Gửi lại mã</button>
                <span id="timer" class="text-muted"></span>
            </form>
        </div>

        <a href="{{ route('password.request') }}" class="back-link">← Quay lại</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputs = document.querySelectorAll('.otp-input');

            inputs.forEach((input, index) => {
                input.addEventListener('keypress', function(e) {
                    const char = String.fromCharCode(e.which);
                    if (!/^\d$/.test(char)) {
                        e.preventDefault();
                    }
                });
                
                input.addEventListener('keyup', function(e) {
                    if (this.value.length === 1 && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                    if(e.key === "Backspace" && this.value === "" && index > 0) {
                        inputs[index - 1].focus();
                    }
                });
            });
            
            const resendBtn = document.getElementById('resendBtn');
            const timerSpan = document.getElementById('timer');
            let countdown = 60;
            resendBtn.disabled = true;
            timerSpan.textContent = ` (${countdown} giây)`;

            const interval = setInterval(() => {
                countdown--;
                timerSpan.textContent = ` (${countdown} giây)`;
                if (countdown <= 0) {
                    clearInterval(interval);
                    timerSpan.textContent = "";
                    resendBtn.disabled = false;
                }
            }, 1000);
        });
    </script>
</body>
</html>
