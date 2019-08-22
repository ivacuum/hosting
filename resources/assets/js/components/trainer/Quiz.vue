<script>
import Type1 from './AnswerType.vue'
import Exercise from './Exercise.vue'
import AnswersBank from './AnswersBank.vue'

export default {
  components: {
    AnswersBank,
    Exercise,
    Type1,
  },

  /*
  data() {
    return {
      mission: 'Put the verbs in brackets into Present Simple or Present Continuous.',
      type: 'type',
      tasks: [
        {
          task: 'She <input @click="alert(answer)"> (study) every evening.',
          answer: 'studies',
        },
      ]
    }
  },

  computed: {
    compiledTasks() {
      return this.tasks.map((task) => {
        const template = Vue.compile(`<div>${task.task}</div>`)

        return Object.assign({}, template, { data() { return task } })
      })
    }
  },

  <h3 class="tw-mt-12">Component</h3>
  <div class="tw-text-center">{{ mission }}</div>
  <div v-for="task in compiledTasks">
    <component :is="task"></component>
  </div>
  */
}

// TODO: первый ответ раскрыт в качестве примера (8)
// TODO: зачеркивание слов из банка по мере ввода ответов (8)
// TODO: банк слов и колонки (3.3)
// TODO: тест (18.3)

// Максимальный акцент на печати, а не просто выборе из банка слов

// Вот это можно использовать как для типов заданий, так и для полей ввода
// <component :is="type"/>

// Можно загруженное оформление поместить в <script type="text/x-template" id="something"/>
</script>

