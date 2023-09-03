<?php /** @var \App\Livewire\Acp\TagForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit="submit">
  <?php $form = LivewireForm::model(App\Tag::class); ?>

  {{ $form->text('titleRu')->required() }}
  {{ $form->text('titleEn')->required() }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->id ? 'acp.save' : 'acp.tags.add')
    </button>
  </div>
</form>
