@extends('japanese.wanikani.base')

@section('content')
<h1 class="h2">@lang('WaniKani V')</h1>
<div class="grid md:grid-cols-3 gap-2 md:gap-4 text-center mb-4">
  <div>
    <div class="bg-radical rounded">
      <a
        class="block ja-shadow-light py-6 text-white hover:text-grey-200"
        href="@lng/japanese/wanikani/radicals"
      >
        <span class="block text-4xl">部首</span>
        @lang('japanese.radicals')
      </a>
    </div>
  </div>
  <div>
    <div class="bg-kanji rounded">
      <a
        class="block ja-shadow-light py-6 text-white hover:text-grey-200"
        href="@lng/japanese/wanikani/kanji"
      >
        <span class="block text-4xl">漢字</span>
        @lang('japanese.kanji')
      </a>
    </div>
  </div>
  <div>
    <div class="bg-vocab rounded">
      <a
        class="block ja-shadow-light py-6 text-white hover:text-grey-200"
        href="@lng/japanese/wanikani/vocabulary"
      >
        <span class="block text-4xl">単語</span>
        @lang('japanese.vocabulary')
      </a>
    </div>
  </div>
</div>

@ru
  <p>WaniKani — это сервис для изучения иероглифов японского языка. Первоисточник расположен по адресу <a class="link" href="https://www.wanikani.com/">wanikani.com</a>. В данном же разделе представлена облегченная его копия с дополнительными возможностями, которых очень недостает на нем. Легкая версия обусловлена тем, что здесь отсутствуют авторские расшифровки иероглифов и мнемоники к ним — за этим нужно обращаться к первоисточнику. Из доработок можно отметить возможность перемешивания информации для стимулирования вдумчивого повторения — у WaniKani информация всегда выводится в алфавитном порядке. Также по умолчанию в списках ключей, кандзи и словарных слов скрыты ответы — это позволяет проверять себя слово за словом, не подглядывая соседние ответы. Тем не менее все ответы можно показать одним нажатием кнопки.</p>
  <p>Вся информация по ключам, кандзи и словарным словам представлена только на английском языке, как и на WaniKani. Без изменений, чтобы не возникало путаницы. Этот сервис — дополнение, а не полноценная замена.</p>
@endru

<h3 class="mt-6">@lang('japanese.by-levels')</h3>
<div class="flex flex-wrap items-center">
  @foreach (range(1, 60) as $level)
    <a
      class="flex bg-grey-600 hover:bg-grey-700 text-white hover:text-grey-100 px-2 text-lg font-bold rounded ja-shadow-light mr-2 mb-2"
      href="{{ to('japanese/wanikani/level/{level}', $level) }}"
    >
      {{ $level }}
    </a>
  @endforeach
</div>
@ru
  <div>На сайте-первоисточнике информация разбита на 60 уровней по нарастанию сложности. Нарастание сложности определено на авторский взгляд и не отражает популярности слов. В среднем на каждом уровне около 33 кандзи и 100 словарных слов. Таким образом, общая база составляет около 2000 иероглифов и 6000 словарных слов.</div>
@endru
@endsection
