<div class="py-3 text-yellow-800 bg-yellow-300 bg-opacity-25 text-opacity-75 border-t border-b border-yellow-200 js-alert-dismiss">
  <div class="container flex">
    <div class="mr-auto">
      {{ $slot }}
    </div>
    <div class="leading-4">
      <button
        type="button"
        class="appearance-none leading-5 text-2xl opacity-50 hover:opacity-75"
        onclick="this.closest('.js-alert-dismiss').remove()"
      >&times;</button>
    </div>
  </div>
</div>
