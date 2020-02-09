<div class="grid md:grid-cols-2 gap-4 mb-6">
  <div>
    @if ($includeTitle ?? true)
      @ru
        <div class="mb-1">Что играли:</div>
      @en
        <div class="mb-1">Setlist:</div>
      @endru
    @endif
    {{ $slot }}
  </div>
  <div class="mobile-wide">
    <img class="mx-auto sm:rounded" src="{{ $cover }}" alt="">
  </div>
</div>
