@extends('layout.backend')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Chi tiết đơn đặt hàng #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'orders.index' ) }}">Đơn đặt hàng</a></li>
    <li class="active">Chi tiết đơn hàng</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
 <a class="btn btn-default btn-sm" href="{{ route('orders.index') }}?status={{ $s['status'] }}&name={{ $s['name'] }}&date_from={{ $s['date_from'] }}&date_to={{ $s['date_to'] }}" style="margin-bottom:5px">Quay lại</a>
 @if($order->customer_id > 0)
  <button class="btn btn-danger btn-sm sendNoti" data-type="2" style="float:right" data-customer-id="{{ $order->customer_id }}" data-order-id="{{ $order->id }}" style="margin-bottom:5px">Gửi tin nhắn
     <?php 
      $countMess = App\Models\CustomerNotification::countMessOrderCustomer($order->customer_id, $order->id);

      ?>
      @if($countMess > 0)
      <span class="badge">{{ $countMess }}</span>
      @endif
  </button>
@endif
  <div class="row">
    <div class="col-md-12">
      @if(Session::has('message'))
      <p class="alert alert-info" >{{ Session::get('message') }}</p>
      @endif
      <div class="box">

        <div class="box-header with-border">
          <div class="col-md-4">
              <h4>Chi tiết chung</h4>
            <p>
              <span>Thời gian đặt hàng :</span><br> {{ date('d-m-Y H:i', strtotime($order->created_at )) }} <br>
              <div class="clearfix" style="margin-bottom:5px"></div>
              <span>Tình trạng đơn hàng : </span><br />
              <select class="select-change-status form-control" order-id="{{ $order->id }}" style="width:200px;" >
                  @foreach($list_status as $index => $status)
                  <option value="{{$index}}"
                    @if($index == $order->status)
                      selected
                    @endif
                    >{{$status}}</option>
                  @endforeach
                </select>                  
             <div class="clearfix" style="margin:5px"></div>
              <span>Khách hàng : <span><br>
              <span>{{ $order->full_name }}( # {{ $order->email }})</span>
              
            </p>
          </div>
          <div class="col-md-4">
            <h4>Thông tin thanh toán</h4>
            <p>
              <span>Địa chỉ :</span><br> {{ $order->address }}, {{ $order->ward_id ? Helper::getName($order->ward_id, 'ward') : "" }}, {{ $order->district_id ? Helper::getName($order->district_id, 'district') : "" }}, {{ $order->city_id ? Helper::getName($order->city_id, 'city') : "" }}<br>
              <div class="clearfix" style="margin-bottom:5px"></div>
              <span>Email : </span><br />
              <span>{{ $order->email }}</span>                  
             <div class="clearfix" style="margin:5px"></div>
              <span>Điện thoại : <span><br>
              <span>{{ $order->phone }}</span>
              
            </p>
          </div>
          <div class="col-md-4">
            <h4>Chi tiết giao nhận hàng</h4>
            <p>
              <span>Địa chỉ :</span><br> {{ $order->address }}, {{ $order->ward_id ? Helper::getName($order->ward_id, 'ward') : "" }}, {{ $order->district_id ? Helper::getName($order->district_id, 'district') : "" }}, {{ $order->city_id ? Helper::getName($order->city_id, 'city') : "" }}<br>         
              
            </p>
          </div>

        </div>

        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width:1%">No.</th>
              <th> Tên Sản phẩm </th>
              <th style="text-align:right"> Số Lượng </th>
              <th style="text-align:center">Giá bán </th>
              <th style="text-align:center">Tổng</th>              
            </tr>
            <tbody>
            <?php $i = 0; ?>
            @foreach($order_detail as $detail)
            <?php $i++; ?>
              <tr>
                  <td style="text-align:center">{{ $i }}</td>
                  <td class="product_name">{{$detail->product->name}}</td>
                  <td style="text-align:right">{{$detail->so_luong}}</td>
                  <td style="text-align:right">{{number_format($detail->don_gia)}} đ</td>
                  <td style="text-align:right">{{number_format($detail->tong_tien)}} đ</td>
                 
              </tr>
            @endforeach
              <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td style="text-align:right"><b>Phí vận chuyển</b></td>
                  <td style="text-align:right">{{number_format($order->phi_giao_hang)}} đ</td>
              </tr>
              <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td style="text-align:right"><b>Tổng chi phí</b></td>
                  <td style="text-align:right">
                    <strong>{{number_format($order->tong_tien)}}</strong> đ</td>
              </tr>
          </tbody>
          </table>
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
  $('.btn-delete-order-detail').click(function(){
    var order_detail_id = $(this).attr('order-detail-id');
    var order_id = $(this).attr('order-id');
    if(confirm('Bạn có muốn xoá sản phẩm ' + $(this).parents('tr').find('.product_name').text() +' này trong đơn hàng ?')) {
      delete_order_detail(order_id, order_detail_id);
    }
  });
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
  function delete_order_detail(order_id, order_detail_id) {
    $.ajax({
      url: '{{route('order.detail.delete')}}',
      type: "POST",
      data: {
        order_id        : order_id,
        order_detail_id : order_detail_id
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