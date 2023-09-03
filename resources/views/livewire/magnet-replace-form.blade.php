<form class="mt-5 sm:flex sm:items-start" wire:submit="submit">
  <div class="w-full sm:max-w-xs">
    <input required type="text" wire:model="input" class="form-input" placeholder="Ссылка или инфо-хэш">
    <x-invalid-feedback field="input"/>
  </div>
  <button
    type="submit"
    class="mt-3 w-full inline-flex items-center justify-center btn btn-default focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto"
  >
    Применить
  </button>
</form>
