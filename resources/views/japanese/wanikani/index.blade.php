@extends('japanese.base')

@section('content')
<h1 class="h2">{{ trans('japanese.wanikani') }}</h1>
<div class="row text-center mb-2">
  <div class="col-md-4 mb-2">
    <div class="bg-radical rounded">
      <a
        class="d-block ja-shadow-light py-4 text-white"
        href="{{ path('JapaneseWanikaniRadicals@index') }}"
      >
        <span class="d-block f36">部首</span>
        {{ trans('japanese.radicals') }}
      </a>
    </div>
  </div>
  <div class="col-md-4 mb-2">
    <div class="bg-kanji rounded">
      <a
        class="d-block ja-shadow-light py-4 text-white"
        href="{{ path('JapaneseWanikaniKanji@index') }}"
      >
        <span class="d-block f36">漢字</span>
        {{ trans('japanese.kanji') }}
      </a>
    </div>
  </div>
  <div class="col-md-4 mb-2">
    <div class="bg-vocab rounded">
      <a
        class="d-block ja-shadow-light py-4 text-white"
        href="{{ path('JapaneseWanikaniVocabulary@index') }}"
      >
        <span class="d-block f36">単語</span>
        {{ trans('japanese.vocabulary') }}
      </a>
    </div>
  </div>
</div>

@ru
  <p>WaniKani — это сервис для изучения иероглифов японского языка. Первоисточник расположен по адресу <a class="link" href="https://www.wanikani.com/">wanikani.com</a>. В данном же разделе представлена облегченная его копия с дополнительными возможностями, которых очень недостает на нем. Легкая версия обусловлена тем, что здесь отсутствуют авторские расшифровки иероглифов и мнемоники к ним — за этим нужно обращаться к первоисточнику. Из доработок можно отметить возможность перемешивания информации для стимулирования вдумчивого повторения — у WaniKani информация всегда выводится в алфавитном порядке. Также по умолчанию в списках ключей, кандзи и словарных слов скрыты ответы — это позволяет проверять себя слово за словом, не подглядывая соседние ответы. Тем не менее все ответы можно показать одним нажатием кнопки.</p>
  <p>Вся информация по ключам, кандзи и словарным словам представлена только на английском языке, как и на WaniKani. Без изменений, чтобы не возникало путаницы. Этот сервис — дополнение, а не полноценная замена.</p>
@endru

<h3 class="mt-4">{{ trans('japanese.by-levels') }}</h3>
<div class="d-flex flex-wrap align-items-center">
  @foreach (range(1, 60) as $level)
    <a class="badge badge-secondary f18 ja-shadow-light mr-2 mb-2" href="{{ path('JapaneseWanikaniLevel@show', $level) }}">
      {{ $level }}
    </a>
  @endforeach
</div>
@ru
  <div>На сайте-первоисточнике информация разбита на 60 уровней по нарастанию сложности. Нарастание сложности определено на авторский взгляд и не отражает популярности слов. В среднем на каждом уровне около 33 кандзи и 100 словарных слов. Таким образом, общая база составляет около 2000 иероглифов и 6000 словарных слов.</div>
@endru
@endsection
