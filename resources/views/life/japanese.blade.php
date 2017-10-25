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
  <p>Полезные ресурсы:</p>
@en
  <p>Useful resources:</p>
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

<div class="row mt-4">
  <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
    @ru
      <h3>Азбука катакана</h3>
      <p><a class="link" href="http://www.tofugu.com/japanese/learn-katakana/">Ассоциации</a>.</p>
    @en
      <h3>Katakana syllabary</h3>
      <p><a class="link" href="http://www.tofugu.com/japanese/learn-katakana/">How to learn</a>.</p>
    @endru
    <table class="table-stats text-center">
      <tr>
        <td>
          <div class="f28">ア</div>
          @ru а @en a @endru
        </td>
        <td>
          <div class="f28">イ</div>
          @ru и @en i @endru
        </td>
        <td>
          <div class="f28">ウ</div>
          @ru у @en u @endru
        </td>
        <td>
          <div class="f28">エ</div>
          @ru э @en e @endru
        </td>
        <td>
          <div class="f28">オ</div>
          @ru о @en o @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">カ</div>
          @ru ка @en ka @endru
        </td>
        <td>
          <div class="f28">キ</div>
          @ru ки @en ki @endru
        </td>
        <td>
          <div class="f28">ク</div>
          @ru ку @en ku @endru
        </td>
        <td>
          <div class="f28">ケ</div>
          @ru кэ @en ke @endru
        </td>
        <td>
          <div class="f28">コ</div>
          @ru ко @en ko @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">サ</div>
          @ru са @en sa @endru
        </td>
        <td>
          <div class="f28">シ</div>
          @ru си @en s[h]i @endru
        </td>
        <td>
          <div class="f28">ス</div>
          @ru су @en su @endru
        </td>
        <td>
          <div class="f28">セ</div>
          @ru сэ @en se @endru
        </td>
        <td>
          <div class="f28">ソ</div>
          @ru со @en so @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">タ</div>
          @ru та @en ta @endru
        </td>
        <td>
          <div class="f28">チ</div>
          @ru ти @en chi @endru
        </td>
        <td>
          <div class="f28">ツ</div>
          @ru цу @en tsu @endru
        </td>
        <td>
          <div class="f28">テ</div>
          @ru тэ @en te @endru
        </td>
        <td>
          <div class="f28">ト</div>
          @ru то @en to @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ナ</div>
          @ru на @en na @endru
        </td>
        <td>
          <div class="f28">ニ</div>
          @ru ни @en ni @endru
        </td>
        <td>
          <div class="f28">ヌ</div>
          @ru ну @en nu @endru
        </td>
        <td>
          <div class="f28">ネ</div>
          @ru нэ @en ne @endru
        </td>
        <td>
          <div class="f28">ノ</div>
          @ru но @en no @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ハ</div>
          @ru ха @en ha @endru
        </td>
        <td>
          <div class="f28">ヒ</div>
          @ru хи @en hi @endru
        </td>
        <td>
          <div class="f28">フ</div>
          @ru фу @en fu @endru
        </td>
        <td>
          <div class="f28">ヘ</div>
          @ru хэ @en he @endru
        </td>
        <td>
          <div class="f28">ホ</div>
          @ru хо @en ho @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">マ</div>
          @ru ма @en ma @endru
        </td>
        <td>
          <div class="f28">ミ</div>
          @ru ми @en mi @endru
        </td>
        <td>
          <div class="f28">ム</div>
          @ru му @en mu @endru
        </td>
        <td>
          <div class="f28">メ</div>
          @ru мэ @en me @endru
        </td>
        <td>
          <div class="f28">モ</div>
          @ru мо @en mo @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ヤ</div>
          @ru я @en ya @endru
        </td>
        <td></td>
        <td>
          <div class="f28">ユ</div>
          @ru ю @en yu @endru
        </td>
        <td></td>
        <td>
          <div class="f28">ヨ</div>
          @ru ё @en yo @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ラ</div>
          @ru ра @en ra @endru
        </td>
        <td>
          <div class="f28">リ</div>
          @ru ри @en ri @endru
        </td>
        <td>
          <div class="f28">ル</div>
          @ru ру @en ru @endru
        </td>
        <td>
          <div class="f28">レ</div>
          @ru рэ @en re @endru
        </td>
        <td>
          <div class="f28">ロ</div>
          @ru ро @en ro @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ワ</div>
          @ru ва @en wa @endru
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td>
          <div class="f28">ヲ</div>
          @ru [у]о @en wo @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ン</div>
          @ru н @en n @endru
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>
          <div class="f28">ガ</div>
          @ru га @en ga @endru
        </td>
        <td>
          <div class="f28">ギ</div>
          @ru ги @en gi @endru
        </td>
        <td>
          <div class="f28">グ</div>
          @ru гу @en gu @endru
        </td>
        <td>
          <div class="f28">ゲ</div>
          @ru ге @en ge @endru
        </td>
        <td>
          <div class="f28">ゴ</div>
          @ru го @en go @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ザ</div>
          @ru дза @en za @endru
        </td>
        <td>
          <div class="f28">ジ</div>
          @ru дзи @en ji @endru
        </td>
        <td>
          <div class="f28">ズ</div>
          @ru дзу @en zu @endru
        </td>
        <td>
          <div class="f28">ゼ</div>
          @ru дзэ @en ze @endru
        </td>
        <td>
          <div class="f28">ゾ</div>
          @ru дзо @en zo @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ダ</div>
          @ru да @en da @endru
        </td>
        <td>
          <div class="f28">ヂ</div>
          @ru дзи @en ji @endru
        </td>
        <td>
          <div class="f28">ヅ</div>
          @ru дзу @en zu @endru
        </td>
        <td>
          <div class="f28">デ</div>
          @ru дэ @en de @endru
        </td>
        <td>
          <div class="f28">ド</div>
          @ru до @en do @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">バ</div>
          @ru ба @en ba @endru
        </td>
        <td>
          <div class="f28">ビ</div>
          @ru би @en bi @endru
        </td>
        <td>
          <div class="f28">ブ</div>
          @ru бу @en bu @endru
        </td>
        <td>
          <div class="f28">ベ</div>
          @ru бэ @en be @endru
        </td>
        <td>
          <div class="f28">ボ</div>
          @ru бо @en bo @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">パ</div>
          @ru па @en pa @endru
        </td>
        <td>
          <div class="f28">ピ</div>
          @ru пи @en pi @endru
        </td>
        <td>
          <div class="f28">プ</div>
          @ru пу @en pu @endru
        </td>
        <td>
          <div class="f28">ペ</div>
          @ru пэ @en pe @endru
        </td>
        <td>
          <div class="f28">ポ</div>
          @ru по @en po @endru
        </td>
      </tr>
    </table>
  </div>
  <div class="col-lg-6 mb-4">
    @ru
      <h3>Азбука хирагана</h3>
      <p><a class="link" href="http://www.tofugu.com/japanese/learn-hiragana/">Ассоциации</a>.</p>
    @en
      <h3>Hiragana syllabary</h3>
      <p><a class="link" href="http://www.tofugu.com/japanese/learn-hiragana/">How to learn</a>.</p>
    @endru
    <table class="table-stats text-center">
      <tr>
        <td>
          <div class="f28">あ</div>
          @ru а @en a @endru
        </td>
        <td>
          <div class="f28">い</div>
          @ru и @en i @endru
        </td>
        <td>
          <div class="f28">う</div>
          @ru у @en u @endru
        </td>
        <td>
          <div class="f28">え</div>
          @ru э @en e @endru
        </td>
        <td>
          <div class="f28">お</div>
          @ru о @en o @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">か</div>
          @ru ка @en ka @endru
        </td>
        <td>
          <div class="f28">き</div>
          @ru ки @en ki @endru
        </td>
        <td>
          <div class="f28">く</div>
          @ru ку @en ku @endru
        </td>
        <td>
          <div class="f28">け</div>
          @ru кэ @en ke @endru
        </td>
        <td>
          <div class="f28">こ</div>
          @ru ко @en ko @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">さ</div>
          @ru са @en sa @endru
        </td>
        <td>
          <div class="f28">し</div>
          @ru си @en s[h]i @endru
        </td>
        <td>
          <div class="f28">す</div>
          @ru су @en su @endru
        </td>
        <td>
          <div class="f28">せ</div>
          @ru сэ @en se @endru
        </td>
        <td>
          <div class="f28">そ</div>
          @ru со @en so @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">た</div>
          @ru та @en ta @endru
        </td>
        <td>
          <div class="f28">ち</div>
          @ru ти @en chi @endru
        </td>
        <td>
          <div class="f28">つ</div>
          @ru цу @en tsu @endru
        </td>
        <td>
          <div class="f28">て</div>
          @ru тэ @en te @endru
        </td>
        <td>
          <div class="f28">と</div>
          @ru то @en to @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">な</div>
          @ru на @en na @endru
        </td>
        <td>
          <div class="f28">に</div>
          @ru ни @en ni @endru
        </td>
        <td>
          <div class="f28">ぬ</div>
          @ru ну @en nu @endru
        </td>
        <td>
          <div class="f28">ね</div>
          @ru нэ @en ne @endru
        </td>
        <td>
          <div class="f28">の</div>
          @ru но @en no @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">は</div>
          @ru ха @en ha @endru
        </td>
        <td>
          <div class="f28">ひ</div>
          @ru хи @en hi @endru
        </td>
        <td>
          <div class="f28">ふ</div>
          @ru фу @en fu @endru
        </td>
        <td>
          <div class="f28">へ</div>
          @ru хэ @en he @endru
        </td>
        <td>
          <div class="f28">ほ</div>
          @ru хо @en ho @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ま</div>
          @ru ма @en ma @endru
        </td>
        <td>
          <div class="f28">み</div>
          @ru ми @en mi @endru
        </td>
        <td>
          <div class="f28">む</div>
          @ru му @en mu @endru
        </td>
        <td>
          <div class="f28">め</div>
          @ru мэ @en me @endru
        </td>
        <td>
          <div class="f28">も</div>
          @ru мо @en mo @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">や</div>
          @ru я @en ya @endru
        </td>
        <td></td>
        <td>
          <div class="f28">ゆ</div>
          @ru ю @en yu @endru
        </td>
        <td></td>
        <td>
          <div class="f28">よ</div>
          @ru ё @en yo @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ら</div>
          @ru ра @en ra @endru
        </td>
        <td>
          <div class="f28">り</div>
          @ru ри @en ri @endru
        </td>
        <td>
          <div class="f28">る</div>
          @ru ру @en ru @endru
        </td>
        <td>
          <div class="f28">れ</div>
          @ru рэ @en re @endru
        </td>
        <td>
          <div class="f28">ろ</div>
          @ru ро @en ro @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">わ</div>
          @ru ва @en wa @endru
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td>
          <div class="f28">を</div>
          @ru [у]о @en wo @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ん</div>
          @ru н @en n @endru
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>
          <div class="f28">が</div>
          @ru га @en ga @endru
        </td>
        <td>
          <div class="f28">ぎ</div>
          @ru ги @en gi @endru
        </td>
        <td>
          <div class="f28">ぐ</div>
          @ru гу @en gu @endru
        </td>
        <td>
          <div class="f28">げ</div>
          @ru ге @en ge @endru
        </td>
        <td>
          <div class="f28">ご</div>
          @ru го @en go @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ざ</div>
          @ru дза @en za @endru
        </td>
        <td>
          <div class="f28">じ</div>
          @ru дзи @en ji @endru
        </td>
        <td>
          <div class="f28">ず</div>
          @ru дзу @en zu @endru
        </td>
        <td>
          <div class="f28">ぜ</div>
          @ru дзэ @en ze @endru
        </td>
        <td>
          <div class="f28">ぞ</div>
          @ru дзо @en zo @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">だ</div>
          @ru да @en da @endru
        </td>
        <td>
          <div class="f28">ぢ</div>
          @ru дзи @en ji @endru
        </td>
        <td>
          <div class="f28">づ</div>
          @ru дзу @en zu @endru
        </td>
        <td>
          <div class="f28">で</div>
          @ru дэ @en de @endru
        </td>
        <td>
          <div class="f28">ど</div>
          @ru до @en do @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ば</div>
          @ru ба @en ba @endru
        </td>
        <td>
          <div class="f28">び</div>
          @ru би @en bi @endru
        </td>
        <td>
          <div class="f28">ぶ</div>
          @ru бу @en bu @endru
        </td>
        <td>
          <div class="f28">べ</div>
          @ru бэ @en be @endru
        </td>
        <td>
          <div class="f28">ぼ</div>
          @ru бо @en bo @endru
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ぱ</div>
          @ru па @en pa @endru
        </td>
        <td>
          <div class="f28">ぴ</div>
          @ru пи @en pi @endru
        </td>
        <td>
          <div class="f28">ぷ</div>
          @ru пу @en pu @endru
        </td>
        <td>
          <div class="f28">ぺ</div>
          @ru пэ @en pe @endru
        </td>
        <td>
          <div class="f28">ぽ</div>
          @ru по @en po @endru
        </td>
      </tr>
    </table>
  </div>
