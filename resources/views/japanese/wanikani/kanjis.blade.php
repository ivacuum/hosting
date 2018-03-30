@extends('japanese.wanikani.base')

@section('content')
<h1 class="h2">{{ trans('japanese.kanji') }}</h1>
<kanji action="{{ path("$self@index") }}"></kanji>
@endsection
