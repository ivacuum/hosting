<?php /** @var \App\Http\Livewire\NumberTrainer $this */ ?>

<div class="grid gap-8 max-w-xl mx-auto">
  <div>
    @ru
      Введите загаданное число и нажмите клавишу Ввод.
    @en
      Type the number and press Enter.
    @endru
  </div>
  <div>
    <div class="text-center">
      <div class="inline-block bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 text-3xl px-3 py-2 rounded leading-none {{ $this->sayOutLoud && !$this->reveal ? 'invisible' : '' }}">
        {{ $this->guessingSpellOut ? $this->number : $this->spellOut }}
      </div>
      <div hidden class="js-utterance">{{ $this->number }}</div>
      <div class="text-2xl">
        @if($this->reveal)
          <span class="flex flex-wrap gap-x-4 justify-center text-green-600">
            @foreach($this->acceptedAnswers() as $answer)
              <span>{{ $answer }}</span>
              @if(!$loop->last)
                <span class="text-gray-300">&middot;</span>
              @endif
            @endforeach
          </span>
        @else
          <button
            class="text-gray-400 dark:text-slate-400"
            accesskey="a"
            type="button"
            wire:click="reveal"
          >&lsaquo;@lang('показать ответ')&rsaquo;</button>
        @endif
      </div>
    </div>

    <div class="mt-2">
      <input
        type="{{ $this->guessingSpellOut ? 'text' : 'number' }}"
        tabindex="1"
        autocapitalize="none"
        autocomplete="off"
        autocorrect="off"
        spellcheck="false"
        placeholder="@lang('Ваш ответ')"
        enterkeyhint="send"
        class="form-input text-center {{ $this->incorrectAnswer ? 'animate-incorrect-answer' : '' }} js-answer"
        {{ $this->incorrectAnswer ? 'wire:dirty.class.remove="animate-incorrect-answer"' : '' }}
        wire:model.defer="answer"
        wire:keydown.enter="check"
      >
    </div>

    <div class="grid grid-cols-3 gap-2 mt-3">
      <button
        class="btn btn-default px-0 text-sm sm:text-base"
        accesskey="s"
        type="button"
        wire:click="skip"
      >@lang($this->reveal ? 'Далее' : 'Пропустить')</button>
      <div>
        <button
          class="btn border border-blue-300 dark:border-blue-700 hover:border-blue-400 hover:dark:border-blue-800 bg-blue-200 dark:bg-blue-600 hover:bg-blue-300 hover:dark:bg-blue-700 dark:text-white w-full js-speak"
          accesskey="p"
          type="button"
        >
          @svg (volume-up-full)
        </button>
      </div>
      <div>
        <a class="btn btn-default w-full" href="#help">@lang('Помощь')</a>
      </div>
    </div>

    <div class="grid grid-cols-3 gap-2 mt-4">
      @if($this->answered > 0)
        <div>
          <div class="text-sm small-caps text-green-500">@lang('japanese.answered')</div>
          <div class="text-2xl">{{ $this->answered }}</div>
        </div>
      @endif
      @if($this->skipped > 0)
        <div>
          <div class="text-sm small-caps text-gray-500">@lang('japanese.skipped')</div>
          <div class="text-2xl">{{ $this->skipped }}</div>
        </div>
      @endif
      @if($this->revealed > 0)
        <div>
          <div class="text-sm small-caps text-yellow-500">@lang('Подсказано')</div>
          <div class="text-2xl">{{ $this->revealed }}</div>
        </div>
      @endif
    </div>
  </div>
  <div>
    <div class="border dark:border-slate-700 rounded overflow-hidden">
      <div class="border-b dark:border-slate-700 bg-gray-100 dark:bg-slate-800 text-gray-600 dark:text-slate-400 px-4 py-2 font-medium leading-tight text-lg" itemprop="name">@lang('Настройки')</div>
      <form class="grid gap-6 px-4 py-3" wire:submit.prevent>
        <div>
          <div class="font-medium text-lg">@lang('Язык')</div>
          <div class="text-gray-500 text-sm mb-2">
            @ru
              Будут загаданы числа этого языка.
            @en
              You will practice the numbers of this language.
            @endru
          </div>
          <select class="form-input" wire:model="lang">
            @foreach($this->locales as $lang => $name)
              <option value="{{ $lang }}">{{ $name }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <div class="font-medium text-lg">@lang('Голос')</div>
          <div class="text-gray-500 text-sm mb-2">
            @ru
              Ваше устройство умеет читать на выбранном языке перечисленными голосами.
            @en
              Your device can pronounce numbers in the selected language with the voices below.
            @endru
          </div>
          <select class="form-input js-voices" data-locale="{{ $this->lang }}" wire:ignore></select>
        </div>
        <div>
          <div class="font-medium text-lg">@lang('Интервал возможных чисел')</div>
          <div class="text-gray-500 text-sm mb-2">@lang('От :min до :max.', ['min' => 0, 'max' => ViewHelper::number($this->maximum)])</div>
          <div class="flex gap-1">
            <button
              class="btn btn-default disabled:opacity-50"
              type="button"
              wire:click="decreaseLevel"
              {{ $this->maximum < 100 ? 'disabled' : '' }}
            >@lang('Уменьшить')</button>
            <button
              class="btn btn-default disabled:opacity-50"
              type="button"
              wire:click="increaseLevel"
              {{ $this->maximum > 10_000_000 ? 'disabled' : '' }}
            >@lang('Увеличить')</button>
          </div>
        </div>
        <div>
          <div class="font-medium text-lg">@lang('Вид ответов')</div>
          <div class="text-gray-500 text-sm mb-2">
            @ru
              Можно научиться как распознавать числа, так писать их словами.
            @en
              You can learn both how to recognize numbers and how to spell them.
            @endru
          </div>
          <div class="flex gap-4 items-center">
            <label class="flex gap-2 items-center">
              <input class="border-gray-300" type="radio" wire:model="guessingSpellOut" value="0">
              @ru
                Сами числа
              @en
                Numbers
              @endru
            </label>
            <label class="flex gap-2 items-center">
              <input class="border-gray-300" type="radio" wire:model="guessingSpellOut" value="1">
              @ru
                Написание чисел
              @en
                Spelling
              @endru
            </label>
          </div>
        </div>
        <div>
          <div class="font-medium text-lg">@lang('Вид заданий')</div>
          {{--<div class="text-gray-500 text-sm mb-2">Вам доступна возможность ввода чисел на слух.</div>--}}
          <div class="flex gap-4 items-center">
            <label class="flex gap-2 items-center">
              <input class="border-gray-300" type="radio" wire:model="sayOutLoud" value="0">
              @lang('Хочу читать')
            </label>
            <label class="flex gap-2 items-center">
              <input class="border-gray-300" type="radio" wire:model="sayOutLoud" value="1">
              @lang('Хочу слушать')
            </label>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div>
    <h1 class="font-medium text-2xl mb-2" id="help">Тренажер по набору чисел</h1>
    <p>Мне долгое время не удавалось запомнить корейские числа. Вспоминая пользу других моих <a class="link" href="{{ to('trainers') }}">тренажеров</a>, было решено сделать тренажер чисел. С ним числа до ста удалось запомнить буквально за 20 минут. Попробуйте и вы! Оптимально начать с цифр, затем перейти к десяткам, сотням и так далее.</p>
    <p>Набор языков основан на данных проекта с открытым исходным кодом под названием <a class="link" href="https://icu.unicode.org/">ICU</a>. По мере его развития количество языков для тренировки может увеличиться. Уже сейчас вы можете потренировать более 70 языков.</p>
    <p>Набор доступных голосов тренажеру сообщает ваше устройство. Это значит, что на том же андроиде можно сходить в настройки голосового ввода и скачать дополнительные голоса, чтобы они стали доступны для произношения. В браузере Microsoft Edge представлен классный и качественный набор онлайн-голосов, поэтому он очень рекомендуется для пробы. Если голосов для выбранного языка на вашем устройстве не нашлось, то функция произношения будет недоступна, а ввод на слух станет чистым гаданием.</p>
    <p>Для ввода ответа текстом большинство языков потребует местную раскладку клавиатуры. То есть, чешская цифра <span class="font-bold">čtyři (4)</span> требует вводить именно <span class="font-bold">č</span> и <span class="font-bold">ř</span>, а немецкая <span class="font-bold">fünf (5)</span> — именно <span class="font-bold">ü</span>. Тренажер принимает ответы транслитом, но транслит по международным правилам не всегда такой, каким вы можете его ожидать, поэтому рекомендуется пользоваться именно местной клавиатурой — так вы запомните правильное написание.</p>

    <div class="font-medium text-xl mt-12 mb-2">Поддерживаемые вашим устройством голоса</div>
    <p>Этот раздел поможет узнать числа каких языков вы можете потренировать на слух.</p>
    <p wire:ignore><button class="btn btn-default js-print-supported-voices">Какие голоса есть в моем устройстве?</button></p>
    <ul class="js-voice-list" wire:ignore></ul>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const answer = document.querySelector('.js-answer')
      const voiceList = document.querySelector('.js-voice-list')
      const voiceSelect = document.querySelector('.js-voices')
      const printSupportedVoices = document.querySelector('.js-print-supported-voices')
      let voices = []

      voiceSelect.addEventListener('input', () => {
        sayOutLoud()

        App.beacon.push({
          event: 'NumberVoiceSelected',
        })
      })

      printSupportedVoices.addEventListener('click', () => {
        voiceList.textContent = ''

        voices.forEach((voice) => {
          let el = document.createElement('li')
          el.textContent = `${voice.name}: ${voice.lang}`

          voiceList.appendChild(el)
        })

        printSupportedVoices.remove()
      })

      function populateVoiceList(locale) {
        voices = speechSynthesis.getVoices()
        voiceSelect.textContent = ''

        voices
          .filter((voice) => voice.lang === locale || voice.lang.replace('_', '-').startsWith(`${locale}-`))
          .forEach((voice) => {
            let option = document.createElement('option')

            option.value = voice.voiceURI
            option.textContent = `${voice.name} (${voice.lang})`

            voiceSelect.appendChild(option)
          })
      }

      function focusOnAnswer() {
        answer.focus()
      }

      populateVoiceList(voiceSelect.dataset.locale)

      if (speechSynthesis.onvoiceschanged !== undefined) {
        speechSynthesis.onvoiceschanged = () => {
          if (voices.length === 0) {
            populateVoiceList(voiceSelect.dataset.locale)
          }
        }
      }

      window.livewire.on('answer.focus', () => {
        focusOnAnswer()
      })

      window.livewire.on('lang.updated', (locale) => {
        populateVoiceList(locale)
      })

      window.livewire.on('say-out-loud', () => {
        sayOutLoud()
      })

      function sayOutLoud() {
        if (voiceSelect.selectedOptions[0] === undefined) {
          return
        }

        const text = document.querySelector('.js-utterance').textContent
        const utterance = new SpeechSynthesisUtterance(text)

        utterance.voice = voices.find((voice) => voice.voiceURI === voiceSelect.selectedOptions[0].value)
        utterance.lang = utterance.voice.lang

        speechSynthesis.speak(utterance)

        App.beacon.push({
          event: 'NumberSpoken',
        })
      }

      document.querySelector('.js-speak')?.addEventListener('click', () => {
        sayOutLoud()
        focusOnAnswer()

        App.beacon.push({
          event: 'NumberSpeakPressed',
        })
      })
    })
  </script>
</div>
