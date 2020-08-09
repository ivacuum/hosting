@extends('base', [
  'noLanguageSelector' => true,
])
@include('livewire')

@section('content_header')
<h1 class="text-3xl leading-tight">@lang("meta_title.korean/psy/{$song}")</h1>
@endsection
