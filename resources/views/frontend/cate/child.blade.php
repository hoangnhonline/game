@extends('frontend.layout')
@include('frontend.partials.meta')
@section('content')
<div class="col-sm-9 block-main">
	<div class="block block-breadcrumb">
      <ul class="breadcrumb"> 
        <li><a href="{{ route('home') }}" title="Trở về trang chủ">Trang chủ</a></li>
        <li><a href="{{ route('danh-muc', $rs->slug) }}" title="{!! $rs->name !!}">{!! $rs->name !!}</a></li>
        <li class="active">        
		{!! $rsCate->name !!}
		</li>
      </ul>
  </div><!-- /block-breadcrumb -->
<div class="block-product block-block-title block-page">
	<h2 class="block-title">
	@if(isset($is_child))
	{!! $rsCate->name !!}
	@else
	{!! $rs->name !!}
	@endif
	</h2>
	<div class="block-share absolute">
		<span>Chia sẻ lên:</span>
		<a href="http://www.facebook.com/sharer.php?u={{ url()->current() }}" target="_blank" title="facebook" class="facebook"><i class="fa fa-facebook"></i></a>
		<a href="https://plus.google.com/share?url={{ url()->current() }}" target="_blank" title="google" class="google"><i class="fa fa-google-plus"></i></a>
		<a  href="https://twitter.com/share?url={{ url()->current() }}&amp;text={!! $rsCate->name !!}&amp;hashtags=baobihoahopphat" target="_blank" title="twitter" class="twitter"><i class="fa fa-twitter"></i></a>		
	</div>
	<div class="block-content">
		@if(!empty( (array) $productList ))
		<div class="row block-list-product">
			@foreach( $productList as $product )
			<div class="col-md-5ths col-xs-6">
				<div class="item">
					<div class="product-img">
						<a href="{{ route('chi-tiet', [$product->slug_loai, $product->slug, $product->id]) }}" title="{!! $product->name !!}">
							<img src="{{ Helper::showImageThumb($product->image_url) }}" alt="{!! $product->name !!}">
						</a>
					</div>
					<h2 class="product-name">{!! $product->name !!}</h2>
				</div>
			</div><!-- /col-md-5ths col-xs-6 -->
			@endforeach				
		</div>
		@endif
	</div><!-- /block-content -->
</div><!-- /block-product -->
</div><!-- /block-main -->
@endsection