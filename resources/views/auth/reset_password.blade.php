<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đặt lại mật khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, rgb(247, 215, 223), rgb(19, 18, 18));
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
            border-radius: 50px;
            text-align: center;
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
            text-decoration: underline;
        }
        #errorMessage {
            color: #dc3545;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        @if(session('status'))
            <div class="alert alert-success" id="successMessage">
                {{ session('status') }}
            </div>
            <script>
                setTimeout(function(){
                    window.location.href = "{{ route('login') }}";
                }, 2000);
            </script>
        @endif

        <h2>Đặt lại mật khẩu</h2>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                   @foreach($errors->all() as $error)
                       <li>{{ $error }}</li>
                   @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('password.reset') }}" method="POST" id="resetPasswordForm">
            @csrf
            <input type="hidden" name="email" value="{{ session('email') ?? old('email') }}">
            <div class="mb-3">
                <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới" required>
            </div>
            <div class="mb-3">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu mới" required>
            </div>
            <button type="submit" class="btn btn-primary">Đặt lại mật khẩu</button>
        </form>
        <div id="errorMessage" class="mt-2"></div>
        
        <a href="{{ route('password.request') }}" class="back-link">← Quay lại</a>
    </div>

    <script>
        document.getElementById('resetPasswordForm').addEventListener('submit', function(e) {
            let password = document.getElementById('password').value;
            let confirmPassword = document.getElementById('password_confirmation').value;
            if (password !== confirmPassword) {
                e.preventDefault();
                document.getElementById('errorMessage').textContent = 'Mật khẩu không khớp. Vui lòng nhập lại.';
            }
        });
    </script>
</body>
</html>