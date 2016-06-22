@extends('base')

@push('head')
<meta content="article" property="og:type">
<meta content="{{ $meta_title or '' }}" property="og:title">
<meta content="{{ Request::url() }}" property="og:url">
<meta content="{{ $meta_image or '' }}" property="og:image">
<meta content="{{ $meta_description or '' }}" property="og:description">
@endpush

@section('content_header')
<div class="lead js-shortcuts-items">
@endsection

@section('content_footer')
</div>
@endsection

{{--
@section('footer')
@parent
<span style="white-space: nowrap;">
  Поделиться:
  <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="big" data-yashareQuickServices="vkontakte,facebook,twitter,gplus" data-yashareTheme="counter" style="display: inline-block"></div>
</span>
@endsection

@push('js')
<script src="//yastatic.net/share/share.js"></script>
@endpush
--}}
