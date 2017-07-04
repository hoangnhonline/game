<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
  <title>Hòa Hợp Phát | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('admin/bootstrap/css/bootstrap.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('http://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css')); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('admin/dist/css/AdminLTE.css')); ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('admin/dist/css/skins/_all-skins.min.css')); ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('admin/plugins/iCheck/flat/blue.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('admin/dist/css/select2.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('admin/dist/css/sweetalert2.min.css')); ?>">  


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini" >
<div class="wrapper">
  <?php echo $__env->make('layout.backend.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  
  <?php echo $__env->make('layout.backend.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  

  <!-- Content Wrapper. Contains page content -->
  <?php echo $__env->yieldContent('content'); ?>  
  <div style="display: none" id="box_uploadimages">
    <div class="upload_wrapper block_auto">
        <div class="note" style="text-align:center;">Nhấn <strong>Ctrl</strong> để chọn nhiều hình.</div>
        <form id="upload_files_new" method="post" enctype="multipart/form-data" enctype="multipart/form-data" action="<?php echo e(route('ck-upload')); ?>">
            <fieldset style="width: 100%; margin-bottom: 10px; height: 47px; padding: 5px;">
                <legend><b>&nbsp;&nbsp;Chọn hình từ máy tính&nbsp;&nbsp;</b></legend>
                <input style="border-radius:2px;" type="file" id="myfile" name="myfile[]" multiple />
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <div class="clear"></div>
                <div class="progress_upload" style="text-align: center;border: 1px solid;border-radius: 3px;position: relative;display: none;">
                    <div class="bar_upload" style="background-color: grey;border-radius: 1px;height: 13px;width: 0%;"></div >
                    <div class="percent_upload" style="color: #FFFFFF;left: 140px;position: absolute;top: 1px;">0%</div >
                </div>
            </fieldset>
        </form>
    </div>
</div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.5
    </div>
    <strong>Copyright &copy; 2017-2020 <a href="mailto:hoangnhonline@gmail.com">hoangnhonline@gmail.com</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
<input type="hidden" id="route_update_order" value="<?php echo e(route('update-order')); ?>">
<input type="hidden" id="route_get_slug" value="<?php echo e(route('get-slug')); ?>">
  <div class="control-sidebar-bg"></div>
</div>
<input type="hidden" id="upload_url" value="<?php echo e(config('icho.upload_url')); ?>">
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo e(URL::asset('admin/plugins/jQuery/jquery-2.2.3.min.js')); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(URL::asset('https://code.jquery.com/ui/1.10.0/jquery-ui.js')); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo e(URL::asset('admin/bootstrap/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('admin/dist/js/ajax-upload.js')); ?>"></script>
<script src="<?php echo e(URL::asset('admin/dist/js/form.js')); ?>"></script>
<script src="<?php echo e(URL::asset('admin/dist/js/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('admin/dist/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('admin/dist/js/es6-promise.min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>

<!-- Slimscroll -->
<script src="<?php echo e(URL::asset('admin/plugins/slimScroll/jquery.slimscroll.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(URL::asset('admin/dist/js/app.min.js')); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo e(URL::asset('admin/dist/js/pages/dashboard.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(URL::asset('admin/dist/js/demo.js')); ?>"></script>
<script src="<?php echo e(URL::asset('admin/dist/js/lazy.js')); ?>"></script>
<script src="<?php echo e(URL::asset('admin/dist/js/ckeditor/ckeditor.js')); ?>"></script>

<script type="text/javascript" type="text/javascript">
$(document).ready(function(){
  $('img.lazy').lazyload();
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
});
</script>
<style type="text/css">
  .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover{
    z-index: 1 !important;
  }
  <?php if(\Request::route()->getName() == "compare.index"): ?>
.content-wrapper, .main-footer{
  margin-left: 0px !important;
}
<?php endif; ?>
</style>

<?php echo $__env->yieldContent('javascript_page'); ?>
</body>
</html>