<template>
<div>
  <div>
    <exercise n="🇯🇵">
      <template slot="title">Using the framework "XY," translate the following sentences into Japanese.</template>
      <div class="tw-my-4">Mr. Takeda is a teacher.</div>
      <textarea
        class="form-control form-control-lg"
      ></textarea>
    </exercise>

    <div style="padding-top: 100vh;"></div>

    <exercise n="8">
      <template slot="title">Choose a verb from the list and complete the text.</template>
      <answers-bank :bank="['read/is reading', 'sleep/is sleeping', 'eat/are eating', 'sail/are sailing', 'cry/is crying', 'drink/is drinking', 'run/are running', 'sing/is singing', 'play/are playing', 'fish/is fishing', 'sit/is sitting']"/>
      <p class="spacious">Laura (1) <type1 answer="is sitting" answered/> under a sunshade. Two boys (2) <type1 answer="are running"/> round a sandcastle while their father (3) <type1 answer="is reading"/> a newspaper. Tom (4) <type1 answer="is drinking"/> Coke. Two girls (5) <type1 answer="are eating"/> ice-cream while their mother (6) <type1 answer="is singing"/> along the radio. Some boys (7) <type1 answer="are playing"/> football near a man who (8) <type1 answer="is fishing"/>. Jim (9) <type1 answer="is sleeping"/>. On his right a baby (10) <type1 answer="is crying"/>. Some people (11) <type1 answer="are sailing"/> past the beach.</p>
    </exercise>

    <exercise n="11">
      <template slot="title">Put the verbs in brackets into Present Simple or Present Continuous.</template>
      <ol class="spacious">
        <li>She <type1 answer="studies" answered/> <em>(study)</em> every evening.</li>
        <li>
          He <type1 answer="is dancing"/> <em>(dance)</em> with Mary now.
          <div><type1 answer="he is dancing with Mary now"/></div>
        </li>
        <li>They <type1 answer="are getting"/> <em>(get)</em> married next week.</li>
        <li>She usually <type1 answer="takes"/> <em>(take)</em> the bus to school.</li>
        <li>Her husband never <type1 answer="remembers"/> <em>(remember)</em> her birthday.</li>
        <li>We <type1 answer="are watching"/> <em>(watch)</em> a film on television at the moment.</li>
      </ol>
    </exercise>

    <exercise n="12">
      <template slot="title">Put the verbs in brackets into Present Simple or Present Continuous.</template>
      <p class="tw-text-green-600">Chris is asking Kim about her holiday arrangements.</p>
      <ol class="spacious">
        <li>Where <type1 answer="are" answered/> you <type1 answer="going" answered/> ? <em>(go)</em></li>
        <li>How <type1 answer="are"/> you <type1 answer="getting"/> there? <em>(get)</em></li>
        <li>What time <type1 answer="does"/> the plane <type1 answer="leave"/> ? <em>(leave)</em></li>
        <li>When <type1 answer="does"/> it <type1 answer="arrive"/> in Cairo? <em>(arrive)</em></li>
        <li>Where <type1 answer="are"/> you <type1 answer="staying"/> when you get there? <em>(stay)</em></li>
        <li>Why <type1 answer="do"/> you <type1 answer="want"/> to go there? <em>(want)</em></li>
        <li><type1 answer="are"/> you <type1 answer="taking"/> a camera with you? <em>(take)</em></li>
      </ol>
    </exercise>

    <exercise n="34">
      <template slot="title">Put the adjectives in the right order.</template>
      <ol class="spacious">
        <li>a new / woollen / red / smart / hat <type1 answer="a smart new red woollen hat"/></li>
      </ol>
    </exercise>

    <exercise n="35">
      <template slot="title">Underline the correct word, adjective or adverb.</template>
      <ol class="spacious">
        <li>The children played <strong>quiet</strong> / <strong style="border-bottom: 3px solid #33648c;">quietly</strong>.</li>
      </ol>
    </exercise>

    <exercise n="37">
      <template slot="title">Fill in the blanks with the correct comparative and superlative forms.</template>
      <ol class="spacious">
        <li>thin <type1 answer="thinner"/> <type1 answer="thinnest"/></li>
      </ol>
    </exercise>

    <section>
      <h2>
        <span class="unit-number">11</span>
        <span class="unit-title">Infinitive (to + verb) — Gerund (verb + -ing)</span>
      </h2>
    </section>

    <exercise n="11.3">
      <template slot="title">Fill in the gaps with a verb from the list below. Put it in the correct form.</template>
      <answers-bank :bank="['post', 'finish/to finish', 'lend/to lend', 'need', 'take/to take', 'borrow']"/>
      <ol class="spacious">
        <li>They managed <type1 answer="to finish" answered/> the project on time.</li>
        <li>Linda may <type1 answer="need"/> some help with the ironing.</li>
        <li>Could you <type1 answer="post"/> this parcel for me, please?</li>
        <li>Dad promised <type1 answer="to take"/> us to the circus on Sunday.</li>
        <li>Bruno won't let me <type1 answer="borrow"/> his car.</li>
        <li>She refused <type1 answer="to lend"/> him some money.</li>
      </ol>
    </exercise>

    <section>
      <h2>
        <span class="unit-number">13</span>
        <span class="unit-title">Conditionals</span>
      </h2>
    </section>

    <exercise n="13.1">
      <template slot="title">Match the following parts of the sentences.</template>
      <answers-bank :bank="[`we'll make a snowman`, `she'll have to take a taxi`, `he'll be late`, `we'll go on a picnic`]"/>
      <ol class="spacious">
        <li>If it's sunny tomorrow, <type1 answer="we'll go on a picnic" answered/>.</li>
        <li>If John doesn't hurry, <type1 answer="he'll be late"/>.</li>
        <li>If it snows, <type1 answer="we'll make a snowman"/>.</li>
        <li>If there are no buses, <type1 answer="she'll have to take a taxi"/>.</li>
      </ol>
    </exercise>

    <exercise n="13.2">
      <template slot="title">Write type 1 conditionals.</template>
      <ol class="spacious">
        <li><type1 answer="if he eats so much, he will put on weight" hint="eat/put on weight" answered/></li>
        <li><type1 answer="unless she works hard, she may lose job" hint="not work hard/lose job"/></li>
        <li><type1 answer="if it rains so much, he will stay at home" hint="rain/stay at home"/></li>
      </ol>
    </exercise>

    <exercise n="13.7">
      <template slot="title">Put the verbs in brackets into the correct tense.</template>
      <p class="spacious">Pat is feeling unhappy. If she (1) <type1 answer="joined" hint="join" answered/> an after school club, she (2) <type1 answer="2" hint="make"/> more friends. Pat (3) <type1 answer="3" hint="enjoy"/> herself if she (4) <type1 answer="4" hint="go"/> out more. Her school marks are suffering, too. If she (5) <type1 answer="5" hint="study"/> more, she (6) <type1 answer="6" hint="have"/> better marks and she (7) <type1 answer="7" hint="get"/> into university. Also, she doesn't exercise much. She (8) <type1 answer="8" hint="feel"/> healthier if she (9) <type1 answer="9" hint="walk"/> to school and she (10) <type1 answer="10" hint="have"/> more energy if she (11) <type1 answer="11" hint="add"/> vegetables to her diet.</p>
    </exercise>
  </div>
</div>
</template>

<style lang="scss">
.ex-number,
.unit-number {
  border-radius: 50%;
  font-weight: bold;
  // padding: 0.375rem 0.75rem;
  width: 3rem;
  height: 3rem;
  display: inline-flex;
  justify-content: center;
  align-items: center;
  margin-right: 0.25rem;
}

.ex-number {
  border: 1px solid #000;
  background-color: #f9fc47;
  box-shadow: -4px 4px black;
}

.unit-number {
  background-color: #4d0016;
  color: #fff;
}

.ex-title {
  border-bottom: 5px solid #f9fc47;
}

.unit-title {
  background-color: #000046;
  color: #fff;
  padding: 0.375rem 0.75rem;
}

.bank-used {
  text-decoration: line-through;
}

.spacious {
  line-height: 2;

  em {
    color: #6c757d;
  }
}
</style>
