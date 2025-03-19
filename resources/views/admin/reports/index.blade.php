@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Báo cáo thống kê</h1>
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
    </div>
</div>
@endsection
