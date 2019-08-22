@extends('life.base', [
  'meta_title' => $gig->metaTitle(),
  'meta_description' => $gig->metaDescription(),
  'meta_image' => $gig->meta_image,
])

@section('content_header')
@parent
@include('tpl.gig-timeline')
<h1 class="h2">
  {{ $gig->title }}
  <span class="tw-text-base tw-text-gray-600"><time datetime="{{ $gig->date->toDateString() }}">{{ $gig->fullDate() }}</time></span>
</h1>
<div class="mw-1000 js-trip-shortcuts">
@endsection

@section('content_footer')
</div>

<div class="h4 tw-mt-12">@ru Поделиться ссылкой @en Share @endru</div>
@include('tpl.social-buttons', ['title' => $gig->metaTitle(), 'url' => Request::url()])
@parent
@endsection
