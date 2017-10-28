<?php \Breadcrumbs::push(trans('life.japanese')); ?>

@extends('life.base', [
  'meta_title' => trans('life.japanese'),
])

{{--
https://en.wikipedia.org/wiki/List_of_kanji_by_concept
--}}

@section('content')
<h2 class="mt-0">{{ trans('life.japanese') }}</h2>
@ru
  <p>В ходе изучения языка попалось много разной информации, которую хотелось бы зафиксировать. Эдакий пересказ как в нем все устроено в общих чертах.</p>
@endru

@ru
  <p class="mb-2">Полезные ресурсы. Все на английском, так как на нем материалов доступно в разы больше, чем на родном.</p>
@en
  <p class="mb-2">Useful resources:</p>
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

<section>
  <div class="h2">@ru Азбуки @en Syllabaries @endru</div>
  @ru
    <p>Без азбук ничего не прочитать. Катакана в основном для заимствованных слов, хирагана — для всего остального.</p>
  @endru
</section>

<div class="row mt-4">
  <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
    @ru
      <h3>Катакана</h3>
      <p><a class="link" href="http://www.tofugu.com/japanese/learn-katakana/">Ассоциации</a>.</p>
    @en
      <h3>Katakana</h3>
      <p><a class="link" href="http://www.tofugu.com/japanese/learn-katakana/">How to learn</a>.</p>
    @endru
    <table class="table-stats text-center">
      <tr>
        <td>
          <div class="f28">ア</div>
          <div class="text-muted">@ru а @en a @endru</div>
        </td>
        <td>
          <div class="f28">イ</div>
          <div class="text-muted">@ru и @en i @endru</div>
        </td>
        <td>
          <div class="f28">ウ</div>
          <div class="text-muted">@ru у @en u @endru</div>
        </td>
        <td>
          <div class="f28">エ</div>
          <div class="text-muted">@ru э @en e @endru</div>
        </td>
        <td>
          <div class="f28">オ</div>
          <div class="text-muted">@ru о @en o @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">カ</div>
          <div class="text-muted">@ru ка @en ka @endru</div>
        </td>
        <td>
          <div class="f28">キ</div>
          <div class="text-muted">@ru ки @en ki @endru</div>
        </td>
        <td>
          <div class="f28">ク</div>
          <div class="text-muted">@ru ку @en ku @endru</div>
        </td>
        <td>
          <div class="f28">ケ</div>
          <div class="text-muted">@ru кэ @en ke @endru</div>
        </td>
        <td>
          <div class="f28">コ</div>
          <div class="text-muted">@ru ко @en ko @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">サ</div>
          <div class="text-muted">@ru са @en sa @endru</div>
        </td>
        <td>
          <div class="f28">シ</div>
          <div class="text-muted">@ru си @en s[h]i @endru</div>
        </td>
        <td>
          <div class="f28">ス</div>
          <div class="text-muted">@ru су @en su @endru</div>
        </td>
        <td>
          <div class="f28">セ</div>
          <div class="text-muted">@ru сэ @en se @endru</div>
        </td>
        <td>
          <div class="f28">ソ</div>
          <div class="text-muted">@ru со @en so @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">タ</div>
          <div class="text-muted">@ru та @en ta @endru</div>
        </td>
        <td>
          <div class="f28">チ</div>
          <div class="text-muted">@ru ти @en chi @endru</div>
        </td>
        <td>
          <div class="f28">ツ</div>
          <div class="text-muted">@ru цу @en tsu @endru</div>
        </td>
        <td>
          <div class="f28">テ</div>
          <div class="text-muted">@ru тэ @en te @endru</div>
        </td>
        <td>
          <div class="f28">ト</div>
          <div class="text-muted">@ru то @en to @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ナ</div>
          <div class="text-muted">@ru на @en na @endru</div>
        </td>
        <td>
          <div class="f28">ニ</div>
          <div class="text-muted">@ru ни @en ni @endru</div>
        </td>
        <td>
          <div class="f28">ヌ</div>
          <div class="text-muted">@ru ну @en nu @endru</div>
        </td>
        <td>
          <div class="f28">ネ</div>
          <div class="text-muted">@ru нэ @en ne @endru</div>
        </td>
        <td>
          <div class="f28">ノ</div>
          <div class="text-muted">@ru но @en no @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ハ</div>
          <div class="text-muted">@ru ха @en ha @endru</div>
        </td>
        <td>
          <div class="f28">ヒ</div>
          <div class="text-muted">@ru хи @en hi @endru</div>
        </td>
        <td>
          <div class="f28">フ</div>
          <div class="text-muted">@ru фу @en fu @endru</div>
        </td>
        <td>
          <div class="f28">ヘ</div>
          <div class="text-muted">@ru хэ @en he @endru</div>
        </td>
        <td>
          <div class="f28">ホ</div>
          <div class="text-muted">@ru хо @en ho @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">マ</div>
          <div class="text-muted">@ru ма @en ma @endru</div>
        </td>
        <td>
          <div class="f28">ミ</div>
          <div class="text-muted">@ru ми @en mi @endru</div>
        </td>
        <td>
          <div class="f28">ム</div>
          <div class="text-muted">@ru му @en mu @endru</div>
        </td>
        <td>
          <div class="f28">メ</div>
          <div class="text-muted">@ru мэ @en me @endru</div>
        </td>
        <td>
          <div class="f28">モ</div>
          <div class="text-muted">@ru мо @en mo @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ヤ</div>
          <div class="text-muted">@ru я @en ya @endru</div>
        </td>
        <td></td>
        <td>
          <div class="f28">ユ</div>
          <div class="text-muted">@ru ю @en yu @endru</div>
        </td>
        <td></td>
        <td>
          <div class="f28">ヨ</div>
          <div class="text-muted">@ru ё @en yo @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ラ</div>
          <div class="text-muted">@ru ра @en ra @endru</div>
        </td>
        <td>
          <div class="f28">リ</div>
          <div class="text-muted">@ru ри @en ri @endru</div>
        </td>
        <td>
          <div class="f28">ル</div>
          <div class="text-muted">@ru ру @en ru @endru</div>
        </td>
        <td>
          <div class="f28">レ</div>
          <div class="text-muted">@ru рэ @en re @endru</div>
        </td>
        <td>
          <div class="f28">ロ</div>
          <div class="text-muted">@ru ро @en ro @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ワ</div>
          <div class="text-muted">@ru ва @en wa @endru</div>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td>
          <div class="f28">ヲ</div>
          <div class="text-muted">@ru [у]о @en wo @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ン</div>
          <div class="text-muted">@ru н @en n @endru</div>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>
          <div class="f28">ガ</div>
          <div class="text-muted">@ru га @en ga @endru</div>
        </td>
        <td>
          <div class="f28">ギ</div>
          <div class="text-muted">@ru ги @en gi @endru</div>
        </td>
        <td>
          <div class="f28">グ</div>
          <div class="text-muted">@ru гу @en gu @endru</div>
        </td>
        <td>
          <div class="f28">ゲ</div>
          <div class="text-muted">@ru ге @en ge @endru</div>
        </td>
        <td>
          <div class="f28">ゴ</div>
          <div class="text-muted">@ru го @en go @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ザ</div>
          <div class="text-muted">@ru дза @en za @endru</div>
        </td>
        <td>
          <div class="f28">ジ</div>
          <div class="text-muted">@ru дзи @en ji @endru</div>
        </td>
        <td>
          <div class="f28">ズ</div>
          <div class="text-muted">@ru дзу @en zu @endru</div>
        </td>
        <td>
          <div class="f28">ゼ</div>
          <div class="text-muted">@ru дзэ @en ze @endru</div>
        </td>
        <td>
          <div class="f28">ゾ</div>
          <div class="text-muted">@ru дзо @en zo @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ダ</div>
          <div class="text-muted">@ru да @en da @endru</div>
        </td>
        <td>
          <div class="f28">ヂ</div>
          <div class="text-muted">@ru дзи @en ji @endru</div>
        </td>
        <td>
          <div class="f28">ヅ</div>
          <div class="text-muted">@ru дзу @en zu @endru</div>
        </td>
        <td>
          <div class="f28">デ</div>
          <div class="text-muted">@ru дэ @en de @endru</div>
        </td>
        <td>
          <div class="f28">ド</div>
          <div class="text-muted">@ru до @en do @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">バ</div>
          <div class="text-muted">@ru ба @en ba @endru</div>
        </td>
        <td>
          <div class="f28">ビ</div>
          <div class="text-muted">@ru би @en bi @endru</div>
        </td>
        <td>
          <div class="f28">ブ</div>
          <div class="text-muted">@ru бу @en bu @endru</div>
        </td>
        <td>
          <div class="f28">ベ</div>
          <div class="text-muted">@ru бэ @en be @endru</div>
        </td>
        <td>
          <div class="f28">ボ</div>
          <div class="text-muted">@ru бо @en bo @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">パ</div>
          <div class="text-muted">@ru па @en pa @endru</div>
        </td>
        <td>
          <div class="f28">ピ</div>
          <div class="text-muted">@ru пи @en pi @endru</div>
        </td>
        <td>
          <div class="f28">プ</div>
          <div class="text-muted">@ru пу @en pu @endru</div>
        </td>
        <td>
          <div class="f28">ペ</div>
          <div class="text-muted">@ru пэ @en pe @endru</div>
        </td>
        <td>
          <div class="f28">ポ</div>
          <div class="text-muted">@ru по @en po @endru</div>
        </td>
      </tr>
    </table>
  </div>
  <div class="col-lg-6 mb-4">
    @ru
      <h3>Хирагана</h3>
      <p><a class="link" href="http://www.tofugu.com/japanese/learn-hiragana/">Ассоциации</a>.</p>
    @en
      <h3>Hiragana</h3>
      <p><a class="link" href="http://www.tofugu.com/japanese/learn-hiragana/">How to learn</a>.</p>
    @endru
    <table class="table-stats text-center">
      <tr>
        <td>
          <div class="f28">あ</div>
          <div class="text-muted">@ru а @en a @endru</div>
        </td>
        <td>
          <div class="f28">い</div>
          <div class="text-muted">@ru и @en i @endru</div>
        </td>
        <td>
          <div class="f28">う</div>
          <div class="text-muted">@ru у @en u @endru</div>
        </td>
        <td>
          <div class="f28">え</div>
          <div class="text-muted">@ru э @en e @endru</div>
        </td>
        <td>
          <div class="f28">お</div>
          <div class="text-muted">@ru о @en o @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">か</div>
          <div class="text-muted">@ru ка @en ka @endru</div>
        </td>
        <td>
          <div class="f28">き</div>
          <div class="text-muted">@ru ки @en ki @endru</div>
        </td>
        <td>
          <div class="f28">く</div>
          <div class="text-muted">@ru ку @en ku @endru</div>
        </td>
        <td>
          <div class="f28">け</div>
          <div class="text-muted">@ru кэ @en ke @endru</div>
        </td>
        <td>
          <div class="f28">こ</div>
          <div class="text-muted">@ru ко @en ko @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">さ</div>
          <div class="text-muted">@ru са @en sa @endru</div>
        </td>
        <td>
          <div class="f28">し</div>
          <div class="text-muted">@ru си @en s[h]i @endru</div>
        </td>
        <td>
          <div class="f28">す</div>
          <div class="text-muted">@ru су @en su @endru</div>
        </td>
        <td>
          <div class="f28">せ</div>
          <div class="text-muted">@ru сэ @en se @endru</div>
        </td>
        <td>
          <div class="f28">そ</div>
          <div class="text-muted">@ru со @en so @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">た</div>
          <div class="text-muted">@ru та @en ta @endru</div>
        </td>
        <td>
          <div class="f28">ち</div>
          <div class="text-muted">@ru ти @en chi @endru</div>
        </td>
        <td>
          <div class="f28">つ</div>
          <div class="text-muted">@ru цу @en tsu @endru</div>
        </td>
        <td>
          <div class="f28">て</div>
          <div class="text-muted">@ru тэ @en te @endru</div>
        </td>
        <td>
          <div class="f28">と</div>
          <div class="text-muted">@ru то @en to @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">な</div>
          <div class="text-muted">@ru на @en na @endru</div>
        </td>
        <td>
          <div class="f28">に</div>
          <div class="text-muted">@ru ни @en ni @endru</div>
        </td>
        <td>
          <div class="f28">ぬ</div>
          <div class="text-muted">@ru ну @en nu @endru</div>
        </td>
        <td>
          <div class="f28">ね</div>
          <div class="text-muted">@ru нэ @en ne @endru</div>
        </td>
        <td>
          <div class="f28">の</div>
          <div class="text-muted">@ru но @en no @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">は</div>
          <div class="text-muted">@ru ха @en ha @endru</div>
        </td>
        <td>
          <div class="f28">ひ</div>
          <div class="text-muted">@ru хи @en hi @endru</div>
        </td>
        <td>
          <div class="f28">ふ</div>
          <div class="text-muted">@ru фу @en fu @endru</div>
        </td>
        <td>
          <div class="f28">へ</div>
          <div class="text-muted">@ru хэ @en he @endru</div>
        </td>
        <td>
          <div class="f28">ほ</div>
          <div class="text-muted">@ru хо @en ho @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ま</div>
          <div class="text-muted">@ru ма @en ma @endru</div>
        </td>
        <td>
          <div class="f28">み</div>
          <div class="text-muted">@ru ми @en mi @endru</div>
        </td>
        <td>
          <div class="f28">む</div>
          <div class="text-muted">@ru му @en mu @endru</div>
        </td>
        <td>
          <div class="f28">め</div>
          <div class="text-muted">@ru мэ @en me @endru</div>
        </td>
        <td>
          <div class="f28">も</div>
          <div class="text-muted">@ru мо @en mo @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">や</div>
          <div class="text-muted">@ru я @en ya @endru</div>
        </td>
        <td></td>
        <td>
          <div class="f28">ゆ</div>
          <div class="text-muted">@ru ю @en yu @endru</div>
        </td>
        <td></td>
        <td>
          <div class="f28">よ</div>
          <div class="text-muted">@ru ё @en yo @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ら</div>
          <div class="text-muted">@ru ра @en ra @endru</div>
        </td>
        <td>
          <div class="f28">り</div>
          <div class="text-muted">@ru ри @en ri @endru</div>
        </td>
        <td>
          <div class="f28">る</div>
          <div class="text-muted">@ru ру @en ru @endru</div>
        </td>
        <td>
          <div class="f28">れ</div>
          <div class="text-muted">@ru рэ @en re @endru</div>
        </td>
        <td>
          <div class="f28">ろ</div>
          <div class="text-muted">@ru ро @en ro @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">わ</div>
          <div class="text-muted">@ru ва @en wa @endru</div>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td>
          <div class="f28">を</div>
          <div class="text-muted">@ru [у]о @en wo @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ん</div>
          <div class="text-muted">@ru н @en n @endru</div>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>
          <div class="f28">が</div>
          <div class="text-muted">@ru га @en ga @endru</div>
        </td>
        <td>
          <div class="f28">ぎ</div>
          <div class="text-muted">@ru ги @en gi @endru</div>
        </td>
        <td>
          <div class="f28">ぐ</div>
          <div class="text-muted">@ru гу @en gu @endru</div>
        </td>
        <td>
          <div class="f28">げ</div>
          <div class="text-muted">@ru ге @en ge @endru</div>
        </td>
        <td>
          <div class="f28">ご</div>
          <div class="text-muted">@ru го @en go @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ざ</div>
          <div class="text-muted">@ru дза @en za @endru</div>
        </td>
        <td>
          <div class="f28">じ</div>
          <div class="text-muted">@ru дзи @en ji @endru</div>
        </td>
        <td>
          <div class="f28">ず</div>
          <div class="text-muted">@ru дзу @en zu @endru</div>
        </td>
        <td>
          <div class="f28">ぜ</div>
          <div class="text-muted">@ru дзэ @en ze @endru</div>
        </td>
        <td>
          <div class="f28">ぞ</div>
          <div class="text-muted">@ru дзо @en zo @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">だ</div>
          <div class="text-muted">@ru да @en da @endru</div>
        </td>
        <td>
          <div class="f28">ぢ</div>
          <div class="text-muted">@ru дзи @en ji @endru</div>
        </td>
        <td>
          <div class="f28">づ</div>
          <div class="text-muted">@ru дзу @en zu @endru</div>
        </td>
        <td>
          <div class="f28">で</div>
          <div class="text-muted">@ru дэ @en de @endru</div>
        </td>
        <td>
          <div class="f28">ど</div>
          <div class="text-muted">@ru до @en do @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ば</div>
          <div class="text-muted">@ru ба @en ba @endru</div>
        </td>
        <td>
          <div class="f28">び</div>
          <div class="text-muted">@ru би @en bi @endru</div>
        </td>
        <td>
          <div class="f28">ぶ</div>
          <div class="text-muted">@ru бу @en bu @endru</div>
        </td>
        <td>
          <div class="f28">べ</div>
          <div class="text-muted">@ru бэ @en be @endru</div>
        </td>
        <td>
          <div class="f28">ぼ</div>
          <div class="text-muted">@ru бо @en bo @endru</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ぱ</div>
          <div class="text-muted">@ru па @en pa @endru</div>
        </td>
        <td>
          <div class="f28">ぴ</div>
          <div class="text-muted">@ru пи @en pi @endru</div>
        </td>
        <td>
          <div class="f28">ぷ</div>
          <div class="text-muted">@ru пу @en pu @endru</div>
        </td>
        <td>
          <div class="f28">ぺ</div>
          <div class="text-muted">@ru пэ @en pe @endru</div>
        </td>
        <td>
          <div class="f28">ぽ</div>
          <div class="text-muted">@ru по @en po @endru</div>
        </td>
      </tr>
    </table>
  </div>
