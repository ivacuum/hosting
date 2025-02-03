@extends('life.base')

@section('content')
<h1 class="text-4xl mb-2">@lang('Тренажеры')</h1>
<p>@lang('Интерактивные инструменты для практики иностранных языков.')</p>

<div class="grid gap-12 md:grid-cols-2 mt-12">
  <div>
    <div class="flex flex-col gap-2">
      <a class="flex flex-col gap-2 link-parent group" href="{{ to('japanese/hiragana-katakana') }}">
        <div class="flex items-center justify-center border border-amber-200 dark:border-amber-700/25 rounded-sm bg-amber-100 dark:bg-amber-800/40 dark:group-hover:bg-amber-800/60 w-24 h-12 text-2xl text-amber-900 dark:text-amber-200">五十音</div>
        <h2 class="text-2xl text-balance link">
          @lang('japanese.hiragana-katakana-trainer')
        </h2>
      </a>
      <div>@lang('meta_description.japanese/hiragana-katakana')</div>
    </div>
  </div>
  <div>
    <div class="flex flex-col gap-2">
      <a class="flex flex-col gap-2 link-parent group" href="{{ to('japanese/words-trainer') }}">
        <div class="flex items-center justify-center border border-cyan-200 dark:border-cyan-700/25 rounded-sm bg-cyan-100 dark:bg-cyan-700/40 dark:group-hover:bg-cyan-700/60 w-24 h-12 text-2xl text-cyan-900 dark:text-cyan-200">単語</div>
        <h2 class="text-2xl text-balance link">
          @lang('Тренажер по набору слов хираганой и катаканой')
        </h2>
      </a>
      <div>@lang('meta_description.japanese/words-trainer')</div>
    </div>
  </div>
  <div>
    <div class="flex flex-col gap-2">
      <a class="flex flex-col gap-2 link-parent group" href="{{ to('korean/hangul') }}">
        <div class="flex items-center justify-center border border-indigo-200 dark:border-indigo-700/25 rounded-sm bg-indigo-100 dark:bg-indigo-700/40 dark:group-hover:bg-indigo-700/60 w-24 h-12 text-2xl text-indigo-900 dark:text-indigo-200">한글</div>
        <h2 class="text-2xl text-balance link">
          @lang('Тренажер хангыля')
        </h2>
      </a>
      <div>@lang('meta_description.korean/hangul')</div>
    </div>
  </div>
  <div>
    <div class="flex flex-col gap-2">
      <a class="flex flex-col gap-2 link-parent group" href="{{ to('trainers/numbers') }}">
        <div class="flex items-center justify-center border border-lime-200 dark:border-lime-700/25 rounded-sm bg-lime-100 dark:bg-lime-800/40 dark:group-hover:bg-lime-800/60 w-24 h-12 text-2xl text-lime-900 dark:text-lime-200">123</div>
        <h2 class="text-2xl text-balance link">
          @lang('Тренажер чисел')
        </h2>
      </a>
      <div>@lang('meta_description.trainers/numbers')</div>
    </div>
  </div>
</div>
@endsection
