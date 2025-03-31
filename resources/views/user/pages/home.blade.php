@extends('user.layouts.app') <!-- Kế thừa layout cha -->

@section('title', 'Trang Chủ')

@section('body')
<link rel="stylesheet" href="{{ asset('css/home/index.css') }}">
<div class="content">
    <div class="slider">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR7XTzW7JUmZykbirItyBL4T-p37MaGWoR7sA&s" alt="" class="image_slider">
    </div>
    <div class="container">
        <div class="new-product">
            <div class="group-title">
                <div class="cr-group-title">
                    <div class="title">Sản phẩm mới</div>
                    <div class="des-content">Chọn lựa những thiết kế hợp xu hướng nhất</div>
                    <div class="view-more">
                    <a href="{{ URL::to('/new') }}" aria-label="Xem thêm" class="btn btn-link">Xem thêm</a>
                    </div>
                </div>
            </div>
            <div class="group-product">
                    @foreach ($products->reverse()->take(4) as $product)
                    <a href="{{  route('products.show' , $product->id) }}" class="owl-item">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-thumbnail" style="cursor:pointer">
                            <div class="overlay">
                                <p>{{ $product->name }}</p>
                                <p style="font-weight: bold; margin-top: 5px">{{ number_format($product->price, 0, ',', '.') }} VND</p>
                            </div>
                        @else
                            N/A
                        @endif
                    </a>
                    @endforeach
            </div>
        </div>
        <div class="block-product">
            <h1>KHÁM PHÁ ĐA DẠNG</h1>
            <div class="best-sell">
                <div class="product-1">
                    <div class="product-item" style="margin-bottom: 20px;">
                        <img src="https://www.vascara.com/uploads/web/900/landing-page/Collection-soiree-glamour/soiree-glamour-10-pc.png">
                    </div>
                    <div class="des">
                        <div>
                        <h2>SOIRÉE GLAMOUR</h2>
                        <p>Một khoảnh khắc thời gian ngưng đọng để chúng ta tạm quên đi dòng chảy của quá khứ, không còn bận tâm về những viễn cảnh tương lai, chỉ đơn giản là tận hưởng hiện thực tự do giữa đêm tiệc lấp lánh nơi thành phố mơ mộng.</p>
                        </div>
                    </div>
                </div>
                <div class="product-2">
                    <div class="des"  style="margin-bottom: 20px;">
                        <div>
                        <h2>LIFE IS A PARTY.DRESS LIKE IT.</h2>
                        <p>Vẻ hiện đại và nữ tính vượt thời gian được tôn vinh qua cuộc dạo chơi cùng những những chiếc túi xách ánh kim phom dáng kinh điển, những đôi giày cao gót mũi nhọn t-strap quai mảnh cách điệu. Tất cả tạo nên một bản phối hoàn hảo cho mùa lễ hội. Khi hoàng hôn buông xuống, cô biến hóa thành phiên bản hấp dẫn đầy mê hoặc của chính mình.</p>
                        </div>
                    </div>
                    <div class="product-item">
                        <img src="https://www.vascara.com/uploads/web/900/landing-page/Collection-soiree-glamour/soiree-glamour-8-pc.png">
                    </div>
                </div>
            </div>
            <h1>ĐẾN TỪ NHỮNG THƯƠNG HIỆU NỔI TIẾNG</h1>
            <div class="slide-product">
                @foreach ($products->take(8) as $product)
                <a href="{{  route('products.show' , $product->id) }}" class="own-product">
                @if($product->image_url)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-thumbnail" style="cursor:pointer">
                    <div class="overlay">
                        <p>{{ $product->name }}</p>
                        <p style="font-weight: bold; margin-top: 5px">{{ number_format($product->price, 0, ',', '.') }} VND</p>
                    </div>
                @else
                    N/A
                @endif
                </a>
                @endforeach
            </div>
            <div class="view-more">
                <a href="{{ URL::to('/products') }}" aria-label="Xem thêm" class="btn btn-link btn-product">Xem thêm</a>
            </div>
        </div>
    </div>
</div>
@endsection