</div>

<section>
  <div class="h2">@ru Кандзи (иероглифы) @en Kanji @endru</div>
  @ru
    <p>Иероглифы состоят из ключей, коих <a class="link" href="https://en.wikipedia.org/wiki/List_of_kanji_radicals_by_stroke_count">214 штук</a>. Приятный бонус в том, что ключи одни и те же как для японского, так и для китайского. И иероглифы общие. Чтение только разное.</p>
    <p>У кандзи может быть несколько чтений: китайского происхождения и японского. Если в слове присутствует хирагана「生きる」, то чтение почти наверняка будет японское. Если слово состоит только из иероглифов「公用」(без символов азбуки хираганы), то чтение с большой вероятностью будет китайское. Почему с вероятностью? Потому что бывают исключения. И чтение каждого типа не обязательно одно — бывает и по три!</p>
    <p>Знать кандзи — не обязательно значит знать слово. Слово может состоять из нескольких кандзи. Или чтение может отличаться между одинаковыми на вид кандзи и словом.「生」в качестве кандзи значит «жизнь» и читается「せい」. Этот же символ「生」в качестве словарного слова значит «свежий» и читается「なま」. Да, запоминать нужно много всего.</p>
    <p>Нафига две азбуки и еще и иероглифы? Компенсируют отсутствие пробела, подсказывают границы слов. Рассмотрим на примере предложения: «Сколько нам нужно автобусов?».</p>
    <ol>
      <li>
        <div class="f20">ばすはなんだいいりますか。</div>
        <div>Все хираганой. Как минимум нужно знать слова, грамматику и контекст, чтобы понять смысл.</div>
      </li>
      <li class="mt-2">
        <div class="f20">バスはなんだいいりますか。</div>
        <div>Добавим катакану. Стал виден заимствованный автобус «басу». Неплохо для начала.</div>
      </li>
      <li class="mt-2">
        <div class="f20">バスは何台いりますか。</div>
        <div>Добавим иероглифы. Проявился вопрос «сколько штук».</div>
      </li>
      <li class="mt-2">
        <div class="f20">バス　は　何台　いり　ます　か。</div>
        <div>В идеале хотелось бы так, но нет. Может решатся когда-нибудь упростить письменность, как корейцы.</div>
      </li>
    </ol>
  @endru
