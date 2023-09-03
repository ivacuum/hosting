<?php /** @var \App\Livewire\Acp\CountryForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit="submit">
  <?php $form = LivewireForm::model(App\Country::class); ?>

  {{ $form->text('titleRu')->required() }}
  {{ $form->text('titleEn')->required() }}
  {{ $form->text('slug')->required() }}
  {{ $form->text('emoji') }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->id ? 'acp.save' : 'acp.countries.add')
    </button>
  </div>
</form>
