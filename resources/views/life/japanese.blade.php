<?php \Breadcrumbs::push(trans('life.japanese')); ?>

@extends('life.base', [
  'meta_title' => trans('life.japanese'),
])

@section('content')
<h3 class="mt-0">{{ trans('life.japanese') }}</h3>
<div class="row">
  <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
    @ru
      <h4>Азбука катакана</h4>
    @en
      <h4>Katakana syllabary</h4>
    @endlang
    <table class="table-stats text-center">
      <tr>
        <td>
          <div class="f28">ア</div>
          @ru а @en a @endlang
        </td>
        <td>
          <div class="f28">イ</div>
          @ru и @en i @endlang
        </td>
        <td>
          <div class="f28">ウ</div>
          @ru у @en u @endlang
        </td>
        <td>
          <div class="f28">エ</div>
          @ru э @en e @endlang
        </td>
        <td>
          <div class="f28">オ</div>
          @ru о @en o @endlang
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">カ</div>
          @ru ка @en ka @endlang
        </td>
        <td>
          <div class="f28">キ</div>
          @ru ки @en ki @endlang
        </td>
        <td>
          <div class="f28">ク</div>
          @ru ку @en ku @endlang
        </td>
        <td>
          <div class="f28">ケ</div>
          @ru кэ @en ke @endlang
        </td>
        <td>
          <div class="f28">コ</div>
          @ru ко @en ko @endlang
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">サ</div>
          @ru са @en sa @endlang
        </td>
        <td>
          <div class="f28">シ</div>
          @ru си @en s[h]i @endlang
        </td>
        <td>
          <div class="f28">ス</div>
          @ru су @en su @endlang
        </td>
        <td>
          <div class="f28">セ</div>
          @ru сэ @en se @endlang
        </td>
        <td>
          <div class="f28">ソ</div>
          @ru со @en so @endlang
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">タ</div>
          @ru та @en ta @endlang
        </td>
        <td>
          <div class="f28">チ</div>
          @ru ти @en chi @endlang
        </td>
        <td>
          <div class="f28">ツ</div>
          @ru цу @en tsu @endlang
        </td>
        <td>
          <div class="f28">テ</div>
          @ru тэ @en te @endlang
        </td>
        <td>
          <div class="f28">ト</div>
          @ru то @en to @endlang
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ナ</div>
          @ru на @en na @endlang
        </td>
        <td>
          <div class="f28">ニ</div>
          @ru ни @en ni @endlang
        </td>
        <td>
          <div class="f28">ヌ</div>
          @ru ну @en nu @endlang
        </td>
        <td>
          <div class="f28">ネ</div>
          @ru нэ @en ne @endlang
        </td>
        <td>
          <div class="f28">ノ</div>
          @ru но @en no @endlang
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ハ</div>
          @ru ха @en ha @endlang
        </td>
        <td>
          <div class="f28">ヒ</div>
          @ru хи @en hi @endlang
        </td>
        <td>
          <div class="f28">フ</div>
          @ru фу @en fu @endlang
        </td>
        <td>
          <div class="f28">ヘ</div>
          @ru хэ @en he @endlang
        </td>
        <td>
          <div class="f28">ホ</div>
          @ru хо @en ho @endlang
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">マ</div>
          @ru ма @en ma @endlang
        </td>
        <td>
          <div class="f28">ミ</div>
          @ru ми @en mi @endlang
        </td>
        <td>
          <div class="f28">ム</div>
          @ru му @en mu @endlang
        </td>
        <td>
          <div class="f28">メ</div>
          @ru мэ @en me @endlang
        </td>
        <td>
          <div class="f28">モ</div>
          @ru мо @en mo @endlang
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ヤ</div>
          @ru я @en ya @endlang
        </td>
        <td></td>
        <td>
          <div class="f28">ユ</div>
          @ru ю @en yu @endlang
        </td>
        <td></td>
        <td>
          <div class="f28">ヨ</div>
          @ru ё @en yo @endlang
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ラ</div>
          @ru ра @en ra @endlang
        </td>
        <td>
          <div class="f28">リ</div>
          @ru ри @en ri @endlang
        </td>
        <td>
          <div class="f28">ル</div>
          @ru ру @en ru @endlang
        </td>
        <td>
          <div class="f28">レ</div>
          @ru рэ @en re @endlang
        </td>
        <td>
          <div class="f28">ロ</div>
          @ru ро @en ro @endlang
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ワ</div>
          @ru ва @en wa @endlang
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td>
          <div class="f28">ヲ</div>
          @ru [у]о @en wo @endlang
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">ン</div>
          @ru н @en n @endlang
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </table>
  </div>
  <div class="col-lg-6 mb-4">
    @ru
      <h4>Азбука хирагана</h4>
    @en
      <h4>Hiragana syllabary</h4>
    @endlang
    <table class="table-stats text-center">
      <tr>
        <td>
          <div class="f28">あ</div>
          @ru а @en a @endlang
        </td>
        <td>
          <div class="f28">い</div>
          @ru и @en i @endlang
        </td>
        <td>
          <div class="f28">う</div>
          @ru у @en u @endlang
        </td>
        <td>
          <div class="f28">え</div>
          @ru э @en e @endlang
        </td>
        <td>
          <div class="f28">お</div>
          @ru о @en o @endlang
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">か</div>
          @ru ка @en ka @endlang
        </td>
        <td>
          <div class="f28">き</div>
          @ru ки @en ki @endlang
        </td>
        <td>
          <div class="f28">く</div>
          @ru ку @en ku @endlang
        </td>
        <td>
          <div class="f28">け</div>
          @ru кэ @en ke @endlang
        </td>
        <td>
          <div class="f28">こ</div>
          @ru ко @en ko @endlang
        </td>
      </tr>
      <tr>
        <td>
          <div class="f28">さ</div>
          @ru са @en sa @endlang
        </td>
        <td>
          <div class="f28">し</div>
          @ru си @en s[h]i @endlang
        </td>
        <td>
          <div class="f28">す</div>
          @ru су @en su @endlang
        </td>
        <td>
          <div class="f28">せ</div>
          @ru сэ @en se @endlang
        </td>
        <td>
          <div class="f28">そ</div>
          @ru со @en so @endlang
        </td>
      </tr>

      <tr>
        <td>
          <div class="f28">た</div>
          @ru та @en ta @endlang
        </td>
        <td>
          <div class="f28">ち</div>
          @ru ти @en chi @endlang
        </td>
        <td>
          <div class="f28">つ</div>
          @ru цу @en tu @endlang
        </td>
        <td>
          <div class="f28">て</div>
          @ru тэ @en te @endlang
        </td>
        <td>
          <div class="f28">と</div>
          @ru то @en to @endlang
        </td>
      </tr>

      <tr>
        <td>
          <div class="f28">な</div>
          @ru на @en na @endlang
        </td>
        <td>
          <div class="f28">に</div>
          @ru ни @en ni @endlang
        </td>
        <td>
          <div class="f28">ぬ</div>
          @ru ну @en nu @endlang
        </td>
        <td>
          <div class="f28">ね</div>
          @ru нэ @en ne @endlang
        </td>
        <td>
          <div class="f28">の</div>
          @ru но @en no @endlang
        </td>
      </tr>

      <tr>
        <td>
          <div class="f28">は</div>
          @ru ха @en ha @endlang
        </td>
        <td>
          <div class="f28">ひ</div>
          @ru хи @en hi @endlang
        </td>
        <td>
          <div class="f28">ふ</div>
          @ru фу @en fu @endlang
        </td>
        <td>
          <div class="f28">へ</div>
          @ru хэ @en he @endlang
        </td>
        <td>
          <div class="f28">ほ</div>
          @ru хо @en ho @endlang
        </td>
      </tr>

      <tr>
        <td>
          <div class="f28">ま</div>
          @ru ма @en ma @endlang
        </td>
        <td>
          <div class="f28">み</div>
          @ru ми @en mi @endlang
        </td>
        <td>
          <div class="f28">む</div>
          @ru му @en mu @endlang
        </td>
        <td>
          <div class="f28">め</div>
          @ru мэ @en me @endlang
        </td>
        <td>
          <div class="f28">も</div>
          @ru мо @en mo @endlang
        </td>
      </tr>

      <tr>
        <td>
          <div class="f28">や</div>
          @ru я @en ya @endlang
        </td>
        <td></td>
        <td>
          <div class="f28">ゆ</div>
          @ru ю @en yu @endlang
        </td>
        <td></td>
        <td>
          <div class="f28">よ</div>
          @ru ё @en yo @endlang
        </td>
      </tr>

      <tr>
        <td>
          <div class="f28">ら</div>
          @ru ра @en ra @endlang
        </td>
        <td>
          <div class="f28">り</div>
          @ru ри @en ri @endlang
        </td>
        <td>
          <div class="f28">る</div>
          @ru ру @en ru @endlang
        </td>
        <td>
          <div class="f28">れ</div>
          @ru рэ @en re @endlang
        </td>
        <td>
          <div class="f28">ろ</div>
          @ru ро @en ro @endlang
        </td>
      </tr>

      <tr>
        <td>
          <div class="f28">わ</div>
          @ru ва @en wa @endlang
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td>
          <div class="f28">を</div>
          @ru [у]о @en wo @endlang
        </td>
      </tr>

      <tr>
        <td>
          <div class="f28">ん</div>
          @ru н @en n @endlang
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </table>
  </div>