</section>

<section>
  <div class="h2">@ru Ключи (радикалы) @en Radicals @endru</div>
  @ru
    <p>Составные блоки иероглифов — здорово помогают их распознавать.</p>
  @endru
  <div class="h3">@ru 1 черта @en 1 stroke @endru</div>
<?php
$glyphs = [[
  'ru' => 'один',
  'en' => 'one',
  'jp' => '一',
], [
  'ru' => 'линия',
  'en' => 'stick',
  'jp' => '丨',
], [
  'ru' => 'точка',
  'en' => 'dot',
  'jp' => '丶',
], [
  'ru' => 'откидная влево',
  'en' => 'slash',
  'jp' => 'ノ',
], [
  'ru' => 'второй',
  'en' => 'second',
  'jp' => '乙',
], [
  'ru' => 'крюк',
  'en' => 'hook',
  'jp' => '亅',
]];
?>
@include('tpl.japanese-glyphs')
</section>

<div class="h3">@ru 2 черты @en 2 strokes @endru</div>
<?php
$glyphs = [[
  'ru' => 'два',
  'en' => 'two',
  'jp' => '二',
], [
  'ru' => 'верхушка',
  'en' => 'lid',
  'jp' => '亠',
], [
  'ru' => 'человек',
  'en' => 'man',
  'jp' => '人',
], [
  'ru' => 'ноги',
  'en' => 'legs',
  'jp' => '儿',
], [
  'ru' => 'входить',
  'en' => 'enter',
  'jp' => '乙',
], [
  'ru' => 'восемь',
  'en' => 'eight',
  'jp' => '亅',
], [
  'ru' => 'рамка',
  'en' => 'inverted box',
  'jp' => '冂',
], [
  'ru' => 'обложка',
  'en' => 'cover',
  'jp' => '冖',
], [
  'ru' => 'лед',
  'en' => 'ice',
  'jp' => '⼎',
], [
  'ru' => 'стол',
  'en' => 'desk',
  'jp' => '⼏',
], [
  'ru' => 'контейнер',
  'en' => 'container',
  'jp' => '⼐',
], [
  'ru' => 'меч',
  'en' => 'sword',
  'jp' => '⼑',
], [
  'ru' => 'сила',
  'en' => 'power',
  'jp' => '⼒',
], [
  'ru' => 'охватывать',
  'en' => 'embrace',
  'jp' => '⼓',
], [
  'ru' => 'ложка',
  'en' => 'spoon',
  'jp' => '⼔',
], [
  'ru' => 'ящик',
  'en' => 'box frame',
  'jp' => '⼕',
], [
  'ru' => 'десять',
  'en' => 'ten',
  'jp' => '⼗',
], [
  'ru' => 'гадать',
  'en' => 'divination',
  'jp' => '⼘',
], [
  'ru' => 'печать',
  'en' => 'seal',
  'jp' => '⼙',
], [
  'ru' => 'обрыв',
  'en' => 'cliff',
  'jp' => '⼚',
], [
  'ru' => 'личный',
  'en' => 'private',
  'jp' => '⼛',
], [
  'ru' => 'еще',
  'en' => 'again',
  'jp' => '⼜',
]];
?>
@include('tpl.japanese-glyphs')

