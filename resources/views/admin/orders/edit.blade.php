@extends('admin.layouts.app')

@section('content')
    <h1>Sửa Đơn hàng #{{ $order->id }}</h1>
    @if($errors->any())
         <div class="alert alert-danger">
            <ul>
               @foreach($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
    @endif
    <form action="{{ route('orders.update', $order->id) }}" method="POST">
         @csrf
         @method('PUT')
         <div class="mb-3">
              <label class="form-label">Trạng thái:</label>
              <select name="status" class="form-select" required>
                  <option value="đang xử lý" {{ $order->status == 'đang xử lý' ? 'selected' : '' }}>Đang xử lý</option>
                  <option value="hoàn thành" {{ $order->status == 'hoàn thành' ? 'selected' : '' }}>Hoàn thành</option>
                  <option value="hủy" {{ $order->status == 'hủy' ? 'selected' : '' }}>Hủy</option>
              </select>
         </div>
         <div class="mb-3">
              <label class="form-label">Phương thức thanh toán:</label>
              <select name="payment_method" class="form-select" required>
                  <option value="COD" {{ $order->payment_method == 'COD' ? 'selected' : '' }}>COD</option>
                  <option value="chuyển khoản" {{ $order->payment_method == 'chuyển khoản' ? 'selected' : '' }}>Chuyển khoản</option>
                  <option value="credit card" {{ $order->payment_method == 'credit card' ? 'selected' : '' }}>Credit Card</option>
                  <option value="tiền mặt" {{ $order->payment_method == 'tiền mặt' ? 'selected' : '' }}>Tiền mặt</option>
              </select>
         </div>
         <button class="btn btn-success" type="submit">Cập nhật</button>
    </form>
@endsection
