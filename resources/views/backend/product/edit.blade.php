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
      <li class="active">Update</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <a class="btn btn-default btn-sm" href="{{ route('product.index') }}" style="margin-bottom:5px">Back</a>
   <form role="form" method="POST" action="{{ route('product.update') }}" id="dataForm">
      <input type="hidden" name="id" value="{{ $detail->id }}">
      <div class="row">
         <!-- left column -->
         <div class="col-md-8">
            <!-- general form elements -->
            <div class="box box-primary">
               <div class="box-header with-border">
                  <h3 class="box-title">Update</h3>
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
                              <label for="loai_id">Type <span class="red-star">*</span></label>
                              <select class="form-control" name="loai_id" id="loai_id">
                                 <option value="">--Select--</option>
                                 @foreach( $loaiSpArr as $value )
                                 <option value="{{ $value->id }}" {{ $value->id == old('loai_id', $detail->loai_id) ? "selected" : "" }}>{{ $value->name }}</option>
                                 @endforeach
                              </select>
                           </div>
                           <div class="form-group col-md-6 none-padding pleft-5">
                              <label for="cate_id">Category <span class="red-star">*</span></label>
                              <select class="form-control" name="cate_id" id="cate_id">
                                 <option value="">--Select--</option>
                                 @foreach( $cateArr as $value )
                                 <option value="{{ $value->id }}" {{ $value->id == old('cate_id', $detail->cate_id) ? "selected" : "" }}>{{ $value->name }}</option>
                                 @endforeach
                              </select>
                           </div>
                           <div class="form-group col-md-6 none-padding" >                  
                              <label>Name <span class="red-star">*</span></label>
                              <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $detail->name) }}">
                           </div>
                           <div class="form-group col-md-6 pleft-5">                  
                              <label>Slug <span class="red-star">*</span></label>                  
                              <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug', $detail->slug) }}">
                           </div>
                           <div class="form-group col-md-8 none-padding" >                  
                              <label>URL IOS</label>
                              <input type="text" class="form-control" name="url_ios" id="url_ios" value="{{ old('url_ios', $detail->url_ios) }}">
                           </div>
                           <div class="form-group col-md-4 pleft-5">                  
                              <label>Requirements</label>                  
                              <input type="text" class="form-control" name="req_ios" id="req_ios" value="{{ old('req_ios', $detail->req_ios) }}">
                           </div>
                           <div class="form-group col-md-8 none-padding" >                  
                              <label>URL Android</label>
                              <input type="text" class="form-control" name="url_android" id="url_android" value="{{ old('url_android', $detail->url_android) }}">
                           </div>
                           <div class="form-group col-md-4 pleft-5">                  
                              <label>Requirements</label>                  
                              <input type="text" class="form-control" name="req_android" id="req_android" value="{{ old('req_android', $detail->req_android) }}">
                           </div>
                           <div class="form-group col-md-8 none-padding" >                  
                              <label>URL WP</label>
                              <input type="text" class="form-control" name="url_wp" id="url_wp" value="{{ old('url_wp', $detail->url_wp) }}">
                           </div>
                           <div class="form-group col-md-4 pleft-5">                  
                              <label>Requirements</label>                  
                              <input type="text" class="form-control" name="req_wp" id="req_wp" value="{{ old('req_wp', $detail->req_wp) }}">
                           </div>
                           <div class="form-group col-md-6 none-padding" >
                              <label>Star</label>
                              <select class="form-control" name="no_star" id="no_star">
                                 <option value="">--Select--</option>
                                 <option value="3" {{ old('no_star', $detail->no_star) == 3 ? "selected" : "" }}>3</option>
                                 <option value="3.5" {{ old('no_star', $detail->no_star) == 3.5 ? "selected" : "" }}>3.5</option>
                                 <option value="4" {{ old('no_star', $detail->no_star) == 4 ? "selected" : "" }}>4</option>
                                 <option value="4.5" {{ old('no_star', $detail->no_star) == 4.5 ? "selected" : "" }}>4.5</option>
                                 <option value="5" {{ old('no_star', $detail->no_star) == 5 ? "selected" : "" }}>5</option>
                              </select>
                           </div>
                           <div class="form-group col-md-6 pleft-5">                  
                              <label>Author</label>                  
                              <input type="text" class="form-control" name="author" id="author" value="{{ old('author', $detail->author) }}">
                           </div>
                           <div class="form-group col-md-6 none-padding" >                  
                              <label>Lastest version</label>
                              <input type="text" class="form-control" name="latest_version" id="latest_version" value="{{ old('latest_version', $detail->latest_version) }}">
                           </div>
                           <div class="form-group col-md-6 pleft-5">                  
                              <label>Publish date</label>                  
                              <input type="text" class="form-control" name="publish_date" id="publish_date" value="{{ old('publish_date', $detail->publish_date) }}">
                           </div>
                           <div class="col-md-12">
                              <div class="checkbox">
                                 <label><input type="checkbox" name="is_hot" value="1" {{ $detail->is_hot == 1 ? "checked" : "" }}> <span style="color:blue">Game HOT </span></label>
                              </div>
                           </div>
                           <div class="input-group">
                            <label>Tags</label>
                            <select class="form-control select2" name="tags[]" id="tags" multiple="multiple">                  
                              @if( $tagArr->count() > 0)
                                @foreach( $tagArr as $value )
                                <option value="{{ $value->id }}" {{ in_array($value->id, $tagSelected) || (old('tags') && in_array($value->id, old('tags'))) ? "selected" : "" }}>{{ $value->name }}</option>
                                @endforeach
                              @endif
                            </select>
                            <span class="input-group-btn">
                              <button style="margin-top:24px" class="btn btn-primary btn-sm" id="btnAddTag" type="button" data-value="3">
                                Add new
                              </button>
                            </span>
                          </div>  
                          @if($detail->status == 2)
                          <div class="form-group col-md-4 none-padding" >
                              <div class="checkbox">
                                <label>
                                  <input type="radio" name="status" value="2" {{ old('status', $detail->status) == 2 ? "checked" : "" }}>
                                  Pending
                                </label>
                              </div>
                          </div> 
                          <div class="form-group col-md-4 none-padding" >
                              <div class="checkbox">
                                <label>
                                  <input type="radio" name="status" value="1" {{ old('status', $detail->status) == 1 ? "checked" : "" }}>
                                  Approved
                                </label>
                              </div>
                          </div>                        
                          <div class="form-group col-md-4 none-padding" ></div> 
                          <div class="clearfix"></div>                      
                          @endif                        
                           <div class="form-group">
                              <label>Description</label>
                              <textarea class="form-control" rows="6" name="description" id="description">{{ old('description', $detail->description) }}</textarea>
                           </div>
                           <div class="form-group">
                              <label>Detail</label>
                              <textarea class="form-control" rows="10" name="content" id="content">{{ old('content', $detail->content) }}</textarea>
                           </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="settings">
                            <div class="form-group" style="margin-top:10px;margin-bottom:10px">  
                             
                              <div class="col-md-12" style="text-align:center">                            
                                
                                <input type="file" id="file-image"  style="display:none" multiple/>
                             
                                <button class="btn btn-primary" id="btnUploadImage" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                                <div class="clearfix"></div>
                                <div id="div-image" style="margin-top:10px">                              
                                  @if( $hinhArr )
                                    @foreach( $hinhArr as $k => $hinh)
                                      <div class="col-md-3">
                                        <img class="img-thumbnail" src="{{ Helper::showImage($hinh) }}" style="width:100%">
                                        <div class="checkbox">                                   
                                          <label><input type="radio" name="thumbnail_id" class="thumb" value="{{ $k }}" {{ $detail->thumbnail_id == $k ? "checked" : "" }}> Ảnh đại diện </label>
                                          <button class="btn btn-danger btn-sm remove-image" type="button" data-value="{{  $hinh }}" data-id="{{ $k }}" >Xóa</button>
                                        </div>
                                        <input type="hidden" name="image_id[]" value="{{ $k }}">
                                      </div>
                                    @endforeach
                                  @endif

                                </div>
                              </div>
                              <div style="clear:both"></div>
                            </div>

                         </div><!--end hinh anh-->
                     </div>
                  </div>
               </div>
               <div class="box-footer">
                  <button type="button" class="btn btn-default" id="btnLoading" style="display:none"><i class="fa fa-spin fa-spinner"></i></button>
                  <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
                  <a class="btn btn-default" class="btn btn-primary" href="{{ route('product.index')}}">Cancel</a>
               </div>
            </div>
            <!-- /.box -->     
         </div>
         <div class="col-md-4">
            @include('backend.partials.seo-info-edit')
            <!--/.col (left) -->      
         </div>
   </form>
   <!-- /.row -->
</section>
<!-- /.content -->
</div>
@include('backend.partials.tag-modal')

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
           $(document).ready(function(){
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
                 $('#cate_id').html(data).selectpicker('refresh');
               }
             });
         
         });
         
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
             height: 400,
             filebrowserBrowseUrl: "{{ URL::asset('/backend/dist/js/kcfinder/browse.php?type=files') }}",
             filebrowserImageBrowseUrl: "{{ URL::asset('/backend/dist/js/kcfinder/browse.php?type=images') }}",
             filebrowserFlashBrowseUrl: "{{ URL::asset('/backend/dist/js/kcfinder/browse.php?type=flash') }}",
             filebrowserUploadUrl: "{{ URL::asset('/backend/dist/js/kcfinder/upload.php?type=files') }}",
             filebrowserImageUploadUrl: "{{ URL::asset('/backend/dist/js/kcfinder/upload.php?type=images') }}",
             filebrowserFlashUploadUrl: "{{ URL::asset('/backend/dist/js/kcfinder/upload.php?type=flash') }}"
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