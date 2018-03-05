@extends('japanese.base')

@section('content')
<h1 class="h2">{{ trans('japanese.vocabulary') }}</h1>
<vocabulary action="{{ path("$self@index") }}"></vocabulary>
@endsection
