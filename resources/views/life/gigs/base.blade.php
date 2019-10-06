@extends('life.base', [
  'metaTitle' => $gig->metaTitle(),
  'metaDescription' => $gig->metaDescription(),
  'metaImage' => $gig->meta_image,
])

@section('content_header')
@parent
@include('tpl.gig-timeline')
<h1 class="h2">
  {{ $gig->title }}
  <span class="text-base text-muted"><time datetime="{{ $gig->date->toDateString() }}">{{ $gig->fullDate() }}</time></span>
</h1>
<div class="max-w-1000px js-trip-shortcuts">
@endsection

@section('content_footer')
</div>

<div class="h4 mt-12">@ru Поделиться ссылкой @en Share @endru</div>
@include('tpl.social-buttons', ['title' => $gig->metaTitle(), 'url' => Request::url()])
@parent
@endsection
