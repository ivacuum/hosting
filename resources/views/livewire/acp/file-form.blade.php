<?php /** @var \App\Livewire\Acp\FileForm $this */ ?>

<form class="grid grid-cols-1 gap-6 md:gap-4" wire:submit="submit">
  <?php $form = LivewireForm::model(App\File::class); ?>

  {{ $form->text('title')->required() }}

  @if(!$this->id)
    {{ $form->text('slug')->required() }}
    {{ $form->text('folder') }}
  @endif

  {{ $form->radio('status')->required()->values(App\Domain\FileStatus::labels()) }}

  @if(!$this->id)
    <div class="md:grid md:grid-cols-(--form-two-columns) md:gap-4 mb-4">
      <label class="font-bold">{{ ViewHelper::modelFieldTrans('file', 'file') }}</label>
      <div>
        <input class="block text-gray-500 w-full file:px-4 file:py-1 file:rounded-sm file:border-0 file:bg-sky-700 file:text-white hover:file:bg-sky-800" type="file" wire:model.live="upload">
        <x-invalid-feedback field="upload"/>
        <div class="form-help">Не более 100 МБ</div>
      </div>
    </div>
  @endif

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->id ? 'acp.save' : 'acp.files.add')
    </button>
  </div>
</form>
