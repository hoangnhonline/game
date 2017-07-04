<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Sản phẩm    
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo e(route('product.index')); ?>">Sản phẩm</a></li>
      <li class="active">Chỉnh sửa</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="<?php echo e(route('product.index', ['loai_id' => $detail->loai_id, 'cate_id' => $detail->cate_id])); ?>" style="margin-bottom:5px">Quay lại</a>
    
    <form role="form" method="POST" action="<?php echo e(route('product.update')); ?>" id="dataForm">
    <div class="row">
      <!-- left column -->
      <input type="hidden" name="id" value="<?php echo e($detail->id); ?>">
      <div class="col-md-8">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Chỉnh sửa</h3>
          </div>
          <!-- /.box-header -->               
            <?php echo csrf_field(); ?>          
            <div class="box-body">
                <?php if(Session::has('message')): ?>
                <p class="alert alert-info" ><?php echo e(Session::get('message')); ?></p>
                <?php endif; ?>
                <?php if(count($errors) > 0): ?>
                  <div class="alert alert-danger">
                    <ul>
                        <?php foreach($errors->all() as $error): ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                  </div>
                <?php endif; ?>
                <div>

                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Thông tin chi tiết</a></li>
                    
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Hình ảnh</a></li>
                                     
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="form-group col-md-6 none-padding">
                          <label for="email">Danh mục cha<span class="red-star">*</span></label>
                          <select class="form-control" name="loai_id" id="loai_id">
                            <option value="">--Chọn--</option>
                            <?php foreach( $loaiSpArr as $value ): ?>
                            <option value="<?php echo e($value->id); ?>"
                            <?php echo e(old('loai_id', $detail->loai_id) == $value->id ? "selected" : ""); ?>


                            ><?php echo e($value->name); ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                          <div class="form-group col-md-6 none-padding pleft-5">
                          <label for="email">Danh mục con</label>

                          <select class="form-control" name="cate_id" id="cate_id">
                            <option value="">--Chọn--</option>
                            <?php foreach( $cateArr as $value ): ?>
                            <option value="<?php echo e($value->id); ?>" <?php echo e(old('cate_id', $detail->cate_id) == $value->id ? "selected" : ""); ?>

                            ><?php echo e($value->name); ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>  
                        <div class="form-group" >                  
                          <label>Tên <span class="red-star">*</span></label>
                          <input type="text" class="form-control" name="name" id="name" value="<?php echo e(old('name', $detail->name)); ?>">
                        </div>
                        <div class="form-group">                  
                          <label>Slug <span class="red-star">*</span></label>                  
                          <input type="text" class="form-control" name="slug" id="slug" value="<?php echo e(old('slug', $detail->slug)); ?>">
                        </div>
                        <div class="form-group">
                            <label>Mô tả ngắn</label>
                            <textarea class="form-control" rows="4" name="description" id="description"><?php echo e(old('description', $detail->description)); ?></textarea>
                          </div>
                        
                        <div class="form-group">
                          <label>Chi tiết</label>
                          <textarea class="form-control" rows="10" name="content" id="content"><?php echo e(old('content', $detail->content)); ?></textarea>
                        </div>
                    </div><!--end thong tin co ban-->                    
                    
                     <div role="tabpanel" class="tab-pane" id="settings">
                        <div class="form-group" style="margin-top:10px;margin-bottom:10px">  
                         
                          <div class="col-md-12" style="text-align:center">                            
                            
                            <input type="file" id="file-image"  style="display:none" multiple/>
                         
                            <button class="btn btn-primary" id="btnUploadImage" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                            <div class="clearfix"></div>
                            <div id="div-image" style="margin-top:10px">                              
                              <?php if( $hinhArr ): ?>
                                <?php foreach( $hinhArr as $k => $hinh): ?>
                                  <div class="col-md-3">
                                    <img class="img-thumbnail" src="<?php echo e(Helper::showImage($hinh)); ?>" style="width:100%">
                                    <div class="checkbox">                                   
                                      <label><input type="radio" name="thumbnail_id" class="thumb" value="<?php echo e($k); ?>" <?php echo e($detail->thumbnail_id == $k ? "checked" : ""); ?>> Ảnh đại diện </label>
                                      <button class="btn btn-danger btn-sm remove-image" type="button" data-value="<?php echo e($hinh); ?>" data-id="<?php echo e($k); ?>" >Xóa</button>
                                    </div>
                                    <input type="hidden" name="image_id[]" value="<?php echo e($k); ?>">
                                  </div>
                                <?php endforeach; ?>
                              <?php endif; ?>

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
              <button type="submit" class="btn btn-primary" id="btnSave">Lưu</button>
              <a class="btn btn-default" class="btn btn-primary" href="<?php echo e(route('product.index', ['loai_id' => $detail->loai_id, 'cate_id' => $detail->cate_id])); ?>">Hủy</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
      <div class="col-md-4">      
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Thông tin SEO</h3>
          </div>

          <!-- /.box-header -->
            <div class="box-body">
              <input type="hidden" name="meta_id" value="<?php echo e($detail->meta_id); ?>">
              <div class="form-group">
                <label>Meta title </label>
                <input type="text" class="form-control" name="meta_title" id="meta_title" value="<?php echo e(!empty((array)$meta) ? $meta->title : ""); ?>">
              </div>
              <!-- textarea -->
              <div class="form-group">
                <label>Meta desciption</label>
                <textarea class="form-control" rows="6" name="meta_description" id="meta_description"><?php echo e(!empty((array)$meta) ? $meta->description : ""); ?></textarea>
              </div>  

              <div class="form-group">
                <label>Meta keywords</label>
                <textarea class="form-control" rows="4" name="meta_keywords" id="meta_keywords"><?php echo e(!empty((array)$meta) ? $meta->keywords : ""); ?></textarea>
              </div>  
              <div class="form-group">
                <label>Custom text</label>
                <textarea class="form-control" rows="6" name="custom_text" id="custom_text"><?php echo e(!empty((array)$meta) ? $meta->custom_text : ""); ?></textarea>
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
<input type="hidden" id="route_upload_tmp_image_multiple" value="<?php echo e(route('image.tmp-upload-multiple')); ?>">
<input type="hidden" id="route_upload_tmp_image" value="<?php echo e(route('image.tmp-upload')); ?>">
<style type="text/css">
  .nav-tabs>li.active>a{
    color:#FFF !important;
    background-color: #3C8DBC !important;
  }

