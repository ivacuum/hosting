@extends('japanese.base')
@include('livewire')

@section('content')
@livewire(App\Livewire\VocabularyTrainer::class)

<div class="max-w-lg mt-12">
  <h1 class="font-medium text-3xl tracking-tight text-balance mb-2">@lang('Тренажер по набору слов хираганой и катаканой')</h1>
  <div class="grid gap-4">
    <div>
      @ru
        После <a class="link" href="@lng/japanese/hiragana-katakana">разучивания азбук</a> самое время попробовать набирать целые слова. На примере слова <span class="font-bold">суши</span> <span lang="ja">寿司</span> ответ можно дать следующими способами:
        <ul>
          <li><span class="font-medium text-gray-500">латиницей</span> — <span class="font-bold" lang="en">sushi</span></li>
          <li><span class="font-medium text-gray-500">хираганой</span> — <span class="font-bold" lang="ja">すし</span></li>
          <li><span class="font-medium text-gray-500">катаканой</span> — <span class="font-bold" lang="ja">スシ</span></li>
          <li>оригинальным написанием с <span class="font-medium text-gray-500">кандзи</span> — <span class="font-bold" lang="ja">寿司</span></li>
        </ul>
      @en
        Once you have <a class="link" href="@lng/japanese/hiragana-katakana">mastered the syllabaries</a>, you are ready to start typing full words. Using 'sushi' (寿司) as an example, answers may be submitted in any of the following formats:
        <ul>
          <li><span class="font-medium text-gray-500">Romaji</span>: <span class="font-bold" lang="en">sushi</span></li>
          <li><span class="font-medium text-gray-500">Hiragana</span>: <span class="font-bold" lang="ja">すし</span></li>
          <li><span class="font-medium text-gray-500">Katakana</span>: <span class="font-bold" lang="ja">スシ</span></li>
          <li><span class="font-medium text-gray-500">Kanji</span> (original spelling): <span class="font-bold" lang="ja">寿司</span></li>
        </ul>
      @endru
    </div>
    <div>
      @ru
        Для проверки ответа необходимо нажать Ввод или клавишу Энтер. В случае правильного ответа следующее слово будет предложено автоматически.
      @en
        To validate your answer, click Submit or press the Enter key. The next word appears automatically if your answer is correct.
      @endru
    </div>
    <div>
      @ru
        Прием ответов хираганой и катаканой предусмотрен для случая, когда вы добавили себе на устройство японскую раскладку клавиатуры и только осваиваете ее.
      @en
        Support for direct Hiragana and Katakana input is intended for users who have configured a Japanese keyboard layout and wish to practice native typing.
      @endru
    </div>
    <div>
      @ru
        На иероглифы на фиолетовом фоне можно нажать, чтобы перейти на страницу с дополнительной информацией. Там же можно послушать произношение слов и посмотреть примеры предложений с ними.
      @en
        Click a word on a purple background to view more details. The detailed page includes native pronunciation and examples of the word used in context.
      @endru
    </div>
    <div>
      @ru
        База слов из прекрасного сервиса <a class="link" href="https://wanikani.com/" rel="noreferrer">Wanikani</a>, посвященного разучиванию ключей, кандзи и словарных слов. <a class="link" href="/news/263">Мой отзыв о Wanikani</a>.
      @en
        The vocabulary database is sourced from <a class="link" href="https://wanikani.com/" rel="noreferrer">Wanikani</a>, a wonderful platform dedicated to learning radicals, kanji, and vocabulary.
      @endru
    </div>
  </div>
</div>
@endsection
