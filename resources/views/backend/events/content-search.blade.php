<section class="content">
  <div class="row">   
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Bộ lọc</h3>
        </div>
        <div class="panel-body">
          <form class="form-inline" id="formSearchAjax" role="form" method="GET" action="{{ route('events.ajax-search') }}">            
            <div class="form-group">
              <label for="email">Danh mục cha</label>
              <select class="form-control" name="loai_id" id="loai_id_search">
                <option value="">--Chọn--</option>
                @foreach( $loaiSpArr as $value )
                <option value="{{ $value->id }}" {{ $value->id == $arrSearch['loai_id'] ? "selected" : "" }}>{{ $value->name }}</option>
                @endforeach
              </select>
            </div>
              <div class="form-group">
              <label for="email">Danh mục con</label>

              <select class="form-control" name="cate_id" id="cate_id_search">
                <option value="">---Chọn--</option>
                @foreach( $cateArr as $value )
                <option value="{{ $value->id }}" {{ $value->id == $arrSearch['cate_id'] ? "selected" : "" }}>{{ $value->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="email">Tên</label>
              <input type="text" class="form-control" name="name" id="name_search" value="{{ $arrSearch['name'] }}">
            </div>            
            <button type="button" id="btnSearchAjax" style="margin-top:0px" class="btn btn-primary btn-sm">Lọc</button>
          </form>         
        </div>
      </div>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Danh sách ( {{ $items->total() }} sản phẩm )</h3>
          <button type="button" class="btn btn-primary btnSaveSearch" style='float:right'>Save</button>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">          
          <table class="table table-bordered" id="table-list-data">
            <tr>
            	<th style="width: 1%">#</th>              
              <th style="width: 1%">No.</th>              
              <th>Hình ảnh</th>
              <th style="text-align:center">Thông tin sản phẩm</th>                  
              
            </tr>
            <tbody>
            @if( $items->count() > 0 )
              <?php $i = 0; ?>
              @foreach( $items as $item )
                <?php $i ++; 

                ?>
              <tr id="row-{{ $item->id }}">
              <td>
                <input type="checkbox" class="checkSelect" value="{{ $item->id }}"/>
              </td>               
                <td><span class="order">{{ $i }}</span></td>               
                <td>
                  <img class="img-thumbnail" width="80" src="{{ $item->image_url ? Helper::showImage($item->image_url) : URL::asset('admin/dist/img/no-image.jpg') }}" alt="Nổi bật" title="Nổi bật" />
                </td>
                <td>                  
                  <a style="color:#333;font-weight:bold" href="{{ route( 'product.edit', [ 'id' => $item->id ]) }}">{{ $item->name }} {{ $item->name_extend }}</a> &nbsp; @if( $item->is_hot == 1 )
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
              </tr> 
              @endforeach
            @else
            <tr>
              <td colspan="9">{{ $arrSearch['loai_id'] == -1 ? "Vui lòng chọn danh mục để lọc" :  "Không có dữ liệu." }}</td>
            </tr>
            @endif

          </tbody>
          </table>
          <div style="text-align:center">
           {{ $items->appends( $arrSearch )->links() }}
          </div>  
        </div>        
      </div>
  
    <!-- /.col -->  
  </div> 
</section>