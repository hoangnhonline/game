<?php 
$bannerArr = DB::table('banner')->where(['object_id' => 2, 'object_type' => 3])->orderBy('display_order', 'asc')->get();
?>
@if($bannerArr)
<div id="advLeft" style="display:none">
  <div class="banner_scroll" id="banner_left">
    <div class="item">        
      @foreach($bannerArr as $banner)       
      @if($banner->ads_url !='')
      <a id="ban_116" href="{{ $banner->ads_url }}" target="_blank" style="width: 100px; display: block;">
      @endif        
                  <img src="{{ Helper::showImage($banner->image_url) }}">
              @if($banner->ads_url !='')
      </a>
      @endif
      @endforeach
    </div>
  </div>
</div><!-- /AdvLeft -->
@endif
<?php 
$bannerArr = DB::table('banner')->where(['object_id' => 3, 'object_type' => 3])->orderBy('display_order', 'asc')->get();
?>
@if($bannerArr)
<div id="advRight" style="display:none">
  <div class="banner_scroll" id="banner_right">
    <div class="item">
      @foreach($bannerArr as $banner)       
      @if($banner->ads_url !='')
      <a id="ban_117" href="{{ $banner->ads_url }}" target="_blank" style="width: 100px; display: block;">
      @endif        
                  <img src="{{ Helper::showImage($banner->image_url) }}">
              @if($banner->ads_url !='')
      </a>
      @endif
      @endforeach
    </div>
  </div>
</div><!-- /Advight -->
@endif