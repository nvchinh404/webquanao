@extends('admin.layouts.app')

@section('content')
    <h1>Tạo Sản phẩm</h1>
    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tên:</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả:</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Giá:</label>
            <input type="number" step="0.01" name="price" class="form-control" required value="{{ old('price') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Số lượng tồn kho:</label>
            <input type="number" step="1" name="stock_quantity" class="form-control" required value="{{ old('stock_quantity', 0) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Danh mục:</label>
            <select name="category_id" class="form-select" required>
                <option value="">Chọn danh mục</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Nhãn hiệu:</label>
            <select name="brand_id" class="form-select" required>
                <option value="">Chọn nhãn hiệu</option>
                @foreach($brands as $brand)
                  <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">URL hình ảnh:</label>
            <input type="text" name="image_url" class="form-control" placeholder="https://example.com/image.jpg" value="{{ old('image_url') }}">
        </div>
        <button class="btn btn-success" type="submit">Tạo</button>
    </form>
@endsection
