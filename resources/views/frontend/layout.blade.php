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
									<form action="#" method="POST" class="form_search">
										<input type="text" name="textsearch" class="search_input" placeholder="">
										<button type="submit" class="btn_search"><i class="fa fa-search"></i></button>
									</form>
								</div><!-- /block_search -->
								<div class="block_tags">
									<a href="#">lucky patcher</a>
				                    <a href="#">youtube</a>
				                    <a href="#">gta</a>				                   
								</div><!-- /block_tags -->
							</div>
						</div><!-- block_search-tags -->
					</div><!-- block_sidebar -->					
					<div class="block block_sidebar">
						<div class="block_hot_day blokck_pad_content">
							<div class="block_title">
								<a title="Hot Apps" href="app.html">Hot »</a>
							</div>
							<div class="block_content clearfix">
								<ul class="hot_day_list">
									<li>
										<div class="hot_day_img_number">
											<div class="hot_day_number">1</div>
											<div class="hot_day_img">
												<a title="Clash of Clans APK" href="#">
													<img alt="Clash of Clans APK" src="{{ URL::asset('assets/images/hot_day/Clash_of_Clans.png') }}">
												</a>
											</div>
										</div>
										<div class="description">
											<h3>
												<a title="Clash of Clans APK" href="#">Clash of Clans</a>
											</h3>
											<p>9.105.9</p>
											<p>2017-06-28</p>
											<div class="down_btn">
												<p>Download Clash of Clans</p>
												<a href="#" class="btn btn_down" title="For iOS"><i class="fa fa-apple"></i></a>
												<a href="#" class="btn btn_down" title="For Android"><i class="fa fa-android"></i></a>
												<a href="#" class="btn btn_down" title="For Window"><i class="fa fa-windows"></i></a>
											</div>
										</div>
									</li><!-- li -->
									<li>
										<div class="hot_day_img_number">
											<div class="hot_day_number">2</div>
											<div class="hot_day_img">
												<a title="The Sims™ Mobile" href="#">
													<img alt="The Sims™ Mobile" src="{{ URL::asset('assets/images/hot_day/The_Sims_Mobile_APK.png') }}">
												</a>
											</div>
										</div>
										<div class="description">
											<h3>
												<a title="The Sims™ Mobile" href="#">The Sims™ Mobile</a>
											</h3>
											<p>9.105.9</p>
											<p>2017-06-28</p>
											<div class="down_btn">
												<p>Download The Sims™ Mobile</p>
												<a href="#" class="btn btn_down" title="For iOS"><i class="fa fa-apple"></i></a>
												<a href="#" class="btn btn_down" title="For Android"><i class="fa fa-android"></i></a>
												<a href="#" class="btn btn_down" title="For Window"><i class="fa fa-windows"></i></a>
											</div>
										</div>
									</li><!-- li -->
									<li>
										<div class="hot_day_img_number">
											<div class="hot_day_number">3</div>
											<div class="hot_day_img">
												<a title="Digital World" href="#">
													<img alt="Digital World" src="{{ URL::asset('assets/images/hot_day/Digital_World_APK.png') }}">
												</a>
											</div>
										</div>
										<div class="description">
											<h3>
												<a title="Digital World" href="#">Digital World</a>
											</h3>
											<p>9.105.9</p>
											<p>2017-06-28</p>
											<div class="down_btn">
												<p>Download Digital World</p>
												<a href="#" class="btn btn_down" title="For iOS"><i class="fa fa-apple"></i></a>
												<a href="#" class="btn btn_down" title="For Android"><i class="fa fa-android"></i></a>
												<a href="#" class="btn btn_down" title="For Window"><i class="fa fa-windows"></i></a>
											</div>
										</div>
									</li><!-- li -->
									<li>
										<div class="hot_day_img_number">
											<div class="hot_day_number">4</div>
											<div class="hot_day_img">
												<a title="GoalKeeper Challenge" href="#">
													<img alt="GoalKeeper Challenge" src="{{ URL::asset('assets/images/hot_day/GoalKeeper_Challenge_APK.png') }}">
												</a>
											</div>
										</div>
										<div class="description">
											<h3>
												<a title="GoalKeeper Challenge" href="#">GoalKeeper Challenge</a>
											</h3>
											<p>9.105.9</p>
											<p>2017-06-28</p>
											<div class="down_btn">
												<p>Download GoalKeeper Challenge</p>
												<a href="#" class="btn btn_down" title="For iOS"><i class="fa fa-apple"></i></a>
												<a href="#" class="btn btn_down" title="For Android"><i class="fa fa-android"></i></a>
												<a href="#" class="btn btn_down" title="For Window"><i class="fa fa-windows"></i></a>
											</div>
										</div>
									</li><!-- li -->
									<li>
										<div class="hot_day_img_number">
											<div class="hot_day_number">5</div>
											<div class="hot_day_img">
												<a title="Mobile Legends: Bang bang APK" href="#">
													<img alt="Mobile Legends: Bang bang APK" src="{{ URL::asset('assets/images/hot_day/Mobile_Legends_Bang_bang_APK.png') }}">
												</a>
											</div>
										</div>
										<div class="description">
											<h3>
												<a title="Mobile Legends: Bang bang APK" href="#">Mobile Legends: Bang bang APK</a>
											</h3>
											<p>9.105.9</p>
											<p>2017-06-28</p>
											<div class="down_btn">
												<p>Download Mobile Legends: Bang bang APK</p>
												<a href="#" class="btn btn_down" title="For iOS"><i class="fa fa-apple"></i></a>
												<a href="#" class="btn btn_down" title="For Android"><i class="fa fa-android"></i></a>
												<a href="#" class="btn btn_down" title="For Window"><i class="fa fa-windows"></i></a>
											</div>
										</div>
									</li><!-- li -->
								</ul>
								<div class="block_more"><a href="/game">More »</a></div>
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
									<li><a href="#" title="">APK to APPX</a></li>
								</ul>
							</div>
							<div class="menu_footer_items">
								<p class="list_menu_footer_title">SOLUTIONS</p>
								<ul>
									<li><a href="#" title="">Mobile Version</a></li>
									<li><a href="#" title="">APKPure For Android</a></li>
									<li><a href="#" title="">APK Install</a></li>
									<li><a href="#" title="">APK Downloader (Region free)</a></li>
									<li><a href="#" title="">APK Signature Verification</a></li>
									<li><a href="#" title="">APK to APPX</a></li>
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
									<li><a href="#" title="">YouTube APK</a></li>
									<li><a href="#" title="">Vidmate -HD Video Downloader &amp; Live TV APK</a></li>
									<li><a href="#" title="">Google Play Store APK</a></li>
									<li><a href="#" title="">imo free video calls and chat APK</a></li>
									<li><a href="#" title="">Snapchat APK</a></li>
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
									<li><a href="#" title="">Mobile Legends: Bang bang APK</a></li>
									<li><a href="#" title="">FIFA 16 Soccer APK</a></li>
									<li><a href="#" title="">Yu-Gi-Oh! Duel Links APK</a></li>
									<li><a href="#" title="">FIFA Mobile Soccer APK</a></li>
									<li><a href="#" title="">CSR Racing 2 APK</a></li>
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