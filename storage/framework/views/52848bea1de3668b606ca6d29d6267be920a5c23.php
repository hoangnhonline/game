

<?php echo $__env->make('frontend.partials.meta', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>

<?php 
$bannerArr = DB::table('banner')->where(['object_id' => 2, 'object_type' => 3])->orderBy('display_order', 'asc')->get();
?>
<div class="col-sm-9 block-main">
    <div class="block block-breadcrumb">
        <ul class="breadcrumb"> 
            <li><a href="<?php echo e(route('home')); ?>" title="Trở về trang chủ">Trang chủ</a></li>
            <li class="active">Hồ sơ công ty</li>
        </ul>
    </div><!-- /block-breadcrumb -->
    <div class="block-page block-page-title">
        <h3 class="block-title">BAO BÌ GIẤY HÒA HỢP PHÁT</h3>
        <div class="block-content row">
            <div class="col-sm-4 col-xs-12 block-slide-about">
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
            <div class="col-sm-8 col-xs-12 block-info-about">
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
                                    <td class="title"><img src="<?php echo e(URL::asset('public/assets/images/arrow1.png')); ?>" alt=""> Số thành viên</td>
                                    <td><?php echo $settingArr['so_thanh_vien']; ?></td>
                                </tr>
                                <tr>
                                    <td class="title"><img src="<?php echo e(URL::asset('public/assets/images/arrow1.png')); ?>" alt=""> Doanh thu/năm</td>
                                    <td><?php echo $settingArr['doanh_thu']; ?></td>
                                </tr>
                                <tr>
                                    <td class="title"><img src="<?php echo e(URL::asset('public/assets/images/arrow1.png')); ?>" alt=""> Thị trường chính</td>
                                    <td><?php echo $settingArr['thi_truong_chinh']; ?></td>
                                </tr>                               
                        </tbody>
                    </table><!-- /table -->
                </div>
            </div><!-- /block-info-about -->
        </div>
        <h4 class="block-title-section" style="margin-top:20px">Chứng chỉ, giấy chứng nhận, giấy xác nhận, giải thưởng...</h4>
        <p class="content-setting"><?php echo $settingArr['chung_chi']; ?></p>
        <h4 class="block-title-section" style="margin-top:20px">Năng lực công ty</h4>
        <p class="content-setting"><?php echo $settingArr['nang_luc']; ?></p>
    </div><!-- /block-page -->
</div><!-- /block-main -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>