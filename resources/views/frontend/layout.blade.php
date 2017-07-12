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
	<link rel="icon" href="{{ URL::asset('assets/images/favicon.ico') }}" type="image/x-icon">
	<!-- <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}" type="image/x-icon">
	<link rel="icon" href="{{ URL::asset('assets/images/favicon.ico') }}" type="image/x-icon"> -->
	<!-- ===== Style CSS ===== -->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/style.css') }}">
	<!-- ===== Responsive CSS ===== -->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/responsive.css') }}">

	<!-- ===== Responsive CSS ===== -->
  <!-- <link href="{{ URL::asset('assets/css/responsive.css') }}" rel="stylesheet"> -->

  <!-- HTML5 Shim and Respond.js') }} IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js') }} doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<link href='{{ URL::asset('assets/css/animations-ie-fix.css') }}' rel='stylesheet'>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}"></script>
		<script src="https://oss.maxcdn.com/libs/respond.{{ URL::asset('assets/js/1.4.2/respond.min.js') }}"></script>
	<![endif]-->
</head>
<body>

	<div class="wrapper">
		
		@include('frontend.partials.header')

		<main id="main" class="container">
			<div class="row">
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
								<a title="Hot Apps" href="app.html">Hot »</a>
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
									<li><a href="#"><i class="adventure"></i>Adventure</a></li>
								</ul>
							</div>
						</div>
					</div><!-- block_sidebar -->
				</div><!-- /block_right -->
			</div>
		</main><!-- /#main -->

		<footer class="footer">
			<div class="footer_main">
				<div class="container">
					<div class="row">
						<div class="col-sm-3 list_menu_footer">
							<div class="menu_footer_items">
								<p class="list_menu_footer_title">SOLUTIONS</p>
								<ul>
									<li><a href="#" title="">Mobile Version</a></li>
									<li><a href="#" title="">APKPure For Android</a></li>
									<li><a href="#" title="">APK Install</a></li>
									<li><a href="#" title="">APK Downloader (Region free)</a></li>
									<li><a href="#" title="">APK Signature Verification</a></li>									
								</ul>
							</div>
							
						</div><!-- /list_menu_footer -->
						<div class="col-sm-3 list_menu_footer">
							<div class="menu_footer_items">
								<p class="list_menu_footer_title">FOLLOW US</p>
								<ul class="follow">
									<li>
										<a href="" title="">
											<i class="fa fa-facebook"></i> Facebook
										</a>
									</li>
									<li>
										<a href="" title="">
											<i class="fa fa-twitter"></i> Twitter
										</a>
									</li>
									<li>
										<a href="" title="">
											<i class="fa fa-google-plus"></i> Google+
										</a>
									</li>
									<li>
										<a href="" title="">
											<i class="fa fa-instagram"></i> Instagram
										</a>
									</li>
								</ul>
							</div>
						</div><!-- /list_menu_footer -->
						<div class="col-sm-3 list_menu_footer">
							<div class="menu_footer_items">
								<p class="list_menu_footer_title">TOP ANDROID APPS</p>
								<ul>
									<li><a href="#" title="">APKPure APK</a></li>
									<li><a href="#" title="">WhatsApp Messenger APK</a></li>
									<li><a href="#" title="">Messenger APK</a></li>
									<li><a href="#" title="">Facebook APK</a></li>
									<li><a href="#" title="">Instagram APK</a></li>																					
								</ul>
							</div>
						</div><!-- /list_menu_footer -->
						<div class="col-sm-3 list_menu_footer">
							<div class="menu_footer_items">
								<p class="list_menu_footer_title">TOP ANDROID GAMES</p>
								<ul>
									<li><a href="#" title="">Pokémon GO APK</a></li>
									<li><a href="#" title="">Dream League Soccer 2017 APK</a></li>
									<li><a href="#" title="">Clash Royale APK</a></li>
									<li><a href="#" title="">Clash of Clans APK</a></li>
									<li><a href="#" title="">Subway Surfers APK</a></li>								
								</ul>
							</div>
						</div><!-- /list_menu_footer -->
					</div>
				</div>
			</div><!-- /footer_main -->
			<div class="footer_bot">
				<div class="container">
					<div class="row">
						<div class="copyright">
							Copyright © 2014-2017 APKPure. All rights reserved.
					        <a href="/dmca.html" rel="nofollow">DMCA Disclaimer</a>
					        <a href="/privacy-policy.html" rel="nofollow">Privacy Policy</a>
					        <a href="/terms.html" rel="nofollow">Term of Use</a>
					        <a target="_blank" href="https://translate.apkpure.com/projects/apkpure/apkpurecom/" rel="nofollow">Help translate APKPure</a>
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

	<!-- ===== JS ===== -->
	<script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
	<!-- ===== JS Bootstrap ===== -->
	<script src="{{ URL::asset('assets/lib/bootstrap/bootstrap.min.js') }}"></script>
	<!-- ===== JS Owl ===== -->
	<script src="{{ URL::asset('assets/lib/owl/owl.carousel.min.js') }}"></script>
	<!-- Js Common -->
	<script src="{{ URL::asset('assets/js/common.js') }}"></script>
</body>
</html>