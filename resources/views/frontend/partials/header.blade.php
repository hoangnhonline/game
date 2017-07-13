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
					@if(!Session::get('login'))
					<a title="Login" href="javascript:void(0);" class="nav-user">Login</a>

					<ul class="nav_submenu nav_submenu_login">
						<li><a href="javascript:;" class="btn-login btn-fb login-by-facebook-popup">
							<span><img src="{{ URL::asset('assets/images/icon/facebook.png') }}" alt=""></span>
							<i>Facebook</i>
						</a></li>
						<li><a href="{{ route('glogin') }}" class="btn-login btn-gg">
							<span><img src="{{ URL::asset('assets/images/icon/gplus.png') }}" alt=""></span>
							<i>Google</i>
						</a></li>
					</ul>
					@else
					<a href="javascript:void(0);" class="nav-user">Hi, {!! Session::get('username') !!}</a>
					<ul class="nav_submenu nav_submenu_login">
					
						<li> <a href="{{route('user-logout')}}" title="Logout"> Logout </a></li>
					</ul>
					
					@endif
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