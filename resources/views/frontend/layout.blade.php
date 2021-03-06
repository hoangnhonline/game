<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="robots" content="index,follow"/>
    <meta http-equiv="content-language" content="en"/>
    <meta name="description" content="@yield('site_description')"/>
    <meta name="keywords" content="@yield('site_keywords')"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"/>
    <link rel="shortcut icon" href="@yield('favicon')" type="image/x-icon"/>
    <link rel="canonical" href="{{ url()->current() }}"/>        
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('site_description')" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="Bao bì DOWNLOAD GAME" />
    <?php $socialImage = isset($socialImage) ? $socialImage : $settingArr['banner']; ?>
    <meta property="og:image" content="{{ Helper::showImage($socialImage) }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="@yield('site_description')" />
    <meta name="twitter:title" content="@yield('title')" />        
    <meta name="twitter:image" content="{{ Helper::showImage($socialImage) }}" />
	<link rel="icon" href="{{ URL::asset('public/assets/images/favicon.ico') }}" type="image/x-icon">
	<!-- <link rel="shortcut icon" href="{{ URL::asset('public/assets/images/favicon.ico') }}" type="image/x-icon">
	<link rel="icon" href="{{ URL::asset('public/assets/images/favicon.ico') }}" type="image/x-icon"> -->
	<!-- ===== Style CSS ===== -->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/css/style.css') }}">
	<!-- ===== Responsive CSS ===== -->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/css/responsive.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('public/admin/dist/css/sweetalert2.min.css') }}">  

	<!-- ===== Responsive CSS ===== -->
  <!-- <link href="{{ URL::asset('public/assets/css/responsive.css') }}" rel="stylesheet"> -->

  <!-- HTML5 Shim and Respond.js') }} IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js') }} doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<link href='{{ URL::asset('public/assets/css/animations-ie-fix.css') }}' rel='stylesheet'>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}"></script>
		<script src="https://oss.maxcdn.com/libs/respond.{{ URL::asset('public/assets/js/1.4.2/respond.min.js') }}"></script>
	<![endif]-->
