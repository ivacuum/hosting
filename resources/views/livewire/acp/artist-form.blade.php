<?php /** @var \App\Http\Livewire\Acp\ArtistForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <?php $form = LivewireForm::model($this->artist); ?>

  {{ $form->text('artist.title')->required() }}
  {{ $form->text('artist.slug')->required() }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->artist->exists ? 'acp.save' : 'acp.artists.add')
    </button>
  </div>
</form>
