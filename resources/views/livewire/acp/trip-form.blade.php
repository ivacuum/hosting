<?php /** @var \App\Livewire\Acp\TripForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit="submit">
  <?php $form = LivewireForm::model(App\Trip::class); ?>

  @if($this->id)
    {{ $form->text('titleRu')->required() }}
    {{ $form->text('titleEn')->required() }}
  @endif

  {{ $form->select('cityId')->required()->values($this->cityIds)->live() }}

  {{ $form->text('slug')->required() }}

  {{ $form->text('dateStart')->required() }}
  {{ $form->text('dateEnd')->required() }}

  {{ $form->radio('status')->required()->values(App\Domain\TripStatus::labels()) }}

  {{ $form->text('metaDescriptionRu') }}
  {{ $form->text('metaDescriptionEn') }}
  {{ $form->text('metaImage') }}

  @if ($this->metaImage)
    <div>
      <img class="max-w-full h-auto rounded" src="{{ $this->metaImage }}" alt="">
    </div>
  @endif

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->id ? 'acp.save' : 'acp.trips.add')
    </button>
  </div>
</form>
