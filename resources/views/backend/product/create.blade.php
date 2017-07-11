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
      <li class="active">Add new</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <a class="btn btn-default btn-sm" href="{{ route('product.index') }}" style="margin-bottom:5px">Back</a>
   <form role="form" method="POST" action="{{ route('product.store') }}" id="dataForm">
      <div class="row">
         <!-- left column -->
         <div class="col-md-8">
            <!-- general form elements -->
            <div class="box box-primary">
               <div class="box-header with-border">
                  <h3 class="box-title">Add new</h3>
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
                        </div>
                        <!--end thong tin co ban-->
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
                        </div>
                        <!--end hinh anh-->
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
            @include('backend.partials.seo-info-create')
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