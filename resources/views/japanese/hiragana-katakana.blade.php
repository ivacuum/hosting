@extends('japanese.base')

@php
$elements = [
  [
    ['あ', 'ア', 'a'],
    ['か', 'カ', 'ka'],
    ['さ', 'サ', 'sa'],
    ['た', 'タ', 'ta'],
    ['な', 'ナ', 'na'],
    ['は', 'ハ', 'ha'],
    ['ま', 'マ', 'ma'],
    ['や', 'ヤ', 'ya'],
    ['ら', 'ラ', 'ra'],
    ['わ', 'ワ', 'wa'],
    ['ん', 'ン', 'n'],
    ['が', 'ガ', 'ga'],
    ['ざ', 'ザ', 'za'],
    ['だ', 'ダ', 'da'],
    ['ば', 'バ', 'ba'],
    ['ぱ', 'パ', 'pa'],
  ], [
    ['い', 'イ', 'i'],
    ['き', 'キ', 'ki'],
    ['し', 'シ', 'shi'],
    ['ち', 'チ', 'chi'],
    ['に', 'ニ', 'ni'],
    ['ひ', 'ヒ', 'hi'],
    ['み', 'ミ', 'mi'],
    ['', '', ''],
    ['り', 'リ', 'ri'],
    ['', '', ''],
    ['', '', ''],
    ['ぎ', 'ギ', 'gi'],
    ['じ', 'ジ', 'ji'],
    ['ぢ', 'ヂ', 'di'],
    ['び', 'ビ', 'bi'],
    ['ぴ', 'ピ', 'pi'],
  ], [
    ['う', 'ウ', 'u'],
    ['く', 'ク', 'ku'],
    ['す', 'ス', 'su'],
    ['つ', 'ツ', 'tsu'],
    ['ぬ', 'ヌ', 'nu'],
    ['ふ', 'フ', 'fu'],
    ['む', 'ム', 'mu'],
    ['ゆ', 'ユ', 'yu'],
    ['る', 'ル', 'ru'],
    ['', '', ''],
    ['', '', ''],
    ['ぐ', 'グ', 'gu'],
    ['ず', 'ズ', 'zu'],
    ['づ', 'ヅ', 'du'],
    ['ぶ', 'ブ', 'bu'],
    ['ぷ', 'プ', 'pu'],
  ], [
    ['え', 'エ', 'e'],
    ['け', 'ケ', 'ke'],
    ['せ', 'セ', 'se'],
    ['て', 'テ', 'te'],
    ['ね', 'ネ', 'ne'],
    ['へ', 'ヘ', 'he'],
    ['め', 'メ', 'me'],
    ['', '', ''],
    ['れ', 'レ', 're'],
    ['', '', ''],
    ['', '', ''],
    ['げ', 'ゲ', 'ge'],
    ['ぜ', 'ゼ', 'ze'],
    ['で', 'デ', 'de'],
    ['べ', 'ベ', 'be'],
    ['ぺ', 'ペ', 'pe'],
  ], [
    ['お', 'オ', 'o'],
    ['こ', 'コ', 'ko'],
    ['そ', 'ソ', 'so'],
    ['と', 'ト', 'to'],
    ['の', 'ノ', 'no'],
    ['ほ', 'ホ', 'ho'],
    ['も', 'モ', 'mo'],
    ['よ', 'ヨ', 'yo'],
    ['ろ', 'ロ', 'ro'],
    ['を', 'ヲ', 'wo'],
    ['', '', ''],
    ['ご', 'ゴ', 'go'],
    ['ぞ', 'ゾ', 'zo'],
    ['ど', 'ド', 'do'],
    ['ぼ', 'ボ', 'bo'],
    ['ぽ', 'ポ', 'po'],
  ],
];
@endphp

