@extends('base', [
  'meta_title'       => $page->meta_title ?: $page->title,
  'meta_keywords'    => $page->meta_keywords,
  'meta_description' => $page->meta_description
])

@section('content')
<h2>{{ $page->title }}</h2>
{!! $page->html !!}
@stop