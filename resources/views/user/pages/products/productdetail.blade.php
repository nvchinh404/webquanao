@extends('users.layouts.app')

@section('title', $products->name)

@section('body')
<link rel="stylesheet" href="{{ asset('css/pages/product.css') }}">
<div class="content">
    <div class="product-image">
        @if($products->image_url)
            <img src="{{ $products->image_url }}" alt="{{ $products->name }}" class="img-thumbnail" style="cursor:pointer">
        @else
            N/A
        @endif
    </div>
    <div class="product-detail">
        <div class="product-name">
            <p>{{ $products->name }}</p>
        </div>
        <div class="product-price">
            <p>{{ number_format($products->price, 0, ',', '.') }} VND</p>
        </div>
        <div class="product-quantity">
            <h3 class="">Số lượng</h3>
            <div class="quantity-action">
                <button class="decrement">-</button>
                <input type="number" name="quantity" value="1" min="1" max="{{ $products->stock_quantity }}" 
                       class="quantity-input">
                <button class="increment">+</button>
            </div>
        </div>
        <div class="product-btn">
            <form action="#" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $products->id }}">
                <input type="hidden" name="size" value="L" id="selected-size">
                <div class="action-buttons">
                    <button type="submit" name="action" value="buy_now" 
                    class="btn-buy button">
                        Mua ngay
                    </button>
                    <button type="submit" name="action" value="add_to_cart" 
                    class="btn-add button">
                        Thêm vào giỏ hàng
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection