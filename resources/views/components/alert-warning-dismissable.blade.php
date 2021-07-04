<div class="py-3 text-yellow-800/75 bg-yellow-300/25 border-t border-b border-yellow-200 js-alert-dismiss">
  <div class="container flex">
    <div class="mr-auto">
      {{ $slot }}
    </div>
    <div>
      <button
        type="button"
        class="appearance-none leading-none text-2xl opacity-50 hover:opacity-75"
        onclick="this.closest('.js-alert-dismiss').remove()"
      >&times;</button>
    </div>
  </div>
</div>
