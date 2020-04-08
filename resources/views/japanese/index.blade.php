@extends('japanese.base')

@section('content_header')
<div class="antialiased hanging-puntuation-first lg:text-lg">
@endsection

@section('content_footer')
</div>
@endsection

@section('content')
<h1 class="h2">{{ trans('japanese.index') }}</h1>
<div class="grid md:grid-cols-2 gap-8 mt-6">
  <div class="flex">
    <div class="border overflow-hidden rounded">
      <div class="bg-greenish-600 px-5 py-3 text-white">
        <h2 class="h4 mb-0">@ru Собственные ресурсы @en Own services @endru</h2>
      </div>
      <div class="px-5 py-4">
        @ru
          <h3 class="h4"><a class="link" href="{{ path([App\Http\Controllers\JapaneseHiraganaKatakana::class, 'index']) }}">Тренажер хираганы и катаканы</a></h3>
          <div>Быстрое освоение японских слоговых азбук столбик за столбиком.</div>

          <h3 class="h4 mt-6"><a class="link" href="{{ path([App\Http\Controllers\JapaneseWanikani::class, 'index']) }}">{{ trans('japanese.wanikani') }}</a></h3>
          <div>Набор ключей, иероглифов и словарных слов для изучения и повторения. Данные и вдохновение взяты с сайта <a class="link" href="https://www.wanikani.com/">wanikani.com</a> и приправлены дополнительными функциями для улучшения процесса обучения.</div>
        @en
          <h3 class="h4"><a class="link" href="{{ path([App\Http\Controllers\JapaneseHiraganaKatakana::class, 'index']) }}">Hiragana & Katakana trainer</a></h3>
          <div>Learn Japanese syllabaries column by column the fast way.</div>

          <h3 class="h4 mt-6"><a class="link" href="{{ path([App\Http\Controllers\JapaneseWanikani::class, 'index']) }}">{{ trans('japanese.wanikani') }}</a></h3>
          <div>Set of radicals, kanji and vocabulary to study and review. Data and inspiration from <a class="link" href="https://www.wanikani.com/">wanikani.com</a> with features added to make learning and review process more effective.</div>
        @endru
      </div>
    </div>
  </div>
  <div class="flex">
    <div class="border overflow-hidden rounded">
      <div class="bg-grey-800 px-5 py-3 text-white">
        <h2 class="h4 mb-0">@ru Внешние полезные ресурсы @en External resources @endru</h2>
      </div>
      <div class="px-5 py-4">
        @ru
          <div class="mb-1">Все на английском, так как на нем материалов доступно в разы больше, чем на родном.</div>
        @en
          <div class="mb-1">Helpful resources for self-learning students:</div>
        @endru
        <ul>
          <li>
            <a class="link" href="http://jisho.org/">jisho.org</a>
            @ru
              — словарь
            @en
              — powerful dictionary
            @endru
          </li>
          <li>
            <a class="link" href="https://www.wanikani.com/">wanikani.com</a>
            @ru
              — онлайн-сервис для изучения ключей, кандзи и иероглифов
            @en
              — web application for learning radicals, kanji and vocabulary
            @endru
          </li>
          <li>
            <a class="link" href="http://www.kanjidamage.com/">kanjidamage.com</a>
            @ru
              — все о кандзи
            @en
              — all about kanji
            @endru
          </li>
          <li>
            <a class="link" href="https://bunpro.jp/">bunpro.jp</a>
            @ru
              — грамматика
            @en
              — grammar
            @endru
          </li>
          <li>
            <a class="link" href="https://www.lingodeer.com/">lingodeer.com</a>
            @ru
              — мобильное приложение для изучения грамматики
            @en
              — mobile app for studying grammar
            @endru
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

@ru
  <h2 class="mt-12">О самом японском языке</h2>
@endru
@ru
  <p>В ходе изучения языка попалось много разной информации, которую хотелось бы зафиксировать. Эдакий пересказ как в нем все устроено в общих чертах.</p>
@endru

