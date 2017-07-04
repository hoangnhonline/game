@include('frontend.partials.meta')
@section('content')
<div class="col-sm-9 block-main">
	<div class="block block-breadcrumb">
      <ul class="breadcrumb"> 
        <li><a href="{{ route('home') }}" title="Trở về trang chủ">Trang chủ</a></li>
        <li><a href="{{ route('danh-muc', $detail->slug_loai) }}" title="{!! $detail->ten_loai !!}">{!! $detail->ten_loai !!}</a></li>
        <li class="active">{!! $detail->name !!}</li>
      </ul>
  </div><!-- /block-breadcrumb -->
	<div class="block-product block-block-title block-page">
		<div class="block-content">
			<div class="product-view">
	            <div class="block-slide-proview">
	                <div class="row">
	                    <div class="product-img-box col-md-6 col-sm-6 col-xs-12">
	                        <div class="bxslider product-img-gallery">
	                        	<?php $i = 0; ?>
	                            @foreach( $hinhArr as $hinh )
	                            <?php $i++; ?>
	                            <div class="item">
	                                <img src="{{ Helper::showImage($hinh['image_url']) }}" alt="{!! $detail->name !!} {{ $i }}" />
	                            </div>								
	                            @endforeach	                            
	                        </div>
	                        <div class="product-img-thumb">
	                            <div id="gallery_01" class="pro-thumb-img">
	                                <?php $i = 0; ?>
		                            @foreach( $hinhArr as $hinh )
		                            <?php $i++; ?>
		                            <div class="item">
	                                    <a href="javascript:void(0)" data-slide-index="{{ $i-1 }}">
	                                        <img src="{{ Helper::showImage($hinh['image_url']) }}" alt="{!! $detail->name !!} {{ $i }}" />
	                                    </a>
	                                </div>		                            							
		                            @endforeach	                                
	                            </div>
	                        </div>
	                    </div>
	                    <div class="product-shop col-md-6 col-sm-6 col-xs-12">
	                        <div class="product-name">
	                            <h1 class="name-product-detail">{!! $detail->name !!}</h1>
	                        </div>
	                        @if($detail->description)
	                        <div class="product-description">
	                            <label class="title">Mô tả:</label>
	                            <div class="pro-desc-info">
	                                {!! $detail->description !!}
	                            </div>
	                        </div>
	                        @endif
	                        <div class="social-share">
	                            <label class="title">Share:</label>
	                            <ul class="list-socials">
	                                <li><a class="btn-share btn-fb" href="http://www.facebook.com/sharer.php?u={{ url()->current() }}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
	                                <li><a class="btn-share btn-tw" href="https://twitter.com/share?url={{ url()->current() }}&amp;text={!! $detail->name !!}&amp;hashtags=baobihoahopphat" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
	                                <li><a class="btn-share btn-gp" href="https://plus.google.com/share?url={{ url()->current() }}" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>	                                
	                            </ul>
	                        </div>
	                    </div>
	                </div>
	            </div><!-- /block-slide-proview -->
	            @if($detail->content)
	            <div class="product-detail">
	                <div class="tab product-tab">
	                    <ul class="nav nav-tabs" role="tablist">
						    <li role="presentation" class="active"><a href="#ctsp" aria-controls="ctsp" role="tab" data-toggle="tab">Chi tiết sản phẩm</a></li>						   
					  	</ul>
	                </div>
	                 <!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="ctsp">
							{!! $detail->content !!}
						</div>						
					</div>
	            </div><!-- /product-detail -->
	            @endif
	        </div>
	        @if($otherList)
	        <div class="block-product-relatives">
	        	<div class="block-title">
	        		Sản phẩm liên quan
	        	</div>
	        	<div class="block-content">
	        		<div class="row block-list-product">
	        			@foreach($otherList as $product)
						<div class="col-md-5ths col-xs-6">
							<div class="item">
								<div class="product-img">
									<a href="{{ route('chi-tiet', [$product->slug_loai, $product->slug, $product->id]) }}" title="{!! $product->name !!}">
										<img src="{{ Helper::showImage($product->image_url) }}" alt="{!! $product->name !!}">
									</a>
								</div>
								<h2 class="product-name">{!! $product->name !!}</h2>
							</div>
						</div><!-- /col-md-5ths col-xs-6 -->
						@endforeach
					</div>
	        	</div>
	        </div><!-- /block-content -->
	        @endif
		</div><!-- /block-content -->
	</div><!-- /block-product -->
	</div><!-- /block-main -->
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