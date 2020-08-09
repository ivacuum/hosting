<div>
  <button
    class="btn btn-default"
    wire:click="toggleBurned"
  >{{ $burned ? __('japanese.resurrect') : __('japanese.burn-vocabulary') }}</button>
</div>
