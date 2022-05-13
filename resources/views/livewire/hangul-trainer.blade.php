<?php /** @var \App\Http\Livewire\HangulTrainer $this */ ?>

<div class="grid lg:grid-cols-2 gap-4">
  <div>
    <p>Что будем тренировать?</p>

    <div>
      <span class="inline-block leading-snug bg-yellow-200 px-1">согласные</span>
      /
      <span class="inline-block leading-snug bg-blue-200 px-1">гласные</span>
      /
      все вместе
    </div>

    <div class="text-center">
      <div class="btn bg-gray-50 border border-gray-100 text-5xl my-6">{{ $this->jamo }}</div>
    </div>

    <form class="mt-2" wire:submit.prevent="check">
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
        wire:model.lazy="answer"
      >
    </form>
  </div>
  <div>
    <div class="grid gap-1 max-w-md text-center mb-6 text-2xl">
      <div class="grid gap-1 justify-center leading-none" style="grid-template-columns: repeat(10, minmax(25px, 35px));">
        <div class="btn bg-yellow-200 px-0">ㅂ<div class="text-gray-500 text-xs">б/п</div></div>
        <div class="btn bg-yellow-200 px-0">ㅈ<div class="text-gray-500 text-xs">дж</div></div>
        <div class="btn bg-yellow-200 px-0">ㄷ<div class="text-gray-500 text-xs">д/т</div></div>
        <div class="btn bg-yellow-200 px-0">ㄱ<div class="text-gray-500 text-xs">г/к</div></div>
        <div class="btn bg-yellow-200 px-0">ㅅ<div class="text-gray-500 text-xs">с</div></div>
        <div class="btn bg-blue-200 px-0">ㅛ<div class="text-gray-500 text-xs">ё</div></div>
        <div class="btn bg-blue-200 px-0">ㅕ<div class="text-gray-500 text-xs">ё</div></div>
        <div class="btn bg-blue-200 px-0">ㅑ<div class="text-gray-500 text-xs">я</div></div>
        <div class="btn bg-blue-200 px-0">ㅐ<div class="text-gray-500 text-xs">э</div></div>
        <div class="btn bg-blue-200 px-0">ㅔ<div class="text-gray-500 text-xs">е</div></div>
      </div>

      <div class="grid gap-1 justify-center leading-none" style="grid-template-columns: repeat(9, minmax(25px, 35px));">
        <div class="btn bg-yellow-200 px-0">ㅁ<div class="text-gray-500 text-xs">м</div></div>
        <div class="btn bg-yellow-200 px-0">ㄴ<div class="text-gray-500 text-xs">н</div></div>
        <div class="btn bg-yellow-200 px-0">ㅇ<div class="text-gray-500 text-xs">н</div></div>
        <div class="btn bg-yellow-200 px-0">ㄹ<div class="text-gray-500 text-xs">р/ль</div></div>
        <div class="btn bg-yellow-200 px-0">ㅎ<div class="text-gray-500 text-xs">х</div></div>
        <div class="btn bg-blue-200 px-0">ㅗ<div class="text-gray-500 text-xs">о</div></div>
        <div class="btn bg-blue-200 px-0">ㅓ<div class="text-gray-500 text-xs">о</div></div>
        <div class="btn bg-blue-200 px-0">ㅏ<div class="text-gray-500 text-xs">а</div></div>
        <div class="btn bg-blue-200 px-0">ㅣ<div class="text-gray-500 text-xs">и</div></div>
      </div>

      <div class="grid gap-1 justify-center leading-none" style="grid-template-columns: repeat(7, minmax(25px, 35px));">
        <div class="btn bg-yellow-200 px-0">ㅋ<div class="text-gray-500 text-xs">кх</div></div>
        <div class="btn bg-yellow-200 px-0">ㅌ<div class="text-gray-500 text-xs">тх</div></div>
        <div class="btn bg-yellow-200 px-0">ㅊ<div class="text-gray-500 text-xs">чх</div></div>
        <div class="btn bg-yellow-200 px-0">ㅍ<div class="text-gray-500 text-xs">пх</div></div>
        <div class="btn bg-blue-200 px-0">ㅠ<div class="text-gray-500 text-xs">ю</div></div>
        <div class="btn bg-blue-200 px-0">ㅜ<div class="text-gray-500 text-xs">у</div></div>
        <div class="btn bg-blue-200 px-0">ㅡ<div class="text-gray-500 text-xs">ы</div></div>
      </div>
    </div>
  </div>
</div>