</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript_page'); ?>
<script type="text/javascript">

$(document).on('click', '.remove-image', function(){
/*  var obj = $(this);
  var is_thumbnail = obj.parents('col-md-3').find("input[name=thumbnail_id]").is(":checked");
  console.log(is_thumbnail);
  */
  if( confirm ("Bạn có chắc chắn không ?")){
    $(this).parents('.col-md-3').remove();
  }
});

    $(document).ready(function(){
         
      $('#loai_id').change(function(){
        location.href="<?php echo e(route('product.create')); ?>?loai_id=" + $(this).val();
      })
      $(".select2").select2();
      $('#dataForm').submit(function(){
        /*var no_cate = $('input[name="category_id[]"]:checked').length;
        if( no_cate == 0){
          swal("Lỗi!", "Chọn ít nhất 1 thể loại!", "error");
          return false;
        }
        var no_country = $('input[name="country_id[]"]:checked').length;
        if( no_country == 0){
          swal("Lỗi!", "Chọn ít nhất 1 quốc gia!", "error");
          return false;
        }        
        */
        //$('#btnSave').hide();
        $('#btnLoading').show();
      });
      var editor = CKEDITOR.replace( 'content',{
          language : 'vi',
          height: 300,
          filebrowserBrowseUrl: "<?php echo e(URL::asset('/backend/dist/js/kcfinder/browse.php?type=files')); ?>",
          filebrowserImageBrowseUrl: "<?php echo e(URL::asset('/backend/dist/js/kcfinder/browse.php?type=images')); ?>",
          filebrowserFlashBrowseUrl: "<?php echo e(URL::asset('/backend/dist/js/kcfinder/browse.php?type=flash')); ?>",
          filebrowserUploadUrl: "<?php echo e(URL::asset('/backend/dist/js/kcfinder/upload.php?type=files')); ?>",
          filebrowserImageUploadUrl: "<?php echo e(URL::asset('/backend/dist/js/kcfinder/upload.php?type=images')); ?>",
          filebrowserFlashUploadUrl: "<?php echo e(URL::asset('/backend/dist/js/kcfinder/upload.php?type=flash')); ?>"
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
         
     
      
    });
    
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>