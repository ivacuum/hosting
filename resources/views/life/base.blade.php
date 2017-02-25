@extends('base')

@push('head')
<meta content="article" property="og:type">
<meta content="{{ $meta_title ?? '' }}" property="og:title">
<meta content="{{ Request::url() }}" property="og:url">
<meta content="{{ $meta_image ?? '' }}" property="og:image">
<meta content="{{ $meta_description ?? '' }}" property="og:description">
@endpush

@section('content_header')
<div class="life-text js-shortcuts-items">
@endsection

@section('content_footer')
</div>
@endsection

{{--
@section('footer')
@parent
<span class="text-nowrap">
  Поделиться:
  <div class="yashare-auto-init d-inline-block" data-yashareL10n="ru" data-yashareType="big" data-yashareQuickServices="vkontakte,facebook,twitter,gplus" data-yashareTheme="counter"></div>
</span>
@endsection

@push('js')
<script src="https://yastatic.net/share/share.js"></script>
@endpush
--}}
