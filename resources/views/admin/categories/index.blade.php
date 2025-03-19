@extends('admin.layouts.app')

@section('content')
    <h1>Quản lý Danh mục</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-2">Thêm danh mục</a>
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
          @foreach($categories as $category)
              <tr>
                  <td>{{ $category->id }}</td>
                  <td>{{ $category->name }}</td>
                  <td>{{ $category->description }}</td>
                  <td>
                      <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Sửa</a>
                      <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
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
