@extends('japanese.wanikani.base', [
  'meta_replace' => ['level' => $level],
])

@section('content')
<h1 class="h2">{{ trans('japanese.level', compact('level')) }}</h1>
<radicals action="{{ path('JapaneseWanikaniRadicals@index') }}" :level="{{ $level }}"></radicals>
<kanji action="{{ path('JapaneseWanikaniKanji@index') }}" :level="{{ $level }}"></kanji>
<vocabulary action="{{ path('JapaneseWanikaniVocabulary@index') }}" :level="{{ $level }}"></vocabulary>

<div class="d-flex justify-content-between mt-3">
  <div>
    @if ($level > 1)
      <a class="btn border-b125" href="{{ path('JapaneseWanikaniLevel@show', $level - 1) }}" id="previous_page">
        @svg (chevron-left)
        {{ trans('japanese.level', ['level' => $level - 1]) }}
      </a>
    @endif
  </div>
  <div>
    @if ($level < 60)
      <a class="btn border-b125" href="{{ path('JapaneseWanikaniLevel@show', $level + 1) }}" id="next_page">
        {{ trans('japanese.level', ['level' => $level + 1]) }}
        @svg (chevron-right)
      </a>
    @endif
  </div>
</div>
@endsection
