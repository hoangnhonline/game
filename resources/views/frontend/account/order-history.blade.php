@extends('frontend.layout')  
@include('frontend.partials.meta')

@section('content')
<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="{{ route('home') }}" title="Trở về trang chủ">Trang chủ</a>
            <span class="navigation-pipe">&nbsp;</span>
            <a href="" title="Đơn hàng của tôi">Đơn hàng của tôi</a>
        </div>
        <!-- ./breadcrumb -->
        <div class="row">
            @include ('frontend.account.sidebar')
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                    <h1 class="page-heading">
                        <span class="page-heading-title2">Danh sách đơn hàng của tôi</span>
                    </h1>
                               
                    <div class="dashboard-order have-margin">
                        <table class="table-responsive table table-bordered">
                            <thead>
                            <tr>
                                <th>
                                    <span class="hidden-xs hidden-sm hidden-md">Mã ĐH</span>
                                    <span class="hidden-lg">Code</span>
                                </th>
                                <th>Ngày mua</th>
                                <th>Sản phẩm</th>
                                <th style="text-align:right">Tổng tiền</th>
                                <th style="text-align:center">
                                    <span class="hidden-xs hidden-sm hidden-md" >Trạng thái đơn hàng</span>
                                    <span class="hidden-lg">Trạng thái</span>
                                </th>
                                <!--                            <th></th>-->
                            </tr>
                            </thead>
                            <tbody>
                            @if($orders->count() > 0)
                            @foreach($orders as $order)
                                <tr>
                                    <td style="text-align:center;"><a style="color:#ec1c24" href="{{ route('order-detail', $order->id)}}">{{ str_pad($order->id, 6, "0", STR_PAD_LEFT)}}</a></td>
                                    <td>{{ date('d/m/Y', strtotime($order->created_at)) }}</td>
                                    <td>                                        
                                    @foreach($order->order_detail()->get() as $detail)
                                    
                                    <p>{{ Helper::getName($detail->sp_id, 'san_pham') }} [ <span style="color:#ec1c24">{{ $detail->so_luong }}</span> ]</p>
                                    @endforeach
                                    </td>
                                    <td style="text-align:right">{{ number_format($order->tong_tien) }}&nbsp;₫</td>                                    
                                    <td style="text-align:center">
                                        <span class="order-status">
                                            {{ $status[$order->status] }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <tr><td colspan="5"><p style="margin: 10px;font-style: italic;">Không có dữ liệu</p></td></tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div>
<style type="text/css">    
    .dashboard-order.have-margin {
        margin-bottom: 20px;
    }   
    table.table-responsive thead tr th {
        display: table-cell;
        padding: 8px;
        background: #f8f8f8;
        font-weight: 500;    
    }
    table.table-responsive tbody tr td{
        font-size: 14px !important;
    }
</style>
<div class="clearfix"></div>
@endsection


@section('javascript_page')
   <script type="text/javascript">
    $(document).ready(function() {

    });
  </script>
@endsection
