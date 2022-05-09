<?php /** @var \App\Http\Livewire\Acp\CityForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <?php $form = LivewireForm::model($this->city); ?>

  {{ $form->select('city.country_id')->required()->values($this->countryIds) }}

  {{ $form->text('city.title_ru')->required() }}
  {{ $form->text('city.title_en')->required() }}
  {{ $form->text('city.slug')->required() }}
  {{ $form->text('city.iata') }}
  {{ $form->text('city.lat') }}
  {{ $form->text('city.lon') }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->city->exists ? 'acp.save' : 'acp.cities.add')
    </button>
  </div>
</form>
