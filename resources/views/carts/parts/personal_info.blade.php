<h4>Thông tin khách hàng</h4>
<div class="border p-2">
    <div class="p-2">
        <label for="">Tên khách hàng: </label>
        <p>{{ Auth::user()->name }}</p>
    </div>
    <div class="p-2">
        <label for="">Email: </label>
        <p>{{ Auth::user()->email }}</p>
    </div>
    <div class="p-2">
        <label for="">Số điện thoại: </label>
        {{-- <p>{{ Auth::user()->phone }}</p> --}}
        <input type="text" name="phone" class="form-control" required>
    </div>
    <div class="p-2">
        <label for="">Địa chỉ giao hàng: </label>
        {{-- <p>{{ Auth::user()->address }}</p> --}}
        <textarea class="form-control" name="address" rows="3" required></textarea>
    </div>
</div>