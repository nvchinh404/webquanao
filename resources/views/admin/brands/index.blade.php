@extends('admin.layouts.app')

@section('content')
    <h1>Quản lý Nhãn hiệu</h1>
    <a href="{{ route('brands.create') }}" class="btn btn-primary mb-2">Thêm nhãn hiệu</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
      <thead>
          <tr>
              <th>ID</th>
              <th>Tên</th>
              <th>Mô tả</th>
              <th>Hành động</th>
          </tr>
      </thead>
      <tbody>
          @foreach($brands as $brand)
              <tr>
                  <td>{{ $brand->id }}</td>
                  <td>{{ $brand->name }}</td>
                  <td>{{ $brand->description }}</td>
                  <td>
                      <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-warning">Sửa</a>
                      <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" style="display:inline-block;">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn?');">Xóa</button>
                      </form>
                  </td>
              </tr>
          @endforeach
      </tbody>
    </table>
@endsection
