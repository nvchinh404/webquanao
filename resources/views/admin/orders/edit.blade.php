@extends('admin.layouts.app')

@section('content')
    <h1>Sửa Đơn hàng #{{ $order->id }}</h1>
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label">Trạng thái:</label>
            <select name="status" class="form-select" required>
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Đang xử lý</option>
                <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}>Đang giao hàng</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Phương thức thanh toán:</label>
            <select name="payment_method" class="form-select" required>
                <option value="cod" {{ $order->payment_method == 'cod' ? 'selected' : '' }}>Thanh toán khi nhận hàng (COD)</option>
                <option value="bank_transfer" {{ $order->payment_method == 'bank_transfer' ? 'selected' : '' }}>Chuyển khoản ngân hàng</option>
                <option value="credit_card" {{ $order->payment_method == 'credit_card' ? 'selected' : '' }}>Thẻ tín dụng</option>
                <option value="e_wallet" {{ $order->payment_method == 'e_wallet' ? 'selected' : '' }}>Ví điện tử</option>
            </select>
        </div>
        
        <button class="btn btn-success" type="submit">Cập nhật</button>
    </form>
@endsection