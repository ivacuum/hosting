@extends('life.base', [
  'meta_title' => $gig->metaTitle(),
  'meta_description' => $gig->meta_description,
  'meta_image' => $gig->meta_image,
])

@section('content_header')
@parent
@include('tpl.gig-timeline')
<h1 class="h2 mt-0">
  {{ $gig->title }}
  <small><time datetime="{{ $gig->date->toDateString() }}">{{ $gig->fullDate() }}</time></small>
</h1>
<div class="trip-text js-trip-shortcuts">
@endsection

@section('content_footer')
</div>

@parent
@endsection
