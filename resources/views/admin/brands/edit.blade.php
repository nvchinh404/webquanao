@extends('admin.layouts.app')

@section('content')
    <h1>Sửa Nhãn hiệu</h1>
    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
    <form action="{{ route('brands.update', $brand->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Tên:</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $brand->name) }}">
        </div>
        <div class="form-group">
            <label>Mô tả:</label>
            <textarea name="description" class="form-control">{{ old('description', $brand->description) }}</textarea>
        </div>
        <button class="btn btn-success" type="submit">Cập nhật</button>
    </form>
@endsection
