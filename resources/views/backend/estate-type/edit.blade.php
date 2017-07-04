@extends('layout.backend')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Danh mục     
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('loai-sp.index') }}">Danh mục</a></li>
      <li class="active"><span class="glyphicon glyphicon-pencil"></span></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('loai-sp.index') }}" style="margin-bottom:5px">Quay lại</a>
  
    <div class="row">
      <!-- left column -->

      <div class="col-md-7">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            Chỉnh sửa
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="POST" action="{{ route('loai-sp.update') }}">
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
               <div class="form-group">
                  <label>Danh mục cha</label>
                  <select class="form-control" name="type" id="type">                  
                    <option value="1" {{ old('type', $detail->type) == 1 ? "selected" : "" }}>Bán</option>
                      <option value="2" {{ old('type', $detail->type) == 2 ? "selected" : "" }}>Cho thuê</option>
                  </select>
                </div> 
               <!-- text input -->
              <div class="form-group">
                <label>Tên danh mục <span class="red-star">*</span></label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $detail->name }}">
              </div>
              <div class="form-group">
                <label>Slug <span class="red-star">*</span></label>
                <input type="text" class="form-control" name="slug" id="slug" value="{{ $detail->slug }}">
              </div>
              <!-- textarea -->
              <div class="form-group">
                <label>Mô tả</label>
                <textarea class="form-control" rows="4" name="description" id="description">{{ $detail->description }}</textarea>
              </div>  
             
              <div class="form-group">
                <label>Ẩn/hiện</label>
                <select class="form-control" name="status" id="status">                  
                  <option value="0" {{ $detail->status == 0 ? "selected" : "" }}>Ẩn</option>
                  <option value="1" {{ $detail->status == 1 ? "selected" : "" }}>Hiện</option>
                </select>
              </div>              
            </div>         
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
              <a class="btn btn-default btn-sm" class="btn btn-primary btn-sm" href="{{ route('loai-sp.index')}}">Hủy</a>
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
    $('#btnUploadIcon').click(function(){        
        $('#file-icon').click();
      });      
      var filesIcon = '';
      $('#file-icon').change(function(e){
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
                $('#thumbnail_icon').attr('src',$('#upload_url').val() + response.image_path);
                $('#icon_url').val( response.image_path );
                $( '#icon_name' ).val( response.image_name );
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
  });

</script>
@stop
