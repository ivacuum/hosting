@extends('base', [
  'noLanguageSelector' => true,
])

@section('content_header')
<h1 class="text-3xl leading-tight">{{ trans("meta_title.korean-psy-{$song}") }}</h1>
@endsection
