<div>
  @if ($avatar)
    <div class="flex items-center mb-4">
      <img class="w-24 h-24 mr-6 rounded-full" src="{{ $avatar }}" alt="">
      <div>
        <button
          class="btn btn-default"
          wire:click="deleteAvatar"
        >{{ __('Удалить аватар') }}</button>
      </div>
    </div>
  @else
    <div class="mb-4">
      @include('tpl.svg-avatar', [
        'bg' => ViewHelper::avatarBg(Auth::user()->id),
        'text' => Auth::user()->avatarName(),
        'classes' => 'w-24 h-24',
      ])
    </div>
  @endif
  @include('tpl.form_errors')
  <div wire:loading.remove.delay wire:target="image">
    <input
      class="block text-muted w-full file:px-4 file:py-1 file:rounded file:border-0 file:bg-blueish-700 file:text-white hover:file:bg-blueish-800"
      accept="image/jpeg,image/png"
      type="file"
      id="{{ $randomId }}"
      wire:model="image"
    >
    <div class="form-help">{{ __('Аватар сохраняется автоматически после выбора файла') }}</div>
  </div>
  <div wire:loading.delay wire:target="image">
    {{ __('Идет загрузка...') }}
  </div>
</div>
