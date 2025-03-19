@extends('admin.layouts.app')

@section('content')
    <h1>Sửa Sản phẩm</h1>
    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label">Tên:</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $product->name) }}">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Mô tả:</label>
            <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Giá:</label>
            <input type="number" step="0.01" name="price" class="form-control" required value="{{ old('price', $product->price) }}">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Số lượng tồn kho:</label>
            <input type="number" name="stock_quantity" class="form-control" required value="{{ old('stock_quantity', $product->stock_quantity) }}">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Danh mục:</label>
            <select name="category_id" class="form-select" required>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                      {{ $category->name }}
                  </option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Nhãn hiệu:</label>
            <select name="brand_id" class="form-select" required>
                @foreach($brands as $brand)
                  <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                      {{ $brand->name }}
                  </option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">URL hình ảnh:</label>
            <input type="text" name="image_url" class="form-control" placeholder="https://example.com/image.jpg" value="{{ old('image_url', $product->image_url) }}">
        </div>
        
        <button class="btn btn-success" type="submit">Cập nhật</button>
    </form>
@endsection
