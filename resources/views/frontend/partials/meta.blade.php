@section('title'){{ $seo['title'] }}@endsection
@section('site_description'){{ $seo['description'] }}@endsection
@section('site_keywords'){{ $seo['keywords'] }}@endsection
@section('site_name'){{ $settingArr['site_name'] }}@endsection
@section('favicon'){{ Helper::showImage($settingArr['favicon']) }}@endsection
@section('logo'){{ Helper::showImage($settingArr['logo']) }}@endsection

