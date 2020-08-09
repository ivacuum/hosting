<div>
  <button
    class="btn btn-default"
    wire:click="toggleBurned"
  >{{ $burned ? __('japanese.resurrect') : __('japanese.burn-kanji') }}</button>
</div>
