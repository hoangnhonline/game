@extends('layout.backend')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Thống kê
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'report.index' ) }}">Thống kê</a></li>
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
      <a href="{{ route('articles.create') }}" class="btn btn-info btn-sm" style="margin-bottom:5px">Tạo mới</a>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Bộ lọc</h3>
        </div>
        <div class="panel-body">
          <form class="form-inline" id="form-report" role="form" method="GET" action="{{ route('report.index') }}">            
          <input type="hidden" name="report_type" id="report_type" value="{{ $report_type }}">
            <div class="form-group">              
              <select class="form-control" name="date_type" id="date_type">
                <option value="0">--Chọn thời gian--</option>
                <option value="7-ngay-qua" {{ $date_type == "7-ngay-qua" ? "selected"  : "" }}>7 ngày qua</option>
                <option value="thang-nay" {{ $date_type == "thang-nay" ? "selected"  : "" }}>Tháng này</option>
                <option value="thang-truoc" {{ $date_type == "thang-truoc" ? "selected"  : "" }}>Tháng trước</option>
                <option value="tuy-chon" {{ $date_type == "tuy-chon" ? "selected"  : "" }}>Tùy chọn</option>
              </select>
            </div>            
            <div class="form-group tuychon" {{ $date_type != "tuy-chon" ? "style=display:none" :  "" }}>              
              <input type="text" class="form-control datetime" name="date_from" value="{{ $date_from }}" placeholder="Từ ngày">
            </div>
            <div class="form-group tuychon" {{ $date_type != "tuy-chon" ? "style=display:none" : ""}}>               
              <input type="text" class="form-control datetime" name="date_to" value="{{ $date_to }}" placeholder="Đến ngày">
            </div>
            <button type="submit" class="btn btn-default btn-sm">Xem</button>
          </form>         
        </div>
      </div>
      <div class="box">        
        <!-- /.box-header -->
        <div class="box-body">
          <div style="text-align:center">
            
          </div>  
           <div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="tab-menu" role="tablist">
              <li role="presentation" {{ $report_type == "don-hang" ? "class=active" : "" }}><a data-value="don-hang" href="#home" aria-controls="home" role="tab" >Đơn hàng</a></li>
              <li role="presentation" {{ $report_type == "khach-hang" ? "class=active" : "" }}><a data-value="khach-hang" href="#profile" aria-controls="profile" role="tab" >Khách hàng</a></li>
              <li role="presentation" {{ $report_type == "doanh-thu" ? "class=active" : "" }}><a data-value="doanh-thu" href="#messages" aria-controls="messages" role="tab" >Doanh thu</a></li>
              <!--<li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Sản phẩm</a></li>-->
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane {{ $report_type == "don-hang" ? "active" : "" }}" id="home">
                  @if($report_type =="don-hang")
                  <div id="charts-data" style="height: 500px; margin: 0 auto"></div>
                  @endif
              </div>
              <div role="tabpanel" class="tab-pane {{ $report_type == "khach-hang" ? "active" : "" }}" id="profile">
                @if($report_type =="khach-hang")
                  <div id="charts-data" style="height: 500px; margin: 0 auto"></div>
                  @endif
              </div>
              <div role="tabpanel" class="tab-pane {{ $report_type == "doanh-thu" ? "active" : "" }}" id="messages">
                @if($report_type =="doanh-thu")
                  <div id="charts-data" style="height: 600px; margin: 0 auto"></div>
                  @endif
              </div>
              <div role="tabpanel" class="tab-pane" id="settings">...</div>
            </div>

          </div> 
          <div style="text-align:center">
            
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

<style type="text/css">
  .nav-tabs {
    border-bottom: 1px solid #3c8dbc !important;
}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{
  border: 1px solid #3c8dbc !important;
  border-bottom-color: transparent !important;
}

