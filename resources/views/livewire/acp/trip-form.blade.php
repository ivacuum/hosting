<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <?php LivewireForm::model(new App\Trip); ?>

  @if ($modelId)
    {{ LivewireForm::text('title_ru')->required() }}
    {{ LivewireForm::text('title_en')->required() }}
  @endif

  {{ LivewireForm::select('city_id')->required()->values(resolve(App\Action\ListCitiesForInputSelectAction::class)->execute()) }}

  {{ LivewireForm::text('slug')->required() }}

  {{ LivewireForm::text('date_start')->required() }}
  {{ LivewireForm::text('date_end')->required() }}

  {{ LivewireForm::radio('status')->required()->values(App\Domain\TripStatus::labels()) }}

  {{ LivewireForm::text('meta_description_ru') }}
  {{ LivewireForm::text('meta_description_en') }}
  {{ LivewireForm::text('meta_image') }}

  @if ($metaImageSrc)
    <div>
      <img class="max-w-full h-auto rounded" src="{{ $metaImageSrc }}" alt="">
    </div>
  @endif

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($modelId ? 'acp.save' : 'acp.trips.add')
    </button>
  </div>
</form>
