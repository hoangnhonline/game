<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Thông báo
  </h1>
  
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">		  
		  <div class="panel-body" style="background-color:#063d4c; color:#FFF"><?php echo $settingArr['thong_bao_chung']; ?></div>
		</div>
      <div class="box">

<div class="box-header with-border">
  <h3 class="box-title">Tin ký gửi chưa duyệt ( <?php echo e($kyguiList->count()); ?> )</h3>
</div>

<!-- /.box-header -->
<div class="box-body">
 
  <table class="table table-bordered" id="table-list-data" cellpadding="1" cellspacing="0">
    <tr>
      <th style="width: 1%">#</th>      
      <th style="text-align:left">Thông tin</th>
      <th width="120px">Trạng thái</th>                              
      <th width="1%;white-space:nowrap">Thao tác</th>
    </tr>
    <tbody>
    <?php if( $kyguiList->count() > 0 ): ?>
      <?php $i = 0; ?>
      <?php foreach( $kyguiList as $item ): ?>
        <?php $i ++; 

        ?>
      <tr id="row-<?php echo e($item->id); ?>">
        <td><span class="order"><?php echo e($i); ?></span></td>
        <td>                  
          <a style="color:<?php echo e($item->cart_status == 1 ? "#444" : "red"); ?>;font-weight:bold" href="<?php echo e(route( 'product.edit', [ 'id' => $item->id ])); ?>"><?php echo e($item->title); ?></a> -<strong style="color:#337ab7;font-style:italic"> <?php echo e(Helper::getName($item->estate_type_id, 'estate_type')); ?></strong><br />
          
          <p style="padding-bottom:0px !important;"><b style="color:red">                  
            <?php echo e(($item->price)); ?> <?php echo e(Helper::getName($item->price_unit_id, 'price_unit')); ?>

           </b>                     -
            <?php if($item->street_id > 0): ?>
            <?php echo e(Helper::getName($item->street_id, 'street')); ?>,&nbsp;
            <?php endif; ?>
            <?php if($item->ward_id > 0): ?>
            <?php echo e(Helper::getName($item->ward_id, 'ward')); ?>,&nbsp;
            <?php endif; ?>
            <?php if($item->district_id > 0): ?>
            <?php echo e(Helper::getName($item->district_id, 'district')); ?>,&nbsp;
            <?php endif; ?>
            <?php if($item->city_id > 0): ?>
            <?php echo e(Helper::getName($item->city_id, 'city')); ?>

            <?php endif; ?>

          </p>
         <p style="margin-top:10px">
            
            
          </p>
          
        </td>
        <td>                
          <?php if($item->type == 1): ?>
            <?php echo e($item->cart_status == 1 ? "Chưa bán" : "Đã bán"); ?>                  
          <?php else: ?>
            <?php echo e($item->cart_status == 1 ? "Còn trống" : "Đã thuê"); ?>

          <?php endif; ?>
        </td>
        <td style="white-space:nowrap; text-align:right">
          <a class="btn btn-default btn-sm" href="<?php echo e(route('chi-tiet', [$item->slug_loai, $item->slug, $item->id] )); ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i> Xem</a>
          
          
          <a href="<?php echo e(route( 'product.edit', [ 'id' => $item->id ])); ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>                 

          <a onclick="return callDelete('<?php echo e($item->name); ?>','<?php echo e(route( 'product.destroy', [ 'id' => $item->id ])); ?>');" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>

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
</div><!-- /.box -->    

    </div>
    <!-- /.col -->  
  </div> 
</section>
<!-- /.content -->
</div>
<div class="col-md-12">
<?php if($settingArr['thong_bao_chung']): ?>
	
<?php endif; ?>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>