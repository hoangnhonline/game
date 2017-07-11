@section('slider')
<?php 

$bannerArr = DB::table('banner')->where(['object_id' => 1, 'object_type' => 3])->orderBy('display_order', 'asc')->get();

?>
@if($bannerArr)
<div class="block block_slide">
	<div class="owl-carousel dotsData" data-nav="true" data-margin="0" data-items='1' data-autoplayTimeout="700" data-autoplay="false" data-loop="true" data-dots="true">
		<div class="item-slide" data-dot="1">
			<img src="{{ URL::asset('assets/images/slide/banner.jpg') }}" alt="banner">
			<div class="figcaption">
				プロジェクト東京ドールズ-アラームアプリ-
			</div>
		</div><!-- item-slide -->
		<div class="item-slide" data-dot="2">
			<img src="{{ URL::asset('assets/images/slide/banner1.jpg') }}" alt="banner">
			<div class="figcaption">
				DEAD TARGET: Zombie
			</div>
		</div><!-- item-slide -->
		<div class="item-slide" data-dot="3">
			<img src="{{ URL::asset('assets/images/slide/banner2.jpg') }}" alt="banner">
			<div class="figcaption">
				The Walking Dead No Man's Land
			</div>
		</div><!-- item-slide -->
		<div class="item-slide" data-dot="4">
			<img src="{{ URL::asset('assets/images/slide/banner3.jpg') }}" alt="banner">
			<div class="figcaption">
				Golden Arcana: Tactics (Unreleased)
			</div>
		</div><!-- item-slide -->
	</div>
</div><!-- /block_slide -->
@endif
@endsection