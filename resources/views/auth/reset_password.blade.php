<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đặt lại mật khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .reset-container {
            position: relative;
            margin-top: 40px;
            padding: 20px;
        }
        /* Nút quay lại ở góc dưới bên trái của container */
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
    <div class="container reset-container">
        @if(session('status'))
            <div class="alert alert-success" id="successMessage">
                {{ session('status') }}
            </div>
            <script>
                setTimeout(function(){
                    window.location.href = "{{ route('login') }}";
                }, 2000); // chuyển hướng sau 2 giây
            </script>
        @endif

        <h2>Đặt lại mật khẩu</h2>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                   @foreach($errors->all() as $error)
                       <li>{{ $error }}</li>
                   @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('password.reset') }}" method="POST" id="resetPasswordForm">
            @csrf
            <!-- Sử dụng session hoặc old input để đảm bảo trường email có giá trị -->
            <input type="hidden" name="email" value="{{ session('email') ?? old('email') }}">
            <div class="mb-3">
                <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới" required>
            </div>
            <div class="mb-3">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu mới" required>
            </div>
            <button type="submit" class="btn btn-primary">Đặt lại mật khẩu</button>
        </form>
        <div id="errorMessage" class="text-danger mt-2"></div>
        
        <!-- Đường dẫn "← Quay lại" ở góc dưới bên trái, quay về trang quên mật khẩu -->
        <a href="{{ route('password.request') }}" class="back-link">← Quay lại</a>
    </div>

    <script>
        // Kiểm tra xem hai trường mật khẩu có khớp không
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
