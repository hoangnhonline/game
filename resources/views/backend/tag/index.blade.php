@extends('layout.backend')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Tags
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'tag.index' ) }}">Tags</a></li>
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
      <a href="{{ route('tag.create') }}" class="btn btn-info btn-sm" style="margin-bottom:5px">Tạo mới</a>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Bộ lọc</h3>
        </div>
        <div class="panel-body">
          <form class="form-inline" role="form" method="GET" action="{{ route('tag.index') }}">
            <div class="form-group">
              <label for="email">Loại :</label>
              <select class="form-control" name="type" id="type">                                
                <option value="1" {{ 1 == $type ? "selected" : "" }}>Sản phẩm</option>
                <option value="2" {{ 2 == $type ? "selected" : "" }}>Bài viết</option>
                <option value="3" {{ 3 ==  $type ? "selected" : "" }}>Tiện ích xung quanh</option>              
              </select>
            </div>
            <div class="form-group" id="div_tien_ich" @if( $type != 3 ) style="display:none" @endif>
                <label for="email">&nbsp;&nbsp;&nbsp;Quận</label>
                  <select class="form-control" name="district_id" id="district_id" data-live-search="true">
                    <option value="">--Tất cả--</option>
                      @foreach( $districtList as $value )
                      <option value="{{ $value->id }}"
                      {{ $district_id == $value->id ? "selected" : "" }}                           

                      >{{ $value->name }}</option>
                      @endforeach
                  </select>
              </div>
            <div class="form-group">
              <label for="email">&nbsp;&nbsp;&nbsp;Từ khóa :</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ $name }}">
            </div>       
            <button type="submit" class="btn btn-primary btn-sm">Lọc</button>
          </form>         
        </div>
      </div>
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Danh sách</h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
          <div style="text-align:right">
            {{ $items->appends( ['name' => $name, 'type' => $type] )->links() }}
          </div>
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>
              <th>Tag</th> 
              <th>Slug</th>
              <th>Mô tả</th>
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
                  <a href="{{ route( 'tag.edit', [ 'id' => $item->id ]) }}">{{ $item->name }}</a>
                  
                </td>                
                <td>{{ $item->slug }}</td>
                <td>{{ $item->description }}</td>
                <td style="white-space:nowrap">                  
                  @if( $item->objects->count() > 0 && $item->type != 3)
                  <a class="btn btn-default btn-sm" href="{{ route('tag', $item->slug) }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i> Xem</a>                
                  @endif
                  <a href="{{ route( 'tag.edit', [ 'id' => $item->id ]) }}" class="btn-sm btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>                  
                  @if( $item->objects->count() == 0)
                  <a onclick="return callDelete('{{ $item->name }}','{{ route( 'tag.destroy', [ 'id' => $item->id ]) }}');" class="btn-sm btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>                  
                  @endif
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
          <div style="text-align:right">          
            {{ $items->appends( ['name' => $name, 'type' => $type] )->links() }}
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
<input type="hidden" id="route_tag_index" value="{{ route('tag.index') }}">
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
  $('#type, #district_id').change(function(){
    $(this).parents('form').submit();
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
</script>
@stop