@extends('frontend.layout')
@include('frontend.partials.meta')
@section('content')
<div class="col-sm-9 block-main">
	<div class="block block-breadcrumb">
	  <ul class="breadcrumb"> 
	    <li><a href="{{ route('home') }}" title="Trở về trang chủ">Trang chủ</a></li>
	    <li class="active">Tìm kiếm
	    </li>
	  </ul>
	</div><!-- /block-breadcrumb -->
<div class="block-product block-block-title block-page">
	<h2 class="block-title">
	Tìm kiếm theo từ khóa : <span style="color:blue">{!! $tu_khoa !!}</span>
	</h2>
	<div class="block-share absolute">
	
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