</div>

@ru
  <h3>53. Поезд</h3>
@en
  <h3>53. Train</h3>
@endlang
<?php
$glyphs = [[
  'ru' => 'вокзал',
  'en' => 'railway station',
  'phonetic' => 'eki',
  'jp' => '駅',
], [
  'ru' => 'камера хранения',
  'en' => 'baggage room',
  'phonetic' => 'azukarisho',
  'jp' => '預かり所',
], [
  'ru' => 'платформа',
  'en' => 'platform',
  'phonetic' => 'hōmu',
  'jp' => 'ホーム',
], [
  'ru' => 'электропоезд',
  'en' => 'electric train',
  'phonetic' => 'densha',
  'jp' => '電車',
]];
?>
@include('tpl.japanese-glyphs')

@ru
  <h3>57. Приветствия и другие выражения</h3>
@en
  <h3>57. Greetings</h3>
@endlang
<?php
$glyphs = [[
  'ru' => 'доброе утро',
  'en' => 'good morning',
  'phonetic' => 'ohayō gozaimasu',
  'jp' => 'おはようございます',
], [
  'ru' => 'добрый день',
  'en' => 'good afternoon',
  'phonetic' => 'konnichiwa',
  'jp' => 'こんにちは',
], [
  'ru' => 'добрый вечер',
  'en' => 'good afternoon',
  'phonetic' => 'konbanwa',
  'jp' => 'こんばんは',
], [
  'ru' => 'как поживаете?',
  'en' => 'how are you?',
  'phonetic' => 'ogenki desu ka',
  'jp' => 'お元気ですか',
], [
  'ru' => 'привет',
  'en' => 'hello',
  'phonetic' => 'yaa',
  'jp' => 'やあ',
]];
?>
@include('tpl.japanese-glyphs')

