<?php /** @var \App\Http\Livewire\NumberSynopsis $this */ ?>

<div class="grid gap-8">
  <div>
    <div class="grid gap-6 mb-6">
      <div>
        <div class="font-medium text-lg">@lang('Язык')</div>
        <select class="form-input max-w-xs" wire:model="lang">
          @foreach($this->locales as $lang => $name)
            <option value="{{ $lang }}">{{ $name }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <div class="font-medium text-lg">@lang('Число')</div>
        <input class="form-input max-w-xs" wire:model="input">
        @error('input')
          <div class="text-sm text-red-600">
            {{ $message }}
          </div>
        @enderror
      </div>
    </div>

    <table class="table-stats table-adaptive">
      <thead>
      <tr>
        <th class="md:text-right">@lang('Число')</th>
        <th class="md:text-left">@lang('Написание')</th>
      </tr>
      </thead>
      <tbody>
      @foreach($this->numbers as $number)
        <tr>
          <td class="md:text-right">{{ $number }}</td>
          <td>
            <div class="inline-flex gap-4">
              @foreach($this->spellOuts($number) as $spellOut)
                @if($loop->first)
                  <span>{{ $spellOut }}</span>
                @else
                  <span class="text-muted">{{ $spellOut }}</span>
                @endif
              @endforeach
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
