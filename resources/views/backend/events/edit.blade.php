@extends('layout.backend')
@section('content')
<link rel="stylesheet" href="{{ URL::asset('public/assets/css/jquery.datetimepicker.min.css') }}">  
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Chương trình khuyến mãi
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('events.index') }}">Chương trình khuyến mãi</a></li>
      <li class="active">Cập nhật</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('events.index') }}" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="{{ route('events.update') }}">
    <div class="row">
      <!-- left column -->

      <div class="col-md-7">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Cập nhật</h3>
          </div>
          <!-- /.box-header -->               
            {!! csrf_field() !!}
            <input type="hidden" name="id" value="{{ $detail->id }}">
            <div class="box-body">
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
                 <!-- text input -->
                <div class="form-group">
                  <label>Tên chương trình<span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ $detail->name }}">
                </div>
                <div class="form-group">
                  <label>Slug <span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="slug" id="slug" value="{{ $detail->slug }}">
                </div>                
                
                <div class="clearfix"></div>
                <!-- textarea -->
                <div class="form-group">
                  <label>Mô tả</label>
                  <textarea class="form-control" rows="4" name="description" id="description">{{ $detail->description }}</textarea>
                </div>
                <div class="form-group">
                  <label>Thể lệ</label>
                  <textarea class="form-control" rows="4" name="the_le" id="the_le">{{ $detail->the_le }}</textarea>
                </div>             
                <div class="form-group" style="margin-top:10px;margin-bottom:10px">  
                  <label class="col-md-3 row">Banner nhỏ</label>    
                  <div class="col-md-9">
                    <img id="thumbnail_small" src="{{ $detail->small_banner ? Helper::showImage($detail->small_banner) : URL::asset('admin/dist/img/img.png') }}" class="img-thumbnail" width="80" >
                    
                    <input type="file" id="file-small" style="display:none" />
                 
                    <button class="btn btn-default btn-sm" id="btnUploadSmall" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                  </div>
                  <div style="clear:both"></div>
                </div> 
                <div class="form-group" style="margin-top:10px;margin-bottom:10px">  
                  <label class="col-md-3 row">Banner lớn</label>    
                  <div class="col-md-9">
                    <img id="thumbnail_large" src="{{ $detail->large_banner ? Helper::showImage($detail->large_banner) : URL::asset('admin/dist/img/img.png') }}" class="img-thumbnail" width="200" >
                    
                    <input type="file" id="file-large" style="display:none" />
                 
                    <button class="btn btn-default btn-sm" id="btnUploadLarge" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                  </div>
                  <div style="clear:both"></div>
                </div>                        
                <div class="form-group">
                  <label>Ngày bắt đầu</label>
                  <input type="text" class="form-control datetime" name="from_date" id="from_date" value="{{ Carbon\Carbon::parse($detail->from_date)->format('d-m-Y H:i') }}">
                </div>
                <div class="form-group">
                  <label>Ngày kết thúc</label>
                  <input type="text" class="form-control datetime" name="to_date" id="to_date" value="{{ Carbon\Carbon::parse($detail->to_date)->format('d-m-Y H:i') }}">
                </div>
            </div>
            <!-- /.box-body -->
            <input type="hidden" name="small_banner" id="small_banner" value="{{ $detail->small_banner }}"/>
            <input type="hidden" name="small_name" id="small_name" value="{{ old('small_name') }}"/>
            <input type="hidden" name="large_banner" id="large_banner" value="{{ $detail->large_banner }}"/>
            <input type="hidden" name="large_name" id="large_name" value="{{ old('large_name') }}"/>           
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
              <a class="btn btn-default btn-sm" class="btn btn-primary btn-sm" href="{{ route('events.index')}}">Hủy</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
      <div class="col-md-5">
        <!-- general form elements -->
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
<script type="text/javascript" src="{{ URL::asset('public/assets/js/jquery.datetimepicker.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
      var editor2 = CKEDITOR.replace( 'the_le',{
          language : 'vi',
          height : 300,
          toolbarGroups : [
            
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
            { name: 'links', groups: [ 'links' ] },           
            '/',
            
          ]
      });
      $('.datetime').datetimepicker({
        format:'d-m-Y H:i',                
      });
      $('#btnUploadSmall').click(function(){ 
        $('#file-small').click();
      });
      $('#btnUploadLarge').click(function(){ 
        $('#file-large').click();
      });      
      var files = "";
      $('#file-large').change(function(e){
         files = e.target.files;
         
         if(files != ''){
           var dataForm = new FormData();        
          $.each(files, function(key, value) {
             dataForm.append('file', value);
          });   
          
          dataForm.append('date_dir', 0);
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
                $('#thumbnail_large').attr('src',$('#upload_url').val() + response.image_path);
                $( '#large_banner' ).val( response.image_path );
                $( '#large_name' ).val( response.image_name);
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
      var filesIcon = '';
      $('#file-small').change(function(e){
         filesIcon = e.target.files;
         
         if(filesIcon != ''){
           var dataForm = new FormData();        
          $.each(filesIcon, function(key, value) {
             dataForm.append('file', value);
          });
          
          dataForm.append('date_dir', 0);
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
                $('#thumbnail_small').attr('src',$('#upload_url').val() + response.image_path);                
                $('#small_banner').val( response.image_path );
                $('#small_name' ).val( response.image_name );
              }
            }
          });
        }
      });      
      
      $('#name').change(function(){
         var name = $.trim( $(this).val() );
         if( name != '' && $('#slug').val() == ''){
            $.ajax({
              url: $('#route_get_slug').val(),
              type: "POST",
              async: false,      
              data: {
                str : name
              },              
              success: function (response) {
                if( response.str ){                  
                  $('#slug').val( response.str );
                }                
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

    });
    
</script>
@stop
