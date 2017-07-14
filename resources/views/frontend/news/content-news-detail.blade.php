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
        <div class="block_content">
            <div class="block-title block-title-common">
                <h3><span class="icon-tile"><i class="fa fa-th-list"></i></span> News related</h3>
            </div>
            <div class="block-contents">
                <div class="all-news-new-list">
                    <div class="row">
                        @if( $otherArr )
                        @foreach( $otherArr as $articles)
                        <div class="col-sm-6 col-xs-12">
                            <div class="all-news-new-item clearfix">
                                <div class="all-news-new-img">
                                    <a href="{{ route('news-detail', ['slug' => $articles->slug, 'id' => $articles->id]) }}" title="">
                                        <img  src="{{ Helper::showImage($articles->image_url) }}" alt="" style="height:80px !important; width:120px !important; "> 
                                    </a>
                                </div>
                                <div class="all-news-new-info" style="height:77px !important">
                                    <a href="{{ route('news-detail', ['slug' => $articles->slug, 'id' => $articles->id]) }}" title="">
                                        {{ $articles->title }}
                                    </a>
                                </div>
                            </div>
                        </div><!-- /col-sm-6 col-xs-12 --> 
                        @endforeach
                        @endif
                    </div>                
                </div>
            </div>
        </div><!-- /block-news-with-region -->
    </div><!-- /block -->

</div>
@endsection