<div class="py-3 text-teal-800 bg-teal-200 bg-opacity-50 border-t border-b border-teal-200 js-alert-dismiss">
  <div class="container flex">
    <div class="mr-auto">
      {{ $slot }}
    </div>
    <div class="leading-none">
      <button
        type="button"
        class="appearance-none text-2xl opacity-50 hover:opacity-75"
        onclick="this.closest('.js-alert-dismiss').remove()"
      >&times;</button>
    </div>
  </div>
</div>
