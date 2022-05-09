<?php /** @var \App\Http\Livewire\Acp\TagForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <?php $form = LivewireForm::model($this->tag); ?>

  {{ $form->text('tag.title_ru')->required() }}
  {{ $form->text('tag.title_en')->required() }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->tag->exists ? 'acp.save' : 'acp.tags.add')
    </button>
  </div>
</form>
