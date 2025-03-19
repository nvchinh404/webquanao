@extends('admin.layouts.app')

@section('content')
    <h1>Quản lý Đơn hàng</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
      <thead>
          <tr>
              <th>ID</th>
              <th>Người đặt hàng</th>
              <th>Tổng tiền</th>
              <th>Trạng thái</th>
              <th>Phương thức thanh toán</th>
              <th>Ngày tạo</th>
              <th>Ngày cập nhật</th>
              <th>Hành động</th>
          </tr>
      </thead>
      <tbody>
          @foreach($orders as $order)
              <tr>
                  <td>{{ $order->id }}</td>
                  <td>{{ $order->user ? $order->user->name : 'N/A' }}</td>
                  <td>{{ number_format($order->total_price, 0, ',', '.') }} đồng</td>
                  <td>{{ $order->status }}</td>
                  <td>{{ $order->payment_method }}</td>
                  <td>{{ $order->created_at->format('d/m/Y') }}</td>
                  <td>{{ $order->updated_at->format('d/m/Y') }}</td>
                  <td>
                      <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Xem</a>
                      <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                      <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');">Xóa</button>
                      </form>
                  </td>
              </tr>
          @endforeach
      </tbody>
    </table>
@endsection
