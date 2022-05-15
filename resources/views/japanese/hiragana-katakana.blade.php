@extends('japanese.base')
@include('vue')
@include('livewire')

@section('content')
<h1 class="h2">@lang('Хирагана и катакана')</h1>
<hiragana-katakana></hiragana-katakana>

<div class="mt-12 max-w-[600px]">
  <div class="h3">@ru Что дальше? @en What next? @endru</div>
  @ru
    <p>Рады, что у вас стало хорошо получаться набирать слоги! Теперь можно закрепить навык в <a class="link" href="/japanese/words-trainer">следующем тренажере</a>, который посвящен набору настоящих японских слов. Так между делом и получится запомнить как они звучат.</p>
  @en
    <p>We're glad you're get used to Japanese syllabaries! Now you can head on to the <a class="link" href="/en/japanese/words-trainer">next trainer</a> dedicated to typing real Japanese words. As a bonus, you can memorize the words are pronounced while typing.</p>
  @endru
</div>

@ru
  <div class="mt-12 max-w-[600px]">
    <div class="h3">Почему набор латиницей, а не кириллицей?</div>
    <p>Взгляните на <a class="link" href="/life/countries/japan">заметки и фотографии</a> из неоднократных поездок в Японию. Попробуйте на них найти кириллизированные японские надписи. Не получилось? Или получилось найти только названия городов? Что ж. Латиница поможет в поездке, а кириллица — едва ли.</p>
  </div>
@en
  <div class="mt-12 max-w-[600px]">
    <div class="h3">Stories about Japan</div>
    <p>Quite a few <a class="link" href="/en/life/countries/japan">notes with a few thousand photos</a> were published after traveling to Japan.</p>
  </div>
@endru

<div class="mt-12 max-w-[600px]">
  <div class="h3 mt-12">@lang('Обратная связь')</div>
  @ru
    <p>Поделитесь своим опытом использования тренажера или задайте вопрос. Мы постараемся обработать информацию и сделать тренажер еще лучше. <span class="whitespace-nowrap" lang="ja">ありがとうございます。</span></p>
  @en
    <p>Use the form below to ask a question or share your thoughts. We will use your feedback to make the trainer better. There are certainly things to improve. <span class="whitespace-nowrap" lang="ja">ありがとうございます。</span></p>
  @endru
  @livewire(App\Http\Livewire\FeedbackForm::class, [
    'title' => 'Hiragana Katakana Trainer',
    'hideTitle' => true,
  ])
</div>
@endsection
