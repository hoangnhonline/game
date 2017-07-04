<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Sản phẩm
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="<?php echo e(route( 'product.index' )); ?>">Sản phẩm</a></li>
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
      <a href="<?php echo e(route('product.create', ['loai_id' => $arrSearch['loai_id'], 'cate_id' => $arrSearch['cate_id']])); ?>" class="btn btn-info btn-sm" style="margin-bottom:5px">Tạo mới</a>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Bộ lọc</h3>
        </div>
        <div class="panel-body">
          <form class="form-inline" id="searchForm" role="form" method="GET" action="<?php echo e(route('product.index')); ?>">
           
          
            
            <div class="form-group">
              <label for="email">Danh mục cha</label>
              <select class="form-control" name="loai_id" id="loai_id">
                <option value="">--Tất cả--</option>
                <?php foreach( $loaiSpArr as $value ): ?>
                <option value="<?php echo e($value->id); ?>" <?php echo e($value->id == $arrSearch['loai_id'] ? "selected" : ""); ?>><?php echo e($value->name); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
              <div class="form-group">
              <label for="email">Danh mục con</label>

              <select class="form-control" name="cate_id" id="cate_id">
                <option value="">--Tất cả--</option>
                <?php foreach( $cateArr as $value ): ?>
                <option value="<?php echo e($value->id); ?>" <?php echo e($value->id == $arrSearch['cate_id'] ? "selected" : ""); ?>><?php echo e($value->name); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="email">Tên</label>
              <input type="text" class="form-control" name="name" value="<?php echo e($arrSearch['name']); ?>">
            </div>
            <!--<div class="form-group">
              <label for="email">Ẩn/hiện :</label>
              <label class="radio-inline"><input type="radio" <?php echo e($arrSearch['status'] == 1 ? "checked" : ""); ?> name="status" value="1">Hiện</label>
              <label class="radio-inline"><input type="radio" <?php echo e($arrSearch['status'] == 0 ? "checked" : ""); ?> name="status" value="0">Ẩn</label>              
            </div>-->
            <div class="form-group">
              <label><input type="checkbox" name="is_hot" value="1" <?php echo e($arrSearch['is_hot'] == 1 ? "checked" : ""); ?>> HOT</label>              
            </div>
            <div class="form-group">
              <label><input type="checkbox" name="is_sale" value="1" <?php echo e($arrSearch['is_sale'] == 1 ? "checked" : ""); ?>> SALE</label>              
            </div>
            <div class="form-group">
              <label><input type="checkbox" name="in_stock" value="1" <?php echo e($arrSearch['in_stock'] == 1 ? "checked" : ""); ?>> Hết hàng</label>              
            </div>                      
            <button type="submit" style="margin-top:-5px" class="btn btn-primary btn-sm">Lọc</button>
          </form>         
        </div>
      </div>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Danh sách ( <?php echo e($items->total()); ?> sản phẩm )</h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
          <div style="text-align:center">
           <?php echo e($items->appends( $arrSearch )->links()); ?>

          </div>  
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>
              <?php if($arrSearch['is_hot'] == 1 && $arrSearch['loai_id'] > 0 ): ?>
              <th style="width: 1%;white-space:nowrap">Thứ tự</th>
              <?php endif; ?>
              <th width="100px">Hình ảnh</th>
              <th style="text-align:center">Thông tin sản phẩm</th>                              
              <th width="1%;white-space:nowrap">Thao tác</th>
            </tr>
            <tbody>
            <?php if( $items->count() > 0 ): ?>
              <?php $i = 0; ?>
              <?php foreach( $items as $item ): ?>
                <?php $i ++; 

                ?>
              <tr id="row-<?php echo e($item->id); ?>">
                <td><span class="order"><?php echo e($i); ?></span></td>
                <?php if($arrSearch['is_hot'] == 1 && $arrSearch['loai_id'] > 0 ): ?>
                <td style="vertical-align:middle;text-align:center">
                  <img src="<?php echo e(URL::asset('admin/dist/img/move.png')); ?>" class="move img-thumbnail" alt="Cập nhật thứ tự"/>
                </td>
                <?php endif; ?>
                <td>
                  <img class="img-thumbnail lazy" width="80" data-original="<?php echo e($item->image_url ? Helper::showImage($item->image_url) : URL::asset('admin/dist/img/no-image.jpg')); ?>" alt="Nổi bật" title="Nổi bật" />
                </td>
                <td>                  
                  <a style="color:#333;font-weight:bold" href="<?php echo e(route( 'product.edit', [ 'id' => $item->id ])); ?>"><?php echo e($item->name); ?> <?php echo e($item->name_extend); ?></a> &nbsp; <?php if( $item->is_hot == 1 ): ?>
                  <img class="img-thumbnail" src="<?php echo e(URL::asset('admin/dist/img/star.png')); ?>" alt="Nổi bật" title="Nổi bật" />
                  <?php endif; ?><br />
                  <strong style="color:#337ab7;font-style:italic"> <?php echo e($item->ten_loai); ?> / <?php echo e($item->ten_cate); ?></strong>
                 <p style="margin-top:10px">
                    
                    <b style="color:red">                  
                    <?php echo e(number_format($item->price)); ?>

                    </b> [ <b style="color:orange">                  
                    <?php echo e(number_format($item->price_5)); ?>

                    </b> ]
                    
                  </p>
                  
                </td>
                <td style="white-space:nowrap; text-align:right">
                  <a class="btn btn-default btn-sm" href="<?php echo e(route('chi-tiet', [$item->slug_loai, $item->slug, $item->id] )); ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i> Xem</a>                  
                  <a href="<?php echo e(route( 'product.edit', [ 'id' => $item->id ])); ?>" class="btn btn-warning btn-sm">Chỉnh sửa</a>                 

                  <a onclick="return callDelete('<?php echo e($item->name); ?>','<?php echo e(route( 'product.destroy', [ 'id' => $item->id ])); ?>');" class="btn btn-danger btn-sm">Xóa</a>

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
          <div style="text-align:center">
           <?php echo e($items->appends( $arrSearch )->links()); ?>

          </div>  
        </div>        
      </div>
      <!-- /.box -->     
    </div>
    <!-- /.col -->  
  </div> 
</section>
<!-- /.content -->
</div>
<style type="text/css">
#searchForm div{
  margin-right: 7px;
}
</style>
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
  $('input.submitForm').click(function(){
    var obj = $(this);
    if(obj.prop('checked') == true){
      obj.val(1);      
    }else{
      obj.val(0);
    } 
    obj.parent().parent().parent().submit(); 
  });
  
  $('#loai_id').change(function(){
    $('#cate_id').val('');
    $('#searchForm').submit();
  });
  $('#cate_id').change(function(){
    $('#searchForm').submit();
  });
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
            updateOrder("san_pham", strOrder);
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