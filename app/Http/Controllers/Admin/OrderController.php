<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng
    public function index()
    {
        // Lấy đơn hàng kèm theo thông tin người dùng (nếu có)
        $orders = Order::with('user')->get();
        return view('admin.orders.index', compact('orders'));
    }

    // Hiển thị chi tiết đơn hàng
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    // Hiển thị form chỉnh sửa đơn hàng
    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    // Cập nhật đơn hàng
    public function update(Request $request, Order $order)
    {
        // Xác thực dữ liệu: status chỉ chấp nhận 3 giá trị và payment_method 4 giá trị
        $validated = $request->validate([
            'status'          => 'required|in:hoàn thành,đang xử lý,hủy',
            'payment_method'  => 'required|in:COD,chuyển khoản,credit card,tiền mặt',
        ]);

        $order->update($validated);

        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã được cập nhật thành công.');
    }

    // Xóa đơn hàng
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã được xóa thành công.');
    }
}
