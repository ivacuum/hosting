@extends('base', [
  'noLanguageSelector' => true,
])

@section('content_header')
<h1 class="font-medium text-3xl tracking-tight mb-2">@lang("meta_title.korean/psy/{$song}")</h1>
@endsection
