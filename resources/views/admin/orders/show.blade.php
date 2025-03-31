@extends('admin.layouts.app')

@section('content')
    <h1>Chi tiết Đơn hàng #{{ $order->id }}</h1>
    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Người đặt hàng:</strong> {{ $order->user ? $order->user->name : 'N/A' }}</p>
            <p><strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, ',', '.') }} đồng</p>
            <p><strong>Trạng thái:</strong> 
                @switch($order->status)
                    @case('pending') Đang xử lý @break
                    @case('shipping') Đang giao hàng @break
                    @case('completed') Hoàn thành @break
                    @case('cancelled') Đã hủy @break
                    @default {{ $order->status }}
                @endswitch
            </p>
            <p><strong>Phương thức thanh toán:</strong> 
                @switch($order->payment_method)
                    @case('cod') COD @break
                    @case('bank_transfer') Chuyển khoản @break
                    @case('credit_card') Thẻ tín dụng @break
                    @case('e_wallet') Ví điện tử @break
                    @default {{ $order->payment_method }}
                @endswitch
            </p>
            <p><strong>Ngày tạo:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Ngày cập nhật:</strong> {{ $order->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <h3>Chi tiết đơn hàng</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @forelse($order->orderDetails as $detail)
                <tr>
                    <td>{{ $detail->id }}</td>
                    <td>{{ $detail->product ? $detail->product->name : 'Sản phẩm đã bị xóa' }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ number_format($detail->price, 0, ',', '.') }} đồng</td>
                    <td>{{ number_format($detail->quantity * $detail->price, 0, ',', '.') }} đồng</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Không có sản phẩm nào trong đơn hàng</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Quay lại</a>
@endsection