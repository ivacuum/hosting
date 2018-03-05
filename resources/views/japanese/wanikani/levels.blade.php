@extends('japanese.base')

@section('content')
<h1 class="h2">{{ trans('japanese.levels') }}</h1>
<div class="d-flex flex-wrap align-items-center">
  @foreach (range(1, 60) as $level)
    <a class="badge badge-secondary f16 mr-2 mb-2" href="{{ path('JapaneseWanikaniLevel@show', $level) }}">
      {{ $level }}
    </a>
  @endforeach
</div>
@endsection
