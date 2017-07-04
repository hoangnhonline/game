@extends('frontend.layout') 

@section('header')
  
  
@endsection
@include('frontend.partials.meta')
@section('content')
<!-- page wapper-->
<div class="columns-container">
  <div class="container" id="columns"> 
    <!-- breadcrumb -->
    <div class="breadcrumb clearfix"> <a class="home" href="#" title="Return to Home">Home</a> <span class="navigation-pipe">&nbsp;</span> <a href="#" title="Giới thiệu">Tạo mật khẩu mới</a> </div>
    <!-- ./breadcrumb --> 
    
    <!-- row -->
    <div class="row">  
      
      <!-- Center colunm-->
      <div class="center_column col-xs-12" id="center_column">
        
        <div class="create-new-password">
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
          <form method="POST" class="form-new-password" id="changePasswordForm" action="{{ route('save-reset-password') }}">
            {{ csrf_field() }}
            <div class="header-box">
              <h3 class="title-form">Tạo mật khẩu mới</h3>
              <p> <span>Bạn chưa có tài khoản? </span> <a href="javascript:(void);" class="link" data-dismiss="modal" data-toggle="modal" data-target="#modalRegisterFrom">Đăng ký</a> </p>
            </div>
            
            <div class="form-group row">
              
              <div class="col-lg-12 input-wrap has-feedback">
                  <input type="password" name="new_pass" class="form-control address" id="new_pass" value="" placeholder="Nhập mật khẩu mới" data-bv-field="new_pass" maxlength="30">
                  <small class="help-block" data-bv-validator="notEmpty" data-bv-for="new_pass" data-bv-result="NOT_VALIDATED" style="display: none;">Vui lòng nhập mật khẩu mới từ 6 đến 30 ký tự.</small>
             </div>
            </div> 
            <div class="form-group row">
              
              <div class="col-lg-12 input-wrap has-feedback">
                  <input type="password" name="re_new_pass" class="form-control address" id="re_new_pass" value="" placeholder="Nhập lại mật khẩu mới" data-bv-field="re_new_pass" maxlength="30">
                  <small class="help-block" data-bv-validator="notEmpty" data-bv-for="re_new_pass" data-bv-result="NOT_VALIDATED" style="display: none;">Nhập lại mật khẩu mới từ 6 đến 30 ký tự và trùng khớp với mật khẩu vừa nhập.</small>
             </div>
             <input type="hidden" name="email" value="{{ $detailCustomer->email }}">
            </div> 
            <div class="form-group action-button">
              <button type="button" id="btnSavePassword" class="btn btn-danger btn-block">Đổi mật khẩu</button>
            </div>
        
          </form>
        </div><!-- end /.create-new-password -->
        
      </div>
      <!-- ./ Center colunm --> 
    
  </div>
  <!-- ./row--> 
</div>
</div>
<!-- ./page wapper--> 
@endsection



@section('javascript_page')
<script type="text/javascript">
  $(document).ready(function() {
         @if (session('success'))
         setTimeout(function(){
          location.href='{{ route('home')}}';
         }, 3000);
         @endif
        $('#btnSavePassword').click(function() {
            $(this).attr('disabled', '');
            validateData();
          });
        
    });
  function validateData() {
        var error = [];
        
        var new_pass   = $('#new_pass').val();
        var re_new_pass   = $('#re_new_pass').val();
       

               
        if(!new_pass.length || new_pass.length < 6 || new_pass.length > 30)
        {
          error.push('new_pass');
        }

        if(!re_new_pass.length || new_pass.length < 6 || new_pass.length > 30 || new_pass != re_new_pass)
        {
          error.push('re_new_pass');
        }

        var list = ['new_pass', 're_new_pass'];

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
