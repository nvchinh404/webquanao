@extends('layouts.app')

@section('content')
<div class="cart-container">
    <h1 class="cart-header">Giỏ Hàng Của Bạn</h1>
    
    @if(session('success'))
        <div class="alert alert-success">   
            {{ session('success') }}
        </div>
    @endif

    @if($cartItems->isEmpty())
    <div class="empty-cart">
        <p>Giỏ hàng của bạn đang trống</p>
        <a href="{{ route('products.index') }}" class="btn btn-primary">
            Tiếp tục mua sắm
        </a>
    </div>
@else
    <div class="cart-items">
        @foreach($cartItems as $item)
        <div class="cart-item">
            <img src="{{ asset('storage/' . $item->product->image) }}" 
                 alt="{{ $item->product->name }}" 
                 class="cart-item-image">
            
            <div class="cart-item-details">
                <h3>{{ $item->product->name }}</h3>
                <p class="cart-item-price">
                    {{ number_format($item->product->price, 0, ',', '.') }} VND
                </p>
                <p class="stock-info">
                    @if($item->product->stock_quantity > 0)
                        Còn {{ $item->product->stock_quantity }} sản phẩm
                    @else
                        <span class="text-danger">Hết hàng</span>
                    @endif
                </p>
                
                <div class="quantity-control">
                    <form action="{{ route('user.cart.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                        <button type="submit" class="quantity-btn" 
                                {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>
                    </form>
                    
                    <span>{{ $item->quantity }}</span>
                    
                    <form action="{{ route('user.cart.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                        <button type="submit" class="quantity-btn"
                                {{ $item->product->stock_quantity <= $item->quantity ? 'disabled' : '' }}>+</button>
                    </form>
                    
                    <form action="{{ route('user.cart.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Xóa
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="cart-item-total">
                {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }} VND
            </div>
        </div>
        @endforeach
    </div>
        
        <div class="cart-summary">
            <div class="summary-row">
                <span>Tạm tính:</span>
                <span>{{ number_format($total, 0, ',', '.') }} VND</span>
            </div>
            <div class="summary-row">
                <span>Phí vận chuyển:</span>
                <span>30,000 VND</span>
            </div>
            <div class="summary-row">
                <strong>Tổng cộng:</strong>
                <strong>{{ number_format($total + 30000, 0, ',', '.') }} VND</strong>
            </div>
            
            <a href="{{ route('checkout') }}" class="checkout-btn">
                Thanh Toán
            </a>
        </div>
    @endif
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@endsection