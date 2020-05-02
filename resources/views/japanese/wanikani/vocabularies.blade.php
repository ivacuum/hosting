@extends('japanese.wanikani.base')

@section('content')
<h1 class="h2">{{ trans('japanese.vocabulary') }}</h1>
@foreach (range($from, $to) as $level)
  @livewire(App\Http\Livewire\VocabularyList::class, ['level' => $level, 'range' => true])
@endforeach

<div class="flex items-center justify-between mt-4">
  <div>
    @if ($from > 5)
      <a href="{{ path([App\Http\Controllers\JapaneseWanikaniVocabulary::class, 'index'], ['from' => $from - 5]) }}">
        @svg (chevron-left)
        {{ trans('japanese.level', ['level' => max(1, $from - 5) . '–' . min(60, $from - 1)]) }}
      </a>
    @endif
  </div>
  <div>
    @if ($to < 56)
      <a href="{{ path([App\Http\Controllers\JapaneseWanikaniVocabulary::class, 'index'], ['from' => $to + 1]) }}">
        {{ trans('japanese.level', ['level' => min(60, $to + 1) . '–' . min(60, $to + 5)]) }}
        @svg (chevron-right)
      </a>
    @endif
  </div>
</div>
@endsection
