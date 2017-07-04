@extends('frontend.layout') 
  
@include('frontend.partials.meta')
@section('content')
<div class="col-sm-9 block-main">
  <div class="block block-breadcrumb">
      <ul class="breadcrumb"> 
        <li><a href="{{ route('home') }}" title="Trở về trang chủ">Trang chủ</a></li>
        <li class="active">{!! $detailPage->title !!}</li>
      </ul>
  </div><!-- /block-breadcrumb -->
  <div class="block-page block-page-title">
    <h3 class="block-title">{!! $detailPage->title !!}</h3>
    <div class="block-share absolute">
      <span>Chia sẻ lên:</span>
      <a href="#" title="" class="facebook"><i class="fa fa-facebook"></i></a>
      <a href="#" title="" class="google"><i class="fa fa-google-plus"></i></a>
      <a href="#" title="" class="twitter"><i class="fa fa-twitter"></i></a>
      <a href="#" title="" class="print"><i class="fa fa-print"></i></a>
      <a href="#" title="" class="envelope"><i class="fa fa-envelope-o"></i></a>
    </div>
    <div class="block-content">
      <div class="page-text-default">
        {!! $detailPage->content !!}
      </div>
    </div>
  </div><!-- /block-page -->
</div>
@endsection
