
<?php echo $__env->make('frontend.partials.meta', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>
<div class="col-sm-9 block-main">
	<div class="block block-breadcrumb">
	  <ul class="breadcrumb"> 
	    <li><a href="<?php echo e(route('home')); ?>" title="Trở về trang chủ">Trang chủ</a></li>
	    <li class="active">
	    <?php if(isset($is_child)): ?>
		<?php echo $rsCate->name; ?>

		<?php else: ?>
		<?php echo $rs->name; ?>

		<?php endif; ?></li>
	  </ul>
	</div><!-- /block-breadcrumb -->
<div class="block-product block-block-title block-page">
	<h2 class="block-title">
	<?php if(isset($is_child)): ?>
	<?php echo $rsCate->name; ?>

	<?php else: ?>
	<?php echo $rs->name; ?>

	<?php endif; ?>
	</h2>
	<div class="block-share absolute">
		<span>Chia sẻ lên:</span>
		<a href="http://www.facebook.com/sharer.php?u=<?php echo e(url()->current()); ?>" target="_blank" title="facebook" class="facebook"><i class="fa fa-facebook"></i></a>
		<a href="https://plus.google.com/share?url=<?php echo e(url()->current()); ?>" target="_blank" title="google" class="google"><i class="fa fa-google-plus"></i></a>
		<a  href="https://twitter.com/share?url=<?php echo e(url()->current()); ?>&amp;text=<?php echo $rs->name; ?>&amp;hashtags=baobihoahopphat" target="_blank" title="twitter" class="twitter"><i class="fa fa-twitter"></i></a>		
	</div>
	<div class="block-content">
		<?php if(!empty( (array) $productList )): ?>
		<div class="row block-list-product">
			<?php foreach( $productList as $product ): ?>
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
		</div>
		<?php endif; ?>
	</div><!-- /block-content -->
</div><!-- /block-product -->
</div><!-- /block-main -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>