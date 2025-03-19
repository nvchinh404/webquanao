<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đặt lại mật khẩu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            padding: 20px;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            color: #ff416c;
        }
        .code {
            font-size: 32px;
            color: #e74c3c;
            text-align: center;
            margin: 20px 0;
            letter-spacing: 2px;
        }
        .footer {
            font-size: 14px;
            color: #777;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h2>Đặt lại mật khẩu</h2>
        </div>
        <p>Xin chào,</p>
        <p>Bạn đã yêu cầu đặt lại mật khẩu. Đây là mã xác nhận của bạn:</p>
        <div class="code">{{ $code }}</div>
        <p>Mã này chỉ có hiệu lực trong 60 giây. Nếu bạn không yêu cầu đặt lại mật khẩu, hãy bỏ qua email này.</p>
        <div class="footer">
            <p>Trân trọng,<br>Đội ngũ hỗ trợ</p>
        </div>
    </div>
</body>
</html>
