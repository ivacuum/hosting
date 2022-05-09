<?php /** @var \App\Http\Livewire\Acp\TripForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <?php $form = LivewireForm::model($this->trip); ?>

  @if($this->trip->exists)
    {{ $form->text('trip.title_ru')->required() }}
    {{ $form->text('trip.title_en')->required() }}
  @endif

  {{ $form->select('trip.city_id')->required()->values($this->cityIds) }}

  {{ $form->text('trip.slug')->required() }}

  {{ $form->text('trip.date_start')->required() }}
  {{ $form->text('trip.date_end')->required() }}

  {{ $form->radio('trip.status')->required()->values(App\Domain\TripStatus::labels()) }}

  {{ $form->text('trip.meta_description_ru') }}
  {{ $form->text('trip.meta_description_en') }}
  {{ $form->text('trip.meta_image') }}

  @if ($this->trip->metaImage())
    <div>
      <img class="max-w-full h-auto rounded" src="{{ $this->trip->metaImage() }}" alt="">
    </div>
  @endif

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->trip->exists ? 'acp.save' : 'acp.trips.add')
    </button>
  </div>
</form>
