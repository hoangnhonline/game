<!DOCTYPE html>
<!--[if lt IE 7 ]><html dir="ltr" lang="en-US" class="no-js ie ie6 lte7 lte8 lte9"><![endif]-->
<!--[if IE 7 ]><html dir="ltr" lang="en-US" class="no-js ie ie7 lte7 lte8 lte9"><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en-US" class="no-js ie ie8 lte8 lte9"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en-US" class="no-js ie ie9 lte9"><![endif]-->
<!--[if IE 10 ]><html dir="ltr" lang="en-US" class="no-js ie ie10 lte10"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="vi">
<!--<![endif]-->
<head>
	<title>@yield('title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="robots" content="index,follow"/>
    <meta http-equiv="content-language" content="vi"/>
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
    <meta property="og:site_name" content="Bao bì Hòa Hợp Phát" />
    <?php $socialImage = isset($socialImage) ? $socialImage : $settingArr['banner']; ?>
    <meta property="og:image" content="{{ Helper::showImage($socialImage) }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="@yield('site_description')" />
    <meta name="twitter:title" content="@yield('title')" />        
    <meta name="twitter:image" content="{{ Helper::showImage($socialImage) }}" />
	<link rel="icon" href="{{ URL::asset('public/assets/images/favicon.ico') }}" type="image/x-icon">
	<!-- <link rel="shortcut icon" href="" type="image/x-icon">
	<link rel="icon" href="" type="image/x-icon"> -->
	<!-- ===== Style CSS Common ===== -->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/css/style.css') }}">
	<!-- ===== Responsive CSS ===== -->
    <link href="{{ URL::asset('public/assets/css/responsive.css') }}" rel="stylesheet">
    
    <!-- HTML5 Shim and Respond.js') }} IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js') }} doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<link href='{{ URL::asset('public/assets/animations-ie-fix.css') }}' rel='stylesheet'>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}"></script>
		<script src="https://oss.maxcdn.com/libs/respond.{{ URL::asset('public/assets/js/1.4.2/respond.min.js') }}"></script>
	<![endif]-->
