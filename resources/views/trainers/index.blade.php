@extends('base')

@section('content')
<p><a href="{{ to('japanese/hiragana-katakana') }}">Тренажер хираганы и катаканы</a></p>
<p><a href="{{ to('japanese/words-trainer') }}">Тренажер по набору слов хираганой и катаканой</a></p>
<p><a href="{{ to('trainers/numbers') }}">Тренажер чисел</a></p>
@endsection
