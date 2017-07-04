<div class="col-sm-3 block-sidebar">
				<section class="block block-search">
					<div class="block-content">
						<form method="GET" class="form-inline" action="{{ route('search') }}">
							<div class="form-group input-serach-sidebar">
								<input name="keyword" type="text" placeholder="Tìm sản phẩm" style="font-style:italic" value="{{ isset($tu_khoa) ? $tu_khoa : '' }}">
							</div>
							<button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
						</form>
					</div>
				</section><!-- /block-search -->
				@foreach($loaiSpList as $loaiSp)
				<section class="block block-menu-sidebar">
					<h3 class="block-title"><a title="{!! $loaiSp->name !!}" href="{{ route('danh-muc', $loaiSp->slug) }}">{!! $loaiSp->name !!}</a></h3>
					@if($cateList[$loaiSp->id]->count() > 0)
					<ul class="block-content">
						@foreach($cateList[$loaiSp->id] as $cate)
						<li><a href="{{ route('danh-muc-con', [$loaiSp->slug, $cate->slug])}}" title="{!! $cate->name !!}">{!! $cate->name !!}</a></li>
						@endforeach
					</ul>
					@endif
				</section><!-- /block-menu-sidebar -->
				@endforeach
				<section class="block block-contact-sidebar block-title-sidebar">
					<h3 class="block-title">Thông Tin Liên Hệ</h3>
					<div class="block-content">
						<div class="contact-sidebar-item">
							<img src="{{ URL::asset('public/assets/images/contact2.jpg') }}" alt="">
							<div class="contact-sidebar-item-bottom">
								<p class="contact-name">Ông Trần Ngọc Tới</p>
								<p class="contact-position">Giám Đốc</p>
								<p class="contact-phone">094.4567.444</p>
								<!-- <div class="contact-add">
									<a href="skype:2?chat"><img src="images/skype-icon.png" alt=""></a>
									<a href="ymsgr:SendIM?baobitruongnx"><img src="images/Yahoo_3.png" alt=""></a>
								</div> -->
							</div>
						</div><!-- /contact-sidebar-item -->
						<div class="contact-sidebar-item">
							<img src="{{ URL::asset('public/assets/images/contact1.jpg') }}" alt="">
							<div class="contact-sidebar-item-bottom">
								<p class="contact-name" style="text-transform: none;">Ms.Nhị</p>
								<p class="contact-position">P. Kinh Doanh</p>
								<p class="contact-phone">(0650) 3721230</p>
								<p class="contact-email">Email: <a href="mailto:joe@example.com?subject=feedback" class="link">baobigiay.hoahopphatbd@gmail.com</a></p>
								<!-- <div class="contact-add">
									<a href="skype:2?chat"><img src="images/skype-icon.png" alt=""></a>
									<a href="ymsgr:SendIM?baobitruongnx"><img src="images/Yahoo_3.png" alt=""></a>
								</div> -->
							</div>
						</div><!-- /contact-sidebar-item -->
					</div>
				</section><!-- /block-contact-sidebar -->
			</div><!-- /block-sidebar -->