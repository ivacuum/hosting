@extends('life.base', [
  'meta_title' => $gig->getMetaTitle(),
  'meta_description' => $gig->meta_description,
  'meta_image' => $gig->meta_image,
])

@section('content_header')
@parent
@include('tpl.gig-timeline')
<h2>
  {{ $gig->title }}
  <small>{{ $gig->fullDate() }}</small>
</h2>
<div class="trip-text js-trip-shortcuts trip-lang-{{ $locale }}">
@endsection

@section('content_footer')
</div>
@parent
@endsection