@section('content')
<h1 class="font-medium text-3xl tracking-tight mb-2">@lang('Хирагана и катакана')</h1>
<div x-data="hiraganaKatakana" class="min-h-[420px]">
  <div x-show="stage === 'pick'" x-transition:enter.opacity>
    @ru
      <p>Выберите столбцы для практики.</p>
    @en
      <p>Select columns to practice.</p>
    @endru
    <div
      class="grid items-center text-center border-grey-200 dark:border-slate-700 overflow-x-scroll"
      style="grid-template-columns: repeat(16, max-content);"
    >
      @foreach ($elements as $i => $cells)
        @foreach ($cells as $j => [$hiragana, $katakana, $romaji])
          <div
            @class(['border-r border-grey-200 dark:border-slate-700 cursor-pointer px-2 pt-2 pb-1', 'border-t' => $i === 0, 'border-l' => $j === 0])
            @click="toggleColumn({{ $j }})"
          >
            <div class="text-2xl font-bold leading-none" x-text="elements[{{ $i }}][{{ $j }}][syllabaryIndex] || '\u00a0'">{{ $hiragana ?: "\u{a0}" }}</div>
            <div class="text-gray-500">{{ $romaji ?: "\u{a0}" }}</div>
          </div>
        @endforeach
      @endforeach
      @foreach (array_keys($elements[0]) as $column)
        <div @class(['border-r border-b border-grey-200 dark:border-slate-700', 'border-l' => $column === 0])>
          <label class="block cursor-pointer py-2">
            <input
              class="not-checked:border-gray-300 text-sky-600 cursor-pointer"
              type="checkbox"
              value="{{ $column }}"
              x-model.number="checkedColumns"
            >
          </label>
        </div>
      @endforeach
    </div>
    <div class="flex gap-1 mt-2 mb-4">
      <button class="btn btn-default" @click="checkAll">@ru Выбрать все @en Check all @endru</button>
      <button class="btn btn-default" @click="uncheckAll">@ru Снять выделение @en Uncheck all @endru</button>
    </div>
    <div class="my-4">
      <div class="font-medium text-lg">@ru Выберите азбуку для практики @en Choose a syllabary to practice @endru</div>
      <div>
        <label class="flex gap-2 items-center">
          <input class="not-checked:border-gray-300 text-sky-600" type="radio" x-model.number="whatToTrain" value="0" checked>
          @ru хирагана @en hiragana @endru
        </label>
        <label class="flex gap-2 items-center">
          <input class="not-checked:border-gray-300 text-sky-600" type="radio" x-model.number="whatToTrain" value="1">
          @ru катакана @en katakana @endru
        </label>
        <label class="flex gap-2 items-center">
          <input class="not-checked:border-gray-300 text-sky-600" type="radio" x-model.number="whatToTrain" value="2">
          @ru обе азбуки сразу @en both syllabaries @endru
        </label>
      </div>
    </div>
    <div class="flex gap-1">
      <button
        class="btn btn-primary disabled:opacity-50"
        :disabled="picked.length < 2"
        disabled
        @click="practice"
      >@ru Практиковаться @en Practice @endru</button>
    </div>
  </div>
  <div class="max-w-[600px]" x-show="stage === 'practice'" x-transition:enter.opacity x-cloak>
    @ru
      <p>Ответ засчитывается автоматически без нажатия клавиши ввода. Пробел подсказывает ответ.</p>
    @en
      <p>The answer is counted automatically, no need to press enter. Space button reveals the answer.</p>
    @endru
    <div class="mx-auto max-w-[400px]">
      <div class="text-center py-2 md:py-12">
        <div class="text-5xl font-bold" @click="revealAnswer" x-text="question"></div>
        <div class="text-gray-500 dark:text-slate-400" :class="{ invisible: !answerVisible }" x-text="answer"></div>
      </div>
      <div>
        <input
          class="the-input text-center"
          type="text"
          autocapitalize="none"
          autocomplete="off"
          autocorrect="off"
          spellcheck="false"
          enterkeyhint="enter"
          placeholder="kana"
          writingsuggestions="false"
          x-ref="input"
          @input="checkInput"
          @keydown.space.prevent="revealAnswer"
          @keydown.enter.prevent="revealAnswer"
        >
      </div>
      <div class="flex items-center justify-between mt-2">
        <div>
          <button class="btn btn-default" @click="pick">@ru Назад к выбору @en Back to picker @endru</button>
        </div>
        <div class="text-gray-500" x-show="answered > 0">
          @ru
            Отвечено: <span x-text="answered"></span>
          @en
            Answered: <span x-text="answered"></span>
          @endru
        </div>
      </div>
    </div>
  </div>
</div>

<div class="mt-12 max-w-[600px]">
  <div class="font-medium text-2xl mb-2 dark:text-white">@ru Что дальше? @en What next? @endru</div>
  @ru
    <p>Рады, что у вас стало хорошо получаться набирать слоги! Теперь можно закрепить навык в <a class="link" href="/japanese/words-trainer">следующем тренажере</a>, который посвящен набору настоящих японских слов. Так между делом и получится запомнить как они звучат.</p>
    <p>Еще можно <a class="link" href="{{ to('trainers/numbers', ['lang' => 'ja']) }}">потренировать японские числа</a>. Самое удивительное открытие будет в том, что <a class="link" href="{{ to('trainers/numbers', ['lang' => 'zh']) }}">китайские числа</a> вы тоже автоматически сможете распознавать, ведь в японском используются китайские иероглифы.</p>
  @en
    <p>We're glad you're get used to Japanese syllabaries! Now you can head on to the <a class="link" href="/en/japanese/words-trainer">next trainer</a> dedicated to typing real Japanese words. As a bonus, you can memorize pronunciation while typing.</p>
    <p>You can also <a class="link" href="{{ to('trainers/numbers', ['lang' => 'ja']) }}">practice Japanese numbers</a>. The most surprising discovery will be that you can automatically recognize <a class="link" href="{{ to('trainers/numbers', ['lang' => 'zh']) }}">Chinese numbers</a> too, because Japanese uses Chinese characters.</p>
  @endru
</div>

