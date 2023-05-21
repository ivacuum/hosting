@extends('japanese.base')
@include('livewire')

@section('content')
<h1 class="font-medium text-3xl tracking-tight mb-2">@lang('Хирагана и катакана')</h1>
<div id="hiragana_katakana" class="invisible">
  <Transition appear name="fade" mode="out-in">
    <div :key="stage" class="min-h-[420px]">
      <div v-show="stage === 'pick'">
        @ru
          <p>Выберите столбцы для практики.</p>
        @en
          <p>Select columns to practice.</p>
        @endru
        <div
          class="grid items-center text-center border-grey-200 dark:border-slate-700 overflow-x-scroll"
          style="grid-template-columns: repeat(16, max-content);"
        >
          <template v-for="(cells, i) in elements">
            <template v-for="(cell, j) in cells">
              <div
                class="border-r border-grey-200 dark:border-slate-700 cursor-pointer px-2 pt-2 pb-1"
                :class="{ 'border-t': i === 0, 'border-l': j === 0 }"
                @click="clickOnColumn(j)"
              >
                <div class="text-2xl font-bold leading-none">@{{ cell[syllabaryIndex] ? cell[syllabaryIndex] : '&nbsp;' }}</div>
                <div class="text-muted">@{{ cell[answerIndex] ? cell[answerIndex] : '&nbsp;' }}</div>
              </div>
            </template>
          </template>
          <template v-for="i in elements[0].length">
            <div class="border-r border-b border-grey-200 dark:border-slate-700" :class="{ 'border-l': i === 1 }">
              <label class="block cursor-pointer py-2">
                <input
                  :id="`column_${i - 1}`"
                  class="border-gray-300 cursor-pointer"
                  type="checkbox"
                  :value="i - 1"
                  v-model="checkedColumns"
                  @change="pickElements"
                >
              </label>
            </div>
          </template>
        </div>
        <div class="grid grid-cols-2 lg:flex gap-2 mt-2">
          <button
            class="btn btn-primary disabled:opacity-50"
            :disabled="this.picked.length < 2"
            @click="practice"
          >@ru Практиковаться @en Practice @endru</button>
          <Transition name="fade-fast" mode="out-in">
            <button
              class="btn btn-default"
              @click="switchSyllabary"
              :key="syllabaryName"
            >
              <span v-show="syllabaryName === 'Hiragana'">@ru Переключиться на катакану @en Switch to katakana @endru</span>
              <span v-show="syllabaryName === 'Katakana'">@ru Переключиться на хирагану @en Switch to hiragana @endru</span>
            </button>
          </Transition>
          <button class="btn btn-default" @click="checkAll">@ru Выбрать все @en Check all @endru</button>
          <button class="btn btn-default" @click="uncheckAll">@ru Снять выделение @en Uncheck all @endru</button>
        </div>
      </div>
      <div class="max-w-[600px]" v-show="stage === 'practice'">
        @ru
          <p>Ответ засчитывается автоматически без нажатия клавиши ввода. Пробел подсказывает ответ.</p>
        @en
          <p>The answer is counted automatically, no need to press enter. Space button reveals the answer.</p>
        @endru
        <div class="mx-auto max-w-[400px]">
          <div class="text-center py-2 md:py-12">
            <div class="text-5xl font-bold" @click="revealAnswer">@{{ question }}</div>
            <div class="text-muted dark:text-slate-400" :class="{ invisible: !answerVisible }">@{{ answer }}</div>
          </div>
          <div>
            <input
              class="form-input text-center"
              type="text"
              autocapitalize="none"
              autocomplete="off"
              autocorrect="off"
              spellcheck="false"
              enterkeyhint="enter"
              placeholder="kana"
              :autofocus="focus"
              :value="input"
              @input="checkInput($event.target.value, $event)"
              @keydown.space.prevent="revealAnswer"
              @keydown.enter.prevent="revealAnswer"
            >
          </div>
          <div class="flex items-center justify-between mt-2">
            <div>
              <button class="btn btn-default" @click="pick">@ru Назад к выбору @en Back to picker @endru</button>
            </div>
            <div class="text-muted" v-if="answered > 0">
              @ru
                Отвечено: @{{ answered }}
              @en
                Answered: @{{ answered }}
              @endru
            </div>
          </div>
        </div>
      </div>
    </div>
  </Transition>
</div>

<div class="mt-12 max-w-[600px]">
  <div class="font-medium text-2xl mb-2">@ru Что дальше? @en What next? @endru</div>
  @ru
    <p>Рады, что у вас стало хорошо получаться набирать слоги! Теперь можно закрепить навык в <a class="link" href="/japanese/words-trainer">следующем тренажере</a>, который посвящен набору настоящих японских слов. Так между делом и получится запомнить как они звучат.</p>
    <p>Еще можно <a class="link" href="{{ to('trainers/numbers', ['lang' => 'ja']) }}">потренировать японские числа</a>. Самое удивительное открытие будет в том, что <a class="link" href="{{ to('trainers/numbers', ['lang' => 'zh']) }}">китайские числа</a> вы тоже автоматически сможете распознавать, ведь в японском используются китайские иероглифы.</p>
  @en
    <p>We're glad you're get used to Japanese syllabaries! Now you can head on to the <a class="link" href="/en/japanese/words-trainer">next trainer</a> dedicated to typing real Japanese words. As a bonus, you can memorize the words are pronounced while typing.</p>
  @endru
