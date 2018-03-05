@extends('japanese.base')

@section('content')
<h1 class="h2">{{ trans('japanese.index') }}</h1>
<p>Изучение иероглифов с помощью <a class="link" href="{{ path('JapaneseWanikani@index') }}">{{ trans('japanese.wanikani') }}.</a></p>
<p>Тренировка <a class="link" href="{{ path('JapaneseHiraganaKatakana@index') }}">хираганы и катаканы</a>.</p>
@endsection
