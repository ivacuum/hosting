<div class="grid sm:grid-cols-2 col-gap-6 row-gap-12 lg:text-xl antialiased">
  <div class="grid gap-4">
    <x-lyrics>
      {{ $slot }}
    </x-lyrics>
  </div>
  @isset ($info)
  <div>
    <p>Материалы:</p>
    {{ $info }}
  </div>
  @endisset
</div>
