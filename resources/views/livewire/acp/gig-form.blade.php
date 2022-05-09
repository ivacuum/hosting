<?php /** @var \App\Http\Livewire\Acp\GigForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <?php $form = LivewireForm::model($this->gig); ?>

  {{ $form->select('gig.artist_id')->required()->values($this->artistIds) }}
  {{ $form->select('gig.city_id')->required()->values($this->cityIds) }}

  {{ $form->text('gig.title_ru')->required() }}
  {{ $form->text('gig.title_en')->required() }}
  {{ $form->text('gig.slug')->required() }}
  {{ $form->text('gig.date')->required() }}

  {{ $form->radio('gig.status')->required()->values(App\Domain\GigStatus::labels()) }}

  {{ $form->text('gig.meta_description_ru') }}
  {{ $form->text('gig.meta_description_en') }}

  {{ $form->text('gig.meta_image') }}

  @if ($this->gig->meta_image)
    <div class="mb-4">
      <img class="max-w-full h-auto rounded" src="{{ $this->gig->meta_image }}" alt="">
    </div>
  @endif

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->gig->exists ? 'acp.save' : 'acp.gigs.add')
    </button>
  </div>
</form>
