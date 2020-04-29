<?php
/**
 * @var \App\Vocabulary $vocab
 */
?>

<div class="grid lg:grid-cols-2 gap-4">
  <div>
    <div class="text-center py-22">
      <div>
        <a class="bg-vocab inline-block text-5xl leading-tight ja-shadow-light px-2 rounded whitespace-no-wrap text-white hover:text-grey-200" href="{{ $vocab->www() }}">{{ $vocab->character }}</a>
      </div>
      <div class="text-3xl text-gray-600 whitespace-no-wrap">
        【{{ $vocab->firstKana() }}】
      </div>
      <div class="text-2xl text-green-600">{{ $reveal ? $vocab->toRomaji() : '&nbsp;' }}</div>
    </div>
    <form class="mt-2" wire:submit.prevent="check">
      <input
        tabindex="1"
        autocapitalize="none"
        autocomplete="off"
        autocorrect="off"
        spellcheck="false"
        placeholder="{{ trans('japanese.answer') }}"
        enterkeyhint="enter"
        class="form-input text-center {{ $reveal ? 'animate-incorrect-answer' : '' }}"
        wire:dirty.class.remove="animate-incorrect-answer"
        wire:model.lazy="answer"
      >
    </form>
    <div class="flex items-center justify-between mt-2">
      <div><button class="btn btn-default" wire:click="next">{{ trans('japanese.skip') }}</button></div>
      <div class="text-muted">{{ $answered > 0 ? trans('japanese.answered', ['x' => $answered]) : '' }}</div>
    </div>
  </div>
  <div>
    <div class="grid gap-1 items-start">
      @foreach ($history as $entry)
        <div class="inline-flex items-center">
          <a
            class="bg-vocab inline-block text-2xl leading-tight ja-shadow-light px-2 rounded whitespace-no-wrap text-white hover:text-grey-200 mr-2"
            href="{{ $entry['www'] }}"
          >{{ $entry['character'] }}</a>
          <span class="leading-tight">{{ $entry['meaning'] }}</span>
        </div>
      @endforeach
    </div>
  </div>
</div>