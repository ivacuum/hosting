<?php /** @var \App\Http\Livewire\HangulTrainer $this */ ?>

@once
@push('head')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nanum+Pen+Script&text={{ urlencode('ㅂㅈㄷㄱㅅㅁㄴㅇㄹㅎㅋㅌㅊㅍㅃㅉㄸㄲㅆㅛㅕㅑㅐㅔㅗㅓㅏㅣㅠㅜㅡㅒㅖㅚㅟㅝㅙㅞㅢㅘ') }}">
@endpush
@endonce

<div class="grid gap-8 max-w-xl mx-auto">
  <div>
    <div class="text-center">
      <div class="inline-block bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 text-5xl px-3 py-2 rounded {{ $this->italic ? 'font-["Nanum_Pen_Script"]' : '' }}">{{ $this->jamo }}</div>
      <div class="text-2xl">
        @if($this->reveal)
          <span class="text-green-600 flex justify-center gap-4">
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
            wire:click="check"
          >@lang('показать ответ')</button>
        @endif
      </div>
    </div>

    <div class="mt-2">
      <input
        type="text"
        tabindex="1"
        autocapitalize="none"
        autocomplete="off"
        autocorrect="off"
        spellcheck="false"
        placeholder="@lang('Ваш ответ')"
        enterkeyhint="enter"
        class="form-input text-center {{ $this->reveal ? 'animate-incorrect-answer' : '' }}"
        {{ $this->reveal ? 'wire:dirty.class.remove="animate-incorrect-answer"' : '' }}
        wire:model.defer="answer"
        wire:keydown.enter="check"
      >
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
    <div class="grid gap-6">
      <div>
        <div class="h5 mb-0">@ru Что будем тренировать? @en What to train? @endru</div>
        <div>
          <label class="flex gap-2 items-center">
            <input class="border-gray-300" type="radio" wire:model="whatToTrain" value="{{ App\Domain\HangulWhatToTrain::Consonants->value }}">
            @lang('согласные')
          </label>
          <label class="flex gap-2 items-center">
            <input class="border-gray-300" type="radio" wire:model="whatToTrain" value="{{ App\Domain\HangulWhatToTrain::Vowels->value }}">
            @lang('гласные')
          </label>
          <label class="flex gap-2 items-center">
            <input class="border-gray-300" type="radio" wire:model="whatToTrain" value="{{ App\Domain\HangulWhatToTrain::AllTogether->value }}">
            @lang('все вместе')
          </label>
        </div>
      </div>
      <div>
        <div class="h5 mb-0">@ru Стиль шрифта @en Font style @endru</div>
        <div>
          <label class="flex gap-2 items-center">
            <input class="border-gray-300" type="radio" wire:model="italic" value="0">
            @ru
              обычный
            @en
              normal
            @endru
          </label>
          <label class="flex gap-2 items-center">
            <input class="border-gray-300" type="radio" wire:model="italic" value="1">
            @ru
              курсив
            @en
              italic
            @endru
          </label>
        </div>
      </div>
    </div>
  </div>
  <div>
    <h1 class="text-3xl" id="help">@lang('Тренажер хангыля')</h1>
    <p>Данный тренажер помогает быстро запомнить корейский алфавит. Ответы принимаются кириллицей по <a class="link" href="https://ru.wikipedia.org/wiki/Система_Концевича">системе Концевича</a> и латиницей по <a class="link" href="https://en.wikipedia.org/wiki/Revised_Romanization_of_Korean">новой романизации</a>.</p>

    <p>Ниже представлена корейская раскладка клавиатуры.</p>

    <div class="grid gap-px text-center mb-6 text-2xl">
      <div class="grid grid-cols-[repeat(10,minmax(25px,35px))] gap-px justify-center leading-none dark:text-gray-800">
        <x-korean-consonant>
          {{ $this->shiftPressed ? 'ㅃ' : 'ㅂ' }}
          <x-slot name="label">
            @ru
              {{ $this->shiftPressed ? 'пп' : 'б/п' }}
            @en
              {{ $this->shiftPressed ? 'pp' : 'b' }}
            @endru
          </x-slot>
        </x-korean-consonant>
        <x-korean-consonant>
          {{ $this->shiftPressed ? 'ㅉ' : 'ㅈ' }}
          <x-slot name="label">
            @ru
              {{ $this->shiftPressed ? 'чч' : 'дж' }}
            @en
              {{ $this->shiftPressed ? 'jj' : 'j' }}
            @endru
          </x-slot>
        </x-korean-consonant>
        <x-korean-consonant>
          {{ $this->shiftPressed ? 'ㄸ' : 'ㄷ' }}
          <x-slot name="label">
            @ru
              {{ $this->shiftPressed ? 'тт' : 'д/т' }}
            @en
              {{ $this->shiftPressed ? 'tt' : 'd' }}
            @endru
          </x-slot>
        </x-korean-consonant>
        <x-korean-consonant>
          {{ $this->shiftPressed ? 'ㄲ' : 'ㄱ' }}
          <x-slot name="label">
            @ru
              {{ $this->shiftPressed ? 'кк' : 'г/к' }}
            @en
              {{ $this->shiftPressed ? 'kk' : 'g' }}
            @endru
          </x-slot>
        </x-korean-consonant>
        <x-korean-consonant>
          {{ $this->shiftPressed ? 'ㅆ' : 'ㅅ' }}
          <x-slot name="label">
            @ru
              {{ $this->shiftPressed ? 'сс' : 'с' }}
            @en
              {{ $this->shiftPressed ? 'ss' : 's' }}
            @endru
          </x-slot>
        </x-korean-consonant>
        <x-korean-vowel>
          ㅛ
          <x-slot name="label">
            @ru ё @en yo @endru
          </x-slot>
        </x-korean-vowel>
        <x-korean-vowel>
          ㅕ
          <x-slot name="label">
            @ru ё @en yeo @endru
          </x-slot>
        </x-korean-vowel>
        <x-korean-vowel>
          ㅑ
          <x-slot name="label">
            @ru я @en ya @endru
          </x-slot>
        </x-korean-vowel>
        <x-korean-vowel>
          {{ $this->shiftPressed ? 'ㅒ' : 'ㅐ' }}
          <x-slot name="label">
            @ru
              {{ $this->shiftPressed ? 'йа' : 'э' }}
            @en
              {{ $this->shiftPressed ? 'yae' : 'ae' }}
            @endru
          </x-slot>
        </x-korean-vowel>
        <x-korean-vowel>
          {{ $this->shiftPressed ? 'ㅖ' : 'ㅔ' }}
          <x-slot name="label">
            @ru
              {{ $this->shiftPressed ? 'йе' : 'е' }}
            @en
              {{ $this->shiftPressed ? 'ye' : 'e' }}
            @endru
          </x-slot>
        </x-korean-vowel>
      </div>

      <div class="grid grid-cols-[repeat(9,minmax(25px,35px))] gap-px justify-center leading-none dark:text-gray-800">
        <x-korean-consonant>
          ㅁ
          <x-slot name="label">
            @ru м @en m @endru
          </x-slot>
        </x-korean-consonant>
        <x-korean-consonant>
          ㄴ
          <x-slot name="label">
            @ru н @en n @endru
          </x-slot>
        </x-korean-consonant>
        <x-korean-consonant>
          ㅇ
          <x-slot name="label">
            @ru н @en ng @endru
          </x-slot>
        </x-korean-consonant>
        <x-korean-consonant>
          ㄹ
          <x-slot name="label">
            @ru р/ль @en l @endru
          </x-slot>
        </x-korean-consonant>
        <x-korean-consonant>
          ㅎ
          <x-slot name="label">
            @ru х @en h @endru
          </x-slot>
        </x-korean-consonant>
        <x-korean-vowel>
          ㅗ
          <x-slot name="label">
            @ru о @en o @endru
          </x-slot>
        </x-korean-vowel>
        <x-korean-vowel>
          ㅓ
          <x-slot name="label">
            @ru о @en eo @endru
          </x-slot>
        </x-korean-vowel>
        <x-korean-vowel>
          ㅏ
          <x-slot name="label">
            @ru а @en a @endru
          </x-slot>
        </x-korean-vowel>
        <x-korean-vowel>
          ㅣ
          <x-slot name="label">
            @ru и @en i @endru
          </x-slot>
        </x-korean-vowel>
      </div>

      <div class="grid grid-cols-[repeat(7,minmax(25px,35px))] gap-px justify-center leading-none dark:text-gray-800">
        <x-korean-consonant>
          ㅋ
          <x-slot name="label">
            @ru кх @en k @endru
          </x-slot>
        </x-korean-consonant>
        <x-korean-consonant>
          ㅌ
          <x-slot name="label">
            @ru тх @en t @endru
          </x-slot>
        </x-korean-consonant>
        <x-korean-consonant>
          ㅊ
          <x-slot name="label">
            @ru чх @en ch @endru
          </x-slot>
        </x-korean-consonant>
        <x-korean-consonant>
          ㅍ
          <x-slot name="label">
            @ru пх @en p @endru
          </x-slot>
        </x-korean-consonant>
        <x-korean-vowel>
          ㅠ
          <x-slot name="label">
            @ru ю @en yu @endru
          </x-slot>
        </x-korean-vowel>
        <x-korean-vowel>
          ㅜ
          <x-slot name="label">
            @ru у @en u @endru
          </x-slot>
        </x-korean-vowel>
        <x-korean-vowel>
          ㅡ
          <x-slot name="label">
            @ru ы @en eu @endru
          </x-slot>
        </x-korean-vowel>
      </div>

      <div class="text-base flex gap-4 items-center justify-center mt-4">
          <label class="flex gap-2 items-center">
            <input class="border-gray-300" type="radio" wire:model="shiftPressed" value="0">
            @ru
              ⇧ Shift отпущен
            @en
              ⇧ Shift released
            @endru
          </label>
          <label class="flex gap-2 items-center">
            <input class="border-gray-300" type="radio" wire:model="shiftPressed" value="1">
            @ru
              ⇧ Shift нажат
            @en
              ⇧ Shift pressed
            @endru
          </label>
      </div>
    </div>

    <p>Как можно заметить, раскладка поделена на две части. В левой половине согласные, а в правой — гласные. Еще можно заметить, что у некоторых букв несколько возможных произношений. Действительно, в зависимости от положения в слове звучание может быть разным. Тренажер не преследует цель объяснить произношение, а лишь помогает выработать связи со знакомым вам языком.</p>
    <p>После освоения алфавита можно попробовать свои силы в <a class="link" href="{{ to('trainers/numbers', ['lang' => 'ko']) }}">тренажере корейских чисел</a>.</p>
  </div>
</div>
