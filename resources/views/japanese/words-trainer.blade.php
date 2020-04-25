@extends('base')

@section('content')
@livewire('vocabulary-trainer')

<div class="max-w-lg mt-12">
  <h1 class="h2">{{ trans('japanese.words-trainer') }}</h1>
  <div>
    @ru
      После <a class="link" href="{{ path([App\Http\Controllers\JapaneseHiraganaKatakana::class, 'index']) }}">разучивания азбук</a> самое время попробовать набирать целые слова. Ответ можно дать как латиницей (пример: sushi), так и хираганой (すし), если вы набираете на японской раскладке клавиатуры. Даже оригинальная запись с иероглифами принимается (寿司).
    @endru
  </div>
  <div class="mt-4">
    @ru
      Для проверки ответа необходимо нажать Ввод или клавишу Энтер. В случае правильного ответа следующее слово будет предложено автоматически.
    @endru
  </div>
  <div class="mt-4">
    @ru
      На иероглифы можно нажать, чтобы перейти на страницу с дополнительной информацией. Там же можно послушать произношение слов.
    @endru
  </div>
</div>
@endsection

@push('head')
@livewireStyles
@endpush

@push('js_vendor')
@livewireScripts
<script src="{{ mix('/assets/livewire-vue.js') }}"></script>
@endpush
