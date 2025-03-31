@include('admin.layouts.app')

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Bạn có thể thêm link Bootstrap hoặc CSS khác tại đây -->
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar bên trái -->
        <div class="sidebar">
            <div>
                <h2>Trang chủ admin</h2>
                <ul>
                    <li><a href="{{ route('admin.users.index') }}"> Người dùng</a></li>
                    <li><a href="{{ route('admin.categories.index') }}"> Danh mục</a></li>
                    <li><a href="{{ route('admin.products.index') }}"> Sản phẩm</a></li>
                    <li><a href="{{ route('admin.brands.index') }}"> Nhãn hiệu</a></li>
                    <li><a href="{{ route('reports.index') }}"> Báo cáo</a></li>
                    <li><a href="{{ route('admin.orders.index') }}"> Đơn hàng</a></li>
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
            <!-- Thanh navbar trên cùng -->
            <div class="navbar-top">
                <span>Xin chào, Admin {{ auth()->user()->name ?? 'Admin' }}</span>
            </div>
            <!-- Nội dung Dashboard -->
            <div class="container mt-4">
                <h2>Chào mừng, Admin User (Admin)</h2>
                <div class="row">
                    <!-- Card: Tổng số người đăng ký -->
                    <div class="col-md-4">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-header">Người dùng đăng ký</div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $totalUsers }}</h5>
                                <p class="card-text">Tổng số người dùng đã đăng ký</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card: Thu nhập -->
                    <div class="col-md-4">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-header">Thu nhập</div>
                            <div class="card-body">
                                <h5 class="card-title">{{ number_format($totalIncome, 0, ',', '.') }} VND</h5>
                                <p class="card-text">Tổng thu nhập từ các đơn hàng đã thanh toán thành công</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card: Tổng đơn hàng thành công -->
                    <div class="col-md-4">
                        <div class="card text-white bg-info mb-3">
                            <div class="card-header">Đơn hàng thành công</div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $totalOrdersPaid }}</h5>
                                <p class="card-text">Tổng số đơn hàng đã thanh toán thành công</p>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