</head>
<body>
	
	<div class="wrapper container" id="wrapper">

		<header id="header" class="header">
			<section class="clearfix">
				<div class="col-sm-3 col-xs-12 logo text-center">
					<img src="{{ URL::asset('public/assets/images/logo.png') }}" alt="Logo Hoa Hop Phat">
				</div>
				<div class="col-sm-9 col-xs-12 info">
					<div class="newsection_text">
						<h1>CÔNG TY TNHH SẢN XUẤT - THƯƠNG MẠI HÒA HỢP PHÁT</h1>
						<p>Chuyên sản xuất giấy tấm, thủng carton, thùng hộp Offset, in ấn gia công các loại ...</p>
						<p><b>Khu KDC Thuận Giao, Kp. Bình Thuận 2, Thuận Giao, Thuận An, Bình Dương</b></p>
						<p><b>Tel: (0650) 3721230 - Fax: (0650) 3721231 - MST: 3702410080</b></p>
					</div>
				</div>
			</section>
		</header><!-- /header -->

		<nav id="mainNav" class="navbar navbar-default navbar-custom">
			<div class="container" id="main-menu">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>
					</button>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse menu" id="bs-example-navbar-collapse-1">
					<div class="text-center logo-menu-res">
						<a title="Logo" href="{{ route('home') }}"><img src="images/logo.jpg" alt="Logo"></a>
					</div>
					<ul class="nav navbar-nav navbar-left">
						<li class="level0">
							<a href="{{ route('home') }}" title="Trang Chủ">Trang Chủ</a>
						</li><!-- END MENU HOME -->
						<li class="level0">
							<a href="{{ route('danh-muc', 'gioi-thieu') }}" title="Giới Thiệu">Giới Thiệu</a>
						</li><!-- END MENU HOME -->
						<li class="level0 parent">
							<a href="{{ route('danh-muc', 'san-pham') }}" title="Sản Phẩm">Sản Phẩm</a>
							<ul class="level0 submenu submenu-white">
								@foreach($loaiSpList as $loaiSp)
								<li class="level1 @if($cateList[$loaiSp->id]->count() > 0) parent @endif">
									<a href="{{ route('danh-muc', $loaiSp->slug) }}" title="{!! $loaiSp->name !!}">{!! $loaiSp->name !!}</a>
									<ul class="level1 submenu submenu-white">
										@if($cateList[$loaiSp->id]->count() > 0)
										@foreach($cateList[$loaiSp->id] as $cate)
										<li><a href="{{ route('danh-muc-con', [$loaiSp->slug, $cate->slug])}}" title="{!! $cate->name !!}">{!! $cate->name !!}</a></li>
										@endforeach
										@endif
									</ul>
								</li>
								@endforeach
							</ul>
						</li><!-- END MENU HOME -->
						<li class="level0">
							<a href="{{ route('info') }}" title="Hồ Sơ Công Ty">Hồ Sơ Công Ty</a>
						</li><!-- END MENU HOME -->
						<li class="level0">
							<a href="{{ route('contact') }}" title="Liên Hệ">Liên Hệ</a>
						</li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div>
		</nav><!-- /mainNav -->

	 	@yield('slider')

        @yield('gioi_thieu')

		<section class="block-2-col clearfix">
			@if(\Request::route()->getName() != 'contact')
				@include('frontend.home.sidebar')				
			@endif
			@yield('content')
		</section><!-- /block-2-col -->

		<footer id="footer">
			<div class="footer-main">
				<address class="block-address">
					<p style="font-size: 16px; color: #006699; text-transform: uppercase;">CÔNG TY TNHH SẢN XUẤT - THƯƠNG MẠI HÒA HỢP PHÁT</p>
					<p><strong>Địa chỉ:</strong> Khu KDC Thuận Giao, Kp. Bình Thuận 2, Thuận Giao, Thuận An, Bình Dương</p>
					<p>
						<strong>Điên thoại:</strong> (0650) 3721230 - <strong>Fax:</strong>(0650) 3721231
					</p>
					<p>
						<strong>Email:</strong> <a href="mailto:baobigiay.hoahopphatbd@gmail.com?subject=feedback" class="link"> baobigiay.hoahopphatbd@gmail.com</a> - 
						<strong>Website:</strong><a href="http://baobigiayhoahopphat.vn/" title="" class="link" target="_blank"> http://baobigiayhoahopphat.vn/</a>
					</p>
				</address>
			</div>
		</footer>

	</div><!-- /main -->

	<a id="return-to-top" class="td-scroll-up" href="javascript:void(0)">
  		<i class="fa fa-angle-up" aria-hidden="true"></i>
	</a>
	<!-- Return To Top -->


	<!-- ===== JS ===== -->
	<script src="{{ URL::asset('public/assets/js/jquery.min.js') }}"></script>
	<!-- JS Bootstrap -->
	<script src="{{ URL::asset('public/assets/vendor/bootstrap/bootstrap.min.js') }}"></script>
	<!-- JS Semantic UI -->
	<script src="{{ URL::asset('public/assets/vendor/semantic-ui/semantic.min.js') }}"></script>
	<!-- JS Nivo Slider -->
	<script src="{{ URL::asset('public/assets/vendor/nivo-slider/jquery.nivo.slider.js') }}"></script>
	<script src="{{ URL::asset('public/assets/vendor/nivo-slider/jquery.nivo.slider.pack.js') }}"></script>
	<!-- ===== JS Bxslider ===== -->
	<script src="{{ URL::asset('public/assets/vendor/bxslider/jquery.bxslider.min.js') }}"></script>
	<!-- JS Sticky -->
	<script src="{{ URL::asset('public/assets/vendor/sticky/jquery.sticky.js') }}"></script>
	<!-- Js Common -->
	<script src="{{ URL::asset('public/assets/js/common.js') }}"></script>	
	<script type="text/javascript"> 
	$(window).on('load', function() {
	    $('#slider').nivoSlider({
	    	theme: 'dark',
	    	effect: 'random',                 // Specify sets like: 'fold,fade,sliceDown' 
		    slices: 15,                       // For slice animations 
		    boxCols: 8,                       // For box animations 
		    boxRows: 4,                       // For box animations 
		    animSpeed: 500,                   // Slide transition speed 
		    pauseTime: 3000,                  // How long each slide will show 
		    startSlide: 0,                    // Set starting Slide (0 index) 
		    directionNav: true,               // Next & Prev navigation 
		    controlNav: 'bullets',                 // 1,2,3... navigation 
		    controlNavThumbs: false,          // Use thumbnails for Control Nav 
		    pauseOnHover: true,               // Stop animation while hovering 
		    manualAdvance: true,             // Force manual transitions 
		    prevText: 'Prev',                 // Prev directionNav text 
		    nextText: 'Next',                 // Next directionNav text
	    }); 
	}); 
	$(".bxslider").bxSlider({
		auto: true,
		pause: 3000,
		autoHover: true,
        pagerCustom: '.bx-thumbnail',
        controls: false,
        // adaptiveHeight: true,
        nextText: '<i class="icofont icofont-rounded-right"></i>',
        prevText: '<i class="icofont icofont-rounded-left"></i>'
    });

    $(".bx-thumbnail").bxSlider({
        slideMargin: 7,
        maxSlides: 3,
        pager: false,
        controls: false,
        slideWidth: 71,
        infiniteLoop: false
    });
	</script>
	@yield('javascript_page')
</body>
</html>