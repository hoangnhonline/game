
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Thông tin trang
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="<?php echo e(route( 'info-seo.index' )); ?>">Thông tin trang</a></li>
    <li class="active">Danh sách</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <?php if(Session::has('message')): ?>
      <p class="alert alert-info" ><?php echo e(Session::get('message')); ?></p>
      <?php endif; ?>
      <a href="<?php echo e(route('info-seo.create')); ?>" class="btn btn-info btn-sm" style="margin-bottom:5px">Tạo mới</a>    
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Danh sách ( <span class="value"><?php echo e($items->total()); ?> trang )</span></h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
            
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>                            
              <th>Image</th>
              <th>URL</th>
              <th>Meta title</th>
              <th>Meta description</th>
              <th>Meta keywords</th>              
              <th width="1%;white-space:nowrap">Thao tác</th>
            </tr>
            <tbody>
            <?php if( $items->count() > 0 ): ?>
              <?php $i = 0; ?>
              <?php foreach( $items as $item ): ?>
                <?php $i ++; ?>
              <tr id="row-<?php echo e($item->id); ?>">
                <td><span class="order"><?php echo e($i); ?></span></td>      
                <td>
                  <img class="img-thumbnail lazy" data-original="<?php echo e(Helper::showImage($item->image_url)); ?>" width="80">
                </td>        
                <td>                  
                  <a href="<?php echo e(route( 'info-seo.edit', [ 'id' => $item->id ])); ?>"><?php echo e($item->url); ?></a>                  
                </td>
                <td><?php echo e($item->title); ?></td>
                <td><?php echo e($item->description); ?></td>
                <td><?php echo e($item->keywords); ?></td>
                <td style="white-space:nowrap">                  
                  <a href="<?php echo e(route( 'info-seo.edit', [ 'id' => $item->id ])); ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>                 
                  
                  <a onclick="return callDelete('<?php echo e($item->title); ?>','<?php echo e(route( 'info-seo.destroy', [ 'id' => $item->id ])); ?>');" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>
                  
                  
                </td>
              </tr> 
              <?php endforeach; ?>
            <?php else: ?>
            <tr>
              <td colspan="9">Không có dữ liệu.</td>
            </tr>
            <?php endif; ?>

          </tbody>
          </table>
           
        </div>        
      </div>
      <!-- /.box -->     
    </div>
    <!-- /.col -->  
  </div> 
</section>
<!-- /.content -->
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript_page'); ?>
<script type="text/javascript">
function callDelete(name, url){  
  swal({
    title: 'Bạn muốn xóa "' + name +'"?',
    text: "Dữ liệu sẽ không thể phục hồi.",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes'
  }).then(function() {
    location.href= url;
  })
  return flag;
}
$(document).ready(function(){
  $('#parent_id').change(function(){
    $.ajax({
        url: $('#route_get_cate_by_parent').val(),
        type: "POST",
        async: false,
        data: {          
            parent_id : $(this).val(),
            type : 'list'
        },
        success: function(data){
            $('#cate_id').html(data).select2('refresh');                      
        }
    });
  });
  $('.select2').select2();

  $('#table-list-data tbody').sortable({
        placeholder: 'placeholder',
        handle: ".move",
        start: function (event, ui) {
                ui.item.toggleClass("highlight");
        },
        stop: function (event, ui) {
                ui.item.toggleClass("highlight");
        },          
        axis: "y",
        update: function() {
            var rows = $('#table-list-data tbody tr');
            var strOrder = '';
            var strTemp = '';
            for (var i=0; i<rows.length; i++) {
                strTemp = rows[i].id;
                strOrder += strTemp.replace('row-','') + ";";
            }     
            updateOrder("loai_sp", strOrder);
        }
    });
});
function updateOrder(table, strOrder){
  $.ajax({
      url: $('#route_update_order').val(),
      type: "POST",
      async: false,
      data: {          
          str_order : strOrder,
          table : table
      },
      success: function(data){
          var countRow = $('#table-list-data tbody tr span.order').length;
          for(var i = 0 ; i < countRow ; i ++ ){
              $('span.order').eq(i).html(i+1);
          }                        
      }
  });
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>