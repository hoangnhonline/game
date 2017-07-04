<!-- Modal -->
<div id="notifiModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Gửi tin nhắn</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('customernoti.store') }}" id="formNoti">
          {!! csrf_field() !!} 
          <div class="form-group">
             <label for="email">Loại tin nhắn<span class="red-star">*</span></label>

            <select class="form-control" name="type" id="type">
              <option value="0">--Chọn--</option>
              <option value="1">Khuyến mãi</option>
              <option value="2">Thông tin đơn hàng</option>
            </select>
          </div>
          <div class="form-group" id="url-km" style="display:none;">
            <label>URL khuyến mãi</label>
            <input type="text" name="event_url" class="form-control" value="{{ old('event_url') }}" id="event_url">
          </div>
          <div class="form-group">
            <label>Nội dung</label>
            <textarea class="form-control" rows="10" name="contentNoti" id="contentNoti">{{ old('content') }}</textarea>
          </div>
          <input type="hidden" name="customer_id" id="customer_id_noti" value="">
          <input type="hidden" name="order_id" id="order_id_noti" value="">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" id="btnSaveNoti">Save</button>
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>