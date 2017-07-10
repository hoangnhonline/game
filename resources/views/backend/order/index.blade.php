@extends('backend.layout')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Đơn hàng
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'orders.index' ) }}">Đơn hàng</a></li>
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
          <form class="form-inline" id="searchForm" role="form" method="GET" action="{{ route('orders.index') }}">            
            <div class="form-group">              
              <select class="form-control" name="status" id="status">
                <option value="-1"
                @if(-1 == $s['status'])
                  selected 
                  @endif   
                >--Tất cả trạng thái--</option>
                 @foreach($list_status as $index => $status)
                  <option value="{{$index}}" 
                  @if($index == $s['status'])
                  selected 
                  @endif                    
                    >{{$status}}</option>
                  @endforeach
              </select>
            </div>
             
            <div class="form-group">              
              <input type="text" class="form-control" name="name" placeholder="Email hoặc Tên khách hàng" value="{{ $s['name'] }}" style="width:250px">
            </div>  
            <div class="form-group">              
              <input type="text" class="form-control datepicker" placeholder="Từ ngày" name="date_from" value="{{ $s['date_from'] }}">
            </div> 
            <div class="form-group">              
              <input type="text" class="form-control datepicker" placeholder="Đến ngày" name="date_to" value="{{ $s['date_to'] }}">
            </div>                 
            <button type="submit" class="btn btn-primary btn-sm">Lọc</button>
          </form>         
        </div>
      </div>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Danh sách ( {{ $orders->total() }} đơn hàng )</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
          <div style="text-align:center">
           {{ $orders->appends( $s )->links() }}
          </div>  
          <table class="table table-bordered" id="table-list-data">           
             <tr>
              <th style="width: 1%">No.</th>
              <th style="width: 1%;white-space:nowrap;width:200px"> Đơn hàng</th>
              <th style="text-align:center;width:150px">Ngày đặt hàng</th>
              <th style="text-align:right;width:200px">Giao hàng đến</th>           
              <th style="text-align:right;width:100px">Tổng hoá đơn</th>
              <th width="120px" style="white-space:nowrap">Trạng thái</th>
              <th width="230px" style="white-space:nowrap"> </th>
            </tr>
            <tbody>

              @if($orders->count() > 0)
              <?php $i = 0; ?>
                @foreach($orders as $order)
                <?php $i++; ?>
                <tr>
                <td style="text-align:center">{{ $i }}</td>                
                <td>
                <a href="" style="font-size:14px; font-weight:bold">
                <?php 

                ?>
                #{{ str_pad($order->id, 6,'0', STR_PAD_LEFT) }}</a> 
                <span style="color:#555"> bởi {{$order->full_name}}</span>
                <br>
                <a href="mailto:">{{ $order->email }}</a>
                <br>
                {{ $order->phone }}
                </td>
                <td style="text-align:center;width:150px;white-space:nowrap">{{ date('d-m-Y H:i ', strtotime($order->created_at))}}</td>
                <td>

                <a href="http://maps.google.com/maps?&q={{ $order->address }}, {{ $order->ward_id ? Helper::getName($order->ward_id, 'ward') : "" }}, {{ $order->district_id ? Helper::getName($order->district_id, 'district') : "" }}, {{ $order->city_id ? Helper::getName($order->city_id, 'city') : "" }}" target="_blank"> 
                {{ $order->full_name }}, {{ $order->address }}, {{ $order->ward_id ? Helper::getName($order->ward_id, 'ward') : "" }}, {{ $order->district_id ? Helper::getName($order->district_id, 'district') : "" }}, {{ $order->city_id ? Helper::getName($order->city_id, 'city') : "" }}</a>
                </td>
                             
                <td style="text-align:right;width:100px">{{number_format($order->tong_tien)}}</td>
                <td>
                  <select class="select-change-status form-control" order-id="{{$order->id}}" customer-id="{{$order->customer_id}}" >
                    @foreach($list_status as $index => $status)
                    <option value="{{$index}}"
                      @if($index == $order->status)
                        selected
                      @endif
                      >{{$status}}</option>
                    @endforeach
                  </select>
                </td>
                <td style="text-align:right">
                  @if($order->customer_id > 0)
                  <button class="btn btn-danger btn-sm sendNoti" data-type="2" data-customer-id="{{ $order->customer_id }}" data-order-id="{{ $order->id }}" >Gửi tin nhắn 
                  <?php 
                  $countMess = App\Models\CustomerNotification::countMessOrderCustomer($order->customer_id, $order->id);

                  ?>
                  @if($countMess > 0)
                  <span class="badge">{{ $countMess }}</span>
                  @endif
                  </button>  
                   @endif  
                  <a href="{{route('order.detail', $order->id)}}?status={{ $s['status'] }}&name={{ $s['name'] }}&date_from={{ $s['date_from'] }}&date_to={{ $s['date_to'] }}" class="btn btn-info btn-sm">Chi tiết</a>
                                 
               
                </td>
                </tr>
                @endforeach
              @else
              <tr>
                <td colspan="5">Không có dữ liệu.</td>
              </tr>
              @endif
          </tbody>
          </table>
          <div style="text-align:center">
           {{ $orders->appends( $s )->links() }}
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

$(document).ready(function(){
  $('#status').change(function(){
    $('#searchForm').submit();

  });
  $('.datepicker').datepicker({ dateFormat: 'dd-mm-yy' });
  $('.select-change-status').change(function(){
    var status_id = $(this).val();
    var order_id  = $(this).attr('order-id');
    var customer_id = $(this).attr('customer-id');
    update_status_orders(status_id, order_id, customer_id);
  });

  function update_status_orders(status_id, order_id, customer_id) {
    $.ajax({
      url: '{{route('orders.update')}}',
      type: "POST",
      data: {
        status_id : status_id,
        order_id : order_id,
        customer_id : customer_id
      },
      success: function (response) {
        location.reload()
      },
      error: function(response){

      }
    });
  }

});

</script>
@stop