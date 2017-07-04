@include('frontend.partials.meta')
@section('content')
<div class="col-sm-9 block-main">
  @foreach($loaiSpList as $loaiSp)
  <div class="block-product block-block-title">
    <h2 class="block-title">{!! $loaiSp->name !!}</h2>
    <div class="block-content">
      <div class="row block-list-product">
        @if($productArr[$loaiSp->id]->count() > 0)
        @foreach($productArr[$loaiSp->id] as $product)
        <div class="col-md-5ths col-xs-6">
          <div class="item">
            <div class="product-img">
              <a href="{{ route('chi-tiet', [$product->slug_loai, $product->slug, $product->id]) }}" title="{!! $product->name !!}">
                <img src="{{ Helper::showImageThumb($product->image_url) }}" alt="{!! $product->name !!}">
              </a>
            </div>
            <h2 class="product-name">{!! $product->name !!}</h2>
          </div>
        </div><!-- /col-md-5ths col-xs-6 -->
        @endforeach
        @endif
      </div>
    </div><!-- /block-content -->
  </div><!-- /block-product -->
  @endforeach
</div><!-- /block-main -->
@endsection