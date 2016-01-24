@extends('life.base', [
  'meta_title' => $trip->getMetaTitle(),
  'meta_description' => $trip->getMetaDescription(),
  'meta_image' => $trip->meta_image,
])

@section('content_header')
@parent
<h2>
  <span class="emoji">{{ $trip->city->country->emoji }}</span>
  {{ $trip->title }}
</h2>
@endsection
