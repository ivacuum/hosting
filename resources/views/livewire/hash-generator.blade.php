<?php /** @var \App\Livewire\HashGenerator $this */ ?>

<div class="grid grid-cols-1 gap-4">
  <div>
    <label class="block mb-1 font-semibold">@lang('Ввод')</label>
    <textarea class="the-input font-mono select-all" rows="4" wire:model.live="input"></textarea>
  </div>

  <div>
    <label class="block mb-1 font-semibold">@lang('MD5')</label>
    <input class="the-input select-all" type="text" value="{{ $this->md5() }}" readonly>
  </div>

  <div>
    <label class="block mb-1 font-semibold">@lang('SHA1')</label>
    <input class="the-input select-all" type="text" value="{{ $this->sha1() }}" readonly>
  </div>

  <div>
    <label class="block mb-1 font-semibold">@lang('SHA256')</label>
    <input class="the-input select-all" type="text" value="{{ $this->sha256() }}" readonly>
  </div>

  <div>
    <label class="block mb-1 font-semibold">@lang('SHA512')</label>
    <input class="the-input select-all" type="text" value="{{ $this->sha512() }}" readonly>
  </div>

  <div>
    <label class="block mb-1 font-semibold">@lang('XXH128')</label>
    <input class="the-input select-all" type="text" value="{{ $this->xxh128() }}" readonly>
  </div>
</div>
