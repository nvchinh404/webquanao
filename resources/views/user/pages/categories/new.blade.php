@extends('users.layouts.app')

@section('Hàng mói',)

@section('body')
<link rel="stylesheet" href="{{ asset('css/home/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/pages/new.css') }}">
<div class="new-block">
    <div class="new-banner">
        <img src="https://img3.thuthuatphanmem.vn/uploads/2019/10/14/banner-thoi-trang-hien-dai-dep-nhat_113857069.jpg" >
    </div>
    <h1>KHÁM PHÁ NHỮNG SẢN PHẨM MỚI</h1>
    <div class="slide-product">
        @foreach ($products->reverse() as $product)
        <a href="#" class="own-product">
        @if($product->image_url)
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-thumbnail" style="cursor:pointer">
        @else
            N/A
        @endif
        </a>
        @endforeach
    </div>
</div>
@endsection