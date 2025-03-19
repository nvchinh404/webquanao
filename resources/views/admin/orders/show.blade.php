@extends('admin.layouts.app')

@section('content')
    <h1>Chi tiết Đơn hàng #{{ $order->id }}</h1>
    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Người đặt hàng:</strong> {{ $order->user ? $order->user->name : 'N/A' }}</p>
            <p><strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, ',', '.') }} đồng</p>
            <p><strong>Trạng thái:</strong> {{ $order->status }}</p>
            <p><strong>Phương thức thanh toán:</strong> {{ $order->payment_method }}</p>
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
            @foreach($order->details as $detail)
                <tr>
                    <td>{{ $detail->id }}</td>
                    <td>{{ $detail->product ? $detail->product->name : 'N/A' }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ number_format($detail->price, 0, ',', '.') }} đồng</td>
                    <td>{{ number_format($detail->quantity * $detail->price, 0, ',', '.') }} đồng</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Quay lại</a>
@endsection
