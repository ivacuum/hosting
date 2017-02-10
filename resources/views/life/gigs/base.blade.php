@extends('life.base', [
  'meta_title' => $gig->metaTitle(),
  'meta_description' => $gig->meta_description,
  'meta_image' => $gig->meta_image,
])

@section('content_header')
@parent
@include('tpl.gig-timeline')
<h2>
  {{ $gig->title }}
  <small><time datetime="{{ $gig->date->toDateString() }}">{{ $gig->fullDate() }}</time></small>
</h2>
<div class="trip-text js-trip-shortcuts">
@endsection

@section('content_footer')
</div>

@parent
@endsection
