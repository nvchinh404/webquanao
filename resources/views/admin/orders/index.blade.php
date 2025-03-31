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
                  <td>
                      @switch($order->status)
                          @case('pending') Đang xử lý @break
                          @case('shipping') Đang giao hàng @break
                          @case('completed') Hoàn thành @break
                          @case('cancelled') Đã hủy @break
                          @default {{ $order->status }}
                      @endswitch
                  </td>
                  <td>
                      @switch($order->payment_method)
                          @case('cod') COD @break
                          @case('bank_transfer') Chuyển khoản @break
                          @case('credit_card') Thẻ tín dụng @break
                          @case('e_wallet') Ví điện tử @break
                          @default {{ $order->payment_method }}
                      @endswitch
                  </td>
                  <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                  <td>{{ $order->updated_at->format('d/m/Y H:i') }}</td>
                  <td>
                      <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">Xem</a>
                      <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                      <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
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