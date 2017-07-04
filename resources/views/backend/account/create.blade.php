@extends('layout.backend')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Tạo tài khoản
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('account.index') }}">Tài khoản</a></li>
      <li class="active">Tạo mới</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('account.index') }}" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="{{ route('account.store') }}" id="formData">
    <div class="row">
      <!-- left column -->

      <div class="col-md-7">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Tạo mới</h3>
          </div>
          <!-- /.box-header -->               
            {!! csrf_field() !!}

            <div class="box-body">
              @if (count($errors) > 0)
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
                 
                 <!-- text input -->
                <div class="form-group">
                  <label>Họ tên <span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="full_name" id="full_name" value="{{ old('full_name') }}">
                </div>
                 <div class="form-group">
                  <label>Email <span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
                </div>                
                <div class="form-group">
                  <label>Role</label>
                  <select class="form-control" name="role" id="role">      
                    <option value="" >--Chọn role--</option>                       
                    <option value="1" {{ old('role') == 1 ? "selected" : "" }}>Editor</option>                  
                    @if(Auth::user()->role == 3)
                    <option value="2" {{ old('role') == 2 ? "selected" : "" }}>Mod</option> 
                    <option value="3" {{ old('role') == 3 ? "selected" : "" }}>Admin</option>                  
                    @endif
                  </select>
                </div> 
                @if(Auth::user()->role == 3)
                <div class="form-group" style="display:none" id="chon_mod">
                  <label>Mod</label>
                  <select class="form-control" name="leader_id" id="leader_id">
                    <option value="">--Chọn Mod--</option>
                    @if($modList)
                      @foreach($modList as $mod)
                    <option value="{{ $mod->id }}">{{ $mod->full_name }}</option> 
                      @endforeach
                    @endif                                
                  </select>
                </div> 
                @endif                           
                <div class="form-group">
                  <label>Trạng thái</label>
                  <select class="form-control" name="status" id="status">                                      
                    <option value="1" {{ old('status') == 1 || old('status') == NULL ? "selected" : "" }}>Mở</option>                  
                    <option value="2" {{ old('status') == 2 ? "selected" : "" }}>Khóa</option>                  
                  </select>
                </div>
            </div>
            <div class="box-footer">
              <button type="button" class="btn btn-default btn-sm" id="btnLoading" style="display:none"><i class="fa fa-spin fa-spinner"></i></button>
              <button type="submit" class="btn btn-primary btn-sm" id="btnSave">Lưu</button>
              <a class="btn btn-default btn-sm" class="btn btn-primary btn-sm" href="{{ route('account.index')}}">Hủy</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
      
      <!--/.col (left) -->      
    </div>
    </form>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
@stop
@section('javascript_page')
<script type="text/javascript">
    $(document).ready(function(){
      $('#formData').submit(function(){
        $('#btnSave').hide();
        $('#btnLoading').show();
      });
      @if(Auth::user()->role == 3)
      $('#role').change(function(){
        if($(this).val() == 1){
          $('#chon_mod').show();
        }else{
          $('#chon_mod').hide();
        }
      });
      @endif
    });
    
</script>
@stop
