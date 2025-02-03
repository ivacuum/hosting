<form class="mt-5 flex flex-col sm:flex-row items-start gap-2" wire:submit="submit">
  <div class="w-full sm:max-w-xs">
    <input required type="text" wire:model="input" class="the-input" placeholder="Ссылка или инфо-хэш">
    <x-invalid-feedback field="input"/>
  </div>
  <button
    type="submit"
    class="w-full inline-flex items-center justify-center btn btn-default sm:w-auto"
  >
    Применить
  </button>
</form>