<div class="h3">@ru 3 черты @en 3 strokes @endru</div>
<?php
$glyphs = [[
  'ru' => 'прятать',
  'en' => 'dead',
  'jp' => '⼖',
], [
  'ru' => 'рот',
  'en' => 'mouth',
  'jp' => '⼝',
], [
  'ru' => 'граница',
  'en' => 'enclosure',
  'jp' => '⼞',
], [
  'ru' => 'земля',
  'en' => 'earth',
  'jp' => '⼟',
], [
  'ru' => 'ученый',
  'en' => 'scholar',
  'jp' => '⼠',
], [
  'ru' => 'следовать',
  'en' => 'winter',
  'jp' => '⼡',
], [
  'ru' => 'медленно идти',
  'en' => 'winter variant',
  'jp' => '⼢',
], [
  'ru' => 'вечер',
  'en' => 'evening',
  'jp' => '⼣',
], [
  'ru' => 'большой',
  'en' => 'big',
  'jp' => '⼤',
], [
  'ru' => 'женщина',
  'en' => 'woman',
  'jp' => '⼥',
], [
  'ru' => 'ребенок',
  'en' => 'child',
  'jp' => '⼦',
], [
  'ru' => 'крыша',
  'en' => 'roof',
  'jp' => '⼧',
], [
  'ru' => 'дюйм',
  'en' => 'inch',
  'jp' => '⼨',
], [
  'ru' => 'маленький',
  'en' => 'small',
  'jp' => '⼩',
], [
  'ru' => 'хромой',
  'en' => 'lame',
  'jp' => '⼪',
], [
  'ru' => 'труп',
  'en' => 'corpse',
  'jp' => '⼫',
], [
  'ru' => 'росток',
  'en' => 'sprout',
  'jp' => '⼬',
], [
  'ru' => 'гора',
  'en' => 'mountain',
  'jp' => '⼭',
], [
  'ru' => 'река',
  'en' => 'river',
  'jp' => '川',
], [
  'ru' => 'труд',
  'en' => 'work',
  'jp' => '⼯',
], [
  'ru' => 'свой',
  'en' => 'oneself',
  'jp' => '⼰',
], [
  'ru' => 'платок',
  'en' => 'turban',
  'jp' => '⼱',
], [
  'ru' => 'сухой',
  'en' => 'dry',
  'jp' => '⼲',
], [
  'ru' => 'крохотный',
  'en' => 'short thread',
  'jp' => '⼳',
], [
  'ru' => 'кров',
  'en' => 'dotted cliff',
  'jp' => '⼴',
], [
  'ru' => 'тянуть',
  'en' => 'long stride',
  'jp' => '⼵',
], [
  'ru' => 'две руки',
  'en' => 'two hands',
  'jp' => '⼶',
], [
  'ru' => 'стрелять',
  'en' => 'shoot',
  'jp' => '⼷',
], [
  'ru' => 'лук',
  'en' => 'bow',
  'jp' => '⼸',
], [
  'ru' => 'свиная голова',
  'en' => "pig's head",
  'jp' => '⼹',
], [
  'ru' => 'борода',
  'en' => 'hair',
  'jp' => '⼺',
], [
  'ru' => 'шаг',
  'en' => 'step',
  'jp' => '⼻',
], [
  'ru' => 'трава',
  'en' => 'grass',
  'jp' => '⾋',
], [
  'ru' => 'гулять',
  'en' => 'walk',
  'jp' => '⾡',
], [
  'ru' => 'город',
  'en' => 'town',
  'jp' => '⾢',
], [
  'ru' => 'курган',
  'en' => 'mound',
  'jp' => '⾩',
]];
?>
@include('tpl.japanese-glyphs')

