@include('frontend.partials.meta')
@section('content')
<div class="block_product_detail">
	<div class="block block_commom block_shadow">
		<div class="block_title">
			<div class="block_breadcrumb">
				<ul class="breadcrumb">
					<li><a href="{{ route('home') }}" title="Back to home">Home</a></li>
					<li><a href="{{ route('parent', $detail->slug_loai) }}" title="{!! $detail->ten_loai !!}">{!! $detail->ten_loai !!}</a></li>
					<li class="active">{!! $detail->name !!}</li>
				</ul>
			</div>
		</div>		
		<div class="block_content">
			<div class="product_box">
				<div class="row">
					<div class="col-sm-3 pro_detail_img">
						<img src="{{ Helper::showImage($detail->image_url) }}" alt="{!! $detail->name !!}">
					</div>
					<div class="col-sm-9 pro_detail_info">
						<h1>{!! $detail->name !!}</h1>
						<div class="pro_detail_share">
							Share fb, g+, instagram
						</div>
						<div class="pro_detail_rating">
							<div class="stars"><span style="width:82%"></span></div>
							<div class="rating_info">votes, <span class="rating"><span class="best">{!! $detail->no_star !!}</span></span></div>
						</div>
						<div class="pro_detail_version">
							<div class="table-responsive">
								<table class="table table-no-border">
									<tr>
										@if($detail->author)
										<th>Author:</th>
										@endif
										@if($detail->lastest_version)
										<th>Latest Version:</th>
										@endif
										@if($detail->pushlish_date)
										<th>Publish Date:</th>
										@endif
									</tr>
									<tr>
										@if($detail->author)
										<td>{!! $detail->author !!}</td>
										@endif
										@if($detail->lastest_version)
										<td>{!! $detail->lastest_version !!}</td>
										@endif
										@if($detail->pushlish_date)
										<td>{!! $detail->pushlish_date !!}</td>
										@endif
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix">
					<div class="down_btn">
						@if($detail->url_ios)
						<a href="{!! $detail->url_ios !!}" target="_blank" class="btn btn_down" title="For iOS"><i class="fa fa-apple"></i> iOS</a>
						@endif
						@if($detail->url_android)
						<a href="{!! $detail->url_android !!}" target="_blank" class="btn btn_down" title="For Android"><i class="fa fa-android"></i> Android</a>
						@endif
						@if($detail->url_wp)
						<a href="{!! $detail->url_wp !!}" target="_blank" class="btn btn_down" title="For Window"><i class="fa fa-windows"></i> Window</a>
						@endif
					</div>
				</div>
				<!--<div class="block_safe-link">
					<a title="Using APKPure App to upgrade Digital World, fast, free and save your internet data." href="#">Using APKPure App to upgrade, fast, free and save your internet data.</a>
				</div>-->
			</div><!-- /product_box -->			
			<div class="product_box">
				<div class="pro_detail_description" style="height:auto !important;">
					{!! $detail->description !!}
				</div>				
			</div><!-- /product_box -->
			<div class="product_box">
				<div class="block_whatnew">
					{!! $detail->content !!}
				</div>
			</div><!-- /product_box -->
			<!--<div class="product_box">
				<div class="block_additional">
					<div class="row">
						<div class="col-sm-3">
							<p><strong>Category:</strong></p>
							<p><a title="Download more Role Playing games" href="#"><span>Free</span> <span>Role Playing GAME</span></a></p>
						</div>
						<div class="col-sm-3">
							<p><strong>Get it on:</strong></p>
							<p>
								<a class="ga" title="Get Digital World on Google Play" href="#" target="_blank">
									<img alt="Get Digital World on Google Play" src="images/gp_logo.png" height="16">
								</a>
							</p>
						</div>
						<div class="col-sm-3">
							<p><strong>Category:</strong></p>
							<p>Android 4.0+</p>
						</div>
						<div class="col-sm-3">
							<p><strong>Category:</strong></p>
							<p><a rel="nofollow" href="/report-content.html?pkg=air.com.helloair.HELLOFROG" target="_blank">Flag as inappropriate</a></p>
						</div>
					</div>
				</div>
			</div><!-- /product_box -->
		</div>
	</div><!-- /block -->	
	<div class="block block_commom block_shadow block_related">
		<div class="block_title">
			<p class="block_title_small">Similar Or Related</p>
		</div>
		@if($otherList)
		<div class="block-content">
			<div class="product_box">
				<ul class="product_items clearfix">
					@foreach($otherList as $product)
					<li class="col-sm-4 col-xs-6 product_item">
						<div class="product_img">
							<a title="{!! $product->name !!}" href="{{ route('chi-tiet', [$product->slug_loai, $product->slug, $product->id]) }}">
								<img alt="{!! $product->name !!}" src="{{ Helper::showImage($product->image_url) }}">
							</a>
						</div>
						<div class="description">
							<h3>
								<a title="{!! $product->name !!}" href="{{ route('chi-tiet', [$product->slug_loai, $product->slug, $product->id]) }}">{!! $product->name !!}</a>
							</h3>
							<div class="stars">
								<span title="Average rating 4.9" style="width:82%;"></span>
							</div>
							<p>{!! $product->pushlish_date !!}</p>
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
				</ul>
			</div>
		</div>
	</div><!-- /block -->
	@endif
	<div class="block block_commom block_shadow">
		<div class="block-content">
			<div class="product_box block-cm-fb">
				<div class="fb-comments" data-href="{{ url()->current() }}" data-width="100%" data-numposts="10"></div>
			</div>
		</div>
	</div><!-- /block -->
</div>
@endsection
@section('javascript_page')
<script src="{{ URL::asset('public/assets/vendor/jquery.zoom/jquery.zoom.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {            

    $('.bxslider .item').each(function () {
        $(this).zoom();
    });

    $(".bxslider").bxSlider({
        pagerCustom: '.pro-thumb-img',
        nextText: '<i class="fa fa-chevron-right"></i>',
        prevText: '<i class="fa fa-chevron-left"></i>'
    });

    $(".pro-thumb-img").bxSlider({
        slideMargin: 10,
        maxSlides: 5,
        pager: false,
        controls: false,
        slideWidth: 50,
        infiniteLoop: false
    });

});
</script>>
@endsection