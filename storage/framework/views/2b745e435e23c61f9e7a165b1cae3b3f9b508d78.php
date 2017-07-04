<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Danh mục cha 
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="<?php echo e(route( 'loai-sp.index' )); ?>">Danh mục cha</a></li>
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
      <a href="<?php echo e(route('loai-sp.create')); ?>" class="btn btn-info btn-sm" style="margin-bottom:5px">Tạo mới</a>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Danh sách</h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>
              <th style="width: 1%;white-space:nowrap">Thứ tự</th>
              <th>Tên</th>
              <th style="text-align:center">Danh mục con</th>              
              <th width="1%;white-space:nowrap">Thao tác</th>
            </tr>
            <tbody>
            <?php if( $items->count() > 0 ): ?>
              <?php $i = 0; ?>
              <?php foreach( $items as $item ): ?>
                <?php $i ++; ?>
              <tr id="row-<?php echo e($item->id); ?>">
                <td><span class="order"><?php echo e($i); ?></span></td>
                <td style="vertical-align:middle;text-align:center">
                  <img src="<?php echo e(URL::asset('admin/dist/img/move.png')); ?>" class="move img-thumbnail" alt="Cập nhật thứ tự"/>
                </td>
                <td>                  
                  <a href="<?php echo e(route( 'loai-sp.edit', [ 'id' => $item->id ])); ?>"><?php echo e($item->name); ?></a>
                  
                  <?php if( $item->is_hot == 1 ): ?>
                  <img class="img-thumbnail" src="<?php echo e(URL::asset('admin/dist/img/star.png')); ?>" alt="Nổi bật" title="Nổi bật" />
                  <?php endif; ?>
                  
                  <p><?php echo e($item->description); ?></p>
                </td>
                <td style="text-align:center"><a class="btn btn-info btn-sm" href="<?php echo e(route('cate.index', [$item->id])); ?>"><?php echo e($item->cates->count()); ?></a></td>               
               
                <td style="white-space:nowrap; text-align:right">
                <a class="btn btn-default btn-sm" href="<?php echo e(route('danh-muc', $item->slug )); ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i> Xem</a>                  
                  <a href="<?php echo e(route( 'loai-sp.edit', [ 'id' => $item->id ])); ?>" class="btn-sm btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>                 
                  <?php if( $item->cates->count() == 0): ?>
                  <a onclick="return callDelete('<?php echo e($item->name); ?>','<?php echo e(route( 'loai-sp.destroy', [ 'id' => $item->id ])); ?>');" class="btn-sm btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                  <?php endif; ?>
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