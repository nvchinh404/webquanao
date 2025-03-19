@extends('admin.layouts.app')

@section('content')
    <h1>Sửa Người dùng</h1>
    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Tên:</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $user->name) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email', $user->email) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Số điện thoại:</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Địa chỉ:</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Vai trò:</label>
            <select name="role" class="form-select">
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <!-- Thêm các role khác nếu cần -->
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Mật khẩu (để trống nếu không đổi):</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button class="btn btn-success" type="submit">Cập nhật</button>
    </form>
@endsection
