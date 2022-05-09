<?php /** @var \App\Http\Livewire\Acp\CountryForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <?php $form = LivewireForm::model($this->country); ?>

  {{ $form->text('country.title_ru')->required() }}
  {{ $form->text('country.title_en')->required() }}
  {{ $form->text('country.slug')->required() }}
  {{ $form->text('country.emoji') }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->country->exists ? 'acp.save' : 'acp.countries.add')
    </button>
  </div>
</form>
