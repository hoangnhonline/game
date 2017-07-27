@include('frontend.partials.meta')
@section('content')
<?php $i = 0; ?>
@foreach($loaiSpList as $loaiSp)
<?php $i++; ?>
<div class="block block_products block_commom">
  <div class="block_title">
    <a href="#">{!! $loaiSp->name !!} »</a>
    <div class="block_more"><a href="{{ route('parent', $loaiSp->slug) }}">More »</a></div>
  </div>
  <div class="block-content">
    <ul class="product_items clearfix">
      @if($productArr[$loaiSp->id]->count() > 0)
      @foreach($productArr[$loaiSp->id] as $product)
      <li class="col-sm-4 col-xs-12 product_item">
        <div class="product_img">
          <a title="{!! $product->name !!}" href="{{ route('chi-tiet', [$product->slug_loai, $product->slug, $product->id]) }}">
            <img alt="{!! $product->name !!}" data-original="{{ Helper::showImage($product->image_url) }}" class="lazy">
          </a>
        </div>
        <div class="description">
          <h3>
            <a title="{!! $product->name !!}" href="{{ route('chi-tiet', [$product->slug_loai, $product->slug, $product->id]) }}">{!! $product->name !!}</a>
          </h3>
          <div class="stars">
            <span title="Average rating 4.9" style="width:82%;"></span>
          </div>
          <p>{!! $product->publish_date !!}</p>
          <div class="down_btn">
            <p>Download {!! $product->name !!}</p>
            @if($product->url_ios)
            <a href="{!! $product->url_ios !!}" target="_blank" class="btn btn_down" title="For iOS"><i class="fa fa-apple"></i></a>
            @endif
            @if($product->url_android)
            <a href="{!! $product->url_android !!}" target="_blank" class="btn btn_down" title="For Android"><i class="fa fa-android"></i></a>
            @endif
            @if($product->url_wp)
            <a href="{!! $product->url_wp !!}" target="_blank" class="btn btn_down" title="For Window"><i class="fa fa-windows"></i></a>
            @endif      
          </div>
        </div>
      </li><!-- /product_item -->
       @endforeach
        @endif
    </ul>
  </div>
</div><!-- /block_products -->

@if($i == 1)
<div class="block block_products block_commom">
<?php 
$ads = DB::table('ads')->where('id', 1)->first();
?>
@if($ads)
@if($ads->type == 1)
<a href="{{ $ads->ads_url }}" target="_blank">
<img src="{{ Helper::showImage($ads->image_url) }}" alt="{{ $ads->name }}" style="width:100%" />
</a>
@else
{{ $ads-> ads_code }}
@endif
@endif
</div>
@endif
 @endforeach
@endsection