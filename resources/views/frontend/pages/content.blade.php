@include('frontend.partials.meta')
@section('content')
<article class="block block-breadcrumb">
  <ul class="breadcrumb">
    <li><a href="{{ route('home') }}" title="Trở về trang chủ">Trang chủ</a></li>
    <li class="active"><a href="{{ route('danh-muc', $detailPage->slug) }}" title="{{ $detailPage->title }}">{{ $detailPage->title }}</a></li>
  </ul>
</article><!-- /block-breadcrumb -->
<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->    
        
      <!-- row -->
       <div class="row">
      
          <!-- Left colunm -->
          <div class="col-sm-3" id="left_column">
              <!-- block category -->
              <div class="block left-module">
                  <p class="title_block">Thông tin</p>
                  <div class="block_content">
                      <!-- layered -->
                      <div class="layered layered-category">
                          <div class="layered-content">
                              <ul class="tree-menu">
                                  <li {{ $detailPage->slug == 'gioi-thieu' ? 'class=active' : '' }}><span></span><a href="{{ route('danh-muc', 'gioi-thieu') }}">Giới thiệu</a></li>                               
                                  <li {{ $detailPage->slug == 'bao-mat-thong-tin' ? 'class=active' : '' }}><span></span><a href="{{ route('danh-muc', 'bao-mat-thong-tin') }}">Bảo mật thông tin</a></li>                      
                                  <li {{ $detailPage->slug == 'thanh-toan' ? 'class=active' : '' }}><span></span><a href="{{ route('danh-muc', 'thanh-toan') }}">Phương thức thanh toán</a></li>
                                  <li {{ $detailPage->slug == 'hinh-thuc-van-chuyen' ? 'class=active' : '' }}><span></span><a href="{{ route('danh-muc', 'hinh-thuc-van-chuyen') }}">Hình thức vận chuyển</a></li>
                                  <li {{ $detailPage->slug == 'chinh-sach-bao-hanh' ? 'class=active' : '' }}><span></span><a href="{{ route('danh-muc', 'chinh-sach-bao-hanh') }}">Chính sách bảo hành</a></li>                                 
                              </ul>
                          </div>
                      </div>
                      <!-- ./layered -->
                  </div>
              </div>
              <!-- ./block category  -->
              <!-- Banner silebar -->
              
              @include('frontend.partials.banner-slidebar')
              <!-- ./Banner silebar -->
          </div>
          <!-- ./left colunm -->
          
          <!-- Center colunm-->
          <div class="center_column col-xs-12 col-sm-9" id="center_column">
              <!-- page heading-->
              <h2 class="page-heading">
                  <span class="page-heading-title2">{{ $detailPage->title }}</span>
              </h2>
              <!-- Content page -->
              <div class="content-text clearfix" id="content-page">

                 <?php echo $detailPage->content; ?>

              </div>
              <!-- ./Content page -->
          </div>
          <!-- ./ Center colunm -->
          
      </div>
      <!-- ./row-->   
</div>
</div>
<style type="text/css">
#content-page h1{margin: 10px 0 20px;font-size: 32px;color: #4e5665;}
#content-page h2{margin: 10px 0;font-size: 24px;}
#content-page h3{margin: 10px 0 5px;font-size: 16px;color: #7F7F7F;}
#content-page h1,h2,h3{font-weight: bold;}
#content-page p{
    margin-bottom: 5px;
}
#content-page th {
    padding-top: 11px;
    padding-bottom: 11px;
    background-color: #4CAF50;
    color: white;
}
#content-page table{
    border-left: 1px solid #ddd;
    border-top: 1px solid #ddd;
}
#content-page table td, table th {
    border-right: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    text-align: left;
    padding: 8px;
}
#content-page h1.title-page{
    text-align: left;
    font-size: 23px;
    text-transform: uppercase;
}
#content-page h3{
    padding: 10px 0 0;
}
#content-page .entry-content{
    font-size: 14px;
}

#content-page #help-navigation {
    float: left;
    padding-top: 10px;
    width: 247px;
}
#content-page .nolist {
    list-style: none;
    padding: 0;
    margin: 0;
}
#content-page #help-navigation ul li {
    border-bottom: 1px solid #f2f2f2;
    display: block;
    height: 38px;
    margin-bottom: 0;
}
#content-page #help-navigation ul li {
    border-bottom: 1px solid #f2f2f2;
    display: block;
    height: 38px;
    margin-bottom: 0;
}
#content-page #help-navigation ul li a {
    background-image: url(../img/help-left-menu-arrow.png);
    background-position: 236px center;
    background-repeat: no-repeat;
    color: #0a63c7;
    display: block;
    height: 38px;
    line-height: 38px;
    padding-left: 15px;
}
#content-page #help-navigation ul li a:hover, #content-page #help-navigation ul li.active a {
    background-color: #ebeef4;
}
#content-page #help-main {
    float: right;
    width: 712px;
}

/*---Reset css---*/
@media (min-width: 1200px) {
    #content-page #help-main {
        width: 889px;
    }
}
@media (max-width: 1200px) {

}
@media (max-width: 992px) {
    #content-page #help-navigation{
        display: none;
    }
    #content-page #help-main {
        float: none;
        width: 100%;
    }
}

</style>
@endsection