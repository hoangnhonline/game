@extends('frontend.layout')
  
  
@include('frontend.news.content')
@include('frontend.partials.meta')
  

@section('content')
<section class="col-sm-8 col-xs-12 block-sitemain">
<article class="block-breadcrumb-page">
    <ul class="breadcrumb"> 
        <li><a href="{{ route('home') }}" title="Trở về trang chủ">Trang chủ</a></li>            
        <li class="active">{{ $cateDetail->name }}</li>
    </ul>
</article>
    <article class="block block-breadcrumb">
      <div class="block-contents">
        <ul>
          <li class="active"><h2><a href="{{ route('news-list', $cateDetail->slug) }}">{{ $cateDetail->name }}</a></h2></li>
        </ul>
      </div>
    </article><!-- /block-breadcrumb -->    

    <article class="block block-article-list clearfix">
      <div class="col-sm-12 col-xs-12">
        <div class="row">
          <div class="block-contents">
            <ul class="article-list-news">
              @foreach( $articlesArr as $articles )
              <li class="article-news-item">
                <div class="article-news-item-head">
                  <a id="" href="{{ route('news-detail', ['slug' => $articles->slug, 'id' => $articles->id]) }}"><img id="" title="" src="{{ Helper::showImage($articles->image_url) }}" alt=""></a>
                </div>
                <div class="article-news-item-description">
                  <a href="{{ route('news-detail', ['slug' => $articles->slug, 'id' => $articles->id]) }}" title="">{{ $articles->title }}</a>
                  <div class="nd-time">{{ date('d-m-Y', strtotime($articles->created_at)) }}  <small>08:05 </small></div>
                  <p>{{ $articles->description }}</p>
                </div>
              </li>
              @endforeach
             
            </ul>
            <!--<nav class="block-pagination">
              <ul class="pagination">
                <li><a class="selected" href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#" aria-label="Previous">Trang sau</a></li>
                <li><a href="#" aria-label="Next">Trang cuối</a></li>
              </ul>-->
            </nav>
          </div>
        </div>
      </div>
    </article><!-- /block-news-new -->

  </section><!-- /block-site-left -->
@endsection
  @section('javascript_page')
  
@endsection