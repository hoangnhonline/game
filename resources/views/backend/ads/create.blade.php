@extends('backend.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      ADS
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('ads.index') }}">ADS</a></li>
      <li class="active">Tạo mới</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm " href="{{ route('ads.index') }}" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="{{ route('ads.store') }}">
    <div class="row">
      <!-- left column -->

      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Tạo mới</h3>
          </div>
          <!-- /.box-header -->               
            {!! csrf_field() !!}

            <div class="box-body">
              @if (count($errors) > 0)
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif         
                <div class="form-group">
                  <label>Loại ADS <span class="red-star">*</span></label>
                  <select name="type" class="form-control" id="type">
                    <option value="" >--select--</option>
                    <option value="1" {{ old('type') == 1  ? "selected" : "" }}>Banner</option>
                    <option value="2" {{ old('type') == 2  ? "selected" : "" }}>Code</option>
                  </select>
                </div>     
                 <div class="form-group">
                  <label>Name <span class="red-star">*</span></label>
                  <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                </div>       
                <div id="div_banner" style="display:none">
                 <div class="form-group" style="margin-top:10px;margin-bottom:10px">  
                  <label class="col-md-2 row">Banner </label>    
                  <div class="col-md-10">
                    <img id="thumbnail_image" src="{{ old('image_url') ? Helper::showImage(old('image_url')) : URL::asset('public/admin/dist/img/img.png') }}" class="img-thumbnail" width="145" height="85">
                    
                    <input type="file" id="file-image" style="display:none" />
                 
                    <button class="btn btn-default btn-sm" id="btnUploadImage" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                  </div>
                  <div style="clear:both"></div>
                </div>
                <div class="form-group">
                  <label>Loại banner</label>
                  <select name="have_link" class="form-control" id="have_link">
                    <option value="1" {{ old('type') == 1  ? "selected" : "" }}>Không liên kết</option>
                    <option value="2" {{ old('type') == 2 ? "selected" : "" }}>Có liên kết</option>
                  </select>
                </div>  
                <div class="form-group" id="div_lk" style="display:none">
                  <label>Liên kết</label>
                  <input type="text" name="ads_url" id="ads_url" value="{{ old('ads_url') }}" class="form-control">
                </div>   
                </div>
                <div class="form-group" style="display:none" id="div_code">
                  <label>Code</label>
                  <textarea rows="8" id="ads_code" name="ads_code" class="form-control">{{ old('ads_code') }}</textarea>
                </div>      
                <div class="form-group">
                  <label>Ẩn / Hiện</label>
                  <select name="status" class="form-control" id="status">
                  	<option value="1" {{ old('status') == 1  ? "selected" : "" }}>Hiện</option>
                  	<option value="2" {{ old('status') == 2  ? "selected" : "" }}>Ẩn</option>
                  </select>
                </div>           
                <!-- textarea -->
                
                <input type="hidden" name="image_url" id="image_url" value="{{ old('image_url') }}"/>          
            	<input type="hidden" name="image_name" id="image_name" value="{{ old('image_name') }}"/>
       
            </div>                        
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
              <a class="btn btn-default btn-sm" class="btn btn-primary btn-sm" href="{{ route('ads.index') }}">Hủy</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
     
      <!--/.col (left) -->      
    </div>
    </form>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<input type="hidden" id="route_upload_tmp_image" value="{{ route('image.tmp-upload') }}">
@stop
@section('javascript_page')
<script type="text/javascript">
    $(document).ready(function(){
      @if(old('type') == 1)
          $('#div_banner').show();
          $('#div_code, #div_lk').hide();
      @endif
      @if(old('type') == 2)
          $('#div_banner').hide();
          $('#div_code').show();
      @endif
      @if(old('have_link') == 2)
          $('#div_lk').show();
      @endif
      $('#btnUploadImage').click(function(){        
        $('#file-image').click();
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
      $('#type').change(function(){
        var type = $(this).val();
        if(type == 1){
          $('#div_banner').show();
          $('#div_code, #div_lk').hide();

        }else{
          $('#div_banner').hide();
          $('#div_code').show();
        }
      });
      var type = $('#have_link').val();
      checkType( have_link );

      $('#have_link').change(function(){
      	checkType( $(this).val() );
      });
      
     
    });
    function checkType( type ){
    	if( type == 1){
    		$('#div_lk').hide();
    	}else{
    		$('#div_lk').show();
    	}
    }
</script>
@stop