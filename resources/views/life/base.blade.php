@extends('base')

@push('head')
<meta content="article" property="og:type">
<meta content="{{ $meta_title ?? '' }}" property="og:title">
<meta content="{{ canonical() }}" property="og:url">
<meta content="{{ $meta_image ?? '' }}" property="og:image">
<meta content="{{ $meta_description ?? '' }}" property="og:description">
@endpush

@section('content_header')
<div class="antialiased hanging-puntuation-first lg:text-lg">
@endsection

@section('content_footer')
</div>
@endsection

{{--
@section('footer')
@parent
<span class="whitespace-no-wrap">
  Поделиться:
  <div class="yashare-auto-init inline-block" data-yashareL10n="ru" data-yashareType="big" data-yashareQuickServices="vkontakte,facebook,twitter,gplus" data-yashareTheme="counter"></div>
</span>
@endsection

@push('js')
<script src="https://yastatic.net/share/share.js"></script>
@endpush
--}}