<div class="h3">@ru 13 черт @en 13 strokes @endru</div>
<?php
$glyphs = [[
  'ru' => 'лягушка',
  'en' => 'frog',
  'jp' => '⿌',
], [
  'ru' => 'треножник',
  'en' => 'tripod',
  'jp' => '⿍',
], [
  'ru' => 'барабан',
  'en' => 'drum',
  'jp' => '⿎',
], [
  'ru' => 'крыса',
  'en' => 'rat',
  'jp' => '⿏',
]];
?>
@include('tpl.japanese-glyphs')

<div class="h3">@ru 14 черт @en 14 strokes @endru</div>
<?php
$glyphs = [[
  'ru' => 'нос',
  'en' => 'nose',
  'jp' => '⿐',
], [
  'ru' => 'равномерный',
  'en' => 'even',
  'jp' => '⿑',
]];
?>
@include('tpl.japanese-glyphs')

<div class="h3">@ru 17 черт @en 17 strokes @endru</div>
<?php
$glyphs = [[
  'ru' => 'флейта',
  'en' => 'flute',
  'jp' => '⿕',
]];
?>
@include('tpl.japanese-glyphs')

@ru
@en
  <p><a class="link" href="https://en.wikipedia.org/wiki/List_of_kanji_radicals_by_stroke_count">Full list of radicals</a>.</p>