</div>

<h4>@ru Ёон @en Yōon @endru</h4>
<div class="row">
  <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
    <table class="table-stats text-center">
      <tr>
        <td colspan="4">
          @ru катакана @en katakana @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right"></td>
        <td class="thead border-right">
          <div class="f28">ヤ</div>
          @ru я @en ya @endru
        </td>
        <td class="thead border-right">
          <div class="f28">ユ</div>
          @ru ю @en yu @endru
        </td>
        <td class="thead">
          <div class="f28">ヨ</div>
          @ru ё @en yo @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right">
          <div class="f28">キ</div>
          @ru ки @en ki @endru
        </td>
        <td>
          <div class="f28">キャ</div>
          @ru кя @en kya @endru
        </td>
        <td>
          <div class="f28">キュ</div>
          @ru кю @en kyu @endru
        </td>
        <td>
          <div class="f28">キョ</div>
          @ru кё @en kyo @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right">
          <div class="f28">シ</div>
          @ru си @en shi @endru
        </td>
        <td>
          <div class="f28">シャ</div>
          @ru ся @en sha @endru
        </td>
        <td>
          <div class="f28">シュ</div>
          @ru сю @en shu @endru
        </td>
        <td>
          <div class="f28">ショ</div>
          @ru сё @en sho @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right">
          <div class="f28">チ</div>
          @ru ти @en chi @endru
        </td>
        <td>
          <div class="f28">チャ</div>
          @ru тя @en cha @endru
        </td>
        <td>
          <div class="f28">チュ</div>
          @ru тю @en chu @endru
        </td>
        <td>
          <div class="f28">チョ</div>
          @ru тё @en cho @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right">
          <div class="f28">ニ</div>
          @ru ни @en ni @endru
        </td>
        <td>
          <div class="f28">ニャ</div>
          @ru ня @en nya @endru
        </td>
        <td>
          <div class="f28">ニュ</div>
          @ru ню @en nyu @endru
        </td>
        <td>
          <div class="f28">ニョ</div>
          @ru нё @en nyo @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right">
          <div class="f28">ヒ</div>
          @ru хи @en hi @endru
        </td>
        <td>
          <div class="f28">ヒャ</div>
          @ru хя @en hya @endru
        </td>
        <td>
          <div class="f28">ヒュ</div>
          @ru хю @en hyu @endru
        </td>
        <td>
          <div class="f28">ヒョ</div>
          @ru хё @en hyo @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right">
          <div class="f28">ミ</div>
          @ru ми @en mi @endru
        </td>
        <td>
          <div class="f28">ミャ</div>
          @ru мя @en mya @endru
        </td>
        <td>
          <div class="f28">ミュ</div>
          @ru мю @en myu @endru
        </td>
        <td>
          <div class="f28">ミョ</div>
          @ru мё @en myo @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right">
          <div class="f28">リ</div>
          @ru ри @en ri @endru
        </td>
        <td>
          <div class="f28">リャ</div>
          @ru ря @en rya @endru
        </td>
        <td>
          <div class="f28">リュ</div>
          @ru рю @en ryu @endru
        </td>
        <td>
          <div class="f28">リョ</div>
          @ru рё @en ryo @endru
        </td>
      </tr>
      <tr>
        <td colspan="4">
          @ru дакутэн @en dakuten @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right">
          <div class="f28">ギ</div>
          @ru ги @en gi @endru
        </td>
        <td>
          <div class="f28">ギャ</div>
          @ru гя @en gya @endru
        </td>
        <td>
          <div class="f28">ギュ</div>
          @ru гю @en gyu @endru
        </td>
        <td>
          <div class="f28">ギョ</div>
          @ru гё @en gyo @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right">
          <div class="f28">ジ</div>
          @ru дзи @en ji @endru
        </td>
        <td>
          <div class="f28">ジャ</div>
          @ru дзя @en ja @endru
        </td>
        <td>
          <div class="f28">ジュ</div>
          @ru дзю @en ju @endru
        </td>
        <td>
          <div class="f28">ジョ</div>
          @ru дзё @en jo @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right">
          <div class="f28">ビ</div>
          @ru би @en bi @endru
        </td>
        <td>
          <div class="f28">ビャ</div>
          @ru бя @en bya @endru
        </td>
        <td>
          <div class="f28">ビュ</div>
          @ru бю @en byu @endru
        </td>
        <td>
          <div class="f28">ビョ</div>
          @ru бё @en byo @endru
        </td>
      </tr>
      <tr>
        <td colspan="4">
          @ru хандакутэн @en handakuten @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right">
          <div class="f28">ピ</div>
          @ru пи @en pi @endru
        </td>
        <td>
          <div class="f28">ピャ</div>
          @ru пя @en pya @endru
        </td>
        <td>
          <div class="f28">ピュ</div>
          @ru пю @en pyu @endru
        </td>
        <td>
          <div class="f28">ピョ</div>
          @ru пё @en pyo @endru
        </td>
      </tr>
    </table>
  </div>
  <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
    <table class="table-stats text-center">
      <tr>
        <td colspan="4">
          @ru хирагана @en hiragana @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right"></td>
        <td class="thead border-right">
          <div class="f28">や</div>
          @ru я @en ya @endru
        </td>
        <td class="thead border-right">
          <div class="f28">ゆ</div>
          @ru ю @en yu @endru
        </td>
        <td class="thead">
          <div class="f28">よ</div>
          @ru ё @en yo @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right">
          <div class="f28">き</div>
          @ru ки @en ki @endru
        </td>
        <td>
          <div class="f28">きゃ</div>
          @ru кя @en kya @endru
        </td>
        <td>
          <div class="f28">きゅ</div>
          @ru кю @en kyu @endru
        </td>
        <td>
          <div class="f28">きょ</div>
          @ru кё @en kyo @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right">
          <div class="f28">し</div>
          @ru си @en shi @endru
        </td>
        <td>
          <div class="f28">しゃ</div>
          @ru ся @en sha @endru
        </td>
        <td>
          <div class="f28">しゅ</div>
          @ru сю @en shu @endru
        </td>
        <td>
          <div class="f28">しょ</div>
          @ru сё @en sho @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right">
          <div class="f28">ち</div>
          @ru ти @en chi @endru
        </td>
        <td>
          <div class="f28">ちゃ</div>
          @ru тя @en cha @endru
        </td>
        <td>
          <div class="f28">ちゅ</div>
          @ru тю @en chu @endru
        </td>
        <td>
          <div class="f28">ちょ</div>
          @ru тё @en cho @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right">
          <div class="f28">に</div>
          @ru ни @en ni @endru
        </td>
        <td>
          <div class="f28">にゃ</div>
          @ru ня @en nya @endru
        </td>
        <td>
          <div class="f28">にゅ</div>
          @ru ню @en nyu @endru
        </td>
        <td>
          <div class="f28">にょ</div>
          @ru нё @en nyo @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right">
          <div class="f28">ひ</div>
          @ru хи @en hi @endru
        </td>
        <td>
          <div class="f28">ひゃ</div>
          @ru хя @en hya @endru
        </td>
        <td>
          <div class="f28">ひゅ</div>
          @ru хю @en hyu @endru
        </td>
        <td>
          <div class="f28">ひょ</div>
          @ru хё @en hyo @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right">
          <div class="f28">み</div>
          @ru ми @en mi @endru
        </td>
        <td>
          <div class="f28">みゃ</div>
          @ru мя @en mya @endru
        </td>
        <td>
          <div class="f28">みゅ</div>
          @ru мю @en myu @endru
        </td>
        <td>
          <div class="f28">みょ</div>
          @ru мё @en myo @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right">
          <div class="f28">り</div>
          @ru ри @en ri @endru
        </td>
        <td>
          <div class="f28">りゃ</div>
          @ru ря @en rya @endru
        </td>
        <td>
          <div class="f28">りゅ</div>
          @ru рю @en ryu @endru
        </td>
        <td>
          <div class="f28">りょ</div>
          @ru рё @en ryo @endru
        </td>
      </tr>
      <tr>
        <td colspan="4">
          @ru дакутэн @en dakuten @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right">
          <div class="f28">ぎ</div>
          @ru ги @en gi @endru
        </td>
        <td>
          <div class="f28">ぎゃ</div>
          @ru гя @en gya @endru
        </td>
        <td>
          <div class="f28">ぎゅ</div>
          @ru гю @en gyu @endru
        </td>
        <td>
          <div class="f28">ぎょ</div>
          @ru гё @en gyo @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right">
          <div class="f28">じ</div>
          @ru дзи @en ji @endru
        </td>
        <td>
          <div class="f28">じゃ</div>
          @ru дзя @en ja @endru
        </td>
        <td>
          <div class="f28">じゅ</div>
          @ru дзю @en ju @endru
        </td>
        <td>
          <div class="f28">じょ</div>
          @ru дзё @en jo @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right">
          <div class="f28">び</div>
          @ru би @en bi @endru
        </td>
        <td>
          <div class="f28">びゃ</div>
          @ru бя @en bya @endru
        </td>
        <td>
          <div class="f28">びゅ</div>
          @ru бю @en byu @endru
        </td>
        <td>
          <div class="f28">びょ</div>
          @ru бё @en byo @endru
        </td>
      </tr>
      <tr>
        <td colspan="4">
          @ru хандакутэн @en handakuten @endru
        </td>
      </tr>
      <tr>
        <td class="thead border-right">
          <div class="f28">ぴ</div>
          @ru пи @en pi @endru
        </td>
        <td>
          <div class="f28">ぴゃ</div>
          @ru пя @en pya @endru
        </td>
        <td>
          <div class="f28">ぴゅ</div>
          @ru пю @en pyu @endru
        </td>
        <td>
          <div class="f28">ぴょ</div>
          @ru пё @en pyo @endru
        </td>
      </tr>
    </table>
  </div>
</div>

<div class="h2">@ru Ключи (радикалы) @en Radicals @endru</div>
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
  <p><a class="link" href="https://en.wikipedia.org/wiki/List_of_kanji_radicals_by_stroke_count">Полный список ключей</a>.</p>
@en
  <p><a class="link" href="https://en.wikipedia.org/wiki/List_of_kanji_radicals_by_stroke_count">Full list of radicals</a>.</p>
@endru

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
