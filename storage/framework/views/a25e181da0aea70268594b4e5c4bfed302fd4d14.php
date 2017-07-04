<?php $__env->startSection('slider'); ?>
<?php 

$bannerArr = DB::table('banner')->where(['object_id' => 1, 'object_type' => 3])->orderBy('display_order', 'asc')->get();

?>
<?php if($bannerArr): ?>
<section class="block slider-wrapper theme-default block-slide">
    <div id="slider" class="nivoSlider">
        <?php $i = 0; ?>
		<?php foreach($bannerArr as $banner): ?>
		 <?php $i++; ?>
        <img src="<?php echo e(Helper::showImage($banner->image_url)); ?>" data-thumb="<?php echo e(Helper::showImage($banner->image_url)); ?>" alt="slide <?php echo e($i); ?>" />
        <?php endforeach; ?>
    </div>
</section><!-- /block-slide -->
<?php endif; ?>
<?php $__env->stopSection(); ?>