@endru

<section>
  <div class="h2">@ru Словарь @en Dictionary @endru</div>
<?php
$glyphs = [[
  'ru' => 'да',
  'en' => 'yes',
  'jp' => 'はい',
], [
  'ru' => 'иена',
  'en' => 'yen',
  'jp' => ['円' => 'えん'],
], [
  'ru' => 'лево',
  'en' => 'left',
  'jp' => ['左' => 'ひがり'],
], [
  'ru' => 'право',
  'en' => 'right',
  'jp' => ['右' => 'みぎ'],
]];
?>
@include('tpl.japanese-glyphs')
</section>

<div class="h2">@ru Поезд @en Train @endru</div>
<?php
$glyphs = [[
  'ru' => 'вокзал',
  'en' => 'railway station',
  'jp' => ['駅' => 'えき'],
], [
  'ru' => 'камера хранения',
  'en' => 'baggage room',
  'jp' => ['預' => 'あず', 'かり' => '', '所' => 'しょ'],
], [
  'ru' => 'платформа',
  'en' => 'platform',
  'jp' => 'ホーム',
], [
  'ru' => 'электропоезд',
  'en' => 'electric train',
  'jp' => ['電車' => 'でんしゃ'],
]];
?>
@include('tpl.japanese-glyphs')

<div class="h2">@ru Числа @en Numbers @endru</div>
<?php
$glyphs = [[
  'ru' => 'ноль',
  'en' => 'zero',
  'jp' => ['〇' => 'れい'],
], [
  'ru' => 'один',
  'en' => 'one',
  'jp' => ['一' => 'いち'],
], [
  'ru' => 'два',
  'en' => 'two',
  'jp' => ['二' => 'に'],
], [
  'ru' => 'три',
  'en' => 'three',
  'jp' => ['三' => 'さん'],
], [
  'ru' => 'четыре',
  'en' => 'four',
  'jp' => ['四' => 'よん'],
], [
  'ru' => 'пять',
  'en' => 'five',
  'jp' => ['五' => 'ご'],
], [
  'ru' => 'шесть',
  'en' => 'six',
  'jp' => ['六' => 'ろく'],
], [
  'ru' => 'семь',
  'en' => 'seven',
  'jp' => ['七' => 'なな'],
], [
  'ru' => 'восемь',
  'en' => 'eight',
  'jp' => ['八' => 'はち'],
], [
  'ru' => 'девять',
  'en' => 'nine',
  'jp' => ['九' => 'きゅう'],
], [
  'ru' => 'десять',
  'en' => 'ten',
  'jp' => ['十' => 'じゅう'],
], [
  'ru' => 'одиннадцать',
  'en' => 'eleven',
  'jp' => ['十一' => 'じゅういち'],
], [
  'ru' => 'двадцать',
  'en' => 'twenty',
  'jp' => ['二十' => 'にじゅう'],
], [
  'ru' => 'сто',
  'en' => 'hundred',
  'jp' => ['百' => 'ひゃく'],
], [
  'ru' => 'тысяча',
  'en' => 'thousand',
  'jp' => ['千' => 'せん'],
], [
  'ru' => '10 тысяч',
  'en' => 'ten thousand',
  'jp' => ['万' => 'まん'],
], [
  'ru' => 'миллион',
  'en' => 'million',
  'jp' => ['百万' => 'ひゃくまん'],
]];
?>
@include('tpl.japanese-glyphs')