@ru
  <div class="mt-12 max-w-[600px]">
    <div class="font-medium text-2xl mb-2 dark:text-white">Почему набор латиницей, а не кириллицей?</div>
    <p>Взгляните на <a class="link" href="/life/countries/japan">заметки и фотографии</a> из неоднократных поездок в Японию. Попробуйте на них найти кириллизированные японские надписи. Не получилось? Или получилось найти только названия городов? Что ж. Латиница поможет в поездке, а кириллица — едва ли.</p>
  </div>
@en
  <div class="mt-12 max-w-[600px]">
    <div class="font-medium text-2xl mb-2">Stories about Japan</div>
    <p>Quite a few <a class="link" href="/en/life/countries/japan">notes with a few thousand photos</a> were published after traveling to Japan.</p>
  </div>
@endru

<div class="mt-12 max-w-[600px]">
  <div class="font-medium text-2xl mb-2 mt-12 dark:text-white">@lang('Обратная связь')</div>
  @ru
    <p>Поделитесь своим опытом использования тренажера или задайте вопрос. Мы постараемся обработать информацию и сделать тренажер еще лучше. <span class="whitespace-nowrap" lang="ja">ありがとうございます。</span></p>
  @en
    <p>Use the form below to ask a question or share your thoughts. We will use your feedback to make the trainer better. There are certainly things to improve. <span class="whitespace-nowrap" lang="ja">ありがとうございます。</span></p>
  @endru
  @livewire(App\Livewire\FeedbackForm::class, [
    'title' => 'Hiragana Katakana Trainer',
    'hideTitle' => true,
  ])
</div>
@endsection

{{-- Чтобы alpine.js был обязательно загружен на странице --}}
@php(Livewire\Livewire::forceAssetInjection())

@push('js')
<script>
document.addEventListener('alpine:init', () => {
  Alpine.data('hiraganaKatakana', () => ({
    stage: 'pick', // pick, practice
    answer: '',
    answered: 0,
    question: '',
    elements: @js($elements),
    answerIndex: 2,
    whatToTrain: 0, // 0: hiragana, 1: katakana, 2: both
    answerVisible: false,
    checkedColumns: [],
    syllabaryIndex: 0, // 0: hiragana, 1: katakana

    init() {
      this.beacon('Selected')

      this.$watch('whatToTrain', (value) => {
        if (value === 1) {
          this.syllabaryIndex = 1
        } else if (value === 0) {
          this.syllabaryIndex = 0
        }

        this.beacon('Selected')
      })
    },

    get picked() {
      const picked = []

      this.checkedColumns.forEach((i) => {
        this.elements.forEach((ary) => {
          if (ary[i][0]) {
            picked.push(ary[i])
          }
        })
      })

      return picked
    },

    get syllabaryName() {
      if (this.whatToTrain === 1) {
        return 'Katakana'
      } else if (this.whatToTrain === 2) {
        return 'Kana'
      }

      return 'Hiragana'
    },

    beacon(action) {
      App.beacon.push({
        event: this.syllabaryName + action
      })
    },

    checkAll() {
      this.checkedColumns = [...this.elements[0].keys()]
    },

    androidSpaceFix(e) {
      if (e.inputType === 'insertText' && e.data === ' ') {
        this.revealAnswer()
      }
    },

    checkInput(e) {
      this.androidSpaceFix(e)

      const input = e.target.value.replace(/\s/g, '')
      e.target.value = input

      if (this.answer && this.answer === input.toLowerCase()) {
        this.answered++
        this.beacon('Answered')
        this.nextQuestion()
      }
    },

    clearInput() {
      this.$refs.input.value = ''
    },

    nextQuestion() {
      this.clearInput()
      this.answerVisible = false

      const el = this.pickRandom()

      this.question = this.whatToTrain === 2
        ? el[this.randomInt(2)]
        : el[this.whatToTrain]
      this.answer = el[this.answerIndex]
    },

    pick() {
      this.stage = 'pick'
      this.scrollToTop()
    },

    pickRandom() {
      const el = this.picked[this.randomInt(this.picked.length)]

      if (this.picked.length > 1 && (el[0] === this.question || el[1] === this.question)) {
        return this.pickRandom()
      }

      return el
    },

    practice() {
      this.stage = 'practice'
      this.answered = 0
      this.beacon('Started')
      this.nextQuestion()
      this.scrollToTop()
      this.$nextTick(() => this.$refs.input.focus({ preventScroll: true }))
    },

    randomInt(max) {
      return Math.floor(Math.random() * max)
    },

    revealAnswer() {
      this.answerVisible = true
      this.beacon('AnswerRevealed')
    },

    scrollToTop() {
      window.scrollTo({
        top: 0,
        left: 0,
        behavior: 'smooth'
      })
    },

    toggleColumn(n) {
      this.checkedColumns = this.checkedColumns.includes(n)
        ? this.checkedColumns.filter((i) => i !== n)
        : [...this.checkedColumns, n]
    },

    uncheckAll() {
      this.checkedColumns = []
    },
  }))
})
</script>
@endpush
