@extends('frontend.layout')
@include('frontend.partials.meta')
@section('content')
<div class="block block_products block_commom">
	<div class="block_title">
		<a href="#">
		@if(isset($is_child))
		{!! $rsCate->name !!}
		@else
		{!! $rs->name !!}
		@endif</a>
	</div>
	<div class="block block-content clearfix">
		<ul class="product_list clearfix">								
			@foreach( $productList as $product )
			<li class="col-sm-5ths col-xs-6">
				<div class="product_item">
					<div class="product_img">
						<a href="{{ route('chi-tiet', [$product->slug_loai, $product->slug, $product->id]) }}" title="{!! $product->name !!}">
							<img src="{{ Helper::showImageThumb($product->image_url) }}" alt="{!! $product->name !!}">
						</a>
					</div>
					<div class="description">
						<h3>
							<a title="{!! $product->name !!}" href="{{ route('chi-tiet', [$product->slug_loai, $product->slug, $product->id]) }}">{!! $product->name !!}</a>
						</h3>
						<div class="stars" style="margin: 0 auto;">
							<span title="{!! $product->name !!} average rating 4.6" style="width:91.99999809265137%"></span>
						</div>
						<div class="down_btn">
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
				</div>
			</li><!-- li -->
			@endforeach
			
		</ul>
	</div>
	<a class="loadmore" href="#">Show More</a>
</div>
@endsection