</style>
@stop
@section('javascript_page')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">
$(function () {
  $('#tab-menu a').click(function(){
    $('#report_type').val($(this).attr('data-value'));
    $('#form-report').submit();
  });
    @if($report_type =="don-hang")
    $('#charts-data').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: '<?php echo $title ?>'
        },
        subtitle: {
            text: '{{ $subtitle }}'
        },
        xAxis: {
            categories: [
                @foreach($dateArr as $date)
                '{{ date('d/m', strtotime($date)) }}',
                @endforeach
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Đơn hàng'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.0f} đơn hàng</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Chờ xử lý',
            data: [
            @foreach($dateArr as $date)
            {{ isset($data['cho_xu_ly'][$date]) ? $data['cho_xu_ly'][$date] : 0 }}, 
            @endforeach]

        }, {
            name: 'Đang giao hàng',
            data: [ @foreach($dateArr as $date)
            {{ isset($data['dang_xu_ly'][$date]) ? $data['dang_xu_ly'][$date] : 0 }}, 
            @endforeach]

        }, {
            name: 'Đã hoàn thành',
            data: [ @foreach($dateArr as $date)
            {{ isset($data['da_hoan_thanh'][$date]) ? $data['da_hoan_thanh'][$date] : 0 }}, 
            @endforeach]

        }]
    });
    @endif
    @if($report_type =="doanh-thu")
    $('#charts-data').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: '<?php echo $title ?>'
        },
        subtitle: {
            text: '{{ $subtitle }}'
        },
        xAxis: {
            categories: [
                @foreach($dateArr as $date)
                '{{ date('d/m', strtotime($date)) }}',
                @endforeach
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Đơn hàng'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.0f} vnđ</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Doanh thu',
            data: [
            @foreach($dateArr as $date)
            {{ isset($data['doanh_thu'][$date]) ? $data['doanh_thu'][$date] : 0 }}, 
            @endforeach]

        }, {
            name: 'Phí giao hàng',
            data: [ @foreach($dateArr as $date)
            {{ isset($data['phi_giao_hang'][$date]) ? $data['phi_giao_hang'][$date] : 0 }}, 
            @endforeach]

        }, {
            name: 'Phí dịch vụ',
            data: [ @foreach($dateArr as $date)
            {{ isset($data['tien_dich_vu'][$date]) ? $data['tien_dich_vu'][$date] : 0 }}, 
            @endforeach]

        }]
    });
    @endif
     @if($report_type =="khach-hang")
    $('#charts-data').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: '<?php echo $title ?>'
        },
        subtitle: {
            text: '{{ $subtitle }}'
        },
        xAxis: {
            categories: [
                @foreach($dateArr as $date)
                '{{ date('d/m', strtotime($date)) }}',
                @endforeach
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Đơn hàng'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.0f} đơn hàng</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Thành viên',
            data: [
            @foreach($dateArr as $date)
            {{ isset($data['thanh_vien'][$date]) ? $data['thanh_vien'][$date] : 0 }}, 
            @endforeach]

        }, {
            name: 'Vãng lai',
            data: [ @foreach($dateArr as $date)
            {{ isset($data['vang_lai'][$date]) ? $data['vang_lai'][$date] : 0 }}, 
            @endforeach]

        }]
    });
    @endif
});
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
  $('.datetime').datepicker({
    dateFormat : 'dd-mm-yy'
  });
  $('#date_type').change(function(){
    if($(this).val() == "tuy-chon"){
      $('.tuychon').show();
    }else{
      $('.tuychon').hide();
    }
  });
  $('#parent_id').change(function(){
    $.ajax({
        url: $('#route_get_cate_by_parent').val(),
        type: "POST",
        async: false,
        data: {          
            parent_id : $(this).val(),
            type : 'list'
        },
        success: function(data){
            $('#cate_id').html(data).select2('refresh');                      
        }
    });
  });
  $('.select2').select2();

  $('#table-list-data tbody').sortable({
        placeholder: 'placeholder',
        handle: ".move",
        start: function (event, ui) {
                ui.item.toggleClass("highlight");
        },
        stop: function (event, ui) {
                ui.item.toggleClass("highlight");
        },          
        axis: "y",
        update: function() {
            var rows = $('#table-list-data tbody tr');
            var strOrder = '';
            var strTemp = '';
            for (var i=0; i<rows.length; i++) {
                strTemp = rows[i].id;
                strOrder += strTemp.replace('row-','') + ";";
            }     
            updateOrder("loai_sp", strOrder);
        }
    });
});
function updateOrder(table, strOrder){
  $.ajax({
      url: $('#route_update_order').val(),
      type: "POST",
      async: false,
      data: {          
          str_order : strOrder,
          table : table
      },
      success: function(data){
          var countRow = $('#table-list-data tbody tr span.order').length;
          for(var i = 0 ; i < countRow ; i ++ ){
              $('span.order').eq(i).html(i+1);
          }                        
      }
  });
}
</script>
@stop