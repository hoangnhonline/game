@extends('frontend.layout')
  
  
@include('frontend.news.content')
@include('frontend.partials.meta')
  

@section('content')
<div class="block block_products block_commom">
  <div class="block_title">
    <a href="#">
    Upload</a>
  </div>
  <div class="block block-content clearfix" style="padding-top:20px">
    <div class="col-md-12">
    @if(Session::has('message'))
    <p class="alert alert-info" >{{ Session::get('message') }}</p>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif       
    </div>
    <form id="dataForm" name="formUpload" action="{{ route('store-game') }}" method="POST">
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
    <div class="form-group col-md-12" >                  
       <label>Name <span class="red-star">*</span></label>
       <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
    </div>
    
    <input type="hidden" class="form-control" name="slug" id="slug" value="{{ old('slug') }}">
    
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
    <div class="form-group col-md-12" style="margin-top:10px;margin-bottom:10px">  
        <label class="col-md-3 row">Thumbnail ( 170x170 px)</label>    
        <div class="col-md-9">
          <img id="thumbnail_image" src="{{ old('image_url') ? Helper::showImage(old('image_url')) : URL::asset('admin/dist/img/img.png') }}" class="img-thumbnail" width="145" height="85">
          
          <input type="file" id="file-image" style="display:none" />
       
          <button class="btn btn-default btn-sm" id="btnUploadImage" type="button"><i class="fa fa-upload"></i> Select Image</button>
        </div>
        <div style="clear:both"></div>
      </div>                         
    <div class="form-group col-md-12">
       <label>Description</label>
       <textarea class="form-control" rows="6" name="description" id="description">{{ old('description') }}</textarea>
    </div>
    <div class="form-group col-md-12">
       <label>Detail</label>
       <textarea class="form-control" rows="10" name="content" id="content">{{ old('content') }}</textarea>
    </div>
     <input type="hidden" name="image_url" id="image_url" value="{{ old('image_url') }}"/>          
    <input type="hidden" name="image_name" id="image_name" value="{{ old('image_name') }}"/>
    <div class="box-footer col-md-12">
        <button type="button" class="btn btn-default" id="btnLoading" style="display:none"><i class="fa fa-spin fa-spinner"></i></button>
        <button type="submit" class="btn btn-primary" id="btnSave">Upload</button>
        <a class="btn btn-default" class="btn btn-primary" href="{{ route('home')}}">Cancel</a>
     </div>
     {{ csrf_field() }}
     </form>
  </div>  
</div>
<style type="text/css">
  input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], textarea, select, input[type="number"], input[type="tel"]{
    border:  1px solid #CCC !important;
  }
  .red-star{
    color: red
  }
</style>
<input type="hidden" id="route_upload_tmp_image" value="{{ route('image.tmp-upload') }}">
<input type="hidden" id="upload_url" value="{{ config('game.upload_url') }}">
@stop
@section('javascript_page')
<script type="text/javascript">
   function filterAjax(type){  
     var str_params = $('#formSearchAjax').serialize();     
   }   
        $('#btnUploadImage').click(function(){        
        $('#file-image').click();
      });      
      $('#btnAddTag').click(function(){
          $('#tagModal').modal('show');
      });
      var files = "";
      $('#file-image').change(function(e){
         files = e.target.files;
         
         if(files != ''){
           var dataForm = new FormData();        
          $.each(files, function(key, value) {
             dataForm.append('file', value);
          });   
          
          dataForm.append('date_dir', 1);
          dataForm.append('folder', 'tmp');

          $.ajax({
            url: $('#route_upload_tmp_image').val(),
            type: "POST",
            async: false,      
            data: dataForm,
            processData: false,
            contentType: false,
            success: function (response) {
              if(response.image_path){
                $('#thumbnail_image').attr('src',$('#upload_url').val() + response.image_path);
                $( '#image_url' ).val( response.image_path );
                $( '#image_name' ).val( response.image_name );
              }
              console.log(response.image_path);
                //window.location.reload();
            },
            error: function(response){                             
                var errors = response.responseJSON;
                for (var key in errors) {
                  
                }
                //$('#btnLoading').hide();
                //$('#btnSave').show();
            }
          });
        }
      });
         $('#loai_id').change(function(){        
   
               var loai_id = $(this).val();
             $.ajax({
               url : '{{ route('get-child') }}',
               data : {
                 mod : 'cate',
                 col : 'loai_id',
                 id : loai_id              
               },
               type : 'POST',
               dataType : 'html',
               success : function(data){
                 $('#cate_id').html(data);
               }
             });
         
         });
         
         $('#dataForm').submit(function(){        
           $('#btnSave').hide();
           $('#btnLoading').show();
         });
         var editor = CKEDITOR.replace( 'content',{
             language : 'vi',
             height: 400,
             toolbarGroups : [
               
               { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
               { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
               { name: 'links', groups: [ 'links' ] },           
               '/',
               
             ]
         });
         
         var editor3 = CKEDITOR.replace( 'description',{
             language : 'vi',
             height : 200,
             toolbarGroups : [
               
               { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
               { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
               { name: 'links', groups: [ 'links' ] },           
               '/',
               
             ]
         });
</script>
@stop