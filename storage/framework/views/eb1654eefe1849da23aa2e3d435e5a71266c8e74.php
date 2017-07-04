<?php echo $__env->make('frontend.partials.meta', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>
<article class="block block-breadcrumb">
  <ul class="breadcrumb">
    <li><a href="<?php echo e(route('home')); ?>" title="Trở về trang chủ">Trang chủ</a></li>
    <li class="active">Liên hệ</li>
  </ul>
</article><!-- /block-breadcrumb -->
<div class="col-sm-9 block-main">
    <div class="block-page block-page-title">
        <h3 class="block-title">BAO BÌ ĐỒNG THUẬN PHÁT - CÔNG TY TNHH BAO BÌ ĐỒNG THUẬN PHÁT</h3>
        <div class="block-content row">
            <div class="col-sm-4 col-xs-12 block-slide-about">
                <div class="block-content">
                    <div class="bxslider">
                        <div class="large-item">
                            <a href="#" title=""><img src="images/info/Thung_carton_-_carton_paper_box.jpg" alt="" /></a>
                        </div>
                        <div class="large-item">
                            <a href="#" title=""><img src="images/info/may_xa.jpg" alt="" /></a>
                        </div>
                        <div class="large-item">
                            <a href="#" title=""><img src="images/info/201111155206_mvu_1503.jpg" alt="" /></a>
                        </div>
                    </div>
                    <div id="bx-pager" class="bx-thumbnail">
                        <div class="item">
                            <div class="item-child">
                                <a data-slide-index="0" class="slide_title" href="#" title=""><img class="avatar" src="images/info/Thung_carton_-_carton_paper_box.jpg" alt="" /></a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="item-child">
                                <a data-slide-index="1" class="slide_title" href="#" title=""><img class="avatar" src="images/info/may_xa.jpg" alt="" /></a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="item-child">
                                <a data-slide-index="2" class="slide_title" href="#" title=""><img class="avatar" src="images/info/201111155206_mvu_1503.jpg" alt="" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /block-slide-about -->
            <div class="col-sm-8 col-xs-12 block-info-about">
                <div class="block-content">
                    <table class="table table-customize">
                        <tbody>
                            <tr>
                                <td class="title"><img src="images/arrow1.png" alt=""> Loại hình cty:</td>
                                <td class="content">Nhà Sản Xuất</td>
                            </tr>
                            <tr>
                                <td class="title"><img src="images/arrow1.png" alt=""> SP/DV chính:</td>
                                <td>Thùng carton 3 lớp, Thùng carton 5 lớp, Thùng ...</td>
                            </tr>
                            <tr>
                                <td class="title"><img src="images/arrow1.png" alt=""> Năm thành lập</td>
                                <td>2008</td>
                            </tr>
                            <tr>
                                <td class="title"><img src="images/arrow1.png" alt=""> Số thành viên</td>
                                <td>Từ 51 - 100 người</td>
                            </tr>
                            <tr>
                                <td class="title"><img src="images/arrow1.png" alt=""> Doanh thu/ năm</td>
                                <td>Bí mật/ không public</td>
                            </tr>
                            <tr>
                                <td class="title"><img src="images/arrow1.png" alt=""> Thị trường chính</td>
                                <td>Toàn quốc</td>
                            </tr>
                        </tbody>
                    </table><!-- /table -->
                </div>
            </div><!-- /block-info-about -->
        </div>
        <h4 class="block-title-section">Chứng chỉ, giấy chứng nhận, giấy xác nhận, giải thưởng...</h4>
        <h4 class="block-title-section">Năng lực công ty</h4>
    </div><!-- /block-page -->
</div><!-- /block-main -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>