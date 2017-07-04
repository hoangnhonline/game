@extends('frontend.layout')  
@include('frontend.partials.meta')

@section('content')
<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="{{ route('home') }}" title="trở về trang chủ">Trang chủ</a>
            <span class="navigation-pipe">&nbsp;</span>
            <a href="{{ route('order-history') }}" title="Đơn hàng của tôi">Đơn hàng </a>
            <span class="navigation-pipe">&nbsp;</span>
            <a href="#" title="Chi tiết">Chi tiết </a>
        </div>
        <!-- ./breadcrumb -->
        
          <!-- row -->
          <div class="row">
          
              @include ('frontend.account.sidebar')              
              <!-- Center colunm-->
              <div class="center_column col-xs-12 col-sm-9" id="center_column">
                  <!-- page heading-->
                  <h2 class="page-heading">
                      <span class="page-heading-title2">Đơn hàng #{{ $str_order_id }} - {{ $status[$order->status] }}</span>
                  </h2>
                  <!-- Content page -->
                    
                    <div class="account-order-detail">
                    
                      <p class="date mt10 mb20">Ngày đặt hàng:  {{ $ngay_dat_hang }}</p>
                      
                      <div class="address-1">
                        <h4 class="mb20"> Địa chỉ người nhận </h4>
                        <p style="font-weight:bold">{{ $customer->full_name }}</p>
                        <p>{{ $customer->address }}, 
                        @if(isset($customer->xa->name))
                          {{$customer->xa->name}}
                        @endif, 
                        @if(isset($customer->huyen->name))
                          {{$customer->huyen->name}},
                        @endif
                        @if(isset($customer->tinh->name))
                          {{$customer->tinh->name}}
                        @endif</p>
                        <p>ĐT: {{ $customer->phone }}</p>
                      </div>
                      
                      <div class="row mb20 mt20">
                        <div class="col-sm-7">
                          <div class="payment-1">
                            <h4 class="mb20">Phương thức vận chuyển</h4>
                            <p>Vận chuyển Tiết Kiệm (dự kiến giao hàng vào {{ $order->ngay_giao_du_kien }})</p>
                            @if($order->phi_giao_hang > 0)
                            <p>Phí vận chuyển : {{ number_format($order->phi_giao_hang)}}&nbsp;đ</p>
                            @else
                            Miễn phí vận chuyển
                            @endif
                          </div>
  
                        </div>
                        <div class="col-sm-5">
                          <div class="payment-2 has-padding">
                            <h4 class="mb20">Phương thức thanh toán</h4>
                            @if($order->method_id == 1)
                            <p>Giao hàng và thu tiền tại nhà </p>                            
                            @else
                            <p>Chuyển khoản ngân hàng</p>                           
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <h4 class="mb10">Sản phẩm mua</h4>
                    
                    <div class="table-responsive">
                      <table class="table table-bordered dashboard-order">
                        <thead>
                          <tr class="default">
                            <th class="text-nowrap"> <span class="hidden-xs hidden-sm hidden-md">Tên sản phẩm</span> <span class="hidden-lg">Sản phẩm</span> </th>                           
                            <th class="text-nowrap">Giá</th>
                            <th class="text-nowrap">Số lượng</th>                          
                            <th class="text-nowrap">Tổng cộng</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($orderDetail as $rowOrder)                          
                          <tr>
                            <td><a href="{{ route('chi-tiet', $detailArr[$rowOrder->sp_id]->slug) }}" target="_blank" class="link">{{ $detailArr[$rowOrder->sp_id]->name }}</a> </td>
                           
                            <td><strong class="hidden-lg hidden-md">Giá: </strong>{{ number_format($rowOrder->don_gia) }}&nbsp;₫</td>
                            <td><strong class="hidden-lg hidden-md">Số lượng: </strong>{{ $rowOrder['so_luong'] }} </td>
                           
                            <td><strong class="hidden-lg hidden-md">Tổng cộng: </strong>{{ number_format($rowOrder->tong_tien) }}&nbsp;₫</td>
                          </tr>
                          @endforeach                         
                        </tbody>
                        <tfoot>
                                                
                          <tr>
                            <td colspan="3" class="text-right"><strong>Chi phí vận chuyển</strong></td>
                            <td><strong>{{ $order->phi_giao_hang > 0 ? number_format($order->phi_giao_hang)."&nbsp;₫" : "Miễn phí" }}</strong></td>
                          </tr>
                          @if($order->phi_cod > 0)
                          <tr>
                            <td colspan="3" class="text-right"><strong>Phí Thu Hộ</strong></td>
                            <td><strong>{{ $order->phi_cod > 0 ? number_format($order->phi_cod)."&nbsp;₫" : "Miễn phí" }}</strong></td>
                          </tr>
                          @endif
                          <tr>
                            <td colspan="3" class="text-right"><strong>Tổng cộng</strong></td>
                            <td><strong>{{ number_format($order->tong_tien)}}&nbsp;₫</strong></td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>                    
                    <a href="{{ route('order-history')}}" class="btn btn-info btn-back"><i class="fa fa-caret-left"></i> Quay về đơn hàng của tôi</a>
                    @if($order->status == 0)
                    <button id="btnHuy" class="btn btn-danger" style="float:right"><i class="fa fa-times"></i> Hủy đơn hàng</button>
                    @endif
                     </div>

              </div>
              <!-- ./ Center colunm -->
              
          </div>
          <!-- ./row-->   
    </div>
</div>
<div class="clearfix"></div>
@endsection

@section('javascript_page')
   <script type="text/javascript">
    $(document).ready(function() {
      $('#btnHuy').click(function(){ 
        var obj = $(this);       
        if(confirm('Quý khách chắc chắn muốn hủy đơn hàng này?')){
          $.ajax({
            url : '{{ route('order-cancel') }}',
            type  : 'POST',
            data : {
              id : {{ $order->id }}
            },
            success : function(){
              swal({ title: '', text: 'Đã hủy đơn hàng #{{ $str_order_id }}', type: 'success' });
              obj.remove();
            }
          });
        }
      });
    });
  </script>
@endsection
