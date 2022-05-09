<?php /** @var \App\Http\Livewire\Acp\FileForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <?php $form = LivewireForm::model($this->file); ?>

  {{ $form->text('file.title')->required() }}

  @if(!$this->file->exists)
    {{ $form->text('file.slug')->required() }}
    {{ $form->text('file.folder') }}
  @endif

  {{ $form->radio('file.status')->required()->values(App\Domain\FileStatus::labels()) }}

  @if(!$this->file->exists)
    <div class="mb-4">
      <label class="font-bold">{{ ViewHelper::modelFieldTrans('file', 'file') }}</label>
      <input class="block w-full" type="file" wire:model="upload">
      <x-invalid-feedback field="upload"/>
      <div class="form-help">Не более 100 МБ</div>
    </div>
  @endif

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->file->exists ? 'acp.save' : 'acp.files.add')
    </button>
  </div>
</form>