<div class="h2">@ru Цвета @en Colors @endru</div>
<?php
$glyphs = [[
  'ru' => 'белый',
  'en' => 'white',
  'jp' => ['白' => 'しろ'],
], [
  'ru' => 'синий',
  'en' => 'blue',
  'jp' => ['青' => 'あお'],
], [
  'ru' => 'красный',
  'en' => 'red',
  'jp' => ['赤' => 'あか'],
], [
  'ru' => 'черный',
  'en' => 'black',
  'jp' => ['黒' => 'くろ'],
]];
?>
@include('tpl.japanese-glyphs')

<div class="h2">@ru Приветствия и другие выражения @en Greetings and other expressions @endru</div>
<?php
$glyphs = [[
  'ru' => 'извините (обращение)',
  'en' => 'excuse me',
  'jp' => 'すみません',
],[
  'ru' => 'доброе утро',
  'en' => 'good morning',
  'jp' => 'おはようございます',
], [
  'ru' => 'добрый день',
  'en' => 'good afternoon',
  'jp' => 'こんにちは',
], [
  'ru' => 'добрый вечер',
  'en' => 'good afternoon',
  'jp' => 'こんばんは',
], [
  'ru' => 'как поживаете?',
  'en' => 'how are you?',
  'jp' => ['お' => '', '元気' => 'げんき', 'ですか' => ''],
], [
  'ru' => 'привет',
  'en' => 'hello',
  'jp' => 'やあ',
], [
  'ru' => 'до свидания',
  'en' => 'goodbye',
  'jp' => 'さようなら',
], [
  'ru' => 'пока',
  'en' => 'bye',
  'jp' => 'またね',
], [
  'ru' => 'счастливо',
  'en' => 'good luck',
  'jp' => ['お' => '', '元気' => 'げんき', 'で' => ''],
], [
  'ru' => 'удачи',
  'en' => 'good luck',
  'jp' => ['成功' => 'せいこう'],
]];
?>
@include('tpl.japanese-glyphs')

<div class="h2">@ru Дни недели @en Weekdays @endru</div>
<?php
$glyphs = [[
  'ru' => 'понедельник',
  'en' => 'monday',
  'jp' => ['月曜日' => 'げつようび'],
], [
  'ru' => 'вторник',
  'en' => 'tuesday',
  'jp' => ['火曜日' => 'かようび'],
], [
  'ru' => 'среда',
  'en' => 'wednesday',
  'jp' => ['水曜日' => 'すいようび'],
], [
  'ru' => 'четверг',
  'en' => 'thursday',
  'jp' => ['木曜日' => 'もくようび'],
], [
  'ru' => 'пятница',
  'en' => 'friday',
  'jp' => ['金曜日' => 'きんようび'],
], [
  'ru' => 'суббота',
  'en' => 'saturday',
  'jp' => ['土曜日' => 'どようび'],
], [
  'ru' => 'воскресенье',
  'en' => 'sunday',
  'jp' => ['日曜日' => 'にちようび'],
]];
?>
@include('tpl.japanese-glyphs')
@endsection
