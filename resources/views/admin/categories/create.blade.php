@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Tạo Danh mục</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên:</label>
            <input type="text" id="name" name="name" class="form-control" required value="{{ old('name') }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả:</label>
            <textarea id="description" name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Tạo</button>
    </form>
</div>
@endsection
