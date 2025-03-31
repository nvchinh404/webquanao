    <header>
        <div class="logo_header">
            <a href="{{ URL::to('/') }}" class="logo_Northside">NORTHSIDE CREW</a>
        </div>
        <ul class="navigate_header">
            <li><a href="{{ URL::to('/new') }}" class="text-deco">Hàng mới</a></li>
            <li>
                <a href="{{ URL::to('/products') }}"><p class="text-deco">Sản phẩm</p></a>
                <div class="dropdown">
                @foreach ( $categories as $category )
                <a href="{{ route('category.show', $category->id) }}" class="text-deco">
                {{ $category->name }}
                </a>
                @endforeach
                </div>
            </li>
            <li>
                <p class="text-deco">Thương hiệu</p>
                <div class="dropdown">
                @foreach ( $brands as $brand )
                <a href="{{ route('category.show', $brand->id) }} " class="text-deco">
                {{ $brand->name }}
                </a>
                @endforeach
                </div>
            </li>
            <li><p class="text-deco">Bán chạy</p></li>
        </ul>
        <ul class="tools_header">
        <li><i class="fa-solid fa-magnifying-glass icon_while"></i></li>
        <li><a href="{{ route('cart.index') }}"><i class="fa-solid fa-briefcase icon_while"></i></a></li>
        <li class="user-dropdown">
            <i class="fa-solid fa-user icon_while dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false"></i>
            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="{{ route('login') }}">Đăng nhập</a></li>
                <li><a class="dropdown-item" href="{{ route('register') }}">Đăng ký</a></li>
            </ul>
        </li>
    </ul>
    </header>
    