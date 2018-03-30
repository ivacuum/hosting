@extends('japanese.wanikani.base')

@section('content')
<h1 class="h2">{{ trans('japanese.radicals') }}</h1>
<radicals action="{{ path("$self@index") }}"></radicals>
@endsection
