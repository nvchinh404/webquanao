@extends('admin.layouts.app')

@section('content')
    <h1>Quản lý Sản phẩm</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-2">Thêm sản phẩm</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
      <thead>
          <tr>
              <th>ID</th>
              <th>Tên</th>
              <th>Danh mục</th>
              <th>Nhãn hiệu</th>
              <th>Giá</th>
              <th>Số lượng</th>
              <th>Ảnh</th>
              <th>Hành động</th>
          </tr>
      </thead>
      <tbody>
          @foreach($products as $product)
              <tr>
                  <td>{{ $product->id }}</td>
                  <td>{{ $product->name }}</td>
                  <td>{{ $product->category ? $product->category->name : '' }}</td>
                  <td>{{ $product->brand ? $product->brand->name : '' }}</td>
                  <td>{{ number_format($product->price, 0, ',', '.') }} đồng</td>
                  <td>{{ $product->stock_quantity }}</td>
                  <td>
                      @if($product->image_url)
                          <img src="{{ $product->image_url }}" alt="{{ $product->name }}" width="50" class="img-thumbnail" style="cursor:pointer" onclick="showImageModal('{{ $product->image_url }}')">
                      @else
                          N/A
                      @endif
                  </td>
                  <td>
                      <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Sửa</a>
                      <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn?');">Xóa</button>
                      </form>
                  </td>
              </tr>
          @endforeach
      </tbody>
    </table>

    <!-- Modal Phóng to hình ảnh -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body p-0">
            <img src="" id="modalImage" class="img-fluid" alt="Zoomed Image">
          </div>
        </div>
      </div>
    </div>
@endsection

@section('scripts')
    <script>
        function showImageModal(src) {
            document.getElementById('modalImage').src = src;
            var myModal = new bootstrap.Modal(document.getElementById('imageModal'));
            myModal.show();
        }
    </script>
@endsection
