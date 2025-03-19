<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Import font Google Roboto */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        /* Reset cơ bản */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .auth-container {
            background-color: #ffffff;
            width: 100%;
            max-width: 400px;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .auth-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }
        .auth-container h1 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 700;
            color: #333333;
        }
        .auth-container .form-control {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 50px;
            font-size: 16px;
            transition: border 0.3s;
        }
        .auth-container .form-control:focus {
            outline: none;
            border-color: #ff416c;
        }
        .auth-container .btn-primary {
            width: 100%;
            padding: 12px 15px;
            border: none;
            border-radius: 50px;
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            color: #ffffff;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .auth-container .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .auth-container p {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666666;
        }
        .auth-container p a {
            color: #ff416c;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        .auth-container p a:hover {
            color: #ff4b2b;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <h1>Đăng ký</h1>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                   @foreach($errors->all() as $error)
                       <li>{{ $error }}</li>
                   @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <input type="text" name="name" class="form-control" placeholder="Tên" value="{{ old('name') }}" required>
            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
            <input type="text" name="phone" class="form-control" placeholder="Số điện thoại" value="{{ old('phone') }}">
            <input type="text" name="address" class="form-control" placeholder="Địa chỉ" value="{{ old('address') }}">
            <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu" required>
            <button type="submit" class="btn btn-primary">Đăng ký</button>
        </form>
        <p>Bạn đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p>
    </div>
</body>
</html>
