@if (empty($order->status) || $order->status == \App\Models\Order::STATUS[0])
    <div class="alert alert-primary" role="alert">Chưa thanh toán</div>
@elseif ($order->status == \App\Models\Order::STATUS[1])
    <div class="alert alert-secondary" role="alert">Đã thanh toán online</div>
@elseif ($order->status == \App\Models\Order::STATUS[2])
    <div class="alert alert-warning" role="alert">Đang giao hàng</div>
@elseif ($order->status == \App\Models\Order::STATUS[3])
    <div class="alert alert-danger" role="alert">Hủy đơn hàng</div>
@else
    <div class="alert alert-success" role="alert">Hoàn thành</div>
@endif