@extends('layout.backend')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Sản phẩm khuyến mãi
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'events.index' ) }}">Chương trình khuyến mãi</a></li>
    <li class="active">Sản phẩm</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      @if(Session::has('message'))
      <p class="alert alert-info" >{{ Session::get('message') }}</p>
      @endif      
       <button class="btn btn-warning btn-sm btnLienQuan" data-value="tuongtu" type="button" id="btnTuongTu">Thêm sản phẩm</button>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Danh sách</h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
          <form method="POST" action="{{ route("events.ajax-save-product") }}" id="form-product" >
          <div style="text-align:center;margin-bottom:10px">
          <button type="submit" class="btn btn-primary btn-sm">Save</button>
          </div>
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>                            
              <th width="140">Ảnh</th>
              <th>Tên</th>              
              <th style="text-align:right;width:100px">Số lượng</th>
              <th style="text-align:right;width:100px">Đã bán</th>
              <th width="1%;white-space:nowrap">Thao tác</th>
            </tr>
            <tbody>
            <?php $str_sp_id = ''; ?>
            @if( $dataList->count() > 0 )
              <?php $i = 0; ?>
              @foreach( $dataList as $item )
                <?php $i ++;
                $str_sp_id.= $item->sp_id.",";
                 ?>
              <tr id="row-{{ $item->id }}">                         
                <td><span class="order">{{ $i }}</span></td>               
                <td>
                  <img class="img-thumbnail" width="80" src="{{ $item->image_url ? Helper::showImage($item->image_url) : URL::asset('admin/dist/img/no-image.jpg') }}" alt="Nổi bật" title="Nổi bật" />
                </td>
                <td>                  
                  <a style="color:#333;font-weight:bold" target="_blank" href="{{ route( 'product.edit', [ 'id' => $item->sp_id ]) }}">{{ $item->name }}</a> &nbsp; @if( $item->is_hot == 1 )
                  <img class="img-thumbnail" src="{{ URL::asset('admin/dist/img/star.png')}}" alt="Nổi bật" title="Nổi bật" />
                  @endif<br />
                  <strong style="color:#337ab7;font-style:italic"> {{ $item->ten_loai }} / {{ $item->ten_cate }}</strong>
                 <p style="margin-top:10px">
                    @if( $item->is_sale == 1)
                   <b style="color:red">                  
                    {{ number_format($item->price_sale) }}
                   </b>
                   <span style="text-decoration: line-through">
                    {{ number_format($item->price) }}  
                    </span>
                    @else
                    <b style="color:red">                  
                    {{ number_format($item->price) }}
                   </b>
                    @endif 
                  </p>
                  
                </td>                
                <td>
                  <input class="form-control" type="text" name="so_luong[{{ $item->sp_id }}]" value="{{ $item->so_luong }}">
                </td>
                 <td style="text-align:right">
                  {{ number_format($item->da_ban) }}
                </td>
                <td>                                 
                  
                  <a onclick="return callDelete('{{ $item->name }}','{{ route( 'events.destroy-product', [ 'sp_id' => $item->sp_id, 'event_id' => $detail->id ]) }}');" class="btn-sm btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>

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
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="str_sp_id" id="str_sp_id" value="{{ $str_sp_id }}" >
          <input type="hidden" name="event_id" value="{{ $detail->id }}">
          <input type="hidden" name="is_add" id="is_add" value="0">
          <div style="text-align:center">
          <button type="submit" class="btn btn-primary btn-sm">Save</button>
          </div>
          </form>
        </div>        
      </div>
      <!-- /.box -->     
    </div>
    <!-- /.col -->  
  </div> 
</section>
<!-- /.content -->

</div>
@include ('backend.events.search-modal')
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
$(document).on('blur', '.checkSoLuong', function(){
  var value = $(this).val();
  
  if(value==''){
    $(this).focus();
  }
});
$(document).on('click', 'button.btnSaveSearch',function(){
  var type = $('#search_type').val();  
  
  str_value = $('#str_sp_id').val();
  
  if( str_value != '' ){
    $('#is_add').val(1);
    $('#form-product').submit();
    
  }else{
    alert('Vui lòng chọn ít nhất 1 sản phẩm.');
    return false;
  }

});
$(document).ready(function(){
  $(document).on('click', '.checkSelect', function(){  
      var obj = $(this);
      var str_sp_id = $('#str_sp_id').val();
      if(obj.prop('checked') == true){
        str_sp_id += obj.val() + ',';
      }else{
        var str = obj.val() + ',';
        str_sp_id = str_sp_id.replace(str, '');
      }
      $('#str_sp_id').val(str_sp_id);      
  });
  $('.btnLienQuan').click(function(){
    $('#label-search').html("sản phẩm khuyến mãi");
    filterAjax();
  }); 
  $(document).on('change', '#loai_id_search, #cate_id_search', function(){
    filterAjax();
  });
  $(document).on('click', '#btnSearchAjax', function(){
    filterAjax();
  });
  $(document).on('keypress', '#name_search', function(e){
    if(e.which == 13) {
        e.preventDefault();
        filterAjax();
    }
  });
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
function filterAjax(){  
  var str_params = $('#formSearchAjax').serialize();
  $.ajax({
          url: '{{ route("events.ajax-search") }}',
          type: "POST",
          async: true,      
          data: str_params,
          beforeSend:function(){
            $('#contentSearch').html('<div style="text-align:center"><img src="{{ URL::asset('admin/dist/img/loading.gif')}}"></div>');
          },        
          success: function (response) {
            $('#contentSearch').html(response);
            $('#myModalSearch').modal('show');
            //$('.selectpicker').selectpicker();            
            //check lai nhung checkbox da checked
            
            var str_checked = $('#str_sp_id').val();
            tmpArr = str_checked.split(",");              
            for (i = 0; i < tmpArr.length; i++) { 
                $('input.checkSelect[value="'+ tmpArr[i] +'"]').prop('checked', true);
            }
            
          }
    });
}
</script>
@stop