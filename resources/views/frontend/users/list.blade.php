@extends('frontend.layout')
  
  
@include('frontend.news.content')
@include('frontend.partials.meta')
  

@section('content')
<div class="block block_products block_commom">
  <div class="block_title">
    <a href="#">
    My upload</a>
  </div>
  <div class="block block-content clearfix" style="padding-top:20px">
    <div class="col-md-12">   
      @if(Session::has('message'))
      <p class="alert alert-info" >{{ Session::get('message') }}</p>
      @endif
   <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>             
              <th width="100px">Images</th>
              <th style="text-align:left">Information</th>                              
              <th width="1%;white-space:nowrap">Action</th>
            </tr>
            <tbody>
            @if( $items->count() > 0 )
              <?php $i = 0; ?>
              @foreach( $items as $item )
                <?php $i ++; 

                ?>
              <tr id="row-{{ $item->id }}">
                <td><span class="order">{{ $i }}</span></td>               
                <td>
                  <img class="img-thumbnail" width="80" src="{{ $item->image_url ? Helper::showImage($item->image_url) : URL::asset('public/admin/dist/img/no-image.jpg') }}" alt="{!! $item->name !!}" title="{!! $item->name !!}" />
                </td>
                <td>                  
                  <strong>{!! $item->name !!} </strong> &nbsp; @if( $item->is_hot == 1 )
                  <img class="img-thumbnail" src="{{ URL::asset('public/admin/dist/img/star.png')}}" alt="Hot" title="Hot" />
                  @endif<br />
                  <strong style="color:#337ab7;font-style:italic"> {{ $item->ten_loai }} / {{ $item->ten_cate }}</strong>
                 <p style="margin-top:10px">
                    
                  </p>
                  
                </td>
                <td style="white-space:nowrap; text-align:right">
                  @if($item->status == 1)
                  <a class="btn btn-default btn-sm" href="{{ route('chi-tiet', [$item->slug_loai, $item->slug, $item->id] ) }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                  @endif
                  @if($item->status == 2)
                  <!--<a href="{{ route( 'product.edit', [ 'id' => $item->id ]) }}" class="btn btn-warning btn-sm">Edit</a>-->
                  <a onclick="return callDelete('{{ $item->name }}','{{ route( 'member.destroy', [ 'id' => $item->id ]) }}');" class="btn btn-danger btn-sm">Delete</a>
                  @endif

                </td>
              </tr> 
              @endforeach
            @else
            <tr>
              <td colspan="4">No data found.</td>
            </tr>
            @endif

          </tbody>
          </table>

          <div style="text-align:center">
           {{ $items->links() }}
          </div>  
          </div>
  </div>  
</div>
@stop
@section('javascript_page')
<script type="text/javascript">
  function callDelete(name, url){  
  swal({
    title: 'Are you sure wan to delete "' + name +'"?',
    text: "Data can't recover.",
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
</script>
@endsection