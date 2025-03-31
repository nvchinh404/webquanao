<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Tổng số người đăng ký
        $totalUsers = User::count();

        // Tổng thu nhập từ các đơn hàng đã thanh toán thành công (sử dụng cột total_price)
        $totalIncome = Order::where('status', 'completed')->sum('total_price');

        // Tổng số đơn hàng đã thanh toán thành công
        $totalOrdersPaid = Order::where('status', 'completed')->count();

        return view('admin.reports.index', compact('totalUsers', 'totalIncome', 'totalOrdersPaid'));
    }
}
