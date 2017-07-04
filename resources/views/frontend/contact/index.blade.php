@extends('frontend.layout')

@include('frontend.partials.meta')
@section('content')
<div class="col-sm-12 block-main">
    <div class="block block-breadcrumb">
        <ul class="breadcrumb"> 
            <li><a href="{{ route('home') }}" title="Trở về trang chủ">Trang chủ</a></li>
            <li class="active">Liên hệ</li>
        </ul>
    </div><!-- /block-breadcrumb -->
    <div class="block-page block-page-title">
        <h3 class="block-title">Liên Hệ</h3>
        @if (count($errors) == 0)
        <div class="row contact-page">
            <div class="col-sm-4">
                <div class="item">
                    <div class="icon">
                        <img src="{{ URL::asset('public/assets/images/contact/icon_address.png') }}" alt="">
                    </div>
                    <span class="title">Địa Chỉ</span>
                    <p>Khu C-KCN Việt Hương, Kp. Bình Giao, P. Thuận Giao, TX. Thuân An, Bình Dương</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="item">
                    <div class="icon">
                        <img src="{{ URL::asset('public/assets/images/contact/icon_phone.png') }}" alt="">
                    </div>
                    <span class="title">Điện Thoại</span>
                    <p><span>Phone: 1800-900-300</span><span>Fax: 1800-900-200</span></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="item">
                    <div class="icon">
                        <img src="{{ URL::asset('public/assets/images/contact/icon_mail.png') }}" alt="">
                    </div>
                    <span class="title">Email</span>
                    <p><span>sale@yourdomain.com</span><span>support@yourdomain.com</span></p>
                </div>
            </div>
        </div><!-- /contact-page -->

        <object class="mymap-contact" data="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126263.60819855973!2d-84.44808690325613!3d33.735934882617194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzPCsDQ0JzQ1LjQiTiA4NMKwMjMnMzUuMyJX!5e0!3m2!1svi!2s!4v1475105845390"></object><!-- /mymap-contact -->
        @endif
        <div class="contact-form">
            @if(Session::has('message'))
            <p class="alert alert-info" >{{ Session::get('message') }}</p>
            @endif            
             @if (count($errors) > 0)
              <div class="alert alert-danger">
                <ul>                           
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach                            
                </ul>
              </div>
            @endif  
            <form method="POST" action="{{ route('send-contact') }}" class="form-horizontal block-contact-form-tab">
            {{ csrf_field() }}
                <div class="form-group group">
                    <input type="text" name="full_name" value="{!! old('full_name') !!}">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Họ tên *</label>
                </div><!-- /form-group -->
                <div class="form-group group">
                    <input type="text" name="phone" value="{!! old('phone') !!}">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Điện thoại *</label>
                </div><!-- /form-group -->
                <div class="form-group group">
                    <input type="text" name="email" value="{!! old('email') !!}">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Email *</label>
                </div><!-- /form-group -->
                <div class="form-group group">
                    <textarea rows="5" name="content" placeholder="" style="max-width: 100%;">{!! old('content') !!}</textarea>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Nội Dung</label>
                </div><!-- /form-group -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-envelope-o"></i> Gửi</button>
                </div><!-- /form-group -->
            </form>
        </div>
    </div><!-- /block-page -->
</div><!-- /block-main -->
@endsection
@section('javascript_page')
<script>
        $(window, document, undefined).ready(function() {
            $('input , textarea').blur(function() {
            var $this = $(this);
            if ($this.val())
                $this.addClass('used');
            else
                $this.removeClass('used');
            });
            var $ripples = $('.ripples');
            $ripples.on('click.Ripples', function(e) {
                var $this = $(this);
                var $offset = $this.parent().offset();
                var $circle = $this.find('.ripplesCircle');

                var x = e.pageX - $offset.left;
                var y = e.pageY - $offset.top;

                $circle.css({
                    top: y + 'px',
                    left: x + 'px'
                });
                $this.addClass('is-active');
            });
            $ripples.on('animationend webkitAnimationEnd mozAnimationEnd oanimationend MSAnimationEnd', function(e) {
                $(this).removeClass('is-active');
            });
        });
    </script>
@endsection