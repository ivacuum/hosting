<template>
<div>
  <transition appear name="fade" mode="out-in">
    <div :key="stage">
      <div v-show="stage === 'pick'">
        <p>Выберите столбцы для практики.</p>
        <div class="align-items-center text-center border-left" style="display: grid; grid-template-columns: repeat(16, max-content);">
          <template v-for="(cells, i) in elements">
            <template v-for="cell in cells">
              <div class="px-2 pt-2 pb-1 border-right" :class="{ 'border-top': i === 0 }">
                <div class="f28 font-weight-bold ja-character">{{ cell[syllabaryIndex] ? cell[syllabaryIndex] : '&nbsp;' }}</div>
                <div class="text-muted">{{ cell[answerIndex] ? cell[answerIndex] : '&nbsp;' }}</div>
              </div>
            </template>
          </template>
          <template v-for="i in elements[0].length">
            <div class="border-right border-bottom">
              <label class="cursor-pointer d-block mb-0 py-2">
                <input class="cursor-pointer" type="checkbox" :value="i - 1" v-model="checkedColumns" @change="pickElements">
              </label>
            </div>
          </template>
        </div>
        <div class="mt-2">
          <button class="btn btn-primary" :disabled="this.picked.length < 2" @click="practice">Практиковаться</button>
          <button class="btn btn-default" @click="checkAll">Выбрать все</button>
          <button class="btn btn-default" @click="uncheckAll">Снять выделение</button>
          <transition name="fade-fast" mode="out-in">
            <button class="btn btn-default" @click="switchSyllabary" :key="syllabaryLabel">{{ syllabaryLabel }}</button>
          </transition>
        </div>
      </div>
      <div v-show="stage === 'practice'">
        <p>Ответ засчитывается автоматически без нажатия клавиши ввода. Пробел подсказывает ответ.</p>
        <div class="mx-auto mw-400">
          <div class="text-center py-2 py-md-5">
            <div class="f48 font-weight-bold" @click="revealAnswer">{{ question }}</div>
            <div class="text-muted" :class="{ invisible: !answerVisible }">{{ answer }}</div>
          </div>
          <div>
            <input class="form-control text-center" autocapitalize="none" placeholder="kana" :autofocus="focus" :value="input" @input="checkInput($event.target.value)" @keydown.space.prevent="revealAnswer">
          </div>
          <div class="d-flex align-items-center justify-content-between mt-2">
            <div><button class="btn btn-default" @click="pick">Назад к выбору</button></div>
            <div class="text-muted" v-if="answered > 0">Отвечено: {{ answered }}</div>
          </div>
        </div>
      </div>
    </div>
  </transition>
</div>
</template>

<script>
let random = require('lodash/random')

export default {
  props: ['value'],

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
    syllabaryLabel: function () {
      return this.syllabaryIndex === 0 ? 'Переключиться на катакану' : 'Переключиться на хирагану'
    }
  },

  methods: {
    checkAll() {
      this.checkedColumns = [...Array(this.elements[0].length).keys()]
      this.pickElements()
    },

    checkInput: function (input) {
      this.input = input

      if (this.answer && this.answer === input) {
        this.answered++
        this.nextQuestion()
      }
    },

    clearInput() {
      this.input = ''
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
      const el = this.picked[random(0, this.picked.length - 1)]

      if (this.picked.length > 1 && el[this.syllabaryIndex] === this.question) {
        return this.pickRandom()
      }

      return el
    },

    practice() {
      this.stage = 'practice'
      this.focus = true
      this.answered = 0
      this.nextQuestion()
    },

    revealAnswer() {
      this.answerVisible = true
    },

    switchSyllabary() {
      this.syllabaryIndex = this.syllabaryIndex === 0 ? 1 : 0
    },

    uncheckAll() {
      this.checkedColumns = []
      this.pickElements()
    }
  }
}
</script>
