<?php /** @var \App\Livewire\Acp\FileForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit="submit">
  <?php $form = LivewireForm::model(App\File::class); ?>

  {{ $form->text('title')->required() }}

  @if(!$this->id)
    {{ $form->text('slug')->required() }}
    {{ $form->text('folder') }}
  @endif

  {{ $form->radio('status')->required()->values(App\Domain\FileStatus::labels()) }}

  @if(!$this->id)
    <div class="mb-4">
      <label class="font-bold">{{ ViewHelper::modelFieldTrans('file', 'file') }}</label>
      <input class="block w-full" type="file" wire:model.live="upload">
      <x-invalid-feedback field="upload"/>
      <div class="form-help">Не более 100 МБ</div>
    </div>
  @endif

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->id ? 'acp.save' : 'acp.files.add')
    </button>
  </div>
</form>