@ru
  <h3>95. Числа</h3>
@en
  <h3>95. Numbers</h3>
@endlang
<?php
$glyphs = [[
  'ru' => 'ноль',
  'en' => 'zero',
  'phonetic' => 'rei',
  'jp' => '〇'
], [
  'ru' => 'один',
  'en' => 'one',
  'phonetic' => 'ichi',
  'jp' => '一'
], [
  'ru' => 'два',
  'en' => 'two',
  'phonetic' => 'ni',
  'jp' => '二'
], [
  'ru' => 'три',
  'en' => 'three',
  'phonetic' => 'san',
  'jp' => '三',
], [
  'ru' => 'четыре',
  'en' => 'four',
  'phonetic' => 'yon',
  'jp' => '四',
], [
  'ru' => 'пять',
  'en' => 'five',
  'phonetic' => 'go',
  'jp' => '五',
], [
  'ru' => 'шесть',
  'en' => 'six',
  'phonetic' => 'roku',
  'jp' => '六',
], [
  'ru' => 'семь',
  'en' => 'seven',
  'phonetic' => 'nana',
  'jp' => '七',
], [
  'ru' => 'восемь',
  'en' => 'eight',
  'phonetic' => 'hachi',
  'jp' => '八',
], [
  'ru' => 'девять',
  'en' => 'nine',
  'phonetic' => 'kyū',
  'jp' => '九',
], [
  'ru' => 'десять',
  'en' => 'ten',
  'phonetic' => 'jū',
  'jp' => '十',
], [
  'ru' => 'одиннадцать',
  'en' => 'eleven',
  'phonetic' => 'jū ichi',
  'jp' => '十一',
], [
  'ru' => 'двадцать',
  'en' => 'twenty',
  'phonetic' => 'ni jū',
  'jp' => '二十',
], [
  'ru' => 'сто',
  'en' => 'hundred',
  'phonetic' => 'hyaku',
  'jp' => '百',
], [
  'ru' => 'тысяча',
  'en' => 'thousand',
  'phonetic' => 'sen',
  'jp' => '千',
], [
  'ru' => 'десять тысяч',
  'en' => 'ten thousand',
  'phonetic' => 'man',
  'jp' => '万',
], [
  'ru' => 'миллион',
  'en' => 'million',
  'phonetic' => 'hyaku man',
  'jp' => '百万',
]];
?>
@include('tpl.japanese-glyphs')
@endsection
