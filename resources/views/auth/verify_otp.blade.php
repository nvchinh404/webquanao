<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xác thực mã OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Roboto', sans-serif;
            position: relative;
            margin: 0;
            padding: 0;
        }
        .form-container {
            position: relative;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        #otpInputs {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin-bottom: 15px;
        }
        .otp-input {
            width: 40px;
            text-align: center;
            padding: 10px;
            font-size: 16px;
        }
        .btn-link {
            text-decoration: none;
            font-size: 14px;
            color: #007bff;
        }
        .btn-link:hover {
            color: #0056b3;
        }
        .resend-wrapper {
            margin-top: 15px;
        }
        /* Đặt đường dẫn "← Quay lại" ở góc dưới bên trái của container */
        .back-link {
            position: absolute;
            bottom: 10px;
            left: 10px;
            text-decoration: none;
            color: #007bff;
            font-size: 14px;
            font-weight: 500;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="mb-3">Xác thực mã OTP</h2>
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

        <!-- Nút gửi lại mã với timer -->
        <div class="resend-wrapper">
            <form action="{{ route('password.resend') }}" method="POST">
                @csrf
                <input type="hidden" name="email" value="{{ session('email') }}">
                <button type="submit" class="btn btn-link" id="resendBtn" disabled>Gửi lại mã</button>
                <span id="timer" class="text-muted"></span>
            </form>
        </div>

        <!-- Đường dẫn "← Quay lại" quay về trang quên mật khẩu -->
        <a href="{{ route('password.request') }}" class="back-link">← Quay lại</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputs = document.querySelectorAll('.otp-input');

            // Chỉ cho phép nhập số
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
            
            // Đếm ngược 60 giây cho nút gửi lại mã
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
