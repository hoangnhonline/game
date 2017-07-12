@section('slider')
<?php 

$bannerArr = DB::table('banner')->where(['object_id' => 1, 'object_type' => 3])->orderBy('display_order', 'asc')->get();

?>
@if($bannerArr)
<div class="block block_slide">
	<div class="owl-carousel dotsData" data-nav="true" data-margin="0" data-items='1' data-autoplayTimeout="700" data-autoplay="true" data-loop="true" data-dots="true">
		<?php $i = 0; ?>
		@foreach($bannerArr as $value)
		<?php $i++; ?>
		<div class="item-slide" data-dot="{{ $i }}">
			<img src="{{ Helper::showImage($value->image_url) }}" alt="banner">
			<!--<div class="figcaption">
				
			</div>-->
		</div><!-- item-slide -->
		@endforeach
	</div>
</div><!-- /block_slide -->
@endif
@endsection