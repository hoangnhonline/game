<?php echo $__env->make('frontend.partials.meta', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>
<div class="col-sm-9 block-main">
	<div class="block-product block-block-title block-page">
		<div class="block-content">
			<div class="product-view">
	            <div class="block-slide-proview">
	                <div class="row">
	                    <div class="product-img-box col-md-6 col-sm-6 col-xs-12">
	                        <div class="bxslider product-img-gallery">
	                        	<?php $i = 0; ?>
	                            <?php foreach( $hinhArr as $hinh ): ?>
	                            <?php $i++; ?>
	                            <div class="item">
	                                <img src="<?php echo e(Helper::showImage($hinh['image_url'])); ?>" alt="<?php echo $detail->name; ?> <?php echo e($i); ?>" />
	                            </div>								
	                            <?php endforeach; ?>	                            
	                        </div>
	                        <div class="product-img-thumb">
	                            <div id="gallery_01" class="pro-thumb-img">
	                                <?php $i = 0; ?>
		                            <?php foreach( $hinhArr as $hinh ): ?>
		                            <?php $i++; ?>
		                            <div class="item">
	                                    <a href="javascript:void(0)" data-slide-index="<?php echo e($i-1); ?>">
	                                        <img src="<?php echo e(Helper::showImage($hinh['image_url'])); ?>" alt="<?php echo $detail->name; ?> <?php echo e($i); ?>" />
	                                    </a>
	                                </div>		                            							
		                            <?php endforeach; ?>	                                
	                            </div>
	                        </div>
	                    </div>
	                    <div class="product-shop col-md-6 col-sm-6 col-xs-12">
	                        <div class="product-name">
	                            <h1 class="name-product-detail"><?php echo $detail->name; ?></h1>
	                        </div>
	                        <?php if($detail->description): ?>
	                        <div class="product-description">
	                            <label class="title">Mô tả:</label>
	                            <div class="pro-desc-info">
	                                <?php echo $detail->description; ?>

	                            </div>
	                        </div>
	                        <?php endif; ?>
	                        <div class="social-share">
	                            <label class="title">Share:</label>
	                            <ul class="list-socials">
	                                <li><a class="btn-share btn-fb" href="http://www.facebook.com/sharer.php?u=<?php echo e(url()->current()); ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
	                                <li><a class="btn-share btn-tw" href="https://twitter.com/share?url=<?php echo e(url()->current()); ?>&amp;text=<?php echo $detail->name; ?>&amp;hashtags=baobihoahopphat" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
	                                <li><a class="btn-share btn-gp" href="https://plus.google.com/share?url=<?php echo e(url()->current()); ?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>	                                
	                            </ul>
	                        </div>
	                    </div>
	                </div>
	            </div><!-- /block-slide-proview -->
	            <?php if($detail->content): ?>
	            <div class="product-detail">
	                <div class="tab product-tab">
	                    <ul class="nav nav-tabs" role="tablist">
						    <li role="presentation" class="active"><a href="#ctsp" aria-controls="ctsp" role="tab" data-toggle="tab">Chi tiết sản phẩm</a></li>						   
					  	</ul>
	                </div>
	                 <!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="ctsp">
							<?php echo $detail->content; ?>

						</div>						
					</div>
	            </div><!-- /product-detail -->
	            <?php endif; ?>
	        </div>
	        <?php if($otherList): ?>
	        <div class="block-product-relatives">
	        	<div class="block-title">
	        		Sản phẩm liên quan
	        	</div>
	        	<div class="block-content">
	        		<div class="row block-list-product">
	        			<?php foreach($otherList as $product): ?>
						<div class="col-md-5ths col-xs-6">
							<div class="item">
								<div class="product-img">
									<a href="<?php echo e(route('chi-tiet', [$product->slug_loai, $product->slug, $product->id])); ?>" title="<?php echo $product->name; ?>">
										<img src="<?php echo e(Helper::showImage($product->image_url)); ?>" alt="<?php echo $product->name; ?>">
									</a>
								</div>
								<h2 class="product-name"><?php echo $product->name; ?></h2>
							</div>
						</div><!-- /col-md-5ths col-xs-6 -->
						<?php endforeach; ?>
					</div>
	        	</div>
	        </div><!-- /block-content -->
	        <?php endif; ?>
		</div><!-- /block-content -->
	</div><!-- /block-product -->
	</div><!-- /block-main -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript_page'); ?>
<script src="<?php echo e(URL::asset('public/assets/vendor/jquery.zoom/jquery.zoom.min.js')); ?>"></script>
<script type="text/javascript">
$(document).ready(function () {            

    $('.bxslider .item').each(function () {
        $(this).zoom();
    });

    $(".bxslider").bxSlider({
        pagerCustom: '.pro-thumb-img',
        nextText: '<i class="fa fa-chevron-right"></i>',
        prevText: '<i class="fa fa-chevron-left"></i>'
    });

    $(".pro-thumb-img").bxSlider({
        slideMargin: 10,
        maxSlides: 5,
        pager: false,
        controls: false,
        slideWidth: 50,
        infiniteLoop: false
    });

});
</script>>
<?php $__env->stopSection(); ?>