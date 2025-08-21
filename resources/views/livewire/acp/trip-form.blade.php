<?php /** @var \App\Livewire\Acp\TripForm $this */ ?>

<form class="grid grid-cols-1 gap-6 md:gap-4" wire:submit="submit">
  <?php $form = LivewireForm::model(\App\Domain\Life\Models\Trip::class); ?>

  @if($this->id)
    {{ $form->text('titleRu')->required() }}
    {{ $form->text('titleEn')->required() }}
  @endif

  {{ $form->select('cityId')->required()->values($this->cityIds)->live() }}

  {{ $form->text('slug')->required() }}

  {{ $form->datetimeLocal('dateStart')->required() }}
  {{ $form->datetimeLocal('dateEnd')->required() }}

  {{ $form->radio('status')->required()->values(\App\Domain\Life\TripStatus::labels()) }}

  {{ $form->text('metaDescriptionRu') }}
  {{ $form->text('metaDescriptionEn') }}
  {{ $form->text('metaImage')->blur() }}

  @if ($this->metaImageSrc())
    <div>
      <img class="max-w-full h-auto rounded-sm" src="{{ $this->metaImageSrc() }}" alt="">
    </div>
  @endif

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->id ? 'acp.save' : 'acp.trips.add')
    </button>
  </div>
</form>
