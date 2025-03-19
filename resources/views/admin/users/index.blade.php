@extends('admin.layouts.app')

@section('content')
    <h1>Quản lý Người dùng</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-2">Thêm người dùng</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
      <thead>
          <tr>
              <th>ID</th>
              <th>Tên</th>
              <th>Email</th>
              <th>Số điện thoại</th>
              <th>Địa chỉ</th>
              <th>Vai trò</th>
              <th>Ngày tạo</th>
              <th>Hành động</th>
          </tr>
      </thead>
      <tbody>
          @foreach($users as $user)
              <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->phone }}</td>
                  <td>{{ $user->address }}</td>
                  <td>{{ $user->role }}</td>
                  <td>{{ $user->created_at->format('d/m/Y') }}</td>
                  <td>
                      <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Sửa</a>
                      <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
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
