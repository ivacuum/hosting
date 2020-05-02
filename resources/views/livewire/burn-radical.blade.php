<div>
  <button
    class="btn btn-default"
    wire:click="toggleBurned"
  >{{ $burned ? trans('japanese.resurrect') : trans('japanese.burn-radical') }}</button>
</div>
