<?php /** @var \App\Livewire\Acp\CityForm $this */ ?>

<form class="grid grid-cols-1 gap-6 md:gap-4" wire:submit="submit">
  <?php $form = LivewireForm::model(\App\Domain\Life\Models\City::class); ?>

  {{ $form->select('countryId')->required()->values($this->countryIds) }}

  {{ $form->text('titleRu')->required() }}
  {{ $form->text('titleEn')->required() }}
  {{ $form->text('slug')->required() }}
  {{ $form->text('hashtags') }}
  {{ $form->text('iata') }}
  {{ $form->text('lat')->live() }}
  {{ $form->text('lon') }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->id ? 'acp.save' : 'acp.cities.add')
    </button>
  </div>
</form>
