@extends('layout.backend')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Tags</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('tag.index') }}">Tags</a></li>
      <li class="active"><span class="glyphicon glyphicon-pencil"></span></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm " href="{{ route('tag.index') }}" style="margin-bottom:5px">Quay lại</a>
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
          <form role="form" method="POST" action="{{ route('tag.update') }}">
            {!! csrf_field() !!}
            <input type="hidden" name="id" value="{{ $detail->id }}">
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
                <label for="email">Loại </label>
                <select class="form-control" name="type" id="type">                                
                  <option value="1" {{ 1 ==  $detail->type ? "selected" : "" }}>Sản phẩm</option>
                  <option value="2" {{ 2 ==  $detail->type ? "selected" : "" }}>Bài viết</option>
                  <option value="3" {{ 3 ==  $detail->type ? "selected" : "" }}>Tiện ích xung quanh</option>
                </select>
              </div>
              <div class="form-group" id="div_tien_ich" @if( old('type', $detail->type) != 3 ) style="display:none" @endif>
                <label for="email">Quận</label>
                  <select class="form-control" name="district_id" id="district_id" data-live-search="true">
                      @foreach( $districtList as $value )
                      <option value="{{ $value->id }}"
                      {{ old('district_id') == $value->id ? "selected" : "" }}                           

                      >{{ $value->name }}</option>
                      @endforeach
                  </select>
              </div>
               <!-- text input -->
              <div class="form-group">
                <label>Tag <span class="red-star">*</span></label>
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
            </div>                    
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
              <a class="btn btn-default btn-sm" class="btn btn-primary btn-sm" href="{{ route('tag.index')}}">Hủy</a>
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

@stop
@section('javascript_page')
<script type="text/javascript">
  $(document).ready(function(){
    $('#type').change(function(){
      var type = $(this).val();
      if(type != 3){
        $('#div_tien_ich').hide();
      }else{
        $('#div_tien_ich').show();
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
</script>>
@stop
