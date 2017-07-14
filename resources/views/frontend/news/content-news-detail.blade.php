@include('frontend.partials.meta')
@section('content')
<div class="block_about">
    <div class="block block_commom block_shadow">
        <div class="block_title">
            <div class="block_breadcrumb">
                <ul class="breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>
                        <a href="{{ route('parent', 'news') }}">{!! $cateDetail->name !!}</a>
                    </li>  
                    <li class="active">{!! $detail->title !!}</li>
                </ul>
            </div>
        </div>
        <div class="block_content">
            <div class="product_box">
                <img src="{{ Helper::showImage($detail->image_url) }}">
                <?php echo $detail->content; ?>
            </div><!-- /product_box -->
        </div>
        <div class="block block_commom block_shadow block_related">
            <div class="block_title">
                <p class="block_title_small">News related</p>
            </div>
            <div class="block-content">
                <div class="news_box">
                    <ul class="news_items clearfix">
                        @if( $otherArr )
                        @foreach( $otherArr as $articles)
                        <li class="col-sm-6 col-xs-6 news_item">
                            <div class="news_img">
                                <a title="{!! $articles->title !!}" href="{{ route('news-detail', ['slug' => $articles->slug, 'id' => $articles->id]) }}">
                                    <img alt="{!! $articles->title !!}" src="{{ Helper::showImage($articles->image_url) }}">
                                </a>
                            </div>
                            <div class="description">
                                <h3>
                                    <a title="{!! $articles->title !!}" href="{{ route('news-detail', ['slug' => $articles->slug, 'id' => $articles->id]) }}">{!! $articles->title !!}</a>
                                </h3>
                                <!--<p class="date">2017-06-28</p>-->
                            </div>
                        </li><!-- /product_item -->
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div><!-- /block_related -->      
    </div><!-- /block -->

</div>
@endsection