 <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Thông tin SEO</h3>
    </div>

    <!-- /.box-header -->
      <div class="box-body">
        <input type="hidden" name="meta_id" value="{{ $detail->meta_id }}">
        <div class="form-group">
          <label>Meta title </label>
          <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ !empty((array)$meta) ? $meta->title : "" }}">
        </div>
        <!-- textarea -->
        <div class="form-group">
          <label>Meta desciption</label>
          <textarea class="form-control" rows="6" name="meta_description" id="meta_description">{{ !empty((array)$meta) ? $meta->description : "" }}</textarea>
        </div>  

        <div class="form-group">
          <label>Meta keywords</label>
          <textarea class="form-control" rows="4" name="meta_keywords" id="meta_keywords">{{ !empty((array)$meta) ? $meta->keywords : "" }}</textarea>
        </div>  
        <div class="form-group">
          <label>Custom text</label>
          <textarea class="form-control" rows="6" name="custom_text" id="custom_text">{{ !empty((array)$meta) ? $meta->custom_text : ""  }}</textarea>
        </div>
      
    </div>
  <!-- /.box -->     

</div>