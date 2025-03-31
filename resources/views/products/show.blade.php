<form action="{{ route('user.cart.store', $product->id) }}" method="POST">
    @csrf
    <div class="row g-3 align-items-center mt-3">
        <div class="col-auto">
            <label for="quantity" class="col-form-label">Số lượng:</label>
        </div>
        <div class="col-auto">
            <input type="number" id="quantity" name="quantity" value="1" min="1" 
                   max="{{ $product->stock_quantity }}" class="form-control" style="width: 80px;">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary" 
                    {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}>
                <i class="fas fa-cart-plus me-2"></i> 
                {{ $product->stock_quantity > 0 ? 'Thêm vào giỏ' : 'Hết hàng' }}
            </button>
        </div>
    </div>
    @if($product->stock_quantity <= 0)
        <p class="text-danger mt-2">Sản phẩm tạm hết hàng</p>
    @elseif($product->stock_quantity < 5)
        <p class="text-warning mt-2">Chỉ còn {{ $product->stock_quantity }} sản phẩm</p>
    @endif
</form>