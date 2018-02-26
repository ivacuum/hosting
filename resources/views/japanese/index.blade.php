@extends('base')

@section('content')
<h1 class="h2">{{ trans('japanese.index') }}</h1>
<p>Тренировка <a class="link" href="{{ path('JapaneseHiraganaKatakana@index') }}">хираганы и катаканы</a>.</p>
@endsection
