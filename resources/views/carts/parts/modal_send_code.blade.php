 <!-- Modal -->
 <div class="modal fade" id="modal-send-code" tabindex="-1" aria-labelledby="modal-send-code-label" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Mã xác nhận</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
        @auth
        <div class="form-group p-2 mt-2 mb-2 border">
          <form action="{{ route('cart.send-verify-code') }}" method="POST" id="frm-send-verify-code">
            @csrf
            
            <input type="radio" name="code_type" value="1" id="send-code-type-1" checked><label for="send-code-type-1">Gửi mã xác nhận qua email</label><hr>
            <input type="radio" name="code_type" value="2" id="send-code-type-2"><label for="send-code-type-2"> Gửi mã xác nhận qua điện thoại</label><hr>
            <button type="submit">Gửi Xác nhận</button>
          </form>
        </div>
        
        {{-- confirm send code --}}
        <div class="form-group  p-2 mt-2 mb-2 border">
          <form action="{{ route('cart.confirm-verify-code') }}" method="POST" id="frm-confirm-verify-code">
            @csrf
            <div class="form-group">
               <label for="">Nhập mã xác nhận: </label>
               <input type="text" name="code" required>
            </div>
          <button type="submit">Xác nhận</button>
            
         </form>
        </div>
        @endauth

        @guest
            <div class="account-info">
               <a href="/login">Login</a>
               <a href="/register">Regitser</a>
            </div>
        @endguest
       </div>
       <div class="modal-footer">
         <button type="button" data-bs-dismiss="modal">Đóng</button>
       </div>
     </div>
   </div>
 </div>