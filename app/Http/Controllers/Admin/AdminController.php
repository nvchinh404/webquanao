<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
{
    // Lấy số người dùng
    $totalUsers = \App\Models\User::count();

    // Thu nhập (ví dụ)
    $totalIncome = \App\Models\Order::where('status', 'paid')->sum('total_price');

    // Tổng đơn hàng đã thanh toán
    $totalOrdersPaid = \App\Models\Order::where('status', 'paid')->count();

    // Trả về view kèm theo các biến
    return view('admin.dashboard', compact('totalUsers', 'totalIncome', 'totalOrdersPaid'));
}

}
