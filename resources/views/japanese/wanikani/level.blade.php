@extends('japanese.wanikani.base')

@section('content')
<h1 class="font-medium text-3xl tracking-tight mb-2">@lang('Уровень :level', ['level' => $level])</h1>

@livewire(App\Http\Livewire\RadicalList::class, ['level' => $level])
@livewire(App\Http\Livewire\KanjiList::class, ['level' => $level])
@livewire(App\Http\Livewire\VocabularyList::class, ['level' => $level])

<div class="flex items-center justify-between mt-4">
  <div>
    @if ($level > 1)
      <a href="{{ path(App\Http\Controllers\WanikaniLevel::class, $level - 1) }}" id="prev_page">
        @svg (chevron-left)
        @lang('Уровень :level', ['level' => $level - 1])
      </a>
    @endif
  </div>
  <div>
    @if ($level < 60)
      <a href="{{ path(App\Http\Controllers\WanikaniLevel::class, $level + 1) }}" id="next_page">
        @lang('Уровень :level', ['level' => $level + 1])
        @svg (chevron-right)
      </a>
    @endif
  </div>
</div>
@endsection