</div>

@ru
  <div class="mt-12 max-w-[600px]">
    <div class="font-medium text-2xl mb-2">Почему набор латиницей, а не кириллицей?</div>
    <p>Взгляните на <a class="link" href="/life/countries/japan">заметки и фотографии</a> из неоднократных поездок в Японию. Попробуйте на них найти кириллизированные японские надписи. Не получилось? Или получилось найти только названия городов? Что ж. Латиница поможет в поездке, а кириллица — едва ли.</p>
  </div>
@en
  <div class="mt-12 max-w-[600px]">
    <div class="font-medium text-2xl mb-2">Stories about Japan</div>
    <p>Quite a few <a class="link" href="/en/life/countries/japan">notes with a few thousand photos</a> were published after traveling to Japan.</p>
  </div>
@endru

<div class="mt-12 max-w-[600px]">
  <div class="font-medium text-2xl mb-2 mt-12">@lang('Обратная связь')</div>
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

@push('js_vendor')
@vite('resources/js/hiragana-katakana.js')
@endpush

@push('js')
<script type="module">
(function () {
  const app = CreateVueApp({
    data() {
      return {
        focus: false,
        input: '',
        stage: 'pick', // pick, practice
        answer: '',
        picked: [],
        answered: 0,
        question: '',
        elements: [
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
            ['', ''],
            ['り', 'リ', 'ri'],
            ['', ''],
            ['', ''],
            ['ぎ', 'ギ', 'gi'],
            ['じ', 'ジ', 'ji'],
            ['ぢ', 'ヂ', 'ji'],
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
            ['', ''],
            ['', ''],
            ['ぐ', 'グ', 'gu'],
            ['ず', 'ズ', 'zu'],
            ['づ', 'ヅ', 'zu'],
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
            ['', ''],
            ['れ', 'レ', 're'],
            ['', ''],
            ['', ''],
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
            ['', ''],
            ['ご', 'ゴ', 'go'],
            ['ぞ', 'ゾ', 'zo'],
            ['ど', 'ド', 'do'],
            ['ぼ', 'ボ', 'bo'],
            ['ぽ', 'ポ', 'po'],
          ],
        ],
        answerIndex: 2,
        answerVisible: false,
        checkedColumns: [],
        syllabaryIndex: 0, // 0: hiragana, 1: katakana
      }
    },

    computed: {
      syllabaryName() {
        return this.syllabaryIndex === 0 ? 'Hiragana' : 'Katakana'
      }
    },

    mounted() {
      this.beacon('Selected')
      document.querySelector('#hiragana_katakana').classList.remove('invisible')
    },

    methods: {
      androidSpaceFix(e) {
        if (e.inputType === 'insertText' && e.data === ' ') {
          this.revealAnswer()
        }
      },

      beacon(action, appendSyllabaryName = true) {
        App.beacon.push({
          event: appendSyllabaryName ? this.syllabaryName + action : action
        })
      },

      checkAll() {
        this.checkedColumns = [...Array(this.elements[0].length).keys()]
        this.pickElements()
      },

      checkInput(input, e) {
        this.androidSpaceFix(e)

        this.input = input.replace(/\s/g, '')

        if (this.answer && this.answer === this.input.toLowerCase()) {
          this.answered++
          this.beacon('Answered')
          this.nextQuestion()
        }
      },

      clearInput() {
        this.input = ''
      },

      clickOnColumn(n) {
        document.querySelector(`#column_${n}`).click()
      },

      nextQuestion() {
        this.clearInput()
        this.answerVisible = false

        const el = this.pickRandom()

        this.question = el[this.syllabaryIndex]
        this.answer = el[this.answerIndex]
      },

      pick() {
        this.stage = 'pick'
        this.scrollToTop()
      },

      pickElements() {
        this.picked = []

        this.checkedColumns.forEach((i) => {
          this.elements.forEach((ary) => {
            if (ary[i][0]) {
              this.picked.push(ary[i])
            }
          })
        })
      },

      pickRandom() {
        const el = this.picked[this.randomInt(this.picked.length)]

        if (this.picked.length > 1 && el[this.syllabaryIndex] === this.question) {
          return this.pickRandom()
        }

        return el
      },

      practice() {
        this.stage = 'practice'
        this.focus = true
        this.answered = 0
        this.beacon('Started')
        this.nextQuestion()
        this.scrollToTop()
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

      switchSyllabary() {
        this.syllabaryIndex = this.syllabaryIndex === 0 ? 1 : 0
        this.beacon('Selected')
      },

      uncheckAll() {
        this.checkedColumns = []
        this.pickElements()
      }
    }
  })

  app.mount('#hiragana_katakana')
})()
</script>
@endpush
