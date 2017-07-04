<?php echo $__env->make('frontend.partials.meta', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>
<article class="block block-breadcrumb">
  <ul class="breadcrumb">
    <li><a href="<?php echo e(route('home')); ?>" title="Trở về trang chủ">Trang chủ</a></li>
    <li class="active">Liên hệ</li>
  </ul>
</article><!-- /block-breadcrumb -->
<section class="block-content">
        <div class="block-common">  
        <div id="contact" class="page-content page-contact">
            <div id="message-box-conact"></div>
            <div class="row">
                
                <div class="col-sm-8">	
                    <h3 class="page-heading">
                        <span class="page-heading-title2">THÔNG TIN Liên hệ</span>
                    </h3>               
                    <div class="content">
                        <h4>NhaDat - Chợ Công Nghệ Giá Sỉ</h4>                        
                        <p>Hotline: <span class="tel">1900 63 69 75</span></p>                        
                        <p>Email: <a href="mailto:muahang@icho.vn">muahang@icho.vn</a></p>
                    </div>
                    <?php if(Session::has('message')): ?>
	                <p class="alert alert-info" ><?php echo e(Session::get('message')); ?></p>
	                <?php endif; ?>
                    <form method="POST" action="<?php echo e(route('send-contact')); ?>">
                     <?php if(count($errors) > 0): ?>
	                  <div class="alert alert-danger">
	                    <ul>	                       
	                        <li>Vui lòng nhập đầy đủ thông tin.</li>	                        
	                    </ul>
	                  </div>
	                <?php endif; ?>	
                    <div class="contact-form-box">
                        <div class="form-selector">                            
                            <textarea style="font-size:14px" class="form-control input-sm" rows="8" id="content" name="content" placeholder="Nhập nội dung bạn muốn liên hệ hoặc góp ý với NhaDat"><?php echo e(old('content')); ?></textarea>

                        </div>
                        <input type="hidden" name="type" value="1">                        
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <div class="form-selector col-md-4" style="padding-left:0px;padding-top:7px;height:45px">
                            <input type="radio" name="gender" value="1" id="gender1" checked="checked"> <label for="gender1">Anh</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="gender" value="2" id="gender2"> <label for="gender2">Chị</label>
                        </div>
                        <div class="form-selector col-md-8" style="padding-right:0px;height:45px">                            
                            <input type="text" placeholder="Họ và tên" class="form-control input-sm" id="full_name" name="full_name"  value="<?php echo e(old('full_name')); ?>" style="height:35px" />
                        </div>
                        <div class="form-selector col-md-4" style="padding-left:0px;height:45px">                            
                            <input type="text" placeholder="Số điện thoại" class="form-control input-sm" id="phone" name="phone" value="<?php echo e(old('phone')); ?>" style="height:35px"/>
                        </div>   
                        <div class="form-selector col-md-8" style="padding-right:0px;height:45px">                           
                            <input type="email" placeholder="Email của bạn" class="form-control input-sm" id="email" name="email" value="<?php echo e(old('email')); ?>" style="height:35px"/>
                        </div>
                        <div class="form-selector">
                            <button type="submit" id="btn-send-contact" class="btn">GỬI LIÊN HỆ</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="col-xs-12 col-sm-4" id="contact_form_map">                    
                    <div class="row">
                        <div class="col-sm-12" style="margin-bottom:20px">
                            <div class="introduce-title">Thông tin Công ty</div>
                            <ul id="introduce-company"  class="introduce-list">
                                <li><a href="<?php echo e(route('danh-muc', 'gioi-thieu')); ?>">Giới thiệu</a></li>
                                <li><a href="<?php echo e(route('chuong-trinh-khuyen-mai')); ?>">Khuyến mãi</a></li>
                                <li><a href="<?php echo e(route('contact')); ?>">Liên hệ</a></li>
                            </ul>
                        </div>                       
                        <div class="col-sm-12">
                            <div class="introduce-title">CHÍNH SÁCH</div>
                            <ul id = "introduce-support"  class="introduce-list">
                                <li><a href="<?php echo e(route('danh-muc', 'bao-mat-thong-tin')); ?>">Bảo mật thông tin</a></li>
                                <li><a href="<?php echo e(route('danh-muc', 'thanh-toan')); ?>">Phương thức thanh toán</a></li>
                                <li><a href="<?php echo e(route('danh-muc', 'hinh-thuc-van-chuyen')); ?>">Hình thức vận chuyển</a></li>
                                <li><a href="<?php echo e(route('danh-muc', 'chinh-sach-bao-hanh')); ?>">Chính sách bảo hành</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</section>
<style type="text/css">
    span.required{
        color:red;
    }
    .contact-form-box input {
        font-size: 14px;
        border: 1px solid #ccc
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>