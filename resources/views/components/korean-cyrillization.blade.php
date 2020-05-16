<div class="grid sm:grid-cols-2 col-gap-6 row-gap-12 lg:text-xl antialiased">
  <div class="grid gap-4">
    <x-lyrics>
      {{ $slot }}
    </x-lyrics>
  </div>
  @isset ($info)
  <div>
    <div class="sm:sticky top-4">
      <p>Материалы:</p>
      {{ $info }}
    </div>
  </div>
  @endisset
</div>
