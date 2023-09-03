<?php /** @var \App\Livewire\Acp\ArtistForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit="submit">
  <?php $form = LivewireForm::model(App\Artist::class); ?>

  {{ $form->text('title')->required() }}
  {{ $form->text('slug')->required() }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->id ? 'acp.save' : 'acp.artists.add')
    </button>
  </div>
</form>
