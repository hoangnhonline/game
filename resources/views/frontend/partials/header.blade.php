<header class="block header">
	<div class="container">
		<div class="block_logo">
			<a href="{{ route('home') }}" title="Home">
				<img alt="Download game" src="{{ Helper::showImage($settingArr['logo']) }}">
			</a>
		</div><!-- /block-logo -->
		<div class="block_search_top">
			<div class="block_search">
				<form method="GET" action="{{ route('search') }}"  class="form_search">
					<input type="text" autocomplete="off" name="keyword" value="{{ isset($tu_khoa) ? $tu_khoa : "" }}" class="search_input" placeholder="" >
					<button type="submit" class="btn_search"><i class="fa fa-search"></i></button>
				</form>
			</div><!-- /block_search -->
		</div><!-- /block_search_top-logo -->
		<div class="block_menu_top">
			<div class="nav-toogle">
				<i class="fa"></i>
			</div>
			<ul class="nav_menu">
				<li class="nav_menu_item">
					<a title="hot games" href="{{ route('parent', 'game') }}" class="nav-game">GAMES</a>
				</li>
				<li class="nav_menu_item">
					<a title="hot apps" href="{{ route('parent', 'apps') }}" class="nav-apps">APPS</a>
				</li>
				<li class="nav_menu_item">
					<a title="hot news" href="{{ route('parent', 'news') }}" class="nav-topics">NEWS</a>
				</li>
				<li class="nav_menu_item nav_menu_user parent">
					@if(!Session::get('login'))
					<a title="Login" href="javascript:void(0);" class="nav-user">Login</a>

					<ul class="nav_submenu nav_submenu_login">
						<li><a href="javascript:;" class="btn-login btn-fb login-by-facebook-popup">
							<span><img src="{{ URL::asset('public/assets/images/icon/facebook.png') }}" alt="Login with Facebook"></span>
							<i>Facebook</i>
						</a></li>
						<li><a href="{{ route('glogin') }}" class="btn-login btn-gg">
							<span><img src="{{ URL::asset('public/assets/images/icon/gplus.png') }}" alt="Login with Google"></span>
							<i>Google</i>
						</a></li>
					</ul>
					@else					
					<a href="javascript:void(0);" class="nav-user user-login-susscess">Hi, <span>{!! Session::get('username') !!}</span></a>
					<ul class="nav_submenu nav_submenu_login">
						<li>
							<a href="{{ route('upload') }}" title="Upload game">
								<i class="fa fa-upload"></i> Upload game
							</a>
						</li>
						<li>
							<a href="{{ route('list') }}" title="Manage game">
								<i class="fa fa-cog"></i> Manage game
							</a>
						</li>
						<li> 
							<a href="{{route('user-logout')}}" title="Logout"> 
								<i class="fa fa-sign-out"></i> Logout 
							</a>
						</li>
					</ul>
					
					@endif
				</li>						
				
				
				
			</ul>
		</div>
	</div>
</header><!-- /header -->