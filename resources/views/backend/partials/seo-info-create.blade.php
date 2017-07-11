<div class="box box-primary">
   <div class="box-header with-border">
      <h3 class="box-title">SEO Information</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
      <div class="form-group">
         <label>Meta title </label>
         <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ old('meta_title') }}">
      </div>
      <!-- textarea -->
      <div class="form-group">
         <label>Meta desciption</label>
         <textarea class="form-control" rows="6" name="meta_description" id="meta_description">{{ old('meta_description') }}</textarea>
      </div>
      <div class="form-group">
         <label>Meta keywords</label>
         <textarea class="form-control" rows="4" name="meta_keywords" id="meta_keywords">{{ old('meta_keywords') }}</textarea>
      </div>
      <div class="form-group">
         <label>Custom text</label>
         <textarea class="form-control" rows="6" name="custom_text" id="custom_text">{{ old('custom_text') }}</textarea>
      </div>
   </div>
   <!-- /.box -->     
</div>