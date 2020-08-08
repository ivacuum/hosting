@extends('japanese.wanikani.base')

@section('content')
<h1 class="h2">{{ trans('japanese.kanji') }}</h1>
@foreach (range($from, $to) as $level)
  @livewire(App\Http\Livewire\KanjiList::class, ['level' => $level, 'range' => true])
@endforeach

<div class="flex items-center justify-between mt-4">
  <div>
    @if ($from > 10)
      <a href="{{ path([App\Http\Controllers\JapaneseWanikaniKanji::class, 'index'], ['from' => $from - 10]) }}">
        @svg (chevron-left)
        @lang('Уровень :level', ['level' => max(1, $from - 10) . '–' . min(60, $from - 1)])
      </a>
    @endif
  </div>
  <div>
    @if ($to < 51)
      <a href="{{ path([App\Http\Controllers\JapaneseWanikaniKanji::class, 'index'], ['from' => $to + 1]) }}">
        @lang('Уровень :level', ['level' => min(60, $to + 1) . '–' . min(60, $to + 10)])
        @svg (chevron-right)
      </a>
    @endif
  </div>
</div>
@endsection
