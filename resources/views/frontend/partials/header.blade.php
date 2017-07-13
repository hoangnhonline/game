<header class="block header">
	<div class="container">
		<div class="block_logo">
			<a href="{{ route('home') }}" title="Home">
				<img alt="Download game" src="{{ URL::asset('assets/images/logo.png') }}">
			</a>
		</div><!-- /block-logo -->
		<div class="block_menu_top">
			<ul class="nav_menu">
				<li class="nav_menu_item nav_menu_user">
					<a title="hot game" href="javascript:void(0);" class="nav-user">Login</a>
					<ul class="nav_submenu nav_submenu_login">
						<li><a href="#" class="btn-login btn-fb">
							<span><img src="{{ URL::asset('assets/images/icon/facebook.png') }}" alt=""></span>
							<i>Facebook</i>
						</a></li>
						<li><a href="#" class="btn-login btn-gg">
							<span><img src="{{ URL::asset('assets/images/icon/gplus.png') }}" alt=""></span>
							<i>Google</i>
						</a></li>
					</ul>
				</li>						
				<li class="nav_menu_item">
					<a title="hot game" href="topics.html" class="nav-topics">TOPICS</a>
				</li>
				<li class="nav_menu_item">
					<a title="hot apps" href="{{ route('parent', 'apps') }}" class="nav-apps">APPS</a>
				</li>
				<li class="nav_menu_item">
					<a title="hot games" href="{{ route('parent', 'game') }}" class="nav-game">GAMES</a>
				</li>
			</ul>
		</div>
	</div>
</header><!-- /header -->