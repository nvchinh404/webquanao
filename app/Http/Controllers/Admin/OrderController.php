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
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // Hiển thị chi tiết đơn hàng
    public function show(Order $order)
    {
        // Load thêm thông tin chi tiết đơn hàng nếu cần
        $order->load('orderDetails.product');
        return view('admin.orders.show', compact('order'));
    }

    // Hiển thị form chỉnh sửa đơn hàng
    public function edit(Order $order)
    {
        // Định nghĩa các trạng thái và phương thức thanh toán hợp lệ
        $statusOptions = [
            'pending' => 'Đang xử lý',
            'shipping' => 'Đang giao hàng',
            'completed' => 'Hoàn thành',
            'cancelled' => 'Đã hủy'
        ];
        
        $paymentMethodOptions = [
            'cod' => 'Thanh toán khi nhận hàng (COD)',
            'bank_transfer' => 'Chuyển khoản ngân hàng',
            'credit_card' => 'Thẻ tín dụng',
            'e_wallet' => 'Ví điện tử'
        ];

        return view('admin.orders.edit', compact('order', 'statusOptions', 'paymentMethodOptions'));
    }

    // Cập nhật đơn hàng
    public function update(Request $request, Order $order)
    {
        // Xác thực dữ liệu phù hợp với database
        $validated = $request->validate([
            'status' => 'required|in:pending,shipping,completed,cancelled',
            'payment_method' => 'required|in:cod,bank_transfer,credit_card,e_wallet',
        ]);

        $order->update($validated);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Đơn hàng đã được cập nhật thành công.');
    }

    // Xóa đơn hàng
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')
            ->with('success', 'Đơn hàng đã được xóa thành công.');
    }

    // Hàm helper để chuyển đổi status sang tiếng Việt (nếu cần)
    protected function getStatusText($status)
    {
        $statuses = [
            'pending' => 'Đang xử lý',
            'shipping' => 'Đang giao hàng',
            'completed' => 'Hoàn thành',
            'cancelled' => 'Đã hủy'
        ];
        return $statuses[$status] ?? $status;
    }
}