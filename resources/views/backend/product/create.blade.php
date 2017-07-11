@extends('backend.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Game    
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('product.index') }}">Game</a></li>
      <li class="active">Thêm mới</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('product.index') }}" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="{{ route('product.store') }}" id="dataForm">
    <div class="row">
      <!-- left column -->

      <div class="col-md-8">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Thêm mới</h3>
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
                <div>

                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Information</a></li>
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Images</a></li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="form-group col-md-6 none-padding">
                          <label for="email">Type<span class="red-star">*</span></label>
                          <select class="form-control" name="loai_id" id="loai_id">
                            <option value="">--Select--</option>
                            @foreach( $loaiSpArr as $value )
                            <option value="{{ $value->id }}" {{ $value->id == old('loai_id') || $value->id == $loai_id ? "selected" : "" }}>{{ $value->name }}</option>
                            @endforeach
                          </select>
                        </div>
                          <div class="form-group col-md-6 none-padding pleft-5">
                          <label for="email">Category</label>

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
                          <label>URL IOS <span class="red-star">*</span></label>
                          <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group col-md-4 pleft-5">                  
                          <label>Requirements</label>                  
                          <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}">
                        </div>
                        <div class="form-group col-md-8 none-padding" >                  
                          <label>URL Android <span class="red-star">*</span></label>
                          <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group col-md-4 pleft-5">                  
                          <label>Requirements</label>                  
                          <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}">
                        </div>
                        <div class="form-group col-md-8 none-padding" >                  
                          <label>URL WP <span class="red-star">*</span></label>
                          <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group col-md-4 pleft-5">                  
                          <label>Requirements</label>                  
                          <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}">
                        </div>
                        <div class="form-group col-md-6 none-padding" >                  
                          <label>Số sao</label>
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
                        <!--
                        <div class="col-md-4 none-padding pleft-5">
                            <div class="checkbox">
                              <label><input type="checkbox" name="is_sale" value="1"> Game SALE </label>
                          </div>
                        </div>
                        <div class="col-md-4 none-padding pleft-5">
                            <div class="checkbox">
                              <label><input type="checkbox" name="in_stock" value="0"> HẾT HÀNG </label>
                          </div>
                        </div>
                        <div class="form-group" >                  
                            <label>Giá</label>
                            <input type="text" class="form-control" name="price" id="price" value="{{ old('price') }}">
                        </div>                                             
                        <div class="form-group" >                  
                            <label>Giá sỉ<span class="red-star">*</span></label>
                            <input type="text" class="form-control" name="price_5" id="price_5" value="{{ old('price_5') }}">
                        </div>                    
                        <div class="form-group" >                  
                            <label>Bảo hành</label>
                            <input type="text" class="form-control" name="guarantee" id="guarantee" value="{{ old('guarantee') }}">
                        </div>
                        <div class="form-group" >                  
                            <label>URL Video</label>
                            <input type="text" class="form-control" name="video_url" id="video_url" value="{{ old('video_url') }}">
                        </div>-->
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="4" name="description" id="description">{{ old('description') }}</textarea>
                          </div>
                        
                         
                        <div class="form-group">
                          <label>Detail</label>
                          <textarea class="form-control" rows="10" name="content" id="content">{{ old('content') }}</textarea>
                        </div>
                    </div><!--end thong tin co ban-->
                     <div role="tabpanel" class="tab-pane" id="settings">
                        <div class="form-group" style="margin-top:10px;margin-bottom:10px">  
                         
                          <div class="col-md-12" style="text-align:center">                            
                            
                            <input type="file" id="file-image"  style="display:none" multiple/>
                         
                            <button class="btn btn-primary" id="btnUploadImage" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                            <div class="clearfix"></div>
                            <div id="div-image" style="margin-top:10px"></div>
                          </div>
                          <div style="clear:both"></div>
                        </div>

                     </div><!--end hinh anh-->
                     
                    
                  </div>

                </div>
                  
            </div>
            <div class="box-footer">
              <button type="button" class="btn btn-default" id="btnLoading" style="display:none"><i class="fa fa-spin fa-spinner"></i></button>
              <button type="submit" class="btn btn-primary" id="btnSave">Lưu</button>
              <a class="btn btn-default" class="btn btn-primary" href="{{ route('product.index')}}">Hủy</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
      <div class="col-md-4">      
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
      <!--/.col (left) -->      
    </div>
    </form>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<input type="hidden" id="route_upload_tmp_image_multiple" value="{{ route('image.tmp-upload-multiple') }}">
<input type="hidden" id="route_upload_tmp_image" value="{{ route('image.tmp-upload') }}">
<style type="text/css">
  .nav-tabs>li.active>a{
    color:#FFF !important;
    background-color: #3C8DBC !important;
  }

</style>
@stop
@section('javascript_page')
<script type="text/javascript">
function filterAjax(type){  
  var str_params = $('#formSearchAjax').serialize();
  
}
$(document).on('click', '.remove-image', function(){
  if( confirm ("Bạn có chắc chắn không ?")){
    $(this).parents('.col-md-3').remove();
  }
});

     
      $('#loai_id').change(function(){
        location.href="{{ route('product.create') }}?loai_id=" + $(this).val();
      })
      $(".select2").select2();
      $('#dataForm').submit(function(){
        /*var no_cate = $('input[name="category_id[]"]:checked').length;
        if( no_cate == 0){
          swal("Lỗi!", "Select ít nhất 1 thể loại!", "error");
          return false;
        }
        var no_country = $('input[name="country_id[]"]:checked').length;
        if( no_country == 0){
          swal("Lỗi!", "Select ít nhất 1 quốc gia!", "error");
          return false;
        }        
        */
        $('#btnSave').hide();
        $('#btnLoading').show();
      });
      var editor = CKEDITOR.replace( 'content',{
          language : 'vi',
          height: 300,
          filebrowserBrowseUrl: "{{ URL::asset('/backend/dist/js/kcfinder/browse.php?type=files') }}",
          filebrowserImageBrowseUrl: "{{ URL::asset('/backend/dist/js/kcfinder/browse.php?type=images') }}",
          filebrowserFlashBrowseUrl: "{{ URL::asset('/backend/dist/js/kcfinder/browse.php?type=flash') }}",
          filebrowserUploadUrl: "{{ URL::asset('/backend/dist/js/kcfinder/upload.php?type=files') }}",
          filebrowserImageUploadUrl: "{{ URL::asset('/backend/dist/js/kcfinder/upload.php?type=images') }}",
          filebrowserFlashUploadUrl: "{{ URL::asset('/backend/dist/js/kcfinder/upload.php?type=flash') }}"
      });
      
      var editor3 = CKEDITOR.replace( 'description',{
          language : 'vi',
          height : 100,
          toolbarGroups : [
            
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
            { name: 'links', groups: [ 'links' ] },           
            '/',
            
          ]
      });
      $('#btnUploadImage').click(function(){        
        $('#file-image').click();
      }); 
     
      var files = "";
      $('#file-image').change(function(e){
         files = e.target.files;
         
         if(files != ''){
           var dataForm = new FormData();        
          $.each(files, function(key, value) {
             dataForm.append('file[]', value);
          });   
          
          dataForm.append('date_dir', 0);
          dataForm.append('folder', 'tmp');

          $.ajax({
            url: $('#route_upload_tmp_image_multiple').val(),
            type: "POST",
            async: false,      
            data: dataForm,
            processData: false,
            contentType: false,
            success: function (response) {
                $('#div-image').append(response);
                if( $('input.thumb:checked').length == 0){
                  $('input.thumb').eq(0).prop('checked', true);
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

    
</script>
@stop
