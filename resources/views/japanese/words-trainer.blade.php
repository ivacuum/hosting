@extends('japanese.base')
@include('livewire')

@section('content')
@livewire(App\Http\Livewire\VocabularyTrainer::class)

<div class="max-w-lg mt-12">
  <h1 class="h2">@lang('Тренажер по набору слов хираганой и катаканой')</h1>
  <div class="grid gap-4">
    <div>
      @ru
        После <a class="link" href="{{ path(App\Http\Controllers\JapaneseHiraganaKatakana::class) }}">разучивания азбук</a> самое время попробовать набирать целые слова. На примере слова <span class="font-bold">суши</span> <span lang="ja">寿司</span> ответ можно дать следующими способами:
        <ul>
          <li><span class="font-medium text-gray-500">латиницей</span> — <span class="font-bold" lang="en">sushi</span></li>
          <li><span class="font-medium text-gray-500">хираганой</span> — <span class="font-bold" lang="ja">すし</span></li>
          <li><span class="font-medium text-gray-500">катаканой</span> — <span class="font-bold" lang="ja">スシ</span></li>
          <li>оригинальным написанием с <span class="font-medium text-gray-500">кандзи</span> — <span class="font-bold" lang="ja">寿司</span></li>
        </ul>
      @endru
    </div>
    <div>
      @ru
        Для проверки ответа необходимо нажать Ввод или клавишу Энтер. В случае правильного ответа следующее слово будет предложено автоматически.
      @endru
    </div>
    <div>
      @ru
        Прием ответов хираганой и катаканой предусмотрен для случая, когда вы добавили себе на устройство японскую раскладку клавиатуры и только осваиваете ее.
      @endru
    </div>
    <div>
      @ru
        На иероглифы на фиолетовом фоне можно нажать, чтобы перейти на страницу с дополнительной информацией. Там же можно послушать произношение слов и посмотреть примеры предложений с ними.
      @endru
    </div>
    <div>
      @ru
        База слов из прекрасного сервиса <a class="link" href="https://wanikani.com/" rel="noreferrer">Wanikani</a>, посвященного разучиванию ключей, кандзи и словарных слов. <a class="link" href="/news/263">Мой отзыв о Wanikani</a>.
      @endru
    </div>
  </div>
</div>
@endsection
