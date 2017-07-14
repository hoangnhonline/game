<div class="form-group col-md-6 none-padding">
   <label for="loai_id">Type <span class="red-star">*</span></label>
   <select class="form-control" name="loai_id" id="loai_id">
      <option value="">--Select--</option>
      @foreach( $loaiSpArr as $value )
      <option value="{{ $value->id }}" {{ $value->id == old('loai_id') || $value->id == $loai_id ? "selected" : "" }}>{{ $value->name }}</option>
      @endforeach
   </select>
</div>
<div class="form-group col-md-6 none-padding pleft-5">
   <label for="cate_id">Category <span class="red-star">*</span></label>
   <select class="form-control" name="cate_id" id="cate_id">
      <option value="">--Select--</option>
      @foreach( $cateArr as $value )
      <option value="{{ $value->id }}" {{ $value->id == old('cate_id') || $value->id == $cate_id ? "selected" : "" }}>{{ $value->name }}</option>
      @endforeach
   </select>
</div>
<div class="form-group col-md-6 none-padding" >                  
   <label>Name <span class="red-star">*</span></label>
   <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
</div>
<div class="form-group col-md-6 pleft-5">                  
   <label>Slug <span class="red-star">*</span></label>                  
   <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}">
</div>
<div class="form-group col-md-8 none-padding" >                  
   <label>URL IOS</label>
   <input type="text" class="form-control" name="url_ios" id="url_ios" value="{{ old('url_ios') }}">
</div>
<div class="form-group col-md-4 pleft-5">                  
   <label>Requirements</label>                  
   <input type="text" class="form-control" name="req_ios" id="req_ios" value="{{ old('req_ios') }}">
</div>
<div class="form-group col-md-8 none-padding" >                  
   <label>URL Android</label>
   <input type="text" class="form-control" name="url_android" id="url_android" value="{{ old('url_android') }}">
</div>
<div class="form-group col-md-4 pleft-5">                  
   <label>Requirements</label>                  
   <input type="text" class="form-control" name="req_android" id="req_android" value="{{ old('req_android') }}">
</div>
<div class="form-group col-md-8 none-padding" >                  
   <label>URL WP</label>
   <input type="text" class="form-control" name="url_wp" id="url_wp" value="{{ old('url_wp') }}">
</div>
<div class="form-group col-md-4 pleft-5">                  
   <label>Requirements</label>                  
   <input type="text" class="form-control" name="req_wp" id="req_wp" value="{{ old('req_wp') }}">
</div>
<div class="form-group col-md-6 none-padding" >
   <label>Star</label>
   <select class="form-control" name="no_star" id="no_star">
      <option value="">--Select--</option>
      <option value="3">3</option>
      <option value="3.5">3.5</option>
      <option value="4">4</option>
      <option value="4.5">4.5</option>
      <option value="5">5</option>
   </select>
</div>
<div class="form-group col-md-6 pleft-5">                  
   <label>Author</label>                  
   <input type="text" class="form-control" name="author" id="author" value="{{ old('author') }}">
</div>
<div class="form-group col-md-6 none-padding" >                  
   <label>Lastest version</label>
   <input type="text" class="form-control" name="latest_version" id="latest_version" value="{{ old('latest_version') }}">
</div>
<div class="form-group col-md-6 pleft-5">                  
   <label>Publish date</label>                  
   <input type="text" class="form-control" name="publish_date" id="publish_date" value="{{ old('publish_date') }}">
</div>
<div class="col-md-12">
   <div class="checkbox">
      <label><input type="checkbox" name="is_hot" value="1"> <span style="color:blue">Game HOT </span></label>
   </div>
</div>
<div class="input-group">
   <label>Tags</label>
   <select class="form-control select2" name="tags[]" id="tags" multiple="multiple">                  
     @if( $tagArr->count() > 0)
       @foreach( $tagArr as $value )
       <option value="{{ $value->id }}" {{ (old('tags') && in_array($value->id, old('tags'))) ? "selected" : "" }}>{{ $value->name }}</option>
       @endforeach
     @endif
   </select>
   <span class="input-group-btn">
     <button style="margin-top:24px" class="btn btn-primary btn-sm" id="btnAddTag" data-type="1" type="button" data-value="1">
       Add new
     </button>
   </span>
 </div>                           
<div class="form-group">
   <label>Description</label>
   <textarea class="form-control" rows="6" name="description" id="description">{{ old('description') }}</textarea>
</div>
<div class="form-group">
   <label>Detail</label>
   <textarea class="form-control" rows="10" name="content" id="content">{{ old('content') }}</textarea>
</div>