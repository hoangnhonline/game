@extends('frontend.layout')

@include('frontend.partials.meta')
@section('content')

<?php 
$bannerArr = DB::table('banner')->where(['object_id' => 2, 'object_type' => 3])->orderBy('display_order', 'asc')->get();
?>
<div class="col-sm-9 block-main">
    <div class="block block-breadcrumb">
        <ul class="breadcrumb"> 
            <li><a href="{{ route('home') }}" title="Trở về trang chủ">Trang chủ</a></li>
            <li class="active">Hồ sơ công ty</li>
        </ul>
    </div><!-- /block-breadcrumb -->
    <div class="block-page block-page-title">
        <h3 class="block-title">BAO BÌ GIẤY HÒA HỢP PHÁT</h3>
        <div class="block-content row">
            <div class="col-sm-4 col-xs-12 block-slide-about">
                <div class="block-content">
                    <div class="bxslider">
                        <?php $i = 0; ?>
                        @foreach($bannerArr as $banner)
                         <?php $i++; ?>
                        <div class="large-item">
                            
                                <img src="{{ Helper::showImage($banner->image_url) }}" alt="anh {{ $i }}" />
                           
                        </div>
                        @endforeach                        
                    </div>
                    <div id="bx-pager" class="bx-thumbnail">
                        <?php $i = 0; ?>
                        @foreach($bannerArr as $banner)
                         <?php $i++; ?>
                        <div class="item">
                            <div class="item-child">
                                <a data-slide-index="{{ $i }}" class="slide_title" href="javascript:void(0)" title="anh {{ $i }}"><img class="avatar" src="{{ Helper::showImage($banner->image_url) }}" alt="anh {{ $i }}" /></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div><!-- /block-slide-about -->
            <div class="col-sm-8 col-xs-12 block-info-about">
                <div class="block-content">
                    <table class="table table-customize">
                        <tbody>
                            <tr>
                                    <td class="title"><img src="{{ URL::asset('public/assets/images/arrow1.png') }}" alt=""> Loại hình cty:</td>
                                    <td class="content">{!! $settingArr['loai_hinh'] !!}</td>
                                </tr>
                                <tr>
                                    <td class="title"><img src="{{ URL::asset('public/assets/images/arrow1.png') }}" alt=""> SP/DV chính:</td>
                                    <td>{!! $settingArr['san_pham_dich_vu_chinh'] !!}</td>
                                </tr>
                                <tr>
                                    <td class="title"><img src="{{ URL::asset('public/assets/images/arrow1.png') }}" alt=""> Năm thành lập</td>
                                    <td>{!! $settingArr['nam_thanh_lap'] !!}</td>
                                </tr>
                                <tr>
                                    <td class="title"><img src="{{ URL::asset('public/assets/images/arrow1.png') }}" alt=""> Số thành viên</td>
                                    <td>{!! $settingArr['so_thanh_vien'] !!}</td>
                                </tr>
                                <tr>
                                    <td class="title"><img src="{{ URL::asset('public/assets/images/arrow1.png') }}" alt=""> Doanh thu/năm</td>
                                    <td>{!! $settingArr['doanh_thu'] !!}</td>
                                </tr>
                                <tr>
                                    <td class="title"><img src="{{ URL::asset('public/assets/images/arrow1.png') }}" alt=""> Thị trường chính</td>
                                    <td>{!! $settingArr['thi_truong_chinh'] !!}</td>
                                </tr>                               
                        </tbody>
                    </table><!-- /table -->
                </div>
            </div><!-- /block-info-about -->
        </div>
        <h4 class="block-title-section" style="margin-top:20px">Chứng chỉ, giấy chứng nhận, giấy xác nhận, giải thưởng...</h4>
        <p class="content-setting">{!! $settingArr['chung_chi'] !!}</p>
        <h4 class="block-title-section" style="margin-top:20px">Năng lực công ty</h4>
        <p class="content-setting">{!! $settingArr['nang_luc'] !!}</p>
    </div><!-- /block-page -->
</div><!-- /block-main -->
@endsection