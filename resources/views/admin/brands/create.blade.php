@extends('admin.layouts.app')

@section('content')
    <h1>Tạo Nhãn hiệu</h1>
    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
    <form action="{{ route('brands.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Tên:</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>Mô tả:</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        <button class="btn btn-success" type="submit">Tạo</button>
    </form>
@endsection
