@section('slider')
<?php 

$bannerArr = DB::table('banner')->where(['object_id' => 1, 'object_type' => 3])->orderBy('display_order', 'asc')->get();

?>
@if($bannerArr)
<section class="block slider-wrapper theme-default block-slide">
    <div id="slider" class="nivoSlider">
        <?php $i = 0; ?>
		@foreach($bannerArr as $banner)
		 <?php $i++; ?>
        <img src="{{ Helper::showImage($banner->image_url) }}" data-thumb="{{ Helper::showImage($banner->image_url) }}" alt="slide {{ $i }}" />
        @endforeach
    </div>
</section><!-- /block-slide -->
@endif
@endsection