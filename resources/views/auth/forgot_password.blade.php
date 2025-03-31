<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quên mật khẩu</title>
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
            position: relative; /* Để định vị nút quay lại bên trong */
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
        /* Nút quay lại */
        .back-link {
            position: absolute;
            bottom: 10px;    /* Canh dưới */
            left: 20px;      /* Canh trái */
            text-decoration: none;
            color: #ff416c;
            font-weight: 500;
            font-size: 14px;
        }
        .back-link:hover {
            color: #ff4b2b;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <h2>Quên mật khẩu</h2>
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <input type="email" name="email" class="form-control" placeholder="Nhập email" required>
            <button type="submit" class="btn btn-primary">Gửi mã xác nhận</button>
            
            @if ($errors->has('email'))
                <div class="alert alert-danger">
                    {{ $errors->first('email') }}
                    @if (session('register_link'))
                        <br>
                        <a href="{{ session('register_link') }}">Bạn có muốn đăng ký không?</a>
                    @endif
                </div>
            @endif
        </form>
        <!-- Đường dẫn quay lại -->
        <a href="{{ route('login') }}" class="back-link">← Quay lại</a>
    </div>
</body>
</html>
