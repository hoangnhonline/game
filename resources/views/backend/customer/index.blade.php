@extends('layout.backend')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Khách hàng
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'customer.index') }}">Khách hàng</a></li>
    <li class="active">Danh sách</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      @if(Session::has('message'))
      <p class="alert alert-info" >{{ Session::get('message') }}</p>
      @endif     
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Bộ lọc</h3>
        </div>
        <div class="panel-body">
          <form class="form-inline" role="form" method="GET" action="{{ route('customer.index') }}" id="frmContact">  <div class="form-group">
              <label for="name">Họ tên :</label>
              <input type="text" class="form-control" name="full_name" value="{{ $full_name }}">
            </div>                                                 
            <div class="form-group">
              <label for="name">Email :</label>
              <input type="text" class="form-control" name="email" value="{{ $email }}">
            </div>
            <div class="form-group">
              <label for="name">&nbsp;&nbsp;Điện thoại :</label>
              <input type="text" class="form-control" name="phone" value="{{ $phone }}">
            </div>
            <button type="submit" class="btn btn-default btn-sm">Lọc</button>
          </form>         
        </div>
      </div>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Danh sách ( <span class="value">{{ $items->total() }} khách hàng )</span></h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">        
          <a href="{{ route('customer.export') }}" class="btn btn-info btn-sm" style="margin-bottom:5px;float:left" target="_blank">Export</a>
          <div style="text-align:center">
            {{ $items->appends( ['status' => $status, 'email' => $email, 'phone' => $phone, 'full_name' => $full_name] )->links() }}
          </div>  
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>                            
              <th>Thông tin liên hệ</th>              
              <th width="10%">Thời gian tạo</th>
              <th width="1%;white-space:nowrap">Thao tác</th>
            </tr>
            <tbody>
            @if( $items->count() > 0 )
              <?php $i = 0; ?>
              @foreach( $items as $item )
                <?php $i ++; ?>
              <tr id="row-{{ $item->id }}">
                <td><span class="order">{{ $i }}</span></td>                       
                <td>                  
                  @if($item->name != '')
                  {{ $item->name }}</br>
                  @endif
                  @if($item->email != '')
                  <a href="{{ route( 'customer.edit', [ 'id' => $item->id ]) }}">{{ $item->email }}</a> -
                  @endif
                  @if($item->phone != '')
                  {{ $item->phone }}</br>
                  @endif
                </td>              
                <td>{{ date('d-m-Y H:i', strtotime($item->created_at)) }}</td>
                <td style="white-space:nowrap">                                  
                  
                  <a onclick="return callDelete('{{ $item->email }}','{{ route( 'customer.destroy', [ 'id' => $item->id ]) }}');" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>
                  
                </td>
              </tr> 
              @endforeach
            @else
            <tr>
              <td colspan="9">Không có dữ liệu.</td>
            </tr>
            @endif

          </tbody>
          </table>
          <div style="text-align:center">
            {{ $items->appends( ['status' => $status, 'email' => $email, 'phone' => $phone, 'full_name' => $full_name] )->links() }}
          </div>  
        </div>        
      </div>
      <!-- /.box -->     
    </div>
    <!-- /.col -->  
  </div> 
</section>
<!-- /.content -->
</div>
@stop
@section('javascript_page')
<script type="text/javascript">
function callDelete(name, url){  
  swal({
    title: 'Bạn muốn xóa "' + name +'"?',
    text: "Dữ liệu sẽ không thể phục hồi.",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes'
  }).then(function() {
    location.href= url;
  })
  return flag;
}
$(document).ready(function(){
  $('#type').change(function(){
    $('#frmContact').submit();
  });
});
</script>
@stop