</head>
<body>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : $('#fb-app-id').val(),
      cookie     : true,
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();   
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
	<div class="wrapper">
		
		@include('frontend.partials.header')

		<main id="main" class="container">
			@if(\Request::route()->getName() == "news-list")
			<div class="title bread-crumbs" style="margin-bottom: 20px;"><a href="{{ route('home') }}">Home</a> » <span>{{ $cateDetail->name }}</span></div>
			<div class="block_1_col row">
				<div class="block-topics">
					<ul class="topics_list clearfix">
              			@foreach( $articlesArr as $articles )
						<li class="col-sm-4 col-xs-12">
							<div class="topics_item">
								<a href="{{ route('news-detail', ['slug' => $articles->slug, 'id' => $articles->id]) }}" title="{!! $articles->title !!}">
									<div class="topics_img">
										<img class="lazy" data-original="{{ Helper::showImage($articles->image_url) }}" alt="{!! $articles->title !!}">
									</div>
									<div class="description">
										<div class="topics_name">{!! $articles->title !!}</div>
										<div class="topics_description">{!! $articles->description !!}</div>
									</div>
								</a>
							</div>
						</li><!-- /li -->
						@endforeach			
					</ul>					
				</div>
			</div><!-- /block_left -->
			@else
			<div class="row">
				@if(!in_array(\Request::route()->getName(), ['parent', 'child']))
				<div class="block_left col-sm-9 col-xs-12">
					@yield('slider')
					@yield('content')
				</div><!-- /block_left -->

				<div class="block_right col-sm-3 col-xs-12">
					<div class="block block_sidebar">
						<div class="block_search-tags block_pad">
							<div class="block_content">
								<div class="block_search">
									<form method="GET" action="{{ route('search') }}" class="form_search">
										<input type="text" autocomplete="off" name="keyword" value="{{ isset($tu_khoa) ? $tu_khoa : "" }}" class="search_input" placeholder="">
										<button type="submit" class="btn_search"><i class="fa fa-search"></i></button>
									</form>
								</div><!-- /block_search -->
								<div class="block_tags">
									@foreach($customLink as $link)
									<a href="{{ $link->link_url }}" title="{{ $link->link_text }}">{{ $link->link_text }}</a>
									@endforeach
								</div><!-- /block_tags -->
							</div>
						</div><!-- block_search-tags -->
					</div><!-- block_sidebar -->					
					<div class="block block_sidebar">
						<div class="block_hot_day blokck_pad_content">
							<div class="block_title block_tab">
								<a title="Hot Apps" href="{{ route('parent', 'game') }}">Hot »</a>
							 	<ul class="nav nav-tabs" role="tablist">
								    <li role="presentation" class="active"><a href="#Game" aria-controls="Game" role="tab" data-toggle="tab">Game</a></li>
								    <li role="presentation"><a href="#Apps" aria-controls="Apps" role="tab" data-toggle="tab">Apps</a></li>
							  	</ul>
							</div>
							<div class="block_content clearfix">
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="Game">
										<ul class="hot_day_list">
											<?php $i = 0; ?>
											@foreach($gameHotList as $product)
											<?php $i ++; ?>
											<li>
												<div class="hot_day_img_number">
													<div class="hot_day_number">{{ $i }}</div>
													<div class="hot_day_img">
														<a title="{!! $product->name !!}" href="{{ route('chi-tiet', [$product->slug_loai, $product->slug, $product->id]) }}">
															<img alt="{!! $product->name !!}" src="{{ Helper::showImage($product->image_url) }}">
														</a>
													</div>
												</div>
												<div class="description">
													<h3>
														<a title="{!! $product->name !!}" href="{{ route('chi-tiet', [$product->slug_loai, $product->slug, $product->id]) }}">{!! $product->name !!}</a>
													</h3>
													<p>9.105.9</p>
													<p>2017-06-28</p>
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
											</li><!-- li -->			
											@endforeach											
										</ul>	
									</div><!-- Game -->
									<div role="tabpanel" class="tab-pane" id="Apps">
										<ul class="hot_day_list">
											<?php $i = 0; ?>
											@foreach($appHotList as $product)
											<?php $i ++; ?>
											<li>
												<div class="hot_day_img_number">
													<div class="hot_day_number">{{ $i }}</div>
													<div class="hot_day_img">
														<a title="{!! $product->name !!}" href="{{ route('chi-tiet', [$product->slug_loai, $product->slug, $product->id]) }}">
															<img alt="{!! $product->name !!}" src="{{ Helper::showImage($product->image_url) }}">
														</a>
													</div>
												</div>
												<div class="description">
													<h3>
														<a title="{!! $product->name !!}" href="{{ route('chi-tiet', [$product->slug_loai, $product->slug, $product->id]) }}">{!! $product->name !!}</a>
													</h3>
													<p>9.105.9</p>
													<p>2017-06-28</p>
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
											</li><!-- li -->			
											@endforeach	
											
										</ul>
									</div><!-- Apps -->
								</div>								
							</div>
						</div>
					</div><!-- block_sidebar -->
					<div class="block block_sidebar">
						<div class="block_popular_categories blokck_pad_content">
							<div class="block_title">
								<div class="title">Popular categories</div>
							</div>
							<div class="block_content clearfix">
								<ul class="popular_categories_list location">
									@foreach($cateHot as $cate)
									<li><a href="{{ route('child', [$cate->slug_loai, $cate->slug]) }}"><i class=""></i>{!! $cate->name !!}</a></li>
									@endforeach
								</ul>
							</div>
						</div>
					</div><!-- block_sidebar -->
					<?php 
					$ads = DB::table('ads')->where('id', 2)->first();
					?>
					@if($ads)
					<div class="block block_sidebar">					
					
						@if($ads->type == 1)
							<a href="{{ $ads->ads_url }}" target="_blank">
							<img src="{{ Helper::showImage($ads->image_url) }}" alt="{{ $ads->name }}" style="width:100%" />
							</a>
						@else
							{!! $ads-> ads_code !!}
						@endif
											
					</div>
					@endif	
				</div><!-- /block_right -->
				@else
				<div class="block_right col-sm-3 col-xs-12">
					<div class="block block_sidebar block_page_child">
						<div class="block_popular_categories blokck_pad_content">
							<div class="block_title">
								<div class="title">Category</div>
							</div>
							@foreach($loaiSpList as $loai)
							<div class="block_content clearfix">
								<p class="title_head">
									<a title="hot {!! $loai->name !!} " href="{{ route('parent', $loai->slug)}}">
										<img src="{{ URL::asset('public/assets/images/icon/gameicon.png') }}"> {!! $loai->name !!}
									</a>
								</p>
								@if(!empty($cateList[$loai->id]))
								<ul class="popular_categories_list location">
									@foreach($cateList[$loai->id] as $cate)
									<li><a href="{{ route('child', [$loai->slug, $cate->slug]) }}">{!! $cate->name !!}</a></li>@endforeach					            	
								</ul>
								@endif
							</div>
							@endforeach							
						</div>
					</div><!-- block_sidebar -->
				</div><!-- /block_right -->

				<div class="block_left col-sm-9 col-xs-12">
					@yield('content')
				</div><!-- /block_left -->
				@endif
			</div>
			@endif
		</main><!-- /#main -->

		<footer class="footer">
			<div class="footer_main">
				<div class="container">
					<div class="row">
						<div class="col-sm-3 list_menu_footer">
							<div class="menu_footer_items">
								<p class="list_menu_footer_title">HELPFUL LINKS</p>
								<ul>
									@foreach($footerLink as $link)
									<li><a href="{{ $link->link_url }}" title="{{ $link->link_text }}">{{ $link->link_text }}</a></li>
									@endforeach																
								</ul>
							</div>
							
						</div><!-- /list_menu_footer -->
						<div class="col-sm-3 list_menu_footer">
							<div class="menu_footer_items">
								<p class="list_menu_footer_title">FOLLOW US</p>
								<ul class="follow">
									<li>
										<a href="{{ $settingArr['facebook_fanpage'] }}" title="Facebook" target="_blank">
											<i class="fa fa-facebook"></i> Facebook
										</a>
									</li>
									<li>
										<a href="{{ $settingArr['twitter_fanpage'] }}" title="Twitter" target="_blank">
											<i class="fa fa-twitter"></i> Twitter
										</a>
									</li>
									<li>
										<a href="{{ $settingArr['google_fanpage'] }}" title="Google+" target="_blank">
											<i class="fa fa-google-plus"></i> Google+
										</a>
									</li>
									<li>
										<a href="{{ $settingArr['instagram_fanpage'] }}" title="Instagram" target="_blank">
											<i class="fa fa-instagram"></i> Instagram
										</a>
									</li>
								</ul>
							</div>
						</div><!-- /list_menu_footer -->
						<?php $i = 0; ?>
						@foreach($loaiSpList as $loai)
						<?php $i++; ?>
						@if($i <= 2)
						<div class="col-sm-3 list_menu_footer">
							<div class="menu_footer_items">
								<p class="list_menu_footer_title">TOP {!! $loai->name !!}</p>
								<ul>
									<?php $j = 0; ?>
									@foreach($cateList[$loai->id] as $cate)
									<?php $j++; ?>
									@if($j <= 5)
									<li><a href="{{ route('child', [$loai->slug, $cate->slug] ) }}" title="{!! $cate->name !!}">{!! $cate->name !!}</a></li>
									@endif
									@endforeach		
								</ul>
							</div>
						</div><!-- /list_menu_footer -->
						@endif
						@endforeach						
					</div>
				</div>
			</div><!-- /footer_main -->
			<div class="footer_bot">
				<div class="container">
					<div class="row">
						<div class="copyright">
							Copyright © 2017-2020 game.com. All rights reserved.
						</div>
					</div>
			    </div>
			</div><!-- /footer_main -->
		</footer><!-- /footer -->

		<a id="return-to-top" class="td-scroll-up" href="javascript:void(0)">
      		<i class="fa fa-angle-up" aria-hidden="true"></i>
    	</a>
    	<!-- Return To Top -->

	</div><!-- /wrapper -->
	<input type="hidden" id="route-ajax-login-fb" value="{{ route('ajax-login-by-fb') }}">
	<input type="hidden" id="fb-app-id" value="{{ env('FACEBOOK_APP_ID') }}">
	<!-- ===== JS ===== -->
	<script src="{{ URL::asset('public/assets/js/jquery.min.js') }}"></script>
	<!-- ===== JS Bootstrap ===== -->
	<script src="{{ URL::asset('public/assets/lib/bootstrap/bootstrap.min.js') }}"></script>
	<!-- ===== JS Owl ===== -->
	<script src="{{ URL::asset('public/assets/lib/owl/owl.carousel.min.js') }}"></script>
	<!-- Js Common -->
	<script src="{{ URL::asset('public/assets/lib/sticky/jquery.sticky.js') }}"></script>
	<script src="{{ URL::asset('public/assets/js/common.js') }}"></script>
	<script src="{{ URL::asset('public/admin/dist/js/ckeditor/ckeditor.js') }}"></script>
	<script src="{{ URL::asset('public/admin/dist/js/sweetalert2.min.js') }}"></script>
	<script src="{{ URL::asset('public/admin/dist/js/lazy.js') }}"></script>
	@yield('javascript_page')
	<script type="text/javascript">
		$(document).ready(function(){
			$('img.lazy').lazyload();
			$.ajaxSetup({
			    headers: {
			       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
			$('.login-by-facebook-popup').click(function() {
			    FB.login(function(response){
			      if(response.status == "connected")
			      {
			         // call ajax to send data to server and do process login
			        var token = response.authResponse.accessToken;
			        $.ajax({
			          url: $('#route-ajax-login-fb').val(),
			          method: "POST",
			          data : {
			            token : token
			          },
			          success : function(data){
			            
			            location.reload();
			            
			          }
			        });

			      }
			    }, {scope: 'public_profile,email'});
			  });
		});

	</script>
</body>
</html>