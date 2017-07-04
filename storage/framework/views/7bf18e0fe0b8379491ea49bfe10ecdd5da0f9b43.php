<?php $__env->startSection('gioi_thieu'); ?>
<?php 

$bannerArr = DB::table('banner')->where(['object_id' => 2, 'object_type' => 3])->orderBy('display_order', 'asc')->get();

?>

<section class="block block-about block-block-title clearfix">
        	<h2 class="block-title">Giới Thiệu Công Ty</h2>
        	<div class="block-content block-3-col">
	        	<div class="col-sm-3 col-xs-12 block-slide-about">
	        		<div class="block-content">
	        			<div class="bxslider">
                            <?php $i = 0; ?>
                            <?php foreach($bannerArr as $banner): ?>
                             <?php $i++; ?>
							<div class="large-item">
                                
                                    <img src="<?php echo e(Helper::showImage($banner->image_url)); ?>" alt="anh <?php echo e($i); ?>" />
                               
                            </div>
                            <?php endforeach; ?>
						</div>
						<div id="bx-pager" class="bx-thumbnail">
                            <?php $i = 0; ?>
                            <?php foreach($bannerArr as $banner): ?>
                             <?php $i++; ?>
							<div class="item">
								<div class="item-child">
		                            <a data-slide-index="<?php echo e($i); ?>" class="slide_title" href="javascript:void(0)" title="anh <?php echo e($i); ?>"><img class="avatar" src="<?php echo e(Helper::showImage($banner->image_url)); ?>" alt="anh <?php echo e($i); ?>" /></a>
	                            </div>
	                        </div>
                            <?php endforeach; ?>
						</div>
	        		</div>
	        	</div><!-- /block-slide-about -->
	        	<div class="col-sm-6 col-xs-12 block-info-about">
	        		<div class="block-content">
        				<table class="table table-customize">
        					<tbody>
        						<tr>
        							<td class="title"><img src="<?php echo e(URL::asset('public/assets/images/arrow1.png')); ?>" alt=""> Loại hình cty:</td>
        							<td class="content"><?php echo $settingArr['loai_hinh']; ?></td>
        						</tr>
        						<tr>
        							<td class="title"><img src="<?php echo e(URL::asset('public/assets/images/arrow1.png')); ?>" alt=""> SP/DV chính:</td>
        							<td><?php echo $settingArr['san_pham_dich_vu_chinh']; ?></td>
        						</tr>
        						<tr>
        							<td class="title"><img src="<?php echo e(URL::asset('public/assets/images/arrow1.png')); ?>" alt=""> Năm thành lập</td>
        							<td><?php echo $settingArr['nam_thanh_lap']; ?></td>
        						</tr>
        						<tr>
        							<td class="title"><img src="<?php echo e(URL::asset('public/assets/images/arrow1.png')); ?>" alt=""> Số thành viên</td>
        							<td><?php echo $settingArr['so_thanh_vien']; ?></td>
        						</tr>
        						<tr>
        							<td class="title"><img src="<?php echo e(URL::asset('public/assets/images/arrow1.png')); ?>" alt=""> Doanh thu/ năm</td>
        							<td><?php echo $settingArr['doanh_thu']; ?></td>
        						</tr>
        						<tr>
        							<td class="title"><img src="<?php echo e(URL::asset('public/assets/images/arrow1.png')); ?>" alt=""> Thị trường chính</td>
        							<td><?php echo $settingArr['thi_truong_chinh']; ?></td>
        						</tr>
        						<tr>
        							<td class="title" colspan="2">
        								<a href="<?php echo e(route('info')); ?>" title="" class="link" target="_blank">Xem chi tiết...</a>
        							</td>
        						</tr>
        					</tbody>
        				</table><!-- /table -->
	        		</div>
	        	</div><!-- /block-info-about -->
	        	<div class="col-sm-3 col-xs-12 block-contact-about">
	        		<div class="block-content">
        				<div class="img_contact">
	                        <img src="<?php echo e(URL::asset('public/assets/images/contact1.jpg')); ?>" alt="">
	                        <p class="img2_contact_hoso">Tôi có thể giúp gì bạn?</p>
	                    </div>
	                    <div class="info_contact">
	                    	<p>Mr.Sen</p>
	                    	<p style="color: rgba(0,0,0,.87)">Tel: <strong>0909 999 999</strong></p>
	                    	<a href="mailto:joe@example.com?subject=feedback" title="" class="link">abc@gmail.com</a>
	                    </div>
	        		</div>
	        	</div><!-- /block-contact-about -->
        	</div>
        </section><!-- /block-about -->
<?php $__env->stopSection(); ?>