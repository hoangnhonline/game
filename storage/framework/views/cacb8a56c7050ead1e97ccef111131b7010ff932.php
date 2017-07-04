<?php echo $__env->make('frontend.partials.meta', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>
<div class="col-sm-9 block-main">
  <?php foreach($loaiSpList as $loaiSp): ?>
  <div class="block-product block-block-title">
    <h2 class="block-title"><?php echo $loaiSp->name; ?></h2>
    <div class="block-content">
      <div class="row block-list-product">
        <?php if($productArr[$loaiSp->id]->count() > 0): ?>
        <?php foreach($productArr[$loaiSp->id] as $product): ?>
        <div class="col-md-5ths col-xs-6">
          <div class="item">
            <div class="product-img">
              <a href="<?php echo e(route('chi-tiet', [$product->slug_loai, $product->slug, $product->id])); ?>" title="<?php echo $product->name; ?>">
                <img src="<?php echo e(Helper::showImageThumb($product->image_url)); ?>" alt="<?php echo $product->name; ?>">
              </a>
            </div>
            <h2 class="product-name"><?php echo $product->name; ?></h2>
          </div>
        </div><!-- /col-md-5ths col-xs-6 -->
        <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div><!-- /block-content -->
  </div><!-- /block-product -->
  <?php endforeach; ?>
</div><!-- /block-main -->
<?php $__env->stopSection(); ?>