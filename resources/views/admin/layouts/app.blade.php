<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ Admin</title>
    <!-- Sử dụng Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tổng thể */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #ecf0f1;
        }
        .wrapper {
            display: flex;
            min-height: 100vh;
        }
        /* Sidebar */
        .sidebar {
            width: 250px;
            background: linear-gradient(135deg, #2c3e50, #34495e);
            color: #ecf0f1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .sidebar h2 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        .sidebar ul {
            list-style: none;
            padding-left: 0;
        }
        .sidebar ul li {
            margin-bottom: 10px;
        }
        .sidebar ul li a {
            color: #ecf0f1;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .sidebar ul li a:hover,
        .sidebar ul li a.active {
            background-color: #1abc9c;
        }
        /* Nút đăng xuất ở cuối sidebar */
        .logout-btn {
            margin-top: 20px;
        }
        .logout-btn form button {
            width: 100%;
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .logout-btn form button:hover {
            background-color: #c0392b;
        }
        /* Nội dung chính */
        .main-content {
            flex: 1;
            padding: 20px;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar bên trái -->
        <div class="sidebar">
            <div>
                <h2 href="{{ route('admin.dashboard') }}">Trang chủ Admin</h2>
                <ul>
                    <li><a href="{{ route('admin.users.index') }}">Người dùng</a></li>
                    <li><a href="{{ route('admin.categories.index') }}">Danh mục</a></li>
                    <li><a href="{{ route('admin.products.index') }}">Sản phẩm</a></li>
                    <li><a href="{{ route('admin.brands.index') }}">Nhãn hiệu</a></li>
                    <li><a href="{{ route('admin.reports.index') }}">Báo cáo</a></li>
                    <li><a href="{{ route('orders.index') }}">Đơn hàng</a></li>

                </ul>   
            </div>
            <div class="logout-btn">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit">Đăng xuất</button>
                </form>
            </div>
        </div>
        <!-- Nội dung chính -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
