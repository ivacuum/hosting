<?php /** @var \App\Livewire\Acp\GigForm $this */ ?>

<form class="grid grid-cols-1 gap-6 md:gap-4" wire:submit="submit">
  <?php $form = LivewireForm::model(\App\Domain\Life\Models\Gig::class); ?>

  {{ $form->select('artistId')->required()->values($this->artistIds)->live() }}
  {{ $form->select('cityId')->required()->values($this->cityIds) }}

  {{ $form->text('titleRu')->required() }}
  {{ $form->text('titleEn')->required() }}
  {{ $form->text('slug')->required() }}
  {{ $form->datetimeLocal('date')->required() }}

  {{ $form->radio('status')->required()->values(\App\Domain\Life\GigStatus::labels()) }}

  {{ $form->text('metaDescriptionRu') }}
  {{ $form->text('metaDescriptionEn') }}

  {{ $form->text('metaImage') }}

  @if ($this->metaImage)
    <div class="mb-4">
      <img class="max-w-full h-auto rounded-sm" src="{{ $this->metaImage }}" alt="">
    </div>
  @endif

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->id ? 'acp.save' : 'acp.gigs.add')
    </button>
  </div>
</form>