<section>
  <div class="h2">@ru Азбуки @en Syllabaries @endru</div>
  @ru
    <p>Без азбук ничего не прочитать. Катакана в основном для заимствованных слов, хирагана — для всего остального. Запомнить азбуки проще всего с помощью <a class="link" href="{{ path([App\Http\Controllers\JapaneseHiraganaKatakana::class, 'index']) }}">тренажера</a>. Практикуя столбик за столбиком, можно за считанные дни добиться автоматизма чтения слогов.</p>
  @endru
</section>

<section>
  <div class="h2">@ru Ключи (радикалы) @en Radicals @endru</div>
  @ru
    <p>Это составные блоки иероглифов. Они здорово помогают их распознавать.</p>
    <p>Возьмем, например, иероглиф неба <a class="link" href="{{ path([App\Http\Controllers\JapaneseWanikaniKanji::class, 'show'], '空') }}">空</a>. Он состоит из следующих ключей: <a class="link" href="{{ path([App\Http\Controllers\JapaneseWanikaniRadicals::class, 'show'], 'construction') }}">工</a>, <a class="link" href="{{ path([App\Http\Controllers\JapaneseWanikaniRadicals::class, 'show'], 'legs') }}">儿</a> и <a class="link" href="{{ path([App\Http\Controllers\JapaneseWanikaniRadicals::class, 'show'], 'helmet') }}">宀</a>.</p>
    <p>Зная хотя бы один ключ, можно найти даже самый заковыристый иероглиф.</p>
  @endru
</section>

<section>
  <div class="h2">@ru Кандзи (иероглифы) @en Kanji @endru</div>
  @ru
    <p>Иероглифы состоят из ключей, коих официально <a class="link" href="https://en.wikipedia.org/wiki/List_of_kanji_radicals_by_stroke_count">214 штук</a>. Приятный бонус в том, что ключи одни и те же как для японского, так и для китайского. И иероглифы общие. Чтение только разное.</p>
    <p>У кандзи может быть несколько чтений: китайского происхождения и японского. Если в слове присутствует хирагана「生きる」, то чтение почти наверняка будет японское. Если слово состоит только из иероглифов「公用」(без символов азбуки хираганы), то чтение с большой вероятностью будет китайское. Почему с вероятностью? Потому что бывают исключения. И чтение каждого типа не обязательно одно — бывает и по три!</p>
    <p>Знать кандзи — не обязательно значит знать слово. Слово может состоять из нескольких кандзи. Или чтение может отличаться между одинаковыми на вид кандзи и словом.「生」в качестве кандзи значит «жизнь» и читается「せい」. Этот же символ「生」в качестве словарного слова значит «свежий» и читается「なま」. Да, запоминать нужно много всего.</p>
    <p>Нафига две азбуки и еще и иероглифы? Компенсируют отсутствие пробела, подсказывают границы слов. Рассмотрим на примере предложения: «Сколько нам нужно автобусов?».</p>
    <ol>
      <li>
        <div class="text-xl">ばすはなんだいいりますか。</div>
        <div>Все хираганой. Как минимум нужно знать слова, грамматику и контекст, чтобы понять смысл.</div>
      </li>
      <li class="mt-2">
        <div class="text-xl">バスはなんだいいりますか。</div>
        <div>Добавим катакану. Стал виден заимствованный автобус «басу». Неплохо для начала.</div>
      </li>
      <li class="mt-2">
        <div class="text-xl">バスは何台いりますか。</div>
        <div>Добавим иероглифы. Проявился вопрос «сколько штук».</div>
      </li>
      <li class="mt-2">
        <div class="inline-flex text-xl">
          <span class="mr-2">バス</span>
          <span class="mr-2">は</span>
          <span class="mr-2">何台</span>
          <span class="mr-2">いり</span>
          <span class="mr-2">ます</span>
          か。
        </div>
        <div>В идеале хотелось бы так, но нет. Может решатся когда-нибудь упростить письменность, как корейцы.</div>
      </li>
    </ol>
  @endru
</section>
@endsection
