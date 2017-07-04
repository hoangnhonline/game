@extends('frontend.layout')
@include('frontend.partials.meta')

@section('content')
<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="{{ route('home') }}" title="Trở về trang chủ">Trang chủ</a>
            <span class="navigation-pipe">&nbsp;</span>
            <a href="" title="Đơn hàng của tôi">Thông báo của tôi</a>
        </div>
        <!-- ./breadcrumb -->
        <div class="row">
            @include ('frontend.account.sidebar')
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                    <h1 class="page-heading">
                        <span class="page-heading-title2">Thông báo của tôi</span>
                    </h1>
                               
                    <div class="dashboard-order have-margin" style="margin-top:15px">
                        <div>

                          <!-- Nav tabs -->
                          <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Khuyến mãi hấp dẫn</a></li>
                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Thông tin đơn hàng</a></li>                           
                          </ul>

                          <!-- Tab panes -->
                          <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home">
                                
                                <div class="account-notify">
                                @if(!empty($notiOrder))
                                   @foreach($notiSale as $noti)
                                   <div class="item ">
                                      <div class="account-notify-date">
                                         <strong>{{ date('d/m/Y', strtotime($noti['created_at'])) }}</strong>
                                      </div>
                                      <div class="account-notify-content">
                                         <p><?php echo $noti['content']; ?>
                                            <a target="_blank" href="{{ $noti['event_url'] }}" style="color:#EC1C24;margin-left:10px">Chi tiết</a>                   
                                         </p>
                                      </div>
                                   </div>
                                   @endforeach
                                   @else
                                   <p style="margin: 20px;font-style: italic;">Không có dữ liệu</p>
                                   @endif
                                   <div class="list-pager">
                                   </div>
                                </div>                               

                            </div>
                            <div role="tabpanel" class="tab-pane" id="profile">
                            <div class="account-notify">
                                @if(!empty($notiOrder))
                                 @foreach($notiOrder as $noti)
                                   <div class="item ">
                                      <div class="account-notify-date">
                                         <strong>{{ date('d/m/Y', strtotime($noti['created_at'])) }}</strong>
                                      </div>
                                      <div class="account-notify-content">
                                         <p><?php echo $noti['content']; ?></p>
                                      </div>
                                   </div>
                                   @endforeach
                                  @else
                                   <p style="margin: 20px;font-style: italic;">Không có dữ liệu</p>
                                   @endif
                            </div>
                            </div>                            
                          </div>

                        </div>

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