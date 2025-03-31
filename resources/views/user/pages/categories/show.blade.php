@extends('users.layouts.app')

@section('title', $category->name)

@section('body')
<link rel="stylesheet" href="{{ asset('css/pages/category.css') }}">
<link rel="stylesheet" href="{{ asset('css/home/index.css') }}">
<div class="">
<h1>{{ $category->name }}</h1>
    <!-- Hiển thị sản phẩm thuộc danh mục -->
    <div class="slide-product">
        @foreach ($category->products->reverse() as $product)
        <a href="{{  route('products.show' , $product->id) }}" class="own-product">
        @if($product->image_url)
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-thumbnail" style="cursor:pointer">
        @else
            N/A
        @endif
        <p>{{ $product->name }}</p>
        <p>{{ number_format($product->price, 0, ',', '.') }} VND</p>
        </a>
        @endforeach
    </div>
</div>
@endsection