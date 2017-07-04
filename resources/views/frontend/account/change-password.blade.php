@extends('frontend.layout') 
@include('frontend.partials.meta')
@section('content')
<article class="block block-breadcrumb">
  <ul class="breadcrumb">
    <li><a href="{{ route('home') }}" title="Trở về trang chủ">Trang chủ</a></li>
    <li class="active">Đổi mật khẩu</li>
  </ul>
</article><!-- /block-breadcrumb -->
<section class="block-content">
        <div class="block-common">
          <p class="block-page-name">Đổi mật khẩu</p>
        <!-- ./breadcrumb -->
        <div class="row">
            @include ('frontend.account.sidebar')
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <h1 class="page-heading">
                    <span class="page-heading-title2">Đổi mật khẩu</span>
                </h1>
                <div class="shipping-address-page">              
                <div class="row row-style-2">
                  <div class="col-lg-12">
                    <div class="panel panel-default">                           
                      <div class="panel-body">
                        @if (session('error'))
                          <div class="alert alert-danger">
                              <ul>                                  
                                <li>{{ session('error') }}</li>                                  
                              </ul>
                          </div>
                      @endif 
                      @if (session('success'))
                          <div class="alert alert-success">
                              <ul>                                  
                                <li>{{ session('success') }}</li>                                  
                              </ul>
                          </div>
                      @endif   
                        <form class="form-horizontal bv-form" role="form" id="changePasswordForm" method="POST" action="{{ route('save-new-password') }}">
                          
                          {{ csrf_field() }}
                          <div class="form-group row">
                            <label for="old_pass" class="col-lg-3 control-label visible-lg-block">Mật khẩu cũ</label>
                            <div class="col-lg-9 input-wrap has-feedback">
                                <input type="password" name="old_pass" class="form-control address" id="old_pass" value="" placeholder="Nhập mật khẩu cũ" data-bv-field="old_pass" maxlength="30">
                                <small class="help-block" data-bv-validator="notEmpty" data-bv-for="old_pass" data-bv-result="NOT_VALIDATED" style="display: none;">Vui lòng nhập mật khẩu cũ.</small>
                           </div>
                          </div>
                          <div class="form-group row">
                            <label for="new_pass" class="col-lg-3 control-label visible-lg-block">Mật khẩu mới</label>
                            <div class="col-lg-9 input-wrap has-feedback">
                                <input type="password" name="new_pass" class="form-control address" id="new_pass" value="" placeholder="Nhập mật khẩu mới" data-bv-field="new_pass" maxlength="30">
                                <small class="help-block" data-bv-validator="notEmpty" data-bv-for="new_pass" data-bv-result="NOT_VALIDATED" style="display: none;">Vui lòng nhập mật khẩu mới từ 6 đến 30 ký tự.</small>
                           </div>
                          </div> 
                          <div class="form-group row">
                            <label for="re_new_pass" class="col-lg-3 control-label visible-lg-block">Nhập lại</label>
                            <div class="col-lg-9 input-wrap has-feedback">
                                <input type="password" name="re_new_pass" class="form-control address" id="re_new_pass" value="" placeholder="Nhập lại mật khẩu mới" data-bv-field="re_new_pass" maxlength="30">
                                <small class="help-block" data-bv-validator="notEmpty" data-bv-for="re_new_pass" data-bv-result="NOT_VALIDATED" style="display: none;">Nhập lại mật khẩu mới từ 6 đến 30 ký tự và trùng khớp với mật khẩu vừa nhập.</small>
                           </div>
                          </div>                        
                          <div class="form-group row end">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-9">
                              <div id="btnSavePassword" class="btn btn-primary btn-custom3" value="update" style="width:120px">Cập nhật</div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>                    
                  </div>
                </div>

           </div><!-- /.shipping-address-page -->
            </div>
        </div><!-- /.page-content -->
    
</section>
<div class="clearfix"></div>
@endsection

@section('javascript_page')
   <script type="text/javascript">
    var customer_district_id = '{{ $customer->district_id }}';
    var customer_ward_id = '{{ $customer->ward_id }}';
    $(document).ready(function() {
         
        $('#btnSavePassword').click(function() {
            $(this).attr('disabled', '');
            validateData();
          });
        
    });

      
    function validateData() {
        var error = [];

        var old_pass = $('#old_pass').val();
        var new_pass   = $('#new_pass').val();
        var re_new_pass   = $('#re_new_pass').val();
       

        if(!old_pass.length)
        {
          error.push('old_pass');
        }
        
        if(!new_pass.length || new_pass.length < 6 || new_pass.length > 30)
        {
          error.push('new_pass');
        }

        if(!re_new_pass.length || new_pass.length < 6 || new_pass.length > 30 || new_pass != re_new_pass)
        {
          error.push('re_new_pass');
        }

        var list = ['old_pass', 'new_pass', 're_new_pass'];

        for( i in list ) {
            $('#' + list[i]).next().hide();
            $('#' + list[i]).parent().removeClass('has-error');
        }

        if(error.length) {
          for( i in error ) {
            $('#' + error[i]).parent().addClass('has-error');
            $('#' + error[i]).next().show();
          }

          $('#btnSavePassword').removeAttr('disabled');
        } else {
          $('#changePasswordForm').submit();
        }
      }
  </script>